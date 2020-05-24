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
	
	
	function display($tpl = null)
	{
		
		$db = JFactory::getDbo();
		
		$this->datasheets = "select * from #__datasheet_product order by id DESC limit 10";
		$db->setQuery($this->datasheets);
		$this->datasheets =  $db->loadObjectList();
		$this->brands = "select * from #__datasheet_product_brand order by name DESC";
		$db->setQuery($this->brands);
		$this->brands =  $db->loadObjectList();
// Display the view
		parent::display($tpl);
	}
}