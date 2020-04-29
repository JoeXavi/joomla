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

class plgContentSocialbuttons extends JPlugin {

    function onContentAfterTitle($context, &$article, &$params, $limitstart)
	{
		
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
		
		$article->fulltext = '<ul class="social-icons" id="l2">
            <li><a href="" class="social-icon"> <i class="fa fa-facebook"></i></a></li>
            <li><a href="" class="social-icon"> <i class="fa fa-twitter"></i></a></li>
            <li><a href="" class="social-icon"> <i class="fa fa-rss"></i></a></li>
            <li><a href="" class="social-icon"> <i class="fa fa-youtube"></i></a></li>
            <li><a href="" class="social-icon"> <i class="fa fa-google-plus"></i></a></li>
        </ul>'. $article->fulltext;	

	}
}