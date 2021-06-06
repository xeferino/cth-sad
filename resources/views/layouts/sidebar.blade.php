<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="{{ asset('img/profile/'.Auth::user()->img) }}" alt="..." class="avatar-img rounded-circle avatar-img-profile">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#" aria-expanded="true">
                        <span>
                            {{ Auth::user()->name }}
                            <span class="user-level">{{ Str::upper((Auth::user()->role=="administer") ? "Administrador" : "Super Admin") }} </span>
                        </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
            </div>
            <ul class="nav">
                    <li class="nav-item {{(\Request::segment(1)=='dashboard')?'active':''}}">
                        <a href="{{route('home')}}">
                            <i class="fas fa-chart-bar"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                @if (Auth::user()->role=="super")
                    @php
                        $nav = ['polls', 'sections', 'questions']
                    @endphp
                    <li class="nav-item {{ (in_array(\Request::segment(1), $nav)) ? 'active' : ''}}">
                        <a href="{{route('polls.index')}}">
                            <i class="fas fa-file-signature"></i>
                            <p>Encuentas</p>
                        </a>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='openings')?'active':''}}">
                        <a href="{{route('openings.index')}}">
                            <i class="fas fa-calendar-alt"></i>
                            <p>Aperturar</p>
                        </a>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='assignments')?'active':''}}">
                        <a href="{{route('assignments.index')}}">
                            <i class="fas fa-user-check"></i>
                            <p>Asignar</p>
                        </a>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='customers')?'active':''}}">
                        <a href="{{route('customers.index')}}">
                            <i class="fas fa-user-friends"></i>
                            <p>Clientes</p>
                        </a>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='routes')?'active':''}}">
                        <a href="{{route('routes.index')}}">
                            <i class="fas fa-map-marker-alt"></i>
                            <p>Rutas</p>
                        </a>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='cantons')?'active':''}}">
                        <a href="{{route('cantons.index')}}">
                            <i class="fas fa-map-marked-alt"></i>
                            <p>Cantones</p>
                        </a>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='tabs')?'active':''}}">
                        <a data-toggle="collapse" href="#base">
                            <i class="fas fa-chart-line"></i>
                            <p>Tabulaciones</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="base">
                            <ul class="nav nav-collapse">
                                <li>
                                    <a href="{{route('tabs.single')}}">
                                        <span class="sub-item">Individuales</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('tabs.question')}}">
                                        <span class="sub-item">Por Preguntas</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('tabs.index')}}">
                                        <span class="sub-item">Indice de Sastifacion</span></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item {{(\Request::segment(1)=='users')?'active':''}}">
                        <a href="{{route('users.index')}}">
                            <i class="fas fa-users"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role=="administer")
                <li class="nav-item {{(\Request::segment(1)=='tabs')?'active':''}}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-chart-line"></i>
                        <p>Tabulaciones</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{route('tabs.single')}}">
                                    <span class="sub-item">Individuales</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('tabs.question')}}">
                                    <span class="sub-item">Por Preguntas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('tabs.index')}}">
                                    <span class="sub-item">Indice de Sastifacion</span></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
