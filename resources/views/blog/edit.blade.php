@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Blogs
                        <a href="{{ route('blogs.index') }}" class="btn btn-primary float-right">Back</a>

                </div>
                <div class="card-body">
                   <div class="row">
                       <div class="col-md-9">
                           <form action="" id="blog-form" method="post">
                               <div class="form-group">
                                   <label for="title">Title</label>
                                   <input id="title" value="{{$blog->title}}" class="form-control" type="text" name="title">
                                   <span class="text-danger" id="#errr-title"></span>
                               </div>
                               <div class="form-group">
                                   <label for="image">Image</label>
                                   <input id="image" class="form-control" type="file" name="image">
                               </div>
                               <div class="form-group">
                                   <label for="description">Description</label>
                                   <textarea name="description"  class="form-control" id="description" cols="3" rows="2">{{$blog->description}}</textarea>
                               </div>
                               <div class="form-group">
                                   <label for="tags">Tags</label>
                                   <input id="tags" value="{{$blog->tag}}" class="form-control"  type="text" name="tags">
                               </div>
                               <button type="submit" class="btn btn-primary">Update</button>
                           </form>
                       </div>
                   </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $('#blog-form').on('submit',function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        console.log(formData);

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept':'appplication/json',
                // "Authorization": 'Bearer '+ localStorage.getItem('api_token')
            }

        });
        $.ajax({
            type: "POST",
            url: "/blogs/store",
            data:formData,
           processData: false,
           contentType: false,
           dataType: 'json',
            success: function (response) {
                var success = response;
                // console.log(response.success);
                if(response.success== true){

                    window.location= '/blogs'
                }


            },
            error: function (err) {


              },
        });

      });

});
</script>


@endsection
