@extends('app')

@section('title', 'Sukurti/Redaguoti CV -')

@section('content')
    <h1>Sukurti / Redaguoti CV</h1>
    <div class="cv-edit">
        <?php  /*
        <div class="cv-navigation">
            <div class="row">
                <div class="col-sm-4">
                    @foreach($states as $k => $s)
                        @if (isset($s['name']))
                            @if ($k == 4 || $k == 8)
                                <div class="col-sm-4">
                            @endif

                            @if (!$cv->isActiveState($k))
                                <span class="disabled">{{ $k }}. {{ $s['name'] }}</span>
                            @else
                                <a href="{{ route("cv_edit", ['id'=>$cv->id, 'state' => $k]) }}"
                                    class="{!! ($currentState == $k ? 'active' : '') !!}"
                                >
                                    {{ $k }}. {{ $s['name'] }}
                                </a>
                            @endif

                            @if($k == 3 || $k == 7)
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
            </div>
            @if (isset($states[$currentState]['name']))
                <h3>{{ $currentState }}. {{ $states[$currentState]['name'] }}</h3>
            @endif
        </div>
        */ ?>
        @if ($currentState == 11)
            {!! $html !!}
        @endif

        @foreach ($states as $k => $s)
            @if (isset($s['name']))
                <a name="section{{$k}}"></a>
                @if ($currentState == $k)
                    <div class="section active">
                        <div class="section-title">
                            <h4>{{ $currentState }}. {{ $states[$currentState]['name'] }}</h4>
                        </div>
                        {!! $html !!}
                    </div>
                @else
                    <div class="section">
                        <div class="section-title">
                            <div class="row">
                                <div class="col-sm-11"><h4>{{ $k }}. {{ $s['name'] }}</h4></div>
                                @if ($cv->isActiveState($k))
                                    <?php /*
                                    <div class="col-sm-3">
                                        <span class="section-no-data">Duomenys nepateikti</span>
                                    </div> */ ?>
                                    <div class="col-sm-1">
                                        <a href="{{ route("cv_edit", ['id'=>$cv->id, 'state' => $k, '#section'.$k]) }}" title="Redaguoti - {{$s['name']}}" class="section-edit">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endsection

@section('scripts')

<script src="{{ asset('/js/jquery.elastic.source.js') }}"></script>
<script type="text/javascript">

    $().ready(function() {
        $("select[name^='another_level']").hide();
        $("textarea[name^='another']").each(function () {
            if ($(this).val()) {
                $(this).parents('.form-group').find('select').show();
            }
        });
        $("textarea[name^='another']").on('input', function () {
            if ($(this).val()) {
                $(this).parents('.form-group').find('select').show();
            }
            else {
                $(this).parents('.form-group').find('select').hide();
            }
        });

        initDatepicker();

        var wrapper = $('<div/>').css({height: 0, width: 0, 'overflow': 'hidden'});
        var photoInput = $('input[name="photo"]').wrap(wrapper);

        photoInput.change(function () {
            $('#photo-upload-file').text($(this).val());
        });

        $('#photo-upload').click(function () {
            photoInput.click();
        }).show();

        $('textarea.form-control').elastic();

        $('#birthday').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-60:+0",
            defaultDate: "{{(new \Carbon('-20 year'))->format('Y-m-d')}}"
        });

        (function (form) {
            form.find('.foreign-language').each(function(i) {
                var $el = $(this).find('select.input-sm');

                $el.attr('id', 'foreign_language_id['+i+']');
                $el.attr('name', 'foreign_language_id['+i+']');
                $el.attr('data-language-value', 'foreign-language-value-'+i+'');
                $el.parents('.form-group').next('.form-group').addClass('foreign-language-value-'+i+'');

                if (parseInt($el.val()) === 100) {
                    toggleLanguageValue('show', $el.data('language-value'));
                }

                form.on('change', 'select.input-sm', function(){
                    if (parseInt($(this).val()) === 100) {
                        toggleLanguageValue('show', $(this).data('language-value'));
                    } else {
                        toggleLanguageValue('hide', $(this).data('language-value'));
                    }
                });

                function toggleLanguageValue(status, o) {
                    var item = form.find('.' + o);
                    if (status == 'show') {
                        item.show();
                    } else if (status == 'hide') {
                        item.hide();
                    }
                }
            });

        })($('.languages-form form'));

        (function (form) {
            form.find('.driving-license').each(function(i) {
                var $dl = $(this);
                var $ic = $(this).find('input:checkbox');

                if(!$ic.prop('checked')) {
                    $dl.find('input:text').prop('readonly', true);
                } else {
                    $dl.find('input:text').prop('readonly', false);
                }

                $ic.on('click', function() {
                    if (!$(this).prop('checked')) {
                        $dl.find('input:text').val('');
                        $dl.find('input:text').prop('readonly', true);
                    } else {
                        $dl.find('input:text').prop('readonly', false);
                    }
                });
            });

            form.find('.attach-document-btn').click(function(){
                form.attr('action', $(this).data('action')).submit();
            });

        })($('.extra-info-form form'));
    });

</script>

@stop