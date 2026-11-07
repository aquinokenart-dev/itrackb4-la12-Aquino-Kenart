<div>
@extends('layouts.app')

@section('content')
    <h1>Page not found</h1>
    <p>The page you are looking for could not be found or has been removed.</p>
    <a href="{{ route('movies.index') }}">Back to the list</a>
@endsection
</div>
