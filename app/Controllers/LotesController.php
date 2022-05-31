<?php

namespace App\Controllers;
use App\Models\tblrasaspuercos;
use App\Models\tbllotes;
use App\Models\tblcerdo;

class LotesController extends BaseController
{
    public function __construct()
    {
        $this->modelrasa = new tblrasaspuercos();
        $this->modellotes = new tbllotes();
        $this->modelcerdo = new tblcerdo();
    }
    public function index(){
        if($this->session->issetGran){
            echo view('layout/header');
            echo view('layout/natvar');
            echo view('inicial');
            echo view('layout/footer');
        }
        else{
            header("Location: login");
        }
    }

    public function listarRegistros(){
        if($this->session->issetGran){
            echo view('layout/header');
            echo view('layout/natvar');
            echo view('listRegistros');
            echo view('layout/footer');
        }
        else{
            header("Location: login");
        }
    }

    public function cargarRazas(){
        $rasasDisponibles = $this->modelrasa->totalRazas();
        $array_temporal=[];
        for ($i=0; $i < count($rasasDisponibles) ; $i++) { 
            array_push($array_temporal,$rasasDisponibles[$i]['nombreRaza']);
        }
        return json_encode($array_temporal);
    }
    public function cargarestados(){
        $rasasDisponibles = $this->modelrasa->totalEstados();
        $array_temporal=[];
        for ($i=0; $i < count($rasasDisponibles) ; $i++) {
            array_push($array_temporal,$rasasDisponibles[$i]['nombre']);
        }
        return json_encode($array_temporal);
    }
    public function agregarRazas(){

        $nameRaza=$this->request->getPost('nameRasa');
        if($nameRaza!=''){

            $isseRasa=$this->modelrasa->issetRasa($nameRaza);
            echo  json_encode($isseRasa);
        }
        else{
            return json_encode(['status'=>false,'msj'=>'Todos los campos son obligatorios','data'=>null,'error'=>204]);
        }

    }
    public function generarName(){
        return json_encode($this->cadenaAleatoria(10));
    }
    public function cadenaAleatoria($longitud=null)
    {
        //crear alfabeto
        $mayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $minus = "abcdefghijklmnopqrstuvwxyz";
        $mayusculas = str_split($mayus);    //Convertir a array
        $minusculas = str_split($minus);    //Convertir a array
        //crear array de numeros 0-9
        $numeros = range(0,9);
        //revolver arrays
        shuffle($mayusculas);
        shuffle($numeros);
        shuffle($minusculas);
        //Unir arrays
        $arregloTotal = array_merge($mayusculas,$numeros,$minusculas);
        $newToken = "";
        for($i=0;$i<$longitud;$i++) {
            $miCar = $this->obtenCaracterAleatorio($arregloTotal);
            $newToken .= $this->obtenCaracterMd5($miCar);
        }
        return $newToken;
    }
    private function obtenCaracterAleatorio($arreglo)
    {
        $clave_aleatoria = array_rand($arreglo, 1); //obtén clave aleatoria
        return $arreglo[ $clave_aleatoria ];    //devolver ítem aleatorio
    }
    private function obtenCaracterMd5($car)
    {
        $md5Car = md5($car.Time()); //Codificar el carácter y el tiempo POSIX (timestamp) en md5
        $arrCar = str_split(strtoupper($md5Car));   //Convertir a array el md5
        $carToken = $this->obtenCaracterAleatorio($arrCar);    //obtén un ítem aleatoriamente
        return $carToken;
    }
    public function createLote(){
        $namelote=$this->request->getPost('namelote');
        $cerdostotales=$this->request->getPost('cerdostotales');
        $cerdosEnfermos=$this->request->getPost('cerdosEnfermos');
        $cerdorMuertos=$this->request->getPost('cerdorMuertos');
        $cerdosSanos=$this->request->getPost('cerdosSanos');
        $rasaCerdos=$this->request->getPost('rasaCerdos');

        if($namelote == ''){
            return json_encode(['status'=>false,'msj'=>'todos los campos son obligatorios','data'=>null,'error'=>204]);
        }
        if($cerdostotales == ''){
            return json_encode(['status'=>false,'msj'=>'todos los campos son obligatorios','data'=>null,'error'=>204]);
        }
        $creacionLote = $this->modellotes->createLote($namelote,$cerdostotales,$this->session->idUsuario);
        if($creacionLote['status']){
            $idLote=$creacionLote['data'];
            if($cerdosEnfermos == 0 && $cerdorMuertos== 0 && $cerdosSanos == 0 ){
                $cerdosSanos=$cerdostotales;
            }
            $cerdosCreate=intval($cerdosEnfermos)+intVal($cerdorMuertos)+intVal($cerdosSanos);
            if($cerdosCreate!=$cerdostotales){
                $cerdosFaltantes=intVal($cerdostotales)-intVal($cerdosCreate);
                $cerdosSanos=intVal($cerdosSanos)+intVal($cerdosFaltantes);
                $cerdosCreate=intVal( $cerdosCreate)+intVal($cerdosFaltantes);
            }
           
            $obtenerIdraza=$this->modelrasa->obtenerid($rasaCerdos);

            if(intVal($cerdostotales)==intVal($cerdosCreate)){
                $cerdosCreados=0;
                for ($j=0; $j < intval($cerdosEnfermos); $j++) { 
                    $data_insert=[
                        'idLote'=>$idLote,
                        'idEstado'=>2,
                        'idRasa'=>$obtenerIdraza,
                        'usuarioCreador'=>$this->session->idUsuario,
                        'nombreCerdo'=>$namelote.'_'.$idLote.'_'.$j,
                        'peso'=>0,
                        'fechaCreacion'=>date('Y-m-d'),
                        'fechaActualizacion'=>date('Y-m-d'),
                    ];
                    $issetCreatecerdo=$this->modelcerdo->createCerdo($data_insert);
                    if(!$issetCreatecerdo['status']){
                        return json_encode($issetCreatecerdo);
                    }
                    else{
                        $cerdosCreados=$cerdosCreados+1;
                    }
                }
                for ($i=0; $i < intval($cerdorMuertos); $i++) { 
                    $data_insert=[
                        'idLote'=>$idLote,
                        'idEstado'=>3,
                        'idRasa'=>$obtenerIdraza,
                        'usuarioCreador'=>$this->session->idUsuario,
                        'nombreCerdo'=>$namelote.'_'.$idLote.'_'.$j,
                        'peso'=>0,
                        'fechaCreacion'=>date('Y-m-d'),
                        'fechaActualizacion'=>date('Y-m-d'),
                    ];
                    $issetCreatecerdo=$this->modelcerdo->createCerdo($data_insert);
                    if(!$issetCreatecerdo['status']){
                        return json_encode($issetCreatecerdo);
                    }
                    else{
                        $cerdosCreados=$cerdosCreados+1;
                    }
                }
                for ($h=0; $h < intval($cerdosSanos); $h++) { 
                    $data_insert=[
                        'idLote'=>$idLote,
                        'idEstado'=>1,
                        'idRasa'=>$obtenerIdraza,
                        'usuarioCreador'=>$this->session->idUsuario,
                        'nombreCerdo'=>$namelote.'_'.$idLote.'_'.$j,
                        'peso'=>0,
                        'fechaCreacion'=>date('Y-m-d'),
                        'fechaActualizacion'=>date('Y-m-d'),
                    ];
                    $issetCreatecerdo=$this->modelcerdo->createCerdo($data_insert);
                    if(!$issetCreatecerdo['status']){
                        return json_encode($issetCreatecerdo);
                    }
                    else{
                        $cerdosCreados=$cerdosCreados+1;
                    }
                }
                if($cerdosCreados==$cerdostotales){
                    return json_encode(['status'=>true,'msj'=>'lote registrado con exito','data'=>$idLote,'error'=>null]);
                }
                else{
                    return json_encode(['status'=>false,'msj'=>'se presenta un error en el calculo para la creacion de los cerdos','data'=>null,'error'=>'algun puto error de mrd']);
                }
            }
            else{
                return json_encode(['status'=>false,'msj'=>'se presenta un error en el calculo para la creacion de los cerdos','data'=>null,'error'=>['cerdosCreados'=>$cerdostotales,'cerdos a crear'=>$cerdosCreate]]);
            }
        }
        else{
            return json_encode($creacionLote);
        }

    }
    public function datosGeneralesLote(){
        $idLote=$this->request->getPost('id_lote');
        $dataLote=$this->modellotes->dataGeneral($idLote);
        return json_encode($dataLote);
    }
    public function dataLoteUser(){
        $perfil_user=$this->session->perfil;
        $dataLotes=[];
        if($perfil_user == 1){
            $datalotes= $this->modellotes->datalotesAdmin();
        }
        else{
            $datalotes= $this->modellotes->datalotesUser($this->session->idusuario);
        }
        if($datalotes['status']){
            $i=1;
            foreach ($datalotes['data'] as $data) {
                $array[]=[
                    'indicativo'=>$i,
                    'usuario'=>$data->numero_lote,
                    'nombre'=>$data->cantidaCerdos
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

    public function dataGlobalLotesRegistros(){
        $datalotes= $this->modellotes->datalotesTotales();
        if($datalotes['status']){
            $i=1;
            foreach ($datalotes['data'] as $data) {
                $array[]=[
                    "indicativo"=>$i,
                    "lote"=>$data['numero_lote'],
                    "cantidad"=>$data['cantidaCerdos'],
                    "fechaCreacion"=>$data['fechaCreacion'],
                    "usuarioCreador"=>$data['nombre'].' '.$data['apellido'],
                    "tipoUsurio"=>($data['perfil']==1)?'Administrado':'Granjero',
                    "documento"=>$data['documento'],
                    "telefono"=>$data['telefono'],
                    "correo"=>$data['correo']
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


    public function dataGlobalLote(){

        $iddatalote=$this->request->getGet('idlotePOST');
        if($iddatalote == ''){
            return json_encode(['status'=>false,'msj'=>'Todos los campos son obligatorios para poder listar la informacion']);
        }
        $datalotes= $this->modellotes->dataGlobalLote($iddatalote);
        if($datalotes['status']){
            $i=1;
            foreach ($datalotes['data'] as $datan) {

                $opciones ="<button type='button' class='btn btn-secondary' onclick='editarDataCerdo({$datan->idCerdo})'>Modificar</button>";
                $array[]=[
                    'indicativo'=>$i,
                    'lote'=>$datan->numero_lote,
                    'nombre'=>$datan->nombreCerdo,
                    'peso'=>$datan->peso,
                    'raza'=>$datan->nombreRaza,
                    'estado'=>$datan->estado,
                    'opciones'=> $opciones,
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
    public function datosCerdosLote(){
        $idCerdo=$this->request->getPost('idCerdo');
        $dataCerdo=$this->modelcerdo->dataCerdo($idCerdo);
        return json_encode($dataCerdo);
    }
    public function EditarCerdoInvi(){
        $idCerdo=$this->request->getPost('idCerdo');
        $pesoCerd=$this->request->getPost('pesoCerdo');
        $estadoCerdo=$this->request->getPost('estadoCerdo');
        $razaCerdo=$this->request->getPost('razaCerda');
        $responseCerdo=$this->modelrasa->updateDataCerdo($idCerdo,$pesoCerd,$estadoCerdo,$razaCerdo);
        return json_encode($responseCerdo);
    }
}