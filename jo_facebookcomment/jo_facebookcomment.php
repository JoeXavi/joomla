<?php
/*------------------------------------------------------------------------
# plg_jo_facebookcomment - JO Facebook comment for Joomla 1.6, 1.7, 2.5 Plugin
# -----------------------------------------------------------------------
# author: http://www.joomcore.com
# copyright Copyright (C) 2011 Joomcore.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.joomcore.com
# Technical Support:  Forum - http://www.joomcore.com/Support
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Restricted access');

class plgContentjo_facebookcomment extends JPlugin 
{
	public function onContentBeforeDisplay($context, &$row, &$params, $page = 0)
	{
		$option = JRequest::getVar('option');
		if($option == 'com_content'){		
			$document = JFactory::getDocument();
			$view   = JRequest::getVar('view');
			$layout = JRequest::getVar('layout');
			//show or hide plugin on featured
			$frontPage = $this->params->get('fb_frontpage', 0);
			if (!$frontPage && $view == "featured"){
				return ;
			}	
			//show or hide plugin on categorys
			$category = $this->params->get('fb_category', 0);
			if(!$category && (($view == "categories")||($view == "category"))){
				return ;
			}
			//hide plugin on category
			$categories = $this->params->get('fb_categories', '');
			if($categories){
				$categoriesArray = explode(",",$categories);
				if(strlen(array_search($row->catid,$categoriesArray))){
					return ;
				}
			}
			//var_dump($row);
			//hide plugin on article 
			$articles = $this->params->get('fb_articles', '');
			if($articles){
				$articlesArray = explode(",",$articles);
				if(strlen(array_search($row->id,$articlesArray))){
					return ;
				}
			}
			//plugin
			require_once(JPATH_BASE.'/components/com_content/helpers/route.php');    			
			if($row->id){
				$link = JRoute::_(ContentHelperRoute::getArticleRoute($row->id,$row->catid));
				$jURI = JURI::getInstance();
				$link = $jURI->getScheme()."://".$jURI->getHost().$link;
			}else{
				$jURI = JURI::getInstance();
				$link = $jURI->toString();
			}
			
			preg_match_all('/src="([^"]+)"/i', @$row->introtext.@$row->fulltext, $matches);
			//var_dump($item);
			if(!empty($matches[1][0])) {
				$imageUrl = JURI::root() . $matches[1][0]; 
				$document->addCustomTag( '<meta property="og:url" content="'.$link.'" />' );
				$document->addCustomTag( '<meta property="og:image" content="'.$imageUrl.'" />' );
			}
		
			// comment facebook
			$fbcomment = '<div id="fb-root"></div>';
			$fbcomment .= '
			<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/'.$this->params->get('lang', 'en_US').'/all.js#xfbml=1&version=v3.2&appId='.$this->params->get('app_id', '310786456414755').'";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, "script", "facebook-jssdk"));
			</script>
			';
			$categoria  = JRequest::getVar('catid');
			$DefauldStyleComment = "dark";
			if($categoria == 86 or $categoria == 77)
			    $DefauldStyleComment = "light";
			if($categoria == 51)
			   { 
			      $DefauldStyleComment = "dark"; 
			   }    
			$fbcomment .= '<div class="fb-comments" data-href="'.$link.'" data-numposts="'.$this->params->get('numposts', 5).'" data-colorscheme="'.$DefauldStyleComment.'" data-width="'.$this->params->get('width', 500).'"></div>';
			
			if($categoria == 51)
			    $row->introtext = $row->introtext.$fbcomment;
			
			$url = $_SERVER["REQUEST_URI"];
            $app  = JFactory::getApplication();
            $menu = $app->getMenu()->getActive()->link;

            $menu = JRoute::_($menu);
            
            if($menu<>'/promociones')
			$row->text = @$row->text.$fbcomment;
			
			
			
		}
		return; 
	}
}
?>