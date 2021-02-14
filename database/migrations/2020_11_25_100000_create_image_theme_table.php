<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageThemeTable extends Migration
{
    public function up()
    {
        Schema::create('image_theme', function (Blueprint $table) {
            $table->foreignIdFor(app('image'))->index();
            $table->foreignIdFor(app('theme'))->index();
            $table->timestamps();
        });
    }
}
