$(function () {
    $('#add_product').on('click', function () {
        $.ajax({
            url: "http://127.0.0.1:8000/api/product/raw",


            success: function (result) {
                // $("#div1").html(result);
                console.log(result);
                $('.product').append(result);
            }
        });

    })
})

$(function () {

    $('.product').on('click', '.remove_product', function () {
        var id = $(this).parent().parent().children('#recipe_id').val();
        console.log(id);
        if (id > 0) {

            $.ajax({
                url: "http://127.0.0.1:8000/api/remove/product/" + id,


                success: function (result) {
                    console.log('success')
                }
            });
            $(this).parent().parent().remove()
        } else {
            $(this).parent().parent().remove()

        }

    })
})
