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
                        <h2>{{ __('Users') }}</h2>

                        {{-- <p class="lead">
                            Basic and custom tables.
                        </p> --}}
                        <hr>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ __('Create User') }} </h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <i class="material-icons">person</i><label class="form-control-label"
                                                for="formGroupExampleInput">{{ __('User Name') }}</label>

                                            <input required type="text" name="name" class="form-control"
                                                id="formGroupExampleInput" placeholder="{{ __('Enter username') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <i class="material-icons">email</i><label class="form-control-label"
                                                for="formGroupExampleInput">{{ __('Email') }}</label>

                                            <input required type="email" name="email" class="form-control"
                                                id="formGroupExampleInput" placeholder="{{ __('Enter email') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <i class="material-icons">web</i><label class="form-control-label"
                                                for="formGroupExampleInput">{{ __('Password') }}</label>

                                            <input required type="password" name="password" class="form-control"
                                                id="formGroupExampleInput" placeholder="{{ __('Enter password') }}">
                                        </div>
                                    </div>



                                    <div class="box-footer text-center mt-2">
                                        {{-- <a href="{{url('project')}}"><span class="btn btn-default">Back</span></a> --}}
                                        <button type="submit" class="btn btn-info" name="submit" value="submit">
                                            {{ __('Create') }} </button>
                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- // END drawer-layout__content -->
            {{-- @extends('common.sidebare') --}}


        </div>
        <!-- // END drawer-layout -->


        @extends('common.script')

</body>

</html>
