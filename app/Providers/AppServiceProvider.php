<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use DB;
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
        $config = DB::table('configs')->first();
        view()->share('configcode', $config->code);
        view()->share('configfbappid', $config->facebook_app_id);
        //all menu
        view()->share('topmenu', self::getMenu());
        // self::getMenus(MENUTYPE1, 'topmenu');
        // view()->share('sidemenu', self::getMenu(MENUTYPE2));
        // self::getMenus(MENUTYPE2, 'sidemenu');
        view()->share('bottommenu', self::getMenu(MENUTYPE3));
        // self::getMenus(MENUTYPE3, 'bottommenu');
        self::getMenus(MENUTYPE4, 'mobilemenu');
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
            $output = '<ul class="menu"><li><a href="/"><i class="fa fa-home" aria-hidden="true"></i>
</a></li>';
        } elseif($type==MENUTYPE2) {
            $output = '<ul class="sidemenu">';
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
                $output .= '<li class="'.CommonQuery::checkCurrent(url($value->url)).$classHasChild.'"><a href="'.$value->url.'">'.$value->name.'</a>';
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
