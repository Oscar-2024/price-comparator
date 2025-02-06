<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // iPhone 16 Negro
        Product::create([
            'name' => 'iPhone 16 Negro 128BG',
            'description' => 'El iPhone 16 en su versión de 128 GB y color Negro sigue el estilo elegante y minimalista característico de Apple. Se espera que el dispositivo presente un diseño refinado, con bordes más delgados y acabados en vidrio y aluminio de alta calidad, ofreciendo una apariencia sofisticada y moderna. En términos de pantalla, Apple probablemente continúe usando una pantalla OLED de alta resolución, brindando colores intensos y negros profundos, perfecta para ver contenido en alta calidad.<br /><br />El rendimiento del iPhone 16 se espera que esté potenciado por un chip avanzado de Apple, optimizado para ejecutar aplicaciones y tareas de inteligencia artificial, garantizando velocidad y eficiencia energética. Las cámaras seguramente incluyan nuevas mejoras, con la tecnología de procesamiento de imagen de Apple para capturas en condiciones de poca luz y detalles más nítidos. Con una capacidad de 128 GB, el almacenamiento es ideal para usuarios con necesidades de espacio moderadas, permitiendo guardar fotos, videos y aplicaciones sin problemas de espacio.',
            'image_url' => '/images/products/iphone-16-black-128gb.png',
        ]);

        // Xiaomi 14 Ultra 5G Negro 512GB
        Product::create([
            'name' => 'Xiaomi 14 Ultra 5G Negro 512GB',
            'description' => 'El Xiaomi 14 Ultra 5G en color Negro con 512 GB de almacenamiento es un dispositivo premium que combina un diseño robusto con especificaciones de alto rendimiento. La versión Ultra de Xiaomi suele enfocarse en una construcción duradera y de lujo, utilizando materiales de alta calidad, como vidrio y metal, y acabados en negro mate o brillante que le otorgan un aspecto sofisticado.<br /><br />Este modelo probablemente cuente con una gran pantalla AMOLED de alta resolución, ofreciendo colores vibrantes, excelente contraste y una alta tasa de refresco (120 Hz o superior) para una experiencia visual fluida y atractiva, ideal para juegos y videos en alta calidad. El almacenamiento masivo de 512 GB es ideal para aquellos que necesitan un amplio espacio para fotos, videos, aplicaciones y archivos pesados.<br /><br />En cuanto a cámaras, el Xiaomi 14 Ultra suele contar con un sistema fotográfico avanzado, con múltiples lentes y sensores desarrollados en colaboración con Leica, diseñados para capturar imágenes de alta calidad incluso en condiciones de poca luz. El sistema de cámaras puede incluir un sensor principal de gran resolución, un ultra gran angular, un teleobjetivo de alta potencia y funciones avanzadas de fotografía computacional para capturas más detalladas.<br /><br />El rendimiento del dispositivo está respaldado por el último chip de alta gama de Qualcomm, junto con la conectividad 5G, lo que garantiza velocidades rápidas de navegación y un funcionamiento fluido incluso en aplicaciones exigentes. Con una batería de larga duración y soporte para carga rápida e inalámbrica, el Xiaomi 14 Ultra 5G es una opción potente para usuarios que buscan lo último en tecnología móvil y almacenamiento.',
            'image_url' => '/images/products/Xiaomi-14-5G-Ultra-Negro-512GB.png',
        ]);

        // LG-UR781-UHD-55-4K
        Product::create([
            'name' => 'LG-UR781-UHD-55-4K',
            'description' => "El LG UR781 UHD 55\" 4K es un televisor que ofrece una calidad de imagen Ultra HD 4K, ideal para disfrutar de contenido con detalles nítidos y colores realistas. Con una pantalla de 55\" pulgadas, este modelo proporciona una experiencia inmersiva, perfecta para salas de estar de tamaño mediano a grande. La resolución 4K asegura una imagen cuatro veces más detallada que Full HD, destacando en nitidez, contraste y profundidad, especialmente en contenido optimizado para 4K.<br /><br />El televisor LG UR781 también incluye la tecnología HDR (High Dynamic Range), que mejora el rango de colores y el brillo, resaltando detalles en escenas tanto oscuras como brillantes para una experiencia visual más realista. Este modelo suele integrar WebOS, el sistema operativo de LG, que permite acceder fácilmente a aplicaciones populares de streaming, como Netflix, YouTube, y Disney+, además de otras funciones inteligentes.<br /><br />El procesador 4K de LG optimiza las imágenes, mejorando la claridad y reduciendo el ruido visual, lo cual es ideal para disfrutar de contenido de alta calidad. Además, cuenta con varias opciones de conectividad, incluyendo puertos HDMI y USB, permitiendo conectar consolas de videojuegos, dispositivos de streaming, o unidades de almacenamiento externas.<br /><br />El LG UR781 UHD 55\" 4K es una excelente opción para quienes buscan un televisor de alta calidad, con buena resolución y una experiencia de entretenimiento completa y accesible.",
            'image_url' => '/images/products/LG-UR781-UHD-55-4K.png',
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
