<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //Guardo la imagen
        $imagen=$request->image->store('images');
        $cat=Category::create([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion,
        ]);

        Image::create([
            'url'=>$imagen,
            'imageable_id'=>$cat->id,
            'imageable_type'=>Category::class,
        ]);
        return redirect()->route('categories.index')->with('info', "Categoría guardada");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $miImagen=$category->image;
        if($request->image){
            $imagen=$request->image->store('images');
            Storage::delete($miImagen->url);
            $miImagen->update([
                'url'=>$imagen
            ]);
        }
        $category->update([
            'nombre'=>$request->nombre,
            'descripcion'=>$request->descripcion
        ]);
        return redirect()->route('categories.index')->with('info', "Categoría modificada");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Storage::delete($category->image->url);

        $category->delete();

        return redirect()->route('categories.index')->with('info', "Categoría Borrada");
    }
}
