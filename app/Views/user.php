<div class="row container">
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 shadow-none p-3 mb-5 bg-light rounded" style="top: 21px;position: relative;align-items: center;left: 59px;">
        <h5>Registrar Usuario</h5>
        <div class="row">
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="Usuario">
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" id="Password">
                <div id="Password" class="form-text">La contraseña debe contener numeros,carecteres especiales y letras mayusculas.</div>
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="Nombre">
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="Apellido">
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Documento" class="form-label">Documento</label>
                <input type="text" class="form-control" id="Documento">
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="Telefono">
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <label for="Correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="Correo">
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-primary btn-sm" id="dataUser" style="position: relative;top: 31px;width: 220px;height: 34px;"><p id="tipoRegistro">Registrar</p></button>
            </div>
            <div class="col-md-4 col-lg-4 col-xs-12 col-sm-12">
                <button type="button" class="btn btn-success btn-sm" id="limpiarCampos" style="position: relative;top: 31px;width: 220px;height: 34px;">limpiar Campos</button>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 shadow-none p-3 mb-5 bg-light rounded" style="position: relative;left: 62px;">
        <table  class="table"  id="tablaUsuarios">
            <thead>
                <tr>
                    <th >#</th>
                    <th >usuario</th>
                    <th >Nombre</th>
                    <th >Apellido</th>
                    <th >Perfil</th>
                    <th >Documento</th>
                    <th >Telefono</th>
                    <th >Correo</th>
                    <th >Opciones</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    var url="<?= base_url();?>"
    $(document).ready(function(){
      $('#tablaUsuarios').DataTable({
          "destroy":true,
          "ajax":{
            url:url+"/Usuarios/dataTablaUsuarios",
            dataSrc: ""
          },
          "columns":[
            {"data":"indicativo"},
            {"data":"usuario"},
            {"data":"nombre"},
            {"data":"apellido"},
            {"data":"perfil"},
            {"data":"documento"},
            {"data":"telefono"},
            {"data":"correo"},
            {"data":"opciones"},
          ]
        });
    });

    let data_user='';
    let id_user='';
    let load_user=false;
    $('#dataUser').on('click',function(){
        if(load_user == false){
            let Usuario=$('#Usuario').val();
            if(Usuario == ''){
                Swal.fire('El usuario es un campo obligatorio');
                return;
            }
            let Password=$('#Password').val();
            if(Password == ''){
                Swal.fire('El Password es un campo obligatorio');
                return;
            }
            let Nombre=$('#Nombre').val();
            if(Nombre == ''){
                Swal.fire('El Nombre es un campo obligatorio');
                return;
            }
            let Apellido=$('#Apellido').val();
            let Documento=$('#Documento').val();
            if(Documento == ''){
                Swal.fire('El Documento es un campo obligatorio');
                return;
            }
            let Telefono=$('#Telefono').val();
            let Correo=$('#Correo').val();
            let validatePassword=validarPAsword(Password);
            if(validatePassword){
                $.ajax({
                    type: "POST",
                    url: "usuarios/registro",
                    data:{
                        idUsuario:id_user,
                        usuario:Usuario,
                        nombre:Nombre,
                        apellidos:Apellido,
                        password:Password,
                        documento:Documento,
                        telefono:Telefono,
                        correo:Correo,
                    },
                    dataType: "JSON",
                    success: function (response) {
                    if(response['status']){
                        Swal.fire(
                            'Registro exitoso',
                            response['msj'],
                            'success'
                        )
                        cargar_data();
                    }
                    else{
                        Swal.fire(
                            'Fallo el registro',
                            response['msj'],
                            'error'
                        )
                    }
                    }
                });
            }
            else{
                Swal.fire('La contraseña debe contener un caractere en Mayuscula,Numero y un caracter especial.');
                return;
            }
        }
        else{

            let Usuario=$('#Usuario').val();
            if(Usuario == ''){
                Swal.fire('El usuario es un campo obligatorio');
                return;
            }
            let Password=$('#Password').val();
            let Nombre=$('#Nombre').val();
            if(Nombre == ''){
                Swal.fire('El Nombre es un campo obligatorio');
                return;
            }
            let Apellido=$('#Apellido').val();
            let Documento=$('#Documento').val();
            if(Documento == ''){
                Swal.fire('El Documento es un campo obligatorio');
                return;
            }
            let Telefono=$('#Telefono').val();
            let Correo=$('#Correo').val();
            if(Password!=''){
                let validatePassword=validarPAsword(Password);
                if(validatePassword){
                    $.ajax({
                        type: "POST",
                        url: "usuarios/update",
                        data:{
                            idUsuario:id_user,
                            usuario:Usuario,
                            nombre:Nombre,
                            apellidos:Apellido,
                            password:Password,
                            documento:Documento,
                            telefono:Telefono,
                            correo:Correo,
                        },
                        dataType: "JSON",
                        success: function (response) {
                        if(response['status']){
                            Swal.fire(
                                'actualizacion exitosa',
                                response['msj'],
                                'success'
                            )
                            cargar_data();
                        }
                        else{
                            Swal.fire(
                                'Fallo la actualizacion',
                                response['msj'],
                                'error'
                            )
                        }
                        }
                    });
                }
                else{
                    Swal.fire('La contraseña debe contener un caractere en Mayuscula,Numero y un caracter especial.');
                    return;
                }
            }
            else{
                $.ajax({
                        type: "POST",
                        url: "update",
                        data:{
                            idUsuario:id_user,
                            usuario:Usuario,
                            nombre:Nombre,
                            apellidos:Apellido,
                            documento:Documento,
                            telefono:Telefono,
                            correo:Correo,
                        },
                        dataType: "JSON",
                        success: function (response) {
                        if(response['status']){
                            Swal.fire(
                                'actualizacion exitosa',
                                response['msj'],
                                'success'
                            )
                            cargar_data();
                        }
                        else{
                            Swal.fire(
                                'Fallo la actualizacion',
                                response['msj'],
                                'error'
                            )
                        }
                        }
                    });
            }
           
        }
        
    });

    function validarPAsword(passworrd){
        let respMayuscula=false;
        let respNumber=false;
        let respCarEspeciales=false;
        for (let i = 0; i < passworrd.length; i++) {
            const element = passworrd[i];
            if(!respMayuscula){
                respMayuscula =/[A-Z]/.test(element);
            }
            if(!respNumber){
                respNumber =/[0-9]/.test(element);
            }
            if(!respCarEspeciales){
                respCarEspeciales =/[.*+\-?^${}()|[]/.test(element);
            }
        }
        if(respMayuscula == true && respNumber == true && respCarEspeciales == true){
            return true;
        }
        else{
            return false;
        }
    };

    function cargar_data(){
        $('#tablaUsuarios').DataTable({
          "destroy":true,
          "ajax":{
            url:url+"/Usuarios/dataTablaUsuarios",
            dataSrc: ""
          },
          "columns":[
            {"data":"indicativo"},
            {"data":"usuario"},
            {"data":"nombre"},
            {"data":"apellido"},
            {"data":"perfil"},
            {"data":"documento"},
            {"data":"telefono"},
            {"data":"correo"},
            {"data":"opciones"},
          ]
        });
    }

    function editarUser(idUser){
        if(idUser != ''){
            Swal.fire({
                title: 'Cargando informacion',
                html: 'data uploading',// add html attribute if you want or remove
                allowOutsideClick: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $.ajax({
                type: "POST",
                url: "usuarios/listarUsuario",
                data:{
                    idUsuario:idUser,
                },
                dataType: "JSON",
                success: function (response) {
                  if(response['status']){
                    Swal.fire(
                        'Exito',
                        response['msj'],
                        'success'
                    )
                    id_user=idUser;
                    $('#Usuario').val(response['data']['usuario']);
                    $('#Password').val('');
                    $('#Nombre').val(response['data']['nombre']);
                    $('#Apellido').val(response['data']['apellido']);
                    $('#Documento').val(response['data']['documento']);
                    $('#Telefono').val(response['data']['telefono']);
                    $('#Correo').val(response['data']['correo']);
                    $('#tipoRegistro').text('actualizar');
                    load_user=true;
                  }
                  else{
                    Swal.fire(
                        'Fallo la carga de informacion',
                        response['msj'],
                        'error'
                    )
                    Swal.close()
                  }
                }
            });
        }
        else{
            Swal.fire('no cuenta con la informacion necesaria para editar el usuario');
        }
    }
    function eliminarUser(idUser){
        if(idUser != ''){
            Swal.fire({
                title: 'Desea eliminar el usuario?',
                showDenyButton: true,
                confirmButtonText: 'NO',
                denyButtonText: `SI`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (!result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "usuarios/EliminarUsuario",
                        data:{id_usuario:idUser},
                        dataType: "JSON",
                        success: function (response) {
                            if(response['status']){
                                cargar_data();
                                swal.fire(response['msj']);
                            }
                            else{
                                swal.fire(response['msj']);
                            }
                        }
                    })
                }
                else{

                }
            });
        }
        else{
            Swal.fire('no cuenta con la informacion necesaria para editar el usuario');
        }
    }

    $('#limpiarCampos').on('click',function(){
        $('#Usuario').val('');
        $('#Password').val('');
        $('#Nombre').val('');
        $('#Apellido').val('');
        $('#Documento').val('');
        $('#Telefono').val('');
        $('#Correo').val('');
        $('#tipoRegistro').text('Registrar');
        load_user=false;
        id_user='';

    });
</script>