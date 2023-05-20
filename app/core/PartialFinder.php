<?php

namespace sendReservation\core;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use Exception;

class PartialFinder {

	/**
	 * @var null|PartialFinder
	 */
	private static $instance = null;

	private const PARTIAL_FOLDER = 'partials';

	/**
	 * @return PartialFinder|null
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new PartialFinder();
		}

		return self::$instance;
	}

	public function get_partial_path( $partial ): string {
		$file_path = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'send-reservation' . DIRECTORY_SEPARATOR . self::PARTIAL_FOLDER . DIRECTORY_SEPARATOR . $partial . '.php';

		if ( ! file_exists( $file_path ) ) {
			throw new Exception( 'Partial file dosen\'t exist: ' . $file_path );
		}

		return $file_path;
	}

	public function get_partial( $partial, $data = null, $return = false ) {
		$file_path = $this->get_partial_path( $partial );

		if ( $return ) {
			return $this->get_internal( $file_path, $data );
		}

		$this->render_internal( $file_path, $data );
	}

	private function render_internal( string $_view_file_, array $_data_ = null ) {
		if ( $_data_ !== null ) {
			extract( $_data_, EXTR_OVERWRITE );
		}

		require $_view_file_;
	}

	private function get_internal( $_view_file_, array $_data_ = null ) {
		if ( $_data_ !== null ) {
			extract( $_data_, EXTR_OVERWRITE );
		}

		ob_start();
		ob_implicit_flush( 0 );
		require $_view_file_;

		return ob_get_clean();
	}
}

