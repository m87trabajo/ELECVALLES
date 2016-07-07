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


}
;

function Fail() {
    alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXGroupTabSlider.php")
}