<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('submission_number')->unsigned()->unique()->nullable(); // ⬅️ AFTER हटाउनुहोस्

            $table->enum('name_type', ['individual', 'group']);
            $table->string('name');
            $table->enum('gender', ['male', 'female', 'third_gender', 'others']);
            $table->enum('age_group', ['below_16', '16_39', '40_59', '60_above']);
            $table->string('contact_number');
            $table->string('email')->nullable();

            $table->enum('complaint_type', ['corruption', 'illegal_property']);
            $table->text('subject_of_complaint');
            $table->enum('corruption_domain', ['province', 'local']);
            $table->string('against_person_or_institution');
            $table->text('additional_info')->nullable();
            $table->string('uploaded_file')->nullable();
            $table->boolean('terms_accepted')->default(false);

            $table->enum('status', ['Processing', 'Holding', 'Finished'])->default('Processing'); // ⬅️ AFTER हटाउनुहोस्

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
