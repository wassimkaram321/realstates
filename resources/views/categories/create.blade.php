<!DOCTYPE html>
<html lang="en" dir="ltr">
@extends('common.sidebare')
@extends('common.navbar')
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

                        {{-- <p class="lead">
                            Basic and custom tables.
                        </p> --}}
                        <hr>
                        <div class="card card-shadow">
                            <div class="card-header">
                                <h4 class="card-title">Create Form </h4>
                            </div>
                            <div class="card-body">
                               <form method="POST" action="{{route('category_add')}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                       <label for="name.en"  class="col-sm-2 col-form-label">Category (English):</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name[en]" id="name.en" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name.ar"  class="col-sm-2 col-form-label">Category (Arabic):</label>
                                        <div class="col-sm-10">
                                             <input type="text" class="form-control" name="name[ar]" id="name.en" placeholder="Name" required>
                                        </div>
                                    </div>
                                    <div class="box-footer text-center">
                                        <a href="{{url('project')}}"><span class="btn btn-default">Back</span></a>
                                        <button type="submit" class="btn btn-info" name="submit" value="submit"> Create </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
             @include('common.footer')
            </div>
        </div>
        @extends('common.script')
</body>

</html>
