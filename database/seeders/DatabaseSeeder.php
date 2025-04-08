<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/* class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
 */

 //Clase para llenar la base de datos con ejemplos
class DatabaseSeeder extends Seeder {
    //Agregamos 2 usuarios de prueba
    public function run() {
        User::create([
            'name' => 'user01',
            'email' => 'user01@example.com',
            'password' => bcrypt('user0001'), // Contraseña encriptada
        ]);

        User::create([
            'name' => 'user02',
            'email' => 'user02@example.com',
            'password' => bcrypt('user0002'), // Contraseña encriptada
        ]);

        //Agregamos 3 tareas d eprueba
        Task::create([
            'title' => 'Tarea de ejemplo',
            'description' => 'Descripción de la tarea',
            'state' => 'pending',
            'expiration_at' => now()->addDays(5),
            'priority' => 1,
            'category' => 'trabajo',
            'user_id' => 1, // Relación con el usuario ID 1
        ]);
        Task::create([
            'title' => 'Tarea de ejemplo',
            'description' => null,
            'state' => 'pending',
            'expiration_at' => null,
            'priority' => 1,
            'category' => 'trabajo',
            'user_id' => 1, // Relación con el usuario ID 1
        ]);
        Task::create([
            'title' => 'Tarea de usuario2',
            'description' => 'Descripción de la tarea',
            'state' => 'pending',
            'expiration_at' => now()->addDays(3),
            'priority' => 1,
            'category' => 'trabajo',
            'user_id' => 2, // Relación con el usuario ID 1
        ]);
    }
}
