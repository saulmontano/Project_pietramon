<div class="container">
    <div class="row">
        <div style="position: relative;top: 5vh;" class="shadow-none p-3 mb-5 bg-light rounded col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <table  class="table"  id="tablaRegistrosLotes">
                <thead>
                    <tr>
                        <th >#</th>
                        <th >Lote</th>
                        <th >Cantidad de cerdos</th>
                        <th >Fecha de creacion</th>
                        <th >Usuario Creador</th>
                        <th >Tipo de usuario</th>
                        <th >Documento</th>
                        <th >Telefono</th>
                        <th >Correo</th>
                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var url="<?= base_url();?>"

        $('#tablaRegistrosLotes').DataTable({
            "destroy":true,
            "ajax":{
                url:url+"/LotesController/dataGlobalLotesRegistros",
                dataSrc:''
            },
            "columns":[
                {"data":"indicativo"},
                {"data":"lote"},
                {"data":"cantidad"},
                {"data":"fechaCreacion"},
                {"data":"usuarioCreador"},
                {"data":"tipoUsurio"},
                {"data":"documento"},
                {"data":"telefono"},
                {"data":"correo"},
            ]
        });
    });
</script>