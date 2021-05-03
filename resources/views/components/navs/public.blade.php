<nav class="white">
    <div class="nav-wrapper container">
        <a href="{{ route('landing-page') }}" class="brand-logo black-text">
            <img src="{{ asset('img/logo.png') }}" alt="UPT Lab" height="60">
        </a>

        <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text">
            <i class="material-icons">menu</i>
        </a>
        
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li {{ ($page == "landing")? 'class=active': '' }}>
                <a href="{{ route('landing-page') }}" class="black-text">Beranda</a>
            </li>
            
            <li {{ ($page == "tutorial")? 'class=active': '' }}>
                <a href="{{ route('landing-tutorial') }}" class="black-text">Tutorial</a>
            </li>

            <li {{ ($page == "check")? 'class=active': '' }}>
                <a href="{{ route('check-registration') }}" class="black-text">Cek Booking</a>
            </li>
        </ul>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li>
        <div class="user-view center">
            <div class="background">
                <img src="{{ asset('img/background.svg')}}">
            </div>
            <a href="{{ route('landing-page') }}">
                <img src="{{ asset('img/logo-white-text.png') }}" alt="UPT Lab" height="60">
            </a>
        </div>
    </li>
    
    <li {{ ($page == "landing")? 'class=active': '' }}>
        <a href="{{ route('landing-page') }}" class="black-text">Beranda</a>
    </li>
    
    <li {{ ($page == "tutorial")? 'class=active': '' }}>
        <a href="{{ route('landing-tutorial') }}" class="black-text">Tutorial</a>
    </li>

    <li {{ ($page == "check")? 'class=active': '' }}>
        <a href="{{ route('check-registration') }}" class="black-text">Cek Booking</a>
    </li>
</ul>

