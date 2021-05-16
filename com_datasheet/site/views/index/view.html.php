<?php

defined('_JEXEC') or die('Restricted access');


use Joomla\CMS\Pagination\Pagination;
jimport('joomla.application.module.helper');

class DatasheetViewIndex extends JViewLegacy
{
	
	public function product_value($product){
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product_data_value');
		$query->where('product_id = '.$db->quote($product->id));
		$db->setQuery($query);
		$result2 =  $db->loadObject();
		$product_value = json_decode($result2->data);
		$tiny = "";
		foreach($product_value as $clave => $value) {
			if($value<>""){
				$query = $db->getQuery(true);
				$query->select('*');
				$query->from('#__datasheet_product_data');
				$query->where('name = '.$db->quote($clave));
				$db->setQuery($query);
				$result3 =  $db->loadObject();
				
			
			if($result3->view_tiny == "tiny"){
				$tiny = $tiny . " | ";
				$tiny = $tiny . $result3->diminutive." ";
				if($result3->type == "number" or $clave == "precio")
					$tiny = $tiny . number_format($value)." ";
				else 
					$tiny = $tiny . $value." ";
					$tiny = $tiny . $result3->measurement;}
		}}
		return $tiny;
	}
	
	public function display($tpl = null)
	{
		$db = JFactory::getDbo();
	
		$this->brands = "select * from #__datasheet_product_brand order by name DESC";
		$db->setQuery($this->brands);
		$this->brands =  $db->loadObjectList();

		$this->sections = "select * from #__datasheet_product_section where state='active' order by name DESC";
		$db->setQuery($this->sections);
		$this->sections =  $db->loadObjectList();

		$cache = JFactory::getCache('com_datasheet','callback');
		$cache->setCaching( 1 );

		$this->allData = [];
		$cont = 0;
		//var_dump($this->sections);

		foreach($this->sections as $section){

			$sql = "select * from #__datasheet_product WHERE section_id=".$section->id." ORDER BY id DESC LIMIT 6";
			$db->setQuery($sql);
			$this->allData[$cont] = $db->loadObjectList();
			$cont++;

		}

		//var_dump(count($this->allData));

		$this->sidebar = JModuleHelper::getModules('sidebar');
		parent::display($tpl);
		
	}
}

