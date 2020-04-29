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
/**
 * HelloWorld Controller
 *
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 * @since       0.0.9
 */
class DatasheetControllerDatasheet extends JControllerForm

{
    public $jsonMyForm = "";
    public $action = "";
    function __construct(array $config = array())
	{
       
        parent::__construct($config);
	}
    
    public function save(string $key = null, string $urlVar = null){
        $input = JFactory::getApplication()->input;
        $data = $input->post->get('myform',array(), "array");
        $this->jsonMyForm = json_encode($data);
        $id = $input->post->get('jform',array(), "array");
        $this->action = $id['id'];
        parent::save($key, $urlVar);
    }

    public function postSaveHook($model, $validData)
    {
        $item = $model->getItem();
        $id = $item->get('id');
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        if($this->action == ""){
            $columns = array('product_id','data');
            $values = array($id,$db->quote($this->jsonMyForm));
            $query->insert($db->quoteName('#__datasheet_product_data_value'))
            ->columns($db->quoteName($columns))
            ->values(implode(',', $values));
        }   
        else {
            $fields = array ( $db->quoteName('data') . ' = ' . $db->quote($this->jsonMyForm));
            $conditions = array('product_id' . ' = ' . $this->action);
            $query->update($db->quoteName('#__datasheet_product_data_value'))->set($fields)->where($conditions);
        }
        $db->setQuery($query);
        $db->execute();
        //exit();
    } 

}