<?
/* V 0.5 */

/*
	Changelog: v0.4 -> v0.5
	+ Added: Autocrop (crops border from image)
	+ Added: GetFromUrl function and autogetter in the constructor (analyzes the filepath, if it is an url, it gets it from the internet).

	Changelog: v0.3 -> v0.4
	+ Added: PHash and FastPHash functions (along with HashAsString, to return the value)
	+ Added: getCanvas function (returns image resource)
	+ Added: flip function
	+ Added: filter function
	* Modified: Fixed watermark function, it can resize the watermark image before blending.

	Changelog: v0.2 -> v0.3
	+ Added: roundCorners (public function) (courtesy of http://www.exorithm.com/algorithm/view/round_corners)
	+ Added: allocateColor (private helper function) (http://www.exorithm.com/algorithm/view/allocate_color)
	+ Added: antialiasPixel (private helper function) (http://www.exorithm.com/algorithm/view/antialias_pixel)
	+ Added optipng and jpegoptim support
*/

define("MODE_FIXED",1);
define("MODE_FILL",2);
define("MODE_KEEP_AR",3);
define("MODE_CROP",4);

define("JPEGOPTIM_ENABLED", true);
define("JPEGOPTIM_PATH", '/usr/bin/jpegoptim');
define("OPTIPNG_ENABLED", true);
define("OPTIPNG_PATH",'/usr/bin/optipng');

class Image {
	private $filepath;
	private $origSize;
	private $size;
	private $mime;
	private $img;
	private $tmp_file;
	private $origExtension;
	private $fillColor;

	public function __construct($filepath=null,&$error=null){
		if(substr($filepath,0,7)=='http://' || substr($filepath,0,8)=='https://'){
			$filepath = $this->getFromUrl($filepath);
			if(!file_exists($filepath)){
				$this->tmp_file = $filepath;
				$error = "No se pudo descargar $filepath.";
				return false;
			}
		} else {
			if(!file_exists($filepath)){
				$error = "El archivo $filepath no existe.";
				return false;
			}
		}

		if($size = getimagesize($filepath)){
			$this->filepath = $filepath;

			switch ($size[2]){
				case 1: // Es un GIF
					$this->origExtension = 'gif';
					break;
				case 2: // Es un JPEG
					$this->origExtension = 'jpg';
					break;
				case 3: // Es un PNG
					$this->origExtension = 'png';
					break;
			}

			$this->origSize = array('width'=>$size[0], 'height'=>$size[1]);
			$this->mime = $size['mime'];
			$this->fillColor = "#000000";
			$this->reset();
		}
		else {
			$error = "El archivo $filepath no es una im&aacute;gen v&aacute;lida.";
			return false;
		}
	}
	public function __destruct(){
		if($this->img){
			imagedestroy($this->img);
		}
		if(file_exists($this->tmp_file)){
			@unlink($this->tmp_file);
		}
	}

