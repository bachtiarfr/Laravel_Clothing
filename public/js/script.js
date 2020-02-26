$(document).ready(function () {
    console.log('transaction ready');
    $('#cekot').click(function () {
        console.log('cekout');

    })
})
function viewData() {

    $.get('/cart/customers', function (data) {
        Object.keys(data).forEach(function (cart) {
            // const tot = Math(data[cart].price * data[cart].qty);

            $('.CartItems').append(
                '<div class="items">' +
                data[cart].product_name + ' (' + data[cart].qty + ')' + '<br>' +
                ' Rp : ' + data[cart].price + '<i class="fa fa-trash deleteCartItems" data-id="' + data[cart].id + '" style="float : right; margin-right: 20px;"></i>' + '<br>' +
                '</div>')

            $('.isiTable').append('<tr class="tablerow text-center">' +
                '<td>' +
                '<h2 class="h5 text-black">' + data[cart].product_id + '</h2>' +
                '</td>' +
                '<td>' +
                '<h2 class="h5 text-black">' + data[cart].product_name + '</h2>' +
                '</td>' +
                '<td>' +
                '<h2 class="h5 text-black">' + data[cart].qty + '</h2>' +
                '</td>' +
                '<td>' +
                '<h2 class="h5 text-black">Rp. ' + data[cart].price + ' ,-</h2>' +
                '</td>' +
                '<td>' +
                '<h2 class="h5 text-black">Rp. ' + data[cart].price * data[cart].qty + ' ,-</h2>' +
                '</td>' +
                '<td><i class="fa fa-trash deleteTableData" data-cartid="' + data[cart].id + '"></i></td>' +
                '</tr>')
        });

        $('.deleteTableData').click(function () {
            var id = $(this).data("cartid");
            var data = {
                id
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/cart/delete/" + id,
                type: "delete",
                data: data,
                success: function () {

                    $('.tablerow').remove();
                    $('.items').remove();
                    viewData();
                    console.log(id + 'terhapus');

                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })
        });


        $('.deleteCartItems').click(function () {
            var id = $(this).data("id");

            var data = {
                id
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/cart/delete/" + id,
                type: "delete",
                data: data,
                success: function () {

                    $('.items').remove();
                    $('.tablerow').remove();
                    viewData()
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            })

        });
    });
}

//add to cart
$(document).ready(function () {
    console.log('ready');

    viewData();
    console.log('masuk');

    $('.Cart').click(function () {
        $('#sidebar').toggle('slow');
    })
    $('#cart_close').click(function () {
        $('#sidebar').toggle('slow');
    })

    $('.AddVoucher').click(function () {
        var id = $(this).data('voucher');
        var data = { id };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/voucher/add",
            type: "post",
            data: data,
            success: function (data) {
                alert('success');
            },
            dataType: "json"
        });
    })

    $('.AddToCart').click(function () {
        $('#sidebar').show();

        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $(this).data('price');
        var data = {
            id,
            name,
            price,
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/cart/add",
            type: "post",
            data: data,
            success: function (data) {
                $('.items').remove();
                viewData();
            },
            dataType: "json"
        });
        console.log(id, name, price);

    })

})
