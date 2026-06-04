@extends('blog.layout')
@section('content')
    <x-blog.post.index :posts='$posts'>
        Articulos:
        @slot('footer')
            Este es el Footer
        @endslot
        @slot('extra')
            Este es el Extra
        @endslot
    </x-blog.post.index>
@endsection

