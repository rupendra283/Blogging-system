@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto" >
            <div class="card">
                <div class="card-header" style="background-image: url({{Storage::url($blog->image)}}); height: 100px; backgrouind-size:cover;">
                    <h2>{{$blog->title}}</h2>
                </div>
                <div class="card-body">
                    <p>{{$blog->description}}</p>
                    <div class="text-right">
                        <h5>Created by</h5>
                        <img src="{{Storage::url($blog->user->image)}}" alt="" class="rounded-circle" width="60px" height="40px"> <strong >{{$blog->user->user_name}}</strong>

                    </div>
                    <hr>

                    <div class="comments">
                        <h5 class="text-danger font-weight-bold">All Comments{{count($blog->comments)}}</h5>
                        <ul class="list-unstyled mt-5">
                            @foreach ($blog->comments as $comment)
                            <li class="media">
                              <img class="mr-3" src="{{Storage::url($comment->user->image)}}" alt="Generic placeholder image" width="40px">
                              <div class="media-body">
                                <h5 class="mt-0 mb-1">{{ $comment->user->user_name }} <i>  {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}} </i>
                                 </h5>
                                 {{ $comment->comment }}

                              </div>
                            </li><hr>
                            @endforeach
                          </ul>
                    </div>
                    <hr>
                    @auth
                    <div class="comment-section">
                        <form action="#" id="comment-form">
                            <div class="form-group">
                                <label for="my-input">Comments</label>
                                <textarea id="my-input" name="comment" class="form-control"></textarea>
                            </div>
                            <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                            <button type=" submit " class="btn btn-primary mt-1">Post Comment </button>
                        </form>
                    </div>

                    @endauth

                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $('#comment-form').on('submit',function (e) {
            e.preventDefault();
            console.log("asdsad");
            let formData= new FormData(this);
            $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept':'appplication/json',
                // "Authorization": 'Bearer '+ localStorage.getItem('api_token')
            }
        });
        $.ajax({
            type: "POST",
            url: "/comment/store",
            data: formData,
            dataType: "json",
            processData: false,
           contentType: false,
            success: function (response) {
                console.log(response);

                location.reload();


            },
            error:function(err){
                console.log(err);
            },
        });
    });
    });

</script>


@endsection
