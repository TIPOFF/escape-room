<?php

declare(strict_types=1);

use DrewRoberts\Media\Models\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tipoff\Locations\Models\Location;

class CreateEscapeRoomLocations extends Migration
{
    public function up()
    {
        Schema::create('escape_room_locations', function (Blueprint $table) {
            $table->id();
            $table->boolean('corporate')->default(true); // Mark false for Miami & DC
            $table->string('team_names')->nullable();
            $table->foreignIdFor(app('image'), 'team_image_id')->nullable();
            $table->unsignedTinyInteger('booking_cutoff'); // Minutes before a game/slot to cutoff the booking window.
            $table->boolean('covid')->default(false); // Mark true if location closed due to COVID-19
            $table->boolean('use_iframe')->default(false); // If yes, use the booking iframe below
            $table->text('booking_iframe')->nullable(); // Iframe code for Resova/Bookeo or other 3rd parting booking software
            $table->foreignIdFor(Location::class)->unique();	// NOTE - unique() added -- there should be exactly one record per location!
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
