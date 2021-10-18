$(function() {

    var slot;
    var timePhrase;

    $("#setupBooking").attr("disabled", true).removeClass('btn-primary').addClass('btn-primary-soft');

    $('button#slot').click( function () {
        if($(this).data('status') == '0') {

            $('button#slot').css({"background": "#bfd6f8"}).css({"color": "#000000"});
            $('button#slot').data('status', '0');

            $(this).data('status', '1');
            $(this).css({"background": "#307399"}).css({"color": "#ffffff"});

            slot = $(this).data('slot');
            timePhrase = $(this).data('time');

            if(slot !== "") {
                $("#setupBooking").attr("disabled", false).addClass('btn-primary').removeClass('btn-primary-soft');
            }

        } else {

            $(this).css({"background": "#bfd6f8"}).css({"color": "#000000"});
            $(this).data('status', '0');
            slot = "";
            timePhrase = "";

            $("#setupBooking").attr("disabled", true).removeClass('btn-primary').addClass('btn-primary-soft');

        }
    });

    $('#setupBooking').click( function () {
        
        $('#slots').html(timePhrase);
        
        $('#bookingModal').modal({
            keyboard: false,
            backdrop: "static"
          });
    });

    $('#continueBooking').click( function () {
        
        $('#slots2').html(timePhrase);
        $('#slots3').html(timePhrase);
        
        $('#bookingModal2').modal({
            keyboard: false,
            backdrop: "static"
          });

          $('#bookingModal').modal('hide');
    });

    
});