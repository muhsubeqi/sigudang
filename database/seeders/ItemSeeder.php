<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/json/barang.json");
        $datas = json_decode($json);
        foreach ($datas as $key => $value) {
            Item::create([
                "code" => $value->id,
                "name" => $value->name,
                "type_id" => $value->category,
                "stock" => $value->quantity,
                "unit_id" => $value->unit
            ]);
        }
    }
}
