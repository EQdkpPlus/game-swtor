<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2011
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2011 EQdkp-Plus Developer Team
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

		protected $this_game	= 'swtor';
		protected $types		= array('classes', 'races', 'factions', 'roles');
		protected $classes		= array();
		protected $races		= array();
		protected $roles		= array();
		protected $factions		= array();
		protected $filters		= array();
		public $langs			= array('english', 'german');

		protected $glang		= array();
		protected $lang_file	= array();
		protected $path			= false;
		public $lang			= false;
		public $version			= '1.2';
		
		protected $class_dependencies = array(
			array(
				'name'		=> 'faction',
				'type'		=> 'factions',
				'admin' 	=> true,
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
		
		/**
		* Returns ImageTag with class-icon
		*
		* @param int $class_id
		* @param bool $big
		* @param bool $pathonly
		* @return html string
		*/
		public function decorate_classes($class_id, $big=false, $pathonly=false) {
		$big = ($size > 40) ? '_b' : '';
		$icon_path = $this->root_path.'games/'.$this->this_game.'/classes/'.$class_id.$big;
		if(is_file($icon_path)){
			return ($pathonly) ? $icon_path : '<img src="'.$icon_path.'" width="'.$size.'" height="'.$size.'" alt="class '.$class_id.'" class="'.$this->this_game.'_classicon classicon'.'" title="'.$this->game->get_name('classes', $class_id).'" />';
		}
		return false;
		}

		/**
		* Initialises filters
		*
		* @param array $langs
		*/
		protected function load_filters($langs) {}
		
		public function profilefields() {
			$fields = array(
				'gender'	=> array(
					'type'			=> 'dropdown',
					'category'		=> 'character',
					'lang'			=> 'uc_gender',
					'options'		=> array('male' => 'uc_male', 'female' => 'uc_female'),
					'undeletable'	=> true,
					'visible'		=> true
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

		public function get_OnChangeInfos($install=false){
			//classcolors
			$info['class_color'] = array();
			$info['aq'] = array();

			//Do this SQL Query NOT if the Eqdkp is installed -> only @ the first install
			#if($install){
			#}
			return $info;
		}
		
		public function admin_settings() {
			$admin_settings = array('swtor_faction'	=> array(
				'lang'		=> 'swtor_faction',
				'type'		=> 'dropdown',
				'size'		=> '1',
				'options'	=> $this->game->get('factions'),
				'default'	=> 0
			));
			return $admin_settings;
		}
	}
}
?>