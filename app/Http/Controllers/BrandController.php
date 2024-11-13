<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     */
    public function index()
    {
        $brands = Brand::with('category')->get();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create()
    {
        $categories = Category::all();
        return view('brands.create', compact('categories'));
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required', // Validar que se seleccione una categoría
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Desencriptar el category_id antes de almacenar
        $categoryId = Crypt::decryptString($request->input('category_id'));

        // Crear la nueva marca
        Brand::create([
            'name' => $request->input('name'),
            'category_id' => $categoryId,
        ]);

        return redirect()->route('brands.index')->with('success', 'Marca creada exitosamente');
    }

    /**
     * Display the specified brand.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $brand = Brand::with('category')->findOrFail($id);

        return view('brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $brand = Brand::findOrFail($id);
        $categories = Category::all();

        return view('brands.edit', compact('brand', 'categories'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, $encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $brand = Brand::findOrFail($id);

        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $categoryId = Crypt::decryptString($request->input('category_id'));
        //$categoryId = $request->input('category_id');

        // Actualizar la marca
        $brand->update([
            'name' => $request->input('name'),
            'category_id' => $categoryId,
        ]);

        return redirect()->route('brands.index')->with('success', 'Marca actualizada exitosamente');
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy($encryptedId)
    {
        $id = Crypt::decryptString($encryptedId);
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Marca eliminada exitosamente');
    }
}
