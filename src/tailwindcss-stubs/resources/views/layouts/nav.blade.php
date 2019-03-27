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
                    <dropdown>
                        <div slot="link" class="block md:hidden">
                            <button class="burger" style="outline: none;">
                                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                            </button>
                        </div>
                        <button slot="link" class="hidden md:block btn is-primary is-small" style="outline: none;">{{ Auth::user()->name }}</button>

                        <div slot="dropdown-items" class="text-right pr-3 pl-10">
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </dropdown>
                @endguest
            </div>
        </div>
        <div class="flex item-end justify-center mb-2 mt-2 md:mt-3">
            @if (auth()->check())
                <dropdown>
                    <a slot="link" class="dropdown-toggle" href="#">Nav Item 1</a>
                    <div slot="dropdown-items">
                        <a href="{{ route('legouser.setlists') }}">Sub Nav 1</a>
                        <a href="{{ route('legouser.sets') }}">Sub Nav 2</a>
                        <a href="{{ route('legouser.parts') }}">Parts</a>
                        <a href="{{ route('legouser.loose_parts') }}">Loose Parts</a>
                        <a href="{{ route('legouser.lost_parts') }}">Lost Parts</a>
                    </div>
                </dropdown>
            @endif
        </div>
    </div>
</nav>