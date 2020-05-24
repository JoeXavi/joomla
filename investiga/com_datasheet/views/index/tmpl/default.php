<?php

// No direct access to this file
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
        <h4 class="text-center">Filtrar fichas tecnicas</h4>
            <form action="" method="post" id="searchdatasheets_form" name="josForm" class="form-validate form-horizontal">
              <div class="form-group row">
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">  
                  <select class="form-control" name="jForm['brand']">
                    <option value="0">Seleccione Marca</option>
                    <?php foreach($this->brands as $brand){
                      echo '<option value="'.$brand->id.'">'.$brand->name.'</option>';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['cilidrada_desde']">
                      <option value="0">Cilindrada desde</option>
                      <option value="80">80</option>
                      <option value="250">250</option>
                      <option value="500">500</option>
                      <option value="750">750</option>
                      <option value="1000">1000</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['cilidrada_hasta']">
                      <option value="0">Cilindrada hasta</option>
                      <option value="250">250</option>
                      <option value="500">500</option>
                      <option value="750">750</option>
                      <option value="1000">1000</option>
                      <option value="2500">mas</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['precio_ini']">
                      <option value="0">Precio desde</option>
                      <option value="1000000">$1.000.000</option>
                      <option value="5000000">$5.000.000</option>
                      <option value="10000000">$10.000.000</option>
                      <option value="16000000">$16.000.000</option>
                      <option value="32000000">$32.000.000</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['precio_fin']">
                      <option value="0">Precio hasta</option>
                      <option value="5000000">$5.000.000</option>
                      <option value="10000000">$10.000.000</option>
                      <option value="16000000">$16.000.000</option>
                      <option value="32000000">$32.000.000</option>
                      <option value="150000000">mas</option>
                    </select>
                </div>
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                  <select class="form-control" name="jForm['year']">
                      <option value="0">Año</option>
                      <?php 
                      $year = date('Y');
                      //echo $year;

                      for($i=0;$i<10;$i++){
                        $fecha=(int)$year-$i;
                        echo '<option value="'.$fecha.'">'.$fecha.'</option>';
                      }?>
                    </select>
                </div>
            
                
                <div class="col-md-3 col-xs-4" style="padding-left:2px;padding-right:2px">
                    <button type="submit" id="register_submit" name="Submit" class="btn btn-primary" style="width: 100%">Filtrar</button>
                  
                    <?php echo JHTML::_('form.token'); ?>
                  </div>
              </div> 
              <hr>
            </form>
          </div>
        </div>
     
      <div class="row">
        <div class="col-md-12 pb-2">
          <h4 class="text-center">Catalogo de motos <?php echo $this->result->name ?></h4>
            <div class="row">
          <?php
            foreach($this->datasheets as $datasheet) {
              echo "<div class='col-xs-6 col-md-4' style='padding-bottom:10px; padding-left:5px;padding-right:5px'>";

              $ruta = JRoute::_('index.php?option=com_datasheet&datasheet='.$datasheet->id);

              echo '<div class="card" style="overflow:hidden">
                <img src="'. JURI::root().$datasheet->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
                <div class="card-body">
                <!--<h5 class="card-title">'.$datasheet->name.'</h5>
                  <p class="card-text"></p>-->
                  <a href="'.$ruta.'" class="btn btn-primary stretched-link" style="width:100%"><b>'.$datasheet->name.'</b><br>
                  <small>'.$this->product_value($datasheet).'</small></a>
                </div>
              </div>';
              echo "</div>";
            }
          ?>
          </div>
        </div>
      </div>
    </div>

  <div class="col-md-4 mobile-hidden" style="margin-top:24px" id="mobile-hidden">
      <div class="header-content-right ">
        <div>
        <form class="form-inline text-center">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        </div>
      </div>

      <div class="header-content-right mt-5">
        <div><ul><li>Carrocería de diseño progresivo para una ergonomía óptima.</li> </ul><ul> <li>La moto viene con freno delantero ABS y trasero con disco convencionalx</li>  </ul>
            <ul><li> De fabricación brasilera según al proporción de precios de ese país vale un 25% menos que la XRE300.</li>      
            </ul><ul> <li>Cuenta con arranque eléctrico, inyección electrónica, sistema de suspensión telescópica trasera</li> </ul>
            <ul> <li>La instrumentación es de fácil visualización y presenta una lectura intuitiva que le aporta mayor seguridad al piloto, quien no tendrá que quitar los ojos del camino.</li> </ul>
          </div>
      </div>
  </div>
</div>

     
