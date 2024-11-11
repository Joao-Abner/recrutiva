@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Jobs</h1>
    
    @foreach ($jobs as $job)
        <div class="job">
            <h2>{{ $job->title }}</h2>
            <p>{{ $job->description }}</p>
            @if (Auth::check() && Auth::user()->role === 'Candidato')
                <form action="{{ route('applications.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="job_id" value="{{ $job->id }}">
                    <button type="submit">Apply</button>
                </form>
            @endif
        </div>
    @endforeach
</div>
@endsection