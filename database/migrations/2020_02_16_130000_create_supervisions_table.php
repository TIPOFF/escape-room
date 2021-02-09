<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisionsTable extends Migration
{
    public function up()
    {
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Internal reference name
            $table->string('title'); // Shows to customers.
            $table->string('slug')->unique()->index();
            $table->string('excerpt')->nullable(); // Shown on website
            $table->text('description')->nullable(); // Shown on website. Written in Markdown.
            $table->text('details')->nullable(); // Written in Markdown. Detailed explanation of the supervision style, could be used later on the website.
            $table->timestamps();
        });
    }
}
