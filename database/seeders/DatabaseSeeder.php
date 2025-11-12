<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Biene;
use App\Models\Director;
use App\Models\Estado;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(RoleSeeder::class);

        User::create([
            'name' => 'Alexandra',
            'email'=> 'shv72963@gmail.com',
            'password'=> Hash::make('12345678'),
            'nombres' => 'Alexandra',
            'apellidos' => 'Vargas',
            'tipo_documento' => 'DNI',
            'numero_documento' => '12345678',
            'celular' => '987654321',
            'fecha_nacimiento' => '2004-01-01',
            'genero' => 'Femenino',    
            'direccion' => 'Av. Siempre Viva 123',
            'estado'=>true,
        ])->assignRole('ADMINISTRADOR');
       
    }
}
