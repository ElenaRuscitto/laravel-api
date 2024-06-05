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
        Schema::table('projects', function (Blueprint $table) {
            //creo la colonna della Foreign Key
            $table->unsignedBigInteger('type_id')->nullable()->after('id');
            // assegno la Foreign Key alla colonna creata
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //elimino la FK
            //elimino in base al nome della colonna della FK
            $table->dropForeign(['type_id']);
            // elimino la colonna
            $table->dropColumn('type_id');
        });
    }
};
