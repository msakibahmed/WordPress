<?php

// Just copy paste this code in your plugin and re-activat your plugin

//**** Use this site for Create table - Online SQL Generator https://wtools.io/generate-sql-create-table

register_activation_hook( __FILE__, 'my_plugin_create_db' );
function my_plugin_create_db() {

  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'my_analysis';

  $sql = "CREATE TABLE $table_name (
    id mediumint(9) NOT NULL AUTO_INCREMENT,
    time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
    views smallint(5) NOT NULL,
    clicks smallint(5) NOT NULL,
    UNIQUE KEY id (id)
  ) $charset_collate;";

  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  dbDelta( $sql );
}