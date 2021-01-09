<?php

defined('_JEXEC') or die('Restricted access');
JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
JHtml::_('bootstrap.framework');


$url = JUri::base() . 'components/com_datasheet/assets/css/style.css';
$document = JFactory::getDocument();
$document->addStyleSheet($url);

$url = JUri::base() . 'components/com_datasheet/assets/js/index.js';
$document->addScript($url);

$document->setMetaData('og:image',JURI::root()."".$this->result->img_default);
$document->setMetaData('og:description',substr(strip_tags($this->result->description),0,200));
$document->setMetaData('og:title',strip_tags($this->result->name));
$document->setMetaData('description',substr(strip_tags($this->result->description),0,200));
$document->setTitle(strip_tags($this->result->name));
?>
<div class="row">
  <div class="col-md-12 col-xs-12" style="padding-left:2px;padding-right:2px ">
    <img src="<?php echo JURI::root()."".$this->result->img_default;?>" width="100%" class="rounded" alt="<?php echo $this->result->name ?>">
    <h1 class="text-center" style="margin:0; background: #f47c14; color: #fff; text-rendering: optimizeLegibility;  font-weight: bold;
  text-shadow: 2px 2px 0px #f47c14, 4px 4px 0px rgba(0, 0, 0, 0.2); padding-bottom:5px "><?php echo $this->result->name ?></h1>
    <div class="entry-highlights bg-dark text-white text-center" style="background: #f47c14; color: #fff; margin-top:3px;">
          Detalles: <?php  echo $this->tiny ?></div>
    </div>
