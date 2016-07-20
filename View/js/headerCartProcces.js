/* ##################################################################################################
 ###################################################################################################
 -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:18-07-2016    -VERSION:V.0.1    -LENGUAJE:JAVASCRIPT 
 -TITULO:View/html/headerCartProcces.js 
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
 MAIN
 ============================================================================================================= */
$(document).ready(function () {
    cartProcces();
    // addClassDyn();
});

/* ============================================================================================================ 
 FUNCIONES
 ============================================================================================================= */

/* ============================================================================================================ 
 CART PROCESS
 ============================================================================================================= */
function cartProcces() {
    /* ======================================= 
     COUNT ELEMENTS CARRO PRIMERA VEZ
     ======================================== */
    /* VARIABLES */
    var sItems = 0;
    $.post("Controller/genCarroCaja.php", {opt: 1}, function () {})// COUNT ELEMENTS CARRO PRIMERA VEZ
            .done(function (data) {//DATA JSON
                //data[0]=$total_ItemsAndQty///----HELP---
                //data[1]=$total_items    ///----HELP---   
                //alert(data);///----DEBUG---
                data = JSON.parse(data);
                sItems = countItemsArregloVisualizacion(data[0]);
                $("#carro_contador").html(sItems); //total items in cart-info element
            })
            .fail(function () {
                alert("ERROR-View/html/header.js\nCOUNT ELEMENTS CARRO PRIMERA VEZ");
            })
            .always(function () {
                //alert("finished");
            });

    /* ======================================= 
     ADD ITEMS IN CART
     ======================================== */
    $("#wrpIndex .container .row").on("click", ".add_button", function (e) {
        e.preventDefault();
        /* VARIABLES */
        var id = 0;
        var qty = 1;
        var button_content = 0;

        id = $(this).attr("data-value");
        //var no = $(this).attr("data_valor_oferta");
        //
        //alert(id);///----DEBUG---
        if ($(".cart-quantity > .quant-input").find("input").length !== 0) {
            qty = $(".cart-quantity > .quant-input").find("input").val();
        }

        button_content = $(this);
        button_content.html("Añadiendo");

        $.post("Controller/genCarroCaja.php", {opt: 2, codigo_producto: id, qtyProducto: qty}, function () {})//ADD ITEMS IN CART
                .done(function (data) {//DATA JSON
                    //alert(data);///----DEBUG---
                    // alert(JSON.parse(data));///----DEBUG---
                    button_content.html('Añadir al carrito'); //reset button text to original text                    
                    if (JSON.parse(data) === true) {
                        $(".eClickCarro").trigger("click"); //trigger click on cart-box to update the items list
                    }
                })
                .fail(function () {
                    alert("ERROR-View/html/header.js\nADD ITEMS IN CART");
                })
                .always(function () {
                    //alert("finished");
                });
    });
    /* ======================================= 
     SHOW ITEMS IN CART
     ======================================== */
    $(".eClickCarro").on("click", function (e) { //when user clicks on cart box
        e.preventDefault();

        /* VARIABLES */
        var dataSanitized = 0;
        var totalItems = new Array();//data[0]=$total_ItemsAndQty,data[1]=$total_items
        var sItems = 0;

        $.post("Controller/genCarroCaja.php", {opt: 1}, function () {})// COUNT ELEMENTS CARRO PRIMERA VEZ
                .done(function (data) {//DATA JSON
                    //data[0]=$total_ItemsAndQty
                    //data[1]=$total_items
                    totalItems = JSON.parse(data);
                    $.post("Controller/genCarroCaja.php", {opt: 3}, function () {})//SHOW ITEMS IN CART
                            .done(function (data) {//DATA HTML
                                dataSanitized = data.replace(/([ ]{1,})(\r\n|\n|\r)/gm, "");
                                //alert(dataSanitized);///----DEBUG---
                                sItems = countItemsArregloVisualizacion(JSON.parse(totalItems[0]));
                                $("#carro_contador").html(sItems); //total items in cart-info element

                                $("#carro_resultados").html(dataSanitized);
                                cartProccesOverflow(totalItems[1]);
                            })
                            .fail(function () {
                                alert("ERROR-View/html/header.js\nSHOW ITEMS IN CART\nLVL 1");
                            })
                            .always(function () {
                                //alert("finished");
                            });

                })
                .fail(function () {
                    alert("ERROR-View/html/header.js\nSHOW ITEMS IN CART\nLVL 2");
                })
                .always(function () {
                    //alert("finished");
                });



    });

    /* ======================================= 
     REMOVE ITEMS FROM CART
     ======================================== */
    $("#carro_resultados").on('click', 'a.remove-item', function (e) {
        e.preventDefault();
        /* VARIABLES */
        var pcode = 0;//get product code
        pcode = $(this).attr("data-code"); //get product code

        $(this).parent().fadeOut(); //remove item element from box
        $.post("Controller/genCarroCaja.php", {opt: 4, "remove_code": pcode}, function () {})//REMOVE ITEMS FROM CART
                .done(function (data) {//DATA JSON
                    $(".eClickCarro").trigger("click"); //trigger click on cart-box to update the items list
                })
                .fail(function () {
                    alert("error");
                })
                .always(function () {
                    //alert("finished");
                });
        ;
    });
}

function countItemsArregloVisualizacion(items) {
    var sItems;
    if (items >= 0 && items < 10) {
        sItems = "&nbsp;" + items;
    }
    return sItems;
}

function cartProccesOverflow(items) {
    if (items > 3) {
        $("#carro_resultados .top-cart-items").addClass("overflowTopCartItems");
    } else {
        $("#carro_resultados .top-cart-items").removeClass("overflowTopCartItems");
    }

}

/* ============================================================================================================ 
 ANIMACION
 ============================================================================================================= */
//function addClassDyn() {
//
////    $('#carro_caja').bind('DOMNodeInserted DOMNodeRemoved',function(){
//// // alert('changed');
////});
//
//    // $(window).load(function () {
//    //alert();
//
//
//    if ($('#carro_caja').is(':visible')) {
//        //alert("visible");
//        $('#carro_caja').toggleClass("fadeInFromNone fadeOutFromFull");
//        //alert("visible");
//       // sleep(2000);
//         $('#carro_caja').toggleClass("fadeInFromNone fadeOutFromFull");
//        // $('#carro_caja').removeClass("fadeInFromNone");
////             alert("visible 1");
////             $('#carro_caja').addClass("fadeOutFromFull");
////              alert("visible 2");
////             $('#carro_caja').removeClass("fadeOutFromFull");
////             $('#carro_caja').addClass("fadeInFromNone");
//        //$('#carro_caja').toggleClass( "fadeInFromNone fadeOutFromFull" );
//    } else {
//        alert("escondido");
//        //$('#carro_caja').removeClass("fadeOutFromFull");
//        $('#carro_caja').addClass("fadeInFromNone");
//    }
//    //});
//
//}
//function sleep(milliseconds) {
//  var start = new Date().getTime();
//  for (var i = 0; i < 1e7; i++) {
//    if ((new Date().getTime() - start) > milliseconds){
//      break;
//    }
//  }
//}