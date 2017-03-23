<?php 
namespace App\Helpers;

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
    //add time to filename
	static function changeFileNameImage($filename)
	{
		$file = getFilename($filename);
		$str = strtotime(date('YmdHis'));
		$fileNameAfter = $file. '-' . $str;
		$extension = getExtension($filename);
		return $fileNameAfter.'.'.$extension;
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
		$replacements = array();
		// string to replace
		$replacements[0] = view('patterns.contactform');
		$replacements[1] = view('patterns.filter', ['filter' => 1]);
		$replacements[2] = view('patterns.filter', ['filter' => 2]);
		$replacements[3] = view('patterns.filter', ['filter' => 3]);
		$replacements[4] = view('patterns.filter', ['filter' => 4]);
		$replacements[5] = view('patterns.filter', ['filter' => 5]);
		$replacements[6] = view('patterns.filter', ['filter' => 6]);
		$replacements[7] = view('patterns.filter', ['filter' => 7]);
		$replacements[8] = view('patterns.filter', ['filter' => 8]);
		$replacements[9] = view('patterns.filter', ['filter' => 9]);
		$replacements[10] = view('patterns.filter', ['filter' => 10]);
		$replacements[11] = view('patterns.filter', ['filter' => 11]);
		$replacements[12] = view('patterns.filter', ['filter' => 12]);
		$replacements[13] = view('patterns.filter', ['filter' => 13]);
		$replacements[14] = view('patterns.filter', ['filter' => 14]);
		$replacements[15] = view('patterns.filter', ['filter' => 15]);
		$replacements[16] = view('patterns.filter', ['filter' => 16]);
		$replacements[17] = view('patterns.filter', ['filter' => 17]);
		$replacements[18] = view('patterns.filter', ['filter' => 18]);
		$replacements[19] = view('patterns.filter', ['filter' => 19]);
		$replacements[20] = view('patterns.filter', ['filter' => 20]);
		$replacements[21] = view('patterns.filter', ['filter' => 21]);
		$replacements[22] = view('patterns.filter', ['filter' => 22]);
		// sort array before replace
		ksort($patterns);
		ksort($replacements);
		return preg_replace($patterns, $replacements, $string);
	}
	
}