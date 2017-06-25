$().ready(function(){
    $('.ajax-form').each(function() {
        $(this).submit(function(e) {
            e.preventDefault();
            ajaxForm(this, true);
        });
    });
    $('.action-modal').each(function() {
        var o = $(this);
        var modalId = guidGenerator();
        var url = o.attr('href');
        var size = (o.attr('data-size') || 'modal-lg');

        $('body').append('<div class="modal fade" id="'+modalId+'" tabindex="-1" role="dialog"><div class="modal-dialog '+size+'"><div class="modal-content"></div></div></div>');

        o.bind('click', function(e) {
            e.preventDefault();

            var data = null;
            var dataForm = (o.attr('data-form'));
            var dataMethod = (o.attr('data-method') || 'post');

            if (dataForm)
            {
                //data = $(dataForm).serialize();
                data = new FormData($(dataForm)[0]);
            }

            $('#'+modalId).modal();

            $.ajax({
                type: dataMethod,
                url: url,
                data: data,
                dataType: 'json',
                processData: false,
                contentType: false,
                error: function(response){
                    var errors = response.responseJSON;
                    var errorsHtml = '<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><h4 class="modal-title">Klaida</h4></div><div class="modal-body"><div class="alert alert-danger">';

                    $.each(errors, function( key, value ) {
                        errorsHtml += '<div>' + value[0] + '</div>'; //showing only the first error.
                    });

                    errorsHtml += '</div></div>';

                    $('#'+modalId+' .modal-content').html(errorsHtml);
                }
            }).success(function(response){
				$('#'+modalId+' .modal-content').html(response.html);
				$('.ajax-form').bind('submit', function(e) {
					e.preventDefault();
					ajaxForm(this, true);
				});
			});
        });
    });

    $('.clone-button').click(function(){
        var cloneArea = $(this).attr('data-clone-area');
        var limit = $(this).attr('data-limit');

        if (limit && $('[name^='+limit+']').length >= 3) {
            alert('Pasiekta ryba');
            return;
        }

        $('.datepicker').datepicker('destroy');

        var cloneObj = $('#'+cloneArea).clone(false).removeAttr('id').removeClass('first').addClass('cloned-item').addClass(cloneArea);
        cloneObj.find('select').attr('disabled', false)
        cloneObj.find('option').prop("selected", false);
        cloneObj.find('input').each(function() {
            if ($(this).data('ignore') == 1 || $(this).attr("name") == '_token') {
            } else {
                $(this).val('');
            }
        });
        cloneObj.find('textarea').val('').attr('disabled', false);
        cloneObj.find('.alert').remove();
        cloneObj.find('.clone-ignore').remove();

        cloneObj.find('.form-group').eq(0).append('<a href="javascript:void(0)" class="remove-clone-item"><span class="glyphicon glyphicon-minus-sign"></span></a>');

        $('#'+cloneArea+'-container').append(cloneObj);

        $('.remove-clone-item').bind('click', function(e) {
            e.preventDefault();
            $(this).parents('.cloned-item').remove();
        });

        //$('textarea.form-control').elastic();

        var i = 0;
        $('.datepicker').each(function () {
            $(this).attr("id",'date' + i).datepicker({
                changeMonth: true,
                changeYear: true
            });
            i++;
        });

        if (cloneArea == 'language-clone-area') {
            var container = $('.languages-form');
            var index = (container.find('.foreign-language').length - 1);
            var $el = cloneObj.find('select.input-sm');

            $el.attr('id', 'foreign_language_id['+index+']');
            $el.attr('name', 'foreign_language_id['+index+']');
            $el.attr('data-language-value', 'foreign-language-value-'+index+'');
            $el.parents('.form-group').next('.form-group')
                .removeClass('foreign-language-value-0')
                .addClass('foreign-language-value-'+index+'');

            //container.find('.cloned-item .form-group').eq(1).addClass('foreign-language-value-'+(i+1)+'');
            //container.find('.cloned-item .form-group').eq(1).removeClass('foreign-language-value-0');
            //container.find('.cloned-item .form-group').eq(1).hide();

            //container.find('.cloned-item input').attr('name', 'foreign_language_value['+(i+1)+']');
        }

    });

    $('.multiselect').multiselect({
        nonSelectedText: '-- Pasirinkti --',
        allSelectedText: 'Visi pažymėti',
        buttonClass: 'btn btn-default btn-sm',
        maxHeight: 300,
        maxButtonTitle: 35,
        onChange: function(option) {
            var me = $(option), // is an <option/>
                parent = me.parent(),// is a <select/>
                max = 3, // defined on <select/>
                options, // will contain all <option/> within <select/>
                selected, // will contain all <option(::selected)/> within <select/>
                multiselect; // will contain the generated ".multiselect-container"
            // get all options
            options = parent.find('option');

            // get selected options
            selected = options.filter(function () {
                return $(this).is(':selected');
            });

            // get the generated multiselect container
            multiselect = parent.siblings('.btn-group').find('.multiselect-container');

            // check if max amount of selected options has been met

            if (selected.length >= max) {
                if (selected.length > max) {
                    alert('Galima pasirinkti tik ' + max + 'parametrus.');
                    //me.prop("selected", false);
                    parent.multiselect('deselect', me.val());
                }
                // max is met so disable all other checkboxes.
                options.filter(function () {
                    return !$(this).is(':selected');
                }).each(function () {
                    multiselect.find('input[value="' + $(this).val() + '"]')
                        .prop('disabled', true)
                        .parents('li').addClass('disabled');
                });

            } else {
                // max is not yet met so enable all disabled checkboxes.
                options.each(function () {
                    multiselect.find('input[value="' + $(this).val() + '"]')
                        .prop('disabled', false)
                        .parents('li').removeClass('disabled');
                });
            }
        }
    });

    $('.upload-button').each(function() {
        var name = $(this).attr('data-name');
        var wrapper = $('<div/>').css({height:0,width:0,'overflow':'hidden'});
        var input = $('input[name="'+name+'"]').wrap(wrapper);

        if (input.val()) {
            $('#'+name+'-filename').text(input.val());
        }

        input.change(function(){
            $('#'+name+'-filename').text($(this).val());
        });

        $(this).click(function(){
            input.click();
        }).show();
    });

    var carousel = $('#carousel').waterwheelCarousel({
        //separation: 195,
        //animationEasing: 'swing',
        //preloadImages: false,
        ////forcedImageWidth: 350,
        //forcedImageHeight: 220,
        autoPlay : 6000
        //speed : 500
    });

    $('.slider').show();

    $('a.carouselNext').bind('click', function(event) {
        event.preventDefault();
        carousel.next();
    });

    $('a.carouselPrev').bind('click', function(event) {
        event.preventDefault();
        carousel.prev();
    });
});

