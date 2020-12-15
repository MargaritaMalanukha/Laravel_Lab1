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
                    @if($page->container == 'page')
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
                    @endif
                    <div class="admin-page-line" style="margin-bottom: 50px">
                        <div class="form-group">
                            <strong>Image for container:</strong>
                            <input type="text" name="imageMain" class="form-control" value="{{$page->imageMain}}">
                        </div>
                    </div>
                    <div class="admin-page-line" style="margin-bottom: 50px">
                        <div class="form-group">
                            <strong>Parent Code:</strong>
                            <input type="text" name="parentCode" class="form-control" value="{{$page->parentCode}}">
                        </div>
                    </div>
                    @if($page->container == 'page')
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
                    @endif
                    @if($page->aliasAt != null)
                        <div class="admin-page-line">
                            <div class="form-group">
                                <strong>Page refer to:</strong>
                                <input type="text" name="aliasAt" class="form-control" value="{{$page->aliasAt}}">
                            </div>
                        </div>
                    @endif
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
