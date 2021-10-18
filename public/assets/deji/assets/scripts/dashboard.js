
function jsRouter(route, id, title) {
    var loader = Handlebars.compile($("#preloader").html());
    $('#app').html(loader).load(route+' #container', function (responseText, textStatus, req) {
        $('.nav-link').removeClass('active');
        $('#'+id).addClass('active');
        history.pushState(null, '', route);
        document.title = title+' | SmartHealth';
        domJS();
        if (textStatus === "error") {
            location.reload();
        }
    });
}

function myRecordJSRouter(route, id, title) {
    var loader = Handlebars.compile($("#preloader").html());
    $('#record_container').html(loader).load(route+' #record_content', function (responseText, textStatus, req) {
        $('.list-group-item-action').removeClass('active');
        $('#'+id).addClass('active');
        history.pushState(null, '', route);
        document.title = title+' | SmartHealth';
        recordDomJS();
        domJS();
        if (textStatus === "error") {
            location.reload();
        }
    });
}

function refreshContent(route) {
    var loader = Handlebars.compile($("#preloader").html());
    $('#record_container').html(loader).load(route+' #record_content', function (responseText, textStatus, req) {
        recordDomJS();
        domJS();
        if (textStatus === "error") {
            location.reload();
        }
    });
}

function domJS() {
    // $("#dtBox").DateTimePicker({
    //     dateFormat: 'yyyy-MM-dd',
    // });
    //
    // $("#dtBoxCurrent").DateTimePicker({
    //     dateFormat: 'yyyy-MM-dd'
    // });
    //
    // $("#dtimeBox").DateTimePicker({
    //     dateTimeFormat: 'yyyy-MM-dd HH:mm:ss',
    //     mode: 'datetime'
    // });

    $(document).ready(function() {
        $('.select2').select2({
            theme: "classic",
            width: '100%'
//            tags: true
        });

        // doctor's country select with flags stars
        $(function() {
            function formatCountry (country) {
                if (!country.id) { return country.text; }
                var $country = $(
                    '<span class="flag-icon flag-icon-'+ country.id.toLowerCase() +' flag-icon-squared"></span>' +
                    '<span class="flag-text">'+ country.text+"</span>"
                );
                return $country;
            };
            $("[name='nationality']").select2({
                placeholder: "Select an option",
                templateResult: formatCountry,
                data: isoCountries,
                width: '100%'
            });
        });
        // ends


    });

    $(function() {
        $('.daterange').daterangepicker({
            "opens": "center",
            "timePicker": true,
            locale: {
                format: 'YYYY-MM-DD HH:mm:ss',
                "separator": " / ",
                "fromLabel": "From",
                "toLabel": "To"
            }
        });
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
        // endDate: current
    });

    $('.input-daterange').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    // plotChart();
}

function recordDomJS() {
    var meter_max = $('.meter_normal_range').data('max');
    var meter_left = Math.ceil($('.meter_normal_range').data('left')/meter_max*100);
    var meter_right = Math.ceil($('.meter_normal_range').data('right')/meter_max*100);
    var meter_marker = Math.ceil($('.meter_marker').data('range')/meter_max*100);
    $('.meter_normal_range').css('margin-left', meter_left+'%').css('margin-right', meter_right+'%');
    $('.meter_marker').css('margin-left', meter_marker+'%');

    $('.select2').select2({
        theme: "classic",
        width: '100%'
    });
}

function savePatientInformation(url) {
    $('#response').html('');
    $('.patientBtn').prop('disabled', true).html("Updating Information...");

    var formData = $('#patientForm').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'JSON',
        complete: function (response) {
            $('.patientBtn').prop('disabled', false).html('Save');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                swal('', res.success, 'success');
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            $('#response').html(processError(xhr.responseJSON));
            $('.patientBtn').prop('disabled', false).html('Save');
        }
    });
}

