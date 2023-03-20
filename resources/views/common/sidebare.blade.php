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
                                        <img src="{{asset('dashboard/assets/images/200-200px-01.png')}}"  width="125" height="125" style="margin-left: 40px;"alt="">
                                    </a>
                                    </div>
                                </div>
                            </div>
                            <!-- HEADING -->
                            <!--<div class="py-2 drawer-heading">-->
                            <!--    {{-- Dashboards --}}-->
                            <!--</div>-->
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
                                    <li class="drawer-menu-item "><a href="our_project">Project</a></li>
                                    <li class="drawer-menu-item "><a href="our_project">Our Project</a></li>
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
                          
                          
                          
                            <!--<li class="drawer-menu-item drawer-submenu">-->
                            <!--    <a data-toggle="collapse" data-parent="#mainMenu" href="#"-->
                            <!--        data-target="#formsMenu" aria-controls="formsMenu" aria-expanded="false"-->
                            <!--        class="collapsed">-->
                            <!--        <i class="material-icons">create_new_folder</i>-->
                            <!--        <span class="drawer-menu-text"> Our Project</span>-->
                            <!--    </a>-->
                            <!--    <ul class="collapse " id="formsMenu">-->
                            <!--        <li class="drawer-menu-item "><a href="our_project">Mobile Project</a></li>-->
                            <!--        <li class="drawer-menu-item "><a href="our_project">Web Project</a></li>-->
                            <!--    </ul>-->
                            <!--</li>-->
                        </ul>
                            <!-- HEADING -->
                            <!--<div class="py-2 drawer-heading">-->
                            <!--    Components-->
                            <!--</div>-->

                            <!-- MENU -->
                            <!--<ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">-->
                            <!--    <li class="drawer-menu-item drawer-submenu">-->
                            <!--        <a data-toggle="collapse" data-parent="#mainMenu" href="#" data-target="#uiComponentsMenu" aria-controls="uiComponentsMenu" aria-expanded="false" class="collapsed">-->
                            <!--            <i class="material-icons">library_books</i>-->
                            <!--            <span class="drawer-menu-text"> UI Components</span>-->
                            <!--        </a>-->
                            <!--        <ul class="collapse " id="uiComponentsMenu">-->
                            <!--            <li class="drawer-menu-item "><a href="ui-buttons.html">Buttons</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="ui-colors.html">Colors</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="ui-grid.html">Grid</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="ui-icons.html">Icons</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="ui-typography.html">Typography</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="ui-drag-drop.html">Drag &amp; Drop</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="ui-loaders.html">Loaders</a></li>-->
                            <!--        </ul>-->
                            <!--    </li>-->


                            <!--    <li class="drawer-menu-item drawer-submenu">-->
                            <!--        <a data-toggle="collapse" data-parent="#mainMenu" href="#" data-target="#formsMenu" aria-controls="formsMenu" aria-expanded="false" class="collapsed">-->
                            <!--            <i class="material-icons">text_format</i>-->
                            <!--            <span class="drawer-menu-text"> Forms</span>-->
                            <!--        </a>-->
                            <!--        <ul class="collapse " id="formsMenu">-->
                            <!--            <li class="drawer-menu-item "><a href="form-controls.html">Form Controls</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="checkboxes-radios.html">Checkboxes &amp; Radios</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="switches-toggles.html">Switches &amp; Toggles</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="form-layout.html">Layout Variations</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="validation.html">Validation</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="custom-forms.html">Custom Forms</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="text-editor.html">Text Editor</a></li>-->
                            <!--            <li class="drawer-menu-item "><a href="datepicker.html">Datepicker</a></li>-->
                            <!--        </ul>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item  ">-->
                            <!--        <a href="ui-tables.html">-->
                            <!--            <i class="material-icons">tab</i>-->
                            <!--            <span class="drawer-menu-text"> Tables</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item  ">-->
                            <!--        <a href="ui-notifications.html">-->
                            <!--            <i class="material-icons">notifications</i>-->
                            <!--            <span class="drawer-menu-text"> Notifications</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item  ">-->
                            <!--        <a href="charts.html">-->
                            <!--            <i class="material-icons">equalizer</i>-->
                            <!--            <span class="drawer-menu-text"> Charts</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item  ">-->
                            <!--        <a href="events-calendar.html">-->
                            <!--            <i class="material-icons">event_available</i>-->
                            <!--            <span class="drawer-menu-text"> Calendar</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item  ">-->
                            <!--        <a href="maps.html">-->
                            <!--            <i class="material-icons">pin_drop</i>-->
                            <!--            <span class="drawer-menu-text"> Maps</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--</ul>-->


                            <!-- HEADING -->
                            <!--<div class="py-2 drawer-heading">-->
                            <!--    Pages-->
                            <!--</div>-->

                            <!-- MENU -->
                            <!--<ul class="drawer-menu" id="mainMenu" data-children=".drawer-submenu">-->
                            <!--    <li class="drawer-menu-item">-->
                            <!--        <a href="account.html">-->
                            <!--            <i class="material-icons">edit</i>-->
                            <!--            <span class="drawer-menu-text">Edit Account</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item">-->
                            <!--        <a href="login.html">-->
                            <!--            <i class="material-icons">lock</i>-->
                            <!--            <span class="drawer-menu-text">Login</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item">-->
                            <!--        <a href="signup.html">-->
                            <!--            <i class="material-icons">account_circle</i>-->
                            <!--            <span class="drawer-menu-text">Sign Up</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--    <li class="drawer-menu-item">-->
                            <!--        <a href="forgot-password.html">-->
                            <!--            <i class="material-icons">help</i>-->
                            <!--            <span class="drawer-menu-text">Forgot Password</span>-->
                            <!--        </a>-->
                            <!--    </li>-->
                            <!--</ul>-->

                        </nav>
                    </div>
                </div>
            </div>
            <!-- // END drawer -->



    </div>