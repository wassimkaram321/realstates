<div class="mdk-header js-mdk-header bg-primary" data-fixed>
                    <div class="mdk-header__content">

                        <nav class="navbar navbar-expand-md bg-primary navbar-dark d-flex-none">
                            <button class="btn btn-link pl-0" type="button" data-toggle="sidebar" style="color:#244879">
                                <i class="material-icons align-middle md-36">short_text</i>
                            </button>
                            <div class="page-title m-0"></div>
                            
                            <div class="collapse navbar-collapse" id="mainNavbar">
                                <ul class="navbar-nav ml-auto align-items-center">
                                    <!-- <li class="nav-item dropdown nav-language d-flex align-items-center">-->
                                    <!--    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"-->
                                    <!--        aria-expanded="false">-->
                                    <!--        EN-->
                                    <!--    </a>-->
                                    <!--     <div class="dropdown-menu dropdown-menu-right ">-->
                                    <!--        <ul class="list-unstyled">-->
                                    <!--            <li>-->
                                    <!--                <a href="account.html" class="dropdown-item active">-->
                                    <!--                    <img src="{{asset('dashboard/assets/img/us_flag.png')}}" style="width: 25px; vertical-align: middle" alt="English"> English-->
                                    <!--                </a>-->
                                    <!--            </li>-->
                                    <!--            <li>-->
                                    <!--                <a href="account.html" class="dropdown-item">-->
                                    <!--                    <img src="{{asset('dashboard/assets/img/ar_flag.png')}}" style="width: 25px; vertical-align: middle" alt="French"> Arabic-->
                                    <!--                </a>-->
                                    <!--            </li>-->
                                        
                                    <!--        </ul>-->
                                    <!--    </div>-->
                                    <!--</li>-->
                                    <li class="nav-item dropdown notifications d-flex align-self-center align-items-center" id="navbarNotifications">
                                        <a href="#" class="nav-link dropdown-toggle notifications--active" data-toggle="dropdown" aria-expanded="false">
                                            <i class="material-icons align-middle">notifications</i>
                                            </a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationsDropdown" id="notificationsDropdown">
                                            <ul class="nav nav-tabs-notifications d-flex px-0" id="notifications-ul" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="true">Notifications</a>
                                                </li>
                                
                                            </ul>
                                                    <div class="tab-content" id="notifications-tabs">
                                                <div class="tab-pane fade show active" id="notifications"
                                                    role="tabpanel" aria-labelledby="notifications-tab">
                                                    </div>
                                                    <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <div class="media align-items-center">
                                                                <i class="material-icons align-middle mr-2 text-warning">
                                                                    info_outline
                                                                    </i>
                                                                <div class="media-body">
                                                                    <div class="w-100">
                                                                        <a href="profile.html">john</a> received a new
                                                                        <a href="#">quote</a>
                                                                    </div>
                                                                    <div class="w-100 text-muted">4 secs ago</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="media align-items-center">
                                                                <i class="material-icons align-middle mr-2 text-success">
                                                                            check_circle
                                                                            </i>
                                                                <div class="media-body">
                                                                    <div class="w-100">
                                                                        <a href="profile.html">karen</a> completed a
                                                                        <a href="#">task</a>
                                                                    </div>
                                                                    <div class="w-100 text-muted">25 mins ago</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="media align-items-center">
                                                                <i class="material-icons align-middle mr-2 text-danger">
                                                                    warning
                                                                    </i>
                                                                <div class="media-body">
                                                                    <div class="w-100">
                                                                        <a href="profile.html">jim</a> removed a
                                                                        <a href="#">task</a>
                                                                    </div>
                                                                    <div class="w-100 text-muted">7 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item text-right">
                                                            <a href="#">
                                                                    <span class="align-middle">View All</span>
                                                                    <i class="material-icons md-18 align-middle">arrow_forward</i>
                                                                </a>
                                                        </li>
                                                    </ul>
                                                    </div>
                                                    <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item">
                                                            <div class="media align-items-center">
                                                                <a href="profile.html">
                                                                    <img src="{{asset('dashboard/assets/images/avatars/person-1.jpg')}}" class="img-fluid rounded-circle mr-2" width="35" alt="">
                                                                    </a>
                                                                <div class="media-body">
                                                                    <div class="w-100">I started that project we talked...</div>
                                                                    <div class="w-100 text-muted">4 secs ago</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="media align-items-center">
                                                                <a href="profile.html">
                                                                    <img src="{{asset('dashboard/assets/images/avatars/person-11.jpg')}}" class="img-fluid rounded-circle mr-2" width="35" alt="">
                                                                    </a>
                                                                <div class="media-body">
                                                                    <div class="w-100">Can we arrange a meeting?...</div>
                                                                    <div class="w-100 text-muted">25 mins ago</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <div class="media align-items-center">
                                                                <a href="profile.html">
                                                                    <img src="{{asset('dashboard/assets/images/avatars/person-12.jpg')}}" class="img-fluid rounded-circle mr-2" width="35" alt="">
                                                                    </a>
                                                                <div class="media-body">
                                                                    <div class="w-100">We need to fix some bugs...</div>
                                                                    <div class="w-100 text-muted">7 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="list-group-item text-right">
                                                            <a href="#">
                                                                <span class="align-middle">View All</span>
                                                                <i class="material-icons md-18 align-middle">arrow_forward</i>
                                                            </a>
                                                        </li>
                                                </ul>
                                                </div>
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
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                                        {{ __('Logout') }}
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                    </i>
                                        {{-- <li class="nav-item">
                                            <a href="#" class="nav-link dropdown-toggle dropdown-clear-caret" data-toggle="sidebar" data-target="#user-drawer">
                                                Frontted
                                                <img src="../../../pbs.twimg.com/profile_images/928893978266697728/3enwe0fO_400x400.jpg" class="img-fluid rounded-circle ml-1" width="35"
                                                    alt="">
                                                </a>
                                        </li> --}}
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
    <style>
        .cancel-icon {
          position: absolute;
          right: 10px;
          top: 50%;
          transform: translateY(-50%);
}
    </style>