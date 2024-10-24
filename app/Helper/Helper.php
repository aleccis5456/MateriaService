<?php

namespace App\Helper;

use App\Models\Curso;
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
        $cursos = $request->bulk;        
        $cursosCreados = [];             
        foreach($cursos as $curso){
            $validator = Validator::make($curso, [
                'curso' => 'required|string',
                'promocion' => 'required|numeric|digits:4',
                'bachillerato' => 'required|string'
            ]);
            if($validator->fails()){
                return response()->json([
                    'message' => 'error en la validacion del helper',
                    'errors' => $validator->errors(),
                ]);
            }
            try{
                $newCurso = Curso::create([
                    'curso' => $curso['curso'],
                    'promocion' => $curso['promocion'],
                    'bachillerato' => $curso['bachillerato'],
                ]);

                $cursosCreados[] = $newCurso;
            }catch(\Exception $e){
                return response()->json([
                    'message' => $e->getMessage(),
                ]);
            }                        
        }

        return response()->json([
            'message' => 'cursos creados',
            'cursos' => $cursosCreados,
        ]);
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

