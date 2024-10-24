<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;

class TareaController extends Controller
{
    public function store(Request $request){
        $token = $request->header('Authorization');
        if(!$user = $this->validarToken($token)){
            return response()->json(['message' => 'no autorizado'],401);
        }
        if($user->rol != 'profesor'){
            return response()->json(['message' => 'no autorizado'],401);
        }

        $validator = Validator::make($request->all(), [
            'profesor_id' => 'required|numeric|exists:profesores,id',
            'clase_id' => 'required|numeric|exists:materias,id',
            'descripcion' => 'nullable|string',
            'fecha_limite' => 'required|date'
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'error en la validacion',
                'errors' => $validator->errors(),
            ]);
        }

                
        
    }

    public function validarToken($token){                 
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('http://127.0.0.1:8001/api/validarToken');        
        return $response->object();
    }
}
