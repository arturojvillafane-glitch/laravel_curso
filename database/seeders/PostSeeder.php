<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
class PostSeeder extends Seeder
{
    public function run(): void
    {
        /*DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');*/
        for ($i = 0; $i < 30; $i++) {
            // $title = Str::random(20); // equivalente con el facade
            $title = str()->random(20);
            $c = Category::inRandomOrder()->first();
            Post::create(
                [
                    'title' => $title,
                    // 'slug' => Str::slug($title), // equivalente con el facade
                   'slug' => str($title)->slug(),
                'content' => "<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae</p>",
                'category_id' => $c->id,
                'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Vitae ",
                'posted' => "yes"
            ]);
        }
    }
}
