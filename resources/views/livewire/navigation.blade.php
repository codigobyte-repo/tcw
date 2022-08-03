<header class="bg-gradient-to-r from-gray-800 to-purple-800 sticky top-0" style="z-index: 900" x-data="{ open:false }">

    {{-- **********************************--}}
    {{-- NAVEGACION DE LA PAGINA PRINCIPAL --}}
    {{-- **********************************--}}    

    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 lg:p-4">
        
        {{-- <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto"> --}}
        <div class="flex justify-between items-center">
            
            <div class="flex text-sm lg:flex-grow">
                
                {{-- LOGOTIPO --}}
                <a href="/" class="flex-shrink-0 lg:mr-6 my-3 lg:my-0 flex items-center">
                    <img class="block lg:hidden h-12 w-auto" src="{{ asset('img/logoB.png')}}" alt="Workflow">
                    <img class="hidden lg:block h-12 w-auto" src="{{ asset('img/logoB.png')}}" alt="Workflow">
                </a>
                {{-- FIN LOGOTIPO --}}

                {{-- MENU HAMBURGUERS CATEGORIAS --}}
                <a :class="{'text-purple-500 bg-white' : open }"
                    x-on:click="open = !open"
                    class="inline-flex items-center justify-center px-3 mx-1 rounded-none text-white hover:text-purple-600 hover:bg-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <svg class="block h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg class="hidden h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="text-base cursor-pointer hidden lg:block">Categorías</span>
                </a>
                {{-- FIN MENU HAMBURGUERS CATEGORIAS --}}

                <div class="hidden lg:block">
                    @if (auth()->user())
                        <a href="{{route('publisher.posts.create')}}" class="inline-flex items-center justify-center mt-1 p-2 font-bold text-white hover:text-white bg-purple-600 hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white rounded-full text-base">Crear publicación</a>
                    @else
                        <a href="{{route('register')}}" class="inline-flex items-center justify-center mt-1 p-2 font-bold text-white hover:text-white bg-purple-600 hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white rounded-full text-base">Crear publicación</a>
                    @endif
                </div>
                
                <div class="inline-flex items-center justify-center mt-1 ml-2 p-2 font-bold text-white hover:text-white md:bg-yellow-600 hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white rounded-full text-base">
                    <a href="{{ route('sellers.index') }}">Sé vendedor</a>
                </div>

            </div>

            {{-- CART --}}
            @livewire('dropdown-cart')
            {{-- FIN CART --}}

            {{-- CHAT --}}
            @can('publisher.index')
                
                @livewire('notifications')
                
            @endcan
            {{-- FIN CHAT --}}
        
            <div class="hidden md:block">
                @auth
                    <div class="absolute inset-y-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                        <!-- Profile dropdown -->
                        <div class="ml-3 relative" x-data="{ open:false }">
                            <div>
                                <button x-on:click="open = !open" type="button" class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                    <img class="h-8 w-8 rounded-full" src="{{ auth()->user()->profile_photo_url }}" alt="Imagen de perfil">
                                    <p class="ml-2 mt-1.5 text-white">Hola, {{ Auth::user()->name }}</p>
                                </button>
                            </div>
                            
                            <div x-show="open" :class="{'block': open, 'hidden': !open}" x-on:click.away="open = !open" class="hidden right-0 absolute mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                
                                {{-- TEXTO INDICATIVO --}}
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    PERFIL DE CUENTA
                                </div>
                                <hr>
                                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Perfil</a>


                                {{-- TEXTO INDICATIVO --}}
                                @can('publisher.index')
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    MIS VENTAS
                                </div>
                                <hr>
                                    <a href="{{ route('publisher.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Mis publicaciones</a>
                                @endcan

                                @can('publisher.index')
                                    <a href="{{ route('publisher.posts.create') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Crear publicación</a>
                                @endcan

                                @can('publisher.index')
                                    <a href="{{ route('publisher.orders.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Ventas</a>
                                @endcan


                                {{-- TEXTO INDICATIVO --}}
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    MIS COMPRAS
                                </div>
                                <hr>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Mis compras</a>
                                
                                {{-- PERMISO ADMIN.HOME INFO: https://youtu.be/Ox3WRl6sJrw?list=PLZ2ovOgdI-kX3XFj77zlvSQYhJyJSYQWr&t=134 --}}
                                @can('admin.home')

                                    {{-- TEXTO INDICATIVO --}}
                                    <hr>
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        CUENTA ADMINISTRATIVA
                                    </div>
                                    <hr>
                                    
                                    <a target="to_blank" href="{{ route('admin.home') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                        <div class="flex items-center">
                                            <img class="mr-1" width="20px" src="{{ asset('img/icons/admin.svg') }}" alt="Admin">
                                            <span class="font-bold text-blue-800">ADMINISTRADOR</span>
                                        </div>
                                    </a>

                                    <a href="{{ route('publisher.categories.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                        <div class="flex items-center">
                                            <span class="text-blue-800 font-bold">Categorías y subcategorías</span>
                                        </div>
                                    </a>

                                    <a href="{{ route('publisher.brands.index') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">
                                        <div class="flex items-center">
                                            <span class="text-blue-800 font-bold">Marcas</span>
                                        </div>
                                    </a>

                                @endcan
                                
                                <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        <div class="flex items-center">
                                            <img class="mr-1" width="20px" src="{{ asset('img/icons/logout.svg') }}" alt="Admin">
                                            <span class="font-bold text-blue-800">Cerrar sesión</span>
                                        </div>
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex justify-end">
                        <a href="{{route('login')}}" class="text-white hover:bg-purple-600 hover:text-white px-4 py-2 text-sm font-medium border-2 border-purple-500 rounded-full mr-2 transition">
                            <i class="fas fa-sign-in-alt"></i>                            
                            Acceder
                        </a>
                        <a href="{{route('register')}}" class="text-white hover:bg-purple-600 hover:text-white px-4 py-2 text-sm font-medium border-2 border-blue-400 rounded-full transition">
                            <i class="fas fa-fingerprint"></i>                            
                            Registrarse
                        </a>
                    </div>
                @endauth
            </div>

        </div>

    </div>

    {{-- MENU CATEGORÍAS EL navigation-menu es para calcular desde el style lo que va a ocupar segun la pantalla el menu  --}}
    {{-- ESTA OPCION ESTÄ EN resources > css > nav.css --}}
    <nav id="navigation-menu"
        x-show="open"
        class="bg-trueGray-700 bg-opacity-25 w-full absolute hidden"
        :class="{'block': open, 'hidden': !open}" >

        {{-- Menu computadora --}}
        <div class="container h-full hidden md:block">
            <div
                x-on:click.away="open = false" 
                class="grid grid-cols-4 h-full relative">

                {{-- SECCION CATEGORÍAS --}}
                <ul class="bg-white">

                    @foreach ($categories as $category)
                        <li class="navigation-link text-trueGray-500 hover:bg-purple-500 hover:text-white">
                            <a href="{{ route('posts.category', $category) }}" class="py-4 px-4 text-sm flex items-center">

                                <span class="flex justify-center w-9">
                                    {!! $category->icon !!}
                                </span>

                                {{ $category->name }}
                            </a>

                            <div class="navigation-submenu bg-gray-100 absolute w-3/4 h-full top-0 right-0 hidden">
                                {{-- Usamos componente blade, directorio: components > navigation-subcategories.blade.php --}}
                                <x-navigation-subcategories :category="$category" />
                            </div>

                        </li>
                    @endforeach

                </ul>
                {{-- FIN SECCION CATEGORÍAS --}}

                {{-- SECCION SUBCATEGORÍAS --}}
                <div class="col-span-3 bg-gray-100">
                   {{-- Usamos componente blade, directorio: components > navigation-subcategories.blade.php --}}
                   <x-navigation-subcategories :category="$categories->first()" />
                </div>
                {{-- FIN SECCION SUBCATEGORÍAS --}}

            </div>
        </div>
        {{-- Fin Menu computadora --}}

        {{-- Menu Mobile --}}
        <div class="bg-white h-full overflow-y-auto">
            <div>
                @livewire('search')
            </div>
            <ul>
                @foreach ($categories as $category)
                    <li class="text-trueGray-500 hover:bg-purple-500 hover:text-white">
                        <a href="{{ route('posts.category', $category) }}" class="py-4 px-4 text-sm flex items-center">

                            <span class="flex justify-center w-9">
                                {!! $category->icon !!}
                            </span>

                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <p class="text-trueGray-500 px-6 my-2">ACCEDER</p>
            @auth
                <a href="{{ route('profile.show') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="far fa-address-card"></i>
                    </span>
                    Perfil
                </a>

                @can('publisher.index')
                    <a href="{{ route('publisher.index') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white">
                        <span class="flex justify-center w-9">
                            <i class="far fa-address-card"></i>
                        </span>
                        Mis publicaciones
                    </a>
                @endcan

                <a href="{{ route('orders.index') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white">
                    <span class="flex justify-center w-9">
                        <i class="far fa-address-card"></i>
                    </span>
                    Mis pedidos
                </a>

                @can('admin.home')
                    <a href="{{ route('admin.home') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white">
                        <span class="flex justify-center w-9">
                            <i class="fab fa-adn"></i>
                        </span>
                        Administrador
                    </a>
                @endcan

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <a href="{{ route('logout') }}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white" role="menuitem" tabindex="-1" id="user-menu-item-2" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            <span class="flex justify-center w-9">
                                <i class="fas fa-sign-out-alt"></i>
                            </span>
                            Cerrar sesión
                        </a>
                </form>
            
            @else
                <div>
                    <a href="{{route('login')}}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white">
                        <span class="flex justify-center w-9">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        Acceder
                    </a>
                    <a href="{{route('register')}}" class="py-2 px-4 text-sm flex items-center text-trueGray-500 hover:bg-purple-500 hover:text-white">
                        <span class="flex justify-center w-9">
                            <i class="fas fa-fingerprint"></i>
                        </span>
                        Registrarse
                    </a>
                </div>

            @endauth
        </div>
        {{-- Menu Mobile --}}


    </nav>
</header>

<header class="hidden xl:block text-gray-600 body-font bg-purple-500">
    <div class="container mx-auto flex flex-wrap p-2 flex-col md:flex-row items-center">

      <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center gap-6">
          @foreach ($categories as $category)  
            <a href="{{ route('posts.category', $category) }}" class="mr-5 text-lg text-white font-medium hover:text-gray-200 cursor-pointer">{{$category->name}}</a>
          @endforeach
      </nav>

    </div>
</header>

