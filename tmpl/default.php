<?php
/**
 * @package    Jmb_Tree
 * @author     Sherza & b2z <support@norrnext.com>
 * @copyright  Copyright (C) 2012 - 2014 NorrNext. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

$menuOpts   = array();
$linkIdHref = array();
$type       = $params->get('type', 'menu');
$selVal     = ($type == 'menu') ? 'Itemid' : 'id';

echo '<ul class="menu menu_norr_list">';

foreach ($list as $k => $link)
{
	if ($type == 'menu')
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
	}

	if (isset($list[$k - 1]->level) && ($link->level > $list[$k - 1]->level))
	{
		echo '<ul>';
	}

	$active = (JFactory::getApplication()->input->getInt($selVal) == $link->id) ? ' active ' : '';
	echo '<li class="norr_level_' . $link->level . ' ' . $active . '">';

	if ($type == 'menu')
	{
		switch ($link->browserNav)
		{
			default:
			case 0:
				?>
				<?php echo $link->levelSeparator; ?><a <?php echo $class; ?>href="<?php echo $link->href; ?>" <?php echo $title; ?><?php echo $link->nofollow; ?>><?php echo $linktype; ?></a>
				<?php
				break;

			case 1:
			case 2:
				?>
				<?php echo $link->levelSeparator; ?><a <?php echo $class; ?>href="<?php echo $link->href; ?>" <?php echo $title; ?>target="_blank" <?php echo $link->nofollow; ?>><?php echo $linktype; ?></a>
				<?php
				break;
		}
	}
	else
	{
		echo $link->levelSeparator . '<a href="' . $link->href . '">' . $link->text . '</a>';
	}

	if (isset($list[$k + 1]->level) && ($link->level >= $list[$k + 1]->level))
	{
		echo str_repeat('</li></ul>', ($link->level - $list[$k + 1]->level)) . '</li>';
	}

	if (!isset($list[$k + 1]->level))
	{
		echo str_repeat('</li></ul>', $link->level);
	}
}

if ($params->get('show_backlink', 1)) : ?>
	<div style="text-align: left; clear: both; font-family: Arial, Helvetica, sans-serif; font-size: 7pt; text-decoration: none">
		<?php echo JText::_('MOD_JMB_TREE_BACKLINK'); ?>
	</div>
<?php endif; ?>
