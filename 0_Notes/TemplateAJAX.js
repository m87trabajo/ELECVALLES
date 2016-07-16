$.ajax({
    async: true, //By default, all requests are sent asynchronously (i.e. this is set to true by default). 
    type: "POST",
    dataType: "json", //The type of data that you're expecting back from the server.
    url: "Controller/AJAXTabSlider.php",
    beforeSend: BeforeLoad,
    success: Done,
    error: Fail,
    data: {
        nameGroup: nameGroup
    }
});
e.preventDefault();

function BeforeLoad() {

}
//Si Ajax succes
function Done(data) { //on Ajax success

}
;

function Fail() {
    alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXTabSlider.php")
}