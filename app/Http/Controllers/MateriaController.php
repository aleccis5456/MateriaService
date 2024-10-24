<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class MateriaController extends Controller
{    
    public function index(Request $request){
        $busqueda = $request->query('b');        
        $query = Materia::query();

        if($request->has('b')){  
            $query->whereLike('name', "%$busqueda%");
        }else{
            $query->orderByDesc('id');
        }        
    
        $materias = $query->get();

        return response()->json($materias);
    }
    
    public function store(Request $request){        
        $response = Helper::validarToken($request); 
        if($response != 'auth'){
            return $response;
        }
    
        if(count($request->all()) == 1){
            $validator = Validator::make($request->all(), [
                'name' => 'required|string'
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'message' => 'error en la validacion',
                    'errors' => $validator->errors(),
                ], 400);
            }
    
            $materia = Materia::create([
                'name' => $request->name,
            ]);
    
            return response()->json([
                'message' => 'materia creada',
                'materia' => $materia
            ], 201);
        
        }elseif(count($request->all()) == 0){
            return response()->json(['message' => 'los datos no se cargaron correctamente']);
        }
        else{
            return Helper::arrStoreMaterias($request);
        }
        
    }
    
    public function destroy(String $id){
        $materia = Materia::destroy($id);
        if(!$materia){
            return response()->json(['message' => 'no se pudo borrar'], 400);
        }

        return response()->json('materia borrado', 200);
    }
}
