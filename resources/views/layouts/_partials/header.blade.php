<header style="padding: {{ Route::currentRouteName() === 'edit' ? '.9rem 0 .8rem 0' : '.6rem 0' }}">
    <div class="container">
        <div class="row">
            <div class="col-md-4 logo-content">
                <a href="{{ route('home') }}" class="mb-2 mb-lg-0 text-white text-decoration-none">
                  <img src="{{ asset('img/logo.png') }}" alt="">
                </a>
            </div>

            <div class="col-md-8">
                <ul class="nav" style="top: {{ Route::currentRouteName() === 'edit' ? '.2rem' : '.8rem' }}">
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
    </div>

    <div class="underline"></div>
</header>
