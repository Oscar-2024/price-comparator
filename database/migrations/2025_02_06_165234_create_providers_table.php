<?php

use App\Models\Provider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });

        Provider::insert([
            [
                'id' => Provider::Website1,
                'name' => 'Website1',
                'logo_url' => '/images/providers/logo-website1.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Provider::Website2,
                'name' => 'Website2',
                'logo_url' => '/images/providers/logo-website2.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Provider::Website3,
                'name' => 'Website3',
                'logo_url' => '/images/providers/logo-website3.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
