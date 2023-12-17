<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultUser extends Seeder
{
    public function run()
    {
        $persona = [
            'id_persona' => 1,
            'ci' => '123123',
            'expedido' => 'LP',
            'nombre' => 'Juan Carlos',
            'paterno' => 'Perez',
            'materno' => 'Perez',
            'fecha_nacimiento' => '1992-05-05',
            'celular' => '70648629',
            'correo_electronico' => 'juanperez@gmail.com',
            'genero' => 'M',
            'direccion' => 'Av. America #123',
        ];

        $this->db->table('personas')->insert($persona);

        $usuario = [
            'id_usuario' => 1,
            'usuario' => 'JUAN123123',
            'clave' => password_hash('123123', PASSWORD_DEFAULT),
        ];
        $this->db->table('usuarios')->insert($usuario);

        $grupo_usuario = [
            'id_grupo_usuario' => 1,
            'id_usuario' => 1,
            'id_grupo' => 1,
            'fecha_inicio' => date('Y-m-d H:i:s'),
            'fecha_fin' => null,
        ];
        $this->db->table('usuarios_grupos')->insert($grupo_usuario);

    }
}
