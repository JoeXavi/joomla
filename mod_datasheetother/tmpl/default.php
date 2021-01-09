<?php 
// No direct access
defined('_JEXEC') or die; ?>
<?php 
$url = JUri::base() . 'modules/mod_datasheetother/assets/css/style.css';
$document = JFactory::getDocument();
$document->addStyleSheet($url);

echo '<a href="datasheet/?datasheet='.$datasheet['datasheet'].'">
<div class="row">
  <div class="col-md-12 col-xs-12" style="padding-left:2px;padding-right:2px ">
    <div class="row" style="margin:0; border:solid 1px #dfdede" >
      <div class="col-md-3 col-xs-4" style="padding:0;">
        <img src="'.JURI::root()."".$datasheet['product']->img_default.'" class="img-datasheet" width="100%" class="rounded" alt="'.$datasheet['product']->name.'" style="">
      </div>
      <div class="col-md-9 col-xs-8 text-other" style="padding:0;">
        <h6 class="text-center" style="margin:0;  color: #fff; text-rendering: optimizeLegibility;  font-weight: bold;
        padding-bottom:5px "> '. $datasheet['product']->name .' </h6>
        <div class="entry-highlights bg-dark text-white text-center" style="margin-top:3px;">
          <b>Detalles Tecnicos:</b> '. $datasheet['values'] .'
        </div>
      </div>
    </div>
    
    
  </div>

</div>
</a>';

    ?>