<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('tours', function (Blueprint $table) {
        $table->unsignedBigInteger('guide_id')->after('id');
        $table->string('name')->after('guide_id');
        $table->text('details')->nullable()->after('name');
        $table->string('duration')->nullable()->after('details');
        $table->decimal('amount', 10, 2)->nullable()->after('duration');
        $table->string('picture')->nullable()->after('amount');

        // Optional: Add foreign key constraint if needed
        $table->foreign('guide_id')->references('id')->on('guides')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropForeign(['guide_id']);
            $table->dropColumn(['guide_id', 'name', 'details', 'duration', 'amount', 'picture']);
        });
    }
};
