<?php

namespace App\Helper;

use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class Helper
{
    public static function arrStoreMaterias(Request $request)
    {
        $matiasCreadas = [];
        $materias = $request->all();
        foreach ($materias as $materia) {
            $validator = Validator::make($materia, [
                'name' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'error en la validacion del helper',
                    'errors' => $validator->errors(),
                ]);
            }
            $materia = Materia::create(['name' => $materia['name']]);

            $matiasCreadas[] = $materia;
        }

        return response()->json([
            'message' => 'materias creadas',
            'materias' => $matiasCreadas,
        ]);
    }

    public static function arrStoreCursos(Request $request) {
        
    }

    public static function validarToken(Request $request){        
        $token = $request->header('authorization');
        $response = Http::withHeaders([
            'Authorization' => $token
        ])->post('http://127.0.0.1:8001/api/validarToken');

        $user = $response->object();        

        if(!$user){
            return response()->json(['message' => 'no autorizado'], 401);
        }
        if($user->rol != 'admin'){  
            return response()->json(['message' => 'no autorizado'], 401);
        }        
        return 'auth';
    }
   
}

