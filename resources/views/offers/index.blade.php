@extends('app')

@section('title', "Darbo ir praktikos pasiūlymai -")

@section('content')
    <div class="offers">
        <h1>
            @if (isset($filter['offerType']) && $filter['offerType'] == 'hot')
                Karšti pasiūlymai
            @else
                Darbo pasiūlymai
            @endif
            ({{$offers->total()}})
        </h1>
        @include('offers.partials.list')

        <div class="text-center">{!! $offers->render() !!}</div>
    </div>
@endsection