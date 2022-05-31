<?php

namespace App\Controllers;
use App\Models\TblUsuarios;

class Usuarios extends BaseController
{
    public function validarUsuario(){
        $this->modelUser = new  TblUsuarios();
        $usuario=$this->request->getPost('usuario');
        $password=$this->request->getPost('password');
        if($usuario == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el usuario']);
        }
        if($password == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar la Password']);
        }
        $issetUser=$this->modelUser->issetUsuario($usuario,$password);
        if($issetUser['status']){
            $dataUsuario=$issetUser['data'];
            $dataSession=[
                'issetGran'=>true,
                'idUsuario'=>$dataUsuario['idUser'],
                'nombre'=>$dataUsuario['nombre'],
                'apellido'=>$dataUsuario['apellido'],
                'perfil'=>$dataUsuario['perfil']
            ];
            $this->session->set($dataSession);
            return json_encode(['status'=>true,'code'=>'200','msj'=>'inicio sastifactorio','error'=>null]);
        }
        else{
            return json_encode($issetUser);
        }
    }
    public function listarUsuarios(){
        if($this->session->issetGran){
            echo view('layout/header');
            echo view('layout/natvar');
            echo view('user');
            echo view('layout/footer');
        }
        else{
            header("Location: Home/index");
        }
    }
    public function dataTablaUsuarios(){
            $this->modelUser = new  TblUsuarios();
            $usuarios=$this->modelUser->getUSers();
            if($usuarios['status']){
                $i=1;
                foreach ($usuarios['data'] as $data) {
                    $array[]=[
                        'indicativo'=>$i,
                        'usuario'=>$data->usuario,
                        'nombre'=>$data->nombre,
                        'apellido'=>$data->apellido,
                        'perfil'=> 'Granjero',
                        'documento'=> $data->documento,
                        'telefono'=>$data->telefono,
                        'correo'=>$data->correo,
                        'opciones'=>"<div class='grid sm:grid-cols-2 gap-3'>
                        <button class='flex items-center justify-center gap-2 h-9 shadow-sm py-1.5 px-3 rounded-md bg-green-100 border border-transparent hover:border-green-500' id='$data->idUser' onclick='editarUser($data->idUser)'>
                          <span class='text-green-500'>editar</span>
                          <i class='fa-solid fa-pen-to-square'></i>
                        </button>
                      </div>",
                    ];
                    $i++;
                }
                $data=['data'=>$array];
                echo json_encode($array);
                exit();
            }
            else{
                echo json_encode(['data'=>'']);
                exit();
            }

    }
    public function listarUsuario(){
        $this->modelUser = new  TblUsuarios();
        $idUsuario = $this->request->getPost('idUsuario');
        $usuariosIssets = $this->modelUser->getUSers($idUsuario);
        return json_encode($usuariosIssets);
    }
    public function registro(){
        $this->modelUser = new  TblUsuarios();
        $usuario = $this->request->getPost('usuario');
        if($usuario == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el usuario']);
        }
        $nombre = $this->request->getPost('nombre');
        if($nombre == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el nombre']);
        }
        $apellidos = $this->request->getPost('apellidos');
        if($apellidos == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el apellidos']);
        }
        $perfil = 2;
        $password = $this->request->getPost('password');
        if($password == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el password']);
        }
        $fechaCreacion = date('Y-m-d');
        $documento = $this->request->getPost('documento');
        if($documento == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el documento']);
        }
        $telefono=$this->request->getPost('telefono');
        $correo=$this->request->getPost('correo');

        $verifickUserIsset=$this->modelUser->verifickUserIsset($usuario);
        
        if($verifickUserIsset['status']){
            $verifickUserIsset['status']=false;
            return json_encode($verifickUserIsset);
        }
        $dataInsert=[
            'usuario'=>$usuario,
            'nombre'=> $nombre,
            'apellido'=>$apellidos,
            'password'=>password_hash($password, PASSWORD_DEFAULT),
            'fechaCreacion'=>$fechaCreacion,
            'perfil'=>$perfil,
            'documento'=>$documento,
            'telefono'=>$telefono,
            'correo'=>$correo
        ];

        $statusUser = $this->modelUser->RegistroUsuario($dataInsert);
        return json_encode($statusUser);

    }
    public function update(){
        $this->modelUser = new  TblUsuarios();
        $idUsuario= $this->request->getPost('idUsuario');
        if($idUsuario == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el idUsuario']);
        }
        $usuario = $this->request->getPost('usuario');
        if($usuario == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el usuario']);
        }
        $nombre = $this->request->getPost('nombre');
        if($nombre == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el nombre']);
        }
        $apellidos = $this->request->getPost('apellidos');
        if($apellidos == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el apellidos']);
        }
        $perfil = 2;
        if($this->request->getPost('password')!=null){
            $password =$this->request->getPost('password') ;
            if($password == null){
                return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el password']);
            }
        }
        
        $fechaCreacion = date('Y-m-d');
        $documento = $this->request->getPost('documento');
        if($documento == null){
            return json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el documento']);
        }
        $telefono=$this->request->getPost('telefono');
        $correo=$this->request->getPost('correo');

        $dataInsert=[
            'usuario'=>$usuario,
            'nombre'=> $nombre,
            'apellido'=>$apellidos,
            'fechaCreacion'=>$fechaCreacion,
            'perfil'=>$perfil,
            'documento'=>$documento,
            'telefono'=>$telefono,
            'correo'=>$correo
        ];
        if($this->request->getPost('password')!=null){
            $dataInsert['password']=password_hash($password, PASSWORD_DEFAULT);
        }
        $statusUser = $this->modelUser->UpdateUsuario($dataInsert,$idUsuario);
        return json_encode($statusUser);
    }
}
