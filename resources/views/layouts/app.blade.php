<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        
        <title>TIDME - @yield('titulo')</title>
        @vite('resources/css/app.css')         
        @vite('resources/js/app.js')
    </head>

    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between item-center">
                <a href="{{ route('home') }}" class="text text-4xl font-extrabold text-teal-500">
                    TIDME
                </a>

            <div>

                <nav class="flex gap-2 items-center" >

                    <a href="/buscador/search" class="flex items-center gap-2 bg-white border p-2 text-teal-500 rounded text-sm uppercase 
                    font-bold cursor-pointer" href="{{route('posts.create')}}">
                        
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                          
                          
                        Buscar
                    </a>  
                </nav>



            </div>

                @auth
                 

                <nav class="flex gap-2 items-center">

                    <a class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase 
                    font-bold cursor-pointer" href="{{route('posts.create')}}">
                        
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          
                          
                        Publicar
                    </a>



                    <a class="font-bold text-gray-600 text-sm" 
                        href="{{route('posts.index', auth()->user()->username)}}"> 
                        Hola: 
                        <span class="font-normal"> 
                            {{auth()->user()->username}}   
                        </span>
                    </a>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        <button type="submit" class="font-bold uppercase text-gray-600 text-sm"> 
                            Logout
                        </button>
                    </form>
                </nav>
                @endauth

                @guest
                    <nav class="flex gap-2 items-center">
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}"> Login </a>
                        <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('register') }}"> Register</a>
                    </nav>
                @endguest

                
            </div>       

        </header>


        <main class="container mx-auto mt-10">
            <h2 class="font-black text-center text-3xl mb-10 text-teal-500">
                @yield('titulo')
            </h2>

            @yield('contenido')

        </main>

        <hr class="text-teal-500 ">
        <footer class="mt-10 text-center p-5 text-teal-500 font-bold uppercase">
            

                    TIDME - Todos los derechos reservados           
                    {{now()->year}}

            </footer>


    </body>
</html>
