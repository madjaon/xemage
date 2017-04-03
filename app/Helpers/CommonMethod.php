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
        if(isset($watermark)) {
        	$w = $img->width();
        	$h = $img->height();
        	if($w >= 300 && $h > 150) {
	        	//176x28
	        	$base64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALAAAAAcCAYAAADBaTXLAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoV2luZG93cykiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OThDRjlEM0QxODI5MTFFN0E1NTdENTMzNjMxNkIxMTkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OThDRjlEM0UxODI5MTFFN0E1NTdENTMzNjMxNkIxMTkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5OENGOUQzQjE4MjkxMUU3QTU1N0Q1MzM2MzE2QjExOSIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5OENGOUQzQzE4MjkxMUU3QTU1N0Q1MzM2MzE2QjExOSIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PuCpGXIAABlPSURBVHja1FwJeFRF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';
        		$img->insert($base64, 'bottom-right');
        	}
        }
        // save image in desired format
        $img->save($path);
        return $imageResult;
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