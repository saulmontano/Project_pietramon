<?php
namespace App\Models;

use CodeIgniter\Model;


class TblUsuarios extends Model
{
    public function issetUsuario($usuario = null,$password = null)
    {
        if($usuario == null){
            echo json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar el usuario']);
            return;
        }
        if($password == null){
            echo json_encode(['status'=>false,'code'=>'204','msj'=>'Todos los campos son obligatorios','error'=>'Falta por dilingeciar la Password']);
            return;
        }

        $dataUsuario=$this->db->table('tblusuarios')->select('idUser,nombre,apellido,password,perfil')->where('usuario',$usuario)->get()->getResultArray();
        $response=[];
        if(count($dataUsuario)>0){
            if(password_verify($password, $dataUsuario[0]['password'])){
                $response=['status'=>true,'code'=>200,'msj'=>'Los datos fueron cargados exitosamente','data'=>$dataUsuario[0]];
            }
            else{
                $response=['status'=>false,'code'=>204,'msj'=>'Las credenciales que intentas utilizar no son las correctas','error'=>'credenciales erradas'];
            }
        }
        else{
            $response=['status'=>false,'code'=>204,'msj'=>'el usuario no se encuentra registrado','error'=>'usuario no registrado'];
        }
        return $response;
    }
    public function verifickUserIsset($usuario=null){

        $response=[];
        if($usuario != null){
            $dataUsuario=$this->db->table('tblusuarios')->where('usuario',$usuario)->get()->getResultArray();
            if(count( $dataUsuario)>0){
                $response=['status'=>true,'code'=>204,'msj'=>'ese usuario ya se encuentra registrado.'];
            }
            else{
                $response=['status'=>false,'code'=>204,'msj'=>'el usuario no se encuentra registrado'];
            }
        }
        else{
            $response=['status'=>true,'code'=>204,'msj'=>'Falta usuario para completar los datos para la consulta'];
        }
        return $response;
    }
    public function RegistroUsuario($dataInsert = null){
        $response=[];
        if($dataInsert != null){
            $dataUsuario=$this->db->table('tblusuarios')->insert($dataInsert);
            if($dataUsuario){
                $response=['status'=>true,'code'=>200,'msj'=>'Usuario registrado con exito','error'=>null];
            }else{
                $response=['status'=>false,'code'=>204,'msj'=>'el usuario no se pudo ser registrado','error'=>$dataUsuario];
            }
        }
        else{
            $response=['status'=>false,'code'=>204,'msj'=>'el usuario no se encuentra registrado','error'=>'usuario no registrado'];
        }
        return $response;
    }
    public function UpdateUsuario($dataInsert = null,$idUsuario=null){
        $response=[];
        if($dataInsert != null){
            $dataUsuario=$this->db->table('tblusuarios')->where('idUser',$idUsuario)->update($dataInsert);
            if($dataUsuario){
                $response=['status'=>true,'code'=>200,'msj'=>'Usuario actualizado con exito','error'=>null];
            }else{
                $response=['status'=>false,'code'=>204,'msj'=>'el usuario no se pudo ser actualizado','error'=>$dataUsuario];
            }
        }
        else{
            $response=['status'=>false,'code'=>204,'msj'=>'el usuario no se encuentra registrado','error'=>'usuario no registrado'];
        }
        return $response;
    }
    public function getUSers($idUser=null){
        $response=[];
        if($idUser == null){
            $dataUsuarios=$this->db->table('tblusuarios')->select('idUser,usuario,nombre,apellido,documento,telefono,correo')->where('perfil',2)->get()->getResult();
            if(count($dataUsuarios)>0){
                $response=['status'=>true,'code'=>200,'msj'=>'usuarios cargados con exito','error'=>null,'data'=>$dataUsuarios];
            }
            else{
                $response=['status'=>false,'code'=>204,'msj'=>'no hay usuarios registrados','error'=>'usuario no registrado'];
            }
        }
        else{
            $dataUsuario=$this->db->table('tblusuarios')->select('idUser,usuario,nombre,apellido,documento,telefono,correo')->where('perfil',2)->where('idUser',$idUser)->get()->getResult();
            if(count($dataUsuario)>0){
                $response=['status'=>true,'code'=>200,'msj'=>'usuario cargados con exito','error'=>null,'data'=>$dataUsuario[0]];
            }
            else{
                $response=['status'=>false,'code'=>204,'msj'=>'no hay usuarios registrados','error'=>'usuario no registrado'];
            }
        }
        return $response;
    }
    public function deleteUser($id_usuario=null){
        $response=[];
        if($id_usuario!=null){
            $dataUsuario=$this->db->table('tblusuarios')->where('idUser',$id_usuario)->delete();
            if( $dataUsuario){
                $response=['status'=>true,'msj'=>'usuario eliminado con exito','error'=>200,'data'=>null];
            }
            else{
                $response=['status'=>false,'msj'=>'se presento un error al intentar eliminar el usuario','error'=>204,'data'=>$dataUsuario];

            }
        }
        else{
            $response=['status'=>false,'msj'=>'Todos los campos on obligatorios','error'=>204,'data'=>null];
        }
        return $response;
    }
}