	public function getFillColor(){
		return $this->fillColor;
	}
	public function setFillColor($color){
		$this->fillColor = $color;
	}
	public function getFilePath(){
		return $this->filepath;
	}
	public function getFilename(){
		return basename($this->filename);
	}
	public function getBasename(){
		return substr(basename($this->filename), 0, strrpos(basename($this->filename), "."));
	}
	public function getExtension(){
		return $this->origExtension;
	}
	public function getWidth(){
		return $this->size['width'];
	}
	public function getHeight(){
		return $this->size['height'];
	}
	public function getMime(){
		return $this->mime;
	}
	public function getFromUrl($url){
		$tmp_file = tempnam(null,'php_image');
		file_put_contents($tmp_file, file_get_contents($url));
		return $tmp_file;
	}
	public function reset(){
		if(($img=$this->imagecreatefromfile($this->filepath))!==false){
			$this->img = $img;
			$this->size['width'] = $this->origSize['width'];
			$this->size['height'] = $this->origSize['height'];
			return true;
		}
		return false;
	}
	public function resize($width, $height, $mode=MODE_KEEP_AR){
		$src = $this->img;
    $origWidth = $this->size['width'];
    $origHeight = $this->size['height'];
    switch($mode){
			case MODE_FIXED:
				$this->size['width'] = $width;
				$this->size['height'] = $height;
				$dst = imagecreatetruecolor($width,$height);
				$newWidth = $this->size['width'];
				$newHeight = $this->size['height'];
				$newx = 0;
				$newy = 0;
				break;

			case MODE_FILL:
				$this->size['width'] = $width;
				$this->size['height'] = $height;
				$dst = imagecreatetruecolor($width,$height);
				$color = $this->allocateColor($dst,$this->fillColor);
				imagefill($dst,0,0,$color);
				$ratio = min(min($width,$this->origSize['width'])/$this->origSize['width'], min($height,$this->origSize['height'])/$this->origSize['height']);
				$newWidth = ceil($this->origSize['width'] * $ratio);
				$newHeight = ceil($this->origSize['height'] * $ratio);
				$newx = ceil(($width - $newWidth) / 2);
				$newy = ceil(($height - $newHeight) / 2);
				break;

			case MODE_CROP:
				$this->size['width'] = $width;
				$this->size['height'] = $height;
				$dst = imagecreatetruecolor($width,$height);
				$ratio = max(min($width,$this->origSize['width'])/$this->origSize['width'],min($height,$this->origSize['height'])/$this->origSize['height']);
				$newWidth = ceil($this->origSize['width'] * $ratio);
				$newHeight = ceil($this->origSize['height'] * $ratio);
				$newx = ceil(($width - $newWidth) / 2);
				$newy = ceil(($height - $newHeight) / 2);
				break;

			case MODE_KEEP_AR:
			default:
				$ratio = min(min($width,$this->origSize['width'])/$this->origSize['width'], min($height,$this->origSize['height'])/$this->origSize['height']);
				$this->size['width'] = ceil($this->origSize['width'] * $ratio);
				$this->size['height'] = ceil($this->origSize['height'] * $ratio);
				$dst = imagecreatetruecolor($this->size['width'],$this->size['height']);
				$newWidth = $this->size['width'];
				$newHeight = $this->size['height'];
				$newx = 0;
				$newy = 0;
		}
		imagealphablending($dst, false);
		imagesavealpha($dst,true);
		$transparent = $this->allocateColor($dst, '#fff', 127);
		imagefilledrectangle($dst, 0, 0, $width, $height, $transparent);
		imagecopyresampled($dst,$src,$newx,$newy,0,0,$newWidth,$newHeight,$origWidth,$origHeight);

		$this->img = $dst;
	}

	public function crop($x,$y,$width,$height){
		$this->size['width'] = $width;
		$this->size['height'] = $height;
		$dst = imagecreatetruecolor($width, $height);
		imagecopy($dst, $this->img, 0, 0, $x, $y, $width, $height);
		$this->img = $dst;
	}

	// round_corners     version 0.2     Round the corners of an image. Transparency and anti-aliasing are supported
	// http://www.exorithm.com/algorithm/view/round_corners
	// Radius: (int) pixels
	// Color: (str) hex color (#rrggbb)
	// Transparency: (int) value (0-127)
	public function roundCorners($radius, $color='#ffffff', $transparency=0){
		$img = $this->img;
		$width = imagesx($img);
		$height = imagesy($img);

		$img2 = imagecreatetruecolor($width, $height);

		imagesavealpha($img2, true);
		imagealphablending($img2, false);

		imagecopy($img2, $img, 0, 0, 0, 0, $width, $height);

		$full_color = $this->allocateColor($img2, $color, $transparency);

		// loop 4 times, for each corner...
		for ($left=0;$left<=1;$left++) {
			for ($top=0;$top<=1;$top++) {
				$start_x = $left * ($width-$radius);
				$start_y = $top * ($height-$radius);
				$end_x = $start_x+$radius;
				$end_y = $start_y+$radius;

				$radius_origin_x = $left * ($start_x-1) + (!$left) * $end_x;
				$radius_origin_y = $top * ($start_y-1) + (!$top) * $end_y;

				for ($x=$start_x;$x<$end_x;$x++) {

					for ($y=$start_y;$y<$end_y;$y++) {
						$dist = sqrt(pow($x-$radius_origin_x,2)+pow($y-$radius_origin_y,2));

						if ($dist>($radius+1)) {
							imagesetpixel($img2, $x, $y, $full_color);
						} elseif ($dist>$radius) {
							$pct = 1-($dist-$radius);
							$color2 = $this->antialiasPixel($img2, $x, $y, $full_color, $pct);
							imagesetpixel($img2, $x, $y, $color2);
						}
					}

				}
			}
		}

		$this->img = $img2;
	}

