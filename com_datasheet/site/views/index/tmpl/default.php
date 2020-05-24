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
  <div class="row">
    <div class="col-md-8 pb-2">
      <div class="row">
        <div class="col-md-12" id="jd-searchdatasheets-container">
          <h4 class="text-center titles">Filtrar fichas tecnicas</h4>
          <form action="" method="post" id="searchdatasheets_form" name="josForm" class="form-validate form-horizontal">
              <div class="form-group row">
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">  
                  <select class="form-control" name="jForm['brand']">
                    <option value="0">Seleccione Marca</option>
                    <?php foreach($this->brands as $brand){
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
                      <option value="150000000" <?php if(isset($this->data) and $this->data["'precio_fin'"] == '150000000') echo "selected"; ?>>mas</option>
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
     
      <div class="row">
        <div class="col-md-12 pb-2">
         
          <h4 class="text-center titles">Catalogo de Fichas tecnicas <?php echo $this->result->name ?></h4>
            <div class="row">
          <?php
            if(count($this->datasheets)>0){
            foreach($this->datasheets as $datasheet) {
              echo "<div class='col-xs-6 col-md-4 relations'>";

              $ruta = JRoute::_('datasheet/?datasheet='.$datasheet->id);

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
            }}
          
          else
            echo "<p style='padding:10px'>Ups... no hay resultados...</p>";
          ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 pb-2">
          <?php if(isset($this->pagination)) echo $this->pagination->getListFooter(); ?>
        </div>
    </div>
    </div>
   

  <div class="col-md-4 mobile-hidden" style="margin-top:24px" id="mobile-hidden">
    <jdoc:include type="modules" name="sidebar" style="xhtml"/>
  <?php 
              
              //var_dump($this->sidebar);
              foreach ($this->sidebar as $module) {
                echo JModuleHelper::renderModule($module);
                }
              ?>
  </div>
</div>

     
