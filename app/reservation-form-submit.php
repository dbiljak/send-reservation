<?php
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

use sendReservation\helpers\ReservationsHelper;

$reservations_helper = new ReservationsHelper;
$send_email          = $reservations_helper->send_email( $_POST['reservation_id'] );
