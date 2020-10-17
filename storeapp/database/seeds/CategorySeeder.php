<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
        insert into Categories(title, slug, status) values 
            ('Iphone', 'iphone', '1'),
            ('SamSung', 'SamSung', '1'),
            ('Oppo', 'Oppo', '1'),
            ('Xiaomi', 'Xiaomi', '1'),
            ('Vivo', 'Vivo', '1'),
            ('Realme', 'Realme', '1'),
            ('OnePlus', 'OnePlus', '1'),
            ('Vsmart', 'Vsmart', '1'),
            ('Nokia', 'Nokia', '1'),
            ('Huawei', 'Huawei', '1'),
            ('Mobell', 'Mobell', '1'),
            ('Itel', 'Itel', '1'),
            ('Masstel', 'Masstel', '1'),
            ('BlackBerry', 'BlackBerry', '1'),
            ('Energizer', 'Energizer', '1'),
            ('coolPad', 'coolPad', '1')
        ");
    }
}
