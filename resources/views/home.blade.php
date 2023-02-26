@extends('layouts.app')
@section('title', 'Dashboard')
@push('custom-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <div class="float-right">
                        <a href="{{ route('task.add')}}" class="btn-sm btn-success">Add task</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(!empty($imptasks))  
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <p><strong>Importent</strong> You should check in on some of those below.</p>
                            <p>
                                @foreach($imptasks as $task)
                                    Task : {{$task->title}}, Due date: {{$task->due_date}}, Priority: {{$task->is_urgent == 1 ? 'On priority' : 'Non priority'}}<br>
                                @endforeach
                            </p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif 
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form class="form-inline">
                        <div class="form-group mr-4">
                            <label><strong>Status : &nbsp;</strong></label>
                            <select id='status' class="form-control" style="width: 200px">
                                <option value="0">All</option>
                                <option value="1">Todo</option>
                                <option value="2">In-process</option>
                                <option value="3">Completed</option>
                            </select>
                        </div>
                        <div class="form-group mr-4">
                            <label><strong>Priority : &nbsp;</strong></label>
                            <select id='priority' class="form-control" style="width: 200px">
                                <option value="0">All</option>
                                <option value="1">On priority</option>
                                <option value="2">Non priority</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive p-2">
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Title</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Due date</th>
                            <th class="text-center">Priority</th>
                            <th width="280px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('custom-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
$(function () {
      
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('home') }}",
          data: function (d) {
                d.status = $('#status').val(),
                d.priority = $('#priority').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {
                data: 'status', 
                name: 'status', 
                orderable: true, 
                searchable: true
            },
            {data:'due_date', name:'due_date'},
            {
                data: 'is_urgent',
                name: 'is_urgent',
                orderable: true, 
                searchable: true
            },
            {
                data: 'action',
                name: 'action',
                orderable: false, 
                searchable: false
            }
        ]
    });
  
    $('#status').change(function(){
        table.draw();
    });
    $('#priority').change(function(){
        table.draw();
    });
      
});
$(document).on('click', '.delete', function(){
    if (!confirm("Do you want to delete")){
        return false;
    }   
});
$(document).on('click', '.completed', function(){
    if (!confirm("Do you want to delete")){
        return false;
    }   
});
</script>
@endpush
@endsection
