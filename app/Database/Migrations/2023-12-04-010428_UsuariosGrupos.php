<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuariosGrupos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_grupo_usuario' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false,
                'auto_increment' => true,
            ],
            'id_usuario' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
            ],
            'id_grupo' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
            ],
            'fecha_inicio' => [
                'type' => 'DATE',
                'null' => false
            ],
            'fecha_fin' => [
                'type' => 'DATE',
                'null' => true
            ],
            'creado_el TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'actualizado_el' => [
                'type' => 'TIMESTAMP',
                'null' => true,
                'default' => null,
                'on update' => 'CURRENT_TIMESTAMP',
            ],
            'estado' => [
                'type'       => 'ENUM',
                'constraint' => ['ACTIVO', 'ELIMINADO'],
                'default'    => 'ACTIVO',
                'null'       => false
            ],
        ]);

        $this->forge->addKey('id_grupo_usuario', true);
        $this->forge->addForeignKey('id_usuario', 'usuarios', 'id_usuario');
        $this->forge->addForeignKey('id_grupo', 'grupos', 'id_grupo');

        $this->forge->createTable('grupos_usuarios', true, [
            'ENGINE' => 'InnoDB',
            'CHARACTER SET' => 'utf8',
            'COLLATE' => 'utf8_general_ci'
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('grupos_usuarios', true);
    }
}
