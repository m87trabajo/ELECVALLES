<?php

require_once 'funcAutoLoad.php';

function MenuGroups($tipo) {

    /* AJUSTAR SEGUN PREFERENCIA */
    $numero_filas = 7; //Numero de filas aparezen en menu

    /* VARIABLES */
    $aGrupoCantidad = array(); //Contenedor de SELECT grupo,cantidad FROM a_grupo_cantidad.
    $html = ''; //Contenedor Html.
    $num_rows = 0; //Count rows.
    $resto = 0; //Cantidad de elementos por poner
    $inicio = 0; //Empieza a colocar elementos desde elemento
    $actual = 0; //Valor hasta donde a colocado elementos
    $no_spaces = ''; //String sin espacios

    /* OBJETO */
    $shop = new Shop('aux');

    /*FUNCION*/
    if ($tipo == 'productos') {
        $shop->MenuGroupsQuantitys('a_grupo_cantidad'); //SELECT grupo,cantidad FROM a_grupo_cantidad
        $aGrupoCantidad = $shop->getArrAux();

        $string_1 = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">';
        $string_2 = 'category_page.php?vNO=N&vGDFS=';
    } else if ($tipo == 'ofertas') {
        $shop->MenuGroupsQuantitys('a_grupo_oferta_cantidad'); //SELECT grupo,cantidad FROM a_grupo_oferta_cantidad
        $aGrupoCantidad = $shop->getArrAux();

        $string_1 = '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">';
        $string_2 = 'category_page.php?vNO=O&vGDFS=';
    }

    $num_rows = count($aGrupoCantidad);
    $resto = $num_rows;
    $inicio = $num_rows - $num_rows;
    $actual = 0;

    while ($resto > 0) {
        $html.= $string_1;
        $html.='<ul class="links">';

        if ($resto > $numero_filas) {
            $actual = $inicio + $numero_filas;
        } else {
            $actual = $resto + $inicio;
        }

        for ($i = $inicio; $i < $actual; $i++) {
            $no_spaces = str_replace(' ', '_', $aGrupoCantidad[$i]['grupo']);
            $html.='<li><a href="' . $string_2 . $no_spaces . '&level=0"><span class="fa fa-angle-right hvr-icon-forward"></span>' . $aGrupoCantidad[$i]['grupo'] . '</a><span>(' . $aGrupoCantidad[$i]['cantidad'] . ')</span></li>';
        }

        $resto = $resto - $numero_filas;
        $inicio = $inicio + $numero_filas;

        $html.='</ul></div>';
    }

    return $html;
}
