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
            ->select('id', 'name', 'slug', 'summary', 'description', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image')
            ->where('slug', $slug)
            ->where('status', ACTIVE)
            ->first();
        // posts tags
        if(isset($tag)) {
            $data = $this->getPostByRelationsQuery('tag', $tag->id)->paginate(PAGINATE);
            if($data->total() > 0) {
                //auto meta tag for seo
                if(empty($tag->meta_title)) {
                    $tag->meta_title = $tag->name.' | Tổng hợp tử vi xem bói phong thủy tại xemtuoi.vn';
                }
                if(empty($tag->meta_keyword)) {
                    $tagNameNoLatin = CommonMethod::convert_string_vi_to_en($tag->name);
                    $tag->meta_keyword = $tagNameNoLatin.', '.$tag->name;
                }
                if(empty($tag->meta_description)) {
                    $tagNameNoLatin = CommonMethod::convert_string_vi_to_en($tag->name);
                    $tag->meta_description = $tagNameNoLatin.', '.$tag->name.' tại xemtuoi.vn';
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
            $singlePage->summary = CommonMethod::replaceText($singlePage->summary);
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
            if($type->grid == ACTIVE) {
                $paginateNumber = PAGINATE;
            } else {
                $paginateNumber = PAGINATE_GRID;
            }
            $paginate = 1;
            $data = $this->getPostByRelationsQuery('type', $type->id)->paginate($paginateNumber);
            $total = count($data);
            //auto meta tag for seo
            if(empty($type->meta_title)) {
                $type->meta_title = $type->name.' | Tổng hợp tử vi xem bói phong thủy tại xemtuoi.vn';
            }
            if(empty($type->meta_keyword)) {
                $typeNameNoLatin = CommonMethod::convert_string_vi_to_en($type->name);
                $type->meta_keyword = $typeNameNoLatin.', '.$type->name;
            }
            if(empty($type->meta_description)) {
                $typeNameNoLatin = CommonMethod::convert_string_vi_to_en($type->name);
                $type->meta_description = $typeNameNoLatin.', '.$type->name.' tại xemtuoi.vn';
            }
            // lay ra the loai con neu the loai nay ko co bai viet
            if($total <= 0) {
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
                $typeChild = null;
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
            //list tags
            $tags = DB::table('post_tags')
                ->join('post_tag_relations', 'post_tags.id', '=', 'post_tag_relations.tag_id')
                ->select('post_tags.id', 'post_tags.name', 'post_tags.slug')
                ->where('post_tag_relations.post_id', $post->id)
                ->where('post_tags.status', ACTIVE)
                ->orderBy('post_tags.name')
                ->get();
            //list type
            $postTypesQuery = $this->getPostTypeQuery($post->type_main_id, [$post->id]);
            $postTypes = $postTypesQuery->get();
            $postTypesIds = $postTypesQuery->pluck('id');
            //list related
            $postRelatedQuery = $this->getPostTypeQuery($post->related, $postTypesIds);
            $postRelated = $postRelatedQuery->get();
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
            if(empty($post->meta_title)) {
                $post->meta_title = $post->name.' | '.$post->name.' tại xemtuoi.vn';
            }
            if(empty($post->meta_keyword)) {
                $postNameNoLatin = CommonMethod::convert_string_vi_to_en($post->name);
                $post->meta_keyword = $post->name.', '.$postNameNoLatin;
            }
            if(empty($post->meta_description)) {
                $postNameNoLatin = CommonMethod::convert_string_vi_to_en($post->name);
                $post->meta_description = $post->name.', '.$postNameNoLatin;
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
            $paginate = 1;
            $data = $this->getPostByRelationsQuery('type', $type->id)->paginate(PAGINATE);
            $total = count($data);
            if($total > 0) {
                $seriParent = $this->getPostTypeById($type->parent_id);
                //put cache
                $html = view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate, 'seriParent' => $seriParent])->render();
                Cache::forever($cacheName, $html);
                //return view
                return view('site.post.type', ['data' => $data, 'type' => $type, 'total' => $total, 'paginate' => $paginate, 'seriParent' => $seriParent]);
            }
        }
        return response()->view('errors.404', [], 404);
    }
    public function search(Request $request)
    {
        trimRequest($request);
        if($request->name == '') {
            return view('site.post.search', ['data' => null, 'request' => $request]);
        }
        //check page
        $page = ($request->page)?$request->page:1;
        //cache name
        $cacheName = 'search_'.$request->name.'_'.$page;
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
        $slug = CommonMethod::convert_string_vi_to_en($request->name);
        $slug = strtolower(preg_replace('/[^a-zA-Z0-9]+/i', '-', $slug));
        $data = DB::table('posts')
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->where('slug', 'like', '%'.$slug.'%')
            ->orderBy('start_date', 'desc')
            ->paginate(PAGINATE);
        //put cache
        $html = view('site.post.search', ['data' => $data->appends($request->except('page')), 'request' => $request])->render();
        Cache::forever($cacheName, $html);
        //return view
        return view('site.post.search', ['data' => $data->appends($request->except('page')), 'request' => $request]);
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
    private function getPostTypeQuery($id, $ids)
    {
        $data = DB::table('posts')
            ->join('post_type_relations', 'posts.id', '=', 'post_type_relations.post_id')
            ->select('posts.id', 'posts.name', 'posts.slug', 'posts.image', 'posts.summary', 'posts.description', 'posts.created_at')
            ->where('post_type_relations.type_id', $id)
            ->where('posts.status', ACTIVE)
            ->where('posts.start_date', '<=', date('Y-m-d H:i:s'))
            ->whereNotIn('post_type_relations.post_id', $ids)
            ->orderBy('posts.start_date', 'desc')
            ->take(PAGINATE_BOX);
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
            ->select('id', 'name', 'slug', 'parent_id', 'summary', 'description', 'image', 'grid', 'meta_title', 'meta_keyword', 'meta_description', 'meta_image', 'display')
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
    private function forgetCache($slug) {
        //delete cache for contact page before redirect to remove message validator
        $cacheName = 'page_'.$slug.'_1';
        $cacheNameMobile = 'page_'.$slug.'_1_mobile';
        Cache::forget($cacheName);
        Cache::forget($cacheNameMobile);
    }
}
