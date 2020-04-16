<?php
/**
 * @version		$Id: nameofplugin.php revision date lasteditedby $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

class plgContentForceregister extends JPlugin {

    function onContentAfterTitle($context, &$article, &$params, $limitstart)
	{
		//add your plugin codes here
		//return 'Hello world';
		//return a string value. Returned value from this event will be displayed in a placeholder. 
                // Most templates display this placeholder after the article separator.
    }
    function onContentPrepare($context, &$article, &$params, $limitstart)
	{
		//add your plugin codes here
		//no return value
		//var_dump($article);
		$config = $this->params;
		//var_dump($config);
		$document = JFactory::getDocument();
		
		$url = JUri::base() . 'plugins/content/forceregister/css/style.css';
		$urlJs = JUri::base() . 'plugins/content/forceregister/js/script.js';
		$registrarse = JUri::base() . $config['linkregister'];
		//echo $url;
		$document->addStyleSheet($url);
		$document->addScript($urlJs);
		
		$article->fulltext = "<div class='displayNone' id='forceregister'>
		<input type='hidden' id='ifloguin' value='".$config['check']."'>
								<div class='contenedor_message'>
								<p>".$config['message']."</p>
								<br>Click en <a id='clickregister' href='".$registrarse."?openview=2' >registrarse</a> o <a id='clickregister' href='".$registrarse."?openview=1' >iniciar sesión</a>
								 y vuelve para terminar de leer el articulo</div>
								 </div>
								 <div id='blurCont'>".$article->fulltext."</diV>";	

	}
}