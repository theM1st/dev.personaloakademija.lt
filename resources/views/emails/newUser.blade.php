@extends('emails.wrapper')

@section('content')
    <table cellpadding="0" cellspacing="0" width="850" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
	    <tr>
	        <td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;">
	            <p style="margin-top:30px; margin-bottom: 20px;">
                   Sveiki,
                </p>
                <div style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">
                        Personalo akademija CV duomenų bazėje įsiregistravimo  laukia naujas kandidatas -
                        <p><b>Lytis:</b> {{$cv->genderName}}</p>
                        <p><b>Amžius:</b> {{$cv->age}}</p>
                        <p><b>Gyvenimo miestas:</b> {{$cv->jobCity}}</p>
                </div>
	        </td>
	    </tr>
	</table>
@endsection