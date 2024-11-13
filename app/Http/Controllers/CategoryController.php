<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear la nueva categoría
        Category::create($request->only('name', 'description'));

        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Display the specified category.
     */
    public function show($encryptedId)
    {
        
            $id = Crypt::decryptString($encryptedId);
            $category = Category::findOrFail($id);
            return view('categories.show', compact('category'));
        
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
            $category = Category::findOrFail($id);
            return view('categories.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Categoría no encontrada');
        }
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
            $category = Category::findOrFail($id);

            // Validación de datos
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Actualizar la categoría
            $category->update($request->only('name', 'description'));

            return redirect()->route('categories.index')->with('success', 'Categoría actualizada exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error al actualizar la categoría');
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
            $category = Category::findOrFail($id);
            $category->delete();

            return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Error al eliminar la categoría');
        }
    }
}
