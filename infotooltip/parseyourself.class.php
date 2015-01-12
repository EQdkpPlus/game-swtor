<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2010
 * Date:		$Date: 2014-09-27 18:15:30 +0200 (Sat, 27 Sep 2014) $
 * -----------------------------------------------------------------------
 * @author		$Author: wallenium $
 * @copyright	2006-2011 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev: 14621 $
 * 
 * $Id: parseyourself.class.php 14621 2014-09-27 16:15:30Z wallenium $
 */

include_once('itt_parser.aclass.php');

if(!class_exists('parseyourself')) {
	class parseyourself extends itt_parser {
		public static $shortcuts = array('pdl', 'puf' => 'urlfetcher', 'config' => 'configset', 'pfh' => array('file_handler', array('infotooltips')));

		public $supported_games	= array('swtor');
		public $av_langs		= array('de' => 'de_DE');
		public $mygame			= '';

		public $settings = array();

		public $itemlist = array();
		public $recipelist = array();

		private $searched_langs = array();

		public function __construct(){
			$this->mygame					= registry::register('config')->get('default_game');
		}

		public function getDataFolder($url=false){
			return (($url) ? $this->env->buildlink() : $this->root_path).'games/'.$this->mygame.'/infotooltip/';
		}

		public function __destruct(){
			unset($this->itemlist);
			unset($this->recipelist);
			unset($this->searched_langs);
			parent::__construct($init, $config, $root_path, $cache, $puf, $pdl);
			$this->av_langs = ((isset($g_lang[$this->mygame])) ? $g_lang[$this->mygame] : '');
		}

		private function getItemlist($lang, $forceupdate=false, $type='item'){
			$this->{$type.'list'} = unserialize(file_get_contents($this->pfh->FilePath($this->mygame.'_'.$lang.'_'.$type.'list.itt', 'itt_cache')));
			switch($lang){
				case 'de': $lang='de_DE';break;
				default: $lang='de_DE';
			}
			if(!$this->itemlist OR $forceupdate){
				$urlitemlist	= $this->getDataFolder().$type.'s/'.$lang.'/'.$type.'list.xml';
				$xml			= simplexml_load_file($urlitemlist);

				foreach($xml->children() as $item) {
					$name = (string) $item['name'];
					$this->{$type.'list'}[(int)$item['id']][$lang] = $name;
				}
				$this->pfh->putContent($this->pfh->FilePath($this->mygame.'_'.$lang.'_'.$type.'list.itt', 'itt_cache'), serialize($this->{$type.'list'}));
			}
			return true;
		}

		private function getItemIDfromItemlist($itemname, $lang, $forceupdate=false, $searchagain=0, $type='item'){
			$searchagain++;
			$this->getItemlist($lang,$forceupdate,$type);
			$item_id = array(0,0);

			//search in the itemlist for the name
			$loaded_item_langs = array();
			if($type == 'item') {
				foreach($this->itemlist as $itemID => $iteml){
					foreach($iteml as $slang => $name) {
						$loaded_item_langs[] = $slang;
						if($itemname == $name){
							$item_id[0]	= $itemID;
							$item_id[1]	= 'items';
							break 2;
						}
					}
				}
			}
			
			if(!$item_id[0] AND count($this->av_langs) > $searchagain) {
				$toload = array();
				foreach($this->av_langs as $c_lang => $langlong) {
					if(!in_array($c_lang,$loaded_item_langs)) {
						$toload[$c_lang][] = 'item';
					}
				}
				foreach($toload as $lang => $load) {
					foreach($load as $type) {
						$item_id = $this->getItemIDfromItemlist($itemname, $lang, true, $searchagain, $type);
						if($item_id[0]) {
							break 2;
						}
					}
				}
			}
			return $item_id;
		}

		protected function searchItemID($itemname, $lang){
			return $this->getItemIDfromItemlist($itemname, $lang);
		}

		protected function getItemData($item_id, $lang, $itemname='', $type='item'){
			settype($item_id, 'int');
			$item			= array('id' => $item_id);
			if(!$item_id) return null;

			switch($lang){
				case 'de': $lang='de_DE';break;
				default: $lang='de_DE';
			}

			$item['link']	= $this->getDataFolder().$type.'/'.$lang.'/'.$item['id'].'.xml';
			$this->config['default_icon']	= '100000';
			if(file_exists($item['link'])){
				$this->pdl->log('infotooltip', 'fetch item-data from: '.$item['link']);
				$itemxml		= simplexml_load_file($item['link']);
		
				$item['name']	= (!is_numeric($itemname) AND strlen($itemname) > 0) ? $itemname : trim($itemxml->name);

				//filter baditems
				if(!is_object($itemxml) OR !isset($itemxml->tooltip) OR strlen($itemxml->tooltip) < 5) {
					$this->pdl->log('infotooltip', 'no xml-object returned');
					$item['baditem'] = true;
					return $item;
				}
				
				//build itemhtml
				$html				= str_replace('"', "'", (string)$itemxml->tooltip);
				$template_html		= trim(file_get_contents($this->root_path.'games/swtor/infotooltip/templates/swtor_self_popup.tpl'));
				$item['params']		= array(
					'path'	=> $this->getDataFolder(true).'items/images/',
					'ext'	=> '.jpg',
					
				);
				$item['html']		= str_replace('{ITEM_HTML}', stripslashes($html), $template_html);
				$item['lang']		= $lang;
				$item['icon']		= (string)$itemxml->iconpath;
				$item['color']		= 'swtor_q'.(string)$itemxml->quality;

			}else{
				$this->pdl->log('infotooltip', 'File '.$item['link'].' does not exist');
			}
			return $item;
		}
	}
}
?>