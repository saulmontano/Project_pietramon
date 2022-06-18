<div class="container">
    <div class="row">
        <div style="position: relative;top: 5vh;" class="shadow-none p-3 mb-5 bg-light rounded col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="row">
                <h6>creacion de lotes de cerdos</h6>
                <div class="col-md-2">
                    <label for="NameLote">Lote</label>
                    <input type="text" id="NameLote" class="form-control">
                </div>
                <div class="col-md-1">
                    <button type="text" id="geLote" class="btn btn-outline-primary" style="top: 22px;position: relative;"><i class="fa-solid fa-arrow-rotate-right"></i></button>
                </div>
                <div class="col-md-2">
                    <label for="cerdosTotal">Cantidad Total</label>
                    <input type="number" id="cerdosTotal" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="cerdosEnfermos">Total enfermos</label>
                    <input type="number" id="cerdosEnfermos" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="cerdosmuertos">Total muertos</label>
                    <input type="number" id="cerdosmuertos" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="cerdossanos">Total sanos</label>
                    <input type="number" id="cerdossanos" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="razaCerdos">Tipo de raza</label>
                    <select class="form-select" aria-label="Default select example" id="razaCerdos">
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="">Agregar Nueva raza</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" id='inpuNameRaza' aria-label="Example text with button addon" aria-describedby="button-addon1">
                        <button class="btn btn-outline-primary" type="button" id="aggRaza"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" style="top: 22px;position: relative;" id="createLote">Crear Lote</button>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 shadow-none p-3 mb-5 bg-light rounded" style="position: relative;top: 5vh;" >
            <h5>Consultar lote</h5>
            <div class="row">
                <div class="col-md-9 col-lg-9 col-xs-9 col-sm-9">
                    <input type="text" class="form-control" id="ConsultLote">
                </div>
                <div class="col-md-1 col-lg-1 col-xs-1 col-sm-1">
                    <button class="btn btn-primary" type="button" id="btnConsulta"><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div class="col-md-2 col-lg-2 col-xs-2 col-sm-2" >
                    <button class="btn btn-primary" type="button" id="loadDataUser">Mis lotes</button>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12" style="position: relative;top: 5vh;">
            <div class="row">
                <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12 shadow-none p-3 mb-5 bg-light rounded">
                    <div class="row">
                        <h5>Informacion global del lote</h5>
                        <div class="col-md-2">
                            <label for="NameLoteGeneral">Lote</label>
                            <input type="text" id="NameLoteGeneral" class="form-control" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="NumbercantidadGeneral">Cantidad Total</label>
                            <input type="text" id="NumbercantidadGeneral" class="form-control" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="Numberenfermosgeneral">Total enfermos</label>
                            <input type="text" id="Numberenfermosgeneral" class="form-control" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="NumbermuertosGeneral">Total muertos</label>
                            <input type="text" id="NumbermuertosGeneral" class="form-control" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="NumbersanosGeneral">Total sanos</label>
                            <input type="text" id="NumbersanosGeneral" class="form-control" disabled>
                        </div>
                        <div class="col-md-2">
                            <label for="Promediopromediogeneral">Peso Promedio</label>
                            <input type="text" id="Promediopromediogeneral" class="form-control" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 shadow-none p-3 mb-5 bg-light rounded"  style="position: relative;top: 5vh;">
            <table  class="table"  id="tablaRegistrosLotes">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Lote</th>
                        <th >Nombre</th>
                        <th >Peso</th>
                        <th >Raza</th>
                        <th >Estado</th>
                        <th >Editar</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</div>


<!-- contenedor model-->
<div class="modal" tabindex="-1" id="modalLotesUser">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informaicon de lotes registrados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalLotesUSer"></button>
      </div>
      <div class="modal-body">
            <table  class="table"  id="tablalotesUser">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Lote</th>
                        <th >cantidad cerdos</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
      </div>
    </div>
  </div>
