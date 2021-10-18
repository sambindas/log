$('body').on('change', '#word', function (e) {
    $('#submitBtn').prop('disabled', false);
});

$("body#success-alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

$(document).ready(function() {
    
    $('body').on('submit', '#getWord', function (e) {
        e.preventDefault();
    //    $('#response').html('');
        $('#submitBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        var formData = $(this).serialize();
        var url = $(this).attr('action');
        var inner = '';
        var el = '';
        call_url(url, formData, inner, el);

    });
    
    $('body').on('click', 'a.redirect', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var formData = $(this).serialize();
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        var inner = '';
        var el = '';
        call_url(url, formData, inner, el);
    });
    
    $('body').on('click', 'a.links', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var formData = $(this).serialize();
        var inner = $(this).html();
        var el = $(this);
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        call_url(url, formData, inner, el);
    });
    
    $('body').on('click', 'a.recent', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            complete: function (response) {
                $('a.recent').prop('disabled', false).html('<span class="float-right"><i class="fa fa-history"></i></span>');
                if(response.status===200)
                {
                    if(response.responseJSON.type){
                        $("#recentHeader").html('<strong>Recent Search</strong><a href="/dictionary?recent=find" class="text-dark recent"><span class="float-right"><i class="fa fa-times"></i></span></a>');
                    } else {
                        $("#recentHeader").html('<strong>Recent </strong><a href="/dictionary?recent=find" class="text-dark recent"><span class="float-right"><i class="fa fa-history"></i></span></a>');
                    }
                    $("#recentWord").html(response.responseJSON.html).show();
                } else{
                    console.log(response);
                }
            },
            error: function (err) {
                $('a.recent').prop('disabled', false).html('<span class="float-right"><i class="fa fa-history"></i></span>');
                console.log(err);
            }
        });
    });
    
    $('body').on('click', 'a.find', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            complete: function (response) {
                $('a.recent').prop('disabled', false).html('<span class="float-right"><i class="fa fa-history"></i></span>');
                if(response.status===200)
                {
                    if(response.responseJSON.type){
                        $("#favHeader").html('<strong>Favourites </strong><span class="float-right"><i class="fa fa-bookmark"></i></span>');
                    } else {
                        $("#favHeader").html('<strong>Favourites </strong><span class="float-right"><i class="fa fa-bookmark"></i></span>');
                    }
                    $("#recentWord").html(response.responseJSON.html).show();
                } else{
                    console.log(response);
                }
            },
            error: function (err) {
                $("#favHeader").html('<strong>Favourites </strong><span class="float-right"><i class="fa fa-bookmark"></i></span>');
                console.log(err);
            }
        });
    });
    
    $('body').on('click', 'a#allFav', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            complete: function (response) {
                $('a#allFav').prop('disabled', false).html('<span class="float-right"><i class="fa fa-history"></i></span>');
                if(response.status===200)
                {
                    if(response.responseJSON.type){
                        $("#favHeader").html('<strong>All Favourites</strong><a href="/dictionary?fav=find"  class="text-dark find"><span class="float-right"><i class="fa fa-times"></i></span></a>');
                    } else {
                        $("#favHeader").html('<strong>Favourites </strong><a href="/dictionary?recent=find" class="text-dark recent"><span class="float-right"><i class="fa fa-bookmark"></i></span></a>');
                    }
                    $("#favourites").html(response.responseJSON.html).show();
                } else{
                    console.log(response);
                }
            },
            error: function (err) {
                $('a#allFav').prop('disabled', false).html('<span class="float-right"><i class="fa fa-history"></i></span>');
                console.log(err);
            }
        });
    });
    
    $('body').on('click', 'a#saveFav', function (event) {
        event.preventDefault();
        var url = $(this).attr('href');;
        $(this).prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'JSON',
            complete: function (response) {
                $('a#saveFav').prop('disabled', false).html('<span class="float-right"><i class="fa fa-bookmark"></i></span>');
                if(response.status===200)
                {
//                    $("#alert").html('<div class="alert alert-success" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Success! </strong>Favourite added successfully.</div>');
//                    alert("Added successfully");
                } else{
                    alert("Failed! Please try again");
//                    $("#alert").html('<div class="alert alert-warning" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Failed! </strong>Favourite could not be added or already exists.</div>');
                }
            },
            error: function (err) {
                alert("Failed! Please try again");
//                $("#alert").html('<div class="alert alert-danger" id="success-alert"><button type="button" class="close" data-dismiss="alert">x</button><strong>Failed! </strong>An error occurred.</div>');
                console.log(err);
            }
        });
    });
    
    function call_url( url, formData, inner, el){
        $.ajax({
            type: 'GET',
            url: url,
            data: formData,
            dataType: 'JSON',
            complete: function (response) {
                $('#submitBtn').prop('disabled', false).html('<i class="fa fa-search"></i>');
                $('#getWord')[0].reset();
                console.log(inner);
                if(inner !== '')  el.html(inner);
                if(response.status===200)
                {
                    $("#result").html(response.responseJSON.html).show();
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
    }
});