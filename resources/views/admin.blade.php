@extends('layout')

@section('content')

<section class="admin-title">
    <h1>Admin Panel</h1>
</section>

<section class="admin-panel-container">
    <div class="admin-panel-block">
            <a class="button" id="admin-create-button" href="{{ route('page.create') }}">CREATE</a>

        @foreach($pages as $page)
            <div class="admin-page-line">
                <p>{{ $page->captionUA }} </p>
                <div class="admin-buttons-container">
                    <a href="/site/{{$page->code}}/ua"><button class="button" id="admin-viewUA-button" >View(UA)</button></a>
                    <a href="/site/{{$page->code}}/ru"><button class="button" id="admin-viewRU-button">View(RU)</button></a>
                    <a href="{{ route('page.edit', $page) }}"><button class="button" id="admin-edit-button">Edit</button></a>
                    <form action="{{ route('page.destroy', $page) }}" method="POST" style="">
                        @csrf
                        @method('DELETE')
                        <button class="button" id="admin-delete-button">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
    </div>
</section>


@endsection
