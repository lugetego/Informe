
var $sport = $("#cursos_lugares");




$(document).ready(function(){


    $sport.change(function(){

        var $form = $(this).closest('form');

        // Simulate form data, but only include the selected sport value.
        var data = {};
        data[$sport.attr("name")] = $sport.val();
        // Submit data via AJAX to the form's action path.

        $('#cursos_lugar').attr('readonly', true);

        if ($sport.val()=='Otro') {
            $.ajax({
                url: $form.attr('action'),
                type: $form.attr('method'),
                data: data,
                success: function (html) {


                    $("#cursos_lugar").replaceWith(
                        // ... with the returned one from the AJAX response.
                        $(html).find("#cursos_lugar")

                        //$("select:first").replaceWith("Hello world!"
                    );

                    $('#cursos_lugar').attr('readonly', false);



                    // Position field now displays the appropriate positions.

                }
            });
        }







    });


});