<?php

namespace sendReservation\traits;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

trait SendEmailTrait {
	public function t_send_email( $email, $subject, $html ): void
    {
		$content_type = function () {
			return 'text/html';
		};

		add_filter( 'wp_mail_content_type', $content_type );

		wp_mail( $email, $subject, $html, $this->get_headers() );

		remove_filter( 'wp_mail_content_type', $content_type );
	}

	private function get_headers(): array
    {
		$headers[] = 'Bcc: dbiljak@gmail.com';

        return $headers;
	}
}