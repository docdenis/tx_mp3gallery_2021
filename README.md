# tx_mp3gallery_2021
Plugin Joomla avec player simple pour lire l'ensemble des mp3 d'un dossier


Mon projet est basé sur xpert-mp3-gallery (lien officiel) :
https://extensions.joomla.org/extension/xpert-mp3-gallery/
un plugin de "ThemeXpert" en licence GPLv2 or later

La mission que je me suis fixé, est de rendre le script compabible avec PHP 7.0 et 8.0 et le l'adapter à mes besoins personels qui sont :
	Avoir sur mes pages une liste de fichiers MP3, et un player HTML5 et un titre lien pour ouvrir le MP3 dans une nouvelle fenêtre.
	Le tout avec un plugin qui affiche l'ensemble des fichiers MP3 qui sont dans un dossier.
	
Je désire concerver le plugin "xpert-mp3-gallery" avec son installeur pour joomla avec les mêmes tags que l'original pour ne pas avoir à repasser sur l'ensemble des pages où celui-ci est déjà utilisé, cependant je vais aussi préparer un autre tag afin de permetre d'utiliser ce plugin à la place de l'ancien "mp3 Browser Fork" qui ne fonctionne plus sur PHP7 ni PHP8.
De cette manière ce plugin pourra remplacer les deux anciens systèmes "xpert-mp3-gallery" et "mp3 Browser Fork".

pour "xpert-mp3-gallery" le tag est : {tx_mp3gallery}/images/podcasts/chemim_vers_les_fichiers{/tx_mp3gallery}
pour "mp3 Browser Fork" le tag est : {music}/images/podcasts/chemim_vers_les_fichiers{/music}



My project is based on xpert-mp3-gallery (official link) :
https://extensions.joomla.org/extension/xpert-mp3-gallery/
One plugin of "ThemeXpert" on GPLv2 or later licence.

The mission that I have set myself to do, is to make the script compatible with PHP 7.0 and 8.0 and to adapt it to my personal requirements which are the following :
	Have on my pages a list of mp3 tracks, and a HTML5 player and a link title to open the mp3 track in a new window.
	All of that with a plugin that would showcase all tracks which are in a file.
	
I wish to maintain the "xpert-mp3-gallery" plugin with its installer for Joomla with the same tags as the original as to not go over the all the pages where the latter is already used, however, I will also prepare another tag to enable the use of this plugin instead of the old "mp3 Browser Fork" which didn't work on PHP7 nor PHP8 anymore.
This way, this plugin could replace both old systems, "xpert-mp3-gallery" and "mp3 Browser Fork"

For "xpert-mp3-gallery" the tag is : {tx_mp3gallery}/images/podcasts/chemim_vers_les_fichiers{/tx_mp3gallery}
For "mp3 Browser Fork" the tag is : {music}/images/podcasts/chemim_vers_les_fichiers{/music}
