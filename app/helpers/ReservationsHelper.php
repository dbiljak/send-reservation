<?php

namespace sendReservation\helpers;

use sendReservation\traits\SendEmailTrait;

class ReservationsHelper {
    use SendEmailTrait;

    public function get_reservations(): array {
        $raw_reservations = $this->query_reservations();
        $reservations     = $this->get_sorted_reservations( $raw_reservations );

        return $reservations;
    }

    public function get_header() {
        $reservations     = $this->get_reservations();
        $reservation_rows = $reservations[0];

        foreach ( $reservation_rows as $key => $row ) {
            $data[] = $this->get_table_headers( $key );
        }

        return $data ?? [];
    }

    public function send_email( $id ): bool
    {
        $reservation = $this->query_reservation_by_id( $id );
        $reservation = $reservation[0] ?? [];

        if ( ! empty( $reservation ) ) {
            $reservation = $this->get_sorted_reservation( $reservation );
            $partial     = get_partial( 'email/reservation-email', $reservation, true );

            $this->t_send_email( 'dbiljak@gmail.com', 'Restaurant Mediterraneo Thank You Mail', $partial );

            return true;
        }

        return false;
    }

    private function get_sorted_reservations( $reservations ) {
        foreach ( $reservations as $reservation ) {
            $response = $this->get_sorted_reservation( $reservation );

            if ( $response ) {
                $data[] = $response;
            }
        }

        return $data ?? [];
    }

    private function get_sorted_reservation( $reservation ) {
        $data          = unserialize( $reservation->form_value );
        $response_data = $this->prepare_data( $reservation->form_id, $reservation->form_post_id, $data );

        if ( ! empty( $response_data ) ) {
            return $response_data;
        }
    }

    private function prepare_data( $reservation_id, $form_id, $data ) {
        $forms_data = $this->get_forms_data();
        $key        = array_search( $form_id, array_column( $forms_data, 'id' ) );
        $response   = [];
        $fields     = $forms_data[$key];

        if ( $fields ) {
            $response['reservation_id']  = $reservation_id;
            $response['form_id']         = $form_id;
            // $response['language']        = $fields['language'];

            foreach ($fields as $key => $field) {
                if ( isset( $data[$field] ) ) {
                    $string         = gettype( $data[$field] ) === 'array' ? $data[$field][0] : $data[$field];
                    $response[$key] = $key === 'message' ? substr( $string, 0, 60 ) . '...' : $string;
                }
            }

            $data_ok = $this->check_date( $response );

            if ( $data_ok ) {
                return $response;
            }
        }
    }

    private function check_date( $reservation ) {
        $date      = strtotime( $reservation['date'] );
        $today     = time();
        $two_weeks = strtotime("-2 weeks");

        return $date > $two_weeks && $date < $today ? true : false;
    }

    private function get_table_headers( $key ) {
        $data = [
            'date'           => 'Reservation date',
            'time'           => 'Time',
            'guests'         => 'Guests',
            'name'           => 'Name',
            'email'          => 'Email',
            'phone'          => 'Phone',
            'message'        => 'Message',
            'language'       => 'Language',
            'form_id'        => 'Form ID',
            'reservation_id' => 'ID'
        ];

        return $data[$key];
    }

    private function get_forms_data() {
        return [
            [
                'id'       => '1560',
                'date'     => 'inside-date',
                'name'     => 'inside-name',
                'email'    => 'inside-email',
            ],
            [
                'id'       => '1550',
                'date'     => 'outside-date',
                'name'     => 'outside-name',
                'email'    => 'outside-email',
            ],
            [
                'id'       => '1619',
                'date'     => 'inside-date',
                'name'     => 'inside-name',
                'email'    => 'inside-email',
            ],
            [
                'id'       => '1620',
                'date'     => 'outside-date',
                'name'     => 'outside-name',
                'email'    => 'outside-email',
            ]

            // COMPLETE DATA
            // [
            //     'id'       => '1619',
            //     'language' => 'Hrvatski',
            //     'date'     => 'inside-date',
            //     'time'     => 'inside-time',
            //     'guests'   => 'inside-guests',
            //     'name'     => 'inside-name',
            //     'email'    => 'inside-email',
            //     'phone'    => 'inside-phone',
            // ],
            // [
            //     'id'       => '1620',
            //     'language' => 'Hrvatski',
            //     'date'     => 'outside-date',
            //     'time'     => 'outside-time',
            //     'guests'   => 'outside-guests',
            //     'name'     => 'outside-name',
            //     'email'    => 'outside-email',
            //     'phone'    => 'outside-phone',
            // ]
        ];
    }

    private function get_where_condition() {
        $forms  = $this->get_forms_data();
        $column = 'form_post_id';
        $html   = '';

        foreach ( $forms as $key => $form ) {
            $prefix = $key === 0 ? 'WHERE' : ' OR';
            $html   .= sprintf( '%s %s = "%s"', $prefix, $column, $form['id'] );
        }

        return $html;
    }

    private function query_reservations() {
        global $wpdb;
        $cfdb       = apply_filters( 'cfdb7_database', $wpdb );
        $table_name = $cfdb->prefix . 'db7_forms';
        $where      = $this->get_where_condition();

        $results       = $cfdb->get_results( "
            SELECT * FROM $table_name
            echo $where
        ", OBJECT );

        return $results;
    }

    private function query_reservation_by_id( $id ) {
        global $wpdb;
        $cfdb       = apply_filters( 'cfdb7_database', $wpdb );
        $table_name = $cfdb->prefix . 'db7_forms';
        $result     = $cfdb->get_results( "SELECT * FROM $table_name WHERE form_id = " . $id, OBJECT );

        return $result;
    }
}