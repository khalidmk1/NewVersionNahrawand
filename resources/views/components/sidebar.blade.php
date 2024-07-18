<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" style="background-image: url({{ asset('') }})" class="brand-link">
        <img src="{{ asset('dist/img/nahrawand.jpg') }}" alt="AdminLTE Logo" class="brand-image  elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">NAHRAWAND</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item menu-open">

                    <ul class="nav nav-treeview">

                        @can('viewReport')
                            <li class="nav-item">
                                <a href="{{ route('report.index') }}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reporting</p>
                                </a>
                            </li>
                        @endcan

                    </ul>


                </li>

                <li class="nav-header">Gestion Acteur</li>


                <li class="nav-item">
                    <a href="{{ route('role.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Roles

                        </p>
                    </a>
                </li>

                @if (auth()->user()->hasRole('Super Admin'))
                    <li class="nav-item">
                        <a href="{{ route('create.admin') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Admins

                            </p>
                        </a>
                    </li>
                @endif



                @if (auth()->user()->hasRole(['Admin', 'Super Admin']))
                    <li class="nav-item">
                        <a href="{{ route('create.manager') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Managers

                            </p>
                        </a>
                    </li>
                @endif


                @can('viewGestionActeur')
                    <li class="nav-item">
                        <a href="{{ route('create.speaker') }}" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Speakers
                            </p>
                        </a>
                    </li>
                @endcan




                <li class="nav-item">
                    <a href="{{ route('client.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-users"></i>
                        <p>
                            Clients

                        </p>
                    </a>
                </li>

                {{-- <li class="nav-header">Gestion Achats</li>

                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>
                            Abonnements

                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fa fa-credit-card"></i>
                        <p>
                            Achats

                        </p>
                    </a>
                </li> --}}

                <li class="nav-header">Filter management</li>

                <li class="nav-item">
                    <a href="{{ route('category.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-book"></i>
                        <p>
                            Categorys
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('subcategory.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Subcategorys

                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('program.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-tasks"></i>
                        <p>
                            Programs
                        </p>
                    </a>
                </li>

                {{--  <li class="nav-item">
                    <a href="{{route('objective.index')}}" class="nav-link">
                        <i class="nav-icon fa fa-bullseye" aria-hidden="true"></i>
                        <p>
                            Objectives

                        </p>
                    </a>
                </li> --}}

                <li class="nav-header">Content Management</li>

                @can('viewCreateContent')
                    <li class="nav-item">
                        <a href="{{ route('content.create') }}" class="nav-link">

                            <i class="nav-icon  fa fa-graduation-cap" aria-hidden="true"></i>
                            <p>
                                Contents
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('content.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-graduation-cap" aria-hidden="true"></i>
                        <p>
                            View
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('event.create') }}" class="nav-link">
                        <i class="nav-icon  fa fa-calendar" aria-hidden="true"></i>
                        <p>
                            Events
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('map.create') }}" class="nav-link">
                        <i class="nav-icon  fa fa-calendar" aria-hidden="true"></i>
                        <p>
                            Map
                        </p>
                    </a>
                </li>


                @can('viewMangeTicket')
                    <li class="nav-header">Ticket Management</li>

                    <li class="nav-item">
                        <a href="{{ route('ticket.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-ticket-alt" aria-hidden="true"></i>

                            <p>
                                Tickets
                            </p>
                        </a>
                    </li>
                @endcan





                <li class="nav-header">Settings</li>

                <li class="nav-item">
                    <a href="{{ route('FAQ.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-question-circle" aria-hidden="true"></i>

                        <p>
                            FAQS
                        </p>
                    </a>
                </li>

                @can('viewManageEmail')
                    <li class="nav-item">
                        <a href="{{ route('email.index') }}" class="nav-link">
                            <i class="nav-icon fa fa-envelope" aria-hidden="true"></i>

                            <p>
                                Emails
                            </p>
                        </a>
                    </li>
                @endcan


                <li class="nav-item">
                    <a href="{{ route('history') }}" class="nav-link">
                        <i class="nav-icon fa fa-history" aria-hidden="true"></i>

                        <p>
                            Historys
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
