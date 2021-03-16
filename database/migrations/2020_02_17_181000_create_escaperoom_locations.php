<?php

declare(strict_types=1);

use DrewRoberts\Media\Models\Image;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscaperoomLocations extends Migration
{
    public function up()
    {
        Schema::create('escaperoom_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(app('location'))->unique();	// NOTE - unique() added -- there should be exactly one record per location!
            $table->boolean('corporate')->default(true);
            $table->boolean('covid')->default(false); // Mark true if location closed due to COVID-19
            
            $table->string('team_names')->nullable();
            $table->foreignIdFor(app('image'), 'team_image_id')->nullable();
            
            $table->unsignedTinyInteger('booking_cutoff'); // Minutes before a game/slot to cutoff the booking window.
            $table->boolean('use_iframe')->default(false); // If yes, use the booking iframe below
            $table->text('booking_iframe')->nullable(); // Iframe code for 3rd parting booking software
            
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
