<?php
namespace App\Models;

use CodeIgniter\Model;

class tblcerdo extends Model
{

    public function createCerdo($data=[]){
        if( $data != null){
            $statusInser=$this->db->table('tblcerdo')->insert($data);
            if($statusInser){
                return ['status'=>true,'msj'=>'creacion exitosa','data'=>null,'error'=>null];
            }
            else{
                return ['status'=>false,'msj'=>'se presento un error en la creacion','data'=>null,'error'=>$statusInser];
            }
        }
        else{
            return ['status'=>false,'msj'=>'los datos son necesarios para la creacion','data'=>null,'error'=>'los datos no estan completos'];
        }
    }

    public function dataCerdo($idCerdo = null){
        if($idCerdo != null){
            $builder=$this->db->table('tblcerdo');
            $builder->select('tblcerdo.idCerdo,tblcerdo.nombreCerdo, tblcerdo.peso, tbllotes.numero_lote, tblestado.nombre as estado, tblrasaspuercos.nombreRaza');
            $builder->join('tbllotes','tbllotes.id_lote=tblcerdo.idLote');
            $builder->join('tblestado','tblestado.idEstado=tblcerdo.idEstado');
            $builder->join('tblrasaspuercos','tblrasaspuercos.idRaza=tblcerdo.idRasa');
            $builder->where('tblcerdo.idCerdo',$idCerdo);
            $data_lote=$builder->get()->getResult();

            if(count($data_lote)>0){
                return ['status'=>true,'msj'=>'creacion exitosa','data'=>$data_lote[0],'error'=>null];
            }
            else{
                return ['status'=>false,'msj'=>'se presento un error en cargar la informacion','data'=>null,'error'=>$data_lote];
            }
        }
        else{
            return ['status'=>false,'msj'=>'los datos son necesarios para la creacion','data'=>null,'error'=>'los datos no estan completos'];

        }
    }
}