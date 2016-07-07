/*===================================================================================*/
/*	---AJAX AUTO LOAD GRUPOS TABS SLIDER---Controller/AJAXGroupTabSlider.php
 /*===================================================================================*/
/*http://api.jquery.com/jquery.ajax/
 http://stackoverflow.com/questions/905298/jquery-storing-ajax-response-into-global-variable*/

$(document).ready(function () {
    //scrollTab();
    var Loading = false; //to prevents multipal ajax loads
    var Finish = false; //FLAG VALOR MAXIMO Cuantos tabs slider pondra como maximo
    var MaxLimit = 1; //Cnt empieza siempre por 1
    var TrackLoad = 0; //Indica cuantos <sections> ahy en la pagina

    $(window).scroll(function () { //detect page scroll
        if ($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
        {
            if (Loading === false && Finish === false) {
                Loading = true;
                //alert(MaxLimit);
                if (MaxLimit === 1) {
                    var jqxhr = $.ajax({
                        async: false, //By default, all requests are sent asynchronously (i.e. this is set to true by default). 
                        type: "POST",
                        dataType: "json", //The type of data that you're expecting back from the server.
                        global: false,
                        //async:false,
                        url: "Controller/AJAXNavTabSlider.php",
                        success: Resultado,
                        error: Fail
                    }).responseText;
                    //e.preventDefault();

                    function Resultado(data) { //on Ajax success
                        //alert(data);///--DEBUG--
                        return data;
                    }
                    ;
                    function Fail() {
                        alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXGroupTabSlider.php")
                    }
                    ;

                    //alert(data);
                }//--------fin if
                ;

                if (Finish === false) {
                    var obj = JSON.parse(jqxhr);
                    //obj[0]=$IN_NumTabs
                    //obj[1]=$CounGroups

                    //alert(obj[0]);

//               // alert("hola");
                    TrackLoad = $("section").length;
                    //alert(TrackLoad + "TrackLoad"),
                    $.ajax({
                        async: true, //By default, all requests are sent asynchronously (i.e. this is set to true by default). 
                        type: "POST",
                        dataType: "html", //The type of data that you're expecting back from the server.
                        url: "Controller/genTabsSlider.php",
                        beforeSend: BeforeLoad,
                        success: Resultado,
                        error: Fail,
                        data: {
                            TrackLoad: TrackLoad
                        }
                    });
                    //e.preventDefault();
//Si Ajax succes            
                    function BeforeLoad() {
//                    elemSection.find(".WrapperProducts_TBS > div").removeClass("active");
//                    WrapperProducts_TBS.prepend('<div class="ajaxLoad"><img src="View/img/ajaxLoad.gif"></div>');
                    }

                    function Resultado(data) { //on Ajax success
                        if (TrackLoad >= Math.ceil(obj[1] / obj[0])) {
                            Finish = true;
                        } else {
                            // alert(obj[1]);
                            //
                            // TrackLoad++;

                            $("#Main .container .row").first().append(data);
                            // init carousel


                            $(".ajaxLoad").remove();

                            $('.home-owl-carousel').each(function () {

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
                            //alert("data" + data);
                            //alert("amth" + Math.ceil(obj[1] / obj[0]));

                            //alert("finish");
                            Loading = false;
                            //scrollTab();
                        }


                    }
                    ;

                    function Fail() {
                        alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXGroupTabSlider.php")
                    }
                    ;
                }


            }
        }
    });
});
/*===================================================================================*/
/*	---AJAX CLICK EN TAB DE GRUPOS TABS SLIDER---Controller/AJAXNavTabSlider.php
 /*===================================================================================*/
$(document).ready(function () {
    $("#Main .container .row ").on("click", ".scroll_tabs .nav_tab_line li a", function (e) {

        var elementA = $(this); //OBJECT CLICKED
        var href = elementA.attr("href"); //#BAÑO_Y_GRIFERÍA Obtiene de new-products nav nav-tabs nav_tab_line el nombre de grupo apretado
        var nameGroupUnderScore = href.replace(/#/gi, ""); //BAÑO_Y_GRIFERÍA Perform a global, case-insensitive replacement:
        var nameGroup = nameGroupUnderScore.replace(/_/gi, " "); //BAÑO Y GRIFERÍA
        var elemSection = elementA.closest("section"); //Elemento <section> hacia arriba mas cercando del elemento apretado
        var elementH3 = elemSection.find("h3.new_product_title");
        elementH3.text(nameGroup);
        
        if ($(href).length === 0) {//SI NO EXISTE LO CREA
            var WrapperProducts_TBS = elemSection.find(".WrapperProducts_TBS"); //Contenedor dnd se generan el prodcut tab slider del grupo

            //Llama a Controller/AJAXGroupTabSlider.php pasandole por parametro el NOMBRE del GRUPO
            $.ajax({
                async: true, //By default, all requests are sent asynchronously (i.e. this is set to true by default). 
                type: "POST",
                dataType: "json", //The type of data that you're expecting back from the server.
                url: "Controller/AJAXGroupTabSlider.php",
                beforeSend: BeforeLoad,
                success: Resultado,
                error: Fail,
                data: {
                    nameGroup: nameGroup
                }
            });
            e.preventDefault();
            function BeforeLoad() {
                elemSection.find(".WrapperProducts_TBS > div").removeClass("active");
                WrapperProducts_TBS.prepend('<div class="ajaxLoad"><img src="View/img/ajaxLoad.gif"></div>');
            }
//Si Ajax succes
            function Resultado(data) { //on Ajax success
                //alert(data);///--DEBUG--
                $.ajax({
                    async: true, //By default, all requests are sent asynchronously (i.e. this is set to true by default). 
                    type: "POST",
                    dataType: "html", //The type of data that you're expecting back from the server.
                    url: "Controller/genTabsSlider.php",
                    beforeSend: BeforeLoad,
                    success: Resultado,
                    error: Fail,
                    data: {
                        GroupItem: data,
                        nameGroupUnderScore: nameGroupUnderScore
                    }
                });
                e.preventDefault();

                function BeforeLoad() {
                    elemSection.find(".WrapperProducts_TBS > div").removeClass("active");
                    WrapperProducts_TBS.prepend('<div class="ajaxLoad"><img src="View/img/ajaxLoad.gif"></div>');
                }
//Si Ajax succes
                function Resultado(data) { //on Ajax success
                    
                var elementLi = elemSection.find("ul.nav_tab_line > li");
                elementLi.removeClass("hide");
                elementA.closest("li").addClass("hide");

                elemSection.find(".WrapperProducts_TBS > div").removeClass("active");
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
                    $('.rating').rateit({max: 5, step: 1, value: 4, resetable: false, readonly: true});

                }
                ;

                function Fail() {
                    alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXGroupTabSlider.php")
                }

            }
            ;
            function Fail() {
                alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXGroupTabSlider.php")
            }
        }
    });
});

