@php
    $route = Route::current()->getName();
    // dd($route);
    $currenturl = url()->full();
    $url = parse_url($currenturl, PHP_URL_SCHEME) . '://' . parse_url($currenturl, PHP_URL_HOST) . ':' . parse_url($currenturl, PHP_URL_PORT);

@endphp
<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item {{ $route == 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                </a>
            </li>
            {{-- <li>
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2
                        </a>
                    </li>
                </ul>
            </li> --}}
            @if (Auth::user()->isAdmin == 1)
                <li  class="nav-item {{ $route == 'customers.index' ? 'active' : '' }}">
                    <a href="{{ route('customers.index') }}" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Customers</span></a>
                </li>
                <li class="nav-item {{ $route == 'products.index' ? 'active' : '' }}">
                    <a href="{{ route('products.index') }}" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Products</span></a>
                </li>
                <li class="nav-item {{ $route == 'PriceList.index' ? 'active' : '' }}">
                    <a href="{{ route('PriceList.index') }}"  class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Price List</span></a>
                </li>
                <li class="nav-item {{ $route == 'salesOrders.index' ? 'active' : '' }}">
                    <a href="{{ route('salesOrders.index') }}" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Sales Orders</span></a>
                </li>

            @else
                <li class="nav-item">
                    <a href="{{ route('salesOrders.create') }}" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Create Sales Orders</span></a>
                </li>
            @endif
        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img  src="{{ asset('') }}assets/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png" alt="hugenerd" width="30" height="30"
                    class="rounded-circle">
                <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">

                <li>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                            class="me-50" data-feather="power"></i>Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </li>
            </ul>
        </div>
    </div>
</div>
