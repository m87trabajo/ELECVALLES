/* ##################################################################################################
 ###################################################################################################
 -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:18-07-2016    -VERSION:V.0.1    -LENGUAJE:JAVASCRIPT 
 -TITULO:View/html/header.js 
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
    stickyHeader();
    search();
    dataHoverXS();
});


/* ============================================================================================================ 
 FUNCIONES
 ============================================================================================================= */
/* ============================================================================================================ 
 STICKY HEADER
 ============================================================================================================= */
// get the value of the bottom of the #footer_header element by adding the offset of that element plus its height, set it as a variable
function stickyHeader() {
    var mainbottom = $('#footer_header').offset().top +$('#stickyHeader').height();
    // on scroll, 
    //alert(mainbottom);
    $(window).on('scroll', function () {

        //if (screen.width > 767) {

        var stop = Math.round($(window).scrollTop());// we round here to reduce a little workload
        if (stop > mainbottom) {
            $('#stickyHeader').addClass('navbar-fixed-top');
        } else {
            $('#stickyHeader').removeClass('navbar-fixed-top');
        }
        //}
    });
}

/* ============================================================================================================ 
 SEARCH
 ============================================================================================================= */
function search() {
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
}
/* ============================================================================================================ 
 DATA HOVER MENU EN XS SEGUN TAMAÑO PANTALLA
 ============================================================================================================= */
function dataHoverXS() {
    var menu = $('#navegador #menu ul:first-child');


    if (screen.width > 767) {
        menu.find('li.dropdown > a').removeAttr("data-toggle");
        /* $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-toggle" );  */
    } else {
        menu.find('li.dropdown > a').removeAttr("data-hover");
        /* $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-hover" );*/
    }

    $(window).on('resize', function () {
        if (screen.width > 767) {
            menu.find('li.dropdown > a').attr("data-hover", "dropdown");
            menu.find('li.dropdown > a').removeAttr("data-toggle");
            /*$("#mini_menu li:nth-child(2) a" ).attr( "data-hover", "dropdown" );
             $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-toggle" );   */
        } else {
            menu.find('li.dropdown > a').attr("data-toggle", "dropdown");
            menu.find('li.dropdown > a').removeAttr("data-hover");
            /* $("#mini_menu li:nth-child(2) a" ).attr( "data-toggle", "dropdown" );  
             $("#mini_menu li:nth-child(2) a" ).removeAttr( "data-toggle" );   */
        }
    });
}


