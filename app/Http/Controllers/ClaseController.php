<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class ClaseController extends Controller
{
    public function index(){
        return response()->json(Clase::all());
    }
    
    public function store(Request $request){
        $token = $request->header('authorization');        
        if(!$user = $this->validarToken($token)){
            return response()->json(['message' => 'no autorizado'], 401);
        }              
        if($user->rol != 'admin'){
            return response()->json(['message' => 'no autorizado'], 401);
        }

        $validator = Validator::make($request->all(), [
            'profesor_id' => 'required|numeric|exists:profesores,id',
            'curso_id' => 'required|numeric|exists:cursos,id',
            'materia_id' => 'required|numeric|exists:materias,id',
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salida' => 'required|date_format:H:i',
            'aula' => 'nullable|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'error en la validacion',
                'errors' => $validator->errors(),
            ]);
        }
        try{
            $clase = Clase::create($request->all());        
            return response()->json([
                'message' => 'clase creada',
                'clase' => $clase
            ]);
        }catch(\Exception $e){
            return response()->json([
                'message' => 'error al crear la clase',
                'errors' => $e->getMessage(),
            ], 400);
        }                
    }

    public function validarToken($token){                 
        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->post('http://127.0.0.1:8001/api/validarToken');        
        return $response->object();
    }
}
