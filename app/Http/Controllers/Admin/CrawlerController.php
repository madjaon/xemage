<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostType;
use App\Models\Crawler;
use DB;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CommonMethod;
use App\Helpers\CommonQuery;
use Cache;
use Sunra\PhpSimple\HtmlDomParser;

class CrawlerController extends Controller
{
    public function index(Request $request)
    {
        trimRequest($request);
        $postTypeArray = CommonQuery::getArrayWithStatus('post_types');
        if($postTypeArray == null) {
            $postTypeArray = [];
        }
        $crawlers = Crawler::get();
        if(!empty($request->id)) {
            $id = $request->id;
            $data = Crawler::where('id', $id)->first();
        } else {
            $id = '';
            $data = [];
        }
        return view('admin.crawler.index', ['data' => $data, 'crawlers' => $crawlers, 'request' => $request, 'postTypeArray' => $postTypeArray, 'id' => $id]);
    }

    public function save(Request $request)
    {
        trimRequest($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'source' => 'max:255',
            'type_main_id' => 'required',
            'type' => 'required',
            'category_post_link_pattern' => 'max:255',
            'image_dir' => 'max:255',
            'image_pattern' => 'max:255',
            'title_pattern' => 'max:255',
            'description_pattern' => 'max:255',
            'element_delete' => 'max:255',
            'element_delete_positions' => 'max:255',
            'time_get' => 'max:255',
        ]);
        if($validator->fails()) {
            return 2;
        }
        if(empty($request->id)) {
            $data = Crawler::create([
                        'name' => $request->name,
                        'source' => $request->source,
                        'post_links' => $request->post_links,
                        'category_link' => $request->category_link,
                        'category_page_link' => $request->category_page_link,
                        'category_page_number' => $request->category_page_number,
                        'category_post_link_pattern' => $request->category_post_link_pattern,
                        'type_main_id' => $request->type_main_id,
                        'type' => $request->type,
                        'image_dir' => $request->image_dir,
                        'image_pattern' => $request->image_pattern,
                        'image_check' => $request->image_check,
                        'title_pattern' => $request->title_pattern,
                        'description_pattern' => $request->description_pattern,
                        'description_pattern_delete' => $request->description_pattern_delete,
                        'element_delete' => $request->element_delete,
                        'element_delete_positions' => $request->element_delete_positions,
                        'start_date' => CommonMethod::datetimeConvert($request->start_date, $request->start_time),
                        'status' => $request->status,
                    ]);
        } else {
            $data = Crawler::find($request->id);
            if($data) {
                $data->update([
                    'name' => $request->name,
                    'source' => $request->source,
                    'post_links' => $request->post_links,
                    'category_link' => $request->category_link,
                    'category_page_link' => $request->category_page_link,
                    'category_page_number' => $request->category_page_number,
                    'category_post_link_pattern' => $request->category_post_link_pattern,
                    'type_main_id' => $request->type_main_id,
                    'type' => $request->type,
                    'image_dir' => $request->image_dir,
                    'image_pattern' => $request->image_pattern,
                    'image_check' => $request->image_check,
                    'title_pattern' => $request->title_pattern,
                    'description_pattern' => $request->description_pattern,
                    'description_pattern_delete' => $request->description_pattern_delete,
                    'element_delete' => $request->element_delete,
                    'element_delete_positions' => $request->element_delete_positions,
                    'start_date' => CommonMethod::datetimeConvert($request->start_date, $request->start_time),
                    'status' => $request->status,
                ]);
            } else {
                return 0;
            }
        }
        return 1;
    }

    public function destroy($id)
    {
        // $data = Post::find($id);
        // $data->delete();
        // return redirect()->route('admin.crawler.index')->with('success', 'Xóa thành công');
    }

    public function steal(Request $request)
    {
        Cache::flush();
        trimRequest($request);
        if($request->type == CRAW_POST) {
            if(!empty($request->post_links)) {
                $links = explode(',', $request->post_links);
                $result = self::stealPost($request, $links);
            }
        } else if($request->type == CRAW_CATEGORY) {
            if(!empty($request->category_link)) {
                $cats = [$request->category_link];
            } else {
                $cats = array();
            }
            //check paging
            if(!empty($request->category_page_link) && !empty($request->category_page_number)) {
                for($i = 2; $i <= $request->category_page_number; $i++) {
                    $cats[] = str_replace('[page_number]', $i, $request->category_page_link);
                }
            }
            if(count($cats) > 0 && !empty($request->category_post_link_pattern)) {
                foreach($cats as $key => $value) {
                    // get all link cat
                    $html = HtmlDomParser::file_get_html($value); // Create DOM from URL or file
                    foreach($html->find($request->category_post_link_pattern) as $element) {
                        $links[$key][] = trim($element->href);
                    }
                    if(!empty($request->image_check) && $request->image_check == CRAW_CATEGORY_IMAGE && !empty($request->image_pattern)) {
                        foreach($html->find($request->image_pattern) as $element) {
                            $images[$key][] = $element->src;
                        }
                    } else {
                        $images[$key] = [];
                    }
                    $result = self::stealPost($request, $links[$key], $images[$key]);
                }
            }
        }
        if(!empty($request->id)) {
            $data = Crawler::find($request->id);
            if($data) {
                $data->update([
                    'count_get' => $data->count_get+1,
                    'time_get' => date('Y-m-d H:i:s'),
                ]);
            }
        }
        return $result;
    }

    private function stealPost($request, $links, $images=array())
    {
        if(count($links) > 0) {
            foreach($links as $key => $link) {
                $html = HtmlDomParser::file_get_html($link); // Create DOM from URL or file
                // Lấy tiêu đề
                foreach($html->find($request->title_pattern) as $element) {
                    $postName = trim($element->plaintext); // Chỉ lấy phần text
                }
                // Lấy noi dung
                foreach($html->find($request->description_pattern) as $element) {
                    // tim anh truoc khi xoa the chua anh <img>
                    if(!empty($request->image_check) && $request->image_check == CRAW_POST_IMAGE && !empty($request->image_pattern)) {
                        foreach($element->find($request->image_pattern) as $e) {
                            $images = [$e->src];
                        }
                    }
                    // Xóa các mẫu trong miêu tả
                    if(!empty($request->description_pattern_delete)) {
                        $arr = explode(',', $request->description_pattern_delete);
                        for($i=0;$i<count($arr);$i++) {
                            foreach($element->find($arr[$i]) as $e) {
                                $e->outertext='';
                            }
                        }
                    }
                    // loai bo the cu the element_delete
                    if(!empty($request->element_delete_positions) && !empty($request->element_delete)) {
                        $element_delete_positions = explode(',', $request->element_delete_positions);
                        if(count($element_delete_positions) > 0) {
                            foreach($element_delete_positions as $edp) {
                                $element->find($request->element_delete, $edp)->outertext='';
                            }
                        }
                    }
                    $postDescription = trim($element->innertext); // Lấy toàn bộ phần html
                    //loai bo het duong dan trong noi dung
                    if(!empty($postDescription)){
                        $postDescription = preg_replace('/<a href=\"(.*?)\">(.*?)<\/a>/', "\\2", $postDescription);
                    }
                }
                //slug
                $slug = CommonMethod::convert_string_vi_to_en($postName);
                $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/i', '-', $slug));
                //image
                if(count($images) > 0 && !empty($request->image_dir)) {
                    $image = '/images/'.$request->image_dir.'/'.basename($images[$key]);
                } else {
                    $image = '';
                }
                //insert post
                $data = Post::create([
                    'name' => $postName,
                    'slug' => $slug,
                    'type_main_id' => $request->type_main_id,
                    'description' => $postDescription,
                    'image' => $image,
                    'position' => 1,
                    'start_date' => CommonMethod::datetimeConvert($request->start_date, $request->start_time),
                    'status' => $request->status,
                    'source' => $request->source,
                    'source_url' => $link,
                ]);
                if($data) {
                    // insert game type relation
                    $data->posttypes()->attach([$request->type_main_id]);
                }
                //upload images
                if(count($images) > 0 && !empty($request->image_dir)) {
                    $imageName = uploadImageFromUrl($images[$key], $request->image_dir);
                }
            }
        }
        return;
    }
}
