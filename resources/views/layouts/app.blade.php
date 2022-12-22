<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @stack('styles')
        
        <title>TIDME - @yield('titulo')</title>
        @vite('resources/css/app.css')         
        @vite('resources/js/app.js')
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script>
            
function GetCookie(name) {
var arg=name+"=";
var alen=arg.length;
var clen=document.cookie.length;
var i=0;

while (i<clen) {
    var j=i+alen;

    if (document.cookie.substring(i,j)==arg)
        return "1";
    i=document.cookie.indexOf(" ",i)+1;
    if (i==0)
        break;
}

return null;
}

function aceptar_cookies(){
var expire=new Date();
expire=new Date(expire.getTime()+7776000000);
document.cookie="cookies_surestao=aceptada; expires="+expire;

var visit=GetCookie("cookies_surestao");

if (visit==1){
    popbox3();
}
}

$(function() {
var visit=GetCookie("cookies_surestao");
if (visit==1){ popbox3(); }
});

function popbox3() {
$('#overbox3').toggle();
}
            </script>
    </head>

    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class="container mx-auto flex justify-between item-center">                
                <a href="{{ route('home') }}" class="text text-4xl font-extrabold text-teal-500">                     
                    TIDME
                </a>

            <div>

                <nav class="flex gap-2 items-center" >

                    <a href="/buscador/search" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase 
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
                        <span class="font-extrabold text-teal-500"> 
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

           <!--<div > 
            <nav class="flex gap-2 items-center">
            <a href="https://www.instagram.com/xcooters/">
               <img src="img/instagram.png" width="40" height="40" >
            </a>
            <a href="https://www.xcooters.com/">
               <img src="img/xcooters.png" width="40" height="40" class="rounded-full">                            
            </a>   
            </nav> 
                <a >
                    TIDME - Designed & Developed by XCOOTERS {{now()->year}}
                </a>            
                
           </div> -->

           <a >
            TIDME - Designed & Developed by XCOOTERS {{now()->year}}
        </a>   



            </footer>


       
            <div id="overbox3">
                <div id="infobox3">
                    <p>Esta web utiliza cookies para obtener datos estadísticos de la navegación de sus usuarios. Si continúas navegando consideramos que aceptas su uso.
                    <a href="politica-privacidad.php">Más información</a>
                    <a onclick="aceptar_cookies();" style="cursor:pointer;">X Cerrar</a></p>
                </div>
            </div>
    </body>

    
</html>
