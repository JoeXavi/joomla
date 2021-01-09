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
class ModDatasheetotherHelper
{
    /**
     * Retrieves the hello message
     *
     * @param   array  $params An object containing the module parameters
     *
     * @access public
     */    
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

		$query = $db->getQuery(true);
		$query->select('*');
		$query->from('#__datasheet_product_data_value');
		$query->where('product_id = '.$db->quote($datasheet));
		$db->setQuery($query);
		$result2 =  $db->loadObject();
		$product_value = json_decode($result2->data);

        //$datasheetTable="";
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
                    $tiny = $tiny . $result3->name.": ";
                    if($result3->type == "number" or $clave == "precio")
                    $tiny = $tiny . number_format($value)." ";
                    else 
                    $tiny = $tiny . $value." ";
                    $tiny = $tiny . $result3->measurement;}
                
               /* if($result3->view_datasheet == "datasheet"){
                    /*if(is_numeric($value) && $result2->type==="number"){
                        $value = number_format($value,1);
                    }
                    $datasheetTable = $datasheetTable . "<tr>
                    <th>".$result3->display_name."</th>
                    <td>".$result3->diminutive.$value." ".$result3->measurement."</td>
                    </tr>";
                }
                */

                
            }
        }
        
        return array("product"=>$result,'values'=>$tiny,"datasheet"=>$datasheet);

    }
}
