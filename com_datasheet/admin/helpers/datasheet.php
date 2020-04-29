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
 * HelloWorld component helper.
 *
 * @param   string  $submenu  The name of the active view.
 *
 * @return  void
 *
 * @since   1.6
 */
abstract class DatasheetHelper extends JHelperContent
{
	/**
	 * Configure the Linkbar.
	 *
	 * @return Bool
	 */

	public static function addSubmenu($submenu) 
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_DATASHEET_SUBMENU_PRODUCTS'),
			'index.php?option=com_datasheet',
			$submenu == 'datasheets'
		);
		
		JHtmlSidebar::addEntry(
			JText::_('COM_DATASHEET_SUBMENU_TYPES'),
			'index.php?option=com_datasheet&view=types',
			$submenu == 'types'
		);

		JHtmlSidebar::addEntry(
			JText::_('COM_DATASHEET_SUBMENU_DATAS'),
			'index.php?option=com_datasheet&view=datas',
			$submenu == 'datas'
		);

		// Set some global property
		$document = JFactory::getDocument();
		$document->addStyleDeclaration('.icon-48-helloworld ' .
										'{background-image: url(../media/com_datasheet/images/tux-48x48.png);}');
		if ($submenu == 'types') 
		{
			$document->setTitle(JText::_('COM_DATASHEET_SUBMENU_TYPES'));
		}

		if ($submenu == 'datas') 
		{
			$document->setTitle(JText::_('COM_DATASHEET_SUBMENU_DATAS'));
		}
	}
}