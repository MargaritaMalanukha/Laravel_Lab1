@extends('layout')

@section('content')

    <section class="container-title-wrapper">
    @if($parentCode != 'error')
        <a class="button" id="admin-create-button" href="../../site/{{$parentCode}}/ua">GO BACK</a>
    @endif
        <div class="ordering-wrapper">
            <p style="margin-top: 10px">Order by:</p>
            <form action="/site/{{$pages[0]->parentCode}}/ua" method="POST" >
                @csrf
                <select name="order">
                    @foreach($options as $option)
                        <option value="{{ $option }}">{{ $option }}</option>
                    @endforeach
                </select>
                <button type="submit" class="button" id="admin-delete-button">Order</button>
            </form>
        </div>
    </section>

    <section class="main-part" style="margin-top: 40px">
        @foreach($pages as $page)
                <a href="/site/{{ $page->code}}/ua"><div class="block">
                        @if ($lang == 'ua')
                            <div class="block-text-wrapper"><div class="block-text">{{ $page->captionUA }}</div></div>
                        @else
                            <div class="block-text-wrapper"><div class="block-text">{{ $page->captionRU }}</div></div>
                        @endif
                    <img src="{{ $page->imageMain }}">
                </div></a>
        @endforeach
    </section>

@endsection
