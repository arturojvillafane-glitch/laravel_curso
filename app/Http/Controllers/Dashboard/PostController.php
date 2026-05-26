<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Post\PutRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /*public function index()
    {
        return Post::create(
            ['title' => "test",
             'slug' => "test",
             'content' => "test",
             'item' => "item 1",
             'category_id' => 1,
             'description' => "test",
             'posted' => "not",
             'image' => "test"]
        );

    }
*/

public function index()
{
        $post = Post::find(3);
        //dd($post);
       /* return $post->update(
            [
                'title' => "test new",
                'slug' => "test",
                'content' => "test",
                'category_id' => 1,
                'description' => "test ho,la",
                'posted' => "not",
                'image' => "test",
                'item' => "item 1"
            ]
        );*/
        //$post = Post::get();
        //$post = Post::all()->toSql()
         //return Post::where("category_id", '3')->toSql();
        //dd($post);

        //$post = Post::find(4);
        //dd($post->Category);
/*
        }
        $categorias = Category::find(1);
        //dd($categorias);
        foreach ($categorias->posts as $post) {
            echo $post->title;
        }
        //dd($categoria->posts);
*/

   //return $post->delete();
   $posts = Post::paginate(2);
    return view('dashboard.post.index', compact('posts'));

}




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $categories = Category::pluck('id', 'title');
    $post = new Post();
    return view('dashboard.post.create', compact('categories', 'post'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        /*
          $request->validate([
            "title" => "required|min:5|max:500",
            "slug" => "required|min:5|max:500",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required"
          ]);
 */       
    /*
        $validated = Validator::make($request->all(), ["title" =>
            "required|min:5|max:500",
            "slug" => "required|min:5|max:500",
            "content" => "required|min:7",
            "category_id" => "required|integer",
            "description" => "required|min:7",
            "posted" => "required"
        ]);        

        dd($validated->errors());

        //dd($request->all());
        */
        session(['key-xx' => 'ENV-55']);
        Post::create($request->validated());
        return to_route("post.index")->with('status', 'Post CREADO CORRECTAMENTE'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view("dashboard.post.show",compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::pluck('id', 'title');
        return view('dashboard.post.edit', compact('categories', 'post'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PutRequest $request, Post $post)
    {
        $data = $request->validated();
        if( isset($data["image"])){
        $data["image"] = time().".".$data["image"]->extension();
        $request->image->move(public_path("image"), $data["image"] );
    
        $post->update($data);
        return to_route("post.index")->with('status', 'Post updated');

    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
    $post->delete();
    session()->forget('key-xx');
   return to_route('post.index')->with('status', 'Se elimino el  post');
    }
    
}

