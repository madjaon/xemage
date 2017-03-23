<?php 
namespace App\Helpers;

class CommonOption
{
	//status
    static function statusArray()
    {
        return array(ACTIVE=>'Kích hoạt', INACTIVE=>'Không kích hoạt');
    }
    static function getStatus($status=ACTIVE)
    {
    	$array = self::statusArray();
        if($status == ACTIVE) {
            return '<span style="color: green;">'.$array[$status].'</span>';
        } else {
            return '<span style="color: red;">'.$array[$status].'</span>';
        }
    }
    //language
    static function langArray()
    {
        return array(VI=>'Tiếng việt'); //, VI=>'Tiếng việt', EN=>'Tiếng anh'
    }
    static function getLang($lang=VI)
    {
    	$array = self::langArray();
        return $array[$lang];
    }
    //menu
    static function menuTypeArray()
    {
        return array(
            MENUTYPE1=>'Menu đầu trang', 
            // MENUTYPE2=>'Menu cột bên', 
            MENUTYPE3=>'Menu cuối trang', 
            MENUTYPE4=>'Menu mobile', 
        );
    }
    static function getMenuType($menuType=ACTIVE)
    {
        $array = self::menuTypeArray();
        return $array[$menuType];
    }
    //type
    static function typePostArray()
    {
        return array(POST=>'Post');
    }
    static function getTypePost($type=POST)
    {
        $array = self::typePostArray();
        return $array[$type];
    }
    //role admin
    static function roleArray()
    {
        return array(ADMIN=>'Admin'); //, EDITOR=>'Editor'
    }
    static function getRole($roleId=ADMIN)
    {
        $array = self::roleArray();
        return $array[$roleId];
    }
    //ad position
    static function adPositionArray()
    {
        return array(
            //all site
            1 => 'Header - PC',
            2 => 'Header - Mobile',
            3 => 'Footer - PC',
            4 => 'Footer - Mobile',
            5 => 'Sidebar Top - PC',
            6 => 'Sidebar Top- Mobile',
            7 => 'Sidebar Bottom - PC',
            8 => 'Sidebar Bottom - Mobile',
            9 => 'Phía trên bài viết - PC',
            10 => 'Phía trên bài viết - Mobile',
            11 => 'Phía dưới bài viết - PC',
            12 => 'Phía dưới bài viết - Mobile',
            
        );
    }
    static function getAdPosition($adPosition)
    {
        $array = self::adPositionArray();
        return $array[$adPosition];
    }
    //sort by Post type
    static function postSortByArray()
    {
        return array(
            'start_date' => 'Mặc định (Ngày đăng giảm dần)',
            'view' => 'Lượt view giảm dần',

        );
    }
    static function getPostSortBy($sortBy)
    {
        $array = self::postSortByArray();
        return $array[$sortBy];
    }
    //slider
    static function sliderTypeArray()
    {
        return array(
            SLIDER1=>'Slider đầu trang', 
            SLIDER2=>'Slider cuối trang', 
            SLIDER3=>'Hot Tips', 
        );
    }
    static function getSliderType($sliderType=SLIDER1)
    {
        $array = self::sliderTypeArray();
        return $array[$sliderType];
    }
    //type crawler
    static function typeCrawlerArray()
    {
        return array(CRAW_POST=>'Lấy tin theo danh sách links posts',CRAW_CATEGORY=>'Lấy tin theo danh sách posts trong chuyên mục');
    }
    static function getTypeCrawler($type=POST)
    {
        $array = self::typeCrawlerArray();
        return $array[$type];
    }
    //image crawler
    static function imageCrawlerArray()
    {
        return array(CRAW_POST_IMAGE=>'Lấy ảnh từ trang chi tiết',CRAW_CATEGORY_IMAGE=>'Lấy ảnh từ trang chuyên mục');
    }
    static function getImageCrawler($type=POST)
    {
        $array = self::imageCrawlerArray();
        return $array[$type];
    }
    //display post type
    static function displayArray()
    {
        return array(
            DISPLAY_1=>'Hình ảnh kèm tiêu đề', 
            DISPLAY_2=>'Chỉ hiển thị tiêu đề', 
        );
    }
    static function getDisplayType($display=DISPLAY_1)
    {
        $array = self::displayArray();
        return $array[$display];
    }
    //slug theo tiêu đề bài viết lấy được hay link nguồn bài viết
    static function slugTypeArray()
    {
        return array(
            SLUGTYPE1=>'Lấy slug tự động theo tiêu đề bài viết lấy được', 
            SLUGTYPE2=>'Lấy slug tự động theo link nguồn bài viết', 
            SLUGTYPE3=>'Lấy slug theo danh sách slugs tương ứng ds link nguồn', 
        );
    }
    static function getSlugType($slugType=SLUGTYPE1)
    {
        $array = self::slugTypeArray();
        return $array[$slugType];
    }
    static function checkSelected($value, $optionValue, $isChecked=null) {
        if($value == $optionValue) {
            if($isChecked != null) {
                return ' checked="checked"';
            } else {
                return ' selected';
            }
        }
        return '';
    }
    static function getListDay($day='day', $value=1)
    {
        $select = '<select name="'.$day.'" class="form-control">';
        for($i = 1; $i <= 31; $i++) {
            $select .= '<option value="'.$i.'"'.self::checkSelected($value, $i).'>'.$i.'</option>';
        }
        $select .= '</select>';
        return $select;
    }
    static function getListMonth($month='month', $value=1)
    {
        $select = '<select name="'.$month.'" class="form-control">';
        for($i = 1; $i <= 12; $i++) {
            $select .= '<option value="'.$i.'"'.self::checkSelected($value, $i).'>Tháng '.$i.'</option>';
        }
        $select .= '</select>';
        return $select;
    }
    static function getListYear($year='year', $limitYear=2015, $startYear=1930, $value=1930)
    {
        $select = '<select name="'.$year.'" class="form-control">';
        for($i = $startYear; $i <= $limitYear; $i++) {
            $select .= '<option value="'.$i.'"'.self::checkSelected($value, $i).'>Năm '.$i.'</option>';
        }
        $select .= '</select>';
        return $select;
    }
    static function getListSex($sex='sex', $value='1')
    {
        return '<input type="radio" name="'.$sex.'" value="1" id="'.$sex.'_1" class="form-control"'.self::checkSelected($value, '1', 1).' /><label for="'.$sex.'_1">Nam</label><input type="radio" name="'.$sex.'" value="2" id="'.$sex.'_2" class="form-control"'.self::checkSelected($value, '2', 1).' /><label for="'.$sex.'_2">Nữ</label>';
    }
    static function getListNguHanh($value='kim')
    {
        if(!in_array($value, ['kim', 'moc', 'thuy', 'hoa', 'tho'])) {
            $value = '';
        }
        return '<select name="hanh" class="form-control"><option value="kim"'.self::checkSelected($value, 'kim').'>Kim</option><option value="moc"'.self::checkSelected($value, 'moc').'>Mộc</option><option value="thuy"'.self::checkSelected($value, 'thuy').'>Thủy</option><option value="hoa"'.self::checkSelected($value, 'hoa').'>Hỏa</option><option value="tho"'.self::checkSelected($value, 'tho').'>Thổ</option></select>';
    }
    static function getListCan($name='cannamsinh', $value='giap')
    {
        if(!in_array($value, ['giap', 'at', 'binh', 'dinh', 'mau', 'ky', 'canh', 'tan', 'nham', 'quy'])) {
            $value = '';
        }
        return '<select name="'.$name.'" class="form-control"><option value="giap"'.self::checkSelected($value, 'giap').'>Giáp</option><option value="at"'.self::checkSelected($value, 'at').'>Ất</option><option value="binh"'.self::checkSelected($value, 'binh').'>Bính</option><option value="dinh"'.self::checkSelected($value, 'dinh').'>Đinh</option><option value="mau"'.self::checkSelected($value, 'mau').'>Mậu</option><option value="ky"'.self::checkSelected($value, 'ky').'>Kỷ</option><option value="canh"'.self::checkSelected($value, 'canh').'>Canh</option><option value="tan"'.self::checkSelected($value, 'tan').'>Tân</option><option value="nham"'.self::checkSelected($value, 'nham').'>Nhâm</option><option value="quy"'.self::checkSelected($value, 'quy').'>Quý</option></select>';
    }
    static function getListChi($name='chi', $value='ty')
    {
        if(!in_array($value, ['ty', 'suu', 'dan', 'mao', 'thin', 'ti', 'ngo', 'mui', 'than', 'dau', 'tuat', 'hoi'])) {
            $value = '';
        }
        return '<select name="'.$name.'" class="form-control"><option value="ty"'.self::checkSelected($value, 'ty').'>Tý</option><option value="suu"'.self::checkSelected($value, 'suu').'>Sửu</option><option value="dan"'.self::checkSelected($value, 'dan').'>Dần</option><option value="mao"'.self::checkSelected($value, 'mao').'>Mão</option><option value="thin"'.self::checkSelected($value, 'thin').'>Thìn</option><option value="ti"'.self::checkSelected($value, 'ti').'>Tị</option><option value="ngo"'.self::checkSelected($value, 'ngo').'>Ngọ</option><option value="mui"'.self::checkSelected($value, 'mui').'>Mùi</option><option value="than"'.self::checkSelected($value, 'than').'>Thân</option><option value="dau"'.self::checkSelected($value, 'dau').'>Dậu</option><option value="tuat"'.self::checkSelected($value, 'tuat').'>Tuất</option><option value="hoi"'.self::checkSelected($value, 'hoi').'>Hợi</option></select>';
    }
    static function getListHour($name='hour', $value='ty')
    {
        if(!in_array($value, ['ty', 'suu', 'dan', 'mao', 'thin', 'ti', 'ngo', 'mui', 'than', 'dau', 'tuat', 'hoi'])) {
            $value = '';
        }
        return '<select name="'.$name.'" class="form-control"><option value="ty"'.self::checkSelected($value, 'ty').'>Tý (23h-01h)</option><option value="suu"'.self::checkSelected($value, 'suu').'>Sửu (01-03h)</option><option value="dan"'.self::checkSelected($value, 'dan').'>Dần (03h-05h)</option><option value="mao"'.self::checkSelected($value, 'mao').'>Mão (05h-07h)</option><option value="thin"'.self::checkSelected($value, 'thin').'>Thìn (07h-09h)</option><option value="ti"'.self::checkSelected($value, 'ti').'>Tỵ (09h-11h)</option><option value="ngo"'.self::checkSelected($value, 'ngo').'>Ngọ (11h-13h)</option><option value="mui"'.self::checkSelected($value, 'mui').'>Mùi (13h-15h)</option><option value="than"'.self::checkSelected($value, 'than').'>Thân (15h-17h)</option><option value="dau"'.self::checkSelected($value, 'dau').'>Dậu (17h-19h)</option><option value="tuat"'.self::checkSelected($value, 'tuat').'>Tuất (19h-21h)</option><option value="hoi"'.self::checkSelected($value, 'hoi').'>Hợi (21h-23h)</option></select>';
    }

}
