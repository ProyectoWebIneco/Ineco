<?php global $user;?>
<?php if($user->uid == 0):?>
	<?php drupal_goto($node->field_external_link_link['und'][0]['url'])?>
<?php else:?>
	<?php echo t('This link will send the user to @link', array('@link' => $node->field_external_link_link['und'][0]['url']));?>
<?php endif;?>
