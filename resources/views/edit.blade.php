@extends('layout')

@section('content')

    <section class="admin-title">
        <h1>Edit Page</h1>
    </section>

    <section class="admin-panel-container">
        <div class="admin-panel-block" style="align-items: center">
            <form action="{{ route('page.update', $page->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row" style="margin-bottom: 50px; margin-top: 50px; display: flex; flex-direction: column; align-items: center">
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>Page Code:</strong>
                            <input type="text" name="code" class="form-control" value="{{ $page->code }}">
                        </div>
                    </div>
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>CaptionUA:</strong>
                            <input type="text" name="captionUA" class="form-control" value="{{$page->captionUA }}">
                        </div>
                    </div>
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>CaptionRU:</strong>
                            <input type="text" name="captionRU" class="form-control" value="{{$page->captionRU}}">
                        </div>
                    </div>
                    <div class="admin-page-line" style="height: 140px">
                        <div class="form-group">
                            <strong>ContentUA:</strong>
                            <textarea class="form-control" style="height:100px" name="contentUA">{{ $page->contentUA }}</textarea>
                        </div>
                    </div>
                    <div class="admin-page-line" style="margin-bottom: 50px">
                        <div class="form-group">
                            <strong>ContentRU:</strong>
                            <textarea class="form-control" style="height:100px" name="contentRU">{{ $page->contentRU }}</textarea>
                        </div>
                    </div>
                    <div class="admin-page-line" style="height: 400px">
                        <div class="form-group" style="height: 400px">
                            <strong>Images URL:</strong>
                            <div class="input-images-wrapper">
                                @foreach($images as $image)
                                    <input type="text" name="{{ $loop->iteration }}Pic" class="form-control" value="{{$image->imageCode}}">
                                @endforeach
                            </div>
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
                </div>

            </form>
        </div>
    </section>

@endsection
