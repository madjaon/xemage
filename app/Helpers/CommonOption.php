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
    static function getMenuType($menuType=MENUTYPE1)
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
        return array(ADMIN=>'Admin', EDITOR=>'Editor');
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
            5 => 'QC trôi bên trái - PC',
            6 => 'QC trôi bên phải - PC',
            7 => 'Dưới nội dung trang - PC',
            8 => 'Dưới nội dung trang - Mobile',
            9 => 'Phía trên mục thư viện - PC',
            10 => 'Phía trên mục thư viện - Mobile',
            
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
    static function getTypeCrawler($type=CRAW_POST)
    {
        $array = self::typeCrawlerArray();
        return $array[$type];
    }
    //image crawler
    static function imageCrawlerArray()
    {
        return array(CRAW_POST_IMAGE=>'Lấy ảnh từ trang chi tiết',CRAW_CATEGORY_IMAGE=>'Lấy ảnh từ trang chuyên mục');
    }
    static function getImageCrawler($type=CRAW_POST_IMAGE)
    {
        $array = self::imageCrawlerArray();
        return $array[$type];
    }
    //image crawler
    static function titleCrawlerArray()
    {
        return array(CRAW_TITLE_POST=>'Lấy tiêu đề bài viết từ trang chi tiết',CRAW_TITLE_CATEGORY=>'Lấy tiêu đề bài viết từ trang chuyên mục');
    }
    static function getTitleCrawler($type=CRAW_TITLE_POST)
    {
        $array = self::titleCrawlerArray();
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
    //kiểu lấy tiêu đề bài viết
    static function titleTypeArray()
    {
        return array(
            TITLETYPE1=>'Lấy tiêu đề bài tự động theo mẫu thẻ lấy tiêu đề', 
            TITLETYPE2=>'Lấy tiêu đề tự động theo danh sách slug tương ứng ds link nguồn', 
            TITLETYPE3=>'Lấy tiêu đề theo danh sách tiêu đề tương ứng ds link nguồn', 
        );
    }
    static function getTitleType($titleType=TITLETYPE1)
    {
        $array = self::titleTypeArray();
        return $array[$titleType];
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
    static function getListSelectOption($name='pos', $end=31, $start=1, $value=1)
    {
        $select = '<select name="'.$name.'" class="form-control">';
        for($i = $start; $i <= $end; $i++) {
            $select .= '<option value="'.$i.'"'.self::checkSelected($value, $i).'>'.$i.'</option>';
        }
        $select .= '</select>';
        return $select;
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
    static function getListBlood($name='blood', $value='a')
    {
        return '<select name="'.$name.'" class="form-control"><option value="a"'.self::checkSelected($value, 'a').'>Nhóm máu A</option><option value="b"'.self::checkSelected($value, 'b').'>Nhóm máu B</option><option value="ab"'.self::checkSelected($value, 'ab').'>Nhóm máu AB</option><option value="o"'.self::checkSelected($value, 'o').'>Nhóm máu O</option></select>';
    }
    static function getListEyes($name='posEye', $value='left')
    {
        return '<select name="'.$name.'" class="form-control"><option value="left"'.self::checkSelected($value, 'left').'>Mắt trái</option><option value="right"'.self::checkSelected($value, 'right').'>Mắt phải</option></select>';
    }
    static function getListBode($name='bode', $value='hoihop')
    {
        return '<select name="'.$name.'" class="form-control"><option value="hoihop"'.self::checkSelected($value, 'hoihop').'>Hồi hộp</option><option value="nhaymui"'.self::checkSelected($value, 'nhaymui').'>Nhảy mũi</option><option value="matnong"'.self::checkSelected($value, 'matnong').'>Mặt nóng</option><option value="utaitrai"'.self::checkSelected($value, 'utaitrai').'>Ù tai trái</option><option value="utaiphai"'.self::checkSelected($value, 'utaiphai').'>Ù tai phải</option><option value="bapthitgiut"'.self::checkSelected($value, 'bapthitgiut').'>Bắp thịt giựt</option><option value="noikeu"'.self::checkSelected($value, 'noikeu').'>Nồi kêu</option><option value="luabocmanh"'.self::checkSelected($value, 'luabocmanh').'>Lửa bốc mạnh</option><option value="chosua"'.self::checkSelected($value, 'chosua').'>Chó sủa</option><option value="quakeu"'.self::checkSelected($value, 'quakeu').'>Quạ kêu</option><option value="hatxihoi"'.self::checkSelected($value, 'hatxihoi').'>Hắt xì hơi</option><option value="chimheo"'.self::checkSelected($value, 'chimheo').'>Chim heo kêu</option><option value="tiengchimkhach"'.self::checkSelected($value, 'tiengchimkhach').'>Tiếng chim khách</option></select>';
    }
    static function getListZodiac($name='zodiac', $value='ma-ket')
    {
        return '<select name="'.$name.'" class="form-control"><option value="ma-ket"'.self::checkSelected($value, 'ma-ket').'>Ma Kết (22/12 - 20/1)</option><option value="bao-binh"'.self::checkSelected($value, 'bao-binh').'>Bảo Bình (21/1 - 19/2)</option><option value="song-ngu"'.self::checkSelected($value, 'song-ngu').'>Song Ngư (20/2 - 20/3)</option><option value="bach-duong"'.self::checkSelected($value, 'bach-duong').'>Bạch Dương (21/3 - 20/4)</option><option value="kim-nguu"'.self::checkSelected($value, 'kim-nguu').'>Kim Ngưu (21/4 - 21/5)</option><option value="song-tu"'.self::checkSelected($value, 'song-tu').'>Song Tử (22/5 - 21/6)</option><option value="cu-giai"'.self::checkSelected($value, 'cu-giai').'>Cự Giải (22/6 - 22/7)</option><option value="su-tu"'.self::checkSelected($value, 'su-tu').'>Sư Tử (23/7 - 22/8)</option><option value="xu-nu"'.self::checkSelected($value, 'xu-nu').'>Xử Nữ (23/8 - 23/9)</option><option value="thien-binh"'.self::checkSelected($value, 'thien-binh').'>Thiên Bình (24/9 - 23/10)</option><option value="bo-cap"'.self::checkSelected($value, 'bo-cap').'>Bọ Cạp (24/10 - 22/11)</option><option value="nhan-ma"'.self::checkSelected($value, 'nhan-ma').'>Nhân Mã (23/11 - 21/12)</option></select>';
    }
    static function getListZodiacRank()
    {
        return '<select name="zodiacRank" class="form-control"><option value="chanh">Chảnh</option><option value="da_tinh">Đa Tình</option><option value="dai_gai">Dại Gái</option><option value="de_xom">Dê Xòm</option><option value="dien">Điên</option><option value="fa_nhieu">FA nhiều</option><option value="gan_da">Gan Dạ</option><option value="gia_nai">Giả Nai</option><option value="ham_hoc">Ham Học</option><option value="hat_hay">Hát Hay</option><option value="lau_ca">Láu Cá</option><option value="lua_tinh">Lừa Tình</option><option value="luoi_bien">Lười Biến</option><option value="luy_tinh">Lụy Tình</option><option value="me_choi_game">Mê Chơi Game</option><option value="me_trai">Mê Trai</option><option value="nghiem_tuc">Nghiêm Túc</option><option value="nhat_gan">Nhát Gan</option><option value="noi_doi">Nói Dối</option><option value="sang_tao">Sáng Tạo</option><option value="mong_mo">Mộng Mơ</option><option value="so_xau">Sợ Xấu</option><option value="than_thien">Thân Thiện</option><option value="thanh_thien">Thánh Thiện</option><option value="vi_ban_be">Vì Bạn Bè</option><option value="vo_tinh">Vô Tình</option><option value="xau_nhieu_nhat">Nhiều Tính Xấu Nhất</option><option value="yeu_doi">Yêu Đời</option></select>';
    }

}
