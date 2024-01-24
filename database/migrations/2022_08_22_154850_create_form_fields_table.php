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
        Schema::create('form_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('number')->nullable();
            $table->string('type');
            $table->string('unit');
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('field_category_id');
            $table->json('select_fields')->nullable();
            $table->boolean('required')->default(0);
            $table->boolean('is_numeric')->default(0);
            $table->float('min')->default(0);
            $table->float('max')->default(10000);
            $table->float('step', 5, 4)->default(1);
            $table->string('placeholder')->nullable();
            $table->string('hint')->nullable();
            $table->string('class')->nullable();
            $table->text('formula')->nullable();
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
        Schema::dropIfExists('form_fields');
    }
};
