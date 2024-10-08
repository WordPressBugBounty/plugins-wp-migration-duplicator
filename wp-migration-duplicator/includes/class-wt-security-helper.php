<?php

/**
 * Webtoffee Security Library
 *
 * Includes Data sanitization, Access checking
 * @author     WebToffee <info@webtoffee.com>
 */

if (!class_exists('Wp_Migration_Duplicator_Security_Helper')) {

	class Wp_Migration_Duplicator_Security_Helper
	{

		/**	
		 * 	Data sanitization function.
		 *	
		 *	@param mixed $val value to sanitize
		 *	@param string $key array key in the validation rule
		 *	@param array $validation_rule array of validation rules. Eg: array('field_key' => array('type' => 'textarea'))
		 *	@return mixed sanitized value
		 */
		public static function sanitize_data($val, $key, $validation_rule = array())
		{
			if (isset($validation_rule[$key]) && is_array($validation_rule[$key])) /* rule declared/exists */ {
				if (isset($validation_rule[$key]['type'])) {
					$val = self::sanitize_item($val, $validation_rule[$key]['type']);
				}
			} else //if no rule is specified then it will be treated as text
			{
				$val = self::sanitize_item($val, 'text');
			}
			return $val;
		}


		/**
		 * 	Sanitize individual data item
		 *
		 *	@param mixed $val value to sanitize
		 *	@param string $type value type
		 *	@return mixed sanitized value
		 */
		public static function sanitize_item($val, $type = '')
		{
			switch ($type) {
				case 'text':
					$val = sanitize_text_field($val);
					break;
				case 'text_arr':
					$val = self::sanitize_arr($val);
					break;
				case 'url':
					$val = esc_url_raw($val);
					break;
				case 'url_arr':
					$val = self::sanitize_arr($val, 'url');
					break;
				case 'textarea':
					$val = sanitize_textarea_field($val);
					break;
				case 'int':
					$val = intval($val);
					break;
				case 'int_arr':
					$val = self::sanitize_arr($val, 'int');
					break;
				case 'float':
					$val = floatval($val);
					break;
				case 'post_content':
					$val = wp_kses_post($val);
					break;
				case 'hex':
					$val = sanitize_hex_color($val);
					break;
				default:
					$val = sanitize_text_field($val);
			}

			return $val;
		}

		/**
		 * 	Recursive array sanitization function
		 *
		 *	@param mixed $arr value to sanitize
		 *	@param string $type value type
		 *	@return mixed sanitized value
		 */
		public static function sanitize_arr($arr, $type = 'text')
		{
			if (is_array($arr)) {
				$out = array();
				foreach ($arr as $k => $arrv) {
					if (is_array($arrv)) {
						$out[$k] = self::sanitize_arr($arrv, $type);
					} else {
						$out[$k] = self::sanitize_item($arrv, $type);
					}
				}
				return $out;
			} else {
				return self::sanitize_item($arr, $type);
			}
		}

		/**
		 * 	User accessibility. Function checks user logged in status, nonce and role access.
		 *
		 *	@param string $plugin_id unique plugin id. Note: This id is used as an identifier in filter name so please use characters allowed in filters 
		 *	@param string $nonce_id Nonce id. If not specified then uses plugin id
		 *	@return boolean if user allowed or not
		 */
		public static function check_write_access($plugin_id, $nonce_id = '')
		{
			$er = true;

			if (!is_user_logged_in()) //checks user is logged in
			{
				$er = false;
			}

			if ($er === true) //no error then proceed
			{
				if (!(self::verify_nonce($plugin_id, $nonce_id))) //verifying nonce
				{
					$er = false;
				} else {
					if (!self::check_role_access($plugin_id)) //Check user role
					{
						$er = false;
					}
				}
			}
			return $er;
		}

		/**
		 * 	Verifying nonce
		 *
		 *	@param string $plugin_id unique plugin id. Note: This id is used as an identifier in filter name so please use characters allowed in filters 
		 *	@param string $nonce_id Nonce id. If not specified then uses plugin id
		 *	@return boolean if user allowed or not
		 */
		public static function verify_nonce($plugin_id, $nonce_id = '')
		{
			$nonce = (isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : '');
			$nonce = (is_array($nonce) ? $nonce[0] : $nonce); //in some cases multiple nonces are declared
			$nonce_id = ($nonce_id == "" ? $plugin_id : $nonce_id); //if nonce id not provided then uses plugin id as nonce id

			if (!(wp_verify_nonce($nonce, $nonce_id))) //verifying nonce
			{
				return false;
			} else {
				return true;
			}
		}


		/**
		 * 	Checks if user role has access
		 *
		 *	@param string $plugin_id unique plugin id. Note: This id is used as an identifier in filter name so please use characters allowed in filters 
		 *	@return boolean if user allowed or not
		 */
		public static function check_role_access($plugin_id)
		{
			$roles = array('manage_options');
			$roles = apply_filters('wt_' . $plugin_id . '_alter_role_access', $roles); //dynamic filter based on plugin id to alter roles 
			$roles = (!is_array($roles) ? array() : $roles);
			$is_allowed = false;

			foreach ($roles as $role) //loop through roles
			{
				if (current_user_can($role)) {
					$is_allowed = true;
					break;
				}
			}
			return $is_allowed;
		}

		public static function wt_mgdp_allowed_screens()
		{
			$screens = array('wp-migration-duplicator', 'wp-migration-duplicator-settings', 'wp-migration-duplicator-log');
			return apply_filters('wt_mgdp_allowed_screens_basic', $screens);
		}

		public static function wt_mgdp_is_screen_allowed()
		{
			if (in_array(self::wt_mgdp_get_current_page(), self::wt_mgdp_allowed_screens())) {
				return true;
			} else {
				return false;
			}
		}
		public static function wt_mgdp_get_current_page()
		{
			if (isset($_GET['page'])) {
				return $_GET['page'];
			}
			return '';
		}

		public static function generateRandomString()
		{
			// Generate a 6-digit prefix
			$prefix = strval(mt_rand(100000, 999999));

			// Generate a 2-digit random number
			$digits = strval(mt_rand(0, 9)) . strval(mt_rand(0, 9));

			// Generate a random lowercase character
			$char = chr(mt_rand(97, 122));

			// Concatenate the prefix, 2-digit number, and character
			return $prefix . $digits . $char;
		}
	}
}
