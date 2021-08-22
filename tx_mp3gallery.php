<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  Content.tx_mp3gallery_2021
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * French : Modification par doc_denis pour mes besoins perso avec un player HTML 5 pour le rendre plus simple et comptible avec PHP 7 et PHP 8.
 * English : Modification made by doc_denis for my personal requirements with a HTML 5 player to make it simpler and compatible with PHP 7 and PHP 8.
 * version 1.0.1 du 2021/08/22 
 * traduction anglais : Juliette B
 */

defined('_JEXEC') or die;

/**
 * Plug-in to enable loading modules into content (e.g. articles)
 * This uses the {loadmodule} syntax
 */
class PlgContentTX_Mp3Gallery extends JPlugin
{
	protected static $modules = array();

	protected static $mods = array();

/**
* 
*/


	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer')
		{
			return true;
		}

		// Simple performance check to determine whether bot should process further
    
    		if (strpos($article->text, '{tx_mp3gallery}') === false && strpos($article->text, '{/tx_mp3gallery}') === false)
			if (strpos($article->text, '{music}') === false && strpos($article->text, '{/music}') === false)
			{
			return true;
			}

//French doc_denis :  regex pour "xpert-mp3-gallery" : 
//English doc_denis : regex for "xpert-mp3-gallery" PLUGIN.
			


			$regex	= '#{tx_mp3gallery}(.*?){/tx_mp3gallery}#s';

    
//doc_denis : regex pour "mp3 Browser Fork"
//English doc_denis : regex for "mp3 B Fork" PLUGIN.
			
			$regex2	= '#{music}(.*?){/music}#s';

		
		// Find all instances of plugin and put in $matches for loadposition
		// $matches[0] is full pattern match, $matches[1] is the folder path

//doc_denis : ajout des deux conditions afin d'assurer le fonctionnement avec les deux tag's
//English doc_denis : addition of both conditions to ensure the functioning with both tags
    
			preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);
    		preg_match_all($regex2, $article->text, $matches2, PREG_SET_ORDER);
		
		// No matches, skip this
// doc_denis : prise en charge du tag original {/tx_mp3gallery} pour "xpert-mp3-gallery"
//English doc_denis : support of the original tag {/tx_mp3gallery} for "xpert-mp3-gallery"

		if ($matches)
		{
			JHtml::_('jquery.framework');
			foreach ($matches as $match)
			{
				//Fetch All mp3 filename and and insert into an array
				if ($handle = opendir(JPATH_SITE.'/'.$match[1])) {

						$musicDir = JURI::base() . $match[1];
						$count		= 0;
               			$mp3Array[0] = '';

						while ((false !== ($file = readdir($handle)))) {
								$fileType =	substr($file, strrpos($file, '.'));

								if($file!="." && $file!=".." && ($fileType=='.mp3' || $fileType=='.MP3')){
										$mp3Array[$count]=$file;
										$count++;
								}
						}
				}

				if($count)
				{
// doc_denis : pour sortir la liste des mp3 en ordre alphabétique, utiliser celle ci-dessous ou prendre la suivante (rsort) :
//English doc_denis :  to sort out the list of mp3 tracks in alphabetical order, use the following or take the one after that (rsort) :
						
                		sort($mp3Array,SORT_STRING);			
                		//rsort($mp3Array,SORT_STRING);

						for($count=0; $count < sizeof($mp3Array) ; $count++){

								$file = $mp3Array[$count];

								//Fetch Mp3 title from file name
								$title=  substr($file,0,-4);
								$id = preg_replace('/\W+/','',strtolower(strip_tags($title)));
								$mp3Info [$count] = array(
									'title'             => $title,
									'id'                => $id,
									'filePath'          => $musicDir.'/'.$file
								);

						} //end for loop

						$output = $this->_prepareOutput($mp3Info, $match[1]);
				}

				// $output = '<strong>We got it MP3</strong>';
				// We should replace only first occurrence in order to allow positions with the same name to regenerate their content:
				$article->text = preg_replace("|$match[0]|", addcslashes($output, '\\$'), $article->text, 1);
			}
		}

// doc_denis : ajout prise en charge du tag {music} pour "mp3 Browser Fork"
//English doc_denis : addition of the support of the {music} tag for "mp3 Browser Fork"
    
		if ($matches2)
		{
			JHtml::_('jquery.framework');
			foreach ($matches2 as $match2)
			{
				//Fetch All mp3 filename and and insert into an array
				if ($handle = opendir(JPATH_SITE.'/'.$match2[1])) {

						$musicDir = JURI::base() . $match2[1];
						$count		= 0;
               			$mp3Array[0] = '';

						while ((false !== ($file = readdir($handle)))) {
								$fileType =	substr($file, strrpos($file, '.'));

								if($file!="." && $file!=".." && ($fileType=='.mp3' || $fileType=='.MP3')){
										$mp3Array[$count]=$file;
										$count++;
								}
						}
				}

				if($count)
				{
// doc_denis : pour sortir la liste des mp3 en ordre alphabétique, utiliser celle ci-dessous :
//English doc_denis :  to sort out the list of mp3 tracks in alphabetical order, use the following :
						
                		sort($mp3Array,SORT_STRING);
					
// doc_denis : pour sortir la liste des mp3 en ordre inverse (le dernier affiché en premier), il faut : commenter la ligne ci-dessus avec (deux slashs) et utiliser celle ci-dessous en enlevant les commentaires (les deux slashs)
//English doc_denis :to sort out the list of mp3 in reverse (the last one first) you need to : comment the above line with (two slashes) and use the one below after removing its comments (the two slashes)
						
                		//rsort($mp3Array,SORT_STRING);

						for($count=0; $count < sizeof($mp3Array) ; $count++){

								$file = $mp3Array[$count];

								//Fetch Mp3 title from file name
								$title=  substr($file,0,-4);
								$id = preg_replace('/\W+/','',strtolower(strip_tags($title)));
								$mp3Info [$count] = array(
									'title'             => $title,
									'id'                => $id,
									'filePath'          => $musicDir.'/'.$file
								);

						} //end for loop

						$output = $this->_prepareOutput($mp3Info, $match2[1]);
				}

				// $output = '<strong>We got it MP3</strong>';
				// We should replace only first occurrence in order to allow positions with the same name to regenerate their content:
				$article->text = preg_replace("|$match2[0]|", addcslashes($output, '\\$'), $article->text, 1);
			}
		}
    
// doc_denis : retour au script après les (if)
//English doc_denis : return to the script after the (if)s
    
	}

/**
* method: prepareOutput
* generate the html for the list or gallery
* doc_denis : J'utilise un player HTML5 simple pour chaque titre MP3
* English doc_denis : for each mp3 track, I use a simple HTML5 player
	*/

	function _prepareOutput(&$mp3Info, $_temp)
	{
	foreach($mp3Info as $mp3){
	      //$html .= '<tr id="tx_mp3gallery-item-'.$mp3['id'].'">';
    		$html .= '<div class="mp3gallery">'.'<hr>';
	        $html .= '<div class="player_mp3gallery">'.'<audio controls>'.'<source src="'.$mp3['filePath'].'"'.$mp3['title'].'">'.'</audio>'.'</div>';
    		$html .= '<div class="title_mp3gallery">'.'<a href="'.$mp3['filePath'].'" '.'target="_blank">'.$mp3['title'].'</a></div>';

	    }
			return $html;

	}
}
