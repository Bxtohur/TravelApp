<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 sticky top-0 z-50 shadow-md transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20"> <div class="flex">
                <div class="shrink-0 flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="flex items-center group">
                        <div class="h-10 w-auto flex items-center justify-center transition-transform duration-300 group-hover:scale-105">
                            <img src="{{ asset('images/Main_logo.png') }}" 
                                alt="Logo PT. Brookal Sukses Abadi" 
                                class="h-full w-auto object-contain">
                        </div>

                        <div class="mx-3 h-6 w-[1px] bg-gray-200"></div>

                        <div class="flex flex-col">
                            <span class="text-[10px] text-gray-400 font-medium tracking-wider uppercase leading-tight">
                                Explore<br>Indonesia
                            </span>
                        </div>
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" 
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out h-full
                       {{ request()->routeIs('dashboard') ? 'border-primary-600 text-gray-900 font-bold' : 'border-transparent text-gray-500 hover:text-primary-600 hover:border-gray-300' }}">
                        {{ __('Dashboard') }}
                    </a>

                    @if(Auth::user()->role === 'admin')
                        {{-- Menu Admin --}}
                        <a href="{{ route('admin.packages.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out h-full
                           {{ request()->routeIs('admin.packages.*') ? 'border-primary-600 text-gray-900 font-bold' : 'border-transparent text-gray-500 hover:text-primary-600 hover:border-gray-300' }}">
                            {{ __('Kelola Paket') }}
                        </a>
                        <a href="{{ route('admin.transactions.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out h-full
                           {{ request()->routeIs('admin.transactions.*') ? 'border-primary-600 text-gray-900 font-bold' : 'border-transparent text-gray-500 hover:text-primary-600 hover:border-gray-300' }}">
                            {{ __('Validasi Pesanan') }}
                        </a>
                    @elseif(Auth::user()->role === 'owner')
                        <a href="{{ route('owner.reports.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out h-full
                           {{ request()->routeIs('owner.reports.*') ? 'border-primary-600 text-gray-900 font-bold' : 'border-transparent text-gray-500 hover:text-primary-600 hover:border-gray-300' }}">
                            {{ __('Laporan Transaksi') }}
                        </a>
                    @else
                        {{-- Menu Customer --}}
                        <a href="{{ route('customer.packages.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out h-full
                           {{ request()->routeIs('customer.packages.*') ? 'border-primary-600 text-gray-900 font-bold' : 'border-transparent text-gray-500 hover:text-primary-600 hover:border-gray-300' }}">
                            {{ __('Daftar Paket') }}
                        </a>
                        <a href="{{ route('customer.transactions.index') }}" 
                           class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out h-full
                           {{ request()->routeIs('customer.transactions.*') ? 'border-primary-600 text-gray-900 font-bold' : 'border-transparent text-gray-500 hover:text-primary-600 hover:border-gray-300' }}">
                            {{ __('Riwayat Pesanan') }}
                        </a>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-gray-50 hover:bg-primary-50 hover:text-primary-700 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center text-xs font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link :href="route('profile.edit')" class="hover:text-primary-600 hover:bg-primary-50">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    class="text-red-600 hover:bg-red-50"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

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

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white border-t border-gray-100">
        <div class="pt-2 pb-3 space-y-1 px-2">
            
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-lg">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.packages.index')" :active="request()->routeIs('admin.packages.*')" class="rounded-lg">
                    {{ __('Kelola Paket') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.transactions.index')" :active="request()->routeIs('admin.transactions.*')" class="rounded-lg">
                    {{ __('Validasi Pesanan') }}
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('customer.packages.index')" :active="request()->routeIs('customer.packages.*')" class="rounded-lg">
                    {{ __('Daftar Paket') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('customer.transactions.index')" :active="request()->routeIs('customer.transactions.*')" class="rounded-lg">
                    {{ __('Riwayat Pesanan') }}
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200 bg-gray-50">
            <div class="px-4 flex items-center gap-3">
                 <div class="w-10 h-10 rounded-full bg-primary-200 text-primary-700 flex items-center justify-center text-lg font-bold">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-lg hover:bg-white">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            class="text-red-600 rounded-lg hover:bg-red-50"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
