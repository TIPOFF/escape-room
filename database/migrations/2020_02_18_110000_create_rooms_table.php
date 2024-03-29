<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('location'))->index();
            $table->foreignIdFor(app('escaperoom_theme'))->index();
            $table->foreignIdFor(app('escaperoom_rate'))->index(); // Default pricing rate structure for the room. Can be overidden by schedules & slots.
            $table->foreignIdFor(app('supervision')); // Defaults to theme->supervision but this allows each room to have a custom supervision
            $table->date('opened_at');
            $table->date('closed_at')->nullable();
            $table->unsignedTinyInteger('participants'); // Max amount of participants for public games
            $table->unsignedTinyInteger('participants_private'); // Max amount of participants for private games
            $table->unsignedTinyInteger('reset_time'); // Time needed to reset the room in minutes. Can be 15 min on some of the newer rooms.
            $table->unsignedTinyInteger('occupied_time'); // Minutes. Used for scheduling & slot conflicts. Defaults to theme->occupied_time but this allows each room to have a custom time.
            $table->unsignedTinyInteger('priority'); // Used to order the themes on the market page
            $table->text('note')->nullable(); // Shown on website. Internal notes may be made in admin panel using tipoff/notes package
            $table->string('title')->nullable(); // Override of theme title on Market page if needed
            $table->text('excerpt')->nullable(); // Override of theme excerpt on Market page if needed
            $table->text('description')->nullable(); // Override of theme description on Market page if needed
            $table->foreignIdFor(app('image'))->nullable();
            $table->foreignIdFor(app('image'), 'poster_image_id')->nullable(); // Override of theme poster on Market page if needed

            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
