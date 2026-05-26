<?php
use App\Http\Controllers\Test\TuControlador;
use App\Http\Controllers\Dashboard\PostController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
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

