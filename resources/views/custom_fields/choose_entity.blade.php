@extends('layout')

@section('content')

    <section class="admin-title">
        <h1>Create Page</h1>
    </section>

    <section class="admin-panel-container">
        <div class="admin-panel-block" style="align-items: center">
            <form action="/page/create/custom_fields" method="POST">
                @csrf
                <div class="row" style="margin-bottom: 50px; margin-top: 50px; display: flex; flex-direction: column; align-items: center">
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>Choose entity:</strong>
                            <select name="entity">
                                <option value="none">none</option>
                                @foreach($entities as $entity)
                                    <option value="{{ $entity->entity }}">{{ $entity->entity }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="admin-page-line" style="margin-top: 30px">
                    <button type="submit" class="button" id="store-button">Submit</button>
                </div>
            </form>
        </div>
    </section>

@endsection
