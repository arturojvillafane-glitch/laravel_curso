<?php

use App\Http\Controllers\Blog\BlogController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Test\TuControlador;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Category;
use App\Models\User;
use App\Http\Controllers\User\ProfileController;
use App\Models\Product;
use App\Models\Tag;

/*
Route::get('/poli', function () {
    
    $user = User::find(1);
    //$user->image()->create(['url' => 'avatars/user1.jpg']);

    $product = Product::find(1);
    //$product->image()->create(['url' => "avatars/producto1.jpg"]);
    
    $imageUrl = $user->image->url;
    //dd($imageUrl);

    $imageUrl_Pro = $product->image->url;
    dd($imageUrl_Pro);

});*/


Route::get('/', function (){
    return view('welcome');
});


Route::group(['prefix' => 'blog'], function () {
    Route::controller(BlogController::class)->group(function () {
       Route::get('', [BlogController::class, 'index'])->name('blog.index');
       Route::get('detail/{post}', [BlogController::class, 'show'])->name('blog.show');
    });
});

Route::get("/contacto", function(){
    return view("contacto");
});

Route::get('/bio', function () {
    $msj2 = "Msj from server *-*";
    $data = ['msj2' => $msj2, "age" => 15, "name" => "pepe"];
    return view('bio', $data);
 });


Route::get("/panel", function  (){
        return view("panel.panel1");
});

Route::get("/detalle", function  (){
        return view("detalle");
});


Route::resource('post', PostController::class);
//Route::resource('category',CategoryController::class);

/*
Route::group(['prefix' => 'dashboard'], function () {
    Route::resource('post', PostController::class);
    //Route::resource('category', CategoryController::class);
});
*/



Route::middleware([App\Http\Middleware\TestMiddleware::class])->group(function () {
    Route::get('/test/{id}', function (int $id) {
        echo $id;
    });
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
            })->name("dashboard");
        Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,
        'category' => App\Http\Controllers\Dashboard\CategoryController::class,
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});




Route::group(['prefix' => 'dashboard', 'middleware' => ['auth',App\Http\Middleware\UserIsAdminMiddleware::class]], function () {
    Route::get('/', function () {
        return view('dashboard.dashboard');
            })->name("dashboard");

    Route::resources([
        'post' => App\Http\Controllers\Dashboard\PostController::class,    
        //'category' => App\Http\Controllers\Dashboard\CategoryController::class,
    ]);
});

Route::get('/db', function () {

  
$post = Post::join('categories', 'categories.id', '=', 'posts.category_id')->select('posts.*', 'categories.title as category')->orderBy('posts.created_at', 'desc')->toSql();
 echo $post;
echo "<br>", "<br>";
$ver = Post::limit(3)->toSql();
 echo $ver;

$category_slug = "BELLO";

$posts2 = Post::join('categories', 'categories.id', '=', 'posts.category_id')
    ->select('posts.*', 'categories.title as category', 'categories.slug as c_slug')
    ->where('categories.slug', $category_slug)
->where('posted', "yes")
->where(function ($query) {
    $query->orWhere('type', 'post')
        ->orWhere('type', 'courses')
        ->orWhere('type', 'group');
})
    ->orderBy('posts.created_at', 'desc')
    ->toSql();

echo $posts2;

echo "<br><br>";

$users = Post::where('type', 'post')
 ->orWhere('type', 'book')
 ->orderBy('created_at', 'desc')
 ->limit(10)
 ->toSql();

 echo $users;
});

Route::get('/perfil', function () {
    $user = User::find(1);
    $profile = $user->profile;

    $profile = Profile::find(1);
    $user = $profile->user;
    dd($user->email);
});

Route::get('/relacion', function () {
    $category = Category::find(1);
    $posts = $category->posts;
    //dd($posts);
    foreach($posts as $post){
        echo $post->title. "<br>";
    }

    $post = Post::find(1);
    $category = $post->category;
    dd($category->title);
});


Route::get('/muchos', function () {
        $post = Post::find(1);
        $tags = $post->tags;
        foreach($tags as $tag){
        echo $tag->id . " ";
        echo $tag->name. "<br>";
    }

    $tag = Tag::find(1);
    $posts = $tag->posts;
        foreach($posts as $post){
        echo $post->id . " ";
        echo $post->title. "<br>";
    }

    $post = Post::find(4);
    $tag1 = Tag::find(1);
    $tag2 = Tag::find(1);
    $tag3 = Tag::find(1);
    //$tag2 = Tag::find(2);
    //$post->tags()->attach($tag);
    $tag->posts()->sync($post);

    //$post->tags()->sync([$tag1,$tag2,$tag3,]);
    $post->tags()->sync([1,2,3]);

});

Route::get('/curso',[CourseController::class, 'index']);