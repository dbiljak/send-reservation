<?php
/**
 * Plugin Name: Send Reservation Mail by I am Root
 * Description: Send Reservation Thank you Mail
 * Version: 3.0.0
 * Author: Dražen Biljak
 * License: GPL2+
 */

use sendReservation\core\AdminDefaults;
use sendReservation\core\PartialFinder;

if ( ! defined( 'WPINC' ) ) {
    exit;
}

require_once 'vendor/autoload.php';

define( 'SEND_RESERVATION_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'SEND_RESERVATION_PLUGIN_FILE_PATH', SEND_RESERVATION_PLUGIN_PATH . basename( __FILE__ ) );

function init_send_reservation(): void {
    $admin_defaults = new AdminDefaults();
    $admin_defaults->init();
}

function get_partial( $partial, $data = null, $return = false ) {
    return PartialFinder::get_instance()->get_partial( $partial, $data, $return );
}

init_send_reservation();

require 'plugin-update-checker/plugin-update-checker.php';
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://example.com/path/to/details.json',
    __FILE__, //Full path to the main plugin file or functions.php.
    'unique-plugin-or-theme-slug'
);
