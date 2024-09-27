<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function index()
    {
        $cargos = Cargo::with('jefe')->paginate(10);
        return view('cargos.index', compact('cargos'));
    }

    public function edit($id)
    {
        $cargo = Cargo::findOrFail($id);
        $empleados = Empleado::all(); // Para mostrar todos los empleados disponibles como jefes
        return response()->json(compact('cargo', 'empleados'));
    }

    public function update(Request $request, $id)
    {
        $cargo = Cargo::findOrFail($id);
        $cargo->update($request->all());

        return response()->json(['message' => 'Cargo actualizado con éxito']);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'empleado_id' => 'required|integer',
        'area' => 'required|string|max:255',
        'cargo' => 'required|string|max:255',
        'rol' => 'required|string|max:50',
        'jefe_id' => 'nullable|integer'
    ]);

    Cargo::create($validatedData);

    return response()->json(['message' => 'Cargo creado con éxito']);
}
}
