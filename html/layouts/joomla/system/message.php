<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.protostar
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

$alert = array('error' => 'alert', 'warning' => 'warning', 'notice' => 'primary', 'message' => 'success');
?>
<div id="system-message-container" class="row">
	<?php if (is_array($msgList) && !empty($msgList)) : ?>
		<div id="system-message">
			<?php foreach ($msgList as $type => $msgs) : ?>
				<div class="callout <?php echo isset($alert[$type]) ? $alert[$type] : $type; ?>" data-closable>
					<?php // This requires JS so we should add it through JS. Progressive enhancement and stuff. ?>
					<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
						&times;
					</button>

					<?php if (!empty($msgs)) : ?>
						<h4 class="alert-heading"><?php echo JText::_($type); ?></h4>
						<div>
							<?php foreach ($msgs as $msg) : ?>
								<div class="alert-message"><?php echo $msg; ?></div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>
