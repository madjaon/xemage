<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Crawler extends Model
{
    protected $fillable = [
        'name', 'source', 'post_links', 'category_link', 'category_page_link', 'category_page_number', 'category_post_link_pattern', 'type_main_id', 'type', 'image_dir', 'image_pattern', 'image_check', 'title_pattern', 'description_pattern', 'description_pattern_delete', 'element_delete', 'element_delete_positions', 'count_get', 'time_get', 'start_date', 'status', 
    ];
}
