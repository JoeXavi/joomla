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
?>
<form action="index.php?option=com_datasheet&view=datasheets" method="post" id="adminForm" name="adminForm">
	<div id="j-sidebar-container" class="span2">
		<?php echo JHtmlSidebar::render(); ?>
	</div>
	<div id="j-main-container" class="span10">
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_DATASHEET_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
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
							<?php echo $this->pagination->getRowOffset($i); ?>
						</td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
						<img src=<?php echo dirname(juri::base())."/".$row->img_default ?> class="img-thumbnail" alt="Miniatura">
						</td>
						<td>
                        <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_DATASHEET_ITEM_LINK_DESC'); ?>">
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
    <input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<?php echo JHtml::_('form.token'); ?>
	</div>
</form>