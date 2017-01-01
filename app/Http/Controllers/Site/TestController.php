<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Helpers\CommonVideo;
use DB;
use App\Models\Post;
use Cache;

class TestController extends Controller
{
    public function index()
    {
    	// $link = 'https://photos.google.com/share/AF1QipMzuyRjE-xZJ8g6GHdDkka3RT0i4-CN84sWCJS9oenpCPA3xc70yhQ1RxHrUOAJ7Q/photo/AF1QipOK5kRr5x-zPWdjVAIwbR08p6cGAsPKfWRWyDyA?key=Smx4T0hVNVp0dTUyUWNpckFwbU1KVGx4dHdaT2p3';
    	// $link = 'https://drive.google.com/file/d/0B77yw2zOQcK_MGhYWHB3aENISlk/view?usp=sharing';
    	// $link = 'http://www.nhaccuatui.com/bai-hat/vo-nguoi-ta-phan-manh-quynh.DRfuHT6Q2LvC.html';
    	// $link = 'http://v.nhaccuatui.com/hoat-hinh/ore-monogatari.kxRUGM6dVwee.html?key=83VGzE8kC2qx9';
    	// $link = 'https://www.youtube.com/watch?v=qGRU3sRbaYw';
    	// $link = 'https://www.facebook.com/LeoMessi/videos/vb.176063032413299/1183588781660714/?type=2&theater';
    	// $result = CommonVideo::getLinkFacebookVideo($link);
    	// dd($result);


        //tu vi tron doi -> table
        // $data = DB::table('tvtd')->take(60)->get();
        // $table = '<table style="height: auto;" width="100%"><tbody><tr>
        //     <td style="text-align: center;" colspan="2"><strong>Năm dương lịch</strong></td>
        //     <td style="text-align: center;"><strong>Năm âm lịch</strong></td>
        //     <td style="text-align: center;"><strong>Giải thích</strong></td>
        //     <td style="text-align: center;"><strong>Mệnh</strong></td>
        //     <td style="text-align: center;"><strong>Giải nghĩa</strong></td>
        //     </tr>';
        // foreach($data as $key => $value) {
        //     $year2 = $value->year + 60;
        //     $url = DB::table('tvtd')->select('slug')->where('year', $value->year)->first();
        //     $url = str_replace('.html', '', $url->slug);
        //     $url2 = DB::table('tvtd')->select('slug')->where('year', $year2)->first();
        //     $url2 = str_replace('.html', '', $url2->slug);
        //     $table .= '<tr>
        //         <td style="text-align: center;"><strong><a href="'.$url.'">'.$value->year.'</a></strong></td>
        //         <td style="text-align: center;"><strong><a href="'.$url2.'">'.$year2.'</a></strong></td>
        //         <td style="text-align: center;">'.$value->ages.'</td>
        //         <td style="text-align: center;">'.$value->note.'</td>
        //         <td style="text-align: center;">'.str_replace('Mạng ', '', $value->life).'</td>
        //         <td style="text-align: center;">'.$value->life_desc.'</td>
        //         </tr>';
        // }
        // $table .= '</tbody></table>';
        // echo $table;
        
        // insert posts
        // $datas = DB::table('tvtd')->get();
        // foreach($datas as $key => $value) {
        //     $slug = str_replace('.html', '', $value->slug);
        //     $slug = str_replace('/', '', $slug);
        //     $type_id = 41;
        //     $data = Post::create([
        //         'name' => $value->name,
        //         'slug' => $slug,
        //         'type_main_id' => $type_id, //tu-vi-tron-doi
        //         'description' => str_replace('  <p style="text-align: center; margin: 10px 0;">  <!-- LVS300x250 -->   </p> <br/> ', '', $value->description),
        //         'source' => 'xemtuoi.com.vn',
        //         'source_url' => 'http://xemtuoi.com.vn'.$value->slug,
        //         'start_date' => date('Y-m-d H:i:s'),
        //     ]);
        //     $data->posttypes()->attach($type_id);
        // }

        // $datas = DB::table('tvtd2')->get();
        // foreach($datas as $key => $value) {
        //     $type_id = 42;
        //     $data = Post::create([
        //         'name' => $value->name,
        //         'slug' => $value->slug,
        //         'type_main_id' => $type_id, //tu-vi-tron-doi
        //         'description' => $value->description,
        //         'source' => 'xemtuoi.com.vn',
        //         'source_url' => 'http://xemtuoi.com.vn/'.$value->slug.'.html',
        //         'start_date' => date('Y-m-d H:i:s'),
        //     ]);
        //     $data->posttypes()->attach($type_id);
        // }
        // Cache::flush();
        // return 1;
    }

}