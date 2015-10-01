<?php if (!defined('APPLICATION')) exit();
/**
Copyright (c) 2013 Diego Zanella (http://dev.pathtoenlightenment.net)

@package Advanced Logger for Vanilla Forums
@author Diego Zanella <diego@pathtoenlightenment.net>
@copyright Copyright (c) 2013 Diego Zanella (http://dev.pathtoenlightenment.net)
@license http://dev.pathtoenlightenment.net/commercial-licence/ Commercial Licence

Acknowledgements
This Plugin is based on {@link http://logging.apache.org/log4php/index.html Log4php). Log4php is an Apache Project licensed under {@link http://logging.apache.org/log4php/license.html Apache 2.0 Licence}.
*/

/**
 * Validation functions for Logger Appender Configuration.
 *
 */

if(!function_exists('ValidateAppenderClass')){
	/**
	 * Checks if an Appender Class is amongst the available ones.
	 */
	function ValidateAppenderClass($Value, $Field, $FormPostedValues){
		return LoggerPlugin::AppendersManager()->AppenderExists($Value);
	}
}

if (!function_exists('ValidatePositiveInteger')) {
	/**
	 * Check that a value is a positive Integer.
	 */
	function ValidatePositiveInteger($Value, $Field) {
		return ValidateInteger($Value, $Field) &&
					 ($Value > 0);
	}
}

if (!function_exists('ValidateTCPPort')) {
	/**
	 * Check that a value is a valid number for a TCP Port. Valid numbers range
	 * from 1 to 65535.
	 */
	function ValidateTCPPort($Value, $Field) {
		return ValidatePositiveInteger($Value, $Field) &&
					 ($Value <= 65535);
	}
}
