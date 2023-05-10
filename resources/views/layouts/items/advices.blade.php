@extends('layouts.app')

@section('content')
    <h1>Generated Advices</h1>

    @foreach($advices as $advice)
        <h2>{{ $advice['title'] }}</h2>
        <p>{{ $advice['message'] }}</p>
    @endforeach
@endsection
