<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            ['id'=>1, 'nombre' => 'Administrativa y Financiera'],
            ['id'=>2,'nombre' => 'Ingeniería'],
            ['id'=>5,'nombre' => 'Desarrollo de Negocio'],
            ['id'=>6,'nombre' => 'Proyectos'],
            ['id'=>7,'nombre' => 'Servicios'],
            ['id'=>8,'nombre' => 'Calidad']
        ]);
        
    }
}
