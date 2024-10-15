@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create New Task</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('addTask') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Task Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Task Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date:</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ old('due_date') }}" min="{{ date('Y-m-d') }}" required>
        </div>


        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection
