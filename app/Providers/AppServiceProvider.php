<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
use Cache;
use Request;
use App\Helpers\CommonQuery;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //get config data
        if(Cache::has('configsite')) {
            $config = Cache::get('configsite');
        } else {
            $config = DB::table('configs')->first();
            Cache::forever('configsite', $config);
        }
        view()->share('configcode', $config->code);
        view()->share('configfbappid', $config->facebook_app_id);
        //all menu
        //current url
        $currentUrl = Request::url();
        $urlArray = parse_url($currentUrl);
        if(!empty($urlArray) && !empty($urlArray['path'])) {
            $path = str_replace('/', '-', $urlArray['path']);
        } else {
            $path = '';
        }
        if(Cache::has('menutype1'.$path)) {
            $menutype1 = Cache::get('menutype1'.$path);
        } else {
            $menutype1 = self::getMenu();
            Cache::forever('menutype1'.$path, $menutype1);
        }
        view()->share('topmenu', $menutype1);
        // if(Cache::has('menutype2')) {
        //     $menutype2 = Cache::get('menutype2');
        // } else {
        //     $menutype2 = self::getMenu(MENUTYPE2);
        //     Cache::forever('menutype2', $menutype2);
        // }
        // view()->share('sidemenu', self::getMenu(MENUTYPE2));
        if(Cache::has('menutype3')) {
            $menutype3 = Cache::get('menutype3');
        } else {
            $menutype3 = self::getMenu(MENUTYPE3);
            Cache::forever('menutype3', $menutype3);
        }
        view()->share('bottommenu', $menutype3);
        if(Cache::has('menutype4'.$path)) {
            $menutype4 = Cache::get('menutype4'.$path);
        } else {
            $menutype4 = self::getMenu(MENUTYPE4);
            Cache::forever('menutype4'.$path, $menutype4);
        }
        view()->share('mobilemenu', $menutype4);
    }

    private function getArchives($orderColumn = 'start_date', $orderSort = 'desc', $limit = PAGINATE_SIDE)
    {
        $data = DB::table('posts')
            ->select('id', 'name', 'slug', 'summary', 'image')
            ->where('status', ACTIVE)
            ->where('start_date', '<=', date('Y-m-d H:i:s'))
            ->limit($limit)
            ->orderBy($orderColumn, $orderSort)
            ->get();
        return $data;
    }

    private function getMenus($type, $name)
    {
        $menu = DB::table('menus')
            ->where('type', $type)
            ->where('status', ACTIVE)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name')
            ->get();
        view()->share($name, $menu);
    }

    private function getMenu($type=MENUTYPE1)
    {
        $data = DB::table('menus')
            ->select('id', 'name', 'url', 'parent_id', 'level', 'position')
            ->where('type', $type)
            ->where('status', ACTIVE)
            ->orderByRaw(DB::raw("position = '0', position"))
            ->orderBy('name')
            ->get();
        if($type==MENUTYPE1  || $type==MENUTYPE3) {
            $output = '<ul class="menu"><li><a href="'.url('/').'"><i class="fa fa-home" aria-hidden="true"></i>
</a></li>';
        } else {
            $output = '<ul>';
        }
        $output .= self::_visit($data, $type);
        $output .= '</ul>';
        return $output;
    }
    private function _visit($data, $type=MENUTYPE1, $parentId=0)
    {
        $output = '';
        $sub = self::_sub($data, $parentId);
        if(count($sub) > 0) {
            foreach($sub as $value) {
                $hasChild = self::_hasChild($value->id);
                $classHasChild = ($hasChild)?' hasChild':'';
                $output .= '<li class="'.CommonQuery::checkCurrent(url($value->url)).$classHasChild.'"><a href="'.url($value->url).'">'.$value->name.'</a>';
                if($hasChild) {
                    if($type==MENUTYPE1) {
                        $output .= '<ul class="submenu">';
                    } else {
                        $output .= '<ul>';
                    }
                    $output .= self::_visit($data, $type, $value->id);
                    $output .= '</ul></li>';    
                } else {
                    $output .= '</li>';
                }
            }
        }
        return $output;
    }
    private function _sub($data, $parentId)
    {
        $sub = array();
        if(isset($data)) {
            foreach($data as $key => $value) {
                if ($value->parent_id == $parentId) {$sub[$key] = $value;}
            }
        }
        return $sub;
    }
    private function _hasChild($id)
    {
        $data = DB::table('menus')
            ->where('parent_id', $id)
            ->where('status', ACTIVE)
            ->first();
        if($data) {
            return true;
        } else {
            return null;
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
