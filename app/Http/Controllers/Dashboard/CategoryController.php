<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\PutRequest;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Verificar si el usuario tiene permiso para ver el índice de categorías
        if (!Auth::user()->hasPermissionTo('editor.category.index')) {
            abort(403, 'No tienes permiso para ver las categorías');
        }
        $categories = Category::paginate(2);
        return view('dashboard.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Verificar si el usuario tiene permiso para crear categorías
        if (!Auth::user()->hasPermissionTo('editor.category.create')) {
            abort(403, 'No tienes permiso para crear categorías');
        }
        $category = new Category();
        return view('dashboard.category.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        // Verificar si el usuario tiene permiso para crear categorías
        if (!Auth::user()->hasPermissionTo('editor.category.create')) {       
            abort(403, 'No tienes permiso para crear categorías');
        }   
        Category::create($request->validated());
        return to_route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        // Verificar si el usuario tiene permiso para ver la categoría
        if (!Auth::user()->hasPermissionTo('editor.category.show')) {
            abort(403, 'No tienes permiso para ver la categoría');
        }       
        return view('dashboard.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        // Verificar si el usuario tiene permiso para editar la categoría
        if (!Auth::user()->hasPermissionTo('editor.category.edit')) {
            abort(403, 'No tienes permiso para editar la categoría');
        }
        return view('dashboard.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Category $category)
    {
        // Verificar si el usuario tiene permiso para actualizar la categoría
        if (!Auth::user()->hasPermissionTo('editor.category.update')) {
            abort(403, 'No tienes permiso para actualizar la categoría');
        }
        $category->update($request->validated());
        return to_route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Verificar si el usuario tiene permiso para eliminar la categoría
        if (!Auth::user()->hasPermissionTo('editor.category.destroy')) {
            abort(403, 'No tienes permiso para eliminar la categoría');
        }
        $category->delete();
        return to_route('category.index');
    }
}