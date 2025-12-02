<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear superadmin
        User::create([
            'name' => 'Super Administrador',
            'email' => 'superadmin@hyperzas.com',
            'password' => Hash::make('super123'),
            'role' => 'superadmin'
        ]);

        // Crear usuarios de prueba
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@hyperzas.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Francisco',
            'email' => 'fran@hyperzas.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Mafer',
            'email' => 'mafer@hyperzas.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        // Crear productos basados en la imagen
        $products = [
            [
                'name' => 'MS365 Business Standar (No Teams)',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 105.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => 'Outlook, Onedrive 1TB, Office 365, Clipchamp, Sharepoint (Por usuario)',
                'active' => true
            ],
            [
                'name' => 'MS365 Business Standar (Con Teams)',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 140.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => 'Outlook, Onedrive 1TB, Office 365, Clipchamp, Sharepoint, Teams (Por usuario)',
                'active' => true
            ],
            [
                'name' => 'Sección web informativa',
                'type' => 'Venta única',
                'quantity' => 1,
                'price' => 200.00,
                'currency' => 'PEN',
                'duration' => '-',
                'billing' => 'Única',
                'details' => '',
                'active' => true
            ],
            [
                'name' => 'Implementación del diseño',
                'type' => 'Venta única',
                'quantity' => 1,
                'price' => 500.00,
                'currency' => 'PEN',
                'duration' => '-',
                'billing' => 'Única',
                'details' => 'Integración del diseño web adaptado al branding de la empresa',
                'active' => true
            ],
            [
                'name' => 'Hosting Web Básico',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 120.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => '30GB Espacio Web, 5 Correos Web (No Outlook), 2GB por correo web, Ancho de Banda Mensua 500,000 MB',
                'active' => true
            ],
            [
                'name' => 'Hosting Web Pyme',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 150.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => '50GB Espacio Web, 10 Correos Web (No Outlook), 7 Subdominios, 3GB por correo web, Ancho de Banda Mensua 700,000 MB',
                'active' => true
            ],
            [
                'name' => 'Hosting Web Enterprise',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 240.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => '70GB Espacio Web, 20 Correos Web (No Outlook), Subdominios ilimitados, 7GB por correo web, Ancho de Banda Mensual 1TB',
                'active' => true
            ],
            [
                'name' => 'Webmaster',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 300.00,
                'currency' => 'PEN',
                'duration' => '1 Mes',
                'billing' => 'Mensual',
                'details' => 'Administración del sitio web y soporte continuo, actualizaciones. Incluye publicar contenido y/o editar 1 vez por semana del sitio web',
                'active' => true
            ],
            [
                'name' => 'Webmaster',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 2999.00,
                'currency' => 'PEN',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => 'Administración del sitio web y soporte continuo, actualizaciones. Incluye publicar contenido y/o editar 1 vez por semana del sitio web',
                'active' => true
            ],
            [
                'name' => 'Dominio .COM .NET',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 25.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => 'Compra e instalación del dominio',
                'active' => true
            ],
            [
                'name' => 'Dominio .COM.PE .PE',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 80.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => 'Compra e instalación del dominio',
                'active' => true
            ],
            [
                'name' => 'Ecommerce',
                'type' => 'Venta única',
                'quantity' => 1,
                'price' => 1500.00,
                'currency' => 'PEN',
                'duration' => '-',
                'billing' => 'Única',
                'details' => 'Creación de sección tienda online, pasarela de pago izipay, y servicio de subida de 30 productos iniciales (Incluye capacitación)',
                'active' => true
            ],
            [
                'name' => 'Subida de productos Ecommerce',
                'type' => 'Venta única',
                'quantity' => 1,
                'price' => 500.00,
                'currency' => 'PEN',
                'duration' => '-',
                'billing' => 'Única',
                'details' => 'Subida de 50 productos a la tienda online',
                'active' => true
            ],
            [
                'name' => '5Kontrol',
                'type' => 'Suscripción',
                'quantity' => 1,
                'price' => 30.00,
                'currency' => 'USD',
                'duration' => '1 Año',
                'billing' => 'Anual',
                'details' => 'Sistema de control de asistencias con reconocimiento facial. Precio por empleado.',
                'active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
