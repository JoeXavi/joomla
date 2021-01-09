<?php 
// No direct access
defined('_JEXEC') or die; 
//var_dump($datasheet);
//exit();
$url = JUri::base() . 'modules/mod_datasheetbrand/assets/css/style.css';
$document = JFactory::getDocument();
$document->addStyleSheet($url);

$cadena1 = '<div class="row">
<div class="col-md-12 pb-2">
  <h4 class="text-center titles">Productos de la misma marca</h4>
  <div class="row">';
$cadena2 = "";
if(is_array ($datasheet['result'])){
    foreach($datasheet['result'] as $motorcycles) {
      $cadena2 = $cadena2. "<div class='col-xs-6 col-md-4' style='padding-bottom:10px'>";

      $ruta = JRoute::_('datasheet/?datasheet='.$motorcycles->id);
      
      $cadena2 = $cadena2.
      '<a href="'.$ruta.'" class="btn btn-primary stretched-link cont-enlace" style="width:100%">
        <div class="card" style="overflow:hidden">
          <img src="'. JURI::root().$motorcycles->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
          <div class="card-body">
            <b>'.$motorcycles->name.'</b><br>
            <small>'.modDatasheetbrandHelper::product_value($motorcycles).'</small>
          </div>
        </div>';
        $cadena2 = $cadena2. "</a></div>";
    }}
else {
  $motorcycles = $datasheet['result'];
  //var_dump($motorcycles);
  $cadena2 = $cadena2. "<div class='col-xs-6 col-md-4' style='padding-bottom:10px'>";

      $ruta = JRoute::_('datasheet/?datasheet='.$motorcycles->id);

      $cadena2 = $cadena2.
      '<a href="'.$ruta.'" class="btn btn-primary stretched-link cont-enlace" style="width:100%">
        <div class="card" style="overflow:hidden">
          <img src="'. JURI::root().$motorcycles->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
          <div class="card-body">
            <b>'.$motorcycles->name.'</b><br>
            <small>'.ModDatasheetbrandHelper::product_value($motorcycles).'</small>
          </div>
        </div>';
        $cadena2 = $cadena2. "</a></div>";
}

  $cadena3 = '</div></div></div>';
  echo $cadena1.$cadena2.$cadena3;
    ?>