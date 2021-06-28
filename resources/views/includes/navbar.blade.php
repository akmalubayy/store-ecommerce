<nav
      class="
        navbar navbar-expand-lg navbar-light navbar-store
        fixed-top
        navbar-fixed-top
      "
      data-aos="fade-down"
    >
      <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
          <img src="{{ url('./images/logo.svg') }}" alt="web-logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('categories') }}" class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Rewards</a>
            </li>
            @guest
            <li class="nav-item">
              <a href="{{ route('register') }}" class="nav-link">Sign up</a>
            </li>
            <li class="nav-item">
              <a
                href="{{ route('login') }}"
                class="btn btn-success nav-link px-4 text-white"
                >Sign In</a
              >
            </li>
            @endguest
          </ul>
          @auth
        <!-- Desktop Menu -->
            <ul class="navbar-nav d-none d-lg-flex">
                <li class="nav-item dropdown profile-image">
                    <a
                        href="#"
                        class="nav-link"
                        id="navbar-dropdown"
                        role="button"
                        data-toggle="dropdown"
                    >
                        <img
                            src="@if (Auth::user()->photo_url != NULL)
                                {{ Storage::url(Auth::user()->photo_url) }}
                            @else
                                https://ui-avatars.com/api/?name={{Auth::user()->name}}
                            @endif"
                            class="rounded-circle mr-2 profile-picture"
                            alt="images-profile"
                        />
                            Hi, {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu">
                        @if (Auth::user()->roles == 'ADMIN')
                        <a href="{{ route('admin-dashboard') }}" class="dropdown-item">
                            Admin Dashboard
                        </a>
                        <a href="{{ route('dashboard') }}" class="dropdown-item">
                           Store Dashboard
                        </a>
                        @else
                            <a href="{{ route('dashboard') }}" class="dropdown-item">
                                Dashboard
                            </a>
                        @endif
                        @if (Auth::user()->roles == 'USER')
                        <a
                            href="{{ route('dashboard-account-settings') }}"
                            class="dropdown-item"
                            >Settings</a
                        >
                        @endif
                        <div class="dropdown-devider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                        @php
                            $carts = \App\Cart::where('users_id', Auth::user()->id)->count();
                        @endphp
                        @if ($carts > 0)
                        <img
                            src="{{ url('./images/icon-cart-filled.svg') }}"
                        />
                        <div class="card-badge">{{ $carts }}</div>
                        @else
                        <img
                            src="{{ url('./images/icon-cart-empty.svg') }}"
                            alt="cart-empty"
                        />
                        @endif
                    </a>
                </li>
            </ul>

            <!-- Mobile Menu -->
            <ul class="navbar-nav d-block d-lg-none">
                <li class="nav-item">
                    <a href="#" class="nav-link"> Hi, {{ Auth::user()->name }} </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                        Cart
                    </a>
                </li>
            </ul>
          @endauth
        </div>
      </div>
    </nav>
