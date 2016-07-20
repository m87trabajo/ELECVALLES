/* ##################################################################################################
 ###################################################################################################
 AUTOR:ELCACHO GRNADOS,MARC    FEHCA:00-00-2016    VERSION:V.0.0    LENGUAJE:JAVASCRIPT 
 TITULO:mainIndex.php
 RETRUN:  
 VENTAJAS:
 RESUMEN:
 DATABASE:
 FUNCIONAMIENTO:
 ERRORES:
 ---!IMPORTANTE!---:
 ##################################################################################################
 ################################################################################################## */


/* ============================================================================================================ 
 MAIN
 ============================================================================================================= */
$(window).load(function () {//Todo el DOM cargado, imagenes...
    $(document).scrollTop(0);
    //alert("MARC");
    genTabSlider();
    genGroupTabSlider();
});


/* ============================================================================================================ 
 FUNCIONES
 ============================================================================================================= */
/* ===================================================================================== 
 ---SCROLL DOWN---
 ---AJAX AUTO LOAD GRUPOS TABS SLIDER---Controller/AJAXTabSlider.php
 ======================================================================================
 http://api.jquery.com/jquery.ajax/
 http://stackoverflow.com/questions/905298/jquery-storing-ajax-response-into-global-variable
 =========================================================================================== */
function genTabSlider() {
    //scrollTab();
    var Loading = false; //to prevents multipal ajax loads
    var Finish = false; //Condicion de paro
    var FlagFirstLoop = false; //Cnt empieza siempre por 1
    var TrackLoad = 0; //Indica cuantos <sections> ahy en la pagina
    var obj = null;//obj[0]=$IN_NumTabs=4, obj[1]=$CounGroups=18 devuelto por JSON "Controller/AJAXNavTabSlider.php"
    var limitTabSlider = 0;
    var NextItem = 0;
    var jqxhr = null; //Objeto JSON devuelto por 

    $(window).scroll(function (e) { //detect page scroll
        e.preventDefault();
        if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
        {
            if (Loading === false && Finish === false) {
                Loading = true;
                //alert(FlagFirstLoop);///--DEBUG--

                //Devuelve $IN_NumTabs=4 y $CounGroups=18 Para tener una condicion de paro.
                if (FlagFirstLoop === false) {
                    FlagFirstLoop = true;
                    jqxhr = $.ajax({
                        async: false, //synchronously. 
                        type: "POST",
                        dataType: "json", //JSON type  data expecting back from the server.
                        global: false,
                        url: "Controller/AJAXNavTabSlider.php",
                        success: Done,
                        error: Fail
                    }).responseText;

                    function Done(data) { //on Ajax success
                        //alert(data);///--DEBUG--                        
                    }
                    ;
                    function Fail() {
                        alert("Error en mainIndex.js AJAX AUTO LOAD GRUPOS TABS SLIDER\nPART 1")
                    }
                    ;

                    /*DATA*/
                    obj = JSON.parse(jqxhr);
                    /*SOLO SE EJECUTA UNA VEZ*/
                    limitTabSlider = Math.ceil(obj[1] / obj[0]);
                }
                ;

                //obj[0]=$IN_NumTabs=4///----HELP----
                //obj[1]=$CounGroups=18///----HELP---
                //alert(obj[0] + ',' + obj[1]);///--DEBUG--
                TrackLoad = $("section.wrpTabSlider").length;////Indica cuantos <sections> ahy en la pagina
                NextItem = TrackLoad + 1;
                //alert(TrackLoad + "TrackLoad")///--DEBUG--
                //alert(TrackLoad + 1);
                //TrackLoad se actualiza cada vez que se produce scroll en ventana
                //(TrackLoad+1) SI TENEMOS 2 PUESTOS MIRAMOS QUE EL QUE VAYA A PONER NO SALGA DE Math.ceil(obj[1] / obj[0])
                /*QUEDAN POR PONER TAB SLIDER*/
                if (NextItem <= limitTabSlider && NextItem > 0) {
                    $.ajax({
                        async: true, //asynchronously. 
                        type: "POST",
                        dataType: "html", //HTML type  data expecting back from the server.
                        url: "Controller/genTabSlider.php",
                        success: Done,
                        error: Fail,
                        data: {
                            TrackLoad: TrackLoad
                        }
                    });

                    function Done(data) { //on Ajax success
                        //alert(data);///----DEBUG---
                        // var dataSanitized = data.replace(/([ ]{1,})(\r\n|\n|\r)/gm, "");
                        //Data es HTML sin espacios ni CRLF. no santizar arreglar PHP
                        $("#wrpIndex .container .row").first().append(data);
                        // init carousel   
                        //Solo carga el ultimo tab slider creado
                        $("section.wrpTabSlider").last().find('.home-owl-carousel').each(function () {
                            var owl = $(this);
                            var itemPerLine = owl.data('item');
                            if (!itemPerLine) {
                                itemPerLine = 4;
                            }
                            owl.owlCarousel({
                                items: itemPerLine,
                                itemsTablet: [768, 2],
                                navigation: true,
                                pagination: false,
                                navigationText: ["", ""]
                            });
                        });
                    }
                    ;

                    function Fail() {
                        alert("Error en mainIndex.js AJAX AUTO LOAD GRUPOS TABS SLIDER\nPARTE 2");
                    }
                    ;

                } 
                /*SI ES IGUAL AL MAXIMO O SE A PASADO PON FOOTER*/
                if (NextItem === limitTabSlider || NextItem > limitTabSlider) {
                    Finish = true;/*PARA EJECUCCION YA SE HAN COLOCADO TODOS LOS ELEMENTOS CUANDO SCROLL NO ENTRARA MAS*/
                    Loading = true;//to prevents multipal ajax loads, when Finish=1 also Loading=1 for prevent bucle
                    $.get("Controller/genFooter.php", function () {
                    }, "html")
                            .done(function (data) {
                                // var dataSanitized = data.replace(/([ ]{1,})(\r\n|\n|\r)/gm, "");
                                //Data es HTML sin espacios ni CRLF. no santizar arreglar PHP
                                $("#wrpIndex").after(data);
                            })
                            .fail(function () {
                                alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXTabSlider.php")
                            });
                    //alert("data" + data);///----DEBUG---
                    //alert("amth" + Math.ceil(obj[1] / obj[0]));///----DEBUG---
                    //alert("finish");///----DEBUG---
                }
                Loading = false;//to prevents multipal ajax loads
            }
        }
    });
}

