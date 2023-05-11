<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Categories;
use App\Models\Food;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Courier;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Food::create([
        //     'title' => 'Bakso enak',
        //     'excerpt' => 'Bakso harga murah pasti kenyang',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla voluptatibus repudiandae dolor sequi molestias animi alias fugit officia, nam mollitia recusandae quibusdam sit saepe earum quis. Rem quam nemo totam.',
        //     'id_category' => 1,
        //     'price' => 15000,
        //     'stock' => 10,
        //     'ratting' => 4,
        //     'image' => 'bakso.png',
        //     'slug' => 'bakso-enak'
        // ]);
        // Food::create([
        //     'title' => 'Nasi Goreng',
        //     'excerpt' => 'Nasi Goreng Terenak',
        //     'body' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nulla voluptatibus repudiandae dolor sequi molestias animi alias fugit officia, nam mollitia recusandae quibusdam sit saepe earum quis. Rem quam nemo totam.',
        //     'id_category' => 2,
        //     'price' => 20000,
        //     'stock' => 5,
        //     'ratting' => 5,
        //     'image' => 'nasi.png',
        //     'slug' => 'nasi-goreng'
        // ]);
        // Categories::create([
        //     'name' => 'Bakso',
        //     'slug' => 'bakso',
        // ]);
        // Categories::create([
        //     'name' => 'Nasi',
        //     'slug' => 'nasi',
        // ]);
        // Order::create([
        //     'id_user' => 2,
        //     'id_food' => 1,
        //     'status' => 'packed',
        //     'quantity' => 5,
        //     'subtotal' => 75000,

        // ]);
        // Transaction::create([
        //     'id_order' => 1,
        //     'bukti' => '1000.png',

        // ]);
        // Order::create([
        //     'id_user' => 2,
        //     'id_food' => 1,
        //     'status' => 'unpaid',
        //     'quantity' => 4,
        //     'subtotal' => 75000,

        // ]);
        // Order::create([
        //     'id_user' => 2,
        //     'id_food' => 1,
        //     'status' => 'unpaid',
        //     'quantity' => 10,
        //     'subtotal' => 75000,

        // ]);
        // Order::create([
        //     'id_user' => 2,
        //     'id_food' => 1,
        //     'status' => 'shipped',
        //     'quantity' => 3,
        //     'subtotal' => 75000,

        // ]);
        // Order::create([
        //     'id_user' => 2,
        //     'id_food' => 1,
        //     'status' => 'done',
        //     'quantity' => 1,
        //     'subtotal' => 75000,

        // ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 0-5 km : Rp 13.000',
            'price' => 13000,
        ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 5,1-15 km : Rp 18.000',
            'price' => 18000,
        ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 15,1-20 km : Rp 21.000',
            'price' => 21000,
        ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 20,1-25 km : 25.000',
            'price' => 25000,
        ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 25,1-30 km : 33.000',
            'price' => 35000,
        ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 30,1-35 km : 39.000',
            'price' => 39000,
        ]);
        Courier::create([
            'ket' => 'Jarak Pengiriman 35,1-40 km : 49.000',
            'price' => 49000,
        ]);
        $users = [
            [
               'name'=>'Admin User',
               'email'=>'admin@test.com',
               'type'=>1,
               'password'=> bcrypt('password'),
            ],
            [
               'name'=>'Fachrul Rozi',
               'email'=>'user@test.com',
               'receiver'=>'Fachrul',
               'address'=>'kp pangkalan',
               'telephone'=>'085884653526',
               'type'=>0,
               'password'=> bcrypt('password'),
            ],
        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}