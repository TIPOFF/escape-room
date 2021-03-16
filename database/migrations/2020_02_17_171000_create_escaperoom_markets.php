<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tipoff\Locations\Models\Location;

class CreateEscaperoomMarkets extends Migration
{
    public function up()
    {
        Schema::create('escaperoom_markets', function (Blueprint $table) {
            $table->id();

            $table->boolean('corporate')->default(true);

            $table->text('rooms_content')->nullable(); // Market specific content for /escape-rooms page. Written in Markdown.
            $table->text('faq_content')->nullable(); // Frequently Asked Questions about the market (such as where to park at each location in the market). Written in Markdown.
            $table->text('competitors_content')->nullable(); // Nice paragraph about the other escape rooms in each market. First used on /escape-rooms page. Written in Markdown.

            $table->foreignIdFor(Location::class)->unique();	// NOTE - unique() added -- there should be exactly one record per location!
            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');

            $table->timestamps();
        });
    }
}
