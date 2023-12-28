<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Municipios extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_municipio' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            'id_provincia' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null'           => false
            ],

            'nombre_municipio' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
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

        $this->forge->addKey('id_municipio', true);
        $this->forge->addForeignKey('id_provincia', 'provincias', 'id_provincia', 'CASCADE', 'CASCADE');
        $this->forge->createTable('municipios');
    }

    public function down()
    {
        $this->forge->dropTable('municipios');
    }
}
