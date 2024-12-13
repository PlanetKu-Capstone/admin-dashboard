<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('screens.article.index', [
            'articles' => Article::latest()->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('screens.article.insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:articles',
            'image' => 'required|image|file|max:2048|mimes:jpeg,png,jpg,gif,webp',
            'description' => 'required',
            'views' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['excerpt'] = str::limit(strip_tags($request->description), 110);

        Article::create($validatedData);

        return redirect('/dashboard')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('screens.article.show', [
            'article' => $article = Article::where('slug', $id)->firstorfail()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('screens.article.update', [
            'article' => $article = Article::where('slug', $id)->firstorfail()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'title' => 'required|max:255',
            'image' => 'image|file|max:2048|mimes:jpeg,png,jpg,gif,webp',
            'description' => 'required',
            'views' => 'required'
        ];

        $article = Article::where('slug', $id)->firstorfail();

        
        if($request->slug != $article->slug){
            $rules['slug'] = 'required|unique:articles';
        }
        
        $validatedData = $request->validate($rules);
        
        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
         
        $validatedData['excerpt'] = Str::limit(strip_tags($request->description), 110);

        Article::where('id', $article->id)
            ->update($validatedData);

        return redirect('/dashboard')->with('success', "Post has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::where('slug', $id)->firstorfail();
        if($article->image) {
            Storage::delete($article->image);
        }
        Article::destroy($article->id);
        return  redirect('/dashboard')->with('success', 'Post has been deleted!');
    }

    public function checkSlug(Request $request){

       $slug = SlugService::createSlug(Article::class, 'slug', $request->title); // title itu url yang parameternya dari js yang di create
       return response()->json(['slug' => $slug]);
      
    }
}
