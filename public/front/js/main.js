$(document).ready(function () {

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[а-яА-Яa-zA-Z]+$/i.test(value);
        /^[а-яА-Яa-zA-Z]+$/
    }, "Only alphabetical characters");
    $('#orderForm').validate({

        rules: {
            name: {
                required: true,
                minlength: 3,
                lettersonly: true
            },
            tel: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 13
            },
            email: {
                required: true,
                email: true
            },
            adress: {
                required: true
            },

            company_name: {}
        },
        errorPlacement: function () {
            return false;
        }
    });

    if($('#product_type').val()=='packages'){
        $('.delivery_price').hide();
        $('#delivery_fee').val(0);
    }
    window.count_total = function () {

         var related_count_price = Array.from($('input[name^=related_count_price]')).reduce(function(sum, elem) {
            return +sum + +$(elem).val();
          },0);
        var product_total_price = ($('.product_total_price').html()=="")?0:$('.product_total_price').html();
        var related_total_price = related_count_price;
        var delivery_fee =($('#delivery_fee').val()=="" || typeof $('#delivery_fee').val() == 'undefined')?0:parseInt($('#delivery_fee').val());


        if($('#delivery_fee').val() == 'in' ){
            delivery_fee = 1000;
        }
        else if($('#delivery_fee').val() == 'out'){
            delivery_fee = 0;
        }
        var total_amount = parseInt(product_total_price) + parseInt(related_total_price) + parseInt(delivery_fee);
        $('.total_amount').html(total_amount);
        // $('#total_amount').val(total_amount);
    }
    count_total();


    svg4everybody({});
    $('.related_divs').hide();
    $('.rent_for_period').hide();
    $('.delivery_text').hide();


    $(function () {
        $('.calendar_from').datepicker({
            format: 'dd.mm.yyyy',
            autoclose: true,
            startDate: "+1d"
        }).on('changeDate', function () {
            var minDate = $(this).datepicker('getDate');
            $(".calendar_to").datepicker("setStartDate", minDate);
            var minDateSeconds = minDate.getTime() / 1000;
            var maxDateSeconds = ( $('.calendar_to').datepicker('getDate') == null) ? 0 : $('.calendar_to').datepicker('getDate').getTime() / 1000;
            if (maxDateSeconds != 0) {
                var differenceSec = maxDateSeconds - minDateSeconds;
                var days = (differenceSec / (24 * 3600)) + 1;
                $('.product_total_price').html(days * product_price);
                $('.from_data_span').html($('.calendar_from').val());
                $('.to_data_span').html($('.calendar_to').val());
                $('.rent_for_period').fadeIn();

                count_total();
            }
        });
    });
    $(function () {
        $('.calendar_to').datepicker({
            format: 'dd.mm.yyyy',
            autoclose: true,
            startDate: "+1d"
        }).on('changeDate', function () {
            var maxDate = ($(this).datepicker('getDate'));
            $(".calendar_from").datepicker("setEndDate", maxDate);
            var maxDateSeconds = maxDate.getTime() / 1000;
            var minDateSeconds = ( $('.calendar_from').datepicker('getDate') == null) ? 0 : $('.calendar_from').datepicker('getDate').getTime() / 1000;
            if (minDateSeconds != 0) {
                var differenceSec = maxDateSeconds - minDateSeconds;
                var days = (differenceSec / (24 * 3600)) + 1;
                var product_price = $('#product_price').val();
                $('.product_total_price').html(days * product_price);
                $('.from_data_span').html($('.calendar_from').val());
                $('.to_data_span').html($('.calendar_to').val());
                $('.rent_for_period').fadeIn();

                count_total();
            }
        });
    });

    $('#SelfDelivery').click(function () {
        $('.address_field').val("");
        $('.address_row').hide();
        $('.delivery_price').hide();
        $('#delivery_fee').val(0);
        count_total();

    });
    $('#SelfDelivery2').click(function () {
        $('.address_row').show();
        $('.delivery_price').show();
        $('#delivery_fee').val();
        count_total();
    });


    $('#nav-wraper').wrap('<div class="nav-placeholder"></div>');
    $('.nav-placeholder').height($('#nav-wraper').outerHeight());

    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('#nav-wraper').addClass('default').fadeIn('slow');
        } else {
            $('#nav-wraper').removeClass('default').fadeIn('slow');
        }
    });

    $('.owl-carousel').owlCarousel({
        nav: true,
        loop: true,
        items: 5,
        smartSpeed: 700,
        rewindNav: true,
        navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'</i>"],
        dots: false,
        autoplay: false,
        responsive: {
            320: {
                items: 1,
                nav: false
            },
            600: {
                items: 3
            },
            991: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    });

    $('.information-input').keyup(function () {
        $('.icon-check-ok').addClass('active');
        if ($('.information-input').val() == "") {
            $('.icon-check-ok').removeClass('active');
        }
    });

    $('a[data-target^="anchor"]').on('click', function () {
        var target = $(this).attr('href'),
            bl_top = $(target).offset().top;
        $('body, html').animate({scrollTop: bl_top - 100}, 1500);
        return false;
    });
    $(".form-tel").keyup(function () {
        $(this).val(this.value.match(/[0-9]*/));
    });
    $(".quantity-number").keyup(function () {
        $(this).val(this.value.match(/[0-9]*/));
    });
    $(".form-name").keyup(function () {
        $(this).val(this.value.match(/^[-a-zA-Z\u0410-\u044F`]+$/));
    });

    $("#form").submit(function () {
        event.preventDefault();
        var formData = $("#form").serialize();
        $.ajax({
            type: 'POST',
            url: $("#form").attr('action'),
            data: formData,
        }).done(function (data) {
            $("#form").html("<h4 style='color:#4d4d4d'>" + data + "</h4>");
        });
        return false;
    });
    $("#modal-form").submit(function () {
        event.preventDefault();
        var formData = $("#modal-form").serialize();
        $.ajax({
            type: 'POST',
            url: $("#modal-form").attr('action'),
            data: formData,
        }).done(function (data) {
            $('#modal-form').html("<img style='width:50px;height:50px;' src='" + window.location.origin + "/public/front/img/content/checked.png'>");
            setTimeout(function () {
                $('#exampleModal').modal('hide');
            }, 3000);
        });
        return false;
    });
    $("#feedback_form").submit(function () {
        event.preventDefault();
        var formData = $("#feedback_form").serialize();
        $.ajax({
            type: 'POST',
            url: $("#feedback_form").attr('action'),
            data: formData,
        }).done(function (data) {
            $('.feedback_div').html("<h4 style='color:#4d4d4d;margin-top: 40px'>" + data + "</h4>");
        });
        return false;
    });

    $('.related_checkbox').click(function (e) {
        var id = $(this).val();
        $('#related_count_price_top'+id).toggle(function () {
            $('.related_total_div'+id).toggle();
        if ($(e.target).prop('checked')){ 
                $('#quantity-number'+id).val(1);
                $('.related_total_price'+id).html( parseInt($('#related_price'+id).val())  );
                $('#related_count_price'+id).val(parseInt($('#related_price'+id).val()));
                // $('#related_count_price'+id).val(0);
                // $('#related_total_price').val($('#related_price').val());
            }
            else {
                $('#quantity-number'+id).val(0);
                $('.related_total_price'+id).html(0);
                $('#related_count_price'+id).val(0);
                // $('#related_total_price').val(0);
            }
            count_total();
        });
    });
    $('.minus').click(function () {
        var id = $(this).parent().find('.related_product_id').val();
        var $input = $('#quantity-number'+id);
        var $price = $('#related_price'+id);
        // var $total_price = $(this).parents("#related_count_price_top").find("input[id='related_total_price']");
        if ($input.val() == '') {
            $input.val(0);
        }
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        var $new_price = $input.val() * $price.val();
        // $total_price.val($new_price);
        // $('#related_total_price').val($new_price);
        $(".related_total_price"+id).html($new_price);
        $('#related_count_price'+id).val($new_price);

        count_total();
        return false;
    });
    $('.plus').click(function () {
        var id = $(this).parent().find('.related_product_id').val();
        var $input = $('#quantity-number'+id);
        var $price = $('#related_price'+id);
        // var $total_price = $(this).parents("#related_count_price_top").find("input[id='related_total_price']");
        if ($input.val() == '') {
            $input.val(0);
        }
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        var $new_price = $input.val() * $price.val();
        // $total_price.val($new_price);
        // $('#related_total_price').val($new_price);
        $(".related_total_price"+id).html($new_price);
        $('#related_count_price'+id).val($new_price);
        count_total();
        return false;
    });


    ymaps.ready(init);
    var myMap,
        myPlacemark1;

    function init() {
        myMap = new ymaps.Map("map", {
            center: [55.661394, 37.555436],
            zoom: 15,
            controls: ['zoomControl'],
            behaviors: ['drag']
        });

        myMap.controls.remove('typeSelector');
        myMap.controls.remove('fullscreenControl');

        myPlacemark1 = new ymaps.Placemark([55.661394, 37.555436], {
            balloonContentHeader: 'Москва, ул. Наметкина 14, корп.1'
        });

        myMap.geoObjects.add(myPlacemark1);
    }

    $('.licenseprod_price').hide();

    $('.add_product').on('click', function () {
        if ($(this).prop('checked')) {
            console.log($(this).val());
            $('.licenseprod_price').fadeIn();
            $('#total_lprod_amount').val(  (parseInt($('#total_lprod_amount').val()) + parseInt(   ($(this).val()=="")?0:$(this).val() )  ));
            $('.total_lprod_amount').html($('#total_lprod_amount').val());
        }
        else {
            $('#total_lprod_amount').val((parseInt($('#total_lprod_amount').val()) - parseInt(   ($(this).val()=="")?0:$(this).val() )));
            $('.total_lprod_amount').html($('#total_lprod_amount').val());
        }
    });
    $('.license-prod-to-card').click(function () {
        if ($('#total_lprod_amount').val() == 0) {
            return false;
        }
    });


});