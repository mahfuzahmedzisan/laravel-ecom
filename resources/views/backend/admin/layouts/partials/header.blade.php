<header>
    <nav class="bg-gray-800">
        <div class="container mx-auto">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}"
                        class="text-white text-lg font-semibold">{{ config('app.name', 'Ecommerce') }}</a>
                </div>
                <div class="flex items-center">
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                            <a href="javascript:void(0)"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
