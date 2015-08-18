<?php
/*	Project:	EQdkp-Plus
 *	Package:	Star Wars - the old republic game package
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if(!class_exists('swtor_torcommunity')) {
	class swtor_torcommunity extends itt_parser {

		public static $shortcuts = array('puf' => 'urlfetcher');
		
		public $supported_games = array('swtor');
		public $av_langs = array('en' => 'en_US');#, 'de' => 'de_DE', 'fr' => 'fr_FR', 'ru' => 'ru_RU', 'es' => 'es_ES', 'pl' => 'pl_PL');

		public $settings = array(
			'itt_icon_loc' => array(	'name' => 'itt_icon_loc',
										'language' => 'pk_itt_icon_loc',
										'type' => 'text',
										'size' => false,
										'options' => false,
										'default' => 'https://torcommunity.com/db/icons/',
			),
			'itt_icon_ext' => array(	'name' => 'itt_icon_ext',
										'language' => 'pk_itt_icon_ext',
										'type' => 'text',
										'size' => false,
										'options' => false,
										'default' => '.png',
			),
			'itt_default_icon' => array('name' => 'itt_default_icon',
										'language' => 'pk_itt_default_icon',
										'type' => 'text',
										'size' => false,
										'options' => false,
										'default' => 'not_yet_found',
			)
		);

		private $searched_langs = array();
		
		public function u_construct() {}

		public function __destruct() {
			unset($this->searched_langs);
			parent::__destruct();
		}

		protected function searchItemID($itemname, $lang, $searchagain=0) {
			$searchagain++;
			$this->pdl->log('infotooltip', 'swtor_torcommunity->searchItemID called: itemname: '.$itemname.', lang: '.$lang.', searchagain: '.$searchagain);

			$name = trim($itemname);
			if(empty($name)) return null;
			$name = urlencode($name);
			
			$url = "https://torcommunity.com/database/search/all?name=".$name;

			$this->pdl->log('infotooltip', 'Search for Item-ID at '.$url);
			$result = $this->puf->fetch($url);
			$item_id = 0;

			$intMatches = preg_match_all("/(.*)<a href='(.*)'(.*?(\n))+.*?<img src='(.*)'(.*?(\n))+.*?<div class='torctip_name'(.*)>(.*)<\//Um", $result, $matches);
			
			if($intMatches){
				foreach ($matches[0] as $key => $match)
				{
					// Extract the item's ID from the match.
					$found_name = $matches[9][$key];
				
					if(strcasecmp($itemname, $found_name) == 0) {
						$strLink = $matches[2][$key];
						
						preg_match("/(.*)\/item\/(.*)\//U", $strLink, $arrIDMatches);

						$item_id = $arrIDMatches[2];
						
						return array($item_id, 'items');
					}
				}
				
			}

			$debug_out = $item_id > 0 ? 'Item-ID found: '.$item_id : 'No Item-ID found';
			$this->pdl->log('infotooltip', $debug_out);
			return array($item_id, 'items');
		}

		protected function getItemData($item_id, $lang, $itemname='', $type='items'){
			//look up url: http://db.darthhater.com/ExTooltips.aspx?id={id}&type=1
			$item = array('id' => $item_id);
			if(!$item_id) return null;
			
			$url = 'https://torcommunity.com/db/tooltips/html/'.$item_id.'.torctip';
			$this->pdl->log('infotooltip', 'fetch item-data from '.$url);
			$content = $this->puf->fetch($url);
			
			preg_match("/(.*)<div class=\"torctip_image (.*)\"><img src=\"(.*)icons\/(.*)\./U", $content, $output_array);
			
			preg_match("/(.*)<div class=\"torctip_name\"><a(.*)>(.*)<\//U", $content, $output_array2);
			
			$template_html = trim(file_get_contents($this->root_path.'games/swtor/infotooltip/templates/swtor_torcommunity_popup.tpl'));
			$item['html'] = str_replace('{ITEM_HTML}', stripslashes($content), $template_html);
			$item['link'] = "https://torcommunity.com/database/item/".$item_id."/";
			$item['icon'] = $output_array[4];
			$item['color'] = str_replace("_image", "", $output_array[2]);
			$item['lang'] = $lang;
			$item['name'] = $output_array2[3];
			return $item;
		}
		
	}
}
?>