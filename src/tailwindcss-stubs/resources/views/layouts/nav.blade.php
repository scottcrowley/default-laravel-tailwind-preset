<nav class="bg-white h-auto shadow mb-8 px-6 lg:px-8">
    <div class="mx-auto h-full flex flex-col">
        <div class="flex items-center pt-3">
            <div class="text-center sm:text-left md:ml-0">
                <a href="{{ url('/') }}" class="text-lg font-hairline text-primary-darker no-underline hover:underline">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <div class="ml-auto">
                @guest
                    <a class="block sm:inline sm:pr-3 sm:mb-2 no-underline hover:underline text-primary-darker text-sm" href="{{ url('/login') }}">{{ __('Login') }}</a>
                    <a class="block sm:inline no-underline hover:underline text-primary-darker text-sm" href="{{ url('/register') }}">{{ __('Register') }}</a>
                @else
                    <dropdown align="right" width="200px">
                        <div slot="trigger">
                            <div class="block md:hidden">
                                <button class="burger" style="outline: none;">
                                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                                </button>
                            </div>
                            <div class="hidden md:block">
                                <button
                                    class="dropdown-toggle-link flex items-center text-secondary-darker no-underline text-lg focus:outline-none"
                                    v-pre
                                >
                                    {{ auth()->user()->name }}
                                </button>
                            </div>
                        </div>

                        <a href="#" class="dropdown-menu-link w-full text-left">Link 1</a>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="dropdown-menu-link w-full text-left">{{ __('Logout') }}</button>
                        </form>
                    </dropdown>
                @endguest
            </div>
        </div>
        <div class="flex item-end justify-center mb-2 mt-2 md:mt-3">
            @if (auth()->check())
                <dropdown align="right">
                    <div slot="trigger">
                        <a href="#" class="dropdown-toggle-link w-full text-left">Nav Item 1</a>
                    </div>

                    <a href="#" class="dropdown-menu-link w-full text-left">Sub Nav 1</a>
                    <a href="#" class="dropdown-menu-link w-full text-left">Sub Nav 2</a>
                </dropdown>
            @endif
        </div>
    </div>
</nav>