<?php

namespace App\Http\Controllers;

use App\Franquias;
use App\Categories;
use App\City;
use App\Events\CallWaiter;
use App\Extras;
use App\Hours;
use App\Imports\RestoImport;
use App\Items;
use App\Models\LocalMenu;
use App\Models\Options;
use App\Notifications\RestaurantCreated;
use App\Notifications\WelcomeNotification;
use App\Plans; 
use App\Tables;
use App\User;
use App\Lojas;
use Artisan;
use Carbon\Carbon;
use DB;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
//use Intervention\Image\Image;
use Image;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class FranquiasController extends Controller
{
    protected $imagePath = 'uploads/settings/';

    private function validateAccess()
    {
        if (! auth()->user()->hasRole('admin')) {
            abort(404);
        }
    }
    /*
    private function getFields()
    {
        return [
            ['ftype'=>'image', 'name'=>__('Franquias image ( 200x200 )'), 'id'=>'image_up'],
            ['ftype'=>'input', 'name'=>'Name', 'id'=>'name', 'placeholder'=>'Enter city name', 'required'=>true],
            ['ftype'=>'input', 'name'=>'Franquias 2 - 3 letter short code', 'id'=>'alias', 'placeholder'=>'Enter city short code ex. ny', 'required'=>true],
            ['ftype'=>'input', 'name'=>'Header title', 'id'=>'header_title', 'placeholder'=>'Header title', 'required'=>true],
            ['ftype'=>'input', 'name'=>'Header subtitle', 'id'=>'header_subtitle', 'placeholder'=>'Header subtitle', 'required'=>true],

        ];
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 
    public function index()
    {
        $this->validateAccess();
        $fraq = new Lojas(); 
        
        return view('franquias.index', ['setup' => [
            'title'=>'Franquias',
            'action_link'=>route('franquias.create'),
            'action_name'=>'Adicionar franquia',
            'items'=>$fraq::where('loja', '1')->orderBy('id', 'desc')->paginate(10),
            'item_names'=>'franquias',
        ]]);
    }
    
    public function busque()
    {
        return 1234;
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    { 
        if (auth()->user()->hasRole('admin')) {
            return view('franquias.create');
        } else {
            return redirect()->route('orders.index')->withStatus(__('No Access'));
        }
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate first
        $request->validate([
            'name' => ['required', 'string', 'unique:restorants,name', 'max:255'],
            'name_owner' => ['required', 'string', 'max:255'],
            'name_owner' => ['required', 'string', 'max:255'],
            'comissao' => ['required', 'string', 'max:255'],
            'endereco' => ['required', 'string', 'max:255'],
            'cep' => ['required', 'string', 'max:255'],
            'cidade' => ['required', 'string', 'max:255'],
            'estado' => ['required', 'string', 'max:255'],
            'cpf' => ['required', 'string', 'max:255'],
            'rg' => ['required', 'string', 'max:255'], 
            'email_owner' => ['required', 'string', 'email', 'unique:users,email', 'max:255'],
            'phone_owner' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ]);

        //Create the user
        $generatedPassword = Str::random(10);
        $owner = new User;
        $owner->name = strip_tags($request->name_owner);
        $owner->email = strip_tags($request->email_owner);
        $owner->phone = strip_tags($request->phone_owner) | '';
        $owner->api_token = Str::random(80);

        $owner->password = Hash::make($generatedPassword);
        $owner->save();

        //Assign role
        $owner->assignRole('owner');
        
        //Create the franquia 
        /*
        $franquia = new Franquias;
        $franquia->nome = strip_tags($request->name);
        $franquia->proprietario = strip_tags($request->name_owner);
        $franquia->email = strip_tags($request->email_owner);
        $franquia->celular = strip_tags($request->phone_owner) | ''; 
        $franquia->lojas = 0;
        $franquia->assinaturas = strip_tags($request->comissao);
        $franquia->cpf = $request->cpf;
        $franquia->rg = $request->rg;
        $franquia->cidade = $request->cidade;
        $franquia->estado = $request->estado;
        $franquia->cep = $request->cep;
        $franquia->endereco = $request->endereco; 
        $franquia->status = 1;
        $franquia->save();
        
        $dados['nome'] = strip_tags($request->name);
        $dados['proprietario'] = strip_tags($request->name_owner);
        $dados['email'] = strip_tags($request->email_owner);
        $dados['celular'] = strip_tags($request->phone_owner) | ''; 
        $dados['lojas'] = 0;
        $dados['assinaturas'] = strip_tags($request->comissao);
        $dados['cpf'] = $request->cpf;
        $dados['rg'] = $request->rg;
        $dados['cidade'] = $request->cidade;
        $dados['estado'] = $request->estado; 
        $dados['cep'] = $request->cep;
        $dados['endereco'] = $request->endereco;
        $dados['status'] = 1; 
        
        DB::table('franquias')->insert($dados);
        */
        
        
        //Create Restorant
        $restaurant = new Restorant;
        $restaurant->name = strip_tags($request->name);
        $restaurant->user_id = $owner->id;
        $restaurant->description = strip_tags($request->description.'');
        $restaurant->minimum = $request->minimum | 0;
        $restaurant->lat = 0;
        $restaurant->lng = 0;
        $restaurant->address = '';
        $restaurant->phone = $owner->phone;
        $restaurant->subdomain = $this->makeAlias(strip_tags($request->name));
        //$restaurant->logo = "";
        $restaurant->save();

        //Send email to the user/owner
        $owner->notify(new RestaurantCreated($generatedPassword, $restaurant, $owner));

        return redirect()->route('franquias.index')->withStatus(__('Franquia criada com sucesso!'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Franquias $franquia)
    {
        $this->validateAccess();
        $fraq = new Franquias(); 
        $getCat = explode("/", $_SERVER['REQUEST_URI']);
        $categoria = $getCat[2];
        
        $dados = $fraq::where('id', $categoria)->orderBy('id', 'desc')->paginate(10);
        
        return view('franquias.edit', ['setup' => [
            'title'=> "Editar Franquia",
            'action_link'=>route('franquias.index'),
            'action_name'=>'Voltar',
            'items'=> $dados,
            'item_names'=>'franquias',
        ]]);
        
        //return view('franquias.edit');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Franquias $city)
    {
        $this->validateAccess();
        $city->name = $request->name;
        $city->alias = $request->alias;
        $city->header_title = $request->header_title;
        $city->header_subtitle = $request->header_subtitle; 

        $city->update();

        return redirect()->route('franquias.index')->withStatus(__('Franquias was updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Franquias $city)
    {
        $this->validateAccess();
        $city->delete();

        return redirect()->route('franquias.index')->withStatus(__('Item was deleted.'));
    }

    
}
