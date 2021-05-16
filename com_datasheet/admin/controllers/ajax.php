<?php

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;

use function PHPSTORM_META\type;

class DatasheetControllerAjax extends JControllerLegacy
{
    function limpia_espacios($cadena){
        $cadena = str_replace(' ', '', $cadena);
        return strtolower($cadena);
      }

    public function work(){
        $app = JFactory::getApplication();

        $data = $app->input->get('data', null, 'uint');
        $with = $app->input->get('with', null, 'uint');
        
        if (is_null($data)) {
            throw new Exception('Invalid Parameter', 500);
        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__datasheet_product_type');
        $query->where('id = '.$db->quote($data));
        $db->setQuery($query);
        $response = $db->loadObject();

        if(!is_null($with) and $with<>0)
        {
            //var_dump($with);
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__datasheet_product_data_value');
            $query->where('product_id = '.$db->quote($with));
            $db->setQuery($query);
            $response2 = $db->loadObject();
            $with = json_decode($response2->data);  
        }
        
        $array =json_decode($response->datas);        
        $fields = "";
        foreach ($array as $value) {
            $query = $db->getQuery(true);
            $query->select('*');
            $query->from('#__datasheet_product_data');
            $query->where('id = '.$db->quote($value));
            $db->setQuery($query);
            $result =  $db->loadObject();
            // $totalResult = $totalResult . "'nombre':'".$result->name."','type':'".$result->type."',";
            $name = $this->limpia_espacios($result->name);
            $xmlText = '<?xml version="1.0" encoding="utf-8"?><form>';
            switch($result->type){
                case "textarea": $xmlText = $xmlText . '<field 
                        name="'.$name.'"
                        type="'.$result->type.'"
                        default=""
                        label="Item '.$result->display_name.'"
                        description="'.$result->description.'"
                        rows="3"
				        cols="10" 
                        />'; break;
                case "number": $xmlText = $xmlText . '<field 
                        name="'.$name.'"
                        type="'.$result->type.'"
                        default=""
                        label="Item '.$result->display_name.'"
                        description="'.$result->description.'"
                        step="0.01" 
                        />'; break;
                case "text": $xmlText = $xmlText . '<field 
                        name="'.$name.'"
                        type="'.$result->type.'"
                        default=""
                        label="Item '.$result->display_name.'"
                        description="'.$result->description.'"
                        />';break;
                    }

            $xmlText = $xmlText . "</form>";
            //var_dump($xmlText);
            $xml = new SimpleXMLElement($xmlText);
            $url = JPATH_COMPONENT_ADMINISTRATOR. "/controllers/files/base.xml";
        
            $form = Form::getInstance("sample",$url, array("control" => "myform"));
            $form->load($xml);
            $prefillData = array($name => $with->{$name});
            $form->bind($prefillData);
            $fields = $fields . $form->renderField($name);
        }

       
        $totalResult = $fields;
        echo new JResponseJson($totalResult,"Resultado de consulta",false);

        $app->close();
    }
}