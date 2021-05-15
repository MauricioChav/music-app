<div class=" menu-bar">
  <div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3">
      
      @guest
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="text-logo" src="{{ asset('css/img/LogoText.png') }}">
      </a>

      @else
      <a href="/admin" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <img class="text-logo" src="{{ asset('css/img/LogoText.png') }}">
      </a>
      @endguest

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        @guest

        @else
        <li><a href="{{ route('home') }}" class="nav-link px-4 link-white"><ion-icon name="home-outline"></ion-icon> Inicio</a></li>
        <li><a href="{{ route('albums.index') }}" class="nav-link px-4 link-white"><ion-icon name="albums-outline"></ion-icon>Álbums</a></li>
        <li><a href="{{ route('songs.index') }}" class="nav-link px-4 link-white"><ion-icon name="musical-notes-outline"></ion-icon> Canciones</a></li>
        <li><a href="{{ route('albums.chooseCreate') }}" class="px-4 btn btn-primary"> Agregar Nueva canción <ion-icon name="add-circle-outline"></ion-icon></a></li>

        @endguest

      </ul>

      <div class="col-md-3 text-end">
        @guest
          <a href="{{ route('login') }}" class="btn btn-io-white me-2"><ion-icon name="log-in-outline"></ion-icon> Iniciar Sesión</a>
          <a href="{{ route('register') }}" class="btn btn-primary"><ion-icon name="add-circle-outline"></ion-icon> Registro</a>
        @else
        <div class="dropdown">
          <button class="btn btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <ion-icon name="person-circle-outline"></ion-icon> Bienvenido, {{ Auth::user()->name }}
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
            <li>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                          Cerrar Sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
          </ul>
        </div>
        @endguest
      </div>
    </header>
  </div>
</div>