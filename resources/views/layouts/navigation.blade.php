<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex flex-row items-center py-2">
                    <a href="/" class="flex items-center me-8 p-2">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        <div class="mt-1 ml-3 font-bold">Vault</div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Home') }}
                    </x-nav-link>
                    @if(Auth::check())
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    @endif
                    <x-nav-link :href="route('public.stores')" :active="request()->routeIs('public.stores')">
                        {{ __('Stores') }}
                    </x-nav-link>
                    @if (Auth::check() && Auth::user()->role === 'client')
                    <x-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                        {{ __('Cart') }}
                    </x-nav-link>
                    <x-nav-link :href="route('orders.clientOrders')" :active="request()->routeIs('orders.clientOrders')">
                        {{ __('Orders') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Search Bar -->
            <form action="{{ route('search') }}" method="GET" class="w-full hidden sm:flex items-center justify-center max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative">
                    <div class="relative w-full">
                        <select
                            name="searchType"
                            class="absolute left-0 top-0 h-full px-6 text-sm text-gray-700 bg-gray-100 border-r border-gray-300 rounded-l-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 z-10">
                            <option value="stores">Stores</option>
                            <option value="products">Products</option>
                        </select>
                        <input
                            type="text"
                            id="searchName"
                            name="searchName"
                            placeholder="Search here..."
                            class="w-full lg:px-40 pl-16 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" />
                        <button
                            type="submit"
                            class="absolute right-0 top-0 h-full px-3 sm:px-5 rounded-r-full bg-blue-500 hover:bg-blue-600 text-white transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 sm:w-4 sm:h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @if(Auth::check())
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @elseif (Route::has('login') && !Auth::check())
                <div class="top-right links text-nowrap space-x-2">
                    <x-nav-link href="{{ url('/login') }}">Login</x-nav-link>
                    <x-nav-link href="{{ url('/register') }}">Register</x-nav-link>
                </div>
                @endif

            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @if(Auth::check())

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('public.stores')" :active="request()->routeIs('dashboard')">
                {{ __('Stores') }}
            </x-responsive-nav-link>
            @if (Auth::check() && Auth::user()->role === 'client')
            <x-responsive-nav-link :href="route('cart')" :active="request()->routeIs('cart')">
                {{ __('Cart') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('orders.clientOrders')" :active="request()->routeIs('orders.clientOrders')">
                {{ __('Orders') }}
            </x-responsive-nav-link>
            @endif
            @if (Route::has('login') && !Auth::check())
            <div class="top-right links">
                <x-responsive-nav-link href="{{ url('/login') }}">Login</x-responsive-nav-link>
                <x-responsive-nav-link href="{{ url('/register') }}">Register</x-responsive-nav-link>
            </div>
            @endif
            <form action="{{ route('search') }}" method="GET" class="w-full flex items-center justify-center max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative">
                    <div class="relative w-full">
                        <select
                            name="searchType"
                            class="absolute left-0 top-0 h-full px-6 text-sm text-gray-700 bg-gray-100 border-r border-gray-300 rounded-l-full cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 z-10">
                            <option value="stores">Stores</option>
                            <option value="products">Products</option>
                        </select>
                        <input
                            type="text"
                            id="searchName"
                            name="searchName"
                            placeholder="Search here..."
                            class="w-full px-40 py-2 rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm" />
                        <button
                            type="submit"
                            class="absolute right-0 top-0 h-full px-3 sm:px-5 rounded-r-full bg-blue-500 hover:bg-blue-600 text-white transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="w-4 h-4 sm:w-4 sm:h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Responsive Settings Options -->
        @if (Auth::check())
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endif
    </div>
</nav>