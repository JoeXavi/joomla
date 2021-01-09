<?php

 // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgButtonDatasheeto extends JPlugin {

    function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }
    function onDisplay($name)
    {
       
        $link = 'index.php?option=com_datasheet&amp;view=datasheets&amp;layout=modal2&amp;tmpl=component&amp;'
                . JSession::getFormToken() . '=1&amp;editor=' . $name;
                
        $doc = & JFactory::getDocument();
        $button = new JObject();
        $button->set('modal', true);
        //$button->set('onclick', 'buttonTestClick(\''.$name.'\');return false;');
        $button->set('text', JText::_('DO'));
        $button->set('name', 'backward-circle');
        $button->set('link', $link);
        $button->set('options', "{handler: 'iframe', size: {x: 800, y: 500}}") ;
        return $button;
    }
}
?>