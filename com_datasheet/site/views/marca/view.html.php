<?php

defined('_JEXEC') or die('Restricted access');


use Joomla\CMS\Pagination\Pagination;
jimport('joomla.application.module.helper');

class DatasheetViewMarca extends JViewLegacy
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
	
	public function getAllDatasheetsByBrand($lim0 = 0, $lim = 12, $brand){
		
			$db = JFactory::getDbo();
			$sql = "select count(id) as total from #__datasheet_product where marca_id=".$brand;
			$db->setQuery($sql);
			$total =  $db->loadObjectList();
			
			$sql = "select * from #__datasheet_product where marca_id=".$brand." order by id DESC";
			
			$db->setQuery($sql,$lim0,$lim);
			$datasheets =  $db->loadObjectList();
			foreach($total as $item)
				$pagination = new Pagination($item->total, $lim0, $lim);
			
			return array('datasheets'=>$datasheets,'pagination'=>$pagination);
		}

	
	public function display($tpl = null)
	{	
		$input = JFactory::getApplication()->input;
		$this->brand = $input->get('id', '1', 'string');

		$db = JFactory::getDbo();
		$this->dataBrand = "select * from #__datasheet_product_brand where id=".$this->brand;
		$db->setQuery($this->dataBrand);
		$this->dataBrand =  $db->loadObjectList();

		foreach($this->dataBrand as $brand){
			$this->dataBrandFull = $brand;
		}
		
		$lim0	= $input->get->get('start', 0, 'int');
		$lim = 12;	

		$cache = JFactory::getCache('com_datasheet','callback');
		$cache->setCaching( 1 );

		$return = $cache->call(array($this, 'getAllDatasheetsByBrand'),$lim0, $lim, $this->brand );
		if($return == null){
			//var_dump("Entra a store");
			$return = $this->getAllDatasheetsByBrand($lim0, $lim, $this->brand);
			$cache->store($return, 'getAllDatasheetsByBrand', 'com_datasheet');
		}
		
		//$return = $cache->call(array('DatasheetViewIndex','getAllDatasheets'), $lim0, $lim );
		$this->pagination = $return['pagination'];
		$this->datasheets = $return['datasheets'];
		//var_dump("Here 1");
		parent::display($tpl);
	
	}
}

