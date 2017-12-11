<?php

/**
 * Implements hook_panels_layouts().
 */
// Plugin definition
$plugin = array(
  'title' => t('Two Columns Stacked MinHeight'),
  'category' => t('Bootstrap'),
  'icon' => 'bootstrap_twocol_minheight_stacked.png',
  'theme' => 'bootstrap_twocol_minheight_stacked',
  'admin css' => '../panels-bootstrap-layouts-admin.css',
  'regions' => array(
    'top' => t('Top'),
    'left' => t('Left'),
    'right' => t('Right'),
    'bottom' => t('Bottom'),
  ),
);
