<?php
namespace App\Models;

use CodeIgniter\Model;

class tbllotes extends Model
{
    public function createLote($namelote=null,$cerdostotales=null,$idUSer=null){
        if($namelote == null){
            return ['status'=>false,'msj'=>'todos los campos son obligatorios','data'=>null,'error'=>204];
        }
        if($cerdostotales == null){
            return ['status'=>false,'msj'=>'todos los campos son obligatorios','data'=>null,'error'=>204];
        }
        $data=[
            'numero_lote'=>$namelote,
            'fechaCreacion'=>date('Y-m-d'),
            'usuarioCreador'=>$idUSer,
            'cantidaCerdos'=>$cerdostotales
        ];
        $response = [];
        $statusInsert=$this->db->table('tbllotes')->insert($data);
        if($statusInsert){
           $response = ['status'=>true,'msj'=>'Lote creado con exito','data'=>$this->db->insertID(),'code'=>200,'error'=>null];
        }
        else{
            $response = ['status'=>false,'msj'=>'Fallo la creacion del lote','data'=>null,'code'=>204,'error'=>$statusInsert];
        }
        return $response;
    }

    public function dataGeneral($nameLote=null){
        if($nameLote!=null){

            $dataLoteID= $this->db->table('tbllotes')->where('numero_lote',$nameLote)->get()->getResultArray();
            if(count($dataLoteID)==0){
                return  ['status'=>false,'msj'=>'el lote que intenta consultar no exxiste'];
            }
            $idLote= $dataLoteID[0]['id_lote'];

            $builder = $this->db->table('tblcerdo');
            $builder->where('idEstado','2');
            $builder->where('idLote',$idLote);
            $TotalEnfermos = $builder->countAllResults();

            $builder = $this->db->table('tblcerdo');
            $builder->where('idEstado','3');
            $builder->where('idLote',$idLote);
            $TotalMuertos = $builder->countAllResults();

            $builder = $this->db->table('tblcerdo');
            $builder->where('idEstado','1');
            $builder->where('idLote',$idLote);
            $Totalsanos = $builder->countAllResults();

            $builder=$this->db->table('tbllotes');
            $builder->where('id_lote',$idLote);
            $dataLote= $builder->get()->getResultArray();

            $builder=$this->db->table('tblCerdo');
            $builder->select('SUM(peso) as peso ,count(idCerdo) as total_cerdos');
            $builder->where('idLote',$idLote);
            $sumaPesoCerdos= $builder->get()->getResultArray();
            $promedio_peso=0;
            if(count($sumaPesoCerdos)>0){
                $promedio_peso=intVal($sumaPesoCerdos[0]['peso'])/ intVal($sumaPesoCerdos[0]['total_cerdos']);
            }

            $data_result=[
                'total_enfermos'=>$TotalEnfermos,
                'total_muertos'=>$TotalMuertos,
                'total_sanos'=>$Totalsanos,
                'promedio_peso'=>$promedio_peso,
                'nombre_lote'=>(count($dataLote)>0)?$dataLote[0]['numero_lote']:'',
                'total_cerdos'=>(count($dataLote)>0)?$dataLote[0]['cantidaCerdos']:'',
            ];

            return ['status'=>true,'data'=>$data_result,'msj'=>'datos cargados'];
        }
        else{
            return ['status'=>false,'msj'=>'Todos los campos son obligtorios para generar la consulta'];
        }
    }

    public function datalotesAdmin(){
        $builder=$this->db->table('tbllotes')->get()->getResult();
        $response=[];
        if(count($builder)>0){
            $response=['status'=>true,'msj'=>'datos cargados con exito','data'=>$builder];
        }
        else{
            $response=['status'=>false,'msj'=>'Fallo la forma en la que se carga los datos','data'=>$builder];
        }
        return $response;
    }

    public function datalotesUser($idUsuario){
        $builder=$this->db->table('tbllotes')->where('usuarioCreador',$idUsuario)->get()->getResult();
        $response=[];
        if(count($builder)>0){
            $response=['status'=>true,'msj'=>'datos cargados con exito','data'=>$builder];
        }
        else{
            $response=['status'=>false,'msj'=>'Fallo la forma en la que se carga los datos','data'=>$builder];
        }
        return $response;
    }

    public function datalotesTotales(){
        $builder=$this->db->table('tbllotes');
        $builder->select('tbllotes.id_lote,tbllotes.numero_lote,tbllotes.cantidaCerdos,tbllotes.fechaCreacion,tblusuarios.nombre,tblusuarios.apellido,tblusuarios.perfil,tblusuarios.documento,tblusuarios.telefono,tblusuarios.correo');
        $builder->join('tblusuarios','tblusuarios.idUser=tbllotes.usuarioCreador');
        $sumaPesoCerdos= $builder->get()->getResultArray();
        $response=[];
        if(count($sumaPesoCerdos)>0){
            $response=['status'=>true,'msj'=>'datos cargados con exito','data'=>$sumaPesoCerdos];
        }
        else{
            $response=['status'=>false,'msj'=>'Fallo la forma en la que se carga los datos','data'=>$sumaPesoCerdos];
        }
        return $response;
    }

    public function dataGlobalLote($namelote=null){
        if($namelote == null){
            return ['status'=>false,'msj'=>'toda la informacion es necesaria para generar la consulta'];
        }
        $dataLoteID= $this->db->table('tbllotes')->where('numero_lote',$namelote)->get()->getResultArray();
        if(count($dataLoteID)==0){
            return  ['status'=>false,'msj'=>'el lote que intenta consultar no exxiste'];
        }
        $iddatalote= $dataLoteID[0]['id_lote'];

        $builder=$this->db->table('tblcerdo');
        $builder->select('tblcerdo.idCerdo,tblcerdo.nombreCerdo, tblcerdo.peso, tbllotes.numero_lote, tblestado.nombre as estado, tblrasaspuercos.nombreRaza');
        $builder->join('tbllotes','tbllotes.id_lote=tblcerdo.idLote');
        $builder->join('tblestado','tblestado.idEstado=tblcerdo.idEstado');
        $builder->join('tblrasaspuercos','tblrasaspuercos.idRaza=tblcerdo.idRasa');
        $builder->where('tblcerdo.idLote',$iddatalote);
        $data_lote=$builder->get()->getResult();
        $response=[];
        if(count($data_lote)>0){
            $response = ['status'=>true,'msj'=>'datos cargados con exito','data'=>$data_lote];
        }
        else{
            $response = ['status'=>false, 'msj'=>'se presento un error al cargar la informacion con respecto a lo lote'];
        }
        return $response;
    }
}
