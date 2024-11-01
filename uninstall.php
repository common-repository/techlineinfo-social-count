<?php
/**
 * Uninstall Techlineinfo Social Count
 *
 * @package     TECHLINEINFO-SOCIAL-COUNT
 * @subpackage  Uninstall
 * @copyright   Copyright (c) 2014, René Hermenau
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0.2
 */

// Exit if accessed directly
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) exit;
global $wpdb;
	/** Delete all the Plugin Options */
	delete_option( 'msssh_options' );       
  
