<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::all();

        return response()->json([
            'message' => 'Lista de superhéroes',
            'data' => $heroes
        ]);
    }

    public function show($id)
    {
        $hero = Hero::find($id);

        if (!$hero) {
            return response()->json([
                'message' => 'Superhéroe no encontrado'
            ], 404);
        }

        return response()->json([
            'message' => 'Superhéroe encontrado',
            'data' => $hero
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:heroes,nombre',
            'nombre_real' => 'required|string|max:255',
            'poder_principal' => 'required|string|max:255',
            'nivel_poder' => 'required|integer|min:1|max:100',
            'imagen_url' => 'nullable|url|max:255',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $hero = Hero::create($validated);

        return response()->json([
            'message' => 'Superhéroe creado correctamente',
            'data' => $hero
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $hero = Hero::find($id);

        if (!$hero) {
            return response()->json([
                'message' => 'Superhéroe no encontrado'
            ], 404);
        }

        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:heroes,nombre,' . $id,
            'nombre_real' => 'required|string|max:255',
            'poder_principal' => 'required|string|max:255',
            'nivel_poder' => 'required|integer|min:1|max:100',
            'imagen_url' => 'nullable|url|max:255',
            'estado' => 'required|in:ACTIVO,INACTIVO',
        ]);

        $hero->update($validated);

        return response()->json([
            'message' => 'Superhéroe actualizado correctamente',
            'data' => $hero
        ]);
    }

    public function destroy($id)
    {
        $hero = Hero::find($id);

        if (!$hero) {
            return response()->json([
                'message' => 'Superhéroe no encontrado'
            ], 404);
        }

        $hero->delete();

        return response()->json([
            'message' => 'Superhéroe eliminado correctamente'
        ]);
    }
}