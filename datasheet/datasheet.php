<?php

 // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgButtonDatasheet extends JPlugin {

    function onDisplay($name)
    {
        $js = "                
            function buttonTestClick(editor) {
                console.log('editor',editor);
                txt = prompt('Please enter datasheet name','Va a ser un select');
                if(!txt) return;
                jInsertEditorText('{loadmodule datasheetbase,'+txt+'}', editor);
            }";
        $link = 'index.php?option=com_datasheet&amp;view=datasheets&amp;layout=modal&amp;tmpl=component&amp;'
                . JSession::getFormToken() . '=1&amp;editor=' . $name;
                
        $doc = & JFactory::getDocument();
        $doc->addScriptDeclaration($js);
        $doc->addStyleDeclaration($css);
        $button = new JObject();
        $button->set('modal', true);
        //$button->set('onclick', 'buttonTestClick(\''.$name.'\');return false;');
        $button->set('text', JText::_('DA'));
        $button->set('name', 'backward-circle');
        $button->set('link', $link);
        $button->set('options', "{handler: 'iframe', size: {x: 800, y: 500}}") ;
        return $button;
    }
}
?>