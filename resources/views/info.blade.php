@extends('layout')


@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <a class="button" id="admin-create-button" href="../../site/{{$page->parentCode}}/ua" style="width: 150px; margin-bottom: 0">GO BACK</a>

	<section class="main" style="margin-top: 40px">

        <div class="img-container" id="container-1">
            @foreach($image as $i)
                @if($loop->iteration <= 3)
                    <img src="{{ $i->imageCode }}">
                @else
                    <img src="{{ $i->imageCode }}" class="undisplayed-img">
                @endif
            @endforeach
        </div>

		<div class="block-container">
			<div class="block2" id="intro">
				<div id="intro-wrapper">
					<div id="intro-title">
                        @if($lang == 'ua')
                            {{ $page->captionUA }}
                        @else
                            {{ $page->captionRU }}
                        @endif</div>
					<div class="buttons">
						<div class="button" id="button-call">
							<img src="../../../img/phone2.png">
						</div>
						<div class="button" id="main-button">
                            @if($lang == 'ua')
							    <div id="main-button-text">ВІДПРАВИТИ<br>ЗАЯВКУ</div>
                            @else
                                <div id="main-button-text">ОТПРАВИТЬ<br>ЗАЯВЛЕНИЕ</div>
                            @endif
						</div>
					</div>
				</div>
			</div>
			<div class="block2" id="info">
				<div class="info-wrapper">
                    @if($lang == 'ua')
					    {!! $page->contentUA !!}
                    @else
                        {!! $page->contentRU !!}
                    @endif
                    @if($fields != null)
                        @foreach($fields as $field)
                            {{ $field->fieldName }}: {{ $field->value }} <br/>
                        @endforeach
                        @endif
				</div>
			</div>
		</div>

    <div class="img-container" id="container-2">
        @foreach($image as $i)
            @if($loop->iteration > 3)
            <img src="{{ $i->imageCode }}">
            @endif
        @endforeach
    </div>
	</section>
@endsection