	public function watermark_text($text,$font,$opacity=50,$position="center",$positionx="center",$size="auto"){
		$width = $this->size['width'];
		$height = $this->size['height'];

		if(!is_numeric($size)){
			$box_size = $this->find_box_size($text,$font,$width);
			$text_width = $box_size['width'];
			$text_height = $box_size['height'];
			$size = $box_size['fontsize'];
		} else {
			$text_box = imagettfbbox($size,0,$font,$text);
			$box_size['fontsize'] = $size;
			$box_size['width'] = abs($text_box[4]) + abs($text_box[6]);
			$box_size['height'] = abs($text_box[1]) + abs($text_box[7]);
			$box_size['x_pos'] = $text_box[0];
			$box_size['y_pos'] = $text_box[1];
			$text_width = $box_size['width'];
			$text_height = $box_size['height'];
		}

		switch($positionx){
			case "left": $x = 0; break;
			case "center": $x = round(($width - $text_width)/2); break;
			case "right": $x = $width - $text_width; break;
			default:
				if(!is_numeric($positionx))
					return false;
				else
					$x = $positionx;
		}
		switch($position){
			case "top": $y = 0; break;
			case "center-top": $y = round((($height/2) - $text_height) / 2); break;
			case "center": $y = round(($height - $text_height) / 2); break;
			case "center-bottom": $y = round($height/2 + (($height/2) - $text_height) / 2); break;
			case "bottom": $y = $height - $text_height; break;
			default:
				if(!is_numeric($position))
					return false;
				else
					$y = $position;
		}

		$transparency = round((100 - $opacity) * 1.27);
		$black = $this->allocateColor($this->img,'#000',$transparency);
		imagettftext($this->img, $size, 0, $x-$box_size['x_pos'], $y+$text_height-$box_size['y_pos'], $black, $font, $text);
/*
		$tmp = imagecreate($text_width,$text_height);
		$bg = $this->allocateColor($tmp,'#000',127);
		imagecolortransparent($tmp, $bg);
		imagefill($tmp,0,0,$bg);
		$black = $this->allocateColor($tmp,'#000',10);
		imagettftext($tmp, $size, 0, 0-$box_size['x_pos'], $text_height-$box_size['y_pos'], -1 * $black, $font, $text);
		imagecopymerge($this->img,$tmp,$x,$y,0,0,$text_width,$text_height,$opacity);
*/
	}

	public function watermark($file,$opacity=50,$x="center",$y="center",$expand=false,$small_file=null){
		list($wm_width,$wm_height) = getimagesize($file);
		$wm_landscape = (($wm_width / $wm_height) >= 0);

		$orig_width = $this->size['width'];
		$orig_height = $this->size['height'];
		$orig_landscape = (($orig_width/$orig_height) >= 0);

		if($wm_width > $orig_width && $small_file){
			$file = $small_file;
			list($wm_width,$wm_height)=getimagesize($file);
			$wm_landscape = (($wm_width / $wm_height) >= 0);
		}

		$dst = $this->img;
		$wm = new Image($file);

		switch($x){
			case "left": $x = 0; break;
			case "center": $x = round(($orig_width - $wm_width) / 2); break;
			case "right": $x = $orig_width - $wm_width; break;
			default:
				if(!is_numeric($x))
					return false;
		}

		switch($y){
			case "top": $y = 0; break;
			case "center-top": $y = round((($orig_height/2) - $wm_height) / 2); break;
			case "center": $y = round(($orig_height - $wm_height) / 2); break;
			case "center-bottom": $y = round($orig_height/2 + (($orig_height/2) - $wm_height) / 2); break;
			case "bottom": $y = $orig_height - $wm_height; break;

			default:
				if(!is_numeric($y))
					return false;
		}

		if(($expand && $orig_landscape && $wm_landscape)){
			$x = 0;
			$width = $orig_width;
			$height = round($wm_height * $orig_width / $wm_width);
			$wm->resize($width,$height,MODE_FIXED);
		} else {
			$width = $wm_width;
			$height = $wm_height;
		}
		$this->imagecopymerge_alpha($dst, $wm->getCanvas(), $x, $y, 0, 0, $width, $height, $opacity);

		$this->img = $dst;
	}

