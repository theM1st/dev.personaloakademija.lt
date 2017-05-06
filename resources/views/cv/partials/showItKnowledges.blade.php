@foreach ($itknowledges as $item)
    <div class="row section-group">
        <div class="col-sm-6 section-label">{{$item['category']->name}}:</div>
        <div class="col-sm-5 section-value">
        @foreach ($item['knowledges'] as $knowledge)
            @if (isset($knowledge->knowledge->name))
                <div>
                    {{$knowledge->knowledge->name}}
                    @if (!empty($knowledge->levelName))
                        (<i>{{$knowledge->levelName}}</i>)
                    @endif
                </div>
            @elseif ($knowledge->knowledge_name)
                <div><strong>Kita:</strong> {{$knowledge->knowledge_name}}</div>
            @endif
        @endforeach
        </div>
    </div>
@endforeach