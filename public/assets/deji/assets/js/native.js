// $(document).ready(function () {

    $(document).on("keyup", ".only_numeric", function () {
        this.value = this.value.replace(/[^0-9\.]/g, "");
    });

    function processError(errors) {
        var errorString = '<ul class="alert alert-danger">';
        $.each( errors, function( key, value) {
            errorString += '<li>' + value + '</li>';
        });
        errorString += '</ul>';
        return errorString;
        // $.toast({text: errorString, icon: 'error', position: 'top-right', hideAfter: false, stack: 1});
    }

    $(".toggle-password").click(function() {
        $(this).data('feather', ($(this).data('feather') === 'eye' ? 'eye-off' : 'eye'));
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

    function fill_form(d) {
        for(var k in d){
            $('[name="'+k+'"]').val(d[k]);
        }
    }
// });