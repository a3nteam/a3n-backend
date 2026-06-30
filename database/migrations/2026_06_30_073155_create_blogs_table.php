<?php

use App\Enum\BlogSource;
use App\Enum\BlogStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
    $table->uuid('id')->primary();

    // AutoSEO
    $table->unsignedBigInteger('autoseo_id')->nullable()->unique();

    // Content
    $table->string('title');
    $table->string('slug')->unique();
    $table->longText('content');
    $table->text('excerpt')->nullable();
    $table->text('description')->nullable();

    // SEO
    $table->string('keywords')->nullable();
    $table->text('meta_keywords')->nullable();

    // Publishing
    $table->enum('status', array_column(BlogStatus::cases(), 'value'))
        ->default(BlogStatus::DRAFT->value);
    $table->timestamp('published_at')->nullable();

    // Assets
    $table->string('hero_image')->nullable();
    $table->string('info_graphic_image')->nullable();

    // Misc
    $table->string('language', 10)->default('en');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
