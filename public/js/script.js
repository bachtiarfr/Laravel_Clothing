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

    $('.form-check-ongkir').click(function() {
        // console.log('checked');
        var province_origin = $('#province_origin').val();
        var city_origin = $('#city_origin').val();
        var province_destination = $('#province_destination').val();
        var city_destination = $('#city_destination').val();
        var courier = $('#courier').val();
        var weight = $('#weight').val();

        var province_origin_text = $('#province_origin option:selected').text();
        var city_origin_text = $('#city_origin option:selected').text();
        var province_destination_text = $('#province_destination option:selected').text();
        var city_destination_text = $('#city_destination option:selected').text();

        var data = {
            "_token": $('#token').val(),
            'province_origin' : province_origin,
            'city_origin' : city_origin,
            'province_destination' : province_destination,
            'city_destination' : city_destination,
            'courier' : courier,
            'weight' : weight,
        }

        // console.log('data ongkir', data);
        var nama;

        $.ajax({
            url : '/submit_check_ongkir',
            method : 'POST',
            data : data,
            success : function(result) {
                console.log('all data', result);
                nama = result[0].name 
               
                $.each( result, function( key, value ) {
                    // alert( key + ": " + value );
                    // console.log('value', value);
                    var table = '<tr><td>'+ value.description +'</td>';
                    $.each(value.cost, function(key, val){
                        table += '<td>'+'Rp. '+ val.value +'</td>';
                        table += '<td>'+ val.etd+ ' hari' +'</td>';
                    })
                    table += '</tr>';
                    $('.show_data_cost').append(table);
                  });
                $('.show_city_origin').html(city_origin_text + ',' + province_origin_text);
                $('.show_city_destination').html(city_destination_text + ',' + province_destination_text);
                $('.show_courier').html(nama);
                $('.show_weight').html(weight);

            }
        })      
        
    })
    
    $('select[name="province_origin"]').on('change', function() {
        let provinceId = $(this).val();
        // console.log('chaged', provinceId);
        if (provinceId) {
        jQuery.ajax({
            url: '/province/'+provinceId+'/cities',
            type: "GET",
            dataType:"json",
            success:function(data) {
            console.log('get province success');
            $('select[name="city_origin"]').empty();
            $.each(data, function(key, value) {
                $('select[name="city_origin"]').append('<option value="'+key+'">'+value+'</option>');
            });
            },
        });
        } else {
        $('select[name="city_origin"]').empty();
        }
    });
    
    $('select[name="province_destination"]').on('change', function() {
        let provinceId = $(this).val();
        if (provinceId) {
        jQuery.ajax({
            url:'/province/'+provinceId+'/cities',
            type:"GET",
            dataType:"json",
            success:function(data) {
            $('select[name="city_destination"]').empty();
            $.each(data, function (key, value) {
                $('select[name="city_destination"]').append('<option value="'+key+'">'+value+'</option>');
            });
            },
        });
        } else {
            console.log('not oke');
        $('select[name="city_destination"]').empty();
        }
    });

    
    

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
