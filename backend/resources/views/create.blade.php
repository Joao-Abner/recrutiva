@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Job</h1>

    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="description">Job Description</label>
            <textarea name="description" id="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Job</button>
    </form>
</div>
@endsection