$('#registerForm').submit(function (e) {
    e.preventDefault();
    $('#response').html('');
    $('#registerBtn').prop('disabled', true).html("Creating Account...");

    var formData = $(this).serialize();
    var callback = $(this).data('callback');
    var url = $(this).attr('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'JSON',
        complete: function (response) {
            // $('#registerBtn').prop('disabled', false).html('Sign Up');

            if(response.status===200)
            {
                $('#registerBtn').html('Account created!');
                var res = JSON.parse(response.responseText);
                $('#response').html('<p class="alert alert-success">'+res.success+'</p>');
                // if (res.type==='Doctor'){
                //     $('#passCodeModal').modal('show');
                //     $('#registerBtn').hide();
                //     $('#confirmEmailBtn').show();
                // }
                // else {
                    window.location.replace(callback);
                // }
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            $('#response').html(processError(xhr.responseJSON));
            $('#registerBtn').prop('disabled', false).html('Sign Up');
        }
    });
});