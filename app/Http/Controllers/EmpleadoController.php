<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;

class EmpleadoController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'identificacion' => 'required|string|max:20',
            'telefono' => 'required|string|max:15',
            'ciudad' => 'required|string|max:100',
            'departamento' => 'required|string|max:100',
        ]);

        $empleado = Empleado::create($validatedData);

        return response()->json(['message' => 'Empleado guardado con éxito']);
    }

    public function index()
        {
            $empleados = Empleado::paginate(10); // Usamos paginación para la vista
            return view('empleados.index', compact('empleados'));
        }


    public function edit($id)
    {
     
        $empleado = Empleado::findOrFail($id);

        return response()->json($empleado);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
    
        $empleado->update($request->all());
    
        return response()->json(['message' => 'Empleado actualizado con éxito']);
    }


   public function indexApi()
{
    $empleados = Empleado::all(); // Retorna todos los empleados
    return response()->json(['empleados' => $empleados]);
}

}

