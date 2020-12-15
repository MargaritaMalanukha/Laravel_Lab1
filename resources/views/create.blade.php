@extends('layout')

@section('content')

    <section class="admin-title">
        <h1>Create Page</h1>
    </section>

    <section class="admin-panel-container">
        <div class="admin-panel-block" style="align-items: center">
            <form action="{{ route('page.store') }}" method="POST" >
                @csrf

                <div class="row" style="margin-bottom: 50px; margin-top: 50px; display: flex; flex-direction: column; align-items: center">
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>Page Code:</strong>
                            <input type="text" name="pageCode" class="form-control">
                        </div>
                    </div>
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>CaptionUA:</strong>
                            <input type="text" name="captionUA" class="form-control">
                        </div>
                    </div>
                    <div class="admin-page-line">
                        <div class="form-group">
                            <strong>CaptionRU:</strong>
                            <input type="text" name="captionRU" class="form-control">
                        </div>
                    </div>
                    <div class="admin-page-line" style="height: 140px">
                        <div class="form-group">
                            <strong>ContentUA:</strong>
                            <textarea class="form-control" style="height:100px" name="contentUA"></textarea>
                        </div>
                    </div>
                    <div class="admin-page-line" style="margin-bottom: 40px">
                        <div class="form-group">
                            <strong>ContentRU:</strong>
                            <textarea class="form-control" style="height:100px" name="contentRU"></textarea>
                        </div>
                    </div>
                    <div class="admin-page-line" style="margin-bottom: 40px">
                        <div class="form-group">
                            <strong>Image for container:</strong>
                            <input type="text" name="imageMain" class="form-control">
                        </div>
                    </div>
                    <div class="admin-page-line" style="margin-bottom: 50px">
                        <div class="form-group">
                            <strong>Parent Code:</strong>
                            <input type="text" name="parentCode" class="form-control">
                        </div>
                    </div>
                    <div class="admin-page-line" style="margin-bottom: 40px">
                        <div class="form-group">
                            <strong>Display as:</strong>
                            <select name="container">
                                <option value="page">page</option>
                                <option value="container item">tile</option>
                            </select>
                        </div>
                    </div>
                    <div class="admin-page-line" style="height: 400px">
                        <div class="form-group" style="height: 400px">
                            <strong>Images URL:</strong>
                            <div class="input-images-wrapper">
                                <input type="text" name="firstPic" class="form-control">
                                <input type="text" name="secondPic" class="form-control">
                                <input type="text" name="thirdPic" class="form-control">
                                <input type="text" name="fourthPic" class="form-control">
                                <input type="text" name="fifthPic" class="form-control">
                                <input type="text" name="sixthPic" class="form-control">
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
