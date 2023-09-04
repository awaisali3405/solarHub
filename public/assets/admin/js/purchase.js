var a = document.getElementsByClassName('.product_quantity');
console.log(a);
$(function () {
    $('#add_purchase_product').on('click', function () {
        $.ajax({
            url: '/api/purchase/product',
            success: function (result) {
                // $("#div1").html(result);
                console.log(result);
                $('.product').append(result);
            }
        })
        // var a = '<tr class="line_items text-center" style="margin-top:5px;"> <td><span class="row-remove btn btn-danger remove_row" style=" margin-right:20px">Remove</span></td> <td> <select class="form-control product_name" style="margin-top: 11px;" name="product_id[]" required> <option value="">Select Product</option> @foreach ($product as $value2) <option value="{{ $value2->id }}">{{ $value2->name }}</option> @endforeach </select></td><td><input type="number" step="any" class="form-control product_quantity" style="    margin-top: 11px;" name="quantity[]" value=""></td> <td><input type="number" step="any" class="form-control product_price" style="    margin-top: 11px;" name="price[]" value=""></td> <td></td> <td><input type="text" class="form-control product_total_price" style="    margin-top: 11px;" name="item_total[]" value="" readonly> </td> </tr>'
        // $('.product').append(a);
    })
})
$(function () {

    $('.product').on('click', '.remove_row', function () {
        console.log('asas');
    })
})
$(document).ready(function () {
    $(".product").focus();
    $(".product").on('change focus input ready', '.product_quantity', function () {
        console.log('as');
        var qty = $(this).parent().parent().children().children('.product_quantity').val();
        var price = $(this).parent().parent().children().children('.product_price').val();

        $(this).parent().parent().children().children('.product_total_price').val(qty * price)
        // $(this).parent().parent().children('.product_total_price').val(qty * price);
        var keyWord = 0;
        $('.product_total_price').each(function () {
            if (this.value) {
                var val = parseInt(this.value);
                if (val != 'NaN') {

                    keyWord += val;
                    $('#sub').val(keyWord);
                }
            }
        });
    })
})
$(function () {

    $(".product").on('change focus input', '.product_price', function () {
        var qty = $(this).parent().parent().children().children('.product_quantity').val();
        var price = $(this).parent().parent().children().children('.product_price').val();

        $(this).parent().parent().children().children('.product_total_price').val(qty * price)
        var keyWord = 0;
        $('.product_total_price').each(function () {
            if (this.value) {
                var val = parseInt(this.value);
                if (val != 'NaN') {

                    keyWord += val;
                    $('#sub').val(keyWord);
                }
            }
        });
    })
})
$(function () {
    $('#discount').on('chang focus input', function () {
        var dis = parseInt($('#discount').val());
        var sub = parseInt($('#sub').val());
        var discount = sub - (sub * dis) / 100;
        $('#discount_total').val(discount);
    })
})
$(function () {
    $('#gst').on('change input load', function () {
        var gst = parseInt($('#gst').val());
        var dis = parseInt($('#discount_total').val());
        var gst = dis + (dis * gst) / 100;
        $('#gst_total').val(gst);
    })
})
$(function () {
    $('#wht').on('change input', function () {
        var gst = parseInt($('#gst_total').val());
        var wht = parseInt($('#wht').val());
        var grand = gst + (gst * wht) / 100;
        $('#grandtotal').val(grand);
    })
})
$(function () {
    $('#paid_id').on('input', function () {
        var grand = $('#grandtotal').val();
        var paid = $('#paid_id').val();
        var remaing = grand - paid;
        if (remaing >= 0) {
            $('#rempay').val(grand - paid)
        } else {
            alert('paid value exceed by total value');
        }

    })
})
$(function () {
    $('.product').on('click', '.row-remove', function () {
        var row = $(this).parent().parent().children('#row_id').val();

        $(this).parent().parent().remove()
        $.ajax({
            url: '/api/purchase/product/remove',
            method: 'POST',
            data: { value: row },
            success: function (result) {

                // $('.product').append(result);
            }
        })

    })
})
$(document).ready(function () {
    var qty = $(this).parent().parent().children().children('.product_quantity').val();
    var price = $(this).parent().parent().children().children('.product_price').val();

    $(this).parent().parent().children().children('.product_total_price').val(qty * price)
    // $(this).parent().parent().children('.product_total_price').val(qty * price);
    var keyWord = 0;
    $('.product_total_price').each(function () {
        if (this.value) {
            var val = parseInt(this.value);
            if (val != 'NaN') {

                keyWord += val;
                $('#sub').val(keyWord);
            }
        }
    });
    var dis = parseInt($('#discount').val());
    var sub = parseInt($('#sub').val());

    var discount = sub - (sub * dis) / 100;
    if (discount == 'NaN') {

        $('#discount_total').val(discount);
        var gst = parseInt($('#gst').val());
        var dis = parseInt($('#discount_total').val());
        var gst = dis + (dis * gst) / 100;
        $('#gst_total').val(gst);
        var gst = parseInt($('#gst_total').val());
        var wht = parseInt($('#wht').val());
        var grand = gst + (gst * wht) / 100;
        $('#grandtotal').val(grand);
    }
})
