<?php

use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ram
        DB::table('ram')->insert([
            array('title'=> "1GB"),
            array('title'=> "2GB"),
            array('title'=> "3GB"),
            array('title'=> "4GB"),
            array('title'=> "6GB"),
            array('title'=> "8GB"),
            array('title'=> "12GB"),
            array('title'=> "16GB"),
        ]);

        //screens
        DB::table('screens')->insert([
            array('title'=> "DH"),
            array('title'=> "FHD"),
            array('title'=> "4K")
        ]);

        //Screensize
        DB::table('screensize')->insert([
            array('title'=> "DH"),
            array('title'=> "FHD"),
            array('title'=> "4K")
        ]);
        //pin
        DB::table('pin')->insert([
            array('title'=> "1000"),
            array('title'=> "2000"),
            array('title'=> "3000"),
            array('title'=> "4000")
        ]);
        //sim
        DB::table('sim')->insert([
            array('title'=> "Nano-SIM"),
            array('title'=> "eSIM")
        ]);
        //Internalmemory
        DB::table('internalmemory')->insert([
            array('title'=> "16GB"),
            array('title'=> "32GB"),
            array('title'=> "64GB"),
            array('title'=> "128GB")
        ]);
        //Size
        DB::table('size')->insert([
            array('title'=> "Apple"),
            array('title'=> "Samsung"),
            array('title'=> "Oppo"),
            array('title'=> "Huawei")
        ]);
        //Manufacturer
        DB::table('weight')->insert([
            array('title'=> "Apple"),
            array('title'=> "Samsung"),
            array('title'=> "Oppo"),
            array('title'=> "Huawei")
        ]);

        //Weight
        DB::table('weight')->insert([
            array('title'=> "Apple"),
            array('title'=> "Samsung"),
            array('title'=> "Oppo"),
            array('title'=> "Huawei")
        ]);

        //Screenresolution
        DB::table('screenresolution')->insert([
            array('title'=> "Apple"),
            array('title'=> "Samsung"),
            array('title'=> "Oppo"),
            array('title'=> "Huawei")
        ]);

        //Operatingsystem
        DB::table('operatingsystem')->insert([
            array('title'=> "Apple"),
            array('title'=> "Samsung"),
            array('title'=> "Oppo"),
            array('title'=> "Huawei")
        ]);

    }
}
