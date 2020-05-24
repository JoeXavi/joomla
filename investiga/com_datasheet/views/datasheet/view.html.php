“<?php
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

class DatasheetViewDatasheet extends JViewLegacy
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
	
	
	function display($tpl = null)
	{
		
		$input = Factory::getApplication()->input;
		$datasheet = $input->get('datasheet', '1', 'string');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product');
		$query->where('id = '.$db->quote($datasheet));
		$db->setQuery($query);
		$this->result =  $db->loadObject();

		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product_data_value');
		$query->where('product_id = '.$db->quote($datasheet));
		$db->setQuery($query);
		$result2 =  $db->loadObject();
		$this->product_value = json_decode($result2->data);

		$this->tiny = "";
		$this->datasheetTable = "";
		$this->datasheetSection = "";
		foreach($this->product_value as $clave => $value) {
			if($value<>""){
				$query = $db->getQuery(true);
				$query->select('*');
				$query->from('#__datasheet_product_data');
				$query->where('name = '.$db->quote($clave));
				$db->setQuery($query);
				$result3 =  $db->loadObject();
				
			
			if($result3->view_tiny == "tiny"){
				$this->tiny = $this->tiny . " | ";
				$this->tiny = $this->tiny . $result3->name.": ";
				if($result3->type == "number" or $clave == "precio")
				$this->tiny = $this->tiny . number_format($value)." ";
				else 
				$this->tiny = $this->tiny . $value." ";
				$this->tiny = $this->tiny . $result3->measurement;}

			if($result3->view_datasheet == "datasheet"){
				if($clave == "precio")
					$value = number_format($value);
				$this->datasheetTable = $this->datasheetTable . "<tr>
				<th>".$result3->display_name."</th>
				<td>".$value."</td>
				</tr>";
			}

			if($result3->view_datasheet == "section"){
				$this->datasheetSection = $this->datasheetSection . '<div class="row">
				<div class="col-md-12">
				'.$value.'
				</div></div>';
			}
		}

		$name_parts = explode(" ",$this->result->name);
		$sql = "select id, catid, alias, language, title from #__content where title like '%".$name_parts[0]."%' order by id DESC limit 10";
		$db->setQuery($sql);
		$this->articles =  $db->loadObjectList();

		$this->datasheets_motorcycles = "select * from #__datasheet_product where type_id=1 and state='active' and id<>".$datasheet." order by id DESC limit 10";
		$db->setQuery($this->datasheets_motorcycles);
		$this->datasheets_motorcycles =  $db->loadObjectList();
	}		
		// Display the view
		parent::display($tpl);
	}
}