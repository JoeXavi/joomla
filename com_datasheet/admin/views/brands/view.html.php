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

/**
 * HelloWorlds View
 *
 * @since  0.0.1
 */
class DatasheetViewBrands extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		// Set the submenu
		DatasheetHelper::addSubmenu('brands');

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);
    }
    
    protected function addToolBar()
	{
		JToolbarHelper::title(JText::_('COM_DATASHEET_MANAGER_DATASHEETS'));
		JToolbarHelper::addNew('brand.add');
		JToolbarHelper::editList('brand.edit');
		JToolbarHelper::deleteList('', 'brand.delete');
	}
}
