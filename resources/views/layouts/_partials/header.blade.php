<header>
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <img src="{{ asset('img/logo.png') }}" alt="">
        </a>

        <ul class="nav">
            <li>
                <a href="{{ route('home') }}"
                   class="nav-link text-white {{ Route::currentRouteName() === 'home' ? 'active' : '' }}"
                >
                    Início
                </a>
            </li>
            <li>
                <a href="{{ route('all-bovines') }}"
                   class="nav-link text-white {{ Route::currentRouteName() === 'all-bovines' ? 'active' : '' }}"
                >
                    Animais
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}"
                   class="nav-link text-white {{ Route::currentRouteName() === 'register' ? 'active' : '' }}"
                >
                    Cadastro
                </a>
            </li>
            <li>
                <a href="{{ route('shoot-down-bovines') }}"
                   class="nav-link text-white {{ Route::currentRouteName() === 'shoot-down-bovines' ? 'active' : '' }}"
                >
                    Abate
                </a>
            </li>
        </ul>
      </div>
    </div>
</header>
