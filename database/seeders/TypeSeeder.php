<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get("database/data/json/jenis.json");
        $datas = json_decode($json);
        foreach ($datas as $key => $value) {
            Type::create([
                "name" => $value->name,
            ]);
        }
    }
}
