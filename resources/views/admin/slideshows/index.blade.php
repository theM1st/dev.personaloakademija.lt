@extends('layouts.admin')

@section('content')
    <div class="row">
        @foreach ($slideshows as $item)
            <div class="col-sm-4">
                <img src="\{{ $item->image }}" alt="" class="img-responsive">
                <div>
                    {{ Form::open(['route' => ['admin.slideshow.destroy', $item->id], 'method' => 'delete', 'style' => 'display:inline']) }}
                        <button class="btn btn-link">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    {{ Form::close() }}
                    <a href="{{ route('admin.slideshow.edit', $item->id) }}" class="btn btn-link pull-right">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection