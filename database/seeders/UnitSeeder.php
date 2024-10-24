<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/json/satuan.json");
        $datas = json_decode($json);
        foreach ($datas as $key => $value) {
            Unit::create([
                "name" => $value->name,
            ]);
        }
    }
}
