<?php
namespace App\Models;

use CodeIgniter\Model;


class tblrasaspuercos extends Model
{

    public function totalRazas(){
        $data=$this->db->table('tblrasaspuercos')->get()->getResultArray();
        return $data;
    }
    public function totalEstados(){
        $data=$this->db->table('tblestado')->get()->getResultArray();
        return $data;
    }
    public function issetRasa($nameRaza=null){
        $response=[];
        if($nameRaza!=null){
            $data=$this->db->table('tblrasaspuercos')->where('nombreRaza',$nameRaza)->get()->getResultArray();
            if(count($data)==0){
                $datainsert=['nombreRaza'=>$nameRaza];
                $insertRaza=$this->db->table('tblrasaspuercos')->insert($datainsert);

                $response= ['status'=>true,'msj'=>'Raza agregada con exito','data'=>$insertRaza];
            }
            else{
                $response=  ['status'=>false,'msj'=>'Raza no fue agregada con exito'];
            }
        }else{
            $response=  ['status'=>false,'msj'=>'Todos los campos son obligatorios'];
        }
        return  $response;
    }

    public function obtenerid($nameRaza=null){
        $raza=$this->db->table('tblrasaspuercos')->where('nombreRaza',$nameRaza)->get()->getResultArray();
        if(count($raza)>0){
            return intVal($raza[0]['idRaza']);
        }
        else{
            return 6;
        }
    }

    public function obteneridEstado($nameRaza=null){
        $raza=$this->db->table('tblestado')->where('nombre',$nameRaza)->get()->getResultArray();
        if(count($raza)>0){
            return intVal($raza[0]['idEstado']);
        }
        else{
            return 1;
        }
    }

    public function updateDataCerdo($idCerdo = null,$pesoCerd = null,$estadoCerdo = null,$razaCerdo=null){

        $idRaza=$this->obtenerid($razaCerdo);
        $idEstado=$this->obteneridEstado($estadoCerdo);

        $dataUpdate=[
            'peso'=>$pesoCerd,
            'idEstado'=>$idEstado,
            'idRasa'=>$idRaza,
            'fechaActualizacion'=>date('Y-m-d')
        ];

        $statusInsert=$this->db->table('tblcerdo')->where('idCerdo',$idCerdo)->update($dataUpdate);
        $response=[];
        if($statusInsert){
            $response=['status'=>true,'msj'=>'datos actualizados con exito','data'=>$statusInsert,'error'=>null];
        }
        else{
            $response=['status'=>false,'msj'=>'Fallo actulizacion de lo datos','data'=>null,'error'=>$statusInsert];
        }
        return $response;
    }

}