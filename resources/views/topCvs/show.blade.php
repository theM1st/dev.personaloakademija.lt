@extends('app')

@section('title', $cv->cv_name)

@section('content')
    <div class="top-cv-profile">
        @if (request()->has('updated'))
            <div class="alert alert-success text-center" role="alert">
                CV sėkmingai atnaujintas
            </div>
        @endif
        @include('topCvs.partials.cv')
        <div class="clearfix tools">
            <a href="#" class="btn btn-link btn-bookmark-cv"
               onclick="event.preventDefault();
                document.getElementById('bookmark-form').submit();">
                @if (!auth()->check() || !auth()->user()->bookmarks->contains($cv->id))
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <span>Pažymėti kandidatą kaip tinkamą</span>
                @else
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <span>Atžymėti kandidatą kaip tinkamą</span>
                @endif
            </a>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#order-cv" style="margin-left:40px">
                Užsakyti tinkamus CV
            </button>
            <a href="{{ route('topCv.index') }}" class="btn btn-default pull-right">Grįžti į CV sąrašą</a>

            {{ Form::open(['route' => ['topCv.addBookmark', $cv->id], 'id' => 'bookmark-form']) }}
            {{ Form::close() }}
        </div>
        @if (auth()->check() && auth()->user()->isAdminWorker())
            <div class="text-center">
                <hr>
                <a href="{{ route('topCvs.pdf', $cv->id) }}" class="btn btn-secondary">PDF formatas</a>
                <a href="{{ route('topCvs.edit', $cv->id) }}" class="btn btn-primary">Redaguoti</a>
                {{ Form::open(['route' => ['topCvs.destroy', $cv->id], 'method' => 'delete', 'style' => 'display:inline']) }}
                    {{ Form::submit('Trinti', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Ar tikrai?')"]) }}
                {{ Form::close() }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="order-cv" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Tinkamų kandidatų užklausos forma</h4>
                </div>
                <div class="modal-body">
                    @if (auth()->check() && auth()->user()->bookmarks->count())
                        {{ Form::open(['route'=>'topCv.order', 'id'=>'bookmark-form', 'class'=>'ajax-form']) }}
                            <div class="form-group">
                                <p>Jūsų pažymėti kandidatai, su kuriais norėtumėte susitikti darbo pokalbyje:</p>
                                <p>
                                    @foreach (auth()->user()->bookmarks as $k => $item)
                                        <span class="label label-primary" style="font-size: 13px">{{ $item->id }}</span>
                                    @endforeach
                                </p>
                            </div>
                            <div class="form-group">
                                {{ Form::label('company_name', 'Jūsų įmonės pavadinimas', ['class' => 'required']) }}
                                {{ Form::text('company_name', null, ['class' => 'form-control input-sm']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('name', 'Jūsų vardas, pavardė', ['class' => 'required']) }}
                                {{ Form::text('name', null, ['class' => 'form-control input-sm']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('work_position', 'Pareigos (vadovaujančios)', ['class' => 'required']) }}
                                {{ Form::text('work_position', null, ['class' => 'form-control input-sm']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email', 'El. paštas (tik darbinis)', ['class' => 'required']) }}
                                {{ Form::text('email', null, ['class' => 'form-control input-sm']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('telephone', 'Telefono nr.') }}
                                {{ Form::text('telephone', null, ['class' => 'form-control input-sm']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('message', 'Žinutės tekstas', ['class' => 'required']) }}
                                {{ Form::textarea('message', null, ['class' => 'form-control input-sm', 'rows' => 3]) }}
                            </div>
                            <div class="form-group text-center">
                                {{ Form::submit('Išsiųsti', ['class' => 'btn btn-secondary']) }}
                            </div>
                        {{ Form::close() }}
                    @else
                        <p class="text-center">Jūsų tinkamų kandidatų sąrašas tuščias.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection