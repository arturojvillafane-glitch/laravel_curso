<?php

namespace App\View\Components\Blog\Post;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public Post $post;
    public function __construct($post)
    {
        $this->post = $post;
    }
    public function render(): View|Closure|string
    {
        return view('components.blog.post.show');
    }
}

