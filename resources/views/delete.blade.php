@extends('layout')

@section('content')

    <section class="admin-title">
    @if ($message = Session::get('success'))
        <h1>{{$message}}</h1>
    @else
        <h1>Deleting your page wasn't successful.</h1>
    @endif
    </section>

@endsection
