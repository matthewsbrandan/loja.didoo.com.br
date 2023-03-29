<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\Categories;

class IntegrateCmsController extends Controller
{
    public function authenticate(Request $request){
        if(!$user = User::with(['restorant' => function($q){
            $q->with(['categories' => function($sq){
                $sq->with('aitems');
            }]);
        }])->whereEmail($request->email)->first()) return response()->json([
            "result" => false,
            "response" => [
                "error-type" => "email",
                "message" => "Email não localizado"
            ]
        ]);
        if(!Hash::check($request->password,$user->password)) return response()->json([
            "result" => false,
            "response" => [
                "error-type" => "password",
                "message" => "Senha inválida"
            ]
        ]);

        $countProducts = 0;
        if($user->restorant && $user->restorant->categories->count() > 0) {
            foreach($user->restorant->categories as $category) {
                $countProducts+=$category->aitems->count();
            }
        }

        if($countProducts == 0) return response()->json([
            "result" => false,
            "response" => [
                "error-type" => "empty",
                "message" => "Você não possui nem um produto neste catálogo"
            ]
        ]);        

        return response()->json([
            "result" => true,
            "response" =>  [
                'user_id' => $user->id,
                'token' => $user->api_token,
                'total_products' => $countProducts
            ]
        ]);
    }
    public function fullCatalog($token){
        if(!$user = User::with(['restorant' => function($query){
            $query->with(['categories' => function($subQuery){
                $subQuery->with('aitems');
            }]);
        }])->whereApiToken($token)->first()) return response()->json([
            "result" => false,
            "response" => "Token Inválido"
        ]);

        if($user->restorant && $user->restorant->categories->count() > 0){
            $categories = $user->restorant->categories;
            return response()->json([
                "result" => true,
                "response" =>  $categories
            ]);
        }

        return response()->json([
            "result" => false,
            "response" => "Você não possui nem um produto neste catálogo"
        ]);
    }
    public function randomProducts($token, $take = 15){
        if(!$user = User::with(['restorant' => function($query){
            $query->with(['categories' => function($subQuery){
                $subQuery->with('aitems');
            }]);
        }])->whereApiToken($token)->first()) return response()->json([
            "result" => false,
            "response" => "Token Inválido"
        ]);

        if($user->restorant && $user->restorant->categories->count() > 0){
            $categories = $user->restorant->categories;
            $products = [];
            foreach($categories as $category){
                $products = [...$products, ...$category->aitems];
            }
            shuffle($products);
            return response()->json([
                "result" => true,
                "response" =>  array_slice($products,0,$take)
            ]);
        }

        return response()->json([
            "result" => false,
            "response" => "Você não possui nem um produto neste catálogo"
        ]);
    }
}
