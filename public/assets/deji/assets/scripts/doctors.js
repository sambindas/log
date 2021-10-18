function toggleProfileForm() {
    if(!$('#biography')[0].validity.valid) return false;
    $('#pform1').hide();
    $('#pform2').show();
}

function getImagePath(file) {
    var filename = file.files[0].name;
    $('#selectFile').html('<strong>Selected: </strong>'+filename);
    $('#uploadText').text('Change Picture');
}

function toggleProfileFormSuccess() {
    $("#doctorUpdateProfileFrom").validate();
}

function countWords() {
    var count = $('#biography').val().length;
    $('#bioCount').text(count);
}


function saveProfileUpdate(formID, url) {
    $('#profileUpdateBtn').prop('disabled', true).html("Saving...");
    var formData = new FormData($('#'+formID)[0]);

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        complete: function (response) {
            $('#profileUpdateBtn').prop('disabled', false).html('Save');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                $('#'+formID)[0].reset();
                $('#pform2').hide();
                $('.pformTitle').hide();
                $('#pformSuccess').show();
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            $('#profileUpdateBtn').prop('disabled', false).html('Save');
        }
    });
}