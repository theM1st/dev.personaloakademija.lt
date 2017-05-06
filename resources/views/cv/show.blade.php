@extends('app')

@section('title', 'Mano CV -')

@section('content')
    <div class="my-cv">
        <h1>Mano CV</h1>

        @if ($updated === '')
            <div class="alert alert-info text-center" role="alert">
                Jūsų CV sėkmingai atnaujintas.
            </div>
        @endif
        <div class="text-center tools">
            <a href="{{ route("cv_edit", ['id'=>$cv->id, 'state' => 1, '#section1']) }}" title="Redaguoti CV" class="btn btn-primary btn-sm">
                Redaguoti CV
            </a>
            <a href="{{ action('CvController@preview', ['id' => $cv->id]) }}" class="btn btn-secondary btn-sm action-modal" data-method="get" style="margin-left: 20px">
                Peržiūrėti CV
            </a>
            <a href="{{ action('CvController@delete', $cv->id) }}" class="btn btn-danger btn-sm action-modal" data-size="modal-sm" data-method="get" style="width: 100px; margin-left: 20px">
                Trinti CV
            </a>
            <span>
                <a href="javascript:void(0)" class="btn cv-print-btn" onclick="printCv('{{ action('CvController@preview', ['id' => $cv->id, 'format' => 'pdf']) }}')" title="Spausdinti CV">
                    <span class="glyphicon glyphicon-print"></span>
                </a>
                <a href="{{ action('CvController@preview', ['id' => $cv->id, 'format' => 'pdf']) }}" class="btn cv-save-btn" title="Išsaugoti CV kaip pdf">
                    <span class="glyphicon glyphicon-floppy-save"></span>
                </a>
            </span>
        </div>
        @foreach ($states as $nr => $s)
            @if (isset($s['name']))
                <div class="section">
                    <div class="section-title">
                        <div class="row">
                            <div class="col-sm-11"><h4>{{$s['name']}}</h4></div>
                            <?php /*
                            @if ($nr != 12)
                                <div class="col-sm-1">
                                    <a href="{{ route("cv_edit", ['id'=>$cv->id, 'state' => $nr, '#section'.$nr]) }}" title="Redaguoti - {{$s['name']}}" class="section-edit">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                </div>
                            @endif */ ?>
                        </div>
                    </div>

                    @if ($nr == 1)
                        @include('cv.partials.showPersonal')
                    @elseif ($nr == 2)
                        @include('cv.partials.showCvInfo')
                    @elseif ($nr == 3)
                        @include('cv.partials.showStudies')
                    @elseif ($nr == 4)
                        @include('cv.partials.showWorks')
                    @elseif ($nr == 5)
                        @include('cv.partials.showLanguages')
                    @elseif ($nr == 6)
                        @include('cv.partials.showItKnowledges')
                    @elseif ($nr == 7)
                        @include('cv.partials.showCharacteristics')
                    @elseif ($nr == 8)
                        @include('cv.partials.showParticipations')
                    @elseif ($nr == 9)
                        @include('cv.partials.showRecomendations')
                    @elseif ($nr == 10)
                        @include('cv.partials.showExtraInfos')
                    @endif
                </div>
            @endif
        @endforeach
        <hr>
        <p class="text-center">
            <a href="{{ route("cv_edit", ['id'=>$cv->id, 'state' => 1, '#section1']) }}" title="Redaguoti CV" class="btn btn-primary btn-sm" style="margin-right: 20px">
                Redaguoti CV
            </a>
            <a href="{{action('CvController@preview', ['id' => $cv->id])}}" class="btn btn-secondary btn-sm action-modal" data-method="get">
                Peržiūrėti CV
            </a>
        </p>

    </div>
@endsection