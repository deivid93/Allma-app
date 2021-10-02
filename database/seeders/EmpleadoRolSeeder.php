<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleado_rol')->insert([
            ['empleado_id' => 3, 'rol_id' => 4],
            ['empleado_id' => 3, 'rol_id' => 7],
            ['empleado_id' => 3, 'rol_id' => 2],
            ['empleado_id' => 4, 'rol_id' => 1],
            ['empleado_id' => 4, 'rol_id' => 2]
        ]);
    }
}
