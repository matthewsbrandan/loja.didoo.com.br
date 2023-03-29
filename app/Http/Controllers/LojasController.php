<?php

namespace App\Http\Controllers;

use App\Lojas;
use Illuminate\Http\Request;
use App\Franquias;
use Auth;

class LojasController extends Controller
{
    protected $imagePath = 'uploads/settings/';
 
    private function getFields()
    {
        return [
            ['ftype'=>'image', 'name'=>__('loja image ( 200x200 )'), 'id'=>'image_up'],
            ['ftype'=>'input', 'name'=>'Name', 'id'=>'name', 'placeholder'=>'Enter loja name', 'required'=>true],
            ['ftype'=>'input', 'name'=>'loja 2 - 3 letter short code', 'id'=>'alias', 'placeholder'=>'Enter loja short code ex. ny', 'required'=>true],
            ['ftype'=>'input', 'name'=>'Header title', 'id'=>'header_title', 'placeholder'=>'Header title', 'required'=>true],
            ['ftype'=>'input', 'name'=>'Header subtitle', 'id'=>'header_subtitle', 'placeholder'=>'Header subtitle', 'required'=>true],

        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $ids = Auth::user()->id;
        $id = 1;
        
        return view('lojas.index', ['setup' => [
            'title'=>'Minhas Lojas',
            'action_link'=>route('lojas.create'),
            'action_name'=>'Adicionar loja',
            'items'=>Lojas::where('franquia', $ids)->orderBy('id', 'desc')->paginate(10),
            'item_names'=>'lojas',
        ]]);
    }
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        /*return view('general.form', ['setup' => [
            'title'=>'Nova loja',
            'action_link'=>route('lojas.index'),
            'action_name'=>__('Back'),
            'iscontent'=>true,
            'action'=>route('lojas.store'),
            'breadcrumbs'=>[
                [__('Lojas'), route('lojas.index')],
                [__('Nova Loja'), null],
            ],
        ],
        'fields'=>$this->getFields(), ]);*/
        return view('lojas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAccess();
        //Validate first
        $request->validate([
            'name' => ['required', 'string', 'unique:lojas,name', 'max:255'],
            'alias' => ['required', 'string', 'unique:lojas,alias', 'string', 'max:255'],
        ]);

        $loja = loja::create([
            'name'=>$request->name,
            'alias'=>$request->alias,
            'image'=>'',
            'header_title'=>$request->header_title,
            'header_subtitle'=>$request->header_subtitle,

        ]);
        $loja->save();

        if ($request->hasFile('image_up')) {
            $loja->image = $this->saveImageVersions(
                $this->imagePath,
                $request->image_up,
                [
                    ['name'=>'large', 'w'=>590, 'h'=>590],
                    ['name'=>'medium', 'w'=>300, 'h'=>300],
                    ['name'=>'thumbnail', 'w'=>200, 'h'=>200],
                ]
            );
            $loja->update();
        }

        return redirect()->route('lojas.index')->withStatus(__('loja was added'));
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
    public function edit(loja $loja)
    {
        $this->validateAccess();
        $fields = $this->getFields();
        $fields[0]['value'] = $loja->logo;
        $fields[1]['value'] = $loja->name;
        $fields[2]['value'] = $loja->alias;
        $fields[3]['value'] = $loja->header_title;
        $fields[4]['value'] = $loja->header_subtitle;

        //dd($option);
        return view('general.form', ['setup' => [
            'title'=>__('Edit loja').' '.$loja->name,
            'action_link'=>route('lojas.index'),
            'action_name'=>__('Back'),
            'iscontent'=>true,
            'isupdate'=>true,
            'action'=>route('lojas.update', ['loja'=>$loja->id]),
            'breadcrumbs'=>[
                [__('lojas'), route('lojas.index')],
                [$loja->name, null],
            ],
        ],
        'fields'=>$fields, ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, loja $loja)
    {
        $this->validateAccess();
        $loja->name = $request->name;
        $loja->alias = $request->alias;
        $loja->header_title = $request->header_title;
        $loja->header_subtitle = $request->header_subtitle;

        if ($request->hasFile('image_up')) {
            $loja->image = $this->saveImageVersions(
                $this->imagePath,
                $request->image_up,
                [
                    ['name'=>'large', 'w'=>590, 'h'=>590],
                    ['name'=>'medium', 'w'=>300, 'h'=>300],
                    ['name'=>'thumbnail', 'w'=>200, 'h'=>200],
                ]
            );
        }

        $loja->update();

        return redirect()->route('lojas.index')->withStatus(__('loja was updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(loja $loja)
    {
        $this->validateAccess();
        $loja->delete();

        return redirect()->route('lojas.index')->withStatus(__('Item was deleted.'));
    }

    
}