/*  =================================================================================== 
 ---ON CLICK TAB de TABSLIDER---
 ---AJAX CLICK EN TAB DE GRUPOS TABS SLIDER---Controller/AJAXNavTabSlider.php
 ======================================================================================                       */
function genGroupTabSlider() {
    $("#wrpIndex .container .row ").on("click", ".scroll_tabs .nav_tab_line li a", function (e) {
        e.preventDefault();
        var elementA = $(this); //OBJECT CLICKED
        var href = elementA.attr("href"); //#BAÑO_Y_GRIFERÍA Obtiene de new-products nav nav-tabs nav_tab_line el nombre de grupo apretado
        var nameGroupUnderScore = href.replace(/#/gi, ""); //BAÑO_Y_GRIFERÍA Perform a global, case-insensitive replacement:
        var nameGroup = nameGroupUnderScore.replace(/_/gi, " "); //BAÑO Y GRIFERÍA
        var elemSection = elementA.closest("section"); //Elemento <section> hacia arriba mas cercando del elemento apretado
        var elementH3 = elemSection.find("h3.new_product_title");
        elementH3.text(nameGroup);

        if ($(href).length === 0) {//SI NO EXISTE LO CREA
            var WrapperProducts_TBS = elemSection.find(".WrapperProducts_TBS"); //Contenedor dnd se generan el prodcut tab slider del grupo

            //Llama a Controller/AJAXNavTabSlider.php pasandole por parametro el NOMBRE del GRUPO
            $.ajax({
                async: true, //asynchronously. 
                type: "POST",
                dataType: "json", //JSON type  data expecting back from the server.
                url: "Controller/AJAXGroupTabSlider.php",
                beforeSend: BeforeLoad,
                success: Done,
                error: Fail,
                data: {
                    nameGroup: nameGroup
                }
            });

            function BeforeLoad() {

            }

            function Done(data) { //on Ajax success
                //alert(data);///--DEBUG--
                $.ajax({
                    async: true, //asynchronously. 
                    type: "POST",
                    dataType: "html", //HTML type  data expecting back from the server.
                    url: "Controller/genTabSlider.php",
                    beforeSend: BeforeLoad,
                    success: Done,
                    error: Fail,
                    data: {
                        GroupItem: data,
                        nameGroupUnderScore: nameGroupUnderScore
                    }
                });

                function BeforeLoad() {
                    elemSection.find(".WrapperProducts_TBS > div").removeClass("active");
                    WrapperProducts_TBS.prepend('<div class="ajaxLoad"><img src="View/img/ajaxLoad.gif"></div>');
                }

                function Done(data) { //on Ajax success
                    //alert(data);///--DEBUG--
                    var elementLi = elemSection.find("ul.nav_tab_line > li");
                    elementLi.removeClass("hide");
                    elementA.closest("li").addClass("hide");

                    elemSection.find(".WrapperProducts_TBS > div").removeClass("active");

                    // var dataSanitized = data.replace(/([ ]{1,})(\r\n|\n|\r)/gm, "");
                    //Data es HTML sin espacios ni CRLF. no santizar arreglar PHP

                    WrapperProducts_TBS.append(data);


                    // init carousel
                    var owl = $(href);
                    owl = owl.find(".home-owl-carousel");
                    var itemPerLine = owl.data('item');
                    if (!itemPerLine) {
                        itemPerLine = 4;
                    }

                    $(".ajaxLoad").remove();
                    owl.owlCarousel({
                        items: itemPerLine,
                        itemsTablet: [768, 2],
                        navigation: true,
                        pagination: false,
                        navigationText: ["", ""]
                    });
                    //$('.rating').rateit({max: 5, step: 1, value: 4, resetable: false, readonly: true});

                }
                ;

                function Fail() {
                    alert("Error en handmade.js AJAX CLICK EN TAB DE GRUPOS TABS SLIDER.\nPARTE LVL 2")
                }

            }
            ;
            function Fail() {
                alert("Error en handmade.js AJAX CLICK EN TAB DE GRUPOS TABS SLIDER.\nPARTE LVL 1")
            }
        }
    });
}