function saveNextOfKin(url) {
    $('#nok_response').html('');
    $('#nextOfKinBtn').prop('disabled', true).html("Saving...");

    var formData = $('#nextOfKinForm').serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'JSON',
        complete: function (response) {
            $('#nextOfKinBtn').prop('disabled', false).html('Save Next of Kin');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                swal('', res.success, 'success');
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status===422) {
                $('#nok_response').html('<p class="alert alert-danger">'+xhr.responseText+'</p>');
            }
            else {
                $('#nok_response').html(processError(xhr.responseJSON));
            }
            $('#nextOfKinBtn').prop('disabled', false).html('Save Next of Kin');
        }
    });
}

function resetForm(formID, label) {
    $('#'+formID)[0].reset();
    $('#addFormLabel').html(label);
}

function submitForm(url, formID, callback) {
    $('#heightBtn').prop('disabled', true).html("Saving...");

    var formData = $('#'+formID).serialize();

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'JSON',
        complete: function (response) {
            $('#heightBtn').prop('disabled', false).html('Save');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                $('#'+formID)[0].reset();
                $('.modal').modal('hide');
                refreshContent(callback);
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            $('#heightBtn').prop('disabled', false).html('Save');
        }
    });
}

function submitUploadForm(url, formID, callback) {
    $('#uploadBtn').prop('disabled', true).html("Saving...");

    var formData = new FormData($('#'+formID)[0]);

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        // dataType: 'JSON',
        complete: function (response) {
            $('#uploadBtn').prop('disabled', false).html('Save');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                $('#'+formID)[0].reset();
                $('.modal').modal('hide');
                refreshContent(callback);
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            $('#uploadBtn').prop('disabled', false).html('Save');
        }
    });
}

function editTrigger(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            fill_form(response.responseJSON.data);
            $('#pre_loader').html('');
        }
    });
}

function editAllergy(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            if (response.responseJSON.data.still_has===0){
                $('#customRadioSolid2').prop('checked', true);
            }
            else if (response.responseJSON.data.still_has===1)
            {
                $('#customRadioSolid1').prop('checked', true);
            }
            var res = response.responseJSON.data;
            delete res.still_has;
            fill_form(res);
            $('#pre_loader').html('');
        }
    });
}

function editMedication(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            if (response.responseJSON.data.still_taking===0){
                $('#customRadioSolid2').prop('checked', true);
            }
            else if (response.responseJSON.data.still_taking===1)
            {
                $('#customRadioSolid1').prop('checked', true);
            }
            var res = response.responseJSON.data;
            // var tagValue = [{id: res.medication, text: res.medication}];
            $('#id').val(res.id);
            $('.medication').val(res.medication).trigger('change');
            $('#doctor_id').val(res.doctor_id).trigger('change');
            $('#pre_loader').html('');
        }
    });
}

function editRCDrug(id, url, formID, label) {
    $('#'+formID)[0].reset();
    $('#rcd_pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#rcdID').val(res.id);
            if (res.marijuana===1){ $('#marijuana').prop('checked', true); }
            if (res.heroine===1){ $('#heroine').prop('checked', true); }
            if (res.cocaine===1){ $('#cocaine').prop('checked', true); }
            if (res.methaphethamine===1){ $('#methaphethamine').prop('checked', true); }
            if (res.ecstasy===1){ $('#ecstasy').prop('checked', true); }
            if (res.lsd===1){ $('#lsd').prop('checked', true); }
            if (res.psychedelic_mushrooms===1){ $('#psychedelic_mushrooms').prop('checked', true); }
            $('#rcd_pre_loader').html('');
        }
    });
}

function editAlcohol(id, url, formID, label) {
    $('#'+formID)[0].reset();
    $('#al_pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#alcoholID').val(res.id);
            if (res.social_drinker===1){ $('#social_drinker').prop('checked', true); }
            if (res.moderate_drinker===1){ $('#moderate_drinker').prop('checked', true); }
            if (res.heavy_drinker===1){ $('#heavy_drinker').prop('checked', true); }
            if (res.not_a_drinker===1){ $('#not_a_drinker').prop('checked', true); }
            $('#al_pre_loader').html('');
        }
    });
}

