<?php
/**
* @package plugin load module into article
* @version 3.1.0
* @copyright Copyright (C) 2008 - 2015 Carsten Engel. All rights reserved.
* @license GPL
* @author http://www.pages-and-items.com
*/

// No direct access
defined('_JEXEC') or die;

jimport('joomla.plugin.plugin');

class plgContentLoadDatasheetInArticle extends JPlugin{	


	public function onContentPrepare($context, &$article, &$params, $limitstart=0){		
		
		
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') {
			return true;
		}
	  
		$regex = '/{(datasheetm)\s*(.*?)}/i';	
			
		$matches = array();
		$preg_set_order = PREG_SET_ORDER;
		preg_match_all($regex, $article->text, $matches, $preg_set_order);  
    
       
        //var_dump($matches);
               for($i=0;$i<count($matches);$i++){

            $paramsarray = explode(' ',$matches[$i][2]);
            //var_dump($paramsarray);			
            $module_id = $paramsarray[0];
            $id = $paramsarray[1]; 
            //var_dump($module_id);		            
            $module_output = $this->load_module($module_id,$id);
            //var_dump($module_output);
            $article->text = preg_replace($regex, $module_output, $article->text, 1);	
        }
        //exit();
		
	}
	
	protected function load_module($module_id, $id){
		
        $module  = JModuleHelper::getModule($module_id);  
        $module->params = "id=".$id;		
        $contents = JModuleHelper::renderModule($module);
        return $contents;
	}
}

?>