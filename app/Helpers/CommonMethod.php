<?php 
namespace App\Helpers;
use Image;

class CommonMethod
{
	static function startDateLabel($startDate = null)
	{
		$now = date('Y-m-d H:i:s');
		if($startDate <= $now) {
			return date('d-m-Y H:i:s', strtotime($startDate));
		} else {
			return '<span style="color: red;">'.date('d-m-Y H:i:s', strtotime($startDate)).'</span>';
		}
	}
	//start date convert format date time
	static function datetimeConvert($date, $time, $second = null)
	{
		if($date == '') {
			$date = date('d/m/Y');
		}
		if($time == '') {
			if($second != null) {
				$time = date('H:i');
			} else {
				$time = date('H:i:s');
			}
		}
		$dateArray = explode('/', $date);
		$timeArray = explode(':', $time);
		$timeArray[2] = isset($timeArray[2])?$timeArray[2]:'00';
		// mktime: hour,minute,second,month,day,year
		return date('Y-m-d H:i:s', mktime($timeArray[0], $timeArray[1], $timeArray[2], $dateArray[1], $dateArray[0], $dateArray[2]));
	}
	// part = 1: date, part = 2: time
	static function datetimeToArray($datetime, $part = 1)
	{
		$datetimeArray = explode(' ', $datetime);
		$dateArray = explode('-', $datetimeArray[0]);
		$timeArray = explode(':', $datetimeArray[1]);
		$date = $dateArray[2].'/'.$dateArray[1].'/'.$dateArray[0];
		$time = $timeArray[0].':'.$timeArray[1];
		if($part == 1) {
			return $date;
		} else {
			return $time;
		}
	}
	// cut domain form url
	static function removeDomainUrl($url)
	{
        $dm = url('/').'/';
        $output = str_replace($dm, '/', $url);
        return $output;
    }
    //full url with http://domain....
    static function getfullurl($url, $domain, $parameters = null) {
	    if (filter_var($url, FILTER_VALIDATE_URL)) { 
	        $result = $url;
	    } else {
	    	//if url co chua domain (k co http://) thi check de tao full url
	    	//host: domain.. scheme: http/https..
	    	$urlArray = parse_url($url);
	    	if(!empty($urlArray) && empty($urlArray['host']) && empty($urlArray['scheme'])) {
	    		//doi voi url dang www.domain... hoac domain... (k co http/https...) can check co ton tai domain.. trong url k? neu co chi can them http:// (k them domain nua)
	    		//kiem tra xem co domain.ext hoac www.domain.ext hay k?
	    		if(!empty($urlArray['path'])) {
	    			$urlExplode = explode('/', substr($urlArray['path'], 1));
	    			if(strpos($urlExplode[0], '.') !== false) {
		    			$result = 'http://' . $url;
		    		} else {
		    			$result = 'http://' . $domain . $url;
		    		}
	    		} else {
	    			$result = 'http://' . $domain . $url;
	    		}
	    	}
	    	else if(!empty($urlArray) && !empty($urlArray['host']) && empty($urlArray['scheme'])) {
	    		$result = 'http://' . $url;
	    	}
	    	else {
	    		$result = $url;
	    	}
	    }
	    if($parameters == null) {
	        $result = self::removeParameters($result);
	    }
	    return $result;
	}
	//remove /?param=.... in url
	static function removeParameters($url = '')
	{
	    if(!empty($url)) {
	        $urlArray = parse_url($url);
	        if(!empty($urlArray) && !empty($urlArray['host']) && !empty($urlArray['scheme']) || !empty($urlArray['path'])) {
	            if(!empty($urlArray['port'])) {
	            	return $urlArray['scheme'].'://'.$urlArray['host'].':'.$urlArray['port'].$urlArray['path'];
	            } else {
	            	return $urlArray['scheme'].'://'.$urlArray['host'].$urlArray['path'];
	            }
	        }
	    }
	    return $url;
	}
    //add time to filename
    //remove %20, space to - . or add time
	static function changeFileNameImage($filename, $time = null)
	{
		$file = self::getFilename($filename);
		//vietnamese to none vietnamese & replace space %20
		$file = str_replace('%20', '-', $file);
		$file = self::convert_string_vi_to_en($file);
        $file = strtolower(preg_replace('/[^a-zA-Z0-9]+/i', '-', $file));
		//add time
		if($time == null) {
			$str_time = strtotime(date('YmdHis'));
			$file = $file. '-' . $str_time;
		}
		$extension = self::getExtension($filename);
		return $file.'.'.$extension;
	}
	//get extension from filename
	static function getExtension($filename = null)
	{
		if($filename != '') {
			return pathinfo($filename, PATHINFO_EXTENSION);
		}
		return null;
	}
	//get filename from filename
	static function getFilename($filename = null)
	{
		if($filename != '') {
			return pathinfo($filename, PATHINFO_FILENAME);
		}
		return null;
	}
	//create thumbnail
	static function createThumb($imageUrl, $domainSource, $savePath, $imageWidth = null, $imageHeight = null, $mode = null) {
		//1 so url khong full (k co http://domain... nen tao duong dan full)
		$imageUrl = self::getfullurl($imageUrl, $domainSource);
		//if image at localhost, imageUrl must full path with public_path / if internet no need
	    if(strpos($imageUrl, 'localhost') !== false) {
	    	//remove http://localhost.../ if exist
	    	$imageUrlRe = self::removeDomainUrl($imageUrl);
	    	$imageUrl = public_path().$imageUrlRe;
	    	if(!file_exists($imageUrl)) {
		    	return '';
		    }
	    } else {
	    	if(!remoteFileExists($imageUrl)) {
				return '';
			}
	    }
        //get image name: foo.jpg
        $name = basename($imageUrl);
        //change file name image
        $name = self::changeFileNameImage($name, 1);
        //result path
        $imageResult = '/images/'.$savePath.'/'.$name;
        //if exist image then return result
        if(file_exists(public_path().$imageResult)) {
	    	return $imageResult;
	    }
        //full save path
	    $path = public_path().$imageResult;
	    //directory to save
	    $directory = './images/'.$savePath;
	    //check directory and create it if no exists
	    if (!file_exists($directory)) {
	        mkdir($directory, 0755, true);
	    }
        // open an image file
        $img = Image::make($imageUrl);
        if(isset($imageWidth) && isset($imageHeight)) {
        	//mode = resize / crop / fit ... more please go to page http://image.intervention.io/
        	if($mode == 'resize') {
        		// resize image instance
        		$img->resize($imageWidth, $imageHeight);
        	} else if($mode == 'crop') {
        		// crop image
				$img->crop($imageWidth, $imageHeight);
        	} else {
        		if($imageWidth != $imageHeight) {
        			// crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
					$img->fit($imageWidth, $imageHeight);
        		} else {
        			// crop the best fitting 1:1 ratio (200x200) and resize to 200x200 pixel
					$img->fit($imageWidth);
        		}
        	}
        }
        // insert a watermark
        // $img->insert('public/watermark.png');
        // save image in desired format
        $img->save($path);
        return $imageResult;
	}
	static function convert_string_vi_to_en($str)
	{
	    $unicode = array(
	        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
	        'd'=>'đ',
	        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	        'i'=>'í|ì|ỉ|ĩ|ị',
	        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	        'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	        'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	        'D'=>'Đ',
	        'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	        'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
	        'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	        'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	        'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	    );
	    foreach($unicode as $nonUnicode=>$uni){
	        $str = preg_replace("/($uni)/i", $nonUnicode, $str);
	    }
	    return $str;
	}
	static function replaceText($string='')
	{
		if($string == '') {
			return '';
		}
		$patterns = array();
		// string to search
		$patterns[0] = CONTACTFORM;
		$patterns[1] = TUVITRONDOI;
		$patterns[2] = XEMHOPTUOI;
		$patterns[3] = XEMTUOIVOCHONG;
		$patterns[4] = DATTENCON;
		$patterns[5] = QUYCOCTOANMENH;
		$patterns[6] = TUOIKETHON;
		$patterns[7] = CAOLYDAUHINH;
		$patterns[8] = NGAYCUOIHOI;
		$patterns[9] = NGAYHOANGDAO;
		$patterns[10] = NGAYLAMNHA;
		$patterns[11] = NGAYNHAPTRACH;
		$patterns[12] = NGAYKHAITRUONG;
		$patterns[13] = NGAYTUTAOSUACHUA;
		$patterns[14] = MAUSACHOPTUOI;
		$patterns[15] = HUONGNHATOT;
		$patterns[16] = NGAYCHONCAT;
		$patterns[17] = NGAYHACDAO;
		$patterns[18] = NGAYBATTUONG;
		$patterns[19] = TUVIGIOSINH;
		$patterns[20] = XEMCUNGMENH;
		$patterns[21] = TAMTAIHOANGOCKIMLAU;
		$patterns[22] = SAOCHIEUMENH;
		$patterns[23] = BOINGAYSINH;
		$patterns[24] = PHONGTHUYMATTIEN;
		$patterns[25] = PHONGTHUYSANVUON;
		$patterns[26] = XEMTUOIXONGDAT;
		$patterns[27] = BOINOTRUOIMATNAM;
		$patterns[28] = BOINOTRUOIMATNU;
		$patterns[29] = BOINOTRUOICOTHENAM;
		$patterns[30] = BOINOTRUOICOTHENU;
		$patterns[31] = BOINOTRUOIBANTAY;
		$patterns[32] = BOITINHYEUTHEONHOMMAU;
		$patterns[33] = BOINHAYMAT;
		$patterns[34] = DIEMBAOLANHDU;
		$patterns[35] = THAYPHAN;
		$patterns[36] = BOIAICAP;
		$patterns[37] = CUNGHOANGDAO;
		$patterns[38] = TINHYEUCUNGHOANGDAO;
		$patterns[39] = XEPHANGCUNGHOANGDAO;
		$replacements = array();
		// string to replace
		$replacements[0] = view('patterns.contactform');
		$replacements[1] = view('patterns.filter1');
		$replacements[2] = view('patterns.filter2');
		$replacements[3] = view('patterns.filter3');
		$replacements[4] = view('patterns.filter4');
		$replacements[5] = view('patterns.filter5');
		$replacements[6] = view('patterns.filter6');
		$replacements[7] = view('patterns.filter7');
		$replacements[8] = view('patterns.filter8');
		$replacements[9] = view('patterns.filter9');
		$replacements[10] = view('patterns.filter10');
		$replacements[11] = view('patterns.filter11');
		$replacements[12] = view('patterns.filter12');
		$replacements[13] = view('patterns.filter13');
		$replacements[14] = view('patterns.filter14');
		$replacements[15] = view('patterns.filter15');
		$replacements[16] = view('patterns.filter16');
		$replacements[17] = view('patterns.filter17');
		$replacements[18] = view('patterns.filter18');
		$replacements[19] = view('patterns.filter19');
		$replacements[20] = view('patterns.filter20');
		$replacements[21] = view('patterns.filter21');
		$replacements[22] = view('patterns.filter22');
		$replacements[23] = view('patterns.filter23');
		$replacements[24] = view('patterns.filter24');
		$replacements[25] = view('patterns.filter25');
		$replacements[26] = view('patterns.filter26');
		$replacements[27] = view('patterns.filter27');
		$replacements[28] = view('patterns.filter28');
		$replacements[29] = view('patterns.filter29');
		$replacements[30] = view('patterns.filter30');
		$replacements[31] = view('patterns.filter31');
		$replacements[32] = view('patterns.filter32');
		$replacements[33] = view('patterns.filter33');
		$replacements[34] = view('patterns.filter34');
		$replacements[35] = view('patterns.filter35');
		$replacements[36] = view('patterns.filter36');
		$replacements[37] = view('patterns.filter37');
		$replacements[38] = view('patterns.filter38');
		$replacements[39] = view('patterns.filter39');
		// sort array before replace
		ksort($patterns);
		ksort($replacements);
		return preg_replace($patterns, $replacements, $string);
	}
	
}