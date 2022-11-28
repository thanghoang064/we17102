<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // viết những câu lệnh tạo dữ liệu mẫu vào đây
        // thư viện db buider query của laravel
        //lệnh thêm dữ liệu và bảng tương đương câu lệnh INSERT INTO BLA BLA
//        $arrData = [];
//
//
//        for($i = 0;$i <100;$i++) {
//            $arrData[] = [
//                "name"=>"nguyen van " . ($i+1),
//                "birth"=>"2020-10-19",
//                "create_at"=>date('Y-m-d H:i:s'),
//                "update_at"=>date('Y-m-d H:i:s'),
//            ];
//        }
//        DB::table('tests')->insert(
//            $arrData
//        );
        $arrData = [];
                for($i = 0;$i <100;$i++) {
            $arrData[] = [
                "name"=>"nguyen van " . ($i+1),
                'email'=>"poly".($i+1)."@gmail.com",
                'password'=> Hash::make('123456'),
                "created_at"=>date('Y-m-d H:i:s'),
                "updated_at"=>date('Y-m-d H:i:s'),
            ];
        }
        DB::table('users')->insert($arrData);
        // tao 50 du lieu moi bang cho csdl khach san hom no minh da tao
        //bang migrate
    }
}
