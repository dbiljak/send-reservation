<?php

namespace sendReservation\core;

class AdminDefaults {
    public function init(): void {
        add_action( 'admin_menu', [ $this, 'add_custom_option_pages' ] );
        add_action( 'admin_init', [ $this, 'create_plugin_table' ] );
        add_action( 'admin_init', [ $this, 'create_mail_sender_role' ] );
    }

    public function create_mail_sender_role(): void {
        add_role(
            'mail_sender',
            'Mail Sender Role', [
            'read'        => true,
            'level_0'     => true,
            'mail_sender' => true,
        ] );
    }

    public function create_plugin_table(): void {
        global $wpdb;

        $table_name      = $wpdb->prefix . 'send_reservation';
        $users_table     = $wpdb->prefix . 'users';
        $form_table      = $wpdb->prefix . 'db7_forms';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id INT(11) NOT NULL AUTO_INCREMENT,
            form_id BIGINT(20),
            user_id BIGINT(20) UNSIGNED,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            FOREIGN KEY (form_id) REFERENCES $form_table(form_id),
            FOREIGN KEY (user_id) REFERENCES $users_table(ID)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }

    public function add_custom_option_pages(): void {
        add_menu_page(
            'Reservations',
            'Reservations',
            'mail_sender',
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
