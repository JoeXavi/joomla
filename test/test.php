
<?php

 // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

class plgButtonDatasheet extends JPlugin {

    function plgButtonDatasheet(& $subject, $config)
    {
        parent::__construct($subject, $config);
    }
    function onDisplay($name)
    {
        $js =  "                      
         function buttonTestClick(editor) {
                             txt = prompt('Please enter datasheet name','Va a ser un select');
                             if(!txt) return;
                               jInsertEditorText('{loadmodule datasheet,'+txt+'}', editor);
        }";
        $css = ".button2-left .testButton {
                    background: transparent url(/plugins/editors-xtd/test.png) no-repeat 100% 0px;
                }";
        $doc = & JFactory::getDocument();
        $doc->addScriptDeclaration($js);
        $doc->addStyleDeclaration($css);
        $button = new JObject();
        $button->set('modal', false);
        $button->set('onclick', 'buttonTestClick(\''.$name.'\');return false;');
        $button->set('text', JText::_('DA'));
        $button->set('name', 'testButton');
        $button->set('link', '#');
        return $button;
    }
}
?>