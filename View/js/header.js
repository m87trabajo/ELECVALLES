/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:JAVASCRIPT 
  -TITULO:---  
  -RETRUN: --- 
  -VENTAJAS:---
  -RESUMEN:---
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:---
  ---!IMPORTANTE!---:
  ##################################################################################################
  ################################################################################################## */
/* ============================================================================================================ 
  STICKY HEADER
  ============================================================================================================= */
// get the value of the bottom of the #footer_header element by adding the offset of that element plus its height, set it as a variable
$(document).ready(function () {
    var mainbottom = $('#footer_header').offset().top + $('#footer_header').height();
    // on scroll, 
    $(window).on('scroll', function () {

        if (screen.width > 767) {
// we round here to reduce a little workload
            stop = Math.round($(window).scrollTop());
            if (stop > mainbottom) {
                $('#navegador').addClass('navbar-fixed-top');
            } else {
                $('#navegador').removeClass('navbar-fixed-top');
            }
        }
    });
});
/* ============================================================================================================ 
  CART PROCESS
  ============================================================================================================= */
$(document).ready(function () {
//$("#carro_resultados").load("func/cart_process.php", {"load_cart": "1"}); //Make ajax request using jQuery Load() & update results

    $(".add_button").on("click", function (e) {
        var id = $(this).attr("data-value");
        var no = $(this).attr("data_valor_oferta");
        if ($(".cart-quantity > .quant-input").find("input").length === 0) {
            var qty = 1;
        } else {
            var qty = $(".cart-quantity > .quant-input").find("input").val();
        }
        var button_content = $(this);
        button_content.html("Añadiendo");
        $.ajax({//make ajax request to cart_process.php
            url: "func/cart_process.php",
            type: "POST",
            dataType: "json", //expect json value from server
            data: {
                product_code: id,
                product_qty: qty,
                data_valor_oferta: no
            }
        }).done(function (data) { //on Ajax success
            $("#carro_contador").html(data.items); //total items in cart-info element
            button_content.html('Añadir al carrito'); //reset button text to original text
            $("#carro_enlace").trigger("click"); //trigger click on cart-box to update the items list
        })
        e.preventDefault();
    });
    //Show Items in Cart
    $("#carro_enlace").on("click", function (e) { //when user clicks on cart box
        e.preventDefault();
        $("#carro_resultados").html('<img src="images/ajax-loader.gif">'); //show Loading image
        $("#carro_resultados").load("func/cart_process.php", {"load_cart": "1"}); //Make ajax request using jQuery Load() & update results

    });
    //Remove items from cart
    $("#carro_resultados").on('click', 'a.remove-item', function (e) {
        e.preventDefault();
        var pcode = $(this).attr("data-code"); //get product code
        $(this).parent().fadeOut(); //remove item element from box
        $.getJSON("func/cart_process.php", {"remove_code": pcode}, function (data) { //get Item count from Server
            $("#carro_contador").html(data.items); //update Item count in cart-info
            $("#carro_enlace").trigger("click"); //trigger click on cart-box to update the items list
        });
    });
});

/* ============================================================================================================ 
  SEARCH
  ============================================================================================================= */

$(document).ready(function () {
    var select_1 = $("#select_1");
    // select_1.html("marc&nbsp;<span class=\"caret\"></span>");

    var li = $("#select_1+ul>li");
    li.each(function (index) {
        $(this).bind('click', function (e) {
            select_1.html($(this).find("a>span").text() + "&nbsp;<span class=\"caret\"></span>");
            //alert( index + ": " + $(this).text() );
        });
    });
    var select_2 = $("#select_2");
    // select_1.html("marc&nbsp;<span class=\"caret\"></span>");

    var li = $("#select_2+ul>li");
    li.each(function (index) {
        $(this).bind('click', function (e) {
            select_2.html($(this).find("a>span").text() + "&nbsp;<span class=\"caret\"></span>");
            //alert( index + ": " + $(this).text() );
        });
    });
});
/* ============================================================================================================ 
  DATA HOVER MENU SEGUN TAMAÑO PANTALLA
  ============================================================================================================= */
$(document).ready(function () {
    if (screen.width > 767) {
        $("#menu ul>li.dropdown > a").removeAttr("data-toggle");
        /* $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-toggle" );  */
    } else {
        $("#menu ul>li.dropdown > a").removeAttr("data-hover");
        /* $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-hover" );*/
    }

    $(window).on('resize', function () {
        if (screen.width > 767) {
            $("#menu ul>li.dropdown > a").attr("data-hover", "dropdown");
            $("#menu ul>li.dropdown > a").removeAttr("data-toggle");
            /*$("#mini_menu li:nth-child(2) a" ).attr( "data-hover", "dropdown" );
             $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-toggle" );   */
        } else {
            $("#menu ul>li.dropdown > a").attr("data-toggle", "dropdown");
            $("#menu ul>li.dropdown > a").removeAttr("data-hover");
            /* $("#mini_menu li:nth-child(2) a" ).attr( "data-toggle", "dropdown" );  
             $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-toggle" );   */
        }
    });
});

