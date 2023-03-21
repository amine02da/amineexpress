<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("store_id")->constrained("stores")->cascadeOnDelete();
            $table->foreignId("category_id")->nullable()->constrained("categories")->nullOnDelete();
            $table->string("name");
            $table->string("slug")->unique();
            $table->text("description")->nullable();
            $table->string("image")->nullable();
            $table->float("price")->default(0);
            $table->float("compare_price")->nullable(); //fax kndir descount 3la whed prod wknbghi niffichi price 9dim m3a jdid knst3mel had field 
            $table->json("option")->nullable();
            $table->float("rating")->default(0);
            $table->boolean("featured")->default(0);
            $table->enum("status",["active","draft","archived"])->default("active"); //check = had chemp khs idkhl fih ghir hadok 3 lioma =>active-draft-archived
            $table->softDeletes();
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
        Schema::dropIfExists('products');
    }
};
