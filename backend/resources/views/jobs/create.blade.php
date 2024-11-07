@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cadastrar Vaga</h1>
    <form action="{{ route('jobs.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="salary">Salário</label>
            <input type="number" step="0.01" class="form-control" id="salary" name="salary" required>
        </div>
        <div class="form-group">
            <label for="location">Localização</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>
        <div class="form-group">
            <label for="requirements">Requisitos</label>
            <textarea class="form-control" id="requirements" name="requirements" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Vaga</button>
    </form>
</div>
@endsection