@extends('emails.wrapper')

@section('content')
    <table cellpadding="0" cellspacing="0" width="850" style="background-color: #d1d1d1; border-radius: 2px; border:1px solid #d1d1d1; margin: 0 auto;" border="1" bordercolor="#d1d1d1">
        <tr>
            <td height="20" width="850" bgcolor="#004265" style="border: none; padding-top: 23px; padding-right: 17px; padding-bottom: 24px; padding-left: 17px;color:#ffffff;text-align: center;font-size:24px">
                Tinkamų kandidatų užklausos forma
            </td>
        </tr>
        <tr>
            <td width="850" bgcolor="#f7f7f7" valign="top" style="border: none; padding-top: 0; padding-right: 44px; padding-bottom: 16px; padding-left: 44px;">
                <p style="margin-bottom: 0; margin-top: 20px; line-height: 20px;">
                    Pažymėti kandidatai:<br>
                    @foreach (auth()->user()->bookmarks as $k => $item)<span>{{ $k > 0 ? ', ' : '' }}{{ $item->id }}</span>@endforeach
                </p>
                <p style="margin-bottom: 0; margin-top: 20px; line-height: 20px;">
                    Įmonės pavadinimas:
                    {{ $data['company_name'] }}
                </p>
                <p style="margin-bottom: 0; margin-top: 20px; line-height: 20px;">
                    Vardas, pavardė:
                    {{ $data['name'] }}
                </p>
                <p style="margin-bottom: 0; margin-top: 20px; line-height: 20px;">
                    Pareigos (vadovaujančios):
                    {{ $data['work_position'] }}
                </p>
                <p style="margin-bottom: 0; margin-top: 20px; line-height: 20px;">
                    Telefono nr.:
                    {{ $data['telephone'] }}
                </p>
                <p style="margin-bottom: 0; margin-top: 20px; line-height: 20px;">
                    Žinutės tekstas:
                    {{ $data['message'] }}
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