	function flip($x = 0, $y = 0, $width = null, $height = null){
		$image = $this->img;
		if ($width  < 1) $width  = imagesx($image);
		if ($height < 1) $height = imagesy($image);
		// Truecolor provides better results, if possible.
		if (function_exists('imageistruecolor') && imageistruecolor($image))
		{
			$tmp = imagecreatetruecolor(1, $height);
		}
		else
		{
			$tmp = imagecreate(1, $height);
		}
		$x2 = $x + $width - 1;
		for ($i = (int) floor(($width - 1) / 2); $i >= 0; $i--)
		{
			// Backup right stripe.
			imagecopy($tmp,   $image, 0,        0,  $x2 - $i, $y, 1, $height);
			// Copy left stripe to the right.
			imagecopy($image, $image, $x2 - $i, $y, $x + $i,  $y, 1, $height);
			// Copy backuped right stripe to the left.
			imagecopy($image, $tmp,   $x + $i,  $y, 0,        0,  1, $height);
		}
		imagedestroy($tmp);
		$this->img = $image;
	}

	/*
	 * negate: Reverses all colors of the image.
	 * grayscale: Converts the image into grayscale.
	 * brightness: Changes the brightness of the image. Use arg1 to set the level of brightness.
	 * contrast: Changes the contrast of the image. Use arg1 to set the level of contrast.
	 * colorize: Like IMG_FILTER_GRAYSCALE, except you can specify the color. Use arg1, arg2 and arg3 in the form of red, green, blue and arg4 for the alpha channel. The range for each color is 0 to 255.
	 * edgedetect: Uses edge detection to highlight the edges in the image.
	 * emboss: Embosses the image.
	 * blur: Blurs the image using the Gaussian method.
	 * selective_blur: Blurs the image.
	 * mean_removal: Uses mean removal to achieve a "sketchy" effect.
	 * smooth: Makes the image smoother. Use arg1 to set the level of smoothness.
	 * pixelate: Applies pixelation effect to the image, use arg1 to set the block size and arg2 to set the pixelation effect mode.
	 */
	public function filter($type,$a1=null,$a2=null,$a3=null,$a4=null){
		switch($type){
			case 'negate':
			case 'negative':
				$type = IMG_FILTER_NEGATE; break;
			case 'grayscale':
			case 'gray':
				$type = IMG_FILTER_GRAYSCALE; break;
			case 'brightness':
				$type = IMG_FILTER_BRIGHTNESS; break;
			case 'contrast':
				$type = IMG_FILTER_CONTRAST; break;
			case 'colorize':
				$type = IMG_FILTER_COLORIZE; break;
			case 'edgedetect':
			case 'edge':
				$type = IMG_FILTER_EDGEDETECT; break;
			case 'emboss':
				$type = IMG_FILTER_EMBOSS; break;
			case 'gaussianblur':
			case 'gaussian_blur':
			case 'gaussian':
			case 'blur':
				$type = IMG_FILTER_GAUSSIAN_BLUR; break;
			case 'selectiveblur':
			case 'selective_blur':
			case 'selective':
			case 'sblur':
				$type = IMG_FILTER_SELECTIVE_BLUR; break;
			case 'meanremoval':
			case 'mean_removal':
				$type = IMG_FILTER_MEAN_REMOVAL; break;
			case 'smooth':
				$type = IMG_FILTER_SMOOTH; break;
			case 'pixelate':
				$type = IMG_FILTER_PIXELATE; break;
		}
		$dst = $this->img;
		$params = array($this->img, $type);
		if($a1 !== null) $params[] = $a1;
		if($a2 !== null) $params[] = $a2;
		if($a3 !== null) $params[] = $a3;
		if($a4 !== null) $params[] = $a4;
		call_user_func_array('imagefilter',$params);
		$this->img = $dst;
	}

