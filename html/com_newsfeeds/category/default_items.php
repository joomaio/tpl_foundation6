<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_newsfeeds
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$n         = count($this->items);
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));

?>
<?php if (empty($this->items)) : ?>
	<p><?php echo JText::_('COM_NEWSFEEDS_NO_ARTICLES'); ?></p>
<?php else : ?>
	<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString(), ENT_COMPAT, 'UTF-8'); ?>" method="post" name="adminForm" id="adminForm">
		<?php if ($this->params->get('filter_field') !== 'hide' || $this->params->get('show_pagination_limit')) : ?>
			<div class="row">
				<?php if ($this->params->get('filter_field') !== 'hide' && $this->params->get('filter_field') == '1') : ?>
					<div class="columns large-6 medium-6">
						<label class="label" for="filter-search">
							<?php echo JText::_('COM_NEWSFEEDS_FILTER_LABEL') . '&#160;'; ?>
						</label>
						<input type="text" name="filter-search" id="filter-search" value="<?php echo $this->escape($this->state->get('list.filter')); ?>" class="inputbox" onchange="document.adminForm.submit();" title="<?php echo JText::_('COM_NEWSFEEDS_FILTER_SEARCH_DESC'); ?>" placeholder="<?php echo JText::_('COM_NEWSFEEDS_FILTER_SEARCH_DESC'); ?>" />
					</div>
				<?php endif; ?>
				<?php if ($this->params->get('show_pagination_limit')) : ?>
					<div class="columns large-3 large-offset-2 medium-6">
						<label for="limit" class="label">
							<?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
						</label>
						<?php echo $this->pagination->getLimitBox(); ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
		<div class="category">
			<?php foreach ($this->items as $i => $item) : ?>
				<?php if ($this->items[$i]->published == 0) : ?>
					<div class="system-unpublished stripes stripes<?php echo $i % 2; ?>">
				<?php else : ?>
					<div class="stripes stripes<?php echo $i % 2; ?>">
				<?php endif; ?>
				<?php if ($this->params->get('show_articles')) : ?>
					<span class="list-hits badge badge-info pull-right">
						<?php echo JText::sprintf('COM_NEWSFEEDS_NUM_ARTICLES_COUNT', $item->numarticles); ?>
					</span>
				<?php endif; ?>
				<span class="list pull-left">
					<div class="list-title">
						<a href="<?php echo JRoute::_(NewsFeedsHelperRoute::getNewsfeedRoute($item->slug, $item->catid)); ?>">
							<?php echo $item->name; ?>
						</a>
					</div>
				</span>
				<?php if ($this->items[$i]->published == 0) : ?>
					<span class="label label-warning">
						<?php echo JText::_('JUNPUBLISHED'); ?>
					</span>
				<?php endif; ?>
				<?php if ($this->params->get('show_link')) : ?>
					<?php $link = JStringPunycode::urlToUTF8($item->link); ?>
					<span class="list pull-left">
						<a href="<?php echo $item->link; ?>">
							<?php echo $link; ?>
						</a>
					</span>
				<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<?php // Add pagination links ?>
		<?php if (!empty($this->items)) : ?>
			<?php if (($this->params->def('show_pagination', 2) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->pagesTotal > 1)) : ?>
				<div class="pagination">
					<?php if ($this->params->def('show_pagination_results', 1)) : ?>
						<p class="counter pull-right">
							<?php echo $this->pagination->getPagesCounter(); ?>
						</p>
					<?php endif; ?>
					<?php echo $this->pagination->getPagesLinks(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	</form>
<?php endif; ?>