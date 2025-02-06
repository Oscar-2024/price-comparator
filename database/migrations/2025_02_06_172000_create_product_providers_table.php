<?php

use App\Models\ProductProvider;
use App\Models\Provider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('provider_id')->constrained()->onDelete('cascade');

            $table->string('url'); // URL para hacer scraping

            $table->string('price_path')->nullable(); // XPath del precio
            $table->string('currency_symbol_path')->nullable(); // XPath para el símbolo de la moneda (opcional)

            // Nuevas columnas para manejar JSON-LD
            $table->string('json_ld_price_path')->nullable(); // Path para el precio en JSON-LD
            $table->string('json_ld_currency_symbol_path')->nullable(); // Path para el símbolo de la moneda en JSON-LD (opcional)

            $table->decimal('latest_price', 10, 2)->nullable(); // Precio más reciente
            $table->string('latest_currency')->nullable(); // Moneda del precio más reciente
            $table->timestamp('last_checked_at')->nullable(); // Última vez que se actualizó

            $table->timestamps();
        });

        // iPhone 16 black 128GB for Website1
        ProductProvider::create([
            'product_id' => 1,
            'provider_id' => Provider::Website1,
            'url' => 'http://localhost/websites/website1/iphone-16-negro-128gb.html',
            'price_path' => "//div[@class='price-item-container']/span[@class='price-item']/text()",
            'currency_symbol_path' => "//div[@class='price-item-container']/span[@class='price-item-symbol']/text()",
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // iPhone 16 black 128GB for Website2
        ProductProvider::create([
            'product_id' => 1,
            'provider_id' => Provider::Website2,
            'url' => 'http://localhost/websites/website2/iphone-16-negro-128gb.html',
            'json_ld_price_path' => 'offers.price',
            'json_ld_currency_symbol_path' => 'offers.priceCurrency',
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // iPhone 16 black 128GB for Website3
        ProductProvider::create([
            'product_id' => 1,
            'provider_id' => Provider::Website3,
            'url' => 'http://localhost/websites/website3/iphone-16-negro-128gb.html',
            'price_path' => "//div[@class='price-item-container']/meta[@itemprop='price']/@content",
            'currency_symbol_path' => "//div[@class='price-item-container']/meta[@itemprop='currency']/@content",
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // Xiaomi 14 Ultra 5G Negro 512GB Website1
        ProductProvider::create([
            'product_id' => 2,
            'provider_id' => Provider::Website1,
            'url' => 'http://localhost/websites/website1/xiaomi-14-ultra-5g-negro-512gb.html',
            'price_path' => "//div[@class='price-item-container']/span[@class='price-item']/text()",
            'currency_symbol_path' => "//div[@class='price-item-container']/span[@class='price-item-symbol']/text()",
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // Xiaomi 14 Ultra 5G Negro 512GB Website2
        ProductProvider::create([
            'product_id' => 2,
            'provider_id' => Provider::Website2,
            'url' => 'http://localhost/websites/website2/xiaomi-14-ultra-5g-negro-512gb.html',
            'json_ld_price_path' => 'offers.price',
            'json_ld_currency_symbol_path' => 'offers.priceCurrency',
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // Xiaomi 14 Ultra 5G Negro 512GB Website3
        ProductProvider::create([
            'product_id' => 2,
            'provider_id' => Provider::Website3,
            'url' => 'http://localhost/websites/website3/xiaomi-14-ultra-5g-negro-512gb.html',
            'price_path' => "//div[@class='price-item-container']/meta[@itemprop='price']/@content",
            'currency_symbol_path' => "//div[@class='price-item-container']/meta[@itemprop='currency']/@content",
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // LG UR781 UHD 55" 4K Website1
        ProductProvider::create([
            'product_id' => 3,
            'provider_id' => Provider::Website1,
            'url' => 'http://localhost/websites/website1/lg-ur781-uhd-55-4k.html',
            'price_path' => "//div[@class='price-item-container']/span[@class='price-item']/text()",
            'currency_symbol_path' => "//div[@class='price-item-container']/span[@class='price-item-symbol']/text()",
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // LG UR781 UHD 55" 4K Website2
        ProductProvider::create([
            'product_id' => 3,
            'provider_id' => Provider::Website2,
            'url' => 'http://localhost/websites/website2/lg-ur781-uhd-55-4k.html',
            'json_ld_price_path' => 'offers.price',
            'json_ld_currency_symbol_path' => 'offers.priceCurrency',
            'latest_price' => null,
            'last_checked_at' => null,
        ]);

        // LG UR781 UHD 55" 4K Website3
        ProductProvider::create([
            'product_id' => 3,
            'provider_id' => Provider::Website3,
            'url' => 'http://localhost/websites/website3/lg-ur781-uhd-55-4k.html',
            'price_path' => "//div[@class='price-item-container']/meta[@itemprop='price']/@content",
            'currency_symbol_path' => "//div[@class='price-item-container']/meta[@itemprop='currency']/@content",
            'latest_price' => null,
            'last_checked_at' => null,
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('product_providers');
    }
};
