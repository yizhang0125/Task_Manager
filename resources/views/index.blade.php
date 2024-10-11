@extends('layouts.app')

@section('title', 'Task Manager')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <h1 class="display-4 text-center">Task Manager</h1>
                <p class="lead text-center">Manage your tasks efficiently</p>

                <!-- Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Task Table -->
                <table class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Due Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if($task->isCompleted == 1)
                                    <span class="badge bg-success">Completed</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>{{ $task->due_date }}</td>
                            <td>
                                @if($task->isCompleted == 0)
                                <a href="{{ route('doneTask', $task->id)}}" class="btn btn-success">Mark as Completed</a>
                                @endif
                            </td>
                            <td> <a href="{{ route('editTask', $task->id) }}" class="btn btn-warning btn-sm">Edit</a></td>
                            <td><!-- Delete Task Button -->
                            <form action="{{ route('deleteTask', $task->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                            </td>
                                    
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
