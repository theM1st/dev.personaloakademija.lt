<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Komentarai</h4>
</div>
<div class="modal-body">
    <table class="table table-striped">
        <tbody>
        @foreach ($cv->comments()->has('user')->where('comment', '!=', '')->get() as $c)
            <tr>
                <td>
                    {{$c->user->firstname}} {{$c->created_at->format('Y-m-d')}}<br>
                    {{$c->comment}}
                </td>
                @if (\Auth::check() && \Auth::user()->isAdmin())
                    <td>
                        {!! Form::open(['action' => ['CvCommentsController@destroy', $c->id], 'method' => 'delete', 'class'=>'form-horizontal', 'onsubmit' => 'return confirm("Ar tikrai ištrinti?")']) !!}
                            <button type="submit" class="btn btn-danger btn-xs">Trinti</button>
                        {!! Form::close() !!}
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
</div>