<?php if (!defined('APPLICATION')) exit();
/*
This plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
This plugin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
You should have received a copy of the GNU General Public License along with Garden.  If not, see <http://www.gnu.org/licenses/>.
*/

// Define the plugin:
$PluginInfo['CssLess'] = array(
   'Name' => 'CSS Less',
   'Description' => "CSS Less adds in the required files to run the CSS Less client side compiler.",
   'Version' => '1.0.0',
   'Author' => "BitGorilla",
   'AuthorEmail' => 'info@bitgorilla.com',
   'AuthorUrl' => 'http://bitgorilla.com/',
   'MobileFriendly' => TRUE
);

class CssLessPlugin extends Gdn_Plugin {
	   
	public function Base_Render_Before($Sender) {
	    $Sender->AddJsFile('plugins/CssLess/less-1.1.3.min.js');
	}
}


