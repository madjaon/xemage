<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCrawlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawlers', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->increments('id');
            $table->string('name'); // ten mau crawl
            $table->string('source'); // source domain, de trong neu khong co
            $table->integer('slug_type')->default(ACTIVE); // lay slug theo tieu de bai viet lay duoc hay theo link nguon bai viet
            $table->text('post_slugs'); // danh sach slug tuong ung voi danh sach link - post_links
            $table->integer('title_type')->default(ACTIVE); // cach lay tieu de bai viet
            $table->text('post_titles'); // danh sach tieu de bai viet tuong ung
            $table->text('post_links'); // 1 hoac nhieu. neu nhieu links thi phai cung 1 mau trang
            $table->text('category_link'); // link trang category dau tien
            $table->text('category_page_link'); // link trang 2 (phan trang)
            $table->integer('category_page_number'); // so luong trang trong category
            $table->string('category_post_link_pattern'); //mau the chua link cua post trong trang category, ex: div.post h2.title a
            $table->integer('type_main_id'); // type_main_id cua post
            $table->integer('type')->default(CRAW_POST); // type cua mau lay tin
            $table->string('image_dir'); // thu muc chua image avatar cua post
            $table->string('image_pattern'); // mau the chua image avatar cua post
            $table->integer('image_check')->default(CRAW_POST_IMAGE); // lay anh tu trang chi tiet hay chuyen muc
            $table->integer('title_post_check')->default(CRAW_TITLE_POST); // lay tieu de post tu trang chi tiet hay chuyen muc
            $table->string('title_pattern'); // mau the chua title cua post
            $table->string('description_pattern'); // mau the chua desc cua post
            $table->text('description_pattern_delete'); // mau the can xoa trong desc cua post, cach nhau = dau phay
            $table->string('element_delete'); // xoa element cu the nao do trong desc, dung trong truong hop ko co class hay id cu the, the giong voi cac the binh thuong khac, su dung = cach xac dinh theo vi tri de xoa (vi tri: element_delete_positions), de trong neu k co
            $table->string('element_delete_positions'); // vi tri xoa element, cach nhau = dau phay, de trong neu khong co
            // ex: $element->find('p', 0)->outertext=''; // xoa p o vi tri dau tien
            // $element->find('p', 1)->outertext=''; // xoa p o vi tri thu 2
            // $element->find('p', -1)->outertext=''; // xoa p o vi tri cuoi cung
            $table->integer('count_get'); // so lan crawl data
            $table->string('time_get'); // thoi gian crawl data gan nhat
            $table->string('start_date'); // thoi gian dang bai
            $table->integer('status')->default(INACTIVE); // trang thai dang bai
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('crawlers');
    }
}
