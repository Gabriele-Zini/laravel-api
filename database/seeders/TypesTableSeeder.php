<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Type;

class TypesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types=['frontend', 'backend', 'desing', 'fullstack', 'AI tools', 'saas'];

        foreach($types as $type) {
            $newType=new Type;
            $newType->name=$type;
            $newType->slug=Str::slug($newType->name);
            $newType->save();

        }

    }
}
