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
 * Extends base Gdn_Model by adding a Logger to it. This way, plugins that want
 * to use logging capabilities won't have to instantiate the Logger every time.
 */
class ModelEx extends Gdn_Model {
	// Logger that will be used by derived Models
	protected $Log;

	public function _construct() {
		parent::__construct();

		$this->Log = LoggerPlugin::GetLogger();
	}
}
