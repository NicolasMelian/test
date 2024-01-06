<div class="max-w-7xl mx-auto navbar bg-base-100">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
        </div>
        <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
          @if(Route::has('login'))
          @auth
            <li class="justify-center mr-4"><a class="text-base" href="/profile">Mi Cuenta</a></li>
            @else
          <li class="justify-center mr-4"><a class="text-base" href="/login">Iniciar Sesión</a></li>
  
           @if(Route::has('register'))
          <li class="justify-center mr-4"><a class="text-base" href="/register">Registrarse</a></li>
          @endif
          @endauth
          @endif
          @guest
          <a class="btn text-base mr-4 premium" href="#precio">
             Premium
          </a>
          
          @endguest
          @auth
          @if (Auth::user()->subscribed())
          <li class="justify-center mr-4"><a class="text-base" href="/billing">
              Suscripción
          </a>
        </li>
          
          @else
        
          <a class="btn text-base mr-4 premium" href="#precio">
                   Premium
          </a>
        
          @endif
          <li class="justify-center mr-4">
          <form class="text-center items-center" method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="text-base" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                  Cerrar Sesión
          </a>
          </form>
          </li>
          @endauth
        </ul>
      </div>
      <a href="/"><img src="images/logo-imagenatexto.png" class="logo" style="width:180px" alt="log de Imagenatexto.com"/></a>
    </div>
  
  
    <div class="navbar-end hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
        @if(Route::has('login'))
        @auth
          <li class="mr-4 text-base"><a class="text-base" href="/profile">Mi Cuenta</a></li>
          @else
        <li class="mr-4 text-base"><a href="/login">Iniciar Sesión</a></li>
  
         @if(Route::has('register'))
        <li class="mr-4 text-base"><a href="/register">Registrarse</a></li>
        @endif
        @endauth
        @endif
        @auth
        @if (Auth::user()->subscribed())
        <li class="mr-4 text-base"><a class="text-base" href="/billing">
            Suscripción
        </a></li>
        
        @else
        
            <a class="btn text-base mr-4 premium" href="/billing">
               Premium
            </a>
      
        @endif
        <li class="mr-4 text-base">
        <form class="text-center items-center" method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                this.closest('form').submit();">
                Cerrar Sesión
        </a>
        </form>
        </li>
        @endauth
        @guest
        
            <a class="btn text-base mr-4 premium" href="#precio">
               Premium
          </a>
        
          @endguest
      </ul>
    </div> 
  </div>