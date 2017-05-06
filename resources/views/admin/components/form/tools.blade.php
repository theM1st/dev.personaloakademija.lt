<div class="btn-group">{{--
--}}<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-menu-hamburger"></span></button>{{--
--}}<ul class="dropdown-menu dropdown-menu-right">{{--
    --}}@foreach ($tools as $name => $address){{--
    --}}@if ($name != 'delete'){{--
            --}}<li><a href="{{ $address }}" class="btn btn-link">{{ trans('admin.page.edit') }}</a></li>{{--
    --}}@else{{--
            --}}<li> {{ Form::open(['url' => $address, 'method' => 'DELETE']) }} <button class="btn btn-link" onclick="return confirm('Ar tikrai?')">{{ trans('admin.page.delete') }}</button> {{ Form::close() }}</li> @endif{{--
    --}}@endforeach{{--
--}}</ul></div>