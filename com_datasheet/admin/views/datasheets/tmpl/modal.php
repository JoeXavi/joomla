<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

JHtml::_('bootstrap.tooltip', '.hasTooltip', array('placement' => 'bottom'));

// @deprecated 4.0 the function parameter, the inline js and the buttons are not needed since 3.7.0.

// Function to update input title when changed

JFactory::getDocument()->addScriptDeclaration("
function datasheet(id) {
      
    if (window.parent) {
        return window.parent.jInsertEditorText('{datasheetm mod_datasheetbase '+id+'}{datasheetm mod_datasheetrels '+id+'}{datasheetm mod_datasheetbrand '+id+'}', 'jform_articletext');
    }
}");
?>

<form action="index.php?option=com_datasheet&view=datasheets" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
		
			<th width="10%">
				<?php echo JText::_('COM_DATASHEET_ITEM_IMAGE') ;?>
			</th>
			<th width="80%">
				<?php echo JText::_('COM_DATASHEET_ITEM_NAME') ;?>
			</th>
			
			<th width="2%">
				<?php echo JText::_('COM_DATASHEET_ID'); ?>
			</th>
		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : 
                    $link = JRoute::_('index.php?option=com_datasheet&task=datasheet.edit&id=' . $row->id);
                    ?>

					<tr>
			
						
						<td>
						<img src=<?php echo dirname(juri::base())."/".$row->img_default ?> class="img-thumbnail" alt="Miniatura">
						</td>
						<td>
                        <a href="#" title="<?php echo JText::_('COM_DATASHEET_ITEM_LINK_DESC'); ?>" onclick="datasheet(<?php echo $row->id; ?>)">
							<?php echo $row->name; ?>
						</td>
						
						<td align="center">
							<?php echo $row->id; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
    </table>
	<?php echo JHtml::_('form.token'); ?>
	</div>
</form>