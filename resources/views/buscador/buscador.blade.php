@extends('layouts.app')

@section('titulo')
    
@endsection


@section('contenido') 

    <div class="container text-center uppercase">
        <div>
            <form action="{{ route('buscador') }}" method="get">
                <div class="grid grid-cols-3 gap-4">
                    <div class="mb-5">
                        <input
                        id="titulo"
                        name="buscar"
                        type="text"
                        placeholder="Introduce usuario o nombre"
                        class="border p-3 w-full rounded-lg"
                        value=""
                        />        
                    </div>   
                    <div class="col-auto">
                        <input
                        type="submit"
                        value="Buscar"
                        class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3
                         text-white rounded-lg"
                        />
                    </div>
                </div>
            </form>  
        </div>    
    </div>

   

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
              <table class="min-w-full">
                <thead class="border-b">
                  <tr>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      Usuario
                    </th>
                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                      Título
                    </th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($usuarios as $usuario)
                  <tr class="bg-white border-b"  style="cursor: pointer">
                   
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap" onclick="window.location='/{{$usuario->username}}';">
                        {{$usuario->username}}
                    </td>
                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap" onclick="window.location='/{{$usuario->username}}/posts/{{$usuario->post_id}}';">
                        {{$usuario->titulo}}
                    </td>

                  </tr>
                   
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


@endsection



