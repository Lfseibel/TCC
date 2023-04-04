<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - UNIFEI</title>

    <link rel="shortcut icon" href="{{asset("logo_unifei.png")}}" type="image/png">
    {{-- <link rel="stylesheet" href="{{asset("./css/output.css")}}"> --}}
    <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
            colors: {
                unifei: {
                    50: "#e6ebf1",
                    100: "#ccd8e2",
                    200: "#33618d",
                    500: "#003a70",
                    600: "#003465",
                    800: "#001122",
                },
            },
        },
    },
    }
  </script>
</head>
<body class="bg-gray-50">
  <header class="bg-unifei-800 text-unifei-50 w-screen">
    <nav>
      <ul class="flex justify-around py-8 text-2xl uppercase items-center"> 
        <li><a href="{{route('index')}}"><img src="{{asset("logo_unifei.png")}}" class="relative h-16"></a></li>
        @if (auth()->user()->type === 'admin')
          <li><a href="{{route('block.index')}}">Blocos</a></li>
          <li><a href="{{route('calendar.index')}}">Calendario</a></li>
          <li><a href="{{route('user.index')}}">Usuarios</a></li>
          <li><a href="{{route('unity.index')}}">Unidades</a></li>
          <li><a href="{{route('schedule.index')}}">Horarios</a></li>
          <li><a href="{{route('room.index')}}">Salas</a></li>
          <li><a href="{{route('reservation.index')}}">Reservas</a></li>
        @elseif (auth()->user()->type === 'professor')
          <li><a href="{{route('reservation.index')}}">Reservas</a></li>
        @endif
        <li><a href="{{ route('user.logout')}}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="50px" height="50px">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
        </svg>
        </a>
        </li>
      </ul>
    </nav>
  </header>

  @yield('content')
  
</body>
</html>