	public function autocrop($cropColor=null,$threshold=10){
		$img = $this->img;
		$hex = $cropColor;

		if($hex == null){
			$rgb = imagecolorat($img,0,0);
			$r = ($rgb >> 16) & 0xFF;
			$g = ($rgb >> 8) & 0xFF;
			$b = $rgb & 0xFF;
			$hex = "rgb($r,$g,$b)";
		}
		$width = imagesx($img);
		$height = imagesy($img);
		$b_top = 0;
		$b_lft = 0;
		$b_btm = $height - 1;
		$b_rt = $width - 1;

		//top
		for(; $b_top < $height; ++$b_top) {
			for($x = 0; $x < $width; ++$x) {
				$rgb = imagecolorat($img, $x, $b_top);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				if(!$this->colorsMatch("rgb($r,$g,$b)",$hex,$threshold)) break 2;
			}
		}

		// return false when all pixels are trimmed
		if ($b_top == $height) return false;

		// bottom
		for(; $b_btm >= 0; --$b_btm) {
			for($x = 0; $x < $width; ++$x) {
				$rgb = imagecolorat($img, $x, $b_btm);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				if(!$this->colorsMatch("rgb($r,$g,$b)",$hex,$threshold)) break 2;
			}
		}

		// left
		for(; $b_lft < $width; ++$b_lft) {
			for($y = $b_top; $y <= $b_btm; ++$y) {
				$rgb = imagecolorat($img, $b_lft, $y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				if(!$this->colorsMatch("rgb($r,$g,$b)",$hex,$threshold)) break 2;
			}
		}

		// right
		for(; $b_rt >= 0; --$b_rt) {
			for($y = $b_top; $y <= $b_btm; ++$y) {
				$rgb = imagecolorat($img, $b_rt, $y);
				$r = ($rgb >> 16) & 0xFF;
				$g = ($rgb >> 8) & 0xFF;
				$b = $rgb & 0xFF;
				if(!$this->colorsMatch("rgb($r,$g,$b)",$hex,$threshold)) break 2;
			}
		}

		$b_btm++;
		$b_rt++;
		$box = array(
			'l' => $b_lft,
			't' => $b_top,
			'r' => $b_rt,
			'b' => $b_btm,
			'w' => $b_rt - $b_lft,
			'h' => $b_btm - $b_top
		);

		// copy cropped portion
		$img2 = imagecreatetruecolor($box['w'], $box['h']);
		imagecopy($img2, $img, 0, 0, $box['l'], $box['t'], $box['w'], $box['h']);

		imagedestroy($img);
		$this->img = $img2;
	}

	public function save($dest=NULL, $quality=90){
		$ret = false;
		$exec_enabled = (function_exists('exec') && !in_array('exec', array_map('trim',explode(', ', ini_get('disable_functions')))) && strtolower( ini_get( 'safe_mode' ) ) != 'off');

		$type_id = 0;
		$image_size = getimagesize($this->filepath);
		$orig_type_id = $image_size[2];
		$dest_type = strtolower(substr($dest, strrpos($dest, '.')+1));
		switch($dest_type){
			case 'gif':
				$type_id = 1; break;
			case 'jpeg':
			case 'jpg':
				$type_id = 2; break;
			case 'png':
				$type_id = 3; break;
		}
		if($type_id==0){
			$type_id = $orig_type_id;
		}
//		e("Type found: $type_id - Orig Type: $orig_type_id");

		if($dest){
			switch ($type_id){
				case 1: // Es un GIF
//          e("Saving GIF...");
					$ret = imagegif($this->img, $dest);
					break;
        case 2: // Es un JPEG
//          e("Saving JPEG...");
					$dimg = $this->img;
          if($orig_type_id == 3){ // Original image is PNG, we have to flatten
//            e("Saving PNG as Jpeg, we have to flatten");
						$dimg = $this->flattenPNG($dimg,$this->fillColor);
					}
					$ret = imagejpeg($dimg, $dest, $quality);
					if($ret && $exec_enabled && JPEGOPTIM_ENABLED && is_executable(JPEGOPTIM_PATH)){
//						e('Executing jpegoptim...');
						exec(JPEGOPTIM_PATH." --strip-all '$dest'",$output,$return_var);
					}
					break;
				case 3: // Es un PNG
//          e("Saving PNG...");
					$ret = imagepng($this->img, $dest, 6);
					if($exec_enabled && OPTIPNG_ENABLED && is_executable(OPTIPNG_PATH)){
//						e('Executing optipng...');
						exec(OPTIPNG_PATH." -strip all -o1 '$dest'",$output,$return_var);
					}
				break;
			}
		}
		chmod($dest, 0644);
		return $ret;
	}

	public function getCanvas(){
		return $this->img;
	}

	public function show(){
		$image_size = getimagesize($this->filepath);
		if (is_array($image_size))
			switch ($image_size[2]){
				case 1: // Es un GIF
					header('Content-type: image/gif');
					imagegif($this->img);
					break;
				case 2: // Es un JPEG
					header('Content-type: image/jpeg');
					imagejpeg($this->img,NULL,80);
					break;
				case 3: // Es un PNG
					header('Content-type: image/png');
					imagepng($this->img);
					break;
			}
	}

	public function flattenPNG($img, $bgColor){
		$width = imagesx($img);
		$height = imagesy($img);
		$output = imagecreatetruecolor($width, $height);
		$bg = $this->allocateColor($img,$bgColor);
		imagefilledrectangle($output, 0, 0, $width, $height, $bg);
		imagecopy($output, $img, 0, 0, 0, 0, $width, $height);
		return $output;
	}

	/* build a perceptual hash out of an image. Just uses averaging because it's faster.
		also we're storing the hash as an array of bits instead of a string.
		http://www.hackerfactor.com/blog/index.php?/archives/432-Looks-Like-It.html */
	public function HashImage($rot=0, $mir=0, $size=8){
		$res = $this->img; // make sure this is a resource
		$rescached = imagecreatetruecolor($size, $size);

		imagecopyresampled($rescached, $res, 0, 0, 0, 0, $size, $size, imagesx($res), imagesy($res));
		imagecopymergegray($rescached, $res, 0, 0, 0, 0, $size, $size, 50);

		$w = imagesx($rescached);
		$h = imagesy($rescached);

		$pixels = array();

		for($y = 0; $y < $size; $y++) {

			for($x = 0; $x < $size; $x++) {

				/* 	instead of rotating the image, we'll rotate the position of the pixels to allow us to generate a hash
					we can use to judge if one image is a rotated or flipped version of the other, without actually creating
					an extra image resource. This currently only works at all for 90 degree rotations and mirrors. */

				switch($rot){
					case 90:	$rx=(($h-1)-$y);	$ry=$x;			break;
					case 180:	$rx=($w-$x)-1;		$ry=($h-1)-$y;	break;
					case 270:	$rx=$y;				$ry=($h-$x)-1;	break;
					default:	$rx=$x;				$ry=$y;
				}

				switch($mir){
					case 1: $rx = (($w-$rx)-1); break;
					case 2: $ry = ($h-$ry); 	break;
					case 3: $rx = (($w-$rx)-1);
							$ry = ($h-$ry); 	break;
					default: 					break;
				}

				$rgb = imagecolorsforindex($rescached, imagecolorat($rescached, $rx, $ry));

    			$r = $rgb['red'];
				$g = $rgb['green'];
				$b = $rgb['blue'];

				$gs = (($r*0.299)+($g*0.587)+($b*0.114));
				$gs = floor($gs);

				$pixels[] = $gs;
				//$index++;
			}
		}

		// find the average value in the array
		//$avg = $this->ArrayAverage($pixels);
		$avg = floor(array_sum($pixels) / count($pixels));

		// create a hash (1 for pixels above the mean, 0 for average or below)
		$index = 0;

		foreach($pixels as $px){
			if($px > $avg){
				$hash[$index] = 1;
			}
			else{
				$hash[$index] = 0;
			}
			$index += 1;
		}

		// return the array
		return $hash;
	}

	/* Heavily modified from a bicubic resampling function by an unknown author here: http://php.net/manual/en/function.imagecopyresampled.php#78049
	this will scale down, desaturate and hash an image entirely in memory without the intermediate steps of altering the image resource and
	re-reading pixel data, and return a perceptual hash for that image. Doesn't support rotation yet and is not actually as fast as it could be
	due to the multiple looping. */
	public function  FastHashImage($scale=8)  {
		$res = $this->img;

		$hash = array();
		$src_w = imagesx($res);
		$src_h = imagesy($res);

		$rX = $src_w / $scale;
		$rY = $src_h / $scale;
		$w = 0;
		for ($y = 0; $y < $scale; $y++)  {
			$ow = $w; $w = round(($y + 1) * $rY);
			$t = 0;
			for ($x = 0; $x < $scale; $x++)  {
				$r = $g = $b = 0; $a = 0;
				$ot = $t; $t = round(($x + 1) * $rX);
				for ($u = 0; $u < ($w - $ow); $u++)  {
					for ($p = 0; $p < ($t - $ot); $p++)  {

						$rgb = imagecolorat($res, $ot + $p, $ow + $u);

						$r = ($rgb >> 16) & 0xFF;
						$g = ($rgb >> 8) & 0xFF;
						$b = $rgb & 0xFF;

						$gs = floor((($r*0.299)+($g*0.587)+($b*0.114)));
						$hash[$x][$y] = $gs;
					}

				}
			}
		}

		// reset all the indexes.
		$nhash = array();


		/**/
		$xnormal=0;

		foreach($hash as $xkey=>$xval){
			foreach($hash[$xkey] as $ykey=>$yval){
				unset($hash[$xkey]);
				$nhash[$xnormal][] = $yval;
			}
			$xnormal++;
		}

		// now hash (I really need to reduce the number of loops here.)
		$phash = array();

		for($x=0; $x<$scale; $x++){

			$avg = floor(array_sum($nhash[$x]) / count(array_filter($nhash[$x])));

		for($y=0; $y<$scale; $y++){
				$rgb = $nhash[$x][$y];
				if($rgb > $avg){
					$phash[] = 1;
				}
				else{
					$phash[] = 0;
				}
			}
		}

		return $phash;
	}

	/* return a perceptual hash as a string. Hex or binary. */
	public function HashAsString($hash, $hex=true){
		$i = 0;
		$bucket=null;
		$return = null;
		if($hex == true){
			foreach($hash as $bit){
				$i++;
				$bucket.=$bit;
				if($i==4){
					$return.= dechex(bindec($bucket));
					$i=0;
					$bucket=null;
				}
			}
			return $return;
		}
		return implode(null, $hash);
	}

	/* returns a binary hash as an html table, with each cell representing 1 or 0. */
	public function HashAsTable($hash, $size=8, $cellsize=8){

		$index = 0;
		$table = "<table cellpadding=\"0\" cellspacing=\"0\" style=\"table-layout: fixed;display:inline-block;\"><tr><td><tbody>";
		for($x=0; $x<$size; $x++){
			$table.="<tr>";
			for($y=0; $y<$size; $y++){
				$bit = (bool)($hash[$index]);
				$bitcolor = ($bit)?"#ddd":"#000";
				$abitcolor = ($bit)?"#000":"#fff";
				$sizepx = $size."px";
				$style="width:{$size}px;height:{$size}px;background-color:$bitcolor;color:$abitcolor;text-align:center;padding:0px;";
				$table.="<td style=\"$style\"></td>";
				$index++;
			}
			$table.="</tr>";
		}
		$table.="</tbody></table>";
		return $table;
	}

	/*
	 * Private functions
	 */

	// Allocates a color from the image
	private function allocateColor($img, $color, $transparency=0){
		if (!($rgb = $this->hexColortoRGB($color))) {
			throw new Exception("Invalid color code.");
		}
		if ($transparency < 0) $transparency = 0;
		if ($transparency > 127) $transparency = 127;

		if (!$transparency) return imagecolorallocate($img, $rgb['R'], $rgb['G'], $rgb['B']);

		return imagecolorallocatealpha($img, $rgb['R'], $rgb['G'], $rgb['B'], $transparency);
	}

	private function antialiasPixel ($image, $x, $y, $color, $weight) {
		$c = imagecolorsforindex($image, $color);
		$r1 = $c['red'];
		$g1 = $c['green'];
		$b1 = $c['blue'];
		$t1 = $c['alpha'];

		$color2 = imagecolorat($image, $x, $y);
		$c = imagecolorsforindex($image, $color2);
		$r2 = $c['red'];
		$g2 = $c['green'];
		$b2 = $c['blue'];
		$t2 = $c['alpha'];

		$cweight = $weight+($t1/127)*(1-$weight)-($t2/127)*(1-$weight);

		$r = round($r2*$cweight + $r1*(1-$cweight));
		$g = round($g2*$cweight + $g1*(1-$cweight));
		$b = round($b2*$cweight + $b1*(1-$cweight));

		$t = round($t2*$weight + $t1*(1-$weight));

		return imagecolorallocatealpha($image, $r, $g, $b, $t);
	}

	// Convierte un color hexadecimal en un array RGB
	private function hexColortoRGB($color){
		if(substr($color,0,4)=='rgb('){
			$rgb = substr($color,4,-1);
			list ($r,$g,$b) = explode(',',$rgb);
		} else {
			if ($color[0] == '#') $color = substr($color, 1);
			if (strlen($color) == 6)
				list($r, $g, $b) = array(	$color[0].$color[1], $color[2].$color[3], $color[4].$color[5]);
			elseif (strlen($color) == 3)
				list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
			else
				return false;

			$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
		}

		return array('R'=>$r, 'G'=>$g, 'B'=>$b);
	}

	//lee una imagen y autodetecta su formato por extensión
	public function imagecreatefromfile($filename){
		$image_size = getimagesize($filename);
		if (is_array($image_size))
			switch ($image_size[2]){
				case 1: // Es un GIF
					return imagecreatefromgif($filename);
					break;
				case 2: // Es un JPEG
					return imagecreatefromjpeg($filename);
					break;
				case 3: // Es un PNG
					$ret = imagecreatefrompng($filename);
					if($ret){
						imagealphablending($ret, true);
						imagesavealpha($ret,true);
						return $ret;
					}
					return false;
					break;
			}
		return false;
	}

	private function find_box_size($text,$font,$width){
		$start_size = 10;
		for($size=$start_size; 1; $size++){
			$text_box = imagettfbbox($size,0,$font,$text);
			$box_width = abs($text_box[4]) + abs($text_box[6]);
			$box_height = abs($text_box[1]) + abs($text_box[7]);
			if($box_width >= $width)
				break;
		}
		$size-=3;
		if($box_width > $width){
			$size--;
		}
		$text_box = imagettfbbox($size,0,$font,$text);
		$box_width = abs($text_box[4]) + abs($text_box[6]);
		$box_height = abs($text_box[1]) + abs($text_box[7]);
		$ret['fontsize'] = $size;
		$ret['width'] = $box_width;
		$ret['height'] = $box_height;
		$ret['x_pos'] = $text_box[0];
		$ret['y_pos'] = $text_box[1];
		return $ret;
	}

	/**
	 * PNG ALPHA CHANNEL SUPPORT for imagecopymerge();
	 * by Sina Salek
	 *
	 * Bugfix by Ralph Voigt (bug which causes it
	 * to work only for $src_x = $src_y = 0.
	 * Also, inverting opacity is not necessary.)
	 * 08-JAN-2011
	 *
	 **/
	private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
		// creating a cut resource
		$cut = imagecreatetruecolor($src_w, $src_h);

		// copying relevant section from background to the cut resource
		imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);

		// copying relevant section from watermark to the cut resource
		imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

		// insert cut resource to destination image
		imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
	}

	public function colorDiff($hex1,$hex2){
		$rgb1 = $this->hexColortoRGB($hex1);
		$rgb2 = $this->hexColortoRGB($hex2);

		//return abs($rgb1['R']-$rgb2['R']) + abs($rgb1['G']-$rgb2['G']) + abs($rgb1['B']-$rgb2['B']) ;
		return pow($rgb1['R']-$rgb2['R'],2) + pow($rgb1['G']-$rgb2['G'],2) + pow($rgb1['B']-$rgb2['B'],2) ;
	}

	// $threshold: 0-127
	public function colorsMatch($hex1,$hex2,$threshold=10){
		$diff = $this->colorDiff($hex1,$hex2);
		$th = ($diff * 127 / $this->colorDiff('000','fff'));
		if($th <= $threshold) return true;
		return false;
	}
}



?>
