<?php

namespace sendReservation\core;

class AdminDefaults {
    public function init(): void {
        add_action( 'admin_menu', [ $this, 'add_custom_option_pages' ] );
    }

    public function add_custom_option_pages(): void {
        add_menu_page(
            'Reservations',
            'Reservations',
            'administrator',
            'reservations.php',
            [ $this, 'render_reservations' ],
            'dashicons-clipboard'
        );
    }

    public function render_reservations(): void {
        if ( isset( $_GET['page'] ) && $_GET['page'] === 'reservations.php' ) {
            get_partial( 'dashboard/reservations' );
        }
    }
}
