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
                                <form method="POST" action="{{ route('update_blog',$blog->id) }}" enctype="multipart/form-data">
                                    @csrf
                                        <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput">Blog image</label>
                                            <img style="max-width: 200px; max-height: 200px"src="{{ asset('public/blog/' . $blog->image) }}">
                                            <br><br>
                                            <input type="file" name="image" class="form-control" id="formGroupExampleInput" placeholder="Enter title">
                                        </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput2">Tirle in english</label>
                                            <input type="text" name="title_en" class="form-control" value="{{$blog->title_en}}" placeholder="" >
                                       </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput2">Text in english</label>
                                            <textarea name="text_en" class="form-control"  >{{$blog->text_en}}</textarea>
                                       </div>
                                       <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput2">Title in arabic</label>
                                            <input type="text" name="title_ar" class="form-control" value="{{$blog->title_ar}}" placeholder="" >
                                       </div>
                                        <div class="form-group">
                                            <label class="form-control-label" for="formGroupExampleInput2">Text in arabic</label>
                                            <textarea name="text_ar" class="form-control" >{{$blog->text_ar}}</textarea>
                                       </div>

                                    <div class="text-center">
                                     <a href = "{{url('blog')}}"><span class="btn btn-default">Back</span></a>
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