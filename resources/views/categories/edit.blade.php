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
                        <h2>Blog</h2>
                     
                        <hr>
                      <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Form </h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('category_update',$category->id) }}" enctype="multipart/form-data">
                                    @csrf
                                       <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput2">Name (English)</label>
                                            <input type="text" class="form-control" value="{{$category->getTranslation('name', 'en')}}" name="name[en]" id="name.en">
                                       </div>
                                       <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput2">Name (Arabic)</label>
                                            <input type="text" class="form-control" value="{{$category->getTranslation('name', 'ar')}}" name="name[ar]" id="name.ar">
                                       </div>
                                    <div class="text-center">
                                     <a href = "{{url('category')}}"><span class="btn btn-default">Back</span></a>
                                     <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>                       
                </div>
            </div>

        </div>
        <!-- // END drawer-layout__content -->


    </div>
    <!-- // END drawer-layout -->


 @include('common.script')

</body>

</html>