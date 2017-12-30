var scntDiv = $('#list');
var i = $('#list tr').size() + 1;

$(document).on('change keydown paste input', '#barcode', function(){
    if ($('#barcode').val().length == 13) {
        scntDiv.append('<tr><td>' + i + '</td><td></td></tr>');   
        i++;

        var barcode = $('#barcode').val();
        var baseUrl = $('#baseUrl').val();
        $('#barcode').val('');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: baseUrl + "/thing/getDetail",
            data: {
                "barcode" : barcode
            },
            success: function(response) {
                // console.log(response);
            }
        })
    }
});

//Remove button
$(document).on('click', '#remove', function() {
    if (i > 2) {
        $(this).closest('tr').remove();
        i--;
    }
    return false;
});