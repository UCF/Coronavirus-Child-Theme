<?php
namespace Coronavirus\Theme;

define( 'CORONAVIRUS_THEME_DIR', trailingslashit( get_stylesheet_directory() ) );


// Theme foundation
include_once CORONAVIRUS_THEME_DIR . 'includes/config.php';
include_once CORONAVIRUS_THEME_DIR . 'includes/meta.php';
include_once CORONAVIRUS_THEME_DIR . 'includes/nav-functions.php';
include_once CORONAVIRUS_THEME_DIR . 'includes/header-functions.php';
include_once CORONAVIRUS_THEME_DIR . 'includes/breadcrumb-functions.php';
include_once CORONAVIRUS_THEME_DIR . 'includes/post-functions.php';
include_once CORONAVIRUS_THEME_DIR . 'includes/structured-data.php';

// Add other includes to this file as needed.
