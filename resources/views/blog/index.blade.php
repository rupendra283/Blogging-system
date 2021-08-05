@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Blogs
                    @auth
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary float-right">Create Blogs</a>
                    @endauth
                </div>
                <div class="card-body">
                   @if(Session::has('message'))
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                    @endif
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


</script>
@endsection
