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

?>
<div class="LoggerPlugin">
	<div class="Content">
		<fieldset>
			<legend>
				<h3><?php echo T('Logger for Vanilla - Basic version'); ?></h3>
				<p>
					<?php
					echo sprintf(T('Basic version is provided without a GUI. If you wish to modify the ' .
												 'configuration, you can edit file <i>config.xml</i>, located in <i>%s</i>.'),
											 PATH_PLUGINS . '/Logger/');
					?>
				</p>
			</legend>
		</fieldset>
		<?php
			 echo $this->Form->Close();
		?>
	</div>
</div>
