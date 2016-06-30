/*===================================================================================*/
/*	STICKY HEADER
 /*===================================================================================*/
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
/*===================================================================================*/
/*	CART PROCESS
 /*===================================================================================*/
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
        $("#carro_resultados").html('<img src="images/ajax-loader.gif">'); //show loading image
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
/*===================================================================================*/
/*	AJAX GRUPOS TABS SLIDER
 /*===================================================================================*/
$(document).ready(function () {
    $(".scroll_tabs .nav_tab_line li a").on("click", function (e) {

        var href = $(this).attr("href");//Obtiene de new-products nav nav-tabs nav_tab_line el nombre de grupo apretado
        href = href.replace(/#/gi, ""); //Perform a global, case-insensitive replacement:
        href = href.replace(/_/gi, " "); //BAÑO Y GRIFERÍA

        //Llama a Controller/ajaxGroupTabsSlider.php pasandole por parametro el NOMBRE del GRUPO
        $.ajax({
            async: true, //By default, all requests are sent asynchronously (i.e. this is set to true by default). 
            type: "POST",
            dataType: "json", //The type of data that you're expecting back from the server.
            url: "Controller/ajaxGroupTabsSlider.php",
            //beforeSend:Enviar,
            success: Resultado,
            //error:Fallos,
            data: {
                product_code: href
            }
        })
        e.preventDefault();

        //Si Ajax succes
        function Resultado(data) { //on Ajax success
            var html = '';//Contiene conjuto de productos de un grupo a insertar
            var string_vNO = 'vNO=N&';
            var data_valor_oferta = 'N';

            var nameGroup = data[0]['grupo'];// #BAÑO_Y_GRIFERÍA
            nameGroup = nameGroup.replace(/ /gi, "_"); //Perform a global, case-insensitive replacement:


            var owl = $('#' + nameGroup);
            var owl2 = owl.find(".home-owl-carousel");
            
            if ($("#" + nameGroup).length ==0) {
                var elemSection=$('a[href="#'+nameGroup+'"]').closest( "section" );
                var wrapper_products=elemSection.find(".wrapper_products");
                elemSection.find(".wrapper_products > div").removeClass("active");

                html+='<div id='+nameGroup+' class="tab-pane active">\n';  
                html+=      '<div class="product-slider">\n';
                html+=          '<div class="owl-carousel home-owl-carousel custom-carousel owl-theme" >\n';


                $.each(data, function (i, item) {
                        html+=        '<div class="item item-carousel">\n';
                        html+=            '<div class="products">\n';

                        html+=                '<div class="product">\n';
                        html+=                    '<div class="product_image">\n';
                        html+=                        '<div class="image">\n';
                        html+=                           '<a href="detail.php?'+string_vNO + 'cod='+ item['codigo_producto'] +'"><img  src="img_productos/'+item['imagen']+'.jpg" alt="'+item['nombre_producto']+'"></a>\n';
                        html+=                        '</div><!-- /.image -->\n';

                        html+=                        '<div class="tag new"><span>new</span></div>\n';
                        html+=                    '</div><!-- /.product_image -->\n';

                        html+=                    '<div class="product_info text-left">\n';
                        html+=                        '<h3 class="name">\n';
                        html+=                            '<a href="detail.php?'+string_vNO + 'cod='+ item['codigo_producto'] +'">'+item['nombre_producto']+'</a>\n';
                        html+=                                '</h3>\n';
                       // html+=                        '<div class="rating rateit-small"></div>\n';
                        html+=                        '<div class="id_product">\n';
                        html+=                            '<span class="value">'+ item['codigo_producto'] +'</span>\n';
                        html+=                        '</div>\n';  

                        html+=                        '<div class="product_price">\n';
                        html+=                            '<span class="price">'+item['pvp']+'</span>\n';
                        html+=                            '<span class="price_before_discount">'+item['pvp_incrementado']+'</span>\n';
                        html+=                        '</div><!-- /.product_price -->\n';

                        html+=                    '</div><!-- /.product_info -->\n';
                        html+=                    '<div class="cart clearfix">\n';

                        html+=                        '<div class="action">\n';
                        html+=                            '<ul class="list-unstyled">\n';
                        html+=                                '<li class="add_cart_button btn-group">\n';
                        html+=                                    '<button type="button" data-toggle="dropdown" class="btn btn-primary icon">\n';
                        html+=                                        '<i class="fa fa-shopping-cart"></i>\n';
                        html+=                                    '</button>\n';
                        html+=                                    '<button type="button" class="btn btn-primary add_button" data_valor_oferta ="'+data_valor_oferta+'" data-value="'+ item['codigo_producto'] +'">Añadir al carrito</button>\n';

                        html+=                                '</li>\n';

                        html+=                                '<li class="lnk wishlist">\n';
                        html+=                                    '<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">\n';
                        html+=                                        '<i class="fa fa-heart"></i>\n';
                        html+=                                    '</a>\n';
                        html+=                                '</li>\n';

                        html+=                                '<li class="lnk">\n';
                        html+=                                    '<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">\n';
                        html+=                                        '<i class="fa fa-retweet"></i>\n';
                        html+=                                    '</a>\n';
                        html+=                                '</li>\n';
                        html+=                            '</ul>\n';
                        html+=                        '</div><!-- /.action -->\n';
                        html+=                    '</div><!-- /.cart -->\n';
                        html+=                '</div><!-- /.product -->\n';

                        html+=            '</div><!-- /.products -->\n';
                        html+=        '</div><!-- /.item -->\n';    
                });

                html+=          '</div><!-- /.home-owl-carousel -->\n';
                html+=      '</div><!-- /.product-slider -->\n';
                html+='</div><!-- /.tab-pane -->\n';
            
                wrapper_products.append(html);


                //$.getScript( "View/js/scripts.js")
                //init carousel
                var owl = $('#'+nameGroup);
                var owl2=owl.find(".home-owl-carousel");

                owl2.owlCarousel({
                    items : 4,
                    itemsTablet:[768,2],
                    navigation : true,
                    pagination : false,
                    transitionStyle: "fade",
                    navigationText: ["", ""]
                });
//                
//             $('.rating').rateit({max: 5, step: 1, value : 4, resetable : false , readonly : true});
            }
        }
        ;
    });
});

/*===================================================================================*/
/*  SEARCH
 /*===================================================================================*/
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
/*===================================================================================*/
/*  DATA HOVER MENU SEGUN TAMAÑO PANTALLA
 /*===================================================================================*/
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

