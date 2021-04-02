@extends('layouts.app')

@section('content')
<div class="container">

@include('sweetalert::alert')

<!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between my-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="content justify-content-center">
        <div class="card shadow">
            <div class="card-header border-0">
                <h5>Profile</h5>
            </div>
            <div class="card-body">

                    <div>
                        <label class="h6 font-weight-bold">Full Name:</label>
                        <h6 class="text-uppercase">{{Auth::user()->firstname}} {{Auth::user()->lastname}}</h6>
                    </div>

                    <div>
                        <label class="h6 font-weight-bold">Username:</label>
                        <h6 class="text-uppercase">{{Auth::user()->username}}</h6>
                    </div>

                    <div>
                        <label class="h6 font-weight-bold">Email:</label>
                        <h6 class="text-uppercase">{{Auth::user()->email}}</h6>
                    </div>


                    <div class="small">
                        <label class="h6 font-weight-bold">Add Avatar:</label>
                        <form action="{{route('home')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image">
                            <input type="submit" value="Upload">
                        </form>
                    </div>

            </div>
        </div>
        <div class="content justify-content-center">
            <div class="card shadow">
                <div class="card-header border-0 mb-3">
                    <h5>Tasks</h5>
                </div>

                <form action="{{route('add-task')}}" method="POST">
                    @csrf
                    <div class="form-group col-xl-5">
                        <input class="form-control" name="title" id="title" placeholder="Title">
                    </div>

                    <div class="form-group col-xl-5">
                        <input class="form-control" name="body" id="body" placeholder="Details">
                    </div>

                    <div class="form-group col-xl-5">
                        <button class="btn btn-outline-primary btn-sm border-0" type="submit"><i class="far fa-plus-square"></i> add</button>
                    </div>

                </form>

                @foreach($tasks->chunk(5) as $chunk)
                    <div class="row justify-content-center">
                        @foreach($chunk as $task)
                        <div class="card p-3 m-2 shadow " style="max-width: fit-content">
                        <form action="{{route('edit-task',$task->id)}}"  method="post">
                            @csrf
                            @method('patch')
                        <div class="form-group">
                            <input class="form-control" name="uTitle" id="uTitle" value="{{$task->title}}">
                        </div>

                        <div class="form-group">
                            <input class="form-control" name="uBody" id="uBody" value="{{$task->body}}">
                        </div>

                            <button class="btn btn-outline-warning btn-sm border-0" type="submit"><i class="far fa-edit"></i> update</button>
                        </form>


                        <form action="{{route('delete-task',$task->id)}}"  method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger btn-sm border-0" type="submit"><i class="far fa-trash-alt"></i> delete</button>
                        </form>

                        </div>
                        @endforeach
                </div>
                @endforeach

            </div>
        </div>
    </div>


</div>
@endsection