function editTobacco(id, url, formID, label) {
    $('#'+formID)[0].reset();
    $('#tb_pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#tobaccoID').val(res.id);
            if (res.dont_smoke===1){ $('#dont_smoke').prop('checked', true); }
            if (res.smoke_2_pack_per_month===1){ $('#smoke_2_pack_per_month').prop('checked', true); }
            if (res.smoke_2_pack_per_week===1){ $('#smoke_2_pack_per_week').prop('checked', true); }
            if (res.smoke_2_pack_per_day===1){ $('#smoke_2_pack_per_day').prop('checked', true); }
            if (res.smoke_more_pack_per_day===1){ $('#smoke_more_pack_per_day').prop('checked', true); }
            $('#tb_pre_loader').html('');
        }
    });
}

function addImmunization(vaccine)
{
    $('#vaccine').val(vaccine).trigger('change');
}

function editImmunization(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#vaccine').val(res.vaccine).trigger('change');
            fill_form(res);
            $('#pre_loader').html('');
        }
    });
}

function editAdmission(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            // $('#dates').val(res.admission_date+' / '+res.discharge_date);
            $('#admission_date').val( moment(res.admission_date).format('YYYY-MM-DD'));
            $('#discharge_date').val( moment(res.discharge_date).format('YYYY-MM-DD'));
            $('#id').val(res.id);
            $('#hospital').val(res.hospital).trigger('change');
            $('#illness').val(res.illness).trigger('change');
            // fill_form(res);
            $('#pre_loader').html('');
        }
    });
}

function editProcedure(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#procedure').val(res.procedure).trigger('change');
            if (res.major===1){ $('#major').prop('checked', true); }
            if (res.minor===1){ $('#minor').prop('checked', true); }
            fill_form(res);
            $('#date').val( moment(res.date).format('YYYY-MM-DD'));
            $('#pre_loader').html('');
        }
    });
}

function editInsurance(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#insurance_company').val(res.insurance_company).trigger('change');
            $('#insurance_plan').val(res.insurance_plan).trigger('change');
            if (res.corporate===1){ $('#corporate').prop('checked', true); }
            if (res.individual===1){ $('#individual').prop('checked', true); }
            fill_form(res);
            $('#pre_loader').html('');
        }
    });
}

function editFamilyHistory(id, url, formID, label) {
    $('#addFormLabel').html(label);
    $('#'+formID)[0].reset();
    $('#pre_loader').html('Fetching...');

    $.ajax({
        type: 'GET',
        url: url+'/'+id,
        complete: function (response) {
            var res = response.responseJSON.data;
            $('#affected_member').val(res.affected_member).trigger('change');
            $('#illness').val(res.illness).trigger('change');
            $('#id').val(res.id);
            $('#pre_loader').html('');
        }
    });
}

function toggleInvestigationType(type) {
    var value = type.value;
    if (value==='laboratory') {
        $('#imaging_file').css('display', 'none');
        $('#laboratory_file').css('display', 'block');
        $('#lab_result').prop('required', true);
        $('#image_result').prop('required', false).val('');
    }
    else if (value==='imaging') {
        $('#laboratory_file').css('display', 'none');
        $('#imaging_file').css('display', 'block');
        $('#lab_result').prop('required', false).val('');
        $('#image_result').prop('required', true);
    }
}

function deleteItem(title, text, id, url, callback) {

    swal({
        title: title,
        text: text,
        icon: "warning",
        buttons: ["Abort", "Proceed"],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'GET',
                url: url+'/'+id,
                complete: function (response) {
                    // $('#item'+id).hide();
                    refreshContent(callback);
                    // swal('Deletion Successful!','','success');
                }
            });
        }
    });

}