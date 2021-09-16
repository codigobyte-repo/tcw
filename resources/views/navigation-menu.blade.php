<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    {{-- **********************************--}}
    {{-------- NAVEGACION DEL PANEL ---------}}
    {{-- **********************************--}}

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('publisher.index') }}">
                        {{-- <x-jet-application-mark class="block h-9 w-auto" /> --}}
                        <img class="h-12 w-auto" src="{{ asset('img/logo.png')}}" alt="Logo">
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ url('/') }}">
                        Sitio principal
                    </x-jet-nav-link>
                    
                    @can('publisher.index')
                        <x-jet-nav-link href="{{ route('publisher.index') }}" :active="request()->routeIs('publisher.index')">
                            Mis publicaciones
                        </x-jet-nav-link>
                    @endcan

                    <x-jet-nav-link href="{{ route('publisher.posts.create') }}" :active="request()->routeIs('publisher.posts.create')">
                        Crear publicación
                    </x-jet-nav-link>

                    @can('publisher.orders.index')
                        <x-jet-nav-link href="{{ route('publisher.orders.index') }}" :active="request()->routeIs('publisher.orders.*')">
                            Mis ventas
                        </x-jet-nav-link>
                    @endcan
                        
                    
                    @can('admin.home')
                        <x-jet-nav-link target="to_blank" href="{{ route('admin.home') }}" :active="request()->routeIs('admin.home.*')">
                            <div class="flex items-center">
                                <img class="mr-1" width="20px" src="{{ asset('img/icons/admin.svg') }}" alt="Admin">
                                <span class="font-bold text-blue-800">ADMINISTRADOR</span>
                            </div>
                        </x-jet-nav-link>
                    @endcan

                        
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            
                            {{-- TEXTO INDICATIVO --}}
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                PERFIL DE CUENTA
                            </div>
                            <hr>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                Mi Perfil
                            </x-jet-dropdown-link>

                            {{-- TEXTO INDICATIVO --}}
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                MIS VENTAS
                            </div>
                            <hr>

                            <x-jet-dropdown-link href="{{ route('publisher.index') }}">
                                Mis publicaciones
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('publisher.posts.create') }}">
                                Crear publicación
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('publisher.orders.index') }}">
                                Ventas
                            </x-jet-dropdown-link>

                            {{-- TEXTO INDICATIVO --}}
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                MIS COMPRAS
                            </div>
                            <hr>
                            <x-jet-dropdown-link href="{{ route('orders.index') }}">
                                Mis compras
                            </x-jet-dropdown-link>
                            

                            @can('admin.home')

                                {{-- TEXTO INDICATIVO --}}
                                <hr>
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    CUENTA ADMINISTRATIVA
                                </div>
                                <hr>

                                    <x-jet-dropdown-link target="to_blank" href="{{ route('admin.home') }}">
                                        <div class="flex items-center">
                                        <img class="mr-1" width="20px" src="{{ asset('img/icons/admin.svg') }}" alt="Admin">
                                        <span class="font-bold text-blue-800">ADMINISTRADOR</span>
                                        </div>
                                    </x-jet-dropdown-link>
                                
                                    <x-jet-dropdown-link href="{{ route('publisher.categories.index') }}">
                                        <span class="text-blue-800 font-bold">Categorías y subcategorías</span>
                                    </x-jet-dropdown-link>
                                
                                    <x-jet-dropdown-link href="{{ route('publisher.brands.index') }}">
                                        <span class="text-blue-800 font-bold">Marcas</span>
                                    </x-jet-dropdown-link>

                            @endcan
                            

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    
                                    <div class="flex items-center">
                                        <img class="mr-1" width="20px" src="{{ asset('img/icons/logout.svg') }}" alt="Admin">
                                        <span class="font-bold text-blue-800">Cerrar sesión</span>
                                    </div>
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-200 pb-20">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('publisher.index') }}" :active="request()->routeIs('publisher.index')">
                Mis publicaciones
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                Perfil
            </x-jet-responsive-nav-link>

            <x-jet-responsive-nav-link href="{{ route('publisher.posts.create') }}" :active="request()->routeIs('publisher.posts.create')">
                Crear Publicación
            </x-jet-responsive-nav-link>

            @can('publisher.orders.index')
                <x-jet-responsive-nav-link href="{{ route('publisher.orders.index') }}" :active="request()->routeIs('publisher.posts.create')">
                    Ordenes
                </x-jet-responsive-nav-link>
            @endcan
            
            @can('publisher.categories.index')
                <x-jet-responsive-nav-link href="{{ route('publisher.categories.index') }}" :active="request()->routeIs('publisher.categories.*')">
                    Categorías y Subcategorías
                </x-jet-responsive-nav-link>
            @endcan

            @can('publisher.brands.index')    
                <x-jet-responsive-nav-link href="{{ route('publisher.brands.index') }}" :active="request()->routeIs('publisher.brands.*')">
                    Marcas
                </x-jet-responsive-nav-link>
            @endcan
            
            @can('admin.home')
                <x-jet-responsive-nav-link href="{{ route('admin.home') }}" :active="request()->routeIs('admin.home')">
                    Administrador
                </x-jet-responsive-nav-link>    
            @endcan
            
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="flex-shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    Perfil
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        Cerrar sesión
                    </x-jet-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
</nav>
