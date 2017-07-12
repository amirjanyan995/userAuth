<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('categoryID');
            $table->string('categoryName',255);
        });
        $category = array(
            array(
                'categoryID'=>null,
                'categoryName'=>'Music'
            ),
            array(
                'categoryID'=>null,
                'categoryName'=>'Sport'
            ),
            array(
                'categoryID'=>null,
                'categoryName'=>'Art'
            ),
            array(
                'categoryID'=>null,
                'categoryName'=>'Books'
            ),
            array(
                'categoryID'=>null,
                'categoryName'=>'Education'
            ),
            array(
                'categoryID'=>null,
                'categoryName'=>'Travel'
            )
        );
        DB::table('category')->insert($category);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
