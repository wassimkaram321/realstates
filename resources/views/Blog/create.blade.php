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
                        <h2>{{__('Blog')}}</h2>
                        
                        {{-- <p class="lead">
                            Basic and custom tables.
                        </p> --}}
                        <hr>
                      <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Create Form </h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('add_blog') }}" enctype="multipart/form-data">
                                    @csrf
                                     <div class="form-group">
                                        <label class="form-control-label" for="formGroupExampleInput">Blog image</label>
                                        <input type="file" name="image" class="form-control" id="formGroupExampleInput" placeholder="Enter title">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="formGroupExampleInput">Title in arabic</label>
                                        <input type="text" name="title_ar" class="form-control" id="formGroupExampleInput" placeholder="Enter Name">
                                          
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="formGroupExampleInput2">Text in arabic</label>
                                        <textarea name="text_ar" class="form-control"></textarea>
                                      
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label" for="formGroupExampleInput">Title in english</label>
                                        <input type="text" name="title_en" class="form-control" id="formGroupExampleInput" placeholder="Enter Name">
                                        <br>
                                         <span class="text-danger" >{{ $errors->first('title_en') }}</span>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="form-control-label" for="formGroupExampleInput2">Text in english</label>
                                        <textarea name="text_en" class="form-control"></textarea>
                                        <br>
                                         <span class="text-danger" >{{ $errors->first('text_en') }}</span>
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

        </div>
        <!-- // END drawer-layout__content -->
{{-- @extends('common.sidebare') --}}
  

    </div>
    <!-- // END drawer-layout -->


 @extends('common.script')

</body>

</html>