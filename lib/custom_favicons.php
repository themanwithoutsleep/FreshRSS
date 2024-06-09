<?php
/**
 * Collate favicons into sprite image to be loaded via CSS
 * Must be run separately. Recommend once a day via cron job.
 *
 * Manually customize favicons for a feed by adding feed_name.ico to 
 * data/favicons/custom/ directory. feed_name is the title of the feed as
 * it appears in FreshRSS:
 * Feed title = Release notes from FreshRSS
 * Icon name = Release notes from FreshRSS.ico
 */

require_once(__DIR__ . '/../constants.php');
require_once(LIB_PATH . '/icofileloader/ParserInterface.php');
require_once(LIB_PATH . '/icofileloader/RendererInterface.php');
require_once(LIB_PATH . '/icofileloader/GdRenderer.php');
require_once(LIB_PATH . '/icofileloader/IcoFileService.php');
require_once(LIB_PATH . '/icofileloader/Icon.php');
require_once(LIB_PATH . '/icofileloader/IconImage.php');
require_once(LIB_PATH . '/icofileloader/IcoParser.php');

$favicons_DIR = DATA_PATH . '/favicons/';
$customFavicons_DIR = DATA_PATH . '/favicons/custom/';
$sprite_DIR = PUBLIC_PATH . '/themes/icons/';
$css_DIR = PUBLIC_PATH . '/themes/';

$str = file_get_contents($favicons_DIR . "favicons.json");
$favicons = json_decode($str, true);

$horizontal = 16;
$vertical = 16 * count($favicons);

// setup transparent background for all the favicons
$newSprite = imagecreatetruecolor($horizontal, $vertical);
imagesavealpha($newSprite, true);
$color = imagecolorallocatealpha($newSprite, 0, 0, 0, 127);
imagefill($newSprite, 0, 0, $color);

$css_str = "";
$loader = new Elphin\IcoFileLoader\IcoFileService;
$index = 0;
foreach($favicons as $key => $i)
{
	$feed_hash = $key;
	$feed_name = $favicons[$feed_hash]['feed_name'];

	if (file_exists($customFavicons_DIR . $feed_name . ".ico")) {
		$sourceFile = $customFavicons_DIR . $feed_name . ".ico";
		
		// Save feed URL for use in lib/favicons.php for custom favicons outside of feeds page
		if (file_exists($favicons_DIR . $feed_hash . ".txt")) {
			$url = file_get_contents($favicons_DIR . $feed_hash . ".txt");
			if (!empty($url)) {
				$favicons[$feed_hash]['feed_url'] = $url;
			}
		}
	} else {
		$sourceFile = $favicons_DIR . $feed_hash . ".ico";
	}
	
	if (!(file_exists($sourceFile))) {
		continue;
	}
	
	// icofileloader doesn't like some formats (i.e. '.png' file renamed to '.ico')
	try {
		$tmp = $loader->extractIcon($sourceFile, 16, 16);
	}
	catch(Exception $e) {
		continue;
	}
   
	$location = $index * 16;
	$favicons[$feed_hash]['feed_favicon'] = $location;

	imagecopy($newSprite, $tmp, 0, $location, 0, 0, 16, 16);
	imagedestroy($tmp);
	$index++;
	
	// Generate CSS string
	$css_str = $css_str . "[id='" . $feed_hash . "'] { /* " . $feed_name ." */
	background: url('icons/favicon_sprite.png') 0 -" . $location . "px;
}
";
}

imagepng($newSprite, $sprite_DIR . "favicon_sprite.png");
file_put_contents($favicons_DIR . "favicons.json", json_encode($favicons, JSON_PRETTY_PRINT));
file_put_contents($css_DIR . "favicons.css", $css_str);
