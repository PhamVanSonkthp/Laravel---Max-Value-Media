<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSingleImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('single_images', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('image_name');
            $table->string('table')->nullable();
            $table->bigInteger('relate_id')->index();
            $table->tinyInteger('status_image_id')->default(0);
            $table->boolean('is_public')->default(1);

            $table->bigInteger('priority')->default(0)->index();
            $table->bigInteger('created_by_id')->default(0);
            $table->timestamps();
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('single_images');
    }
}
