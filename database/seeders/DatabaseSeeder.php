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
            "Nasi Goreng",
            "Mie Goreng",
            "Ayam Goreng",
            "Bakso",
            "Soto Ayam",
            "Gado-Gado",
            "Rendang",
            "Martabak",
            "Pempek",
            "Ketoprak",
            "Sop Buntut",
            "Sop Iga",
            "Sop Ayam",
            "Sop Kambing",
            "Sop Seafood",
            "Ketupat Sayur",
            "Lontong Cap Go Meh",
            "Rawon",
            "Sambal Goreng Ati",
            "Sayur Asem",
            "Sayur Lodeh",
            "Sayur Nangka",
            "Sayur Sop",
            "Selat Solo",
            "Semur Jengkol",
            "Sop Bening",
            "Sop Buah",
            "Sop Kacang",
            "Sop Merah",
            "Sop Timlo",
            "Sop Waluh",
            "Soto Betawi",
            "Soto Daging",
            "Soto Kudus",
            "Soto Medan",
            "Soto Padang",
            "Soto Semarang",
            "Soto Tangkar",
            "Soto Tauto",
            "Soto Mie",
            "Soto Babat",
            "Soto Banjar",
            "Soto Batok",
            "Soto Kaki",
            "Soto Kikil",
            "Soto Sokaraja",
            "Soto Sulung"
         ];

         foreach ($foods as $food) {
            Product::create([
                "name" => $food,
                "price" =>  rand(5000, 20000),
                "stock" => rand(10, 50),
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






    }
}