function initDatepicker() {
    var datepickerInit = false;

    var options = {
        changeMonth: true,
        changeYear: true
    };

    if ($('#work_from').length) {
        var options2 = {
            onClose: function(selectedDate) {
                $("#work_to").datepicker("option", "minDate", selectedDate);
            }
        };

        $('#work_from').datepicker($.extend(options, options2));
        datepickerInit = true;
    }

    if ($('#work_to').length) {
        var options2 = {
            onClose: function( selectedDate ) {
                $("#work_from").datepicker("option", "maxDate", selectedDate);
            }
        };

        $('#work_to').datepicker($.extend(options, options2));
        datepickerInit = true;
    }

    if (!datepickerInit) {
        $('.datepicker').datepicker(options);
    }
}

function msOnChange(option) {
    var me = $(option), // is an <option/>
        parent = me.parents('select'),// is a <select/>
        max = 3, // defined on <select/>
        options, // will contain all <option/> within <select/>
        selected, // will contain all <option(::selected)/> within <select/>
        multiselect; // will contain the generated ".multiselect-container"
    // get all options
    options = parent.find('option');

    // get selected options
    selected = options.filter(function () {
        return $(this).is(':selected');
    });

    // get the generated multiselect container
    multiselect = parent.siblings('.btn-group').find('.multiselect-container');

    // check if max amount of selected options has been met

    if (selected.length >= max) {
        if (selected.length > max) {
            alert('Galima pasirinkti tik ' + max + 'parametrus.');
            //me.prop("selected", false);
            parent.multiselect('deselect', me.val());
        }
        // max is met so disable all other checkboxes.
        options.filter(function () {
            return !$(this).is(':selected');
        }).each(function () {
            multiselect.find('input[value="' + $(this).val() + '"]')
                .prop('disabled', true)
                .parents('li').addClass('disabled');
        });

    } else {
        // max is not yet met so enable all disabled checkboxes.
        options.each(function () {
            multiselect.find('input[value="' + $(this).val() + '"]')
                .prop('disabled', false)
                .parents('li').removeClass('disabled');
        });
    }
}

