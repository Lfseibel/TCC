<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - UNIFEI</title>

    <link rel="shortcut icon" href="{{asset("logo_unifei.png")}}" type="image/png">

    <link rel="stylesheet" href="{{asset("/css/output.css")}}">
</head>
<body class="bg-gray-50">
  <header class="bg-unifei-800 text-unifei-50 w-screen">
    <nav>
      <ul class="flex justify-around py-8 text-2xl uppercase items-center"> 
        <li><img src="{{asset("logo_unifei.png")}}" class="relative h-16"></li>
        <li><button class="teste uppercase">Bloco
          <div
                    class="teste-menu absolute hidden bg-white border border-gray-200 py-1 shadow-md rounded w-48 -ml-12"
                    
                >
                    <a
                        href="{{ route('block.create') }}"
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Criar Bloco</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 2</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 3</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 4</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 5</a>
                </div></button>
        </li>
        <li><button class="teste uppercase">Calendario
          <div
                    class="teste-menu absolute hidden bg-white border border-gray-200 py-1 shadow-md rounded w-48 -ml-12"
                    
                >
                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 1</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 2</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 3</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 4</a>

                    <a
                        href=""
                        class="block text-sm text-gray-500 px-3 py-1 bg-white hover:bg-gray-100"
                    >Link 5</a>
                </div></button></li>
        <li>Usuario</li>
        <li>Unidade</li>
        <li>Horario</li>
        <li>Sala</li>
        <li>Reserva</li>
      </ul>
    </nav>
  </header>

  @yield('content')

</body>
</html>