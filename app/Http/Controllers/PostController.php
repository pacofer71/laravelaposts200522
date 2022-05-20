<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::where('user_id', auth()->user()->id)->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags=Tag::orderBy('nombre')->get();
        $categories=Category::pluck('nombre', 'id');
        return view('admin.posts.create', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imagen=$request->image->store('images');
        $post=Post::create([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'estado'=>$request->estado,
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id
        ]);
        $post->tags()->attach($request->tags);
        Image::create([
            'url'=>$imagen,
            'imageable_id'=>$post->id,
            'imageable_type'=>Post::class
        ]);
        return redirect()->route('posts.index')->with('info', 'Post Guardado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $tags=Tag::orderBy('nombre')->get();
        $categories=Category::pluck('nombre', 'id');
        return view('admin.posts.edit', compact('post', 'tags', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $imagen=$post->image;
        if($request->image){
            Storage::delete($imagen);
            $imagen=$request->image->store('images');
            $post->image()->update([
                'url'=>$imagen
            ]);
        }

        $post->update([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'estado'=>$request->estado,
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id
        ]);
        $post->tags()->sync($request->tags);

        return redirect()->route('posts.index')->with('info', 'Post Editado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(isset($post->image->url)){
            Storage::delete($post->image->url);
            $post->image->delete();
        }

        $post->delete();
        return redirect()->route('posts.index')->with('info', 'Post Borrado');
    }
}
