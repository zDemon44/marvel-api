<?php

namespace App\Http\Controllers;

use App\Models\Mision;
use App\Models\Hero;
use Illuminate\Http\Request;

class MisionController extends Controller
{
    public function index()
    {
        $misiones = Mision::with('heroe')->get();

        return response()->json([
            'message' => 'Lista de misiones',
            'data' => $misiones
        ]);
    }

    public function show($id)
    {
        $mision = Mision::with('heroe')->find($id);

        if (!$mision) {
            return response()->json([
                'message' => 'Misión no encontrada'
            ], 404);
        }

        return response()->json([
            'message' => 'Misión encontrada',
            'data' => $mision
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'nivel_peligro' => 'required|in:BAJO,MEDIO,ALTO',
            'estado' => 'required|in:PENDIENTE,EN_PROGRESO,COMPLETADA',
            'superheroe_id' => 'required|integer|exists:heroes,id',
        ]);

        $mision = Mision::create($validated);

        return response()->json([
            'message' => 'Misión creada correctamente',
            'data' => $mision->load('heroe')
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $mision = Mision::find($id);

        if (!$mision) {
            return response()->json([
                'message' => 'Misión no encontrada'
            ], 404);
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'ubicacion' => 'required|string|max:255',
            'fecha' => 'required|date',
            'nivel_peligro' => 'required|in:BAJO,MEDIO,ALTO',
            'estado' => 'required|in:PENDIENTE,EN_PROGRESO,COMPLETADA',
            'superheroe_id' => 'required|integer|exists:heroes,id',
        ]);

        $mision->update($validated);

        return response()->json([
            'message' => 'Misión actualizada correctamente',
            'data' => $mision->load('heroe')
        ]);
    }

    public function destroy($id)
    {
        $mision = Mision::find($id);

        if (!$mision) {
            return response()->json([
                'message' => 'Misión no encontrada'
            ], 404);
        }

        $mision->delete();

        return response()->json([
            'message' => 'Misión eliminada correctamente'
        ]);
    }
}