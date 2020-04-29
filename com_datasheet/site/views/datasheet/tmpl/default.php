<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<?php 
JHtml::_('jquery.framework');
JHtml::_('bootstrap.framework');

use Joomla\CMS\Factory;
$input = Factory::getApplication()->input;
$datasheet = $input->get('datasheet', '1', 'string');
$db = JFactory::getDbo();
$query = $db->getQuery(true);
$query->select('*');
$query->from('#__datasheet_product');
$query->where('id = '.$db->quote($datasheet));
$db->setQuery($query);
$result =  $db->loadObject();
//echo $p1; 
//var_dump($result);
?>
<div>
    <div class="container mt-5">
    <div class="motos enduro">    
        <div class="moto honda">
          <img src="<?php echo JURI::root()."/".$result->img_default;?>" width="100%" class="rounded" alt="honda xr 190">
          <h1 class="bg-dark text-white text-center"><?php echo $result->name ?></h1>
        <div class="entry-highlights bg-dark text-white text-center"> 184.4 cc | 127 kg | 16 hp @ 8500 rpm | 2.750 € | 16.2 nm </div>
    </div></div>
    </div>

    <div  class="container">
      <div class="row">
          <div class="col-md-8">
              <div class="header-content-center mt-4">
               <a href="https://www.publimotos.com/mactualidad/3062-gixxer-250-vs-fz-25-vs-cb-250-twister-comparativo" class="btn btn-outline-secondary btn-lg #f47c14 btn-block"><h4>Gixxer 250 vs FZ 25 vs CB 250 Twister - Comparativo</h4></a>
              </div>
              <p class="h5 text-justify mt-4">Rueda delantera con sistema ABS para dar más seguridad y estabilidad al piloto. Freno trasero marca NISSIN complementa perfectamente el sistema de frenado.</p>
              <br>
            <!--div class="text-center mt-6">
                <h2 class="display-6">Costo de la Honda xre 190 </h1>
                <p class="text-justify mt-4"> El costo de la <strong>HONDA XRE 190 es 2750 € aproximadamente $11'700.000, </strong> Honda quiere abrirse paso  en uno de los segmentos más populares de nuestro país, para lo cual planea producir una nueva plataforma de 200cc.</p>
            </div>-->

         
            <div class="row">
                <div class="col-md-12">
                    <div class="header-content-center ">
                        <div class="text-center ">
                            <h2 class="display-5 text-sm-center">Datos tecnicos</h1>
                            <p  class="text-justify mt-4"><?php echo $result->description ?></p>
                        </div>
                    </div>
                </div>
            </div>
              
            <div class="row">
                  <div class="col-md-12"><hr>
                    <div class="header-content-right mt-5">
                      <div class="text-center-sm">  
                        <h2 class="display-5 text-center"> GALERIA HONDA XRE 190 </h2>
                        <div class=" text-left mt-5">
          
                          <div id="carouselExampleFade" class="carousel slide carousel-fade " data-ride="carousel">
                            <div class="carousel-inner text-center">
                              <div class="carousel-item active ">
                                <img src="img/honda-costado.png" class="d-block w-100"  alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/honda-der.png" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/honda-frente.png" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/hondallanta.png" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/honda1.png" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/honda-luces.png" class="d-block w-100 " alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/manejo.png" class="d-block w-100" alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/hondamotor.png" class="d-block w-100 " alt="...">
                              </div>
                              <div class="carousel-item">
                                <img src="img/cola.png" class="d-block w-100" alt="...">
                              </div>
                            </div>
                            <a class="carousel-control-prev " href="#carouselExampleFade" role="button" data-slide="prev">
                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next " href="#carouselExampleFade" role="button" data-slide="next">
                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
                  
            <table class="table table-hover-responsive text-center">
                       <thead>
                         <tr>
                           <td colspan="4" class="text-center h3"><strong> ficha tecnica</strong> </td>
                         </tr>
                       </thead>
                       <tbody>
                         <tr>
                           <th scope="row">1</th>
                           <td>Cilindraje</td>
                           <td>184.4 cc</td>
                         </tr>
                         <tr>
                           <th scope="row">2</th>
                           <td>Tipo de Motor</td>
                           <td>OHC, Monocilíndrico, 4 tiempos, Refrigerado por aire</td>
                         </tr>
                         <tr>
                           <th scope="row">3</th>
                           <td>Potencia Máxima</td>
                           <td>16 hp @ 8500 rpm</td>
                         </tr>
                         <tr>
                           <th scope="row">4</th>
                           <td>Torque Máximo</td>
                           <td>16.2 nm @ 6000 rpm</td>
                         </tr>
                         <tr>
                           <th scope="row">5</th>
                           <td>Relación de Compresión</td>
                           <td>9.5 a 1</td>
                         </tr>
                         <tr>
                           <th scope="row">6</th>
                           <td> Tipo de Transmisión</td>
                           <td>Mecánica 5 velocidades</td>
                         </tr>
                         <tr>
                           <th scope="row">7</th>
                           <td> Rueda Delantera</td>
                           <td>90 / 90 – 19</td>
                           
                         </tr>
                         <tr>
                           <th scope="row">8</th>
                           <td>  Rueda Trasera</td>
                           <td>110 / 90 – 17</td>
                         </tr>
                         <tr>
                           <th scope="row">9</th>
                           <td> Dimensión Total</td>
                           <td>2075 x 821 x 1179 mm</td>
                           
                         </tr>
                         <tr>
                           <th scope="row">10</th>
                           <td> Distancia Entre Ejes </td>
                           <td> 1358 mm</td>
                         </tr>
                         <tr>
                           <th scope="row">11</th>
                           <td>    Peso   </td>
                           <td>127 kgs  </td>
                           </tr>
                         <tr>
                           <th scope="row">12</th>
                           <td> Freno Delantero </td>
                           <td>  Disco con ABS </td>
                         </tr>
                         <tr>
                           <th scope="row">13</th>
                           <td> Freno Trasero </td>
                           <td>Disco </td>
                         </tr>
                         <tr>
                           <th scope="row">14</th>
                           <td>  Suspensión Delantera </td>
                           <td>Telescópica</td>
                         </tr>
                       </tbody>
                     </table>
            
          </div>
          <div class="col-md-4">
              <div class="header-content-right mt-4">
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
     </div>     
 
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>