<nav class="white">
    <div class="nav-wrapper container">
        <a href="{{ route('landing-page') }}" class="brand-logo left black-text">
            <img src="{{ asset('img/logo-apmfi.png') }}" alt="APMFI" height="60">
        </a>
        
        <ul id="nav-mobile" class="right">
            <li {{ ($page == "login")? 'class=active': '' }}>
                <a href="{{ route('login') }}" class="black-text">Masuk</a>
            </li>
        </ul>
    </div>
</nav>