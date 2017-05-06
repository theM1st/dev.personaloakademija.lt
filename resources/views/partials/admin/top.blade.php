@php $user = Auth::user() @endphp

<header class="header navbar navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a href="{{ route('admin.root') }}" class="navbar-brand">
                <span class="glyphicon glyphicon-cog"></span>
                ADMINISTRAVIMAS
            </a>
        </div>
        <nav>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a>
                        <span class="glyphicon glyphicon-user"></span>
                        {{ $user->email }}
                    </a>
                </li>
                <li>
                    <a href="/" class="user-logout">
                        <span class="glyphicon glyphicon-globe"></span>
                        Pagrindinis
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>