@if ($documents->count())
    @foreach ($documents as $d)
        <div class="row section-group">

            <div class="col-sm-6 section-value text-right">

                {!! Form::open(['action' => ['CvController@deleteDocument', $d->id], 'method' => 'delete', 'onsubmit' => 'return confirm("Ar tikrai ištrinti?")']) !!}
                    <span class="glyphicon glyphicon-file"></span>&nbsp;<a href="{{$d->fullpath}}" target="_blank" title="Atsisiųsti dokumentą">{{$d->filename}}</a>
                    <button type="submit" class="btn btn-link btn-sm delete-cvdocument">Trinti</button>
                {!! Form::close() !!}
            </div>
        </div>
    @endforeach
@endif