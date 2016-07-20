$.ajax({
    async: true, ////asynchronously
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

function Done(data) { //on Ajax success

}
;

function Fail() {
    alert("Error en handmade.js AJAX GRUPOS TABS SLIDER.\nSe a encontrado un ---echo-- en el procceso de AJAXTabSlider.php")
}