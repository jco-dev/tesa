<?php

namespace App\Controllers;

use App\Libraries\Ssp;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;

class Grupo extends BaseController
{
    public function index(): string
    {
        return view('grupo/index');
    }

    public function listadoRolesAjax(): ResponseInterfaceAlias
    {
        $table = "grupos";
        $primaryKey = 'id_grupo';
        $where = NULL;
        $columns = [
            ['db' => 'id_grupo', 'dt' => 0],
            ['db' => 'nombre_grupo', 'dt' => 1],
            ['db' => 'creado_el', 'dt' => 2, 'formatter' => function($fecha, $fila){
                return date('d/m/Y H:i:s', strtotime($fecha));
            }],
            ['db' => 'estado', 'dt' => 3, 'formatter' => function ($d, $row) {
                if ($d == 'ACTIVO')
                    return '<span class="badge badge-success">ACTIVO</span>';
                else
                    return '<span class="badge badge-danger">INACTIVO</span>';
            }]
        ];

        $db = \Config\Database::connect();

        $sql_details = array(
            'user' => $db->username,
            'pass' => $db->password,
            'db' => $db->database,
            'host' => $db->hostname
        );

        return $this->response->setJSON(
            json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where))
        );
    }
}
