<?php 
// No direct access
defined('_JEXEC') or die; ?>
<?php 

echo '<a href="datasheet/?datasheet='.$datasheet['datasheet'].'">
<div class="row">
  <div class="col-md-12 col-xs-12" style="padding-left:2px;padding-right:2px ">
    <img src="'.JURI::root()."".$datasheet['product']->img_default.'" width="100%" class="rounded" alt="'.$datasheet['product']->name.'">
    <h1 class="text-center" style="margin:0; background: #f47c14; color: #fff; text-rendering: optimizeLegibility;  font-weight: bold;
      text-shadow: 2px 2px 0px #f47c14, 4px 4px 0px rgba(0, 0, 0, 0.2); padding-bottom:5px ">'. $datasheet['product']->name .'</h1>
    <div class="entry-highlights bg-dark text-white text-center" style="background: #f47c14; color: #fff; margin-top:3px;">
      <b>Detalles Tecnicos:</b> '. $datasheet['values'] .'
    </div>
    <div class="entry-highlights bg-dark text-white text-center" style="background: #f47c14; color: #fff; margin-top:3px;">
      <b>Saber mas...</b>
    </div>
  </div>

</div>
</a>';

    ?>