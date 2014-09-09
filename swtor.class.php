<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2014 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev$
 *
 * $Id$
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

if(!class_exists('swtor')) {
	class swtor extends game_generic {
		protected static $apiLevel	= 20;
		public $version				= '1.2';
		protected $this_game		= 'swtor';
		protected $types			= array('classes', 'races', 'factions', 'roles');
		protected $classes			= array();
		protected $races			= array();
		protected $roles			= array();
		protected $factions			= array();
		protected $filters			= array();
		public $langs				= array('english', 'german');

		protected $glang			= array();
		protected $lang_file		= array();
		protected $path				= false;
		public $lang				= false;

		protected $class_dependencies = array(
			array(
				'name'		=> 'faction',
				'type'		=> 'factions',
				'admin' 	=> false,
				'decorate'	=> false,
				'parent'	=> false,
			),
			array(
				'name'		=> 'race',
				'type'		=> 'races',
				'admin'		=> false,
				'decorate'	=> true,
				'parent'	=> array(
					'faction' => array(
						'republic'	=> array(0,1,2,3,4,5,6,7,8),
						'imperial'	=> array(0,9,10,11,12,13,14,15,16),
					),
				),
			),
			array(
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'colorize'	=> true,
				'roster'	=> true,
				'recruitment' => true,
				'parent'	=> array(
					'race' => array(
						0 	=> 'all',											// Unknown
						1 	=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16),	// Human
						2 	=> array(9,10,11,12,13,14),							// Rattataki
						3 	=> array(3,4,5,6,7,8,13,14),						// Twi'lek
						4 	=> array(9,10,11,12),								// Chiss
						5 	=> array(15,16,13,14),								// Sith Pureblood
						6 	=> array(5,6,7,8),									// Miraluka
						7 	=> array(1,2,3,4,5,6,7,8),							// Mirialan
						8 	=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16),	// Zabrak
						9 	=> array(1,2,3,4,9,10,11,12,15,16),					// Cyborg
						10 	=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16),	// Cathar
					),
				),
			),
		);

		protected $default_roles = array(
			1 => array(2, 3, 5),
			2 => array(1, 6, 8),
			3 => array(2, 4, 5),
			4 => array(1, 3, 6, 7, 8)
		);

		public function decorate_classes($class_id, $profile=array(), $size=16, $pathonly=false) {
			$big = ($size > 40) ? '_b' : '';
			if(is_file($this->root_path.'games/'.$this->this_game.'/icons/classes/'.$class_id.$big.'.png')){
				$icon_path = $this->server_path.'games/'.$this->this_game.'/icons/classes/'.$class_id.$big.'.png';
				return ($pathonly) ? $icon_path : '<img src="'.$icon_path.'" width="'.$size.'" height="'.$size.'" alt="class '.$class_id.'" class="'.$this->this_game.'_classicon classicon'.'" title="'.$this->game->get_name('classes', $class_id).'" />';
			}
			return false;
		}

		protected function load_filters($langs) {}

		public function profilefields() {
			$fields = array(
				'gender'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'character',
					'lang'			=> 'uc_gender',
					'options'		=> array('male' => 'uc_male', 'female' => 'uc_female'),
					'undeletable'	=> true,
					'visible'		=> true,
					'tolang'		=> true
				),
				'guild'	=> array(
					'type'			=> 'text',
					'category'		=> 'character',
					'lang'			=> 'uc_guild',
					'size'			=> 40,
					'undeletable'	=> true,
					'visible'		=> true
				)
			);
			return $fields;
		}

		public function install($install=false){
			return array();
		}

		public function get_class_dependencies() {
			$pf_faction = $this->pdh->get('profile_fields', 'fields', array('faction'));
			if($this->config->get('uc_one_faction')) {
				$this->class_dependencies[0]['admin'] = true;
				// hide faction-field in profile-settings
				if($pf_faction['type'] != 'hidden') {
					$this->db->query("UPDATE __member_profilefields SET type = 'hidden' WHERE name='faction';");
					$this->pdh->enqueue_hook('game_update');
					$this->pdh->process_hook_queue();
				}
			} else {
				// set type of faction-field back to dropdown
				if($pf_faction['type'] != 'dropdown') {	
					$this->db->query("UPDATE __member_profilefields SET type = 'dropdown' WHERE name='faction';");
					$this->pdh->enqueue_hook('game_update');
					$this->pdh->process_hook_queue();
				}
			}
			return $this->class_dependencies;
		}

		public function admin_settings() {
			return array(
				'uc_one_faction' => array(
					'type'	=> 'radio',
					'lang'	=> 'uc_one_faction',
				)
			);
		}
	}
}
?>