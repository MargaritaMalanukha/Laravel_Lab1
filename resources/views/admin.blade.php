@extends('layout')

@section('content')

<section class="admin-title">
    <h1>Admin Panel</h1>
</section>

<section class="admin-panel-container">
    <div class="admin-panel-block">
        <div class="admin-upper-buttons-wrapper" >
            <a class="button" id="admin-create-button" href="{{ route('entity.index') }}">CREATE</a>
            <a class="button" id="admin-create-button" href="/page/create/alias">CREATE ALIAS</a>
            <a class="button" id="admin-create-button" href="site/countries/ua">GO TO MAIN</a>
        </div>
        <div class="admin-lower-buttons-wrapper">
            <a class="button" id="admin-create-button" style="width: 300px" href="{{ route('custom_fields.index') }}">MANAGE CUSTOM FIELDS</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif


        @foreach($pages as $page)
            <div class="admin-page-line">
                <p>{{ $page->code }} </p>
                <div class="admin-buttons-container">
                    <a href="/site/{{ $page->code }}/ua"><button class="button" id="admin-viewUA-button">View</button></a>
                    <a href="{{ route('page.edit', $page) }}"><button class="button" id="admin-edit-button">Edit</button></a>
                    <form action="{{ route('page.destroy', $page) }}" method="POST" style="">
                        @csrf
                        @method('DELETE')
                        <button class="button" id="admin-delete-button">Delete</button>
                    </form>

                </div>
            </div>
        @endforeach

    </div>
</section>


@endsection