</div>

      <div class="row">
          <div class="col-md-8 pb-2">
              
              <!--<a href="https://www.publimotos.com/mactualidad/3062-gixxer-250-vs-fz-25-vs-cb-250-twister-comparativo" class="btn btn-light btn-lg">Gixxer 250 vs FZ 25 vs CB 250 Twister - Comparativo</a>
              
              <p class="h5 text-justify mt-4">Rueda delantera con sistema ABS para dar más seguridad y estabilidad al piloto. Freno trasero marca NISSIN complementa perfectamente el sistema de frenado.</p>
              <br>-->
            <!--div class="text-center mt-6">
                <h2 class="display-6">Costo de la Honda xre 190 </h1>
                <p class="text-justify mt-4"> El costo de la <strong>HONDA XRE 190 es 2750 € aproximadamente $11'700.000, </strong> Honda quiere abrirse paso  en uno de los segmentos más populares de nuestro país, para lo cual planea producir una nueva plataforma de 200cc.</p>
            </div>-->

         
            <div class="row">
                <div class="col-md-12">
                    <div class="header-content-center ">
                        <div class="">
                            <h3 class="display-5 text-center titles">Interesante de <?php echo $this->result->name ?></h3>
                            <p  class="text-justify mt-4"><?php echo $this->result->description ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if($this->result->url_video <> "") {
              $skinvideo = JUri::base() . 'components/com_datasheet/assets/css/vsj-skin.css';
              $document->addStyleSheet('https://vjs.zencdn.net/7.7.5/video-js.css');
              $document->addStyleSheet($skinvideo);
            ?>
            <div class="row">
              <div class="col-md-12"><hr>
                <div id="cont-video">
                  <video
                    id="vid1"
                    class="video-js vjs-default-skin"
                    controls
                    data-setup='{"fluid": true, "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $this->result->url_video ?>"}] }'
                  >
                  </video>
                </div>
              
              </div>
            </div>
            
             <?php 
            
            $document->addScript('https://vjs.zencdn.net/7.7.5/video.js');
            $document->addScript(JURI::base() .'components/com_datasheet/assets/js/youtube.min.js');  
            } 
          
            if($this->result->gallery_folder <> "") {
            ?>
            <div class="row">
                  <div class="col-md-12"><hr>
                    <div class="header-content-right mt-5">
                      <div class="text-center-sm">  
                        <h3 class="display-5 text-center titles">Galeria <?php echo $this->result->name ?></h3>
                        <div class=" text-left mt-5">
                          <div class="slider">
                              <?php 
                                $dir = "./images/datasheetmedia/".$this->result->gallery_folder;
                                $all_files = scandir($dir);
                                $init = 0;
                                for ($i=0; $i<count($all_files); $i++){
                                  $image_name = $all_files[$i];
                                  $supported_format = array('gif','jpg','jpeg','png');
                                  $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
                                 
                                  if (in_array($ext, $supported_format))
                                      {
                                        ?>

                                        <div class="carousel-item <?php if($init == 0) {echo "active"; $init=1;}?>">
                                          <img src="<?php echo JURI::root()."images/datasheetmedia/".$this->result->gallery_folder."/".$image_name ?>" class="img-fluid" alt="...">
                                        </div>
                                      <?php 
                                      } else {
                                          continue;
                                      }
                                  }
                          
                              ?>
                            </div>
                         
                          <script>
                            jQuery(document).ready(function(){
                               var ventana_ancho = jQuery(window).width();
                                if(ventana_ancho < 991)
                                {
                                  jQuery('.slider').bxSlider({
                                    auto: true,
                                    preloadImages: 'visible',
                                    adaptiveHeight: true,
                                    autoStart : true,
                                    mode : 'fade',
                                    speed: 1500});  
                                }
                                else{
                                  jQuery('.slider').bxSlider({
                                    auto: true,
                                    preloadImages: 'visible',
                                    adaptiveHeight: true,
                                    autoStart : true,
                                    mode : 'fade',
                                    speed: 1000});   
                                }
                            });
                          </script>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
             <?php } 
            if($this->datasheetSection <> ""){?>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center titles">Informacion Adicional</h4>
                  <?php 
                  echo $this->datasheetSection;
                  ?>
                </div>
              </div>
            <?php } ?>
              <div class="row">
                <div class="col-md-12" >
                  <h4 class="text-center titles">Ficha tecnica</h4>
                  <div style="max-height: 200px;" id="table-datasheet">
                    <table class="table table-hover-responsive text-center">
                      <tbody>
                      <?php 
                        echo $this->datasheetTable;
                      ?>
                      </tbody>
                    </table>
                  </div>
                  <button type="button" class="btn btn-secondary btn-lg btn-block" id="ver-mas-datasheet">Ver mas...</button>
                </div>
              </div>
              <?php 
              
              if(count($this->competitionproduct)>0)
              {
              ?>
              <div class="row">
                <div class="col-md-12 pb-2">
                  <h4 class="text-center titles">Competencia de <?php echo $this->result->name ?></h4>
                   <div class="row">
                  <?php
                    foreach($this->competitionproduct as $motorcycles) {
                      echo "<div class='col-xs-6 col-md-4 relations'>";

                      $ruta = JRoute::_('datasheet/?datasheet='.$motorcycles->id);
      
                      echo '<a href="'.$ruta.'" class="btn btn-primary stretched-link cont-enlace" style="width:100%"><div class="card" style="overflow:hidden">
                        <img src="'. JURI::root().$motorcycles->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
                        <div class="card-body">
                        <!--<h5 class="card-title">'.$motorcycles->name.'</h5>
                          <p class="card-text"></p>-->
                          <b>'.$motorcycles->name.'</b><br>
                          <small>'.$this->product_value($motorcycles).'</small>
                        </div>
                      </div>';
                      echo "</div></a>";
                    }
                  ?>
                </div>
              </div>
              </div>
              <?php 
              }
              ?>
              <?php 
              
              if($this->product_rels<>"" && count($this->product_rels)>0)
              {
              ?>
              <div class="row">
                <div class="col-md-12 pb-2">
                  <h4 class="text-center titles">Productos Relacionados con <?php echo $this->result->name ?></h4>
                   <div class="row">
                  <?php
                    foreach($this->product_rels as $motorcycles) {
                      echo "<div class='col-xs-6 col-md-4 relations'>";

                      $ruta = JRoute::_('datasheet/?datasheet='.$motorcycles->id);
      
                      echo '<a href="'.$ruta.'" class="btn btn-primary stretched-link cont-enlace" style="width:100%"><div class="card" style="overflow:hidden">
                        <img src="'. JURI::root().$motorcycles->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
                        <div class="card-body">
                        <!--<h5 class="card-title">'.$motorcycles->name.'</h5>
                          <p class="card-text"></p>-->
                          <b>'.$motorcycles->name.'</b><br>
                          <small>'.$this->product_value($motorcycles).'</small>
                        </div>
                      </div>';
                      echo "</div></a>";
                    }
                  ?>
                </div>
              </div>
              </div>
              <?php 
              }
              ?>
              <div class="row">
                <div class="col-md-12 pb-2">
                  <!--<pre>
                    <?php 
                    // var_dump($this->datasheets_motorcycles);
                    ?>
                  </pre>-->
                  <h4 class="text-center titles">Fichas de motos Relacionados con <?php echo $this->result->name ?></h4>
                   <div class="row">
                  <?php
                  
                    foreach($this->datasheets_motorcycles as $motorcycles) {
                      echo "<div class='col-xs-6 col-md-4 relations'>";

                      $ruta = JRoute::_('datasheet/?datasheet='.$motorcycles->id);
      
                      echo '<a href="'.$ruta.'" class="btn btn-primary stretched-link cont-enlace" style="width:100%"><div class="card" style="overflow:hidden">
                        <img src="'. JURI::root().$motorcycles->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
                        <div class="card-body">
                        <!--<h5 class="card-title">'.$motorcycles->name.'</h5>
                          <p class="card-text"></p>-->
                          <b>'.$motorcycles->name.'</b><br>
                          <small>'.$this->product_value($motorcycles).'</small>
                        </div>
                      </div>';
                      echo "</div></a>";
                    }
                  ?>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="padding-bottom:20px">
                  <h4 class="text-center titles">Articulos Relacionados con <?php echo $this->result->name ?></h4>
                   <div class="row">
                  <?php
                    foreach($this->articles as $article) {
                        
                      $ruta = JRoute::_(ContentHelperRoute::getArticleRoute($article->id,$article->catid,$article->language));
                        echo "<div class='col-md-6'>";
                        echo "<a href='".$ruta."'>".JHtmlString::abridge($article->title,45)."</a>";
                        echo "</div>";
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 mobile-hidden" style="margin-top:24px">
           
              <?php 
              echo $this->renderSidebar;
              ?>
          </div>
        </div>