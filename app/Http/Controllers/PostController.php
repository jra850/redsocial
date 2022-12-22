<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }

    public function index(User $user)
    {
        //$posts = Post::where('user_id', $user->id)->get();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(12);
        
        return view('dashboard', [
            'user' => $user, 
            'posts' => $posts
        ]);
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

         Post::create([
             'titulo' => $request->titulo,
             'descripcion' => $request->descripcion,
             'imagen' => $request->imagen,
             'user_id' => auth()->user()->id
         ]);

        // Otra forma
        // $post = new Post;
        // $post->titulo = $request->titulo;
        // $post->descripcion = $request->descripcion;
        // $post->imagen = $request->imagen;
        // $post->user_id = auth()->user()->id;
        // $post->save();

       // $request->user()->posts()->create([
       //     'titulo' => $request->titulo,
       //     'descripcion' => $request->descripcion,
       //     'imagen' => $request->imagen,
       //     'user_id' => auth()->user()->id
       // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }


    public function index2(Request $request)
        {
            //$usuarios = User::all();            

            $texto=trim($request->get('buscar'));
            /*$usuarios = DB::table('users')
                ->select('username','name')
                ->where('username','LIKE','%'.$texto.'%')
                ->orWhere('name','LIKE','%'.$texto.'%')
                ->orderBy('username')
                ->paginate(5);

            return view('buscador.buscador',compact('usuarios')); */

            $usuarios = DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.user_id')
                ->join('comentarios', 'posts.id', '=', 'comentarios.post_id')
                /*->select('users.username', 'posts.titulo', )*/
                ->where('users.username', 'LIKE', '%' . $texto . '%')
                ->orWhere('users.name', 'LIKE', '%' . $texto . '%')
                ->orWhere('posts.titulo','LIKE','%'.$texto.'%')
                ->orWhere('comentarios.comentario','LIKE','%'.$texto.'%');

            $usuarios = $usuarios->get();

                return view('buscador.buscador',compact('usuarios'));
            }

}
