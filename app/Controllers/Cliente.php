<?php

namespace App\Controllers;

use App\Libraries\Ssp;
use App\Controllers\BaseController;

class Cliente extends BaseController
{

    private $model;
    private $personaModel;

    public function __construct()
    {
        $this->model = model('App\Models\ClienteModel');
        $this->personaModel = model('App\Models\PersonaModel');
    }

    public function index()
    {
        return view('cliente/index');
    }

    public function listadoClientesAjax()
    {
        $table = "vista_clientes";
        $primaryKey = 'id_persona';
        $where = NULL;
        $columns = [
            ['db' => 'id_persona', 'dt' => 0],
            ['db' => 'ci', 'dt' => 1],
            ['db' => 'nombres', 'dt' => 2],
            ['db' => 'fecha_nacimiento', 'dt' => 3],
            ['db' => 'celular', 'dt' => 4],
            ['db' => 'correo_electronico', 'dt' => 5],
            ['db' => 'departamento', 'dt' => 6],
            ['db' => 'total_compra', 'dt' => 7],
            ['db' => 'estado', 'dt' => 8, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTRADO</span>';
                else
                    return '<span class="badge badge-danger">ELIMINADO</span>';
            }],
            [
                'db' => 'id_persona',
                'dt' => 9,
                'formatter' => function ($d, $row) {
                    return '
                        <button class="btn btn-icon btn-sm btn-warning btn-editar" data-id="' . $d . '">
                            <i class="fa-solid fa-pencil"></i>
                        </button>
                        <button class="btn btn-icon btn-sm btn-danger btn-eliminar" data-id="' . $d . '" data-usuario="' . $row['nombres'] . '">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    ';
                }
            ]
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

    public function vistaAgregar()
    {
        $vista = view('cliente/agregar', ['municipios' => $this->model->listadoMunicipios()]);
        return $this->response->setJSON([
            'vista' => $vista,
        ]);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'ci' => 'required|numeric|is_unique[personas.ci]',
            'expedido' => 'required',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|numeric|is_unique[personas.celular]',
            'correo_electronico' => 'required|valid_email|is_unique[personas.correo_electronico]',
            'genero' => 'required',
            'id_municipio' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $id_persona = $this->personaModel->insert([
            'ci' => trim($this->request->getVar('ci')),
            'expedido' => trim($this->request->getVar('expedido')),
            'nombre' => mb_convert_case(trim($this->request->getVar('nombre')), MB_CASE_UPPER, "UTF-8"),
            'paterno' => mb_convert_case(trim($this->request->getVar('paterno')), MB_CASE_UPPER, "UTF-8"),
            'materno' => mb_convert_case(trim($this->request->getVar('materno')), MB_CASE_UPPER, "UTF-8"),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'celular' => trim($this->request->getVar('celular')),
            'correo_electronico' => trim($this->request->getVar('correo_electronico')),
            'genero' => trim($this->request->getVar('genero')),
            'direccion' => mb_convert_case(trim($this->request->getVar('direccion')), MB_CASE_UPPER, "UTF-8"),
            'estado' => 'REGISTRADO'
        ]);

        if (is_numeric($id_persona)) {
            $clienteModel = model('App\Models\ClienteModel');
            $data_cliente = [
                'id_cliente' => $id_persona,
                'id_usuario' => $_SESSION['id'],
                'id_municipio' => $this->request->getVar('id_municipio'),
            ];

            $clienteModel->insert($data_cliente);

            return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente el cliente']);
        } else {
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar el cliente']);
        }
    }

    public function edit()
    {
        $id_persona = $this->request->getVar('id');
        $persona = $this->personaModel->find($id_persona);
        $cliente = $this->model->where('id_cliente', $id_persona)->first();

        $vista = view('cliente/editar', [
            'persona' => $persona,
            'cliente' => $cliente,
            'municipios' => $this->model->listadoMunicipios()
        ]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function update()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_persona' => 'required',
            'ci' => 'required|numeric|is_unique_ci_editar[' . trim($this->request->getVar('ci')) . ']',
            'expedido' => 'required',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|numeric|is_unique_celular_editar[' . trim($this->request->getVar('celular')) . ']',
            'correo_electronico' => 'required|valid_email|is_unique_email_editar[' . trim($this->request->getVar('ci')) . ']',
            'genero' => 'required',
            'id_municipio' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $respuesta = $this->personaModel->update($this->request->getVar('id_persona'), [
            'ci' => trim($this->request->getVar('ci')),
            'expedido' => trim($this->request->getVar('expedido')),
            'nombre' => mb_convert_case(trim($this->request->getVar('nombre')), MB_CASE_UPPER, "UTF-8"),
            'paterno' => mb_convert_case(trim($this->request->getVar('paterno')), MB_CASE_UPPER, "UTF-8"),
            'materno' => mb_convert_case(trim($this->request->getVar('materno')), MB_CASE_UPPER, "UTF-8"),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'celular' => trim($this->request->getVar('celular')),
            'correo_electronico' => trim($this->request->getVar('correo_electronico')),
            'genero' => trim($this->request->getVar('genero')),
            'direccion' => mb_convert_case(trim($this->request->getVar('direccion')), MB_CASE_UPPER, "UTF-8"),
            'estado' => 'REGISTRADO'
        ]);

        $this->model->update(
            $this->request->getVar('id_persona'),
            [
                'id_usuario' => $_SESSION['id'],
                'id_municipio' => $this->request->getVar('id_municipio'),
            ]
        );

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro modificado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al modificar el registro']);
    }

    public function delete()
    {
        $id_cliente = $this->request->getVar('id');
        $respuesta = $this->model->update($id_cliente, ['estado' => 'ELIMINADO']);
       
        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro eliminado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al eliminar el registro']);
    }
}
