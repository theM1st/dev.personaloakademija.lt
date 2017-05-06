@extends('app')

@section('title', "Baneriai -")

@section('content')
    <div class="banners">
        <h1>Baneriai</h1>

        <div><a href="{{action('BannersController@create')}}" class="btn btn-primary">Sukurti naują banerį</a></div>
        <br>

        <h3>Baneriai kairėje</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:30px"></th>
                    <th></th>
                    <th>Pavadinimas</th>
                    <th>Nuoroda</th>
                    <th style="width:150px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leftBanners as $k => $b)
                    <tr>
                        <td style="vertical-align: middle">
                            @if ($k > 0)
                                <a href="{{action('BannersController@move', [$b->id, 'up'])}}" style="display: block;font-size: 18px"><span class="glyphicon glyphicon-triangle-top"></span></a>
                            @endif
                            @if ($k+1 < $leftBanners->count())
                                <a href="{{action('BannersController@move', [$b->id, 'down'])}}" style="display: block;font-size: 18px"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
                            @endif
                        </td>
                        <td style="width:100px;vertical-align: middle">
                            <a href="{{$b->banner_link}}" target="_blank">
                                <img src="{{$b->getImage()}}" style="width:100px">
                            </a>
                        </td>
                        <td style="vertical-align: middle">{{$b->banner_name}}</td>
                        <td style="vertical-align: middle">{{$b->banner_link}}</td>
                        <td style="vertical-align: middle">
                            {!! Form::open(['action' => ['BannersController@destroy', $b->id], 'method' => 'delete', 'class'=>'form-horizontal', 'onsubmit' => 'return confirm("Ar tikrai ištrinti?")']) !!}
                                {!! Html::linkAction('BannersController@edit', 'Redaguoti', ['id' => $b->id], ['class' => "btn-link btn-sm"]) !!}

                                <button type="submit" class="btn-link btn-sm delete-offer">Trinti</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Baneriai dešinėje</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="width:30px"></th>
                    <th></th>
                    <th>Pavadinimas</th>
                    <th>Nuoroda</th>
                    <th style="width:150px"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rightBanners as $k => $b)
                    <tr>
                        <td style="vertical-align: middle">
                            @if ($rightBanners->count() > 1)
                                @if ($k > 0)
                                    <a href="{{action('BannersController@move', [$b->id, 'up'])}}" style="display: block;font-size: 18px"><span class="glyphicon glyphicon-triangle-top"></span></a>
                                @endif
                                @if ($k+1 < $rightBanners->count())
                                    <a href="{{action('BannersController@move', [$b->id, 'down'])}}" style="display: block;font-size: 18px"><span class="glyphicon glyphicon-triangle-bottom"></span></a>
                                @endif
                            @endif
                        </td>
                        <td style="width:100px;vertical-align: middle">
                            <a href="{{$b->banner_link}}" target="_blank">
                                <img src="{{$b->getImage()}}" style="width:100px">
                            </a>
                        </td>
                        <td style="vertical-align: middle">{{$b->banner_name}}</td>
                        <td style="vertical-align: middle">{{$b->banner_link}}</td>
                        <td style="vertical-align: middle">
                            {!! Form::open(['action' => ['BannersController@destroy', $b->id], 'method' => 'delete', 'class'=>'form-horizontal', 'onsubmit' => 'return confirm("Ar tikrai ištrinti?")']) !!}
                                {!! Html::linkAction('BannersController@edit', 'Redaguoti', ['id' => $b->id], ['class' => "btn-link btn-sm"]) !!}

                                <button type="submit" class="btn-link btn-sm delete-offer">Trinti</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection