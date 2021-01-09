<?php
session_start();

if (!isset($_SESSION['cod_usuario'])) {
	header("Location:indexControl.php");
} else {

    include_once 'include/conexion.php';
    include_once 'include/funciones.php';

    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasad

    $sql = "select * from live ORDER BY timestamp DESC LIMIT 1";
	$rs = mysqli_query($conexion,$sql );
	$resultado = mysqli_fetch_array($rs);
	$carpeta = $resultado['carpeta'];

	if ($resultado['estado']=='Activo') {
		
        if (isset($_POST['cierreLive']) && $_POST['cierreLive']!="") {
	      
            $sql = "update live set estado='Cerrado' where id=". $resultado['id'] ;
			$rs = mysqli_query($conexion,$sql );
			$comando = shell_exec('nohup '.'./EjecutorCierre.sh '.$carpeta.' > /dev/null 2>&1 & echo $!');

   			print "Salida: $comando \n";
   			header("Location:ControlLive.php");
		}	
	} else {
		
        if (isset($_POST['iniciarLive']) && $_POST['iniciarLive'] != "") {
			
            date_default_timezone_set('UTC');
            $timestamp = strtotime(date("Y-m-d H:i:s"));
            $urlAmigable =  sanear_string_url($_POST['titulo']);
        
            do {
                $carpeta = hexadecimalAzar(10);
                $sql = "select carpeta from live where carpeta = '" . $carpeta . "'";
                $rs = mysqli_query($conexion,$sql);
            } while( mysqli_num_rows($rs)<>false);

            $tituloArt = sanear_string_especial($_POST['titulo']);
            $descripcionArt = sanear_string_especial($_POST['descripcionLive']);

            $conexionArticulo = $_POST['TipoRegistro'];


            if ($conexionArticulo == "n2") {
                $conexionReal = mysqli_connect($db_host,$db_usuario2, $db_password2, $db_nombre2);
                //$categoriaArticulo = 86;
                $categoriaArticulo = 89;
                if($_POST['category'] != 0){
                    $categoriaArticulo = $_POST['category'];
                }
                $urlNotificacion = "https://n2.publimotos.com/";

                if (url_exists('https://n2.publimotos.com/images/2019/livesF2R/'.$carpeta .'.jpg'))
                    $imagenArticulo = "2019/livesF2R/".$carpeta.".jpg";
                else
                    $imagenArticulo = "2019/livesF2R/PlantillaArticulosPublimotos.jpg";
            }
            
            if ($conexionArticulo == "todos") {
                $conexionReal = mysqli_connect($db_host,$db_usuario3, $db_password3, $db_nombre3);
                $categoriaArticulo = 86;
                //$categoriaArticulo = 89;
                if($_POST['category'] != 0){
                    $categoriaArticulo = $_POST['category'];
                }
                $urlNotificacion = "https://www.publimotos.com/";

                if (url_exists('https://www.publimotos.com/images/lives/'.$carpeta.'.jpg'))
                    $imagenArticulo = "lives/".$carpeta.".jpg";
                else
                    $imagenArticulo = "lives/PlantillaArticulosPublimotos.jpg";
            }

            mysqli_set_charset($conexionReal, "utf8");

            echo $imagenArticulo;

            $fulltextStr = '';
            $imagesStr = '{"image_intro":"images\/'.str_replace("/", "\/", $imagenArticulo).'","float_intro":"","image_intro_alt":"Imagen del Artículo","image_intro_caption":"","image_fulltext":"images\/2019\/livesF2R\/PlantillaArticulosPublimotos.jpg","float_fulltext":"","image_fulltext_alt":"Image by PubliMotos","image_fulltext_caption":""}';
    
            $contIframe = "<div class=\"embed-container\" datotransmision=\"".$carpeta."\"><iframe width=\"560\" height=\"315\" src=\"https://publimotostv.com/LiveDebug.php?carpeta=".$carpeta."\" allowfullscreen=\"allowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" oallowfullscreen=\"\" msallowfullscreen=\"\">\r\n\r\n   </iframe></div>";
            $attribsStr = '{"article_layout":"","show_title":"","link_titles":"","show_tags":"","show_intro":"","info_block_position":"","info_block_show_title":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_associations":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_page_title":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":"","title":"","imageredes":"","metadescription":"","ctm_content_type":"video","ctm_source":"other","ctm_local_src":"","ctm_embed_code":"<div class=\"embed-container\" datotransmision=\"'.$carpeta.'\"><iframe width=\"560\" height=\"315\" src=\"https:\/\/publimotostv.com\/VideoMaster.php?carpeta='.$carpeta.'\" allowfullscreen=\"allowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" oallowfullscreen=\"\" msallowfullscreen=\"\">\r\n\r\n   <\/iframe><\/div>","ctm_embed_url":"","ctm_thumbnail":"","ctm_description":"","ctm_width":"640","ctm_height":"360","ctm_topic_id":""}';

            $sql = "INSERT INTO `gzvfr_content` (`title`, `alias`, `introtext`, `fulltext`, `state`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) 
                    VALUES   ('".$tituloArt."', '".$urlAmigable."', '<p>".$descripcionArt."</p>\r\n', '\r\n<div class=\"embed-container\" datotransmision=\"".$carpeta."\"><iframe width=\"560\" height=\"315\" src=\"https://publimotostv.com/LiveDebug.php?carpeta=".$carpeta."\" allowfullscreen=\"allowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" oallowfullscreen=\"\" msallowfullscreen=\"\">\r\n\r\n   </iframe></div><center><div class=\"ContenedorLogin\"><a href=\"#\" class=\"btn btn-block btn-social btn-facebook\" id=\"LoginFacebook\" onclick=\"ingresar()\" style=\"margin: 10px 0px; max-width: 300px;\"><span class=\"fa fa-facebook\"></span>Para comentar inicia sesión</a></div></center><p><iframe width=\"100%\" height=\"500\" frameborder=\"0\" src=\"https://publimotostv.com/include/comentarios.php?carpeta=".$carpeta."\" allowfullscreen=\"allowfullscreen\" webkitallowfullscreen=\"webkitallowfullscreen\" mozallowfullscreen=\"mozallowfullscreen\" oallowfullscreen=\"\" msallowfullscreen=\"\"></iframe></p>', 1, '".$categoriaArticulo." ', '".date("Y-m-d H:i:s")."', 45, '', '".date("Y-m-d H:i:s")."', 45, 0, '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."', '0000-00-00 00:00:00', '".addslashes($imagesStr)."', '{\"urla\":false,\"urlatext\":\"\",\"targeta\":\"\",\"urlb\":false,\"urlbtext\":\"\",\"targetb\":\"\",\"urlc\":false,\"urlctext\":\"\",\"targetc\":\"\"}', '".addslashes($attribsStr)."', 19, 0, '', '', 1, 0, '{\"robots\":\"\",\"author\":\"\",\"rights\":\"\",\"xreference\":\"\"}', 0, '*', '');";
            
            if (mysqli_query($conexionReal,$sql)) {

                $ultimoId = mysqli_insert_id($conexionReal);
                $sql = "insert into live (carpeta, estado, timestamp, Mensaje, titulo, urlAmigable,tipo) values('".$carpeta."','Activo','".$timestamp."','".$descripcionArt."','".$tituloArt."', 'en-vivo-ofertas-motos/".$ultimoId.'-'.$urlAmigable."','".$conexionArticulo."')" ;
                $sql2 = "INSERT INTO gzvfr_content_meta (content_id, meta_key, meta_value) values ('".$ultimoId."', 'content_type', 'video')";
                mysqli_query($conexionReal, $sql2);

                if ( mysqli_query($conexion,$sql )) {

                    $comando = 'nohup '.'./ejecutor.sh '.$carpeta.' > /dev/null 2>&1 & echo $!';
                    echo $comando;
                    $comando = shell_exec($comando);

                require_once("include/notificacionDebug.php");

                if ($_POST['TipoNotificacion']<>"nadie")
                    $notificacion = sendMessage(  $tituloArt, $descripcionArt, $carpeta, $_POST['TipoNotificacion'],$urlNotificacion.$ultimoId.'-'.$urlAmigable);
                    unset($_POST['carpeta']);
                    print "Salida: $comando \n";
                    header("Location:ControlLive.php");

                } else {
                    echo "Fallo la Consulta2";
                }
            } else {
                echo "Fallo la Consulta1";
            }
        } else {
            $sql = "select * from gzvfr_categories where published = 1 and extension = 'com_content'";

        }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html" charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="source/icono.png">
    <link rel="apple-touch-icon-precomposed" href="source/icono.png">
    <title>Control Live Publimotos</title>
    <!-- Bootstrap core CSS-->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="https://vjs.zencdn.net/7.4.1/video-js.css" rel="stylesheet">
    <link rel="stylesheet" href="css/vsg-skin.css"/>
    <!-- Imágenes-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="js/funciones.js"></script>
    <script type="text/javascript">

    //Valida si hay campos requeridos vacios

    function ValidarFor() {
    		var strError = "";
    		for (var intLoop = 0; intLoop<document.forma.elements.length; intLoop++){
    			if (null!=document.forma.elements[intLoop].getAttribute("Requerido")){ 
    				if (document.forma.elements[intLoop].value == ""){
    					strError += "  " + document.forma.elements[intLoop].name + "\n";
    					document.forma.elements[intLoop].style.background = "#ffff99";
    		 		}else{
    					document.forma.elements[intLoop].style.background = "white";
    		 		}
    			}
    	   	}
    	   	if ("" != strError) {
    			alert("Por favor complete los campos resaltados");
    			return false;
    	   }
    	   
    	   return true;
    	}
    </script>
    <style type="text/css">
       
        .videocontent{
          margin:50px auto ;

          max-width: 100%;
        }
    </style>
</head>
<body class="bg-dark">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="registro_clientes.php"><?php echo $_SESSION['nom_usuario']?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li>
                    <a class="nav-link" href="cerrar_sesion.php">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="row">
        <div class="col-md-3 offset-1">
            <?php if ($resultado['estado'] == 'Activo') { ?>
        	
            <div class="container">
                <div class="card card-login mx-auto mt-5">
                    <div class="card-header">Control de Transmision en vivo - Cierre</div>
                    <div class="card-body">
                        <form name="rtmp" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <div class="form-group">
                            <input type="hidden" name="publicado" value="true"/>
                            <input type="hidden" name="target" value="n2">
                            <button type="submit" name="cierreLive" value="liveOFF" class="btn btn-primary btn-block btn-warning">Live OFF</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { 

    /*if (isset($_POST['publicado']) && $_POST['publicado'] == true) {
        echo "<h1>Listo. A publicar!</h1>";
    }*/ ?>
        <div class="container">
            <div class="card card-login mx-auto mt-5">
                <div class="card-header">Control de Transmision en vivo - Inicio</div>
                <div class="card-body">
                    <form name="rtmp" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Titulo de transmisión</label>
                            <input class="form-control" id="titulo" name="titulo" type="text" aria-describedby="titulo" requiered placeholder="Titulo de transmisión">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tipo Registro</label>
                            <select class="form-control" id="tiporegistro" name="TipoRegistro" required="required">
                                <option value="n2">n2</option>
                                <option value="todos">Publica</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Categorias</label>
                            <select class="form-control" id="category" name="category" required="required">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tipo notificacion</label>
                            <select class="form-control" id="TipoNotificacion" name="TipoNotificacion" required="required">
                                <option value="test">Test</option>
                                <option value="todos">Todos</option>
                                <option value="nadie">Nadie</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Descripción</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="descripcionLive" pattern="/^[A-Za-z0-9]+$/g" requiered placeholder="Descripcion Live" maxlength="200" rows="6"></textarea>
                        </div>
                        <div class="form-group">
                            <input name="variable"  type="hidden"/>
                            <button type="submit" class="btn btn-primary btn-block btn-warning" name= "iniciarLive" value="iniciarLive">Live ON</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="col-md-7">
        <div class="container">
            <div class="videocontent">
                <video id="my_video_1" class="video-js vjs-default-skin vjs-16-9 vjs-big-play-centered" controls preload="auto" width="640" height="264" poster="poster.jpg" controlsList="nodownload">
            <!--<source src="<?php // echo $_GET['load'] ?>/h264_master.m3u8" type="application/x-mpegURL">-->
                    <source src="rtmp://64.91.247.168/app/live" type="rtmp/flv"/>
            <!--<source src="<?php // echo $_GET['load'] ?>/error.webm" type="video/webm"/>  -->
                    
                </video>
                
                <script src="https://vjs.zencdn.net/7.4.1/video.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/videojs-flash@2/dist/videojs-flash.min.js"></script>
                <script>
                    window.onload = function() {
                        const player = videojs('my_video_1', {techOrder: ['html5','flash']});
                    };
                    
                </script>
            </div>
        </div>
    </div>
</div>
 
</body>
</html>
<?php
}
?>
