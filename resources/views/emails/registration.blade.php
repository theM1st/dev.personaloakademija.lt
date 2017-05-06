@extends('emails.wrapper')

@section('content')
    <table cellpadding="0" cellspacing="0" width="850" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
        <tr>
            <td height="20" width="850" bgcolor="#004265" style="border: none; padding-top: 23px; padding-right: 17px; padding-bottom: 24px; padding-left: 17px;">
            </td>
        </tr>
	    <tr>
	        <td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;">
	            <p style="margin-top:30px; margin-bottom: 28px; font-weight: bold; font-size: 19px; color: #1366A5;">
                   Sveiki, {{$firstname}}.
                </p>
                <p style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">
                    Sveikiname, dabar Jūs esate svetainės vartotojas.
                </p>
                <p style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">
                    Prisijungti prie svetainės {!! Html::linkRoute("auth.login", 'personaloakademija.lt') !!} galite naudojant savo duomenis:
                </p>
	            <p style="margin-top: 0; margin-bottom: 20px; line-height: 20px;">
                    Prisijungimo vardas: {{$email}}<br />
                    Slaptažodis: {{$password}}
                </p>
	        </td>
	    </tr>
	    <tr>
        <td height="40px" width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 30px; padding-left: 44px;">
            @include('emails.footer')
        </td>
        </tr>
	</table>
@endsection