$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.delete', function (e) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let url = $(this).attr('data-url');

                $.ajax({
                    url: url,
                    type: 'DELETE',
                }).done(function (res) {
                    $('#data').html(res.data);
                    toastr.success(res.msg, 'Success');
                    $('#dataTable').DataTable({
                        "destroy": true,
                    });
                }).fail(function (jqXHR, status, error) {
                    toastr.error(error, 'Error');
                });
                swal.close()
            }
            else {
                swal.close();
            }
        });
    });



    $('#pro').change(function () {
        var type = $('#pro').val();
        var url = '/profit';
        var token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "_token": token,
                "type": type,
            },

        }).done(function (res) {
            $('#data').html(res.data);
        }).fail(function (res) {
            toastr.alert(res.msg);
        });
    });

    $('.clear').click(function () {
        var data = $(this).attr('data-url');
        var url = '/clear';
        var token = $("meta[name='csrf-token']").attr("content");
        data = data.split(',');
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                "_token": token,
                "id": data[0],
                "month": data[1],
                "year": data[2],
                "vehicle": data[3],
            },

        }).done(function (res) {
            window.location.reload();
        }).fail(function (res) {
            toastr.alert(res.msg);
        });
    });

});
