@extends('layouts.app')
@section('title', 'Add task')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Add task') }}
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
                    <form action="{{ route('insert.task') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" class="form-control">
                                        <option value="" disabled selected>Select status</option>
                                        <option value="1">To-do</option>
                                        <option value="2">In progress</option>
                                        <option value="3">Completed</option>
                                    </select>
                                </div>        
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Due date</label>
                                    <input type="date" name="due_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group m-2">
                                    <div class="form-check">
                                        <input class="form-check-input" name="is_urgent" type="checkbox" value="1">
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
