<?php
/**
 * Authenticator loader.
 *
 * @package APIAPI\Authenticator_Basic
 * @since 1.0.0
 */

if ( ! function_exists( 'apiapi_register_authenticator_basic' ) ) {

	/**
	 * Registers the authenticator for Basic Authentication.
	 *
	 * It is stored in a global if the API-API has not yet been loaded.
	 *
	 * @since 1.0.0
	 */
	function apiapi_register_authenticator_basic() {
		if ( function_exists( 'apiapi_manager' ) ) {
			apiapi_manager()->authenticators()->register( 'basic', 'APIAPI\Authenticator_Basic\Authenticator_Basic' );
		} else {
			if ( ! isset( $GLOBALS['_apiapi_authenticators_loader'] ) ) {
				$GLOBALS['_apiapi_authenticators_loader'] = array();
			}

			$GLOBALS['_apiapi_authenticators_loader']['basic'] = 'APIAPI\Authenticator_Basic\Authenticator_Basic';
		}
	}

	apiapi_register_authenticator_basic();

}
