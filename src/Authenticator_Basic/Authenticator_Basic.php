<?php
/**
 * Authenticator_Basic class
 *
 * @package APIAPIAuthenticatorBasic
 * @since 1.0.0
 */

namespace APIAPI\Authenticator_Basic;

use APIAPI\Core\Authenticators\Authenticator;
use APIAPI\Core\Exception;

if ( ! class_exists( 'APIAPI\Authenticator_Basic\Authenticator_Basic' ) ) {

	/**
	 * Authenticator implementation for Basic Authentication.
	 *
	 * @since 1.0.0
	 */
	class Authenticator_Basic extends Authenticator {
		/**
		 * Authenticates a request.
		 *
		 * This method does not yet actually authenticate the request with the server. It only sets
		 * the required values on the request object.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param APIAPI\Core\Request\Route_Request $request The request to send.
		 */
		public function authenticate_request( $request ) {
			$data = $this->parse_authentication_data( $request );

			if ( empty( $data['username'] ) || empty( $data['password'] ) ) {
				throw new Exception( sprintf( 'The request to %s could not be authenticated as username and password have not been passed.', $request->get_uri() ) );
			}

			$request->set_header( 'Authorization', 'Basic ' . base64_encode( $data['username'] . ':' . $data['password'] ) );
		}

		/**
		 * Checks whether a request is authenticated.
		 *
		 * This method does not check whether the request was actually authenticated with the server.
		 * It only checks whether authentication data has been properly set on it.
		 *
		 * @since 1.0.0
		 * @access public
		 *
		 * @param APIAPI\Core\Request\Route_Request $request The request to check.
		 * @return bool True if the request is authenticated, otherwise false.
		 */
		public function is_authenticated( $request ) {
			$data = $this->parse_authentication_data( $request );

			$header_value = $request->get_header( 'Authorization' );
			if ( null === $header_value ) {
				return false;
			}

			return 0 === strpos( $header_value, 'Basic ' );
		}

		/**
		 * Sets the default authentication arguments.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
		protected function set_default_args() {
			$this->default_args = array(
				'username'    => '',
				'password'    => '',
			);
		}
	}

}
