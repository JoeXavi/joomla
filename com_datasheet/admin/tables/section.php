<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die('Restricted access');

/**
 * Hello Table class
 *
 * @since  0.0.1
 */
class DatasheetTableSection extends JTable
{
	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver  &$db  A database connector object
	 */
	function __construct(&$db)
	{
		parent::__construct('#__datasheet_product_section', 'id', $db);
	}

	public function bind($array, $ignore = ''){
        if (isset($array['datas']) && is_array($array['datas']))
		{
			$parameter = new JRegistry;
			$parameter->loadArray($array['datas']);
			$array['datas'] = (string)$parameter;
		}
		return parent::bind($array, $ignore);
    }
	
}