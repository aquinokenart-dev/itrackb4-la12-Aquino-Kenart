<div>
    @extends('layouts.app')

@section('content')
    <h1>Server Error</h1>
    <p>Something went wrong on our end. Please try again later.</p>
    <a href="{{ route('movies.index') }}">Back to the list</a>
@endsection
</div>
