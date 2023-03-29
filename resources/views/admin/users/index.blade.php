<!DOCTYPE html>
<html lang="en" dir="ltr">
@extends('common.sidebare')
@extends('common.navbar')
@include('common.head')


<body>
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-responsive-width="992px"
        data-has-scrolling-region>

        <div class="mdk-drawer-layout__content">
            <!-- header-layout -->

            <div
                class="mdk-header-layout js-mdk-header-layout  mdk-header--fixed  mdk-header-layout__content--scrollable">
                <!-- header -->


                <!-- content -->
                <div class="mdk-header-layout__content top-navbar mdk-header-layout__content--scrollable h-100">
                    <!-- main content -->
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>{{ __('Users') }}</h2>
                            <div class="d-flex">
                                <ol class="breadcrumb m-0 mr-auto">
                                    <li class="breadcrumb-item active"><a href="home">{{ __('Dashboard') }}</a></li>
                                    <li class="breadcrumb-item">{{ __('Users') }}</li>
                                </ol>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">

                                <h2 class="float-right">
                                    <a href="{{ route('users.create') }}" class="btn btn-info"> {{ __('Create') }} </a>

                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table m-0" id="myTable">
                                        <thead>
                                            <tr>

                                                <th scope="col" class="text-center">{{ __('Name') }}</th>
                                                <th scope="col" class="text-center">{{ __('Email') }}</th>
                                                <th scope="col" class="text-center">{{ __('Status') }}</th>
                                                <th scope="col" class="text-center">{{ __('Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>

                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->status }}</td>
                                                    <td>
                                                        <a href="{{ route('users.edit', ['user' => $user]) }}"
                                                            class="btn btn-info btn-circle fr mr-2">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-edit"></i>
                                                            </span>

                                                        </a>
                                                        <a href="#" data-id="{{$user->id}}"
                                                            class="btn btn-danger btn-circle fr delete-confirm mr-2">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-trash"></i>
                                                            </span>
                                                        </a>

                                                        
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div style="margin-left: 1000px;">
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                @include('common.footer')
            </div>
            <!-- // END drawer-layout__content -->
            <div class="mdk-header js-mdk-header bg-primary mdk-header--fixed" data-fixed>
                <div class="mdk-header__content">

                    <nav class="navbar navbar-expand-md navbar-dark bg-primary d-flex-none">
                        <button class="btn btn-link pl-0" type="button" data-toggle="sidebar" style="color:#244879">
                            <i class="material-icons align-middle md-36">short_text</i>
                        </button>
                        <a href="https://testpeaklink.netlify.app/" target="_blank" style="color:#0a2647">
                            Visit site
                            <i class="material-icons" style="margin-right:10px; color:#0a2647">near_me</i>
                        </a>
                        {{-- <div class="page-title m-0">UI Tables</div> --}}

                        <div class="collapse navbar-collapse" id="mainNavbar">
                            <ul class="navbar-nav ml-auto align-items-center">

                                <li class="nav-item dropdown nav-language d-flex align-items-center">
                                    <select name="language" class="input-group-text btn-primary"
                                        onchange="window.location.href=this.value;">


                                        <div
                                            class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu">
                                            <span class="align-middle d-none d-sm-inline-block">
                                                <option>Select Language</option>
                                            </span>

                                            <span class="align-middle d-none d-sm-inline-block">
                                                <option value="">English</option>
                                            </span>
                                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block align-middle">
                                            </i>
                                            <!-- item-->
                                            <span class="align-middle">
                                                <option value="">Arabic</option>
                                            </span>
                                        </div>
                                    </select>
                                </li>
                                <li class="nav-item dropdown notifications d-flex align-self-center align-items-center"
                                    id="navbarNotifications">
                                    <a href="#" class="nav-link dropdown-toggle notifications--active"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="material-icons align-middle">notifications</i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="notificationsDropdown" id="notificationsDropdown">
                                        <ul class="nav nav-tabs-notifications d-flex px-0" id="notifications-ul"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="notifications-tab" data-toggle="tab"
                                                    href="#notifications" role="tab" aria-controls="notifications"
                                                    aria-selected="true">Notifications</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="notifications-tabs">

                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item nav-divider">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                            role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                @endguest
                                </i>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>


        </div>

        <!-- drawer -->

        <!-- // END drawer -->
        @include('common.script')
        <style>
            .cancel-icon {
                position: absolute;
                right: 10px;
                top: 50%;
                transform: translateY(-50%);
            }
        </style>
        <script>
            $(document).ready(function() {
                $('.delete-confirm').click(function() {
                    var id = $(this).data('id');
                    var route = "{{ route('users.destroy', ['user' => ':id']) }}";
                    route = route.replace(':id', id);
                    // showDeleteConfirmation(id, route);
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: route,
                            data: {
                                '_token': "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                location.reload();
                            }
                        });
                    }
                });
                });
                $('.delete-selected-confirm').click(function() {
                    var id = productIds;
                    // 
                });
            });
        </script>


</body>


</html>
