@extends('emails.wrapper')

@section('content')
    <table cellpadding="0" cellspacing="0" width="850" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
        <tr>
            <td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;">
                <p style="margin: 30px 0">Sveiki, {{$offer->user->name}}.</p>

                <p>Dėkojame už sukurtą naują <b>{{$offer->work_position}}</b> darbo pasiūlymo skelbimo sukūrimą. Netrukus jis bus paskelbtas.</p>
                <p><span style="color: #337ab7; font-weight: bold;">Okay<span style="color: #239a58;">CV</span></span> Jums linki gerų kandidatų!</p>
            </td>
        </tr>
        <tr>
            <td height="40px" width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 30px; padding-left: 44px;">
                @include('emails.footer')
            </td>
        </tr>
    </table>
@endsection