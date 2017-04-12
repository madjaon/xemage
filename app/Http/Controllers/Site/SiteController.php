<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DB;
use Cache;
use App\Helpers\CommonMethod;
use Validator;
use App\Models\Contact;

class SiteController extends Controller
{
    public function index()
    {
        //cache name
        $cacheName = 'index';
        $device = getDevice();
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        $data = DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'summary', 'grid', 'limited', 'sort_by', 'display')
            ->where('status', ACTIVE)
            ->where('home', ACTIVE)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name', 'asc')
            ->get();
        if(count($data) > 0) {
            foreach($data as $key => $value) {
                //chi hien thi the loai (khong co 2 tab)
                $value->posts = $this->getPostByRelationsQuery('type', $value->id, $value->sort_by)->take(PAGINATE_BOX)->get();
                // neu the loai nay la con cua the loai khac (co parent_id khac 0) thi lay ra the loai cha cua no
                if($value->parent_id != 0) {
                    $parentTypeData = self::getPostTypeById($value->parent_id);
                    $value->parentType = $parentTypeData;
                } else {
                    $value->parentType = null;
                }
            }
        }
        //seo meta
        $seo = DB::table('configs')->where('status', ACTIVE)->first();
        
        //put cache
        $html = view('site.index', ['data' => $data, 'seo' => $seo])->render();
        Cache::forever($cacheName, $html);
        //return view
        return view('site.index', ['data' => $data, 'seo' => $seo]);
    }
    public function tag(Request $request, $slug)
    {
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'tag_'.$slug.'_'.$page;
        $device = getDevice();
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        $tag = DB::table('post_tags')
            ->select('id', 'name', 'slug', 'patterns', 'summary', 'description', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image')
            ->where('slug', $slug)
            ->where('status', ACTIVE)
            ->first();
        // posts tags
        if(isset($tag)) {
            $tag->patterns = CommonMethod::replaceText($tag->patterns);
            $tag->summary = CommonMethod::replaceText($tag->summary);
            $tag->description = CommonMethod::replaceText($tag->description);
            $data = $this->getPostByRelationsQuery('tag', $tag->id)->paginate(PAGINATE);
            if($data->total() > 0) {
                //auto meta tag for seo
                $tagName = ucwords(mb_strtolower($tag->name));
                if(empty($tag->meta_title)) {
                    if($page > 1) {
                        $tag->meta_title = $tagName.' trang '.$page.' | xemtuoi.vn';
                    } else {
                        $tag->meta_title = $tagName.' | xemtuoi.vn';
                    }
                }
                if(empty($tag->meta_keyword)) {
                    $tagNameNoLatin = CommonMethod::convert_string_vi_to_en($tagName);
                    $tag->meta_keyword = $tagNameNoLatin.','.$tagName;
                }
                if(empty($tag->meta_description)) {
                    $tag->meta_description = $tagName;
                }
                //put cache
                $html = view('site.post.tag', ['data' => $data, 'tag' => $tag])->render();
                Cache::forever($cacheName, $html);
                //return view
                return view('site.post.tag', ['data' => $data, 'tag' => $tag]);
            }
        }
        return response()->view('errors.404', [], 404);
    }
    public function page(Request $request, $slug)
    {
        self::forgetCache('lien-he');
        //
        trimRequest($request);
        $device = getDevice();
        //update count view post
        DB::table('posts')->where('slug', $slug)->increment('view');
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'page_'.$slug.'_'.$page;
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        // IF SLUG IS PAGE
        //query
        $singlePage = DB::table('pages')->where('slug', $slug)->where('status', ACTIVE)->first();
        // page
        if(isset($singlePage)) {
            $singlePage->patterns = CommonMethod::replaceText($singlePage->patterns);
            $singlePage->summary = CommonMethod::replaceText($singlePage->summary);
            $singlePage->description = CommonMethod::replaceText($singlePage->description);
            //put cache
            $html = view('site.page', ['data' => $singlePage])->render();
            Cache::forever($cacheName, $html);
            //return view
            return view('site.page', ['data' => $singlePage]);
        }        
        // IF SLUG IS TYPE
        //query
        $type = $this->getPostTypeBySlug($slug);
        // post type
        if(isset($type)) {
            $type->patterns = CommonMethod::replaceText($type->patterns);
            $type->summary = CommonMethod::replaceText($type->summary);
            $type->description = CommonMethod::replaceText($type->description);
            if($type->list_posts == ACTIVE) {
                if($type->grid == ACTIVE) {
                    $paginateNumber = PAGINATE;
                } else {
                    $paginateNumber = PAGINATE_GRID;
                }
                $paginate = 1;
                $data = $this->getPostByRelationsQuery('type', $type->id)->paginate($paginateNumber);
                $total = count($data);
                // lay ra the loai con cua the loai hien tai
                $typeChild = DB::table('post_types')
                        ->select('id', 'name', 'slug', 'parent_id', 'image')
                        ->where('parent_id', $type->id)
                        ->where('status', ACTIVE)
                        ->get();
                if(count($typeChild) > 0) {
                    $typeChild = $typeChild;
                } else {
                    $typeChild = null;
                }
            } else {
                $paginate = null;
                $data = null;
                $total = 0;
                $typeChild = null;
            }
            //auto meta tag for seo
            $typeName = ucwords(mb_strtolower($type->name));
            if(empty($type->meta_title)) {
                if($page > 1) {
                    $type->meta_title = $typeName.' trang '.$page.' | xemtuoi.vn';
                } else {
                    $type->meta_title = $typeName.' | xemtuoi.vn';
                }
            }
            if(empty($type->meta_keyword)) {
                $typeNameNoLatin = CommonMethod::convert_string_vi_to_en($typeName);
                $type->meta_keyword = $typeNameNoLatin.','.$typeName;
            }
            if(empty($type->meta_description)) {
                $type->meta_description = $typeName;
            }
            //put cache
            $html = view('site.post.type', ['data' => $data, 'type' => $type, 'typeChild' => $typeChild, 'total' => $total, 'paginate' => $paginate])->render();
            Cache::forever($cacheName, $html);
            //return view
            return view('site.post.type', ['data' => $data, 'type' => $type, 'typeChild' => $typeChild, 'total' => $total, 'paginate' => $paginate]);
        }
        // IF SLUG IS A POST
        // post
        $post = DB::table('posts')
            ->where('slug', $slug)
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->first();
        if($post) {
            $post->patterns = CommonMethod::replaceText($post->patterns);
            $post->summary = CommonMethod::replaceText($post->summary);
            $post->description = CommonMethod::replaceText($post->description);
            //list tags
            $tags = DB::table('post_tags')
                ->join('post_tag_relations', 'post_tags.id', '=', 'post_tag_relations.tag_id')
                ->select('post_tags.id', 'post_tags.name', 'post_tags.slug')
                ->where('post_tag_relations.post_id', $post->id)
                ->where('post_tags.status', ACTIVE)
                ->orderBy('post_tags.name')
                ->get();
            //list type
            $postTypes = $this->getPostRelated($post->id, [$post->id], $post->type_main_id);
            $postTypesIds = $this->getPostRelated($post->id, [$post->id], $post->type_main_id, 1);
            //list related
            $postRelated = $this->getPostRelated($post->id, $postTypesIds, $post->related);
            //FIRST: type, related
            $typeMain = $this->getPostTypeById($post->type_main_id);
            $related = $this->getPostTypeById($post->related);
            //parent type of typeMain if exist
            if($typeMain->parent_id > 0) {
                $typeMainParent = $this->getPostTypeById($typeMain->parent_id);
            } else {
                $typeMainParent = null;
            }
            //auto meta tag for seo
            $postName = ucwords(mb_strtolower($post->name));
            if(empty($post->meta_title)) {
                $post->meta_title = $postName.' | xemtuoi.vn';
            }
            if(empty($post->meta_keyword)) {
                $postNameNoLatin = CommonMethod::convert_string_vi_to_en($postName);
                $post->meta_keyword = $postName.','.$postNameNoLatin;
            }
            if(empty($post->meta_description)) {
                $post->meta_description = limit_text(strip_tags($post->description), 200);
            }
            //put cache
            $html = view('site.post.show', [
                    'post' => $post, 
                    'tags' => $tags, 
                    'postTypes' => $postTypes, 
                    'postRelated' => $postRelated, 
                    'typeMain' => $typeMain, 
                    'related' => $related, 
                    'typeMainParent' => $typeMainParent, 
                ])->render();
            Cache::forever($cacheName, $html);
            //return view
            return view('site.post.show', [
                    'post' => $post, 
                    'tags' => $tags, 
                    'postTypes' => $postTypes, 
                    'postRelated' => $postRelated, 
                    'typeMain' => $typeMain, 
                    'related' => $related, 
                    'typeMainParent' => $typeMainParent, 
                ]);
        }
        return response()->view('errors.404', [], 404);
    }
    public function page2(Request $request, $slug1, $slug2)
    {
        trimRequest($request);
        $device = getDevice();
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'page_'.$slug1.'_'.$slug2.'_'.$page;
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        $type = $this->getPostTypeBySlug($slug2, 1);
        $typeParent = $this->getPostTypeBySlug($slug1);
        if(isset($type) && isset($typeParent) && ($typeParent->id == $type->parent_id)) {
            $type->patterns = CommonMethod::replaceText($type->patterns);
            $type->summary = CommonMethod::replaceText($type->summary);
            $type->description = CommonMethod::replaceText($type->description);
            if($type->list_posts == ACTIVE) {
                $paginate = 1;
                $data = $this->getPostByRelationsQuery('type', $type->id)->paginate(PAGINATE);
                $total = count($data);
            } else {
                $data = null;
                $paginate = null;
                $total = 0;
            }
            //auto meta tag for seo
            $typeName = ucwords(mb_strtolower($type->name));
            if(empty($type->meta_title)) {
                if($page > 1) {
                    $type->meta_title = $typeName.' trang '.$page.' | xemtuoi.vn';
                } else {
                    $type->meta_title = $typeName.' | xemtuoi.vn';
                }
            }
            if(empty($type->meta_keyword)) {
                $typeNameNoLatin = CommonMethod::convert_string_vi_to_en($typeName);
                $type->meta_keyword = $typeNameNoLatin.','.$typeName;
            }
            if(empty($type->meta_description)) {
                $type->meta_description = $typeName;
            }
            //put cache
            $html = view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate, 'typeParent' => $typeParent])->render();
            Cache::forever($cacheName, $html);
            //return view
            return view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate, 'typeParent' => $typeParent]);
        }
        return response()->view('errors.404', [], 404);
    }
    public function search(Request $request)
    {
        $search = array();
        trimRequest($request);
        if($request->s == '') {
            return view('site.post.search', ['data' => null, 'request' => $request, 'search' => $search]);
        }
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'search_'.$request->s.'_'.$page;
        $device = getDevice();
        if($device == MOBILE) {
            $cacheName = $cacheName.'_mobile';
        }
        //get cache
        if(Cache::has($cacheName)) {
            return Cache::get($cacheName);
        }
        //query
        // post
        $slug = CommonMethod::convert_string_vi_to_en($request->s);
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/i', '-', $slug));
        $data = DB::table('posts')
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->where('slug', 'like', '%'.$slug.'%')
            ->orderBy('start_date', 'desc')
            ->paginate(PAGINATE);
        //auto meta tag for seo
        if($page > 1) {
            $search['meta_title'] = 'Tìm kiếm: '.$request->s.' trang '.$page.' | xemtuoi.vn';
        } else {
            $search['meta_title'] = 'Tìm kiếm: '.$request->s.' | xemtuoi.vn';
        }
        $search['meta_keyword'] = $request->s;
        $search['meta_description'] = $request->s;
        //put cache
        $html = view('site.post.search', ['data' => $data->appends($request->except('page')), 'request' => $request, 'search' => $search])->render();
        Cache::forever($cacheName, $html);
        //return view
        return view('site.post.search', ['data' => $data->appends($request->except('page')), 'request' => $request, 'search' => $search]);
    }
    public function sitemap()
    {
        ///cache name
        $cacheName = 'sitemap';
        //get cache
        if(Cache::has($cacheName)) {
            $content = Cache::get($cacheName);
            return response($content)->header('Content-Type', 'text/xml;charset=utf-8');
        }
        //query
        //put cache
        $html = view('site.sitemap')->render();
        Cache::forever($cacheName, $html);
        //return view
        $content = view('site.sitemap');
        return response($content)->header('Content-Type', 'text/xml;charset=utf-8');
    }
    //asuna: lay tat ca du lieu post (null) / hay chi lay danh sach id cua post (not null)
    private function getPostRelated($id, $ids, $typeId, $asuna = null)
    {
        //lay danh sach posts
        if($asuna == null) {
            //post moi hon
            $post1Query = $this->getPostTypeQuery($id, $ids, $typeId);
            $post1 = $post1Query->get();
            //post cu hon
            $post2Query = $this->getPostTypeQuery($id, $ids, $typeId, 1);
            $post2 = $post2Query->get();
            $posts = array_merge($post1, $post2);
            return $posts;
        }
        //lay danh sach id posts
        else {
            //post moi hon
            $post1Query = $this->getPostTypeQuery($id, $ids, $typeId);
            $post1 = $post1Query->pluck('id');
            //post cu hon
            $post2Query = $this->getPostTypeQuery($id, $ids, $typeId, 1);
            $post2 = $post2Query->pluck('id');
            $posts = array_merge($post1, $post2);
            return $posts;
        }
    }
    //lay ra post cu hon (time not null) va moi hon (time null) theo id
    //id: id post hien tai
    //typeId: id type main / related cua post hien tai. ids: danh sach id da lay ra (tranh trung lap)
    private function getPostTypeQuery($id, $ids, $typeId, $time = null)
    {
        $data = DB::table('posts')
            ->join('post_type_relations', 'posts.id', '=', 'post_type_relations.post_id')
            ->select('posts.id', 'posts.name', 'posts.slug', 'posts.image', 'posts.summary', 'posts.created_at')
            ->where('post_type_relations.type_id', $typeId)
            ->where('posts.status', ACTIVE)
            ->where('posts.start_date', '<=', date('Y-m-d H:i:s'));
        if($time == null) {
            $data = $data->where('posts.id', '>', $id);
        } else {
            $data = $data->where('posts.id', '<', $id);
        }
        $data = $data->whereNotIn('post_type_relations.post_id', $ids)
            ->orderBy('posts.id', 'desc')
            ->take(PAGINATE_RELATED);
        return $data;
    }
    private function getPostTypeByParentIdQuery($id)
    {
        return DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'summary', 'image', 'grid', 'display')
            ->where('status', ACTIVE)
            ->where('parent_id', $id)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name', 'asc');
    }
    private function getPostTypeById($id)
    {
        return DB::table('post_types')
            ->select('id', 'name', 'slug', 'parent_id', 'summary', 'image', 'grid', 'display')
            ->where('id', $id)
            ->where('status', ACTIVE)
            ->first();
    }
    private function getPostTypeBySlug($slug, $hasParentId = null)
    {
        $result = DB::table('post_types')
            ->select('id', 'name', 'slug', 'patterns', 'parent_id', 'summary', 'description', 'image', 'grid', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image', 'display', 'list_posts')
            ->where('slug', $slug)
            ->where('status', ACTIVE);
        if($hasParentId) {
            $result = $result->where('parent_id', '!=', 0);
        } else {
            $result = $result->where('parent_id', 0);
        }
        return $result->first();
    }
    private function getPostByTypeQuery($id, $orderColumn = 'start_date', $orderSort = 'desc')
    {
        $data = DB::table('posts')
            ->select('id', 'name', 'slug', 'image', 'summary', 'description', 'created_at')
            ->where('type_main_id', $id)
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->orderBy($orderColumn, $orderSort);
        return $data;
    }
    private function getPostByRelationsQuery($element, $id, $orderColumn = 'start_date', $orderSort = 'desc')
    {
        $data = DB::table('posts')
            ->join('post_'.$element.'_relations', 'posts.id', '=', 'post_'.$element.'_relations.post_id')
            // ->join('post_'.$element.'s', 'post_'.$element.'_relations.'.$element.'_id', '=', 'post_'.$element.'s.id')
            ->select('posts.id', 'posts.name', 'posts.slug', 'posts.image', 'posts.summary', 'posts.description', 'posts.created_at')
            ->where('post_'.$element.'_relations.'.$element.'_id', $id)
            ->where('posts.status', ACTIVE)
            ->where('posts.start_date', '<=', date('Y-m-d H:i:s'))
            ->orderBy('posts.'.$orderColumn, $orderSort);
        return $data;
    }
    /* 
    * contact
    */
    public function contact(Request $request)
    {
        self::forgetCache('lien-he');
        //
        $ip = get_client_ip();
        $now = strtotime(date('Y-m-d H:i:s'));
        $range = 60; //second
        $time = $now - $range;
        $past = date('Y-m-d H:i:s', $time);
        // check ip with time
        $checkIP = DB::table('contacts')->where('ip', $ip)->where('created_at', '>', $past)->count();
        if($checkIP > 0) {
            return redirect()->back()->with('warning', 'Hệ thống đang bận. Xin bạn hãy thử lại sau ít phút.');
        }
        //
        trimRequest($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'tel' => 'max:255',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'tel' => $request->tel,
                'msg' => $request->msg,
                'ip' => $ip,
            ]);
        return redirect()->back()->with('success', 'Cảm ơn bạn đã gửi thông tin liên hệ cho chúng tôi.');
    }
    // remove cache page if exist message validator
    private function forgetCache($slug)
    {
        //delete cache for contact page before redirect to remove message validator
        $cacheName = 'page_'.$slug.'_1';
        $cacheNameMobile = 'page_'.$slug.'_1_mobile';
        Cache::forget($cacheName);
        Cache::forget($cacheNameMobile);
    }
    //boingaysinh
    public function boingaysinh(Request $request)
    {
        $day = $request->day;
        $month = $request->month;
        $year = $request->year;
        if(isset($day) && isset($month) && isset($year)) {
            $n = $day . $month . $year;
            $x = $n % 10;
            if($x > 0 && $x < 10) {
                return $x;
            }
        }
        return 1;
    }
    //xemboithayphan
    public function xemboithayphan(Request $request)
    {
        $question = $request->question;
        $answer = $request->answer;
        if(isset($question) && isset($answer)) {
            $q = str_split_unicode($question);
            $a = explode(',', $answer);
            $qcount = count($q);
            $acount = count($a);
            if($qcount == 0 || $acount == 0) {
                return 'Mời bạn nhập lại dữ liệu giúp thầy.';
            }
            $s = 0;
            //cong tat ca cac chu cai trong cau hoi vao nhau (sau khi convert sang number = ord)
            for($i = 0; $i < $qcount; $i++) {
                $s += toNumber($q[$i]);
            }
            $sdate = intval(date('j')) + intval(date('n')) + intval(date('Y'));
            //cong them ngay thang nam hien tai
            $s = $s + $sdate;
            //cong nhu tren voi tung cau tra loi
            $aitem = []; $aitemcount = []; $as = []; $ass = [];
            for($i = 0; $i < $acount; $i++) {
                $aitem[$i] = str_split_unicode($a[$i]);
                $aitemcount[$i] = count($aitem[$i]);
                for($j = 0; $j < $aitemcount[$i]; $j++) {
                    $as[$i] = toNumber($aitem[$i][$j]);
                    $ass[$i] = $s % $as[$i];
                }
            }
            $assmax = max($ass);
            $r = array_search($assmax, $ass);
            return 'Thầy khuyên bạn nên chọn câu trả lời là: <strong>' . $a[$r] . '</strong>';
        }
        return 'Xin lỗi bạn. Thầy bó tay không thể phán câu hỏi này của bạn.';
    }
    //xemboiaicap
    public function xemboiaicap(Request $request)
    {
        $fullname = $request->fullname;
        if(isset($fullname)) {
            $n = toNumber($fullname);
            $r = $n % 10;
            if($r > 0 && $r < 10) {
                $data = $r;
            } else {
                $data = 1;
            }
        } else {
            $data = 1;    
        }
        return response()->json($data);
    }

}
