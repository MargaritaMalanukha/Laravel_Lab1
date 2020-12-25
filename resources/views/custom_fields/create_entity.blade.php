@extends('layout')

@section('content')

    <section class="admin-title">
        <h1>Create Field</h1>
    </section>

    <section class="admin-panel-container">
        <div class="admin-panel-block" style="align-items: center">
            <form action="{{ route('entity.store') }}" method="POST">
                @csrf
                <div class="admin-page-line" style="margin-top: 50px">
                    <div class="form-group">
                        <strong>Entity name:</strong>
                        <input type="text" name="entity" class="form-control">
                    </div>
                </div>
                <div class="admin-page-line" style="margin-top: 30px">
                    <button type="submit" class="button" id="store-button">Submit</button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </form>
        </div>
    </section>

@endsection
