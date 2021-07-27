<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('img/profile/avatar.svg') }}" alt="..." class="avatar-img rounded-circle avatar-img-profile">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#" aria-expanded="true">
                        <span>
                            {{ Auth::user()->Nombre_Usuario }}
                            <span class="user-level">{{ Str::upper((Auth::user()->role=="administer") ? "Administrador" : "Super Admin") }} </span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav">
                <li class="nav-item {{(\Request::segment(1)=='dashboard')?'active':''}}">
                    <a href="{{route('home')}}">
                        <i class="fas fa-chalkboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{(\Request::segment(1)=='clientes')?'active':''}}">
                    <a href="{{route('clientes.index')}}">
                        <i class="fas fa-users"></i>
                        <p>Clientes</p>
                    </a>
                </li>
                <li class="nav-item {{(\Request::segment(1)=='productos')?'active':''}}">
                    <a href="{{route('home')}}">
                        <i class="fas fa-box"></i>
                        <p>Productos</p>
                    </a>
                </li>
                <li class="nav-item {{(\Request::segment(1)=='cotizaciones')?'active':''}}">
                    <a href="{{route('home')}}">
                        <i class="fas fa-chart-line"></i>
                        <p>Cotizaciones</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
