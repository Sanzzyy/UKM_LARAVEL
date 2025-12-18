<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // 1. SEEDER USERS (Admin & Kasir)
        // =====================================================
        echo "🔄 Seeding Users...\n";

        $users = [
            [
                'name' => 'Admin Utama',
                'email' => 'admin@nasgor.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'kasir1@nasgor.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'kasir2@nasgor.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi Wijaya',
                'email' => 'kasir3@nasgor.com',
                'password' => Hash::make('kasir123'),
                'role' => 'kasir',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        echo "✅ " . count($users) . " users created\n\n";

        // =====================================================
        // 2. SEEDER CATEGORIES
        // =====================================================
        echo "🔄 Seeding Categories...\n";

        $categories = [
            [
                'name' => 'Nasi Goreng',
                'description' => 'Berbagai varian nasi goreng dengan cita rasa khas Indonesia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mie Goreng',
                'description' => 'Mie goreng dengan berbagai topping pilihan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman Dingin',
                'description' => 'Minuman segar untuk menemani hidangan Anda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman Hangat',
                'description' => 'Minuman hangat untuk relaksasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tambahan & Topping',
                'description' => 'Pelengkap untuk menyempurnakan hidangan Anda',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paket Hemat',
                'description' => 'Paket combo hemat dan menguntungkan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        echo "✅ " . count($categories) . " categories created\n\n";

        // =====================================================
        // 3. SEEDER MENUS (Lengkap dengan berbagai variasi)
        // =====================================================
        echo "🔄 Seeding Menus...\n";

        $menus = [
            // KATEGORI 1: Nasi Goreng
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam suwir, udang, dan sayuran lengkap',
                'price' => 25000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Ayam',
                'description' => 'Nasi goreng dengan potongan ayam fillet yang gurih',
                'price' => 18000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Seafood',
                'description' => 'Nasi goreng dengan udang, cumi, dan ikan',
                'price' => 28000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Kambing',
                'description' => 'Nasi goreng dengan daging kambing empuk tanpa prengus',
                'price' => 30000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Pete',
                'description' => 'Nasi goreng dengan pete segar, nikmat untuk pecinta pete',
                'price' => 20000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Sosis',
                'description' => 'Nasi goreng dengan sosis sapi premium',
                'price' => 19000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Jawa',
                'description' => 'Nasi goreng dengan bumbu khas Jawa yang manis',
                'price' => 17000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Gila',
                'description' => 'Nasi goreng super pedas dengan level kepedasan maksimal',
                'price' => 22000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Putih',
                'description' => 'Nasi goreng tanpa kecap, cocok untuk yang tidak suka manis',
                'price' => 16000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 1,
                'name' => 'Nasi Goreng Teri Medan',
                'description' => 'Nasi goreng dengan teri medan yang gurih dan renyah',
                'price' => 21000,
                'image' => null,
                'is_available' => true,
            ],

            // KATEGORI 2: Mie Goreng
            [
                'category_id' => 2,
                'name' => 'Mie Goreng Spesial',
                'description' => 'Mie goreng dengan telur, ayam, udang, dan sayuran',
                'price' => 23000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Mie Goreng Ayam',
                'description' => 'Mie goreng dengan potongan ayam',
                'price' => 17000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Mie Goreng Seafood',
                'description' => 'Mie goreng dengan seafood segar',
                'price' => 26000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Mie Goreng Jawa',
                'description' => 'Mie goreng dengan bumbu khas Jawa',
                'price' => 16000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 2,
                'name' => 'Mie Goreng Tek-Tek',
                'description' => 'Mie goreng ala abang-abang dengan cita rasa jalanan',
                'price' => 15000,
                'image' => null,
                'is_available' => true,
            ],

            // KATEGORI 3: Minuman Dingin
            [
                'category_id' => 3,
                'name' => 'Es Teh Manis',
                'description' => 'Teh manis dingin segar',
                'price' => 5000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Es Jeruk',
                'description' => 'Jeruk peras segar dengan es batu',
                'price' => 8000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Es Lemon Tea',
                'description' => 'Teh dengan perasan lemon segar',
                'price' => 9000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Es Kelapa Muda',
                'description' => 'Air kelapa muda segar langsung dari buahnya',
                'price' => 12000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Es Campur',
                'description' => 'Es campur dengan berbagai topping lengkap',
                'price' => 15000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Es Cincau',
                'description' => 'Cincau hitam dengan sirup dan susu',
                'price' => 10000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Jus Alpukat',
                'description' => 'Jus alpukat segar dengan susu coklat',
                'price' => 13000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 3,
                'name' => 'Jus Mangga',
                'description' => 'Jus mangga manis segar',
                'price' => 12000,
                'image' => null,
                'is_available' => true,
            ],

            // KATEGORI 4: Minuman Hangat
            [
                'category_id' => 4,
                'name' => 'Teh Hangat',
                'description' => 'Teh hangat manis',
                'price' => 4000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Kopi Hitam',
                'description' => 'Kopi hitam tanpa gula',
                'price' => 6000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Kopi Susu',
                'description' => 'Kopi dengan susu kental manis',
                'price' => 8000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Susu Jahe',
                'description' => 'Susu hangat dengan jahe untuk menghangatkan badan',
                'price' => 10000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 4,
                'name' => 'Wedang Uwuh',
                'description' => 'Minuman tradisional dengan rempah lengkap',
                'price' => 9000,
                'image' => null,
                'is_available' => true,
            ],

            // KATEGORI 5: Tambahan & Topping
            [
                'category_id' => 5,
                'name' => 'Telur Mata Sapi',
                'description' => 'Telur goreng mata sapi',
                'price' => 5000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Telur Dadar',
                'description' => 'Telur dadar bumbu',
                'price' => 5000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Kerupuk Udang',
                'description' => 'Kerupuk udang renyah',
                'price' => 2000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Kerupuk Kulit',
                'description' => 'Kerupuk kulit sapi khas',
                'price' => 3000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Emping',
                'description' => 'Emping melinjo gurih',
                'price' => 3000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Ayam Goreng',
                'description' => 'Ayam goreng bumbu kuning',
                'price' => 12000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Sate Ayam (5 tusuk)',
                'description' => 'Sate ayam dengan bumbu kacang',
                'price' => 15000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 5,
                'name' => 'Perkedel',
                'description' => 'Perkedel kentang isi daging',
                'price' => 4000,
                'image' => null,
                'is_available' => true,
            ],

            // KATEGORI 6: Paket Hemat
            [
                'category_id' => 6,
                'name' => 'Paket Hemat A',
                'description' => 'Nasi Goreng Ayam + Es Teh Manis',
                'price' => 20000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'Paket Hemat B',
                'description' => 'Nasi Goreng Spesial + Es Jeruk + Kerupuk',
                'price' => 30000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'Paket Hemat C',
                'description' => 'Mie Goreng Ayam + Es Teh Manis',
                'price' => 19000,
                'image' => null,
                'is_available' => true,
            ],
            [
                'category_id' => 6,
                'name' => 'Paket Keluarga',
                'description' => '3 Nasi Goreng Spesial + 3 Es Jeruk + Kerupuk',
                'price' => 75000,
                'image' => null,
                'is_available' => true,
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        echo "✅ " . count($menus) . " menus created\n\n";

        // =====================================================
        // 4. SEEDER CUSTOMERS (Pelanggan)
        // =====================================================
        echo "🔄 Seeding Customers...\n";

        $customers = [
            [
                'name' => 'Umum',
                'phone' => '-',
                'address' => '-',
                'created_at' => now()->subDays(60),
                'updated_at' => now()->subDays(60),
            ],
            [
                'name' => 'Ahmad Dahlan',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 15, Lubuklinggau',
                'created_at' => now()->subDays(45),
                'updated_at' => now()->subDays(45),
            ],
            [
                'name' => 'Dewi Sartika',
                'phone' => '081345678901',
                'address' => 'Jl. Sudirman No. 28, Lubuklinggau',
                'created_at' => now()->subDays(40),
                'updated_at' => now()->subDays(40),
            ],
            [
                'name' => 'Budi Prasetyo',
                'phone' => '082123456789',
                'address' => 'Jl. Ahmad Yani No. 42, Lubuklinggau',
                'created_at' => now()->subDays(35),
                'updated_at' => now()->subDays(35),
            ],
            [
                'name' => 'Rina Wati',
                'phone' => '085678901234',
                'address' => 'Jl. Gatot Subroto No. 67, Lubuklinggau',
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'name' => 'Bambang Supriadi',
                'phone' => '087890123456',
                'address' => 'Jl. Diponegoro No. 89, Lubuklinggau',
                'created_at' => now()->subDays(28),
                'updated_at' => now()->subDays(28),
            ],
            [
                'name' => 'Siska Melati',
                'phone' => '089012345678',
                'address' => 'Jl. Imam Bonjol No. 12, Lubuklinggau',
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'name' => 'Hendra Gunawan',
                'phone' => '081298765432',
                'address' => 'Jl. Veteran No. 34, Lubuklinggau',
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            [
                'name' => 'Linda Wijaya',
                'phone' => '082187654321',
                'address' => 'Jl. Pemuda No. 56, Lubuklinggau',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'name' => 'Agus Salim',
                'phone' => '083176543210',
                'address' => 'Jl. Pahlawan No. 78, Lubuklinggau',
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            [
                'name' => 'Maya Puspita',
                'phone' => '085265432109',
                'address' => 'Jl. Proklamasi No. 90, Lubuklinggau',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'name' => 'Doni Setiawan',
                'phone' => '087654321098',
                'address' => 'Jl. Kartini No. 23, Lubuklinggau',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'name' => 'Fitri Handayani',
                'phone' => '089543210987',
                'address' => 'Jl. Cut Nyak Dien No. 45, Lubuklinggau',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],
            [
                'name' => 'Rudi Hartono',
                'phone' => '081432109876',
                'address' => 'Jl. Teuku Umar No. 67, Lubuklinggau',
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'name' => 'Ani Susilowati',
                'phone' => '082321098765',
                'address' => 'Jl. Pattimura No. 89, Lubuklinggau',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }

        echo "✅ " . count($customers) . " customers created\n\n";

        // =====================================================
        // 5. SEEDER TRANSACTIONS & TRANSACTION DETAILS
        // =====================================================
        echo "🔄 Seeding Transactions & Details...\n";

        $transactionCount = 0;
        $detailCount = 0;

        // Generate transaksi untuk 30 hari terakhir
        for ($day = 30; $day >= 0; $day--) {
            $date = now()->subDays($day);

            // Random 5-15 transaksi per hari
            $transactionsPerDay = rand(5, 15);

            for ($i = 0; $i < $transactionsPerDay; $i++) {
                // Random waktu dalam sehari
                $randomHour = rand(10, 21); // Jam 10 pagi - 9 malam
                $randomMinute = rand(0, 59);
                $transactionTime = $date->copy()->setTime($randomHour, $randomMinute);

                // Random customer (1-15, atau null untuk umum)
                $customerId = rand(1, 20) > 5 ? rand(2, 15) : 1; // 75% peluang pelanggan tetap

                // Random kasir (user_id 2, 3, atau 4)
                $kasirId = rand(2, 4);

                // Generate transaction code
                $transactionCode = 'TRX' . $transactionTime->format('YmdHis') . rand(100, 999);

                // Random items (1-5 items per transaksi)
                $itemCount = rand(1, 5);
                $selectedMenuIds = [];
                $totalAmount = 0;

                // Ambil menu random langsung dari DB
                $menus = Menu::inRandomOrder()->take($itemCount)->get();

                $totalAmount = 0;
                $transactionItems = [];

                foreach ($menus as $menu) {
                    $quantity = rand(1, 3);
                    $subtotal = $menu->price * $quantity;
                    $totalAmount += $subtotal;

                    $transactionItems[] = [
                        'menu_id' => $menu->id,
                        'quantity' => $quantity,
                        'price' => $menu->price,
                        'subtotal' => $subtotal,
                    ];
                }

                // Hitung total dari selected items
                $transactionItems = [];
                foreach ($selectedMenuIds as $menuId) {
                    $menu = Menu::find($menuId);
                    $quantity = rand(1, 3);
                    $subtotal = $menu->price * $quantity;
                    $totalAmount += $subtotal;

                    $transactionItems[] = [
                        'menu_id' => $menuId,
                        'quantity' => $quantity,
                        'price' => $menu->price,
                        'subtotal' => $subtotal,
                    ];
                }

                // Random payment method
                $paymentMethods = ['cash', 'transfer', 'qris'];
                $paymentMethod = $paymentMethods[array_rand($paymentMethods)];

                // Calculate paid amount and change
                if ($paymentMethod === 'cash') {
                    // Round up ke ribuan terdekat untuk cash
                    $paidAmount = ceil($totalAmount / 1000) * 1000;
                    // Kadang customer bayar lebih
                    if (rand(1, 10) > 7) {
                        $paidAmount += rand(5, 20) * 1000;
                    }
                } else {
                    // Transfer/QRIS biasanya pas
                    $paidAmount = $totalAmount;
                }

                $changeAmount = $paidAmount - $totalAmount;

                // Create transaction
                $transaction = Transaction::create([
                    'transaction_code' => $transactionCode,
                    'user_id' => $kasirId,
                    'customer_id' => $customerId,
                    'total_amount' => $totalAmount,
                    'paid_amount' => $paidAmount,
                    'change_amount' => $changeAmount,
                    'payment_method' => $paymentMethod,
                    'created_at' => $transactionTime,
                    'updated_at' => $transactionTime,
                ]);

                $transactionCount++;

                // Create transaction details
                foreach ($transactionItems as $item) {
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'menu_id' => $item['menu_id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                        'notes' => rand(1, 10) > 8 ? 'Pedas' : null, // 20% ada notes
                        'created_at' => $transactionTime,
                        'updated_at' => $transactionTime,
                    ]);

                    $detailCount++;
                }
            }

            echo "  ✓ Day " . (30 - $day) . "/31 completed\n";
        }

        echo "\n✅ " . $transactionCount . " transactions created\n";
        echo "✅ " . $detailCount . " transaction details created\n\n";

        // =====================================================
        // SUMMARY
        // =====================================================
        echo "==========================================\n";
        echo "🎉 SEEDING COMPLETED SUCCESSFULLY!\n";
        echo "==========================================\n";
        echo "👥 Users: " . User::count() . "\n";
        echo "📁 Categories: " . Category::count() . "\n";
        echo "🍴 Menus: " . Menu::count() . "\n";
        echo "👨‍👩‍👧‍👦 Customers: " . Customer::count() . "\n";
        echo "💳 Transactions: " . Transaction::count() . "\n";
        echo "📝 Transaction Details: " . TransactionDetail::count() . "\n";
        echo "==========================================\n";
        echo "💰 Total Revenue: Rp " . number_format(Transaction::sum('total_amount'), 0, ',', '.') . "\n";
        echo "==========================================\n";
    }
}
