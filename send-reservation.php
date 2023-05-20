<?php
/**
 * Plugin Name: Send Reservation Mail by I am Root
 * Description: Send Reservation Thank you Mail #2
 * Version: 3.0.1
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
    'https://github.com/dbiljak/send-reservation',
    __FILE__,
    'send-reservation'
);
$myUpdateChecker->setAuthentication( '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' );
$myUpdateChecker->setBranch( 'master' );
