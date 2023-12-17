<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    public function login(): string
    {
        return view('auth/login');
    }

    public function autentificar()
    {
        $validation = $this->validate([
            'usuario' => 'required',
            'clave' => 'required|min_length[5]'
        ]);


        if (!$validation) {
            $respuesta = $this->formatErrores($this->validator->getErrors());
            return redirect()->back()->withInput()->with('errores', $respuesta);
        }

        $session = session();
        $usuario = $this->request->getPost('usuario');
        $clave = $this->request->getPost('clave');

        $usuario = model('UsuarioModel')->where('usuario', $usuario)->first();

        if(!$usuario)
            return redirect()->back()->withInput()->with('error', 'Error al ingresar el usuario o contraseña');

        if (!password_verify($clave, $usuario->clave))
            return redirect()->back()->withInput()->with('error', 'Error al ingresar el usuario o contraseña');

        $persona = model('PersonaModel')->find($usuario->id_usuario);
        $grupos = model('PersonaModel')->getGrupoUsuarioModel($usuario->id_usuario);
        $grupos = $this->gruposPersona($grupos);

        $session->set([
            'id'                    => $usuario->id_usuario,
            'nombre'                => $persona->nombre,
            'paterno'               => $persona->paterno,
            'materno'               => $persona->materno,
            'correo_electronico'   => $persona->correo_electronico,
            'grupos'                => $grupos,
            'genero'                => $persona->genero,
            'autenticado'           => true
        ]);

        return redirect()->to(base_url(route_to('home')));
    }

    private function formatErrores(array $errors): string
    {
        $ul = '<ul>';
        foreach ($errors as $error) {
            $ul .= sprintf('<li>%s</li>', htmlspecialchars($error, ENT_QUOTES, 'UTF-8'));
        }
        $ul .= '</ul>';

        return $ul;
    }

    private function gruposPersona(array $grupos): string
    {
        $grupo = '';
        foreach ($grupos as $g)
            $grupo .= $g->nombre_grupo . ',';

        return substr($grupo, 0, -1);
    }

    public function salir(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to(base_url(route_to('login')));
    }
}
