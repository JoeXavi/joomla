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

use Joomla\CMS\Factory;
jimport('joomla.application.module.helper');

class DatasheetViewFicha extends JViewLegacy
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

	public function loadDatasheet($id){
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product');
		$query->where('id = '.$db->quote($id));
		$db->setQuery($query);
		$result =  $db->loadObject();

		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product_data_value');
		$query->where('product_id = '.$db->quote($id));
		$db->setQuery($query);
		$result2 =  $db->loadObject();
		$product_value = json_decode($result2->data);

		$tiny = "";
		$datasheetTable = "";
		$datasheetSection = "";
		$competitionproduct  = "";

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
				$tiny = $tiny . $result3->name.": ";
				if($result3->type == "number" or $clave == "precio")
				$tiny = $tiny . number_format($value)." ";
				else 
				$tiny = $tiny . $value." ";
				$tiny = $tiny . $result3->measurement;}

			if($result3->view_datasheet == "datasheet"){
				if($clave == "precio")
					$value = number_format($value);
				$datasheetTable = $datasheetTable . "<tr>
				<th>".$result3->display_name."</th>
				<td>".$value."</td>
				</tr>";
			}

			if($result3->view_datasheet == "section"){
				$datasheetSection = $datasheetSection . '<div class="row">
				<div class="col-md-12">
				'.$value.'
				</div></div>';
			}

			if($clave == "cilindrada"){
				$cilindrada = $value;
				$cilUp = $cilindrada + 150;
				$cilDown = $cilindrada - 150;
				$sqlcil = "select p.* from #__datasheet_product p inner join #__datasheet_product_data_value v on v.product_id=p.id where 1=1 and p.type_id=1 and state='active' and p.id<>".$id."";
				$sqlcil = $sqlcil . " and json_extract_c(data,\"$.cilindrada\")>".$cilDown."";
				$sqlcil = $sqlcil . " and json_extract_c(data,\"$.cilindrada\")<".$cilUp."";
				//var_dump($sqlcil);
				$db->setQuery($sqlcil);
				$competitionproduct =  $db->loadObjectList();
			}
		}

		
		 
		$name_parts = explode(" ",$result->name);
		$sql = "select id, catid, alias, language, title from #__content where title like '%".$name_parts[0]."%' order by id DESC limit 10";
		$db->setQuery($sql);
		$articles =  $db->loadObjectList();
				
		$product_rels = "";
		if((int)$result->type_id === 1){
			$product_rels = "select * from #__datasheet_product where type_id<>1 and state='active' and relations like '%:\"".$id."\"%' order by id DESC limit 6";
		}
		// if((int)$result->type_id === 1){
		// 	$datasheets_motorcycles = "select * from #__datasheet_product where type_id=1 and state='active' and id<>".$id." order by id DESC limit 6";
		// 	
		// 	$db->setQuery($datasheets_motorcycles);
		// 	$datasheets_motorcycles =  $db->loadObjectList();
		// 	} else {
				
		// 	}
		$motorcycle_datasheet_rels = json_decode($result->relations, true);
		$datasheets_motorcycles = new stdClass();
		$i=0;
		// echo "motorcycle_datasheet_rels <br>";
		// var_dump($motorcycle_datasheet_rels);
		
		//echo "<br>";
		if(is_array($motorcycle_datasheet_rels)){
			//echo "Entra en if <br>";
			foreach($motorcycle_datasheet_rels as $key => $value){
				$sql = "select * from #__datasheet_product where type_id=1 and state='active' and id=".(int) $value."";
				$db->setQuery($sql);
				$data =  $db->loadObjectList();
				$datasheets_motorcycles->{$i}=$data[0];
				$i++;				
			}
			// echo "<br>";
			// var_dump($datasheets_motorcycles);
		}
		
		
		if($product_rels<>''){
		$db->setQuery($product_rels);
		$product_rels =  $db->loadObjectList();}
		}			
		return array('result'=>$result,
			'product_value'=>$product_value,
			'tiny'=>$tiny,
			'datasheetTable'=>$datasheetTable,
			'datasheetSection'=>$datasheetSection,
			'articles'=>$articles,
			'datasheets_motorcycles'=>(object) $datasheets_motorcycles,
			'product_rels'=>$product_rels,
			'competition'=>$competitionproduct);
	}
	
	
	function display($tpl = null)
	{
		
		$input = Factory::getApplication()->input;
		$datasheet = $input->get('id', '1', 'string');
		
		$cache = JFactory::getCache('com_datasheet','callback');
		
	
		$return = $cache->get(array($this, 'loadDatasheet'),array($datasheet) );
		$this->result = $return['result'];
		$this->product_value = $return['product_value'];
		$this->tiny = $return['tiny'];
		$this->datasheetTable = $return['datasheetTable'];
		$this->datasheetSection = $return['datasheetSection'];
		$this->articles = $return['articles'];
		$this->datasheets_motorcycles = $return['datasheets_motorcycles'];
		$this->product_rels = $return['product_rels'];
		$this->competitionproduct = $return['competition'];

		$this->sidebar = JModuleHelper::getModules('sidebar');
		$this->renderSidebar = "";
		//var_dump($this->sidebar);
		foreach ($this->sidebar as $module) {
			//($module);
			$this->renderSidebar = $this->renderSidebar . JModuleHelper::renderModule($module);
			}
		
				// Display the view
		parent::display($tpl);
	}
}