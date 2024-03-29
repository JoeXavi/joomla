<?php
defined('_JEXEC') or die('Restricted access');
JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.ui');
$url = JUri::base() . 'components/com_datasheet/assets/css/style.css';
$document = JFactory::getDocument();
$document->addStyleSheet($url);


?>
  <div class="row margin-0" >
    <div class="col-md-8 pb-2" style="padding: 0;">
      <div class="row">
        <div class="col-md-12" id="jd-searchdatasheets-container">
          <div class="row">
            <div class="col-md-1 col-xs-2 col-1">
              <?php 
                $ruta = JRoute::link('site', 'index.php?option=com_datasheet&view=index');
                echo '<a href="'.$ruta.'" class="btn btn-primary custom-home"><span class="fa fa-home"></span></a>';
              ?>
            </div>
            <div class="col-md-11 col-xs-10 col-11"><h4 class="text-center first-title">Filtrar fichas t&eacutecnicas</h4></div>
          </div>
          
          <form action="<?php 
            $ruta2 = JRoute::link('site', 'index.php?option=com_datasheet&view=filtro');
            echo $ruta2;
          ?>" method="get" id="searchdatasheets_form" name="josForm" class="form-validate form-horizontal">
              <div class="form-group row">
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">  
                  <select class="form-control" name="jForm['brand']">
                    <option value="0">Seleccione Marca</option>
                    <?php 
                      foreach($this->brands as $brand){
                        if(isset($this->data) and $this->data["'brand'"] == $brand->id)
                          echo '<option value="'.$brand->id.'" selected>'.$brand->name.'</option>';
                        else 
                          echo '<option value="'.$brand->id.'" >'.$brand->name.'</option>';
                      }
                    ?>
                  </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['cilidrada_desde']">
                      <option value="0">Cilindrada desde</option>
                      <option value="80" <?php if(isset($this->data) and $this->data["'cilidrada_desde'"] == '80') echo "selected"; ?>>80</option>
                      <option value="250" <?php if(isset($this->data) and $this->data["'cilidrada_desde'"] == '250') echo "selected"; ?>>250</option>
                      <option value="500" <?php if(isset($this->data) and $this->data["'cilidrada_desde'"] == '500') echo "selected"; ?>>500</option>
                      <option value="750" <?php if(isset($this->data) and $this->data["'cilidrada_desde'"] == '750') echo "selected"; ?>>750</option>
                      <option value="1000" <?php if(isset($this->data) and $this->data["'cilidrada_desde'"] == '1000') echo "selected"; ?>>1000</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['cilidrada_hasta']">
                      <option value="0" >Cilindrada hasta</option>
                      <option value="250" <?php if(isset($this->data) and $this->data["'cilidrada_hasta'"] == '250') echo "selected"; ?>>250</option>
                      <option value="500" <?php if(isset($this->data) and $this->data["'cilidrada_hasta'"] == '500') echo "selected"; ?>>500</option>
                      <option value="750" <?php if(isset($this->data) and $this->data["'cilidrada_hasta'"] == '750') echo "selected"; ?>>750</option>
                      <option value="1000" <?php if(isset($this->data) and $this->data["'cilidrada_hasta'"] == '1000') echo "selected"; ?>>1000</option>
                      <option value="2500" <?php if(isset($this->data) and $this->data["'cilidrada_hasta'"] == '2500') echo "selected"; ?>>mas</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['precio_ini']">
                      <option value="0">Precio desde</option>
                      <option value="1000000" <?php if(isset($this->data) and $this->data["'precio_ini'"] == '1000000') echo "selected"; ?>>$1.000.000</option>
                      <option value="5000000" <?php if(isset($this->data) and $this->data["'precio_ini'"] == '5000000') echo "selected"; ?>>$5.000.000</option>
                      <option value="10000000" <?php if(isset($this->data) and $this->data["'precio_ini'"] == '10000000') echo "selected"; ?>>$10.000.000</option>
                      <option value="16000000" <?php if(isset($this->data) and $this->data["'precio_ini'"] == '16000000') echo "selected"; ?>>$16.000.000</option>
                      <option value="32000000" <?php if(isset($this->data) and $this->data["'precio_ini'"] == '32000000') echo "selected"; ?>>$32.000.000</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['precio_fin']">
                      <option value="0">Precio hasta</option>
                      <option value="5000000" <?php if(isset($this->data) and $this->data["'precio_fin'"] == '5000000') echo "selected"; ?>>$5.000.000</option>
                      <option value="10000000" <?php if(isset($this->data) and $this->data["'precio_fin'"] == '10000000') echo "selected"; ?>>$10.000.000</option>
                      <option value="16000000" <?php if(isset($this->data) and $this->data["'precio_fin'"] == '16000000') echo "selected"; ?>>$16.000.000</option>
                      <option value="32000000" <?php if(isset($this->data) and $this->data["'precio_fin'"] == '32000000') echo "selected"; ?>>$32.000.000</option>
                      <option value="150000000" <?php if(isset($this->data) and $this->data["'precio_fin'"] == '150000000') echo "selected"; ?>>m&aacutes</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['year']">
                      <option value="0">Año</option>
                      <?php 
                      $year = date('Y');
                      //echo $year;

                      for($i=-1;$i<9;$i++){
                        $fecha=(int)$year-$i;
                        if(isset($this->data) and $this->data["'year'"] == $fecha){
                          echo '<option value="'.$fecha.'" selected>'.$fecha.'</option>';
                        } else {
                          echo '<option value="'.$fecha.'">'.$fecha.'</option>';
                        }
                        
                      }?>
                    </select>
                </div>
            
                
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                    <button type="submit" id="register_submit" name="Submit" class="btn btn-primary" style="width: 100%">Filtrar</button>
                      <input type="hidden" name="filter" value="hi">
                    <?php echo JHTML::_('form.token'); ?>
                  </div>
              </div> 
              <hr>
          </form>
        </div>
      </div>
      <!-- MARCAS -->
      <div class="row">
        <div class="col-md-12">
          <h4 class="text-center titles">Marcas</h4>
          <?php if(is_array($this->brands))?>
          <div class="slider">
            <?php 
              foreach ($this->brands as $brand){    
                $url = JFilterOutput::stringURLSafe($brand->name);            
                $ruta = JRoute::link('site', 'index.php?option=com_datasheet&view=marca&id='.$brand->id.'-'.$url);
                ?>
                  
                  <a href="<?php echo $ruta ?>" class="">
                    <img src="<?php echo JURI::root().$brand->logo ?>" alt="<?php echo $brand->name ?>" class="img-thumbnail" style="max-width:150px; max-heigt:150px">
                    <div class="caption">
                        <h5 class="text-center"><?php echo $brand->name ?></h5> 
                    </div>
                  </a>
                <?php 
                }
        
            ?>
    
          </div>
          <script>
            jQuery(document).ready(function(){
              let ventana_ancho = $(window).width();
              let config = {
                pager:false,
                moveSlides: 1,
                slideMargin: 5,
                preloadImages: 'visible',
                adaptiveHeight: true,
                autoStart : true,
                responsive: true,
                mode : 'horizontal',
                slideWidth: 150,
                minSlides: 2,
                maxSlides: 6,
                speed: 1500
              }
                
              if(ventana_ancho<991){
                config = {...config, auto:true}
              }else{
                config = {...config,
                touchEnabled:false,
                oneToOneTouch:false,
                
                };   
              }       
              jQuery('.slider').bxSlider(config);   
                  
              });
            </script>
      </div>

      <?php 
       if (is_array($this->allData) || is_object($this->allData)){
         if(count($this->allData)>0){
           for($i=0;$i<count($this->allData);$i++){
             $section = $this->allData[$i];
             $Section2 = $this->sections[$i];
             //var_dump($section);
      ?>
      <div class="row">
        <div class="col-md-12 pb-2">
          <h4 class="text-center titles"><?php echo $Section2->name ?></h4>
            <div class="row">
          <?php
            if (is_array($section) || is_object($section)){
              if(count($section)>0){
                foreach($section as $datasheet) {
                  echo "<div class='col-xs-6 col-md-4 relations'>";
                  
                  $ruta = JRoute::link('site', 'index.php?option=com_datasheet&view=ficha&id='.$datasheet->id.'-'.$datasheet->slug);

                  echo '
                  <a href="'.$ruta.'" class="btn btn-primary stretched-link  cont-enlace" style="width:100%">
                  <div class="card " style="">
                    <img src="'. JURI::root().$datasheet->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
                    <div class="card-body">
                    <!--<h5 class="card-title">'.$datasheet->name.'</h5>
                      <p class="card-text"></p>-->
                      <b>'.$datasheet->name.'</b><br>
                      <div class="text-center entry-highlights">'.$this->product_value($datasheet).'</div>
                    </div>
                  </div>';
                  echo "</div></a>";
                }
              }
            }
          
          else
            echo "<p style='padding:10px'>Ups... no hay resultados...</p>";
          ?>
          </div>
          <form action="<?php 
          echo $ruta2;
          ?>" method="get" id="searchdatasheets_form" name="josForm" class="form-validate form-horizontal">
          <input type="hidden" name="filter" value="hi">
          <input type="hidden" name="jForm['section_id']" value="<?php echo $Section2->id; ?>">
          <button type="submit" class="btn btn-secondary btn-lg btn-block"  name="Submit"id="ver-mas-datasheet">Ver mas...</button>
        
        </form>
          
        </div>
      </div>
      
      <?php 
         }
        }
      }

      ?>

    </div>
   

  <div class="col-md-4 mobile-hidden" style="margin-top:24px" id="mobile-hidden">
    <jdoc:include type="modules" name="sidebar" style="xhtml"/>
  <?php 
              
              //var_dump($this->sidebar);
              if (is_array($this->sidebar) || is_object($this->sidebar)){
                foreach ($this->sidebar as $module) {
                  echo JModuleHelper::renderModule($module);
                  }}
              ?>
  </div>
</div>
<script>
  if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
  }
</script>
     
