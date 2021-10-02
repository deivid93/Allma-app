<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Area;
use App\Models\Rol;

class EmpleadoController extends Controller
{
    public function new(){
        $areas = Area::all();
        $roles = Rol::all();
        return view('Empleado.new', ['areas'=> $areas, 'roles' => $roles]);
    }

    public function create(Request $request){
        $areas = Area::all();
        $roles = Rol::all();
        $datos = $request->all();
        //Validacion
        $request->validate([
            'nombre' => 'required|min:5|max:100',
            'email' => 'required|email',
            'sexo' => 'required',
            'area_id' => 'required',
            'descripcion' => 'required|min:5|max:100'
        ]);

         $empleado = new Empleado();
         $empleado->nombre = $datos['nombre'];
         $empleado->email = $datos['email'];
         if($datos['sexo'] == 'Masculino'){
            $empleado->sexo = 'M';
         }else{
            $empleado->sexo = 'F';
         }
         $empleado->area_id = $datos['area_id'];
         $empleado->descripcion = $datos['descripcion'];
         $empleado->save();
         $empleado->roles()->attach($datos['rol']);
        $data = array(
            'status' => 'success',
            'code' => 200,
            'message' => 'Empleado creado');    
        
        return view('Empleado.index', ['success'=> $data['message'],'areas'=> $areas, 'roles' => $roles ]);
    }

    public function index(Request $request){
        $areas = Area::all();
        $roles = Rol::all();
        return view('Empleado.index', ['areas'=> $areas, 'roles' => $roles]);
    }

    public function ajaxEmpleado(Request $request){
        $input = request()->all();
        $pagina = $input['offset'];
        $limite = $input['limit'];
        $empleado = Empleado::orderBy('id', 'ASC')->with('area');
        $all = $empleado->count();
        //dd($all);
        $resultado = $empleado->skip($pagina)->limit($all)->take($limite)->get();

        $data["total"] = $all;
        $data["totalNotFiltered"] = $all;
        $data["rows"] = $resultado;
        return response()->json($data);
    }

    public function show($id, Request $request){
        $empleado = Empleado::find($id);
        return view('empleado/show', array('empleado'=> $empleado) );
    }
    public function update(Request $request)
    {
        $datos = $request->all();
        $e = Empleado::find($request->request->all()['id']);
        $e->nombre = $request->request->all()['nombre'];
        $e->email = $request->request->all()['email'];
        if($request->request->all()['sexo'] == 'M'){
            $e->sexo = 'M';
         }else{
            $e->sexo = 'F';
         }
        $e->area_id = $request->request->all()['area_id'];
        $e->descripcion = $request->request->all()['descripcion'];
        $e->update();

        return response()->json($e);
        
        //return view('Empleado.index');
    }

}
