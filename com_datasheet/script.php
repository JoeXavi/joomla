<?php
// create a folder inside your images folder

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.folder');
/**
 * Script file of DATASHEET component
 */
class com_datasheetInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
      // $parent is the class calling this method
      if(JFolder::create(JPATH_ROOT.DS.'images'.DS.'datasheetmedia')) {
		$parent->getParent()->setRedirectURL('index.php?option=com_datasheet');
      } else {
         echo "Unable to create folder";
      } 
		
	}
 
	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		echo '<p>' . JText::_('COM_DATASHEET_UNINSTALL_TEXT') . '</p>';
	}
 
	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		$db = JFactory::getDbo();
		$sql = "select * from #__datasheet_product";
		$db->setQuery($sql);
		$data =  $db->loadObjectList();
		foreach($data as $item){
			//$query = $db->getQuery(true);
			$slug = JFilterOutput::stringURLSafe($item->name);
			$item->slug = $slug;
			$db->updateObject('#__datasheet_product', $item, 'id', true);
		}

		$query = $db->getQuery(true);
		$sql = "select * from #__datasheet_product_section";
		$db->setQuery($sql);
		$sections =  $db->loadObjectList();
		if(is_array($sections)){
			if(!isset($sections[0])){
				$columns = array('name', 'description', 'state');
				$values = array($db->quote('Fichas tecnicas'), $db->quote("Descripcion"), $db->quote('active'));

				$query->insert($db->quoteName('#__datasheet_product_section'))
				->columns($db->quoteName($columns))
				->values(implode(',', $values));

				$db->setQuery($query);
				$db->execute();

				foreach($data as $item){
					$item->section_id = 1;
					$db->updateObject('#__datasheet_product', $item, 'id', true);
				}

			}
		}
		

		echo '<p>' . JText::sprintf('COM_DATASHEET_UPDATE_TEXT', $parent->get('manifest')->version) . '</p>';
	}
 
	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '<p>' . JText::_('COM_DATASHEET_PREFLIGHT_' . $type . '_TEXT') . '</p>';
	}
 
	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		// $parent is the class calling this method
		// $type is the type of change (install, update or discover_install)
		echo '<p>' . JText::_('COM_DATASHEET_POSTFLIGHT_' . $type . '_TEXT') . '</p>';
	}
}