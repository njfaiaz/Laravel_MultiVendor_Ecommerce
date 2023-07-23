<!-- // Start Col md 3 menu -->
@php
    $route = Route::current()->getName();
@endphp


<div class="col-md-3">
<div class="dashboard-menu">
    <ul class="nav flex-column" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ ($route ==  'user.dashboard')? 'active':  '' }}" href="{{ route('user.dashboard') }}"><i
                    class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($route ==  'user.order.page')? 'active':  '' }}" href="{{ route('user.order.page') }}"><i
                    class="fi-rs-shopping-bag mr-10"></i>Orders</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($route ==  'return.order.page')? 'active':  '' }}" href="{{ route('return.order.page') }}" ><i class="fi-rs-shopping-bag mr-10"></i>Return Orders</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="#track-orders"><i
                    class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="#address"><i class="fi-rs-marker mr-10"></i>My Address</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{ ($route ==  'user.account.page')? 'active':  '' }}" href="{{ route('user.account.page') }}"><i
                    class="fi-rs-user mr-10"></i>Account details</a>
        </li>

        <li class="nav-item ">
            <a class="nav-link {{ ($route ==  'user.change.password')? 'active':  '' }}" href="{{ route('user.change.password') }}"><i class="fi-rs-user mr-10"></i>Change
                Password</a>
        </li>

        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
        </li>
    </ul>
</div>
</div>
<!-- // End Col md 3 menu -->
