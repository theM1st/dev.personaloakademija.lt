<!DOCTYPE html>
<html lang="{{Lang::locale()}}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title') Personalo akademija</title>

	<link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" media="all">
	<link href="{{ asset('/css/jquery-ui.min.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/app.css') }}?v=201706071" rel="stylesheet" media="all">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

	<link href="{{ asset('/css/bootstrap-multiselect.css') }}" rel="stylesheet">
	@yield('styles')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>