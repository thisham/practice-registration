<nav class="indigo">
    <div class="nav-wrapper container">
        <div class="row">
            <div class="col l6 m12 s12">
                <a href="#" data-target="slide-out" class="sidenav-trigger show-on-large show-on-medium-and-down">
                    <i class="material-icons">menu</i>
                </a>

                <a href="#" class="brand-logo center">UPT Laboratorium Pusat</a>	
            </div>
        </div>
    </div>
</nav>

<ul id="slide-out" class="sidenav">
    <li>
        <div class="user-view">
            <div class="background">
                <img src="{{ asset('img/background.svg')}} ">
            </div>
            <a href="#user"><i class="material-icons white-text circle medium">admin_panel_settings</i></a>
            <a href="#name"><span class="white-text name">{{ Auth::user()->name }}</span></a>
            <a href="#email"><span class="white-text email">{{ Auth::user()->email }}</span></a>
        </div>
    </li>

    <li {{ ($page == "home")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-home') }}">
        <i class="material-icons left">home</i>Dashboard
    </a></li>

    <li><div class="divider"></div></li>
    
    <li><a class="subheader">Praktikum</a></li>

    <li {{ ($page == "new-practices")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-new-practices') }}">
        <i class="material-icons left">group</i>Form Baru
    </a></li>

    <li {{ ($page == "practice-plans")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-practice-plans') }}">
        <i class="material-icons left">description</i>Rencana Praktikum
    </a></li>

    <li {{ ($page == "practice-histories")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-practice-plans') }}">
        <i class="material-icons left">description</i>Riwayat Praktikum
    </a></li>

    <li><div class="divider"></div></li>
    
    <li><a class="subheader">Manajemen</a></li>

    <li {{ ($page == "tools")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-new-practices') }}">
        <i class="material-icons left">group</i>Alat
    </a></li>
        
    <li><div class="divider"></div></li>
    
    <li><a class="subheader">Akun</a></li>

    <li {{ ($page == "pw-change")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-pwedit') }}">
        <i class="material-icons left">settings</i>Pengaturan Akun
    </a></li>
        
    <li {{ ($page == "info-change")? 'class=active': '' }}><a class="waves-effect" href="{{ route('admin-pwedit') }}">
        <i class="material-icons left">lock</i>Ubah Kata Sandi
    </a></li>
        
    <li><a class="waves-effect" href="{{ route('logout') }}">
        <i class="material-icons left">exit_to_app</i>Keluar
    </a></li>
</ul>