<!-- resources/views/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Task</h2>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Edit Task Form -->
    <form action="{{ route('updateTask', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Task Title -->
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $task->title) }}" required>
        </div>

        <!-- Task Description -->
        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $task->description) }}</textarea>
        </div>

        <!-- Due Date -->
        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $task->due_date) }}" required>
        </div>



        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Task</button>
        <a href="{{ route('index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
    