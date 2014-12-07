<?php
/**
 * @package    Jmb_Tree
 * @author     Sherza & Dmitry Rekun <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

// Require helper.
require_once __DIR__ . '/helper.php';

$list = ModJmbTreeHelper::getList($params);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$moduleStyle = 'default';
$layout = $params->get('layout', 'default');

require JModuleHelper::getLayoutPath('mod_jmb_tree', $params->get('layout', 'default'));