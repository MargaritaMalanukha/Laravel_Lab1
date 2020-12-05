@extends('layout')


@section('content')

	<section class="main">

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
							<div id="main-button-text">ВІДПРАВИТИ<br>ЗАЯВКУ</div>
						</div>
					</div>
				</div>
			</div>
			<div class="block2" id="info">
				<div class="info-wrapper">
                    @if($lang == 'ua')
					    {{ $page->contentUA }}
                    @else
                        {{ $page->contentRU }}
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
