<table class="table table-striped">
    @foreach ($cvs as $cv)
    <tr>
        <td class="cv-logo">
            <div class="cell">
                @if ($cv->photos()->getPhoto())
                <div class="offer-logo">
                    <a href="{{route('cv_preview', ['id' => $cv->id])}}">
                        <img src="{{$cv->photos()->getPhoto()}}" alt="">
                    </a>
                </div>
                @endif
            </div>
        </td>
        <td class="cv-name">
            <div class="cell">
                <div class="row">
                    <div class="col-sm-8">
                        <a href="{{route('cv_preview', ['id' => $cv->id])}}">
                            <h4 style="margin-top:0">
                                {{$cv->cv_fullname}}
                                @if ($cv->documents()->count())
                                <span class="glyphicon glyphicon-paperclip" title="Sertifikatai, pažymėjimai, atestatai, pagyrimai ir kiti dokumentai"></span>
                                @endif
                            </h4>
                        </a>
                    </div>
                    @if (isset($cv->comments->first()->rating))
                    <div class="col-sm-4 text-right">
                        <input type="number" name="cv_rating" class="rating" value="{{$cv->comments->first()->rating}}" style="display: none">
                    </div>
                    @endif
                </div>
                <div>
                    @if ($cv->description)
                        <span class="cv-description">{{str_limit($cv->description, 220)}}</span>
                    @endif
                </div>
            </div>
        </td>
        <td class="cv-created last">
            <div class="cell">
                <div class="cv-created">Įkelta {{$cv->updated_at->format('Y-m-d')}}</div>
                <div class="cv-gender">{{$cv->genderName}}, {{$cv->age}} m.</div>
                <div class="cv-city">{{$cv->city}}</div>
            </div>
        </td>
    </tr>
    @endforeach
</table>