@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Blogs
                    {{count($blogs)}}
                    @auth
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary float-right">Create Blogs</a>
                    @endauth
                </div>
                <div class="card-body">
                    @if(Session::has('message'))
                     <p class="alert alert-info">{{ Session::get('message') }}</p>
                     @endif
                    <div class="row">
                         @php
                                 $sr=1;
                             @endphp
                         @foreach ($blogs as $blog)
                         @if ($blog->deleted_at == null)
                     <div class="col-md-3">


                  <img src="{{ Storage::url($blog->user->image)}}" class="rounded-circle" width="60px" height="40px">
                    <p>{{$blog->user->user_name}}</p>
                    <div class="card bg-light border-0" style="width:200px">
                      <a href="/blogs/show/{{$blog->slug}}"> <img class="card-img-top" src="{{ Storage::url($blog->image)}}" alt="Card image" style="width:100%"></a>
                        <div class="card-body">
                        <h4 cl  ass="card-title">{{$sr++}}{{$blog->title}}</h4>
                        <p class="card-text">{{$blog->description}}</p>
                        <a href="/blogs/show/{{$blog->slug}}" class="btn btn-primary btn-sm">Blog</a>
                        @auth
                        @if (Auth::user()->id ==  $blog->user_id)
                        <a href="/blogs/{{ $blog->slug }}/edit" class="btn btn-success btn-sm">Edit</a>
                        <a href="/blogs/{{ $blog->slug }}/delete" class="btn btn-danger btn-sm">Delete</a>
                        @endif
                        @endauth
                        </div>
                    </div>
                    <br>
                    @endif

                                        {{-- <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>tags</th>
                                <th>Image</th>
                                <th>Owner</th>
                                @auth
                                <th>Action</th>
                                @endauth
                            </tr>
                        </thead>
                        @php
                            $sr=1;
                        @endphp
                        <tbody>
                            @foreach ($blogs as $blog)
                            @if ($blog->deleted_at == null)
                            <tr>
                                <td>{{$sr++}}</td>
                                   <td> <a href="/blogs/show/{{$blog->slug}}">{{$blog->title}}</a></td>
                                   <td>{{$blog->tags}}</td>
                                   <td><img src="{{ Storage::url($blog->image)}}" width="100px" alt=""></td>
                                   <td>{{$blog->user->user_name}}</td>
                                   @auth
                                   <td>
                                       @if (Auth::user()->id ==  $blog->user_id)


                                       <a href="/blogs/{{ $blog->slug }}/edit" class="btn btn-success">Edit</a>
                                       <a href="/blogs/{{ $blog->slug }}/delete" class="btn btn-danger">Delete</a>
                                       @endif


                                   </td>

                                   @endauth
                               </tr>

                            @endif
                            @endforeach
                        </tbody>
                    </table> --}}
                </div>
                @endforeach
            </div>
        </div>
    </div>
        </div>

    </div>
    @auth

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-3">
                <div class="card-header">
                    Recycle Bin
                </div>
                <div class="card-body">
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>Sr No</th>
                                <th>Title</th>
                                <th>tags</th>
                                <th>Image</th>
                                <th>Owner</th>
                                @auth
                                <th>Action</th>
                                @endauth
                            </tr>
                        </thead>
                        @php
                            $sr=1;
                        @endphp
                        <tbody>
                            @foreach ($blogs as $blog)
                            @if ($blog->deleted_at !== null && $blog->user_id == auth()->user()->id)
                            <tr>
                                <td>{{$sr++}}</td>
                                   <td> <a href="/blogs/show/{{$blog->slug}}">{{$blog->title}}</a></td>
                                   <td>{{$blog->tags}}</td>
                                   <td><img src="{{ Storage::url($blog->image)}}" width="100px" alt=""></td>
                                   <td>{{$blog->user->user_name}}</td>
                                   @auth
                                   <td>
                                       @if (Auth::user()->id ==  $blog->user_id)
                                       <a href="/blogs/{{ $blog->slug }}/restore" class="btn btn-sm btn-primary">Restore</a>
                                       <a href="/blogs/{{ $blog->slug }}/delete-permanent" class="btn btn-sm btn-danger">Delete Permenent</a>
                                       @endif
                                   </td>

                                   @endauth
                               </tr>

                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    @endauth



</div>
<script>


</script>
@endsection
