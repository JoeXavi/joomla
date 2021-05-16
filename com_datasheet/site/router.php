<?php

defined('_JEXEC') or die;

class DatasheetRouter extends JComponentRouterBase
{
    
    public function build(&$query)
    {
        // ob_flush();
        // ob_start();
        // var_dump($query);
        // file_put_contents("dump.txt", ob_get_flush());
        
        $segments = array();
        if (isset($query['view']))
        {
            $segments[] = $query['view'];
            unset($query['view']);
        }
        if (isset($query['id']))
        {
            $segments[] = $query['id'];
            unset($query['id']);
        };
        return $segments;
    }

    public function parse(&$segments)
    {
        // ob_flush();
        // ob_start();
        // var_dump($segments);
        // file_put_contents("dump.txt", ob_get_flush());

        $vars = array();
        $vars['view'] = $segments[0];
        if(isset($segments[1])){
            $parts = explode("-",$segments[1]);
            $vars['id'] = $parts[0];}
        return $vars;
    }

}