function guidGenerator()
{
    var S4 = function() {
        return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
    };
    return (S4()+S4()+"-"+S4()+"-"+S4()+"-"+S4()+"-"+S4()+S4()+S4());
}

function ajaxForm(obj, async)
{
	var o = $(obj);
    var async = async;
    var result = false;

	var st = true;

	if (st) {
		var url = o.attr('action');
		var data = new FormData(o[0]);
		var callback = (o.data('callback') || null);

		$('[type=submit]', o).attr('disabled', true);

		var ajaxOptions = {
			type: 'post',
			url: url,
			data: data,
			dataType: 'json',
			processData: false,
			contentType: false,
            async: async,
            error: function(response){
                $('.alert', o).remove();
                var errors = response.responseJSON;
                var errorsHtml = '<div class="alert alert-danger">';

                $.each(errors, function( key, value ) {
                    errorsHtml += '<div>' + value[0] + '</div>'; //showing only the first error.
                });

                errorsHtml += '</div></div>';

                o.prepend(errorsHtml);
                $('[type=submit]', o).attr('disabled', false);
            }
		};

		$.ajax(ajaxOptions).success(function(response) {

			$('[type=submit]', o).attr('disabled', false);
			$('.alert', o).remove();

			if (response.error) {
				o.prepend('<div class="alert alert-danger">' + response.error + '</div>');
			}

			if (response.success) {
                if (typeof response.success === 'string') {
                    o.prepend('<div class="alert alert-success">' + response.success + '</div>');
                    o.find('.form-group').hide();
                }
            }

            if (callback) {
                window[callback](response, obj);
            }
            if (response.location) {
                location.href = response.location;
            }

            result = response;
		});
	}

	return result;
}

function skipState(id, state) {
    $.get('/cv/'+id+'/skipState/'+state, function(response) {
        if (response) {
            location.href = response.url;
        }
    });
}

function ajaxForms(container, state)
{
    var response = null;
    var forms = $('#'+container).find('form');

    if (forms.length > 0) {
        var btn = $('#'+container).find('button');
        btn.prop('disabled', true);

        forms.each(function(){
            if (state) {
                $(this).append('<input type="hidden" name="state" value="' + state + '">');
            }
            response = ajaxForm(this, false);
            if (response === false) {
                return false;
            } else {
                $(this).find('input[name=id]').val(response.id);
            }
        });
    }

    if (response === false) {
        btn.prop('disabled', false);

        return false;
    } else {
        if (container == 'workForms' || container == 'experienceForms') {
            return response.url;
        } else {
            location.href = response.url;
        }
    }

    return false;
}

function scopeCategoriesTrigger(selectedItems)
{
    $('#scope_id').on('change', function() {
        var id = $(this).val();

        $.get('/administration/topCvs/getScopeCategories', { id: id }, function(data) {
            var $select = $('#scope_category_id');
            var options = $select.prop('options');

            $('option', $select).remove();

            $.each(data, function(val, text) {
                var selected = selectedItems[val] || false;
                options[options.length] = new Option(text, val, false, selected);
            });

            $select.multiselect('rebuild');
        });
    });

    $("#scope_id").trigger('change');
}

function printCv(url) {
    var openWindow = window.open(url, '', '');
    openWindow.document.close();
    openWindow.focus();
    openWindow.print();
    //openWindow.close();
}