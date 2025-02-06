<?php

namespace App\Console\Commands;

use App\Models\ProductProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WebScrapingProductPrices extends Command
{
    protected $signature = 'web-scraping:prices {product_id?}';

    protected $description = 'Obtenemos el precio del producto de un proveedor';

    public function handle(): void
    {
        $productId = $this->argument('product_id');

        $productProviders = match ($productId) {
            null => ProductProvider::all(),
            default => ProductProvider::where('product_id', $productId)->get(),
        };

        foreach ($productProviders as $productProvider)
        {
            $this->info("Procesando proveedor: {$productProvider->id} para el producto {$productProvider->product->name}");

            try {
                // definir headers para evitar ser bloqueado
                $headers = [
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/58.0.3029.110 Safari/537.3',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Encoding' => 'gzip, deflate, sdch',
                    'Accept-Language' => 'es-ES,es;q=0.8',
                ];
                $response = Http::withHeaders($headers)->get($productProvider->url);

                if ($response->successful())
                {
                    $htmlContent = $response->body();

                    if ($productProvider->price_path && $productProvider->currency_symbol_path)
                    {
                        $price = $this->getValueFromXPath($htmlContent, $productProvider->price_path);
                        $currency = $this->getValueFromXPath($htmlContent, $productProvider->currency_symbol_path);

                        if ($price)
                        {
                            $this->updateProductProvider($productProvider, $price, $this->normalizeCurrency($currency));
                            continue;
                        }
                    }

                    if ($productProvider->json_ld_price_path)
                    {
                        $price = $this->getValueFromJsonLD($htmlContent, $productProvider->json_ld_price_path);
                        $currency = $this->getValueFromJsonLD($htmlContent, $productProvider->json_ld_currency_symbol_path);

                        if ($price)
                        {
                            $this->updateProductProvider($productProvider, $price, $this->normalizeCurrency($currency));
                            continue;
                        }
                    }
                }

                $this->error("No se pudo obtener el precio para el proveedor {$productProvider->id}.");
            } catch (\Exception $e) {
                $this->error("Ocurrió un error al procesar el proveedor {$productProvider->id}: " . $e->getMessage());
            }
        }
    }

    private function updateProductProvider(ProductProvider $productProvider, string $price, ?string $currency): void
    {
        $this->info("Precio encontrado: " . $price . ' ' . $currency);

        $productProvider->update([
            'latest_price' => $price,
            'latest_currency' => $currency,
            'last_checked_at' => now(),
        ]);
    }

    private function getValueFromXPath($htmlContent, $xPath): ?string
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($htmlContent); // Desactivar warnings por HTML no válido
        $xpath = new \DOMXPath($dom);

        $node = $xpath->query($xPath);

        if ($node->length > 0) {
            return $node->item(0)->nodeValue;
        }

        return null;
    }

    private function getValueFromJsonLD($htmlContent, $jsonLdPath): ?string
    {
        preg_match('/<script[^>]*type="application\/ld\+json"[^>]*>(.*?)<\/script>/s', $htmlContent, $matches);

        if (isset($matches[1]))
        {
            $jsonLdData = json_decode($matches[1], true);

            return data_get($jsonLdData, $jsonLdPath);
        }

        return null;
    }

    private function normalizeCurrency(string $currency = 'EUR'): string
    {
        $currency = strtolower($currency);

        return match ($currency) {
            'dollar', 'usd', '$' => 'USD',
            'pound', 'gbp', '£' => 'GBP',
            default => 'EUR',
        };
    }
}
