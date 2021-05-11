<nav class="white">
    <div class="nav-wrapper container">
        <a href="{{ route('landing-page') }}" class="brand-logo left black-text">
            <img src="{{ asset('img/logo.png') }}" alt="Mitseda" height="60">
        </a>
        
        <ul id="nav-mobile" class="right">
            <li {{ ($page == "login")? 'class=active': '' }}>
                <a href="{{ route('login') }}" class="black-text">Masuk</a>
            </li>

            @if (Route::has('register'))
                <li {{ ($page == "register")? 'class=active': '' }}>
                    <a href="{{ route('register') }}" class="black-text">Daftar</a>
                </li>
            @endif
        </ul>
    </div>
</nav>