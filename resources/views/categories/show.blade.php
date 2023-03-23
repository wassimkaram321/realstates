<!DOCTYPE html>
<html lang="en" dir="ltr">

@include('common.head')

<body>
    <div class="mdk-drawer-layout js-mdk-drawer-layout" data-fullbleed data-push data-responsive-width="992px" data-has-scrolling-region>

        <div class="mdk-drawer-layout__content">
            <!-- header-layout -->
            
            <div class="mdk-header-layout js-mdk-header-layout  mdk-header--fixed  mdk-header-layout__content--scrollable">
                <!-- header -->
                

                <!-- content -->
                <div class="mdk-header-layout__content top-navbar mdk-header-layout__content--scrollable h-100">
                    <!-- main content -->
                    <div class="container-fluid">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Category</h2>
                            <div class="d-flex">
                                <ol class="breadcrumb m-0 mr-auto">
                                    <li class="breadcrumb-item active"><a href="home">Dashboard</a></li>
                                    <li class="breadcrumb-item">category</li>
                                </ol>
                            </div>
                        </div>
                        <div class="card card-shadow">
                            <div class="card-header">
                                {{-- <h4 class="card-title">
                                    Default
                                </h4> --}}
                                <h2 class="float-right">
                                    <a href="#" class="btn btn-info" > Create </a>
                                   
                                </h2>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table m-0" id="myTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">#</th>
                                                <th scope="col" class="text-center">Name</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @foreach ($categorys as $category)
                                            <tr>
                                               <th class="align-middle text-center" scope="row">{{$category->id}}</th>
                                                <td class="align-middle text-center">{{ $category->getTranslation('name','ar') }} </td>
                                                <td class="align-middle text-center">
                                                 <a href="{{ url('delete_hero', $category->id) }}" class="action-icon "><i class="material-icons">delete</i> </a>
                                                 <a href="{{ url('edit_hero', $category->id) }}"><i class="material-icons">edit</i> </a>
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
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown"
                                    id="notificationsDropdown">
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
        <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
            <div class="mdk-drawer__content">
                <div class="mdk-drawer__inner" data-simplebar data-simplebar-force-enabled="true">

                    <nav class="drawer  drawer--dark">
                        <div class="drawer-spacer">
                            <div class="media align-items-center">
                                {{-- <a href="index.html" class="drawer-brand-circle mr-2">S</a> --}}
                                <div class="media-body">
                                    <a href="home" class="h5 m-0 text-link">
                                        <img src=""
                                            width="125" height="125" style="margin-left: 40px;"alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- HEADING -->
                        <div class="py-2 drawer-heading">
                            {{-- Dashboards --}}
                        </div>
                        <!-- MENU -->
                      <ul class="drawer-menu" id="dasboardMenu" data-children=".drawer-submenu">
                            <li class="drawer-menu-item  ">
                                <a href="home">
                                    <i class="material-icons">dashboard</i>
                                    <span class="drawer-menu-text">Dashboards</span>
                                </a>
                            </li>
                           
                            <li class="drawer-menu-item">
                                <a href="users">
                                    <i class="material-icons">person</i>
                                    <span class="drawer-menu-text">Users</span>
                                    {{-- <span class="badge badge-pill badge-success ml-1">4</span> --}}
                                </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="contact">
                                    <i class="material-icons">ring_volume</i>
                                    <span class="drawer-menu-text">Contact-us</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item ">
                                <a href="hero">
                                    <i class="material-icons">photo_size_select_actual</i>
                                    <span class="drawer-menu-text">Hero</span>
                                </a>
                            </li>
                           <li class="drawer-menu-item ">
                                <a href="testimonial">
                                    <i class="material-icons">message</i>
                                    <span class="drawer-menu-text"> Testimonial</span>
                                </a>
                            </li>
                            <li class="drawer-menu-item ">
                                    <a href="projects">
                                        <i class="material-icons">local_parking</i>
                                        <span class="drawer-menu-text">Project</span>
                                    </a>
                            </li>
                             <li class="drawer-menu-item ">
                                    <a href="our_project">
                                        <i class="material-icons">local_grocery_store</i>
                                        <span class="drawer-menu-text">Our Product</span>
                                    </a>
                            </li>
                             <li class="drawer-menu-item ">
                                    <a href="service">
                                        <i class="material-icons">hdr_weak</i>
                                        <span class="drawer-menu-text">Our Services</span>
                                    </a>
                            </li>
                             
                            <li class="drawer-menu-item ">
                                <a href="blog">
                                    <i class="material-icons">photo_library</i>
                                    <span class="drawer-menu-text">Blog</span>
                                </a>
                            </li>
                               <li class="drawer-menu-item drawer-submenu">
                                <a data-toggle="collapse" data-parent="#mainMenu" href="#"
                                    data-target="#formsMenu" aria-controls="formsMenu" aria-expanded="false"
                                    class="collapsed">
                                    <i class="material-icons">markunread</i>
                                    <span class="drawer-menu-text"> Email</span>
                                </a>
                                <ul class="collapse " id="formsMenu">
                                    <li class="drawer-menu-item "><a href="job">Jobs</a></li>
                                    <li class="drawer-menu-item "><a href="service_email">Service</a></li>
                                    <li class="drawer-menu-item "><a href="show_order_project">Order Project</a></li>
                                    <li class="drawer-menu-item "><a href="show_order_demo">Order Demo</a></li>
                                </ul>
                            </li>
                            
                             <li class="drawer-menu-item ">
                                <a href="partner">
                                    <i class="material-icons">person_pin_circle</i>
                                    <span class="drawer-menu-text">Partners</span>
                                </a>
                            </li>
                            
                           <li class="drawer-menu-item  ">
                                <a href="about_us">
                                    <i class="material-icons">feedback</i>
                                    <span class="drawer-menu-text"> About Us</span>
                                </a>
                            </li>
                         
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
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


</body>


</html>