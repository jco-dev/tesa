<?php

namespace App\Controllers;

use App\Libraries\Ssp;
use App\Controllers\BaseController;
use App\Models\UsuarioGrupoModel;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;

class Persona extends BaseController
{
    public $model;
    public $grupoModel;
    public function __construct()
    {
        $this->model = model('App\Models\PersonaModel');
        $this->grupoModel = model('App\Models\GrupoModel');
    }

    public function index(): string
    {
        return view('persona/index');
    }

    public function listadoPersonasAjax(): ResponseInterfaceAlias
    {
        $table = "vista_personas";
        $primaryKey = 'id_persona';
        $where = "estado='REGISTRADO'";
        $columns = [
            ['db' => 'id_persona', 'dt' => 0],
            ['db' => 'ci', 'dt' => 1],
            ['db' => 'nombres', 'dt' => 2],
            ['db' => 'fecha_nacimiento', 'dt' => 3],
            ['db' => 'celular', 'dt' => 4],
            ['db' => 'correo_electronico', 'dt' => 5],
            ['db' => 'estado', 'dt' => 6, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTRADO</span>';
                else
                    return '<span class="badge badge-danger">ELIMINADO</span>';
            }],
            [
                'db' => 'id_persona',
                'dt' => 7,
                'formatter' => function ($d, $row) {
                    return '<button class="btn btn-sm btn-warning btn-editar" data-id="' . $d . '">Editar</button>';
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

    public function vistaAgregar(): ResponseInterfaceAlias
    {
        $vista = view('persona/agregar', [
            'grupos' => $this->grupoModel->findAll(),
        ]);
        return $this->response->setJSON([
            'vista' => $vista,
        ]);
    }

    public function VerificarPersona(): ResponseInterfaceAlias
    {
        $ci = trim($this->request->getVar('ci'));
        $persona = $this->model->where('ci', $ci)->first();

        $responseData = ['exito' => false];

        if ($persona)
            $responseData = ['exito' => true, 'msg' => 'La persona ya se encuentra registrada'];

        return $this->response->setJSON($responseData);
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
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $id_persona = $this->model->insert([
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
            $usuarioModel = model('App\Models\UsuarioModel');
            $data_usuario = [
                'id_usuario' => $id_persona,
                'usuario' => explode(' ', trim($this->request->getVar('nombre')))[0] . trim($this->request->getVar('ci')),
                'clave' => password_hash(trim($this->request->getVar('ci')), PASSWORD_DEFAULT),
                'estado' => 'ACTIVO'
            ];

            $usuarioModel->insert($data_usuario);

            $grupoUsuarioModel = model('App\Models\UsuarioGrupoModel');
            $data_grupo_usuario = [
                'id_usuario' => $id_persona,
                'id_grupo' => $this->request->getVar('rol'),
                'fecha_inicio' => date('Y-m-d'),
                'fecha_fin' => $this->ultimoDiaGestionActual(),
                'estado' => 'ACTIVO'
            ];
            $grupoUsuarioModel->insert($data_grupo_usuario);

            return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente la persona']);
        } else {
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar la persona']);
        }
    }

    private function ultimoDiaGestionActual(): string
    {
        return date('Y') . '-12-31';
    }

    public function edit(): ResponseInterfaceAlias
    {
        $id_persona = $this->request->getVar('id');
        $persona = $this->model->find($id_persona);
        $grupo =  (new UsuarioGrupoModel())->where(['id_usuario' => $id_persona])->first();
        $vista = view('persona/editar', [
            'persona' => $persona,
            'id_grupo_persona' => $grupo,
            'grupos' => $this->grupoModel->findAll(),
        ]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function update(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_persona' => 'required',
            'ci' => 'required|numeric|is_unique_ci_editar['.trim($this->request->getVar('ci')).']',
            'expedido' => 'required',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|numeric|is_unique_celular_editar['.trim($this->request->getVar('celular')).']',
            'correo_electronico' => 'required|valid_email|is_unique_email_editar['.trim($this->request->getVar('ci')).']',
            'genero' => 'required',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $respuesta = $this->model->update($this->request->getVar('id_persona'), [
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

        $usuarioModel = model('UsuarioModel');
        $usuarioModel->update(
            $this->request->getVar('id_persona'),
            ['usuario' => explode(' ', trim($this->request->getVar('nombre')))[0] . trim($this->request->getVar('ci'))]
        );

        $grupoUsuarioModel = model('UsuarioGrupoModel');
        $grupoUsuarioModel->update(
            ['id_usuario' => $this->request->getVar('id_persona')],
            ['id_grupo' => $this->request->getVar('rol')]
        );

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro modificado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al modificar el registro']);

    }
}
