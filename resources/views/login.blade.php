<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="{{asset("/css/output.css")}}" />
    <link rel="shortcut icon" href="{{asset("logo_unifei.png")}}" type="image/png">
  </head>
  <body class="bg-unifei-50">
    <header
      class="p-6 flex bg-unifei-800 text-unifei-50 uppercase text-6xl font-bold"
    >
      <span class="mx-auto">Agendamento de Salas</span>
    </header>
    <article class="w-screen mt-28 flex items-center justify-center flex-col">
      <form
        class="bg-unifei-100 w-72 px-48 py-14 flex flex-col gap-5 items-center justify-center shadow"
        action="{{ route('user.auth')}}"
        method="POST"
      >
      @csrf
        <p class="uppercase text-unifei-800 text-2xl font-bold">Login</p>
        <input
          name="email"
          type="email"
          placeholder="Email institucional"
          value="{{old('email')}}"
          class="w-fit bg-unifei-50 border border-unifei-500 focus:border-unifei-800 focus:ring-2 focus:ring-unifei-500 focus:ring-opacity-50 rounded px-3 py-3 text-lg text-gray-800 placeholder-unifei-200 focus:outline-none transition duration-200 ease-in-out"
        />
        <input
          name="password"
          type="password"
          placeholder="Senha"
          class="w-fit bg-unifei-50 border border-unifei-500 focus:border-unifei-800 focus:ring-2 focus:ring-unifei-500 focus:ring-opacity-40 rounded px-3 py-3 text-lg text-gray-800 placeholder-unifei-200 focus:outline-none transition duration-200 ease-in-out"
        />
        <button
          type="submit"
          class="w-fit text-xl bg-unifei-500 hover:bg-unifei-800 px-6 py-2 rounded text-unifei-50 shadow transition duration-200 ease-in-out"
        >
          Login
        </button>
      </form>

      @include('includes.validation-form')
    </article>

  </body>
</html>
