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
	        $result = self::convertUrlEncode($url);
	    } else {
	    	//if url co chua domain (k co http://) thi check de tao full url
	    	//host: domain.. scheme: http/https..
	    	$urlArray = parse_url($url);
	    	if(!empty($urlArray) && empty($urlArray['host']) && empty($urlArray['scheme'])) {
	    		//doi voi url dang www.domain... hoac domain... (k co http/https...) can check co ton tai domain.. trong url k? neu co chi can them http:// (k them domain nua)
	    		//kiem tra xem co domain.ext hoac www.domain.ext hay k?
	    		if(!empty($urlArray['path'])) {
	    			$urlExplode = explode('/', substr($urlArray['path'], 1));
	    			//count url explode path > 1: tranh truong hop dau cham co o duoi .html, .htm...
	    			if(count($urlExplode) > 1 && strpos($urlExplode[0], '.') !== false) {
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
	    return self::convertUrlEncode($result);
	}
	//remove /?param=.... in url
	static function removeParameters($url = '')
	{
	    if(!empty($url)) {
	        $urlArray = parse_url($url);
	        if(!empty($urlArray) && !empty($urlArray['host']) && !empty($urlArray['scheme']) && !empty($urlArray['path'])) {
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
	static function createThumb($imageUrl, $domainSource, $savePath, $imageWidth = null, $imageHeight = null, $mode = null, $watermark = null) {
		//////////////////////////////////////
		// make result (duong dan anh de luu vao db)
		//////////////////////////////////////
		//get image name: foo.jpg
		//remove query ?param=.... neu co
        $name = basename(self::removeParameters($imageUrl));
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
	    //////////////////////////////////////
	    // make image url (duong dan anh can down ve de up len host)
	    //////////////////////////////////////
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
        // open an image file
        try {
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
	        if(isset($watermark)) {
	        	$w = $img->width();
	        	$h = $img->height();
	        	if($w >= 300 && $h > 150) {
		        	//176x28
		        	$base64 = 'data:image/jpeg;base64,/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAABQAAD/4QMraHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjMtYzAxMSA2Ni4xNDU2NjEsIDIwMTIvMDIvMDYtMTQ6NTY6MjcgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDUzYgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOkFGRDA1MUQzNUUyODExRTdBNEFGQTQ5QUVCNjFBNUFEIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOkFGRDA1MUQ0NUUyODExRTdBNEFGQTQ5QUVCNjFBNUFEIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6QUZEMDUxRDE1RTI4MTFFN0E0QUZBNDlBRUI2MUE1QUQiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6QUZEMDUxRDI1RTI4MTFFN0E0QUZBNDlBRUI2MUE1QUQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz7/7gAmQWRvYmUAZMAAAAABAwAVBAMGCg0AAAgLAAAM2gAAERcAABdB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';
	        		$img->insert($base64, 'bottom-right');
	        	}
	        }
	        // save image in desired format
	        $img->save($path);
	        return $imageResult;
        } catch (\Intervention\Image\Exception\NotReadableException $e) {
			return '';
		}
	}
	static function convertUrlEncode($url)
	{
		//loai bo scheme va host
		$urlArray = parse_url($url);
        if(!empty($urlArray) && !empty($urlArray['path'])) {
        	//bo dau / truoc path de explode
        	$path = substr($urlArray['path'], 1);
        	//tach path theo dau /
        	$pathArray = explode('/', $path);
        	$pathUrl = '';
        	$pathHost = '';
        	if(count($pathArray) > 0) {
        		foreach($pathArray as $value) {
        			$pathUrl .= '/'.urlencode($value);
        		}
        	}
        	if($pathUrl != '') {
        		if(!empty($urlArray['host'])) {
        			if(!empty($urlArray['port'])) {
	        			$pathHost = $urlArray['host'].':'.$urlArray['port'];
	        		} else {
	        			$pathHost = $urlArray['host'];
	        		}
        		}
        		if(!empty($urlArray['scheme'])) {
        			$pathHost = $urlArray['scheme'].'://'.$pathHost;
        		}
        		if(!empty($urlArray['query'])) {
        			$pathUrl = $pathUrl.'?'.$urlArray['query'];
        		}
        		$url = $pathHost.$pathUrl;
        	}
        }
		return $url;
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