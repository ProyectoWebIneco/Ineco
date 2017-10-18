<?php

// Plugin definition
$plugin = array(
  'title' => t('Dos columnas'),
  'category' => t('Ineco'),
  'icon' => 'two_col_ineco.png',
  'theme' => 'panels-two_col_ineco',
  'css' => 'two_col_ineco.css',
  'regions' => array(
    'left' => t('Left side'),
    'content' => t('Content'),
  ),
);
