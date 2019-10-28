@extends('layout.adminapp')

@section('body')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

@endsection