<?php

// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$datasheet = modDatasheetbrandHelper::getBase($params);
require JModuleHelper::getLayoutPath('mod_datasheetbrand');