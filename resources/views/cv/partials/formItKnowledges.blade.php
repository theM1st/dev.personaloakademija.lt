@include('errors.list')
<div class="it-knowledges">
    {!! Form::open(['class' => 'col-sm-offset-1 form-horizontal']) !!}
        @foreach($categories as $c)
            <p><strong>{{$c->name}}</strong></p>
            @foreach($c->knowledges() as $k)
                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-3">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="knowledge[{{$c->id}}][{{$k->id}}]" value="1" @if(isset($knowledges[$k->id])) checked @endif> {{$k->name}}
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        {!! Form::select("knowledge_level[$c->id][$k->id]", $knowledgeLevels, (isset($knowledges[$k->id]) ? $knowledges[$k->id] : null), ['class' => 'form-control input-xs']) !!}
                    </div>
                </div>

            @endforeach
            <div class="form-group">
                {!! Form::label("another[$c->id]", 'Kita', ['class' => 'col-sm-offset-1 col-sm-3 control-label', 'style' => 'text-align: left']) !!}
                <div class="col-sm-4">
                    {!! Form::textarea("another[$c->id]", (isset($anothers[$c->id]) ? $anothers[$c->id]->knowledge_name : null), ['rows' => '1', 'class' => 'form-control input-sm', 'placeholder' => 'Įrašyti']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Form::select("another_level[$c->id]", $knowledgeLevels, (isset($anothers[$c->id]) ? $anothers[$c->id]->knowledge_level : null), ['class' => 'form-control input-xs']) !!}
                </div>
            </div>
            <br>
        @endforeach

        <div class="form-group row" style="margin-bottom: 10px">
            <div class="col-sm-offset-3 col-sm-5">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::submit('Išsaugoti ir toliau', ['class' => 'btn btn-primary btn-sm']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::button('Praleisti ir toliau', ['class' => 'btn btn-secondary btn-sm', 'onclick'=>"skipState($cv->id, $currentState)"]) !!}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</div>
@section('scripts')

<script type="text/javascript">
    $().ready(function() {

    });
</script>
@endsection
