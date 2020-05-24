<?php
/**
 * Helper class for Hello World! module
 * 
 * @package    Joomla.Tutorials
 * @subpackage Modules
 * @link http://docs.joomla.org/J3.x:Creating_a_simple_module/Developing_a_Basic_Module
 * @license        GNU/GPL, see LICENSE.php
 * mod_helloworld is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 */
class ModDatasheetrelsHelper
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
				if($result3->type == "number")
				$tiny = $tiny . number_format($value)." ";
				else 
				$tiny = $tiny . $value." ";
				$tiny = $tiny . $result3->measurement;}
		}}
		return $tiny;
    }

    public static function getBase($params)
    {
        $datasheet = $params->get('id');
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product');
		$query->where('id = '.$db->quote($datasheet));
		$db->setQuery($query);
		$result =  $db->loadObject();
        
        $db = JFactory::getDbo();
		$datasheets_motorcycles = "select * from #__datasheet_product where type_id=1 and state='active' and id<>".$params->get('id')." order by id DESC limit 10";
		$db->setQuery($datasheets_motorcycles);
		$datasheets_motorcycles =  $db->loadObjectList();
        
        return array("product"=>$result,"result"=>$datasheets_motorcycles);

    }
}
