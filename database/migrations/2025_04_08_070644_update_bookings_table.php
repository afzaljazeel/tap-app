<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('tour_id')->nullable()->after('id');
            $table->unsignedBigInteger('tourist_id')->nullable()->after('tour_id');
            $table->unsignedBigInteger('guide_id')->nullable()->after('tourist_id');
            
            $table->enum('preferred_time', ['Morning', 'Evening', 'Night'])->after('guide_id');
            $table->date('date')->after('preferred_time');
            $table->enum('status', ['Pending', 'Scheduled', 'Ongoing', 'Completed', 'Declined'])->default('Pending')->after('date');
            $table->text('notes')->nullable()->after('status');

            // Foreign keys
            $table->foreign('tour_id')->references('id')->on('tours')->onDelete('cascade');
            $table->foreign('tourist_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('guide_id')->references('id')->on('guides')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['tour_id']);
            $table->dropForeign(['tourist_id']);
            $table->dropForeign(['guide_id']);

            $table->dropColumn([
                'tour_id', 'tourist_id', 'guide_id',
                'preferred_time', 'date', 'status', 'notes'
            ]);
        });
    }
}

