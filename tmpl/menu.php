<?php
/**
 * @package    Jmb_Tree
 * @author     Sherza & b2z <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

$selVal = ($params->get('type', 'category') == 'category') ? 'id' : 'Itemid';

$menuOpts = array();
$link_id_href = array();

echo '<ul class="menu menu_norr_list">';

foreach ($list as $k => $link)
{
	// Note. It is important to remove spaces between elements.
	$class = $link->anchor_css ? 'class="' . $link->anchor_css . '" ' : '';
	$title = $link->anchor_title ? 'title="' . $link->anchor_title . '" ' : '';

	if ($link->menu_image && $params->get('menu_img', 1))
	{
		$link->params->get('menu_text', 1) ?
		$linktype = '<img src="' . $link->menu_image . '" alt="' . $link->text . '" /><span class="image-title">' . $link->text . '</span> ' :
		$linktype = '<img src="' . $link->menu_image . '" alt="' . $link->text . '" />';
	}
	else
	{
		$linktype = $link->text;
	}

	if (isset($list[$k - 1]->level) && ($link->level > $list[$k - 1]->level))
	{
		echo '<ul>';
	}

	$active = (JFactory::getApplication()->input->getInt($selVal) == $link->id) ? ' active ' : '';
	echo '<li class="norr_level_' . $link->level . ' ' . $active . '">';

	switch ($link->browserNav)
	{
		default:
		case 0:
			?>
			<a <?php echo $class; ?>href="<?php echo $link->href; ?>" <?php echo $title; ?><?php echo $link->nofollowInternal; ?>><?php echo $link->levelSeparator . $linktype; ?></a>
			<?php
			break;

		case 1:
			?>
			<a <?php echo $class; ?>href="<?php echo $link->href; ?>" <?php echo $title; ?>target="_blank" <?php echo $link->nofollowExternal; ?>><?php echo $link->levelSeparator . $linktype; ?></a>
			<?php
			break;
	}

	if (isset($list[$k + 1]->level) && ($link->level >= $list[$k + 1]->level))
	{
		echo str_repeat('</li></ul>', ($link->level - $list[$k + 1]->level)) . '</li>';
	}
}

echo str_repeat('</li></ul>', ($link->level));

if ($params->get('show_backlink', 1)) : ?>
		<div style="text-align: left; font-family: Arial, Helvetica, sans-serif; font-size: 7pt; text-decoration: none">
			<?php echo JText::_('MOD_JMB_TREE_BACKLINK'); ?>
		</div>
<?php endif; ?>
