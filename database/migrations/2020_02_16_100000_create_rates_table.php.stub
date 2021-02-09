<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Internal reference name
            $table->string('slug')->unique()->index();

            $table->unsignedInteger('public_1')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_2')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_3')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_4')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_5')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_6')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_7')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_8')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_9')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('public_10')->default(4800); // In cents. Price per participant.

            $table->unsignedInteger('private_1')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_2')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_3')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_4')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_5')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_6')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_7')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_8')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_9')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_10')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_11')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_12')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_13')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_14')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_15')->default(4800); // In cents. Price per participant.
            $table->unsignedInteger('private_16')->default(4800); // In cents. Price per participant.

            $table->foreignIdFor(app('user'), 'creator_id');
            $table->foreignIdFor(app('user'), 'updater_id');
            $table->timestamps();
        });
    }
}
