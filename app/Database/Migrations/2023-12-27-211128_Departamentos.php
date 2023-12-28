<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Departamentos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_departamento' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'codigo' => [
                'type' => 'VARCHAR',
                'constraint' => '2',
            ],

            'nombre_departamento' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'unique' => true,
                'null' => false,
            ],

            'estado_departamento' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
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
                'constraint' => ['REGISTRADO', 'ELIMINADO'],
                'default'    => 'REGISTRADO',
                'null'       => false
            ],

        ]);

        $this->forge->addKey('id_departamento', true);
        $this->forge->createTable('departamentos');
    }

    public function down()
    {
        $this->forge->dropTable('departamentos');
    }
}
