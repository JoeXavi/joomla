<?php
/*------------------------------------------------------------------------
# plg_jo_livecomment - JO Facebook comment for Joomla 1.6, 1.7, 2.5 Plugin
# -----------------------------------------------------------------------

-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class plgContentjo_livecomment extends JPlugin 
{
	public function onContentBeforeDisplay($context, &$row, &$params, $page = 0)
	{
		//session_start();
		$document = JFactory::getDocument();
		$document->addScript('https://code.jquery.com/jquery-3.4.0.min.js');
		$document->addScript('https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js');
		$document->addScript('https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js');
	
		 $document->addScript('https://publimotostv.com/js/fancywebsocketPlugin.js');
		 $document->addStyleSheet('https://publimotostv.com/css/slidejs.css');
            $document->addStyleSheet('https://publimotostv.com/css/bootstrap-social.css');
            $document->addStyleSheet('https://publimotostv.com/css/estilos.css');
            $document->addScript('https://publimotostv.com/js/facebooklogin.js');
            $document->addScript('https://publimotostv.com/js/insertar_comentario.js');
                
       
      return; 
      
	}
}
?>