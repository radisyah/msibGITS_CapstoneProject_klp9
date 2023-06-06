<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Products;
use App\Models\NomorMeja;
use App\Models\Categories;
use App\Models\Roles;
use App\Models\User;
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
        Roles::create([
            'level' => 'Super Admin'
        ]);

        Roles::create([
            'level' => 'Admin Dapur'
        ]);

        Roles::create([
            'level' => 'Admin Kasir'
        ]);

        User::create([
            'role_id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => \Hash::make('12345')
        ]);

        User::create([
            'role_id' => 2,
            'name' => 'Admin Dapur',
            'email' => 'admindapur@gmail.com',
            'password' => \Hash::make('12345')
        ]);

        User::create([
            'role_id' => 3,
            'name' => 'Admin Kasir',
            'email' => 'adminkasir@gmail.com',
            'password' => \Hash::make('12345')
        ]);

        Categories::create([
            'category_name' => 'Makanan'
        ]);

        Categories::create([
            'category_name' => 'Minuman'
        ]);

        Products::create([
            'product_code' => 'K001',
            'name' => 'Kwetiaw Goreng Ori',
            'purchase_price' => '10000',
            'selling_price' => '18000',
            'stock' => '100',
            'image' => 'products/kwetiau.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'K002',
            'name' => 'Kwetiaw Goreng Bakso',
            'purchase_price' => '12000',
            'selling_price' => '20000',
            'stock' => '50',
            'image' => 'products/kwetiaugorengbakso.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'K003',
            'name' => 'Kwetiaw Goreng Seafood',
            'purchase_price' => '13000',
            'selling_price' => '22000',
            'stock' => '50',
            'image' => 'products/kwetiaugorengseafood.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'K004',
            'name' => 'Kwetiaw Rebus',
            'purchase_price' => '10000',
            'selling_price' => '18000',
            'stock' => '100',
            'image' => 'products/kwetiaurebus.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'N005',
            'name' => 'Nasi Goreng Ori',
            'purchase_price' => '10000',
            'selling_price' => '18000',
            'stock' => '100',
            'image' => 'products/nasgor.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'N006',
            'name' => 'Nasi Groeng Bakso',
            'purchase_price' => '12000',
            'selling_price' => '20000',
            'stock' => '50',
            'image' => 'products/nasigoreng.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'N007',
            'name' => 'Nasi Goreng Seafood',
            'purchase_price' => '13000',
            'selling_price' => '22000',
            'stock' => '50',
            'image' => 'products/nasigorengseafood.jpg',
            'category_id' => 1,
        ]);

        Products::create([
            'product_code' => 'M001',
            'name' => 'Es Teh',
            'purchase_price' => '1000',
            'selling_price' => '4000',
            'stock' => '200',
            'image' => 'products/esteh.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'M002',
            'name' => 'Es Jeruk',
            'purchase_price' => '2000',
            'selling_price' => '5000',
            'stock' => '100',
            'image' => 'products/esjeruk.jpg',
            'category_id' => 2,
        ]);

        //gambar baru sampai sini

        Products::create([
            'product_code' => 'M003',
            'name' => 'Air Putih',
            'purchase_price' => '1000',
            'selling_price' => '2000',
            'stock' => '100',
            'image' => 'products/airputih.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'M004',
            'name' => 'Cimory Yougrt',
            'purchase_price' => '8000',
            'selling_price' => '15000',
            'stock' => '50',
            'image' => 'products/cimory.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'M005',
            'name' => 'Fanta Merah',
            'purchase_price' => '5000',
            'selling_price' => '8000',
            'stock' => '50',
            'image' => 'products/fanta.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'M006',
            'name' => 'Olate',
            'purchase_price' => '8000',
            'selling_price' => '13000',
            'stock' => '40',
            'image' => 'products/olate.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'M007',
            'name' => 'Teh Pucuk Harum',
            'purchase_price' => '4000',
            'selling_price' => '6000',
            'stock' => '100',
            'image' => 'products/pucuk.jpg',
            'category_id' => 2,
        ]);

        Products::create([
            'product_code' => 'M008',
            'name' => 'Sprite',
            'purchase_price' => '3000',
            'selling_price' => '5000',
            'stock' => '50',
            'image' => 'products/sprite.jpg',
            'category_id' => 2,
        ]);

        NomorMeja::create([
            'nomor_meja' => '1',
            'qr' => 'qrs/1.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '2',
            'qr' => 'qrs/2.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '3',
            'qr' => 'qrs/3.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '4',
            'qr' => 'qrs/4.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '5',
            'qr' => 'qrs/5.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '6',
            'qr' => 'qrs/6.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '7',
            'qr' => 'qrs/7.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '8',
            'qr' => 'qrs/8.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '9',
            'qr' => 'qrs/9.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '10',
            'qr' => 'qrs/10.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '11',
            'qr' => 'qrs/11.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '12',
            'qr' => 'qrs/12.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '13',
            'qr' => 'qrs/13.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '14',
            'qr' => 'qrs/14.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '15',
            'qr' => 'qrs/15.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '16',
            'qr' => 'qrs/16.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '17',
            'qr' => 'qrs/17.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '18',
            'qr' => 'qrs/18.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '19',
            'qr' => 'qrs/19.png'
        ]);
        NomorMeja::create([
            'nomor_meja' => '20',
            'qr' => 'qrs/20.png'
        ]);

    }   
}
