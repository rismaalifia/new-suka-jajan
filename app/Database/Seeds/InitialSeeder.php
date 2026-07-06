<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Admin user (password: admin123)
        $this->db->table('users')->insertBatch([
            [
                'username'   => 'admin',
                'email'      => 'admin@sukajajan.com',
                'password'   => password_hash('admin123', PASSWORD_DEFAULT),
                'role'       => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username'   => 'user1',
                'email'      => 'user1@sukajajan.com',
                'password'   => password_hash('user123', PASSWORD_DEFAULT),
                'role'       => 'contributor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        // Categories
        $this->db->table('categories')->insertBatch([
            ['nama' => 'Warung Makan',    'slug' => 'warung-makan',    'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Cafe',            'slug' => 'cafe',            'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Street Food',     'slug' => 'street-food',     'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Restoran',        'slug' => 'restoran',        'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Bakery & Kue',    'slug' => 'bakery-kue',      'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Minuman',         'slug' => 'minuman',         'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);

        // Tags
        $this->db->table('tags')->insertBatch([
            ['nama' => 'Pedas',     'slug' => 'pedas',     'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Murah',     'slug' => 'murah',     'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Halal',     'slug' => 'halal',     'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Legendaris','slug' => 'legendaris', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Viral',     'slug' => 'viral',     'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Porsi Besar','slug' => 'porsi-besar','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['nama' => 'Instagramable','slug' => 'instagramable','created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);

        // Kuliners (semua approved)
        $this->db->table('kuliners')->insertBatch([
            [
                'user_id' => 1, 'category_id' => 1,
                'nama' => 'Warung Soto Bangkong', 'slug' => 'warung-soto-bangkong',
                'alamat' => 'Jl. Bangkong No. 10, Semarang',
                'deskripsi' => 'Soto legendaris Semarang yang sudah berdiri sejak tahun 1970. Kuahnya yang kaya rempah dengan isian ayam kampung suwir, telur, dan tauge segar menjadikannya favorit warga Semarang.',
                'latitude' => '-6.9847553', 'longitude' => '110.4217147',
                'foto_utama' => 'kuliner_1.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.50, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1, 'category_id' => 3,
                'nama' => 'Lumpia Gang Lombok', 'slug' => 'lumpia-gang-lombok',
                'alamat' => 'Jl. Gang Lombok No. 11, Semarang',
                'deskripsi' => 'Lumpia goreng dan basah khas Semarang yang terkenal se-Indonesia. Isian rebung, udang, dan telur yang pas bumbunya. Wajib dibeli kalau ke Semarang!',
                'latitude' => '-6.9680345', 'longitude' => '110.4279865',
                'foto_utama' => 'kuliner_2.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.80, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1, 'category_id' => 2,
                'nama' => 'Kopi Tuku Semarang', 'slug' => 'kopi-tuku-semarang',
                'alamat' => 'Jl. Pleburan Barat No. 5, Semarang',
                'deskripsi' => 'Cabang kopi tuku yang viral di Semarang. Es kopi susu tetangga yang jadi favorit anak muda. Tempatnya cozy dan Instagramable.',
                'latitude' => '-6.9932100', 'longitude' => '110.4092400',
                'foto_utama' => 'kuliner_3.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.00, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2, 'category_id' => 4,
                'nama' => 'Sate Kambing Pak Budi', 'slug' => 'sate-kambing-pak-budi',
                'alamat' => 'Jl. Pandanaran No. 78, Semarang',
                'deskripsi' => 'Sate kambing empuk dengan bumbu kacang racikan sendiri. Dagingnya fresh dan tidak bau prengus. Porsi besar dan harga terjangkau.',
                'latitude' => '-6.9880000', 'longitude' => '110.4120000',
                'foto_utama' => 'kuliner_4.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.30, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2, 'category_id' => 5,
                'nama' => 'Toko Roti Purimas', 'slug' => 'toko-roti-purimas',
                'alamat' => 'Jl. Pemuda No. 45, Semarang',
                'deskripsi' => 'Toko roti legendaris Semarang. Roti gandum, donat, dan kue-kue basah selalu fresh dari oven. Cocok untuk oleh-oleh.',
                'latitude' => '-6.9750000', 'longitude' => '110.4200000',
                'foto_utama' => 'kuliner_5.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.60, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 1, 'category_id' => 6,
                'nama' => 'Es Puter Pak Djo', 'slug' => 'es-puter-pak-djo',
                'alamat' => 'Jl. Simpang Lima, Semarang',
                'deskripsi' => 'Es puter tradisional yang diputar manual. Rasa durian, kelapa muda, dan coklat jadi favorit. Segar banget di cuaca panas Semarang!',
                'latitude' => '-6.9850000', 'longitude' => '110.4190000',
                'foto_utama' => 'kuliner_6.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.20, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // === New entries: near university campuses in Semarang ===
            // 7 - Near UNDIP Tembalang
            [
                'user_id' => 2, 'category_id' => 1,
                'nama' => 'Warung Nasi Kucing Bu Rum', 'slug' => 'warung-nasi-kucing-bu-rum',
                'alamat' => 'Jl. Prof. Soedarto No. 15, Tembalang, Semarang',
                'deskripsi' => 'Warung nasi kucing legendaris dekat kampus UNDIP Tembalang. Porsi kecil harga terjangkau, cocok buat mahasiswa. Lauk ayam suwir, teri, dan tempe goreng selalu fresh.',
                'latitude' => '-7.0499000', 'longitude' => '110.4382000',
                'foto_utama' => 'kuliner_7.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.20, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 8 - Near UNDIP Tembalang
            [
                'user_id' => 1, 'category_id' => 2,
                'nama' => 'Kopi Tembalang Space', 'slug' => 'kopi-tembalang-space',
                'alamat' => 'Jl. Tirto Agung Raya No. 22, Tembalang, Semarang',
                'deskripsi' => 'Coffee shop favorit mahasiswa UNDIP. Tempatnya luas dengan colokan di setiap meja, WiFi kencang, dan menu kopi yang variatif. Cocok buat nugas sampai malam.',
                'latitude' => '-7.0465000', 'longitude' => '110.4395000',
                'foto_utama' => 'kuliner_8.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.50, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 9 - Near UNNES Sekaran
            [
                'user_id' => 2, 'category_id' => 3,
                'nama' => 'Mie Ayam Pak Gendut Sekaran', 'slug' => 'mie-ayam-pak-gendut-sekaran',
                'alamat' => 'Jl. Sekaran Raya No. 8, Gunungpati, Semarang',
                'deskripsi' => 'Mie ayam porsi jumbo yang jadi langganan mahasiswa UNNES. Mie-nya kenyal, topping ayamnya melimpah, dan kuah kaldunya gurih. Harga ramah kantong mahasiswa.',
                'latitude' => '-7.0532000', 'longitude' => '110.3922000',
                'foto_utama' => 'kuliner_9.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.70, 'total_reviews' => 3,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 10 - Near UNNES Sekaran
            [
                'user_id' => 1, 'category_id' => 6,
                'nama' => 'Es Teh Poci Mbak Yuni', 'slug' => 'es-teh-poci-mbak-yuni',
                'alamat' => 'Jl. Raya Sekaran No. 3, Gunungpati, Semarang',
                'deskripsi' => 'Es teh poci asli dengan gula batu yang manisnya pas. Diseduh pakai teko tanah liat tradisional. Minuman paling segar buat mahasiswa UNNES sehabis kuliah.',
                'latitude' => '-7.0510000', 'longitude' => '110.3895000',
                'foto_utama' => 'kuliner_10.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 3.80, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 11 - Near USM (Universitas Semarang)
            [
                'user_id' => 2, 'category_id' => 1,
                'nama' => 'Warung Rawon Bu Sri', 'slug' => 'warung-rawon-bu-sri',
                'alamat' => 'Jl. Soekarno-Hatta No. 50, Tlogosari, Semarang',
                'deskripsi' => 'Rawon hitam pekat dengan daging sapi empuk yang meleleh di mulut. Bumbu kluwek-nya kental dan harum. Dilengkapi sambal terasi yang bikin nagih.',
                'latitude' => '-6.9920000', 'longitude' => '110.4510000',
                'foto_utama' => 'kuliner_11.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.00, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 12 - Near UNIKA Soegijapranata
            [
                'user_id' => 1, 'category_id' => 4,
                'nama' => 'Restoran Seafood Pak Karmin', 'slug' => 'restoran-seafood-pak-karmin',
                'alamat' => 'Jl. Pawiyatan Luhur IV No. 12, Bendan Duwur, Semarang',
                'deskripsi' => 'Restoran seafood dekat kampus UNIKA dengan udang bakar madu yang jadi signature dish. Ikan bawal bakar dan cumi saus telur asinnya juga tidak kalah lezat.',
                'latitude' => '-7.0005000', 'longitude' => '110.4155000',
                'foto_utama' => 'kuliner_12.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.30, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 13 - Near UNIKA Soegijapranata
            [
                'user_id' => 2, 'category_id' => 5,
                'nama' => 'Roti Bakar 88 Bendan', 'slug' => 'roti-bakar-88-bendan',
                'alamat' => 'Jl. Bendan Ngisor No. 20, Semarang',
                'deskripsi' => 'Roti bakar dengan aneka topping mulai dari coklat keju, pisang susu, hingga ovomaltine. Favorit mahasiswa UNIKA buat nongkrong malam. Harga mulai 8 ribu.',
                'latitude' => '-7.0020000', 'longitude' => '110.4100000',
                'foto_utama' => 'kuliner_13.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 3.90, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 14 - Near UDINUS
            [
                'user_id' => 1, 'category_id' => 3,
                'nama' => 'Tahu Gimbal Pak Eko', 'slug' => 'tahu-gimbal-pak-eko',
                'alamat' => 'Jl. Nakula I No. 5, Pendrikan Kidul, Semarang',
                'deskripsi' => 'Tahu gimbal khas Semarang dekat kampus UDINUS. Tahu goreng crispy dengan gimbal udang, lontong, dan bumbu kacang yang kental. Porsi mengenyangkan cuma 12 ribu.',
                'latitude' => '-6.9780000', 'longitude' => '110.4210000',
                'foto_utama' => 'kuliner_14.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.50, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 15 - Near UDINUS
            [
                'user_id' => 2, 'category_id' => 2,
                'nama' => 'Kedai Kopi Nakula', 'slug' => 'kedai-kopi-nakula',
                'alamat' => 'Jl. Nakula No. 18, Pendrikan Kidul, Semarang',
                'deskripsi' => 'Kedai kopi minimalis di dekat UDINUS. Single origin Java dan Sumatera jadi andalannya. Manual brew V60 dan Aeropress disajikan dengan penjelasan dari barista.',
                'latitude' => '-6.9775000', 'longitude' => '110.4225000',
                'foto_utama' => 'kuliner_15.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.60, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 16 - Near UNDIP Pleburan (kampus lama)
            [
                'user_id' => 1, 'category_id' => 1,
                'nama' => 'Warung Pecel Bu Tinah', 'slug' => 'warung-pecel-bu-tinah',
                'alamat' => 'Jl. Pleburan Timur No. 7, Pleburan, Semarang',
                'deskripsi' => 'Pecel sayur dengan bumbu kacang homemade yang gurih dan sedikit pedas. Dilengkapi rempeyek, tempe goreng, dan telur dadar. Sarapan favorit warga Pleburan.',
                'latitude' => '-6.9940000', 'longitude' => '110.4080000',
                'foto_utama' => 'kuliner_16.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.10, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 17 - Near Polines / UNNES Kampus Bendan
            [
                'user_id' => 2, 'category_id' => 4,
                'nama' => 'Ayam Geprek Bensu Bendan', 'slug' => 'ayam-geprek-bensu-bendan',
                'alamat' => 'Jl. Bendan Ngisor No. 45, Semarang',
                'deskripsi' => 'Ayam geprek dengan level pedas 1-10 yang bikin keringatan. Sambal bawangnya harum dan ayamnya crispy sempurna. Menu favorit: geprek mozarella level 5.',
                'latitude' => '-7.0035000', 'longitude' => '110.4070000',
                'foto_utama' => 'kuliner_17.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 3.50, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 18 - Near UNISSULA
            [
                'user_id' => 1, 'category_id' => 5,
                'nama' => 'Martabak Bangka Pak Jaya', 'slug' => 'martabak-bangka-pak-jaya',
                'alamat' => 'Jl. Kaligawe Raya No. 30, Semarang',
                'deskripsi' => 'Martabak manis tebal dengan topping keju, coklat, kacang, dan wijen. Adonannya lembut dan empuk. Martabak telurnya juga juara dengan isian daging spesial.',
                'latitude' => '-6.9680000', 'longitude' => '110.4480000',
                'foto_utama' => 'kuliner_18.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.80, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 19 - Near UPGRIS
            [
                'user_id' => 2, 'category_id' => 6,
                'nama' => 'Jus Buah Segar Mbak Nia', 'slug' => 'jus-buah-segar-mbak-nia',
                'alamat' => 'Jl. Sidodadi Timur No. 12, Semarang',
                'deskripsi' => 'Aneka jus buah segar tanpa pengawet dan pemanis buatan. Jus alpukat, mangga, dan buah naga jadi best seller. Cocok buat mahasiswa UPGRIS yang butuh minuman sehat.',
                'latitude' => '-6.9810000', 'longitude' => '110.4305000',
                'foto_utama' => 'kuliner_19.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.00, 'total_reviews' => 1,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 20 - Near UNDIP Tembalang
            [
                'user_id' => 1, 'category_id' => 3,
                'nama' => 'Angkringan Mas Mono Tembalang', 'slug' => 'angkringan-mas-mono-tembalang',
                'alamat' => 'Jl. Sirojudin No. 3, Tembalang, Semarang',
                'deskripsi' => 'Angkringan khas Jogja-Semarang di area Tembalang. Nasi kucing, sate usus, sate telur puyuh, dan wedang jahe jadi menu andalannya. Buka dari sore sampai tengah malam.',
                'latitude' => '-7.0480000', 'longitude' => '110.4370000',
                'foto_utama' => 'kuliner_20.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.40, 'total_reviews' => 3,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 21 - Near USM
            [
                'user_id' => 2, 'category_id' => 4,
                'nama' => 'Nasi Goreng Babat Pak Wari', 'slug' => 'nasi-goreng-babat-pak-wari',
                'alamat' => 'Jl. Soekarno-Hatta No. 88, Tlogosari, Semarang',
                'deskripsi' => 'Nasi goreng babat legendaris yang buka malam hari. Babatnya empuk, bumbu nasi gorengnya meresap sempurna, dan porsinya bikin kenyang. Tambah kerupuk dan telur ceplok makin mantap.',
                'latitude' => '-6.9935000', 'longitude' => '110.4520000',
                'foto_utama' => 'kuliner_21.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.70, 'total_reviews' => 3,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
            // 22 - Near UNIKA
            [
                'user_id' => 1, 'category_id' => 2,
                'nama' => 'Lawang Coffee Pawiyatan', 'slug' => 'lawang-coffee-pawiyatan',
                'alamat' => 'Jl. Pawiyatan Luhur II No. 8, Bendan Duwur, Semarang',
                'deskripsi' => 'Cafe industrial yang jadi basecamp mahasiswa UNIKA. Menu signature: dirty latte dan red velvet latte. Ada board game gratis dan live music tiap Jumat malam.',
                'latitude' => '-7.0010000', 'longitude' => '110.4140000',
                'foto_utama' => 'kuliner_22.jpg', 'status' => 'approved', 'is_closed' => 0,
                'avg_rating' => 4.90, 'total_reviews' => 2,
                'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);

        // Kuliner-Tags
        $this->db->table('kuliner_tags')->insertBatch([
            ['kuliner_id' => 1, 'tag_id' => 3], // Soto - Halal
            ['kuliner_id' => 1, 'tag_id' => 4], // Soto - Legendaris
            ['kuliner_id' => 1, 'tag_id' => 2], // Soto - Murah
            ['kuliner_id' => 2, 'tag_id' => 4], // Lumpia - Legendaris
            ['kuliner_id' => 2, 'tag_id' => 3], // Lumpia - Halal
            ['kuliner_id' => 3, 'tag_id' => 5], // Kopi Tuku - Viral
            ['kuliner_id' => 3, 'tag_id' => 7], // Kopi Tuku - Instagramable
            ['kuliner_id' => 4, 'tag_id' => 6], // Sate - Porsi Besar
            ['kuliner_id' => 4, 'tag_id' => 3], // Sate - Halal
            ['kuliner_id' => 4, 'tag_id' => 1], // Sate - Pedas
            ['kuliner_id' => 5, 'tag_id' => 4], // Purimas - Legendaris
            ['kuliner_id' => 6, 'tag_id' => 2], // Es Puter - Murah
            ['kuliner_id' => 6, 'tag_id' => 4], // Es Puter - Legendaris
            // === New kuliner_tags ===
            ['kuliner_id' => 7, 'tag_id' => 2],  // Nasi Kucing - Murah
            ['kuliner_id' => 7, 'tag_id' => 3],  // Nasi Kucing - Halal
            ['kuliner_id' => 8, 'tag_id' => 7],  // Kopi Tembalang - Instagramable
            ['kuliner_id' => 8, 'tag_id' => 5],  // Kopi Tembalang - Viral
            ['kuliner_id' => 9, 'tag_id' => 6],  // Mie Ayam - Porsi Besar
            ['kuliner_id' => 9, 'tag_id' => 2],  // Mie Ayam - Murah
            ['kuliner_id' => 9, 'tag_id' => 3],  // Mie Ayam - Halal
            ['kuliner_id' => 10, 'tag_id' => 2], // Es Teh Poci - Murah
            ['kuliner_id' => 10, 'tag_id' => 4], // Es Teh Poci - Legendaris
            ['kuliner_id' => 11, 'tag_id' => 3], // Rawon - Halal
            ['kuliner_id' => 11, 'tag_id' => 1], // Rawon - Pedas
            ['kuliner_id' => 12, 'tag_id' => 6], // Seafood - Porsi Besar
            ['kuliner_id' => 12, 'tag_id' => 3], // Seafood - Halal
            ['kuliner_id' => 13, 'tag_id' => 2], // Roti Bakar - Murah
            ['kuliner_id' => 13, 'tag_id' => 5], // Roti Bakar - Viral
            ['kuliner_id' => 14, 'tag_id' => 4], // Tahu Gimbal - Legendaris
            ['kuliner_id' => 14, 'tag_id' => 2], // Tahu Gimbal - Murah
            ['kuliner_id' => 14, 'tag_id' => 3], // Tahu Gimbal - Halal
            ['kuliner_id' => 15, 'tag_id' => 7], // Kedai Kopi - Instagramable
            ['kuliner_id' => 15, 'tag_id' => 5], // Kedai Kopi - Viral
            ['kuliner_id' => 16, 'tag_id' => 2], // Pecel - Murah
            ['kuliner_id' => 16, 'tag_id' => 3], // Pecel - Halal
            ['kuliner_id' => 17, 'tag_id' => 1], // Ayam Geprek - Pedas
            ['kuliner_id' => 17, 'tag_id' => 5], // Ayam Geprek - Viral
            ['kuliner_id' => 18, 'tag_id' => 6], // Martabak - Porsi Besar
            ['kuliner_id' => 18, 'tag_id' => 3], // Martabak - Halal
            ['kuliner_id' => 19, 'tag_id' => 2], // Jus Buah - Murah
            ['kuliner_id' => 19, 'tag_id' => 3], // Jus Buah - Halal
            ['kuliner_id' => 20, 'tag_id' => 2], // Angkringan - Murah
            ['kuliner_id' => 20, 'tag_id' => 3], // Angkringan - Halal
            ['kuliner_id' => 20, 'tag_id' => 4], // Angkringan - Legendaris
            ['kuliner_id' => 21, 'tag_id' => 1], // Nasi Goreng - Pedas
            ['kuliner_id' => 21, 'tag_id' => 6], // Nasi Goreng - Porsi Besar
            ['kuliner_id' => 21, 'tag_id' => 4], // Nasi Goreng - Legendaris
            ['kuliner_id' => 22, 'tag_id' => 7], // Lawang Coffee - Instagramable
            ['kuliner_id' => 22, 'tag_id' => 5], // Lawang Coffee - Viral
        ]);

        // Reviews
        $this->db->table('reviews')->insertBatch([
            ['kuliner_id' => 1, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Soto paling enak di Semarang! Kuahnya gurih dan dagingnya banyak. Wajib coba!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 1, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Enak banget, porsinya pas. Tempatnya sederhana tapi rasa juara.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 2, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Lumpia terenak! Renyah di luar, isian rebungnya melimpah. 10/10!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 2, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Ga ada yang ngalahin lumpia sini. Beli 10 buat oleh-oleh selalu habis.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 3, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Kopi susunya enak, tempatnya nyaman buat kerja. WiFi kenceng.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 3, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Es kopi susu tetangganya juara. Harga standar, rasa premium.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 4, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Sate kambingnya empuk dan bumbu kacangnya mantap. Recommended!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 4, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Porsi besar, daging ga bau prengus. Paling suka yang bumbu kecap!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 5, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Roti gandumnya paling enak di Semarang. Fresh dan harga terjangkau.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 5, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Donatnya lembut banget. Kue basahnya juga enak-enak. Langganan!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 6, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Es puter rasa durian mantepp! Seger banget di siang bolong.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 6, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Rasa kelapa mudanya authentic. Murah cuma 5 ribu!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // === Reviews for new kuliners ===
            // Kuliner 7 - Warung Nasi Kucing Bu Rum (avg 4.20, 2 reviews)
            ['kuliner_id' => 7, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Nasi kucingnya enak dan murah banget! Cocok buat anak kos. Lauk ayam suwirnya favorit saya.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 7, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Tempatnya sederhana tapi rasanya juara. Beli 3 bungkus cuma 9 ribu, kenyang!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 8 - Kopi Tembalang Space (avg 4.50, 2 reviews)
            ['kuliner_id' => 8, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Best cafe di Tembalang! WiFi kenceng, colokan banyak, kopinya enak. Tempat nugas paling nyaman.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 8, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Es kopi susunya pas manisnya. Tempatnya aesthetic dan harga masih ramah kantong mahasiswa.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 9 - Mie Ayam Pak Gendut (avg 4.70, 3 reviews)
            ['kuliner_id' => 9, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Porsinya beneran gendut! Mie-nya kenyal, ayamnya banyak, kuahnya gurih. Wajib coba!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 9, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Mie ayam terenak di Gunungpati. Sering antri tapi worth it banget. Pangsitnya juga enak.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 9, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Balik lagi kesini, tetep konsisten enaknya. Cuma parkiran agak sempit aja.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 10 - Es Teh Poci Mbak Yuni (avg 3.80, 2 reviews)
            ['kuliner_id' => 10, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Teh poci-nya wangi dan seger. Gula batunya pas, ga kemanis. Murah pula!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 10, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Minuman andalan sehabis kuliah. Sederhana tapi rasanya otentik banget.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 11 - Warung Rawon Bu Sri (avg 4.00, 2 reviews)
            ['kuliner_id' => 11, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Rawonnya hitam pekat, dagingnya empuk. Sambal terasinya nampol!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 11, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Rasanya kayak rawon buatan ibu. Porsinya cukup besar dengan harga 18 ribu.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 12 - Restoran Seafood Pak Karmin (avg 4.30, 2 reviews)
            ['kuliner_id' => 12, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Udang bakar madunya juara! Bumbu meresap sempurna. Tempatnya luas buat makan rame-rame.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 12, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Cumi saus telur asinnya nagih banget. Seafood-nya fresh dan harga masih reasonable.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 13 - Roti Bakar 88 Bendan (avg 3.90, 2 reviews)
            ['kuliner_id' => 13, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Roti bakar coklat kejunya melted sempurna. Harga anak kos banget, murah dan enak!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 13, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Sering mampir abis kelas malam. Roti bakar pisang susunya comfort food banget.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 14 - Tahu Gimbal Pak Eko (avg 4.50, 2 reviews)
            ['kuliner_id' => 14, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Tahu gimbal paling enak di daerah sini! Bumbu kacangnya kental dan tahunya crispy.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 14, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Gimbal udangnya banyak, lontongnya lembut. Wajib pake kecap manis biar makin mantap.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 15 - Kedai Kopi Nakula (avg 4.60, 2 reviews)
            ['kuliner_id' => 15, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Manual brew V60-nya top! Barista-nya ramah dan mau jelasin soal biji kopi. Suasana tenang.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 15, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Single origin Java-nya aromatic banget. Tempatnya kecil tapi cozy. Worth it!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 16 - Warung Pecel Bu Tinah (avg 4.10, 2 reviews)
            ['kuliner_id' => 16, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Pecel sayurnya seger, bumbu kacangnya homemade dan berasa banget. Sarapan sempurna!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 16, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Rempeyek udangnya renyah banget. Pecelnya porsi pas dan ga bikin eneg. Murah lagi.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 17 - Ayam Geprek Bensu Bendan (avg 3.50, 2 reviews)
            ['kuliner_id' => 17, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Geprek level 5 udah bikin keringatan. Sambal bawangnya harum dan ayamnya crispy!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 17, 'user_id' => 2, 'rating' => 3, 'komentar' => 'Rasa oke tapi pelayanannya agak lama kalau rame. Geprek mozarella-nya enak sih.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 18 - Martabak Bangka Pak Jaya (avg 4.80, 2 reviews)
            ['kuliner_id' => 18, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Martabak manisnya tebal, lembut, dan topping-nya ga pelit. Coklat keju wijennya the best!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 18, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Martabak telur spesialnya juara. Isian daging banyak dan bumbunya meresap. Selalu beli tiap weekend.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 19 - Jus Buah Segar Mbak Nia (avg 4.00, 1 review)
            ['kuliner_id' => 19, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Jus alpukatnya creamy dan segar! Tanpa pemanis buatan, beneran rasa buah asli.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 20 - Angkringan Mas Mono (avg 4.40, 3 reviews)
            ['kuliner_id' => 20, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Angkringan paling lengkap di Tembalang! Sate usus dan wedang jahenya wajib pesen.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 20, 'user_id' => 2, 'rating' => 4, 'komentar' => 'Nasi kucing teri pedasnya nagih. Suasana nongkrong malam yang asik banget.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 20, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Harga anak kos, rasa bintang lima. Sate telur puyuhnya simple tapi enak pol.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 21 - Nasi Goreng Babat Pak Wari (avg 4.70, 3 reviews)
            ['kuliner_id' => 21, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Nasi goreng babat terenak! Babatnya empuk, bumbu nasgornya meresap, porsi gede.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 21, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Selalu antri tapi ga pernah kecewa. Tambah telur ceplok dan kerupuk makin sempurna.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 21, 'user_id' => 1, 'rating' => 4, 'komentar' => 'Buka malam doang tapi worth the wait. Nasgor babat spesialnya legendaris!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            // Kuliner 22 - Lawang Coffee Pawiyatan (avg 4.90, 2 reviews)
            ['kuliner_id' => 22, 'user_id' => 1, 'rating' => 5, 'komentar' => 'Cafe terbaik dekat UNIKA! Dirty latte-nya premium banget. Live music Jumat malamnya bikin betah.', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['kuliner_id' => 22, 'user_id' => 2, 'rating' => 5, 'komentar' => 'Tempatnya industrial keren. Red velvet latte-nya unik dan enak. Board game-nya seru buat rame-rame!', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
