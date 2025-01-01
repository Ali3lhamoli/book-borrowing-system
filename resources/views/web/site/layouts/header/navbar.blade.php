<nav class="navbar navbar-expand-lg bg-dark border-bottom border-body fixed-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('site.home') }}">Sharikna</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('site.home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('site.books.index') }}">My Books</a>
                </li>

                @if (auth()->check() && auth()->user()->hasRole('admin'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site.books.create') }}">Add Books</a>
                    </li>
                @endif

                @if (!auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->check() ? Auth::user()->name : 'profile' }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit"
                                        class="nav-link text-white">logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
