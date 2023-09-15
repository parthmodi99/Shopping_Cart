<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('dashboard') }}">Welcome <u style="text-transform: uppercase;">
            {{ Auth::guard('web')->user()->name }} </u>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ Request::routeIs(['dashboard']) ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
            </li>

            <li class="nav-item {{ Request::routeIs('user_product.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user_product.index') }}">Product List</a>
            </li>

            <li class="nav-item {{ Request::routeIs('cart.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('logout')}}">Logout </a>
            </li>
        </ul>
    </div>
</nav>
