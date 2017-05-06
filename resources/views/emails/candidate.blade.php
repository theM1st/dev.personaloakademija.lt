@extends('emails.wrapper')

@section('content')
<style>
    a, a:visited {
        color: #003366;
    }
</style>
<table cellpadding="0" cellspacing="0" width="850" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
    <tr>
	    <td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding: 15px;">
	        <table>
	            <tr>
	                <td width="150">
	                    <a href="http://www.okaycv.lt">
                            <img src="{{asset('assets/img/logo.png')}}" />
                        </a>
	                </td>
	                <td width="700" bgcolor="#d9edf7" style="border: 1px solid #bce8f1; padding: 10px; line-height:24px;">
                        <p style="margin-top:0;margin-bottom: 4px">Vartotojas kandidatavo į darbo pasiūlymo skelbimą</p>
                        <div style="font-weight: bold; font-size: 16px; margin-top: 20px; text-align: center">
                            <a href="{{route("offers_show", ['id' => $offer->id])}}">{{$offer->work_position}}</a>
                        </div>
	                </td>
	            </tr>
	        </table>
            <div style="margin-top: 30px">
                Naujo kandidato CV galite peržiūrėti:
                <a href="{{route('cv_show', ['id' => $user->cv->id])}}?token={{$user->cv->token}}" target="_blank">
                    {{route('cv_show', ['id' => $user->cv->id])}}?token={{$user->cv->token}}
                </a>
            </div>

        </td>
    </tr>
    <tr>
        <td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding: 15px;">
            @include('emails.footer', ['logo'=>false])
        </td>
    </tr>
</table>
@endsection
