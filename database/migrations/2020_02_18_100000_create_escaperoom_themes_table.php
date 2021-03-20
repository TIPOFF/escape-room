<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tipoff\EscapeRoom\Models\Supervision;

class CreateEscaperoomThemesTable extends Migration
{
    public function up()
    {
        Schema::create('escaperoom_themes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique()->index();
            $table->string('name')->unique();
            $table->string('title')->unique();
            $table->string('full_title')->unique();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->text('synopsis')->nullable();
            $table->text('story')->nullable();
            $table->text('info')->nullable(); // Additional information about escape rooms with this theme. Used for note to display on frontend of website
            $table->unsignedTinyInteger('duration'); // Minutes
            $table->unsignedTinyInteger('occupied_time'); // Minutes. Typically is duration of theme plus a reset/cleanup time. In some cases, groups can be staggered into room at intervals less than duration.
            $table->unsignedTinyInteger('scavenger_level')->nullable(); // 1-5 scale
            $table->unsignedTinyInteger('puzzle_level')->nullable(); // 1-5 scale
            $table->unsignedTinyInteger('escape_rate')->nullable(); // 0-100% scale
            $table->foreignIdFor(app('image'))->nullable();
            $table->foreignIdFor(app('video'))->nullable();
            $table->foreignIdFor(app('image'), 'poster_image_id')->nullable();
            $table->foreignIdFor(app('image'), 'icon_id')->nullable();
            $table->foreignIdFor(app('supervision'), 'supervision_id');

            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
