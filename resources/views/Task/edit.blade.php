@extends('layouts.app')
@section('title', 'Edit task')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit task') }}
                </div>
                <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                    <form action="{{ route('update.task') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$find->id}}">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" value="{{$find->title}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="10">{{$find->description}}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="" disabled selected>Select status</option>
                                        <option value="1" {{$find->status == 1 ? 'selected' : ''}}>To-do</option>
                                        <option value="2" {{$find->status == 2 ? 'selected' : ''}}>In progress</option>
                                        <option value="3" {{$find->status == 3 ? 'selected' : ''}}>Completed</option>
                                    </select>
                                </div>        
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Due date</label>
                                    <input type="date" name="due_date" class="form-control" value="{{$find->due_date}}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group m-2">
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_urgent" type="checkbox" {{$find->is_urgent == 1 ? 'checked' : ''}} value="1">
                                        <label class="form-check-label">
                                            On priority
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <input type="submit" value="Submit" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