</div>
<!-- contenedor model editar-->
<div class="modal" tabindex="-1" id="modaleditarCerdo" style="width: 80%;left: 10%;top: 40%;">
  <div class="modal-dialog-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informaicon de lotes registrados</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalCerdo"></button>
      </div>
        <div class="modal-body">
            <div class="container fluid row">
                <h6>Modificacion Cerdo</h6>
                <input type="hidden" id="idCerdo" class="form-control" disabled>
                <div class="col-md-2">
                    <label for="NameLoteinput">Lote</label>
                    <input type="text" id="NameLoteinput" class="form-control" disabled>
                </div>
                <div class="col-md-2">
                    <label for="nameCerdo">Nombre Cerdo</label>
                    <input type="text" id="nameCerdo" class="form-control" disabled>
                </div>
                <div class="col-md-2">
                    <label for="pesoCerdo">Peso Cerdo</label>
                    <input type="text" id="pesoCerdo" class="form-control">
                </div>
                <div class="col-md-2">
                    <label for="razaCerdosinputEdit">Tipo de raza</label>
                    <select class="form-select" aria-label="Default select example" id="razaCerdosinputEdit">
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="EstadosCerdoedit">Estado</label>
                    <select class="form-select" aria-label="Default select example" id="EstadosCerdoedit">
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-outline-primary" style="top: 22px;position: relative;" id="Modificar_cerdo_data">Modificar</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- script para la creacion de lotes-->
<script>
    //generar nombre  aleatorio del lote
    $('#geLote').on('click',function(){
        $.ajax({
            type: "GET",
            url: "LotesController/generarName",
            dataType: "JSON",
            success: function (response) {
                $('#NameLote').val(response);
            }
        });
    });
    $(document).ready(function(){
        cargar_rasas();
    });
    function cargar_rasas(){
        document.getElementById("razaCerdos").innerHTML='';
        $.ajax({
            type: "GET",
            url: "LotesController/cargarRazas",
            dataType: "JSON",
            success: function (response) {
                let rasas= response;
                document.getElementById("razaCerdos").innerHTML += "<option value=''>Selepcione una</option>"
                for(var i in rasas)
                {
                    document.getElementById("razaCerdos").innerHTML += "<option value='"+rasas[i]+"'>"+rasas[i]+"</option>";
                }
            }
        });
    }
    $('#aggRaza').on('click',function(){
        let name_raza=$('#inpuNameRaza').val();
        if(name_raza == null){
            swal.fire('Debe agregar un nombre para la raza');
            return;
        }
        $.ajax({
            type: "POST",
            url: "LotesController/agregarRazas",
            data: {nameRasa:name_raza},
            dataType: "JSON",
            success: function (response) {
                if(response['status']){
                    Swal.fire(
                        'Registro exitoso',
                        response['msj'],
                        'success'
                    )
                    cargar_rasas();
                    $('#inpuNameRaza').val('');
                }
                else{
                    Swal.fire(
                                'Fallo el registro',
                                response['msj'],
                                'error'
                    )
                    return;
                }
            }
        });
    });
    $('#cerdosEnfermos').on('click',function(){
        $cantidad=$('#cerdosTotal').val();
        if($cantidad == ''){
            swal.fire('se debe establecer primero una cantidad total de cerdos');
        }
    })
    $('#cerdosmuertos').on('click',function(){
        $cantidad=$('#cerdosTotal').val();
        if($cantidad == ''){
            swal.fire('se debe establecer primero una cantidad total de cerdos');
        }
    })
    $('#cerdossanos').on('click',function(){
        $cantidad=$('#cerdosTotal').val();
        if($cantidad == ''){
            swal.fire('se debe establecer primero una cantidad total de cerdos');
        }
    })
    $('#cerdosmuertos').on('change',function(){
        let cerdostotales=$('#cerdosTotal').val();
        let cerdossanos=$('#cerdossanos').val();
        let cerdosenfermos=$('#cerdosEnfermos').val();
        let cantidad=$('#cerdosmuertos').val();
        let total_cerdos=cerdossanos+cerdosenfermos+ cantidad;

        if(cerdostotales < total_cerdos){
            swal.fire('la cantidad de cerdos muertos no puede ser mayor a la suma total o a la cantidad misma.');
            $('#cerdossanos').val(0);
            $('#cerdosEnfermos').val(0);
            $('#cerdosmuertos').val(0);
        }
    })
    $('#cerdosEnfermos').on('change',function(){
        let cerdostotales=$('#cerdosTotal').val();
        let cerdossanos=$('#cerdossanos').val();
        let cerdosenfermos=$('#cerdosEnfermos').val();
        let cantidad=$('#cerdosmuertos').val();
        let total_cerdos=cerdossanos+cerdosenfermos+ cantidad;

        if(cerdostotales < total_cerdos){
            swal.fire('la cantidad de cerdos muertos no puede ser mayor a la suma total o a la cantidad misma.');
            $('#cerdossanos').val(0);
            $('#cerdosEnfermos').val(0);
            $('#cerdosmuertos').val(0);
        }
    })
    $('#cerdossanos').on('change',function(){
        let cerdostotales=$('#cerdosTotal').val();
        let cerdossanos=$('#cerdossanos').val();
        let cerdosenfermos=$('#cerdosEnfermos').val();
        let cantidad=$('#cerdosmuertos').val();
        let total_cerdos=cerdossanos+cerdosenfermos+ cantidad;

        if(cerdostotales < total_cerdos){
            swal.fire('la cantidad de cerdos muertos no puede ser mayor a la suma total o a la cantidad misma.');
            $('#cerdossanos').val(0);
            $('#cerdosEnfermos').val(0);
            $('#cerdosmuertos').val(0);
        }
    })
    //crear lote 
    $('#createLote').on('click',function(){
        let nameLote=$('#NameLote').val();
        let cerdostotales=$('#cerdosTotal').val();
        let cerdosEnfermos=$('#cerdosEnfermos').val();
        let cerdorMuertos=$('#cerdosmuertos').val();
        let cerdosSanos=$('#cerdossanos').val();
        let rasaCerdos=$('#razaCerdos').val();
        if(nameLote == ''){
            swal.fire('Para la creacion de un lote debe tener un codigo establecido, lo puede generar automaticamente o ingreselo de manera manual.');
            return;
        }
        if(cerdostotales == ''){
            swal.fire('Todo lote debe contar con una cantidad minima de cerdos por favor diligencie la cantidad.');
            return;
        }
        swal.fire('Estas apunto de generar un lote, se crearan por unidad la totalidad de cerdo, la eidicion invidual de ellos la podras ver en el apartado global de lote.');
        window.Swal.fire({
            title:'Estamos generando la creacion del lote',
            icon: 'success',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showConfirmButton: false
        });
        window.Swal.showLoading();
        $.ajax({
            type: "POST",
            url: "LotesController/createLote",
            data: {
                namelote:nameLote.trim(),
                cerdostotales:cerdostotales.trim(),
                cerdosEnfermos:cerdosEnfermos.trim(),
                cerdorMuertos:cerdorMuertos.trim(),
                cerdosSanos:cerdosSanos.trim(),
                rasaCerdos:rasaCerdos.trim()
            },
            dataType: "JSON",
            success: function (response) {
                if(response['status']){
                    Swal.fire(
                        'Lote creado con exito',
                        response['msj'],
                        'success'
                    );
                    obtenerEstadicaslote(nameLote.trim());
                    loadDataCerdosLotes(nameLote.trim());
                }
                else{
                    Swal.fire(
                        'Fallo el registro',
                        response['msj'],
                        'error'
                    )
                    return;
                }
            }
        });
    });
    $('#btnConsulta').on('click',function(){
        let dataConsultar=$('#ConsultLote').val();
        if(dataConsultar != ''){
            obtenerEstadicaslote(dataConsultar.trim());
            loadDataCerdosLotes(dataConsultar.trim());
        }
    });
    var url="<?= base_url();?>"
    $('#loadDataUser').on('click',function(){
        $('#tablalotesUser').DataTable({
            "destroy":true,
            "ajax":{
                url:url+"/LotesController/dataLoteUser",
                dataSrc: ""
            },
            "columns":[
                {"data":"indicativo"},
                {"data":"usuario"},
                {"data":"nombre"},
            ]
        });
        $('#modalLotesUser').show();
    });

    $('#closeModalLotesUSer').on('click',function(){
        $('#modalLotesUser').hide();
    });
    function obtenerEstadicaslote(data)
    {
        if(data!=null || data != ''){
            $.ajax({
                type: "POST",
                url: "LotesController/datosGeneralesLote",
                data: {
                    id_lote:data
                },
                dataType: "JSON",
                success: function (response) {
                    if(response['status']){
                        $('#NameLoteGeneral').val(response['data']['nombre_lote']);
                        $('#NumbercantidadGeneral').val(response['data']['total_cerdos']);
                        $('#Numberenfermosgeneral').val(response['data']['total_enfermos']);
                        $('#NumbermuertosGeneral').val(response['data']['total_muertos']);
                        $('#NumbersanosGeneral').val(response['data']['total_sanos']);
                        $('#Promediopromediogeneral').val(response['data']['promedio_peso']);
                    }
                    else{
                        swal.fire(response['msj']);
                    }
                }
            })
        }
        else{
            swal.fire('No cuentas con los datos suficientes para cargar las informacion global');
        }
    }

    function loadDataCerdosLotes(data){
        if(data == null){
            swal.fire('Todos los campos son necesarios para carga los datos generales del lote');
            return;
        }
        $('#tablaRegistrosLotes').DataTable({
            "destroy":true,
            "ajax":{
                url:url+"/LotesController/dataGlobalLote",
                tye: "POST",
                data:{idlotePOST:data},
                dataSrc:''
            },
            "columns":[
                {"data":"indicativo"},
                {"data":"lote"},
                {"data":"nombre"},
                {"data":"peso"},
                {"data":"raza"},
                {"data":"estado"},
                {"data":"opciones"},
            ]
        });
    }

    function editarDataCerdo(iddatacerdo){
        window.Swal.fire({
            title:'Cargando la informacion',
            icon: 'success',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showConfirmButton: false
        });
        window.Swal.showLoading()
        cargar_rasasedit();
        cargar_estadosEdit();
        $.ajax({
            type: "POST",
            url: "LotesController/datosCerdosLote",
            data: {
                idCerdo:iddatacerdo
            },
            dataType: "JSON",
            success: function (response) {
                if(response['status']){
                    swal.fire('Datos cargados con exito');
                    $('#idCerdo').val(response['data'].idCerdo);
                    $('#NameLoteinput').val(response['data'].numero_lote);
                    $('#nameCerdo').val(response['data'].nombreCerdo);
                    $('#pesoCerdo').val(response['data'].peso);
                    $('#razaCerdosinputEdit option[value="'+response['data'].nombreRaza+'"]').attr("selected", true);
                   // $('#EstadosCerdoedit').val(response['data'].estado);
                    $('#EstadosCerdoedit option[value="'+response['data'].estado+'"]').attr("selected", true);
                    $('#modaleditarCerdo').show();
                }
                else{
                    swal.fire(response['msj']);
                }
            }
        })
    }

    function aliminarDataCerdo(iddatacerdonuevo){
       
        Swal.fire({
            title: 'Desea eliminar este elemento del lote',
            showDenyButton: true,
            confirmButtonText: 'NO',
            denyButtonText: `SI`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (!result.isConfirmed) {
                if(iddatacerdonuevo != ''){
                    $.ajax({
                        type: "POST",
                        url: "LotesController/EliminarCerdo",
                        data:{
                            idCerdo:iddatacerdonuevo,
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response['status']){
                                obtenerEstadicaslote(response['data']);
                                loadDataCerdosLotes(response['data']);
                                Swal.fire(
                                    'Eliminacion exitosa',
                                    response['msj'],
                                    'success'
                                )
                            }
                            else{
                                swal.fire(response['msj']);
                            }
                        }
                    });
                }
                else{
                    Swal.fire('no Cuenta con toda la informacion para la eliminacion');
                }
            }
        })
    }

    function cargar_rasasedit(){
        document.getElementById("razaCerdosinputEdit").innerHTML='';
        $.ajax({
            type: "GET",
            url: "LotesController/cargarRazas",
            dataType: "JSON",
            success: function (response) {
                let rasas= response;
                document.getElementById("razaCerdosinputEdit").innerHTML += "<option value=''>Selepcione una</option>"
                for(var i in rasas)
                {
                    document.getElementById("razaCerdosinputEdit").innerHTML += "<option value='"+rasas[i]+"'>"+rasas[i]+"</option>";
                }
            }
        });
    }
    function cargar_estadosEdit(){
        document.getElementById("EstadosCerdoedit").innerHTML='';
        $.ajax({
            type: "GET",
            url: "LotesController/cargarestados",
            dataType: "JSON",
            success: function (response) {
                let rasas= response;
                document.getElementById("EstadosCerdoedit").innerHTML += "<option value=''>Selepcione una</option>"
                for(var i in rasas)
                {
                    document.getElementById("EstadosCerdoedit").innerHTML += "<option value='"+rasas[i]+"'>"+rasas[i]+"</option>";
                }
            }
        });
    }
    $('#Modificar_cerdo_data').on('click',function(){
        window.Swal.fire({
            title:'estamos realizando la actulizacion',
            icon: 'success',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            showConfirmButton: false
        });
        window.Swal.showLoading()
        let nameLote=$('#NameLoteinput').val();
        let idCerdo=$('#idCerdo').val();
        let pesoCerdo=$('#pesoCerdo').val();
        let estadoCerdo=$('#EstadosCerdoedit').val();
        let razaCerda=$('#razaCerdosinputEdit').val();
        $.ajax({
            type: "POST",
            url: "LotesController/EditarCerdoInvi",
            data:{
                idCerdo:idCerdo,
                pesoCerdo:pesoCerdo,
                estadoCerdo:estadoCerdo,
                razaCerda:razaCerda
            },
            dataType: "JSON",
            success: function (response) {
                if(response['status']){

                    obtenerEstadicaslote(nameLote);
                    loadDataCerdosLotes(nameLote);
                    Swal.fire(
                        'actualizacion exitosa',
                        response['msj'],
                        'success'
                    )
                }
                else{
                    swal.fire(response['msj']);
                }
            }
        });
    });
    $('#closeModalCerdo').on('click',function(){
        $('#modaleditarCerdo').hide();
    });
</script>