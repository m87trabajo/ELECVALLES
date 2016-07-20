<?php
/* ##################################################################################################
  ###################################################################################################
  -AUTOR:ELCACHO GRNADOS,MARC    -FEHCA:00-00-2016    -VERSION:V.0.0    -LENGUAJE:HTML 
  -TITULO:Html/View/mainElement.php 
  -RETRUN: --- 
  -VENTAJAS:---
  -RESUMEN:Genera HTML tabSlider
  -DATABASE:---
  -FUNCIONAMIENTO:---
  -ERRORES:---
  ---!IMPORTANTE!---:
  ##################################################################################################
  =======================================
  -----------!!!!ATENCION¡¡¡¡------------
  ========================================
  NO FORMATEAR ALT+MAYS+F (NETBEANS)
  BORRAR TODOS LOS CRLF I ESPACIOS EN BLANCO ENTRE FUNCIONES PHP SINO GENERA MAL HTML CON CRLF
   mainIndex.php
   mainCategoryPage.php
   mainDetailProdut.php
  ################################################################################################## */

/* ============================================================================================================ 
  FUNCIONES
  ============================================================================================================= */
?>
<?php function mainElementOpen($idNameHTML) { ?>
<div id = "wrp<?php echo $idNameHTML ?>" class = "main body-content">
    <div class = "container">
        <div class = "row">
<?php }?>
<?php function mainElementClose() {?>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /#wrpElement -->
<?php }