@extends('app')

@section('title', 'Kandidatai -')

@section('content')
    <div class="offer-candidates-index">
        <a href="{{ action('OffersAdminController@index') }}" class="btn btn-sm btn-secondary">Grįžti atgal</a>
        <h4>
             Kandidatai pagal darbo pasiūlymą „{{$offer->work_position}}” <span>({{ $offer->cities()->pluck('name_'.Lang::locale())->implode(', ') }})</span>
        </h4>
        @if ($offer->candidates->count() > 0)
            {!! Form::open(['action' => ['CandidatesController@destroyAll'], 'method' => 'delete', 'id'=>'deleteCandidates', 'onsubmit' => 'return confirm("Ar tikrai norite ištrinti?")']) !!}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="3" class="actions">
                            {!! Form::button('Trinti pasirinktus kandidatus', ['class' => 'btn btn-sm btn-link', 'onclick'=>"$('#deleteCandidates').submit()"]) !!}
                            <input type="checkbox">
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($offer->candidates as $c)
                    <tr>
                        <td class="date">{{$c->updated_at->format('Y-m-d')}}</td>
                        <td class="name"><a href="{{route('cv_preview', ['id' => $c->cv_id])}}" target="_blank">{{$c->cv->name}}</a></td>
                        <td class="actions">
                            <a href="{{action('CandidatesController@setComment', ['id' => $c->cv_id])}}" class="btn btn-sm btn-link" title="Rašyti komentarą" onclick="return writeCandidateComment({{$c->id}})" style="margin:0">
                                <span class="glyphicon glyphicon-comment"></span>
                            </a>
                            <a href="{{route('cv_preview', ['id' => $c->cv_id])}}?format=pdf" class="btn btn-sm btn-link" target="_blank" title="Išsaugoti CV">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                            </a>
                            <div class="candidate-rating" title="Kandidato įvertinimas">
                                <div class="slider" data-value="{{$c->rating}}" data-url="{{action('CandidatesController@setRating', [$c->id, 0])}}"></div>
                            </div>
                            <a href="mailto:{{$c->cv->user->email}}" class="btn btn-sm btn-link" title="Siųsti kandidatui laišką" style="margin-left:20px">
                                <span class="glyphicon glyphicon-envelope"></span>
                            </a>
                            <a href="#" onclick="printCv('{{route('cv_preview', ['id' => $c->cv_id])}}?format=pdf')" title="Spausdinti CV" class="btn btn-sm btn-link">
                                <span class="glyphicon glyphicon-print"></span>
                            </a>
                            <a href="mailto:?subject=CV „{{$c->cv->cv_name}}”&body=Kandidato cv {{route('cv_preview', ['id' => $c->cv_id])}}" title="Persiųsti bendradarbiui" class="btn btn-sm btn-link">
                                <span class="glyphicon glyphicon-share"></span>
                            </a>
                            <a href="{{action('CandidatesController@destroy', ['id' => $c->id, 'token' => md5('candidate'.$c->id)])}}" title="Trinti CV" onclick="return confirm('Ar tikrai norite ištrinti šį kandidatą?')" class="btn btn-sm btn-link">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            {!! Form::checkbox('candidate[]', $c->id) !!}
                            <div class="candidate-comment" id="candidate-comment{{$c->id}}">
                                <span>{{str_limit($c->comment, 100)}}</span>
                                <div class="candidate-comment-form" style="display: none">
                                    <textarea class="form-control" rows="2" placeholder="Įrašyti komentarą" data-url="{{action('CandidatesController@setComment', ['id' => $c->id])}}">{{$c->comment}}</textarea>
                                    <a href="" class="btn btn-sm">Išsaugoti</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! Form::close() !!}
        @endif
    </div>
@endsection

@section('scripts')
    <script>

        function writeCandidateComment(candidateId) {
            var form = $('#candidate-comment'+candidateId).find('.candidate-comment-form');

            var comment = $('#candidate-comment'+candidateId).find('span').hide();
            form.show();

            form.find('textarea').blur(function() {
                $.get($(this).attr('data-url')+'/'+$(this).val(), function(response) {
                    comment.text(response.comment);
                });
            });

            form.find('a.btn').click(function(e) {
                e.preventDefault();
                form.hide();
                comment.show();
            });

            return false;
        }

        $('.offer-candidates-index th.actions input').click(function () {
            var checked = $(this).prop('checked');
            $('.offer-candidates-index td').find(':checkbox').prop('checked', checked);
        });

        $('.candidate-rating .slider').slider({
            orientation: "horizontal",
            range: "min",
            min: 0,
            max: 10,
            create: function() {
                $(this).slider('value', $(this).attr('data-value'));
                $(this).find('.ui-slider-handle').html('<span>'+$(this).attr('data-value')+'</span>');
            },
            slide: function( event, ui ) {
                $(this).find('.ui-slider-handle').html('<span>'+ui.value+'</span>');
            },
            stop: function( event, ui ) {
                $.get($(this).attr('data-url')+'/'+ui.value);
            }
        });
    </script>
@endsection