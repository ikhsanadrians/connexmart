<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Roles;
use App\Models\Wallet;
use App\Models\TopUp;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         Roles::create([
            "name" => "admin",
         ]);

         Roles::create([
            "name" => "bank"
         ]);

         Roles::create([
            "name" => "kantin"
         ]);

         Roles::create([
            "name" => "siswa"
         ]);


         User::create([
            "name" => "ikhsan_adrians",
            "role_id" => 4,
            "password" => bcrypt("mahabarata")
         ]);

         User::create([
            "name" => "admin",
            "role_id" => 1,
            "password" => bcrypt("admin123")
         ]);

         User::create([
            "name" => "bank",
            "role_id" => 2,
            "password" => bcrypt("bank123")
         ]);

         User::create([
            "name" => "kantin",
            "role_id" => 3,
            "password" => bcrypt("kantin123")
         ]);

         Category::create([
            "name" => "Desert"
         ]);

         Category::create([
            "name" => "Snack"
         ]);


         Category::create([
            "name" => "Drink"
         ]);

         Category::create([
            "name" => "Stationary"
         ]);

         $foods = [
            "Chitato", "Qtela", "Lays", "Doritos", "Pringles", "Taro", "Chiki", "Cheetos", "Garuda", "Pilus",
            "Jet-Z", "Happy Tos", "Makaroni Ngehe", "Kusuka", "Sukro", "Dua Kelinci", "Nano Nano", "Beng-Beng",
            "SilverQueen", "Tic Tac", "Fox's", "Gery", "Roma Malkist", "Oreo", "Tango", "Nabati", "Nextar",
            "Kiss", "Astor", "Selamat", "Superstar", "Gandum Mas", "Nyam Nyam", "Snickers", "M&M's", "Kit Kat",
            "Twix", "Haribo", "Marshmallow", "Yupi", "Choco Pie", "Monde", "Khong Guan", "Nissin", "Regal",
            "Better", "Good Time", "Sari Gandum", "Biskuat", "Marie", "Slai O'lai", "Beng-Beng Maxx", "Chacha",
            "Pocky", "Hello Panda", "Fisherman's Friend", "Mentos", "Kopiko", "Mayora", "Energen", "Fullo",
            "Top", "Tic Tac Toe", "Koko Krunch", "Cornetto", "SilverKing", "Mr. Hottest", "Mr. P", "Mr. Potato",
            "Lotte", "Kanmuri", "Kracie", "Meiji", "Glico", "Calbee", "Kameda Seika", "Bourbon", "Tohato",
            "UHA Mikakuto", "Morinaga", "Kasugai", "Koikeya", "Riskha", "Richeese", "Richoco", "So Nice",
            "So Good", "So Yummy", "So Crunchy", "So Tasty", "So Fun", "So Cool", "So Fresh", "So Hot",
            "So Spicy", "So Sweet", "So Delicious", "So Amazing", "So Wonderful", "So Incredible", "So Fantastic",
            "Pop Mie", "Indomie", "Sarimi", "Supermi", "Mie Sedaap", "Mie Gelas", "Mie ABC", "Mie Gaga",
            "Mie Kremezz", "Mie Burung Dara", "Mie Tropicana Slim", "Mie Kuah Susu", "Mie Janda", "Mie Samyang",
            "Mie Ghost Pepper", "Mie Ufo", "Mie Sedap Cup", "Mie Gacoan", "Mie Ayam Bakso", "Mie Ayam Jamur",
            "Mie Ayam Ceker", "Mie Ayam Special", "Mie Ayam Tumini", "Mie Ayam Warkop", "Mie Ayam Pelangi",
            "Mie Ayam Bakar", "Mie Ayam Pangsit", "Mie Ayam Keju", "Mie Ayam Blackpepper", "Mie Ayam Gravy",
            "Mie Ayam Mafia", "Mie Ayam Level", "Mie Ayam Pedas Manis", "Mie Ayam Pedas Mampus",
            "Mie Ayam Super Pedas", "Mie Ayam Bumbu Rujak", "Mie Ayam Bumbu Bali", "Mie Ayam Bumbu Jawa",
            "Mie Ayam Bumbu Padang", "Mie Ayam Bumbu Sate", "Mie Ayam Bumbu Kacang", "Mie Ayam Bumbu Tongseng",
            "Mie Ayam Bumbu Rendang", "Mie Ayam Bumbu Gulai", "Mie Ayam Bumbu Green Chilli", "Mie Ayam Bumbu Tom Yum",
            "Mie Ayam Bumbu Curry", "Mie Ayam Bumbu Lemongrass", "Mie Ayam Bumbu Teriyaki", "Mie Ayam Bumbu Tikka Masala",
            "Mie Ayam Bumbu Pesto", "Mie Ayam Bumbu Alfredo", "Mie Ayam Bumbu Carbonara", "Mie Ayam Bumbu Cheese",
            "Mie Ayam Bumbu Mushroom", "Mie Ayam Bumbu Onion", "Mie Ayam Bumbu Garlic", "Mie Ayam Bumbu Herb",
            "Mie Ayam Bumbu Spice", "Mie Ayam Bumbu BBQ", "Mie Ayam Bumbu Honey Mustard", "Mie Ayam Bumbu Hot Sauce"
        ];


         foreach ($foods as $food) {
            Product::create([
                "name" => $food,
                "price" =>  rand(5000, 25000),
                "stock" => rand(10, 100),
                "photo" => "",
                "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                "quantity_sold" => 0,
                "category_id" => rand(1,4),
                "stand" => 2
            ]);
         }

         Wallet::create([
           "user_id" => 1,
           "credit" => 100000,
           "debit" => 0
         ]);


         
    $topUps = [
        ["user_id" => 1, "nominals" => 100000, "unique_code" => "TOPUP123", "status" => "unconfirmed"],
        ["user_id" => 2, "nominals" => 50000, "unique_code" => "TOPUP456", "status" => "confirmed"],
        ["user_id" => 3, "nominals" => 200000, "unique_code" => "TOPUP789", "status" => "rejected"],
    ];

    foreach ($topUps as $topUp) {
        TopUp::create($topUp);
    }








    }
}