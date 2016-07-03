<?php

/* ##################################################################################################
  ###################################################################################################
  AUTOR:ELCACHO GRNADOS,MARC
  FEHCA:30-06-2016
  VERSION:V.0.3
  TITULO:
  FUNCIONAMIENTO:
  SELECT grupo FROM a_grupo_cantidad ORDER BY grupo ASC.Y sabemos cuantos grupos ahy.
  Segun variables preferencia $CantTabsSlider y $CantTabs. Llama a DB.
  Si ahy 4 tabs por slider cojera el grupo 1,5,9 ...
  SELECT DISTINCT grupo FROM a_grupo_cantidad ORDER BY grupo ASC LIMIT :i,1;
  Solo se cargan la primera tab del slider con productos. Los otros tabs se cargan mediante AJAX.
  SELECT grupo,codigo_producto,nombre_producto,pvp,pvp_incrementado,imagen,valor_oferta FROM f_random_products WHERE grupo = :group;
  Mostramos producto en el tab correspondiente.
  ##################################################################################################
  ################################################################################################## */

/* ======================================= 
  INCLUDES
  ======================================== */


/* ======================================= 
  AJUSTAR SEGUN PREFERENCIA
  ======================================== */

/* ======================================= 
  OBJETO
  ======================================== */

/* ======================================= 
  VARIABLES
  ======================================== */
/* VARIABLES HTML */


/* VARIABLES FUNCION */

/* ============================================================================================================ 
  MAIN
  ============================================================================================================= */


/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */

