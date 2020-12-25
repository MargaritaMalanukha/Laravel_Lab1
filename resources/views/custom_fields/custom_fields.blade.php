@extends('layout')

@section('content')

    <section class="admin-title">
        <h1>Custom fields management panel</h1>
    </section>

    <section class="admin-panel-container">
        <div class="admin-panel-block">
            <div class="admin-upper-buttons-wrapper" style="margin-bottom: 40px">
                <a class="button" id="admin-create-button" href="{{ route('entity.create') }}" style="width: 250px">CREATE ENTITY</a>
                <a class="button" id="admin-create-button" href="{{ route('custom_fields.create') }}" style="width: 250px">CREATE FIELD</a>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($entities != null)
                @foreach($entities as $entity)
                    <div class="admin-page-line" style="margin-left: 30px">
                        <p> Entity: </p>
                        <p>{{ $entity->entity }}</p>
                        <div class="admin-buttons-container">
                            <form action="{{ route('entity.destroy', $entity->entity) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="button" id="admin-delete-button">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
            @if ($fields != null)
                @foreach($fields as $field)
                    <div class="admin-page-line" style="margin-left: 30px">
                        <p> Field: </p>
                        <p>{{ $field->field }}</p>
                        <div class="admin-buttons-container" style="width: 250px; margin-right: 40px">
                            <a href="{{ route('custom_fields.edit', $field->field) }}"><button class="button" id="admin-edit-button">Edit</button></a>
                            <form action="{{ route('custom_fields.destroy', $field->field) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="button" id="admin-delete-button">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </section>

@endsection
