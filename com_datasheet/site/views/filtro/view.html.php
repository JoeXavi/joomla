<?php

defined('_JEXEC') or die('Restricted access');


use Joomla\CMS\Pagination\Pagination;
jimport('joomla.application.module.helper');

class DatasheetViewFiltro extends JViewLegacy
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
	
	public function getAllDatasheets($lim0 = 0, $lim = 12){
		
			$db = JFactory::getDbo();
			$sql = "select count(id) as total from #__datasheet_product";
			$db->setQuery($sql);
			$total =  $db->loadObjectList();
			
			$sql = "select * from #__datasheet_product order by id DESC";
			
			$db->setQuery($sql,$lim0,$lim);
			$datasheets =  $db->loadObjectList();
			foreach($total as $item)
				$pagination = new Pagination($item->total, $lim0, $lim);
			//var_dump($pagination);
			//var_dump($datasheets);
			
			return array('datasheets'=>$datasheets,'pagination'=>$pagination);
		}

	
	public function display($tpl = null)
	{
		$db = JFactory::getDbo();
	
		
		$input = JFactory::getApplication()->input;
		$this->filter = $input->get->get('filter', null, 'word');
		$lim0	= $input->get->get('start', 0, 'int');
		$lim = 12;	

		$this->data = (array) $input->get->get('jForm',null,'array'); 
		
		$sqlCount = "select count(p.id) as total from #__datasheet_product p inner join #__datasheet_product_data_value v on v.product_id=p.id where 1=1";
		$sqlTmp = "select * from #__datasheet_product p inner join #__datasheet_product_data_value v on v.product_id=p.id where 1=1";
		$sql="";
		$ver = 0 ;
		foreach($this->data as $key => $value){
			if($key == "'brand'" and $value<>'0'){
				$sql = $sql ." and p.marca_id=".$value;
				$ver = 1;
			}
			if($key == "'section_id'" and $value<>'0'){
				$sql = $sql ." and p.section_id=".$value;
				$ver = 1;
			}
			if($key == "'cilidrada_desde'" and $value<>'0'){
				$sql = $sql . " and json_extract_c(data,\"$.cilindrada\")>=".$value;
				$ver = 1;
			}
			if($key == "'cilidrada_hasta'" and $value<>'0'){
				$sql  = $sql . " and json_extract_c(data,\"$.cilindrada\")<".$value;
				$ver = 1;
			}
			if($key == "'precio_ini'" and $value<>'0'){
				$sql = $sql . " and json_extract_c(data,\"$.precio\")>=".$value;
				$ver = 1;
			}
			if($key == "'precio_fin'" and $value<>'0'){
				$sql  = $sql . " and json_extract_c(data,\"$.precio\")<".$value;
				$ver = 1;
			}
			if($key == "'year'" and $value<>'0'){
				$sql  = $sql . " and json_extract_c(data,\"$.modelo\")=".$value;
				$ver = 1;
			}
		}
		
		//var_dump( $sqlCount.$sql);
		//return;
		$db->setQuery($sqlCount.$sql);
		$total =  $db->loadObjectList();
		//var_dump($total);
		$sql = $sqlTmp.$sql;
		//var_dump($sql);
		$db->setQuery($sql,$lim0,$lim);
		$this->datasheets =  $db->loadObjectList();
		foreach($total as $item)
			$this->pagination = new Pagination($item->total, $lim0, $lim);
		

		//$db->setQuery($sql);
		//$total =  $db->loadObjectList();
		//foreach($total as $item)
		//		$this->pagination = new Pagination($item->total, $lim0, $lim);
		
		//var_dump($sql);
		$this->sidebar = JModuleHelper::getModules('sidebar');

		parent::display($tpl);
	}
}

