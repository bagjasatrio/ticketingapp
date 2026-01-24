<div class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <a href="{{ route('home') }}" class="flex-1">
            <img src="{{ asset('assets/images/logo_bengkod.svg') }}" alt="Logo" class="h-10 w-auto" />
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <input class="input w-72" placeholder="Cari Event..." />
    </div>
    <div class="navbar-end gap-2">
        <!-- check user session -->
        @guest
            <a href="{{ route('login') }}" class="btn bg-blue-900 text-white">Login</a>
            <a href="{{ route('register') }}" class="btn text-blue-900">Register</a>
        @endguest

        @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost rounded-btn">
                    Halo, {{ Auth::user()->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>

                </div>
                <ul tabindex="0" class="mt-3 p-2 shadow menu menu-compact dropdown-content bg-base-100 rounded-box w-52">
	<li>
		<a href="{{ route('orders.index') }}" class="justify-between">
			Riwayat Pembelian
		</a>
	</li>
	<li>
		<a href="{{ route('logout') }}"
			onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				Logout
		</a>
		<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
			@csrf
		</form>
	</li>
</ul>
        @endauth



    </div>
</div>