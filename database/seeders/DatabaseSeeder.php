<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Promo;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $usersData = [
            ['name' => 'Admin Warung', 'email' => 'warung@example.com', 'phone' => '+62 812 3456 7890', 'role' => 'umkm',
             'store' => ['name' => 'Warung Nusantara', 'category' => 'Kuliner', 'description' => 'Warung Nusantara menyajikan makanan khas dari berbagai daerah Indonesia. Kami menggunakan bahan-bahan segar pilihan untuk menjaga cita rasa autentik.', 'address' => 'Jl. Sudirman No. 12', 'city' => 'Jakarta Selatan', 'phone' => '+62 812 3456 7890', 'instagram' => '@warungnusantara'],
             'products' => [
                 ['name' => 'Nasi Gudeg Istimewa', 'category' => 'Makanan', 'price' => 35000, 'description' => 'Nasi Gudeg Istimewa disajikan dengan nangka muda berbumbu khas Yogyakarta, dilengkapi dengan telur pindang, ayam kampung opor, dan sambel goreng krecek.', 'social_link' => '@warungnusantara/gudeg'],
                 ['name' => 'Soto Betawi Spesial', 'category' => 'Makanan', 'price' => 42000, 'description' => 'Soto Betawi dengan kuah santan gurih dan daging sapi pilihan yang empuk.', 'social_link' => '@warungnusantara/soto'],
                 ['name' => 'Rendang Padang', 'category' => 'Makanan', 'price' => 55000, 'description' => 'Rendang daging sapi dengan bumbu rempah-rempah pilihan khas Padang.', 'social_link' => '@warungnusantara/rendang'],
                 ['name' => 'Gado-gado Jakarta', 'category' => 'Makanan', 'price' => 28000, 'description' => 'Gado-gado segar dengan bumbu kacang khas Jakarta.', 'social_link' => '@warungnusantara/gado'],
                 ['name' => 'Nasi Campur Bali', 'category' => 'Makanan', 'price' => 38000, 'description' => 'Nasi campur khas Bali dengan lauk pilihan.', 'social_link' => '@warungnusantara/nasibali'],
                 ['name' => 'Bakso Premium Solo', 'category' => 'Makanan', 'price' => 32000, 'description' => 'Bakso sapi premium khas Solo dengan kuah kaldu spesial.', 'social_link' => '@warungnusantara/bakso'],
             ],
             'promos' => [
                 ['title' => 'Diskon 20% Produk Makanan', 'code' => 'MAKAN20', 'promo_link' => '#', 'expires_at' => '2025-12-31', 'status' => 'aktif'],
             ]
            ],
            ['name' => 'Admin Batik', 'email' => 'batik@example.com', 'phone' => '+62 813 1234 5678', 'role' => 'umkm',
             'store' => ['name' => 'Batik Sari Yogya', 'category' => 'Fashion', 'description' => 'Koleksi batik modern dengan motif tradisional yang elegan dan berkelas dari pengrajin pilihan Yogyakarta.', 'address' => 'Jl. Malioboro No. 5', 'city' => 'Yogyakarta', 'phone' => '+62 813 1234 5678', 'instagram' => '@batiksariyogya'],
             'products' => [
                 ['name' => 'Batik Tulis Motif Parang', 'category' => 'Fashion', 'price' => 350000, 'description' => 'Batik tulis tangan dengan motif parang khas Yogyakarta.', 'social_link' => '@batiksari/parang'],
                 ['name' => 'Kebaya Batik Modern', 'category' => 'Fashion', 'price' => 450000, 'description' => 'Kebaya batik modern untuk berbagai kesempatan.', 'social_link' => '@batiksari/kebaya'],
             ],
             'promos' => [
                 ['title' => 'Gratis Ongkir Min. Rp50.000', 'code' => 'ONGKIR0', 'promo_link' => '#', 'expires_at' => '2025-12-25', 'status' => 'aktif'],
                 ['title' => 'Flash Sale Sabtu-Minggu', 'code' => 'FLASH50', 'promo_link' => '#', 'expires_at' => '2024-12-15', 'status' => 'berakhir'],
             ]
            ],
            ['name' => 'Admin Anyaman', 'email' => 'anyaman@example.com', 'phone' => '+62 811 9876 5432', 'role' => 'umkm',
             'store' => ['name' => 'Anyaman Indah', 'category' => 'Kerajinan', 'description' => 'Produk anyaman berkualitas tinggi dari pengrajin lokal berpengalaman Bandung.', 'address' => 'Jl. Kerajinan No. 8', 'city' => 'Bandung', 'phone' => '+62 811 9876 5432', 'instagram' => '@anyamanindah'],
             'products' => [
                 ['name' => 'Tas Anyaman Rotan', 'category' => 'Kerajinan', 'price' => 185000, 'description' => 'Tas anyaman rotan asli handmade dari pengrajin lokal.', 'social_link' => '@anyamanindah/tas'],
                 ['name' => 'Keranjang Bambu', 'category' => 'Kerajinan', 'price' => 75000, 'description' => 'Keranjang bambu serbaguna dengan anyaman rapi.', 'social_link' => '@anyamanindah/keranjang'],
             ],
             'promos' => [
                 ['title' => 'Beli 2 Gratis 1 Kerajinan', 'code' => 'B2G1', 'promo_link' => '#', 'expires_at' => '2025-12-20', 'status' => 'aktif'],
             ]
            ],
            ['name' => 'Admin Kopi', 'email' => 'kopi@example.com', 'phone' => '+62 812 5555 0000', 'role' => 'umkm',
             'store' => ['name' => 'Kopi Nusantara', 'category' => 'Minuman', 'description' => 'Biji kopi pilihan dari berbagai daerah penghasil kopi terbaik Indonesia.', 'address' => 'Jl. Gayo No. 1', 'city' => 'Aceh', 'phone' => '+62 812 5555 0000', 'instagram' => '@kopinusantara'],
             'products' => [
                 ['name' => 'Kopi Gayo Premium', 'category' => 'Minuman', 'price' => 85000, 'description' => 'Kopi Gayo pilihan dengan cita rasa terbaik.', 'social_link' => '@kopinus/gayo'],
                 ['name' => 'Kopi Flores Robusta', 'category' => 'Minuman', 'price' => 65000, 'description' => 'Kopi Robusta dari Flores dengan aroma yang kuat.', 'social_link' => '@kopinus/flores'],
             ],
             'promos' => []
            ],
            ['name' => 'Admin Tenun', 'email' => 'tenun@example.com', 'phone' => '+62 813 7777 8888', 'role' => 'umkm',
             'store' => ['name' => 'Tenun Sumatra', 'category' => 'Tekstil', 'description' => 'Kain tenun asli Sumatra dengan corak dan warna yang memukau.', 'address' => 'Jl. Tenun No. 15', 'city' => 'Medan', 'phone' => '+62 813 7777 8888', 'instagram' => '@tenunsumatra'],
             'products' => [
                 ['name' => 'Kain Ulos Batak', 'category' => 'Tekstil', 'price' => 250000, 'description' => 'Kain ulos tradisional Batak dengan motif khas.', 'social_link' => '@tenuns/ulos'],
             ],
             'promos' => [
                 ['title' => 'Diskon 15% Produk Fashion', 'code' => 'FASHION15', 'promo_link' => '#', 'expires_at' => '2024-12-15', 'status' => 'berakhir'],
             ]
            ],
            ['name' => 'Admin Herbal', 'email' => 'herbal@example.com', 'phone' => '+62 856 2222 3333', 'role' => 'umkm',
             'store' => ['name' => 'Herbal Jawa', 'category' => 'Kesehatan', 'description' => 'Produk herbal tradisional Jawa yang berkhasiat untuk kesehatan.', 'address' => 'Jl. Herbal No. 22', 'city' => 'Solo', 'phone' => '+62 856 2222 3333', 'instagram' => '@herbaljawa'],
             'products' => [
                 ['name' => 'Jamu Kunyit Asam', 'category' => 'Kesehatan', 'price' => 25000, 'description' => 'Jamu kunyit asam tradisional untuk kesehatan tubuh.', 'social_link' => '@herbaljawa/kunyit'],
                 ['name' => 'Temulawak Kering', 'category' => 'Kesehatan', 'price' => 35000, 'description' => 'Temulawak kering pilihan berkhasiat tinggi.', 'social_link' => '@herbaljawa/temulawak'],
             ],
             'promos' => [
                 ['title' => 'Promo Member Baru', 'code' => 'NEWMEMBER', 'promo_link' => '#', 'expires_at' => '2025-01-10', 'status' => 'aktif'],
             ]
            ],
        ];

        foreach ($usersData as $ud) {
            $storeData = $ud['store'];
            $products  = $ud['products'];
            $promos    = $ud['promos'];
            unset($ud['store'], $ud['products'], $ud['promos']);

            $user = User::create([
                'name'     => $ud['name'],
                'email'    => $ud['email'],
                'phone'    => $ud['phone'],
                'password' => Hash::make('password123'),
                'role'     => $ud['role'],
            ]);

            $store = Store::create(array_merge($storeData, ['user_id' => $user->id]));

            foreach ($products as $pd) {
                Product::create(array_merge($pd, ['store_id' => $store->id]));
            }

            foreach ($promos as $pr) {
                Promo::create(array_merge($pr, ['store_id' => $store->id]));
            }
        }
    }
}
