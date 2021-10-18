$('#loginForm').submit(function (e) {
    e.preventDefault();
    $('#response').html('');
    $('#loginBtn').prop('disabled', true).html("Authenticating...");

    var formData = $(this).serialize();
    var url = $(this).attr('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'JSON',
        complete: function (response) {
            $('#loginBtn').prop('disabled', false).html('Sign In');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                $('#loginBtn').prop('disabled', true).html(res.success);
                    window.location.replace(res.callback);
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status===401) {
                var err = JSON.parse(xhr.responseJSON);
                $('#response').html('<p class="alert alert-danger">'+err.error_description+'</p>');
            }
            else {
                $('#response').html(processError(xhr.responseJSON));
            }
            $('#loginBtn').prop('disabled', false).html('Sign In');
        }
    });

    // axios({
    //     method: 'post',
    //     url: url,
    //     data: formData
    // })
    //     .then(function (response) {
    //         $('#loginBtn').prop('disabled', false).html('Sign In');
    //         if(response.statusText==='OK')
    //         {
    //             $('#response').html('<p class="alert alert-success">'+response.data.success+'</p>');
    //             window.location.replace(response.data.callback);
    //         } else{
    //             console.log(response.data);
    //         }
    //     })
    //     .catch(function (error) {
    //         // console.log(JSON.parse(error.response.data));
    //         if (error.response.status===401) {
    //             var err = JSON.parse(error.response.data);
    //             $('#response').html('<p class="alert alert-danger">'+err.error_description+'</p>');
    //         }
    //         else {
    //             $('#response').html(processError(error.response.data));
    //         }
    //         $('#loginBtn').prop('disabled', false).html('Sign In');
    //     });
});

$('#onboardProfileForm').submit(function (e) {
    e.preventDefault();
    $('#onboardProfileBtn').prop('disabled', true).html("Saving...");
    var formData = new FormData($(this)[0]);
    var url = $(this).attr('action');
    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        // dataType: 'JSON',
        complete: function (response) {
            $('#onboardProfileBtn').prop('disabled', false).html('Continue');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                $('#one').hide();
                $('#two').show();
                $('#twoTitle').addClass('active');
                $('#nTwo').addClass('active');
                $('#oneTitle').removeClass('active');
                $('#nOne').removeClass('active');
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            $('#onboardProfileBtn').prop('disabled', false).html('Continue');
        }
    });
});

$('#onboardProfessionalForm').submit(function (e) {
    e.preventDefault();
    $('#response').html('');
    $('#onboardBtn').prop('disabled', true).html("Saving...");

    var formData = $(this).serialize();
    var url = $(this).attr('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        dataType: 'JSON',
        complete: function (response) {
            $('#onboardBtn').prop('disabled', false).html('Continue');
            if(response.status===200)
            {
                var res = JSON.parse(response.responseText);
                $('#onboardBtn').prop('disabled', true).html(res.success);
                window.location.replace(res.callback);
            } else{
                console.log(response.data);
            }
        },
        error: function (xhr, status, error) {
            if (xhr.status===401) {
                var err = JSON.parse(xhr.responseJSON);
                $('#response').html('<p class="alert alert-danger">'+err.error_description+'</p>');
            }
            else {
                $('#response').html(processError(xhr.responseJSON));
            }
            $('#onboardBtn').prop('disabled', false).html('Continue');
        }
    });
});