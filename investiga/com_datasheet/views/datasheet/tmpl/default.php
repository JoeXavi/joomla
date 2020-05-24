<?php

defined('_JEXEC') or die('Restricted access');
JLoader::register('ContentHelperRoute', JPATH_SITE . '/components/com_content/helpers/route.php');
JHtml::_('jquery.framework');

$url = JUri::base() . 'components/com_datasheet/assets/css/style.css';
$document = JFactory::getDocument();
$document->addStyleSheet($url);
$document->setMetaData('og:image',JURI::root()."".$this->result->img_default);
$document->setMetaData('og:description',substr(strip_tags($this->result->description),0,200));
$document->setMetaData('og:title',strip_tags($this->result->name));
$document->setMetaData('description',substr(strip_tags($this->result->description),0,200));
$document->setTitle(strip_tags($this->result->name));
?>
<div class="container mt-5">
  
        <div>
          <img src="<?php echo JURI::root()."".$this->result->img_default;?>" width="100%" class="rounded" alt="<?php echo $this->result->name ?>">
          <h1 class="text-center" style="margin:0; background: #f47c14; color: #fff; text-rendering: optimizeLegibility;  font-weight: bold;
  text-shadow: 2px 2px 0px #f47c14, 4px 4px 0px rgba(0, 0, 0, 0.2); padding-bottom:5px "><?php echo $this->result->name ?></h1>
          <div class="entry-highlights bg-dark text-white text-center" style="background: #f47c14; color: #fff; margin-top:3px;">
          Detalles: <?php  echo $this->tiny ?></div>
    </div>
</div>

    <div  class="container">
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
                            <h3 class="display-5 text-center">Interesante de <?php echo $this->result->name ?></h3>
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
                    data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "<?php echo $this->result->url_video ?>"}] }'
                  >
                  </video>
                </div>
              
              </div>
            </div>
            <script>
              let contVideo = document.getElementById("cont-video");
              let Video = document.getElementById("vid1");
              console.log("Ancho",Video.width)
              Video.width = contVideo.offsetWidth;
              Video.height = contVideo.offsetWidth * 0.5625;
            </script>
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
                        <h3 class="display-5 text-center">Galeria <?php echo $this->result->name ?></h3>
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
                               var ventana_ancho = $(window).width();
                                if(ventana_ancho < 991)
                                {
                                  jQuery('.slider').bxSlider({
                                    auto: true,
                                    preloadImages: 'visible',
                                    adaptiveHeight: true,
                                    autoStart : true,
                                    mode : 'fade',
                                    speed: 1000});  
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
                  <h4 class="text-center">Informacion general</h4>
                  <?php 
                  echo $this->datasheetSection;
                  ?>
                </div>
              </div>
            <?php } ?>
              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center">Ficha tecnica</h4>
                  <table class="table table-hover-responsive text-center">
                    <tbody>
                    <?php 
                      echo $this->datasheetTable;
                    ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 pb-2">
                  <h4 class="text-center">Fichas de motos Relacionados con <?php echo $this->result->name ?></h4>
                   <div class="row">
                  <?php
                    foreach($this->datasheets_motorcycles as $motorcycles) {
                      echo "<div class='col-xs-6 col-md-4' style='padding-bottom:10px'>";

                      $ruta = JRoute::_('index.php?option=com_datasheet&datasheet='.$motorcycles->id);
      
                      echo '<div class="card" style="overflow:hidden">
                        <img src="'. JURI::root().$motorcycles->img_default.'" class="card-img-top" alt="..." style="max-width:100%">
                        <div class="card-body">
                        <!--<h5 class="card-title">'.$motorcycles->name.'</h5>
                          <p class="card-text"></p>-->
                          <a href="'.$ruta.'" class="btn btn-primary stretched-link" style="width:100%"><b>'.$motorcycles->name.'</b><br>
                          <small>'.$this->product_value($motorcycles).'</small></a>
                        </div>
                      </div>';
                      echo "</div>";
                    }
                  ?>
                </div>
              </div>
              </div>
              <div class="row">
                <div class="col-md-12" style="padding-bottom:20px">
                  <h4 class="text-center">Articulos Relacionados con <?php echo $this->result->name ?></h4>
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
      </div> 
     
