<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


class DatasheetController extends JControllerLegacy
{
	/**
	 * The default view for the display method.
	 *
	 * @var string
	 * @since 12.2
*/

	protected $default_view = 'datasheets';

	public function display($cachable = false, $urlparams = false) {
        $app = JFactory::getApplication();
        $view = $app->input->getCmd('view', $this->default_view);
        $app->input->set('view', $view);
        parent::display($cachable, $urlparams);
        return $this;
    }

    public function execute($task)
    {
        // Not technically needed, but a DAMN good idea.  See http://docs.joomla.org/How_to_add_CSRF_anti-spoofing_to_forms
         //JSession::checkToken();
       // echo "Hello world";
        try
        {
            parent::execute($task);
        }
        catch(Exception $e)
        {
            echo new JResponseJson($e);
        }
    }
}
