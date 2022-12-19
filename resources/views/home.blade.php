@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('contenido')
   
@if ($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post )
        <div>
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user ]) }}">
                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                <hr>
                <p class="text-center font-bold" > {{ $post->user->username}} </p>
                <p class="text-center text-gray-500" > {{ $post->titulo }} </p>                
            </a>
            
        </div>
        @endforeach
    </div>

    <div class="my-10">
        {{ $posts->links() }}
    </div>

@else
    <p class="text-center"> No hay publicaciones
@endif


@endsection