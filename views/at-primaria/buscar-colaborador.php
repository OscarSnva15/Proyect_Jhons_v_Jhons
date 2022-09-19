<?php
require_once 'views/layout/header.php';
require_once 'views/layout/loader.php';
require_once 'views/layout/navbar.php';
require_once 'views/layout/sidebar.php';
?>

<!--DataTables-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>


<!-- Para los mensajes de error se debe modificar una propiedad de Bootstrap, por eso la redefinimos a continuación -->
<style>
    .alert .close {
        color: rgb(232, 230, 227) !important;
        margin-top: 3px !important;
        margin-right: 10px !important;
    }
</style>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-xl-12 col-xl-12 col-xl-12 col-12 layout-spacing">
                <div class="widget widget-three">
                    <div class="widget-content">

                        <div class="card border-info mb-5">
                            <div class="card-header bg-info">
                                <h5 class="text-white ml-3 mt-2">Buscar colaborador</h5>
                            </div>
                            <div class="card-body">

                                <?php if(isset($_SESSION['busqueda_colaborador']) && $_SESSION['busqueda_colaborador'] == 'failed'): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ¡No se ha encontrado ningún colaborador con ese WWID!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php endif; ?>
                                <?php Utils_Pvm::deleteSession('busqueda_colaborador'); ?>

                                <?php if(isset($_SESSION['busqueda_colaborador_empty']) && $_SESSION['busqueda_colaborador_empty'] == 'empty'): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ¡Debes ingresar un WWID, Nombre ó Apellidos!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php endif; ?>
                                <?php Utils_Pvm::deleteSession('busqueda_colaborador_empty'); ?>
                                <?php  //var_dump($_GET);?>

                                <form method="POST" action="<?=base_url?>atprimaria/buscador_colaboradores">
                                    <div class="form-group row">

                                        <input type="hidden" class="form-control form-control-sm" id="param" name="param" value="<?php if(isset($_GET['param']) && !empty($_GET['param'])){ echo $_GET['param'];}?>">

                                        <div class="col-md-4 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Nombre</span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm" id="nombre"
                                                    name="nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Apellido Paterno</span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="apellidopaterno" name="apellidopaterno">
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Apellido Materno</span>
                                                </div>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="apellidomaterno" name="apellidomaterno">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-4 mb-3">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">WWID</span>
                                                </div>
                                                <input type="number" class="form-control form-control-sm" id="wwid"
                                                    name="wwid">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <input type="reset" class="btn btn-dark" value="Limpiar formulario">
                                        <button class="btn btn-primary" id="boton_buscar" type="submit">Buscar
                                        <!-- <div class="spinner-border" id="load_buscador" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div> -->
                                        <div class="spinner-border spinner-border-sm" id="load_buscador" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                        </button>
                                        <!-- <div class="spinner-border text-primary" id="load_buscador" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div> -->
                                        
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="table_abvigilancia" class="table table-bordered table-hover mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">WWID</th>
                                        <th scope="col">NOMBRE</th>
                                        <th scope="col">EDAD</th>
                                        <th scope="col">FECHA DE NACIMIENTO</th>
                                        <th scope="col">FECHA DE INSCRIPCIÓN A P.V.M</th>
                                        <th scope="col">Ver P.V.M</th>
                                    </tr>
                                </thead>
                                
                                
                                <tbody>
                                    <?php if (isset($busqueda_colaboradores) && $busqueda_colaboradores != false) : ?>
                                        <?php foreach($busqueda_colaboradores as $colaborador):?>
                                            <tr>
                                                <?php //$fechas = Utils_Pvm::obtener_fechas_inscripcion_vigilancias_medicas($colaborador['IDEmpleado']);?>
                                                <td><?=$colaborador['IDEmpleado']?></td>
                                                <td><?=$colaborador['Nombre']?></td>
                                                <td><?=$colaborador['Anios']?></td>
                                                <td><?=$colaborador['FechaNaci']?></td>
                                                <td>
                                                    <?php $dias = rand(1, 15);$fecha = strtotime("+$dias days");echo date('Y-m-d', $fecha);?>
                                                    <?php //Utils_Pvm::imprimir_fechas_inscripcion_vigilancias_medicas($fechas); ?>
                                                </td>
                                                <?php
                                                    if(isset($gestion) && $gestion){
                                                        $action_controller = 'gestion_atprimaria';
                                                    }else if(isset($alta) && $alta){
                                                        $action_controller = 'alta_atprimaria';
                                                    }else if(isset($baja) && $baja){
                                                        $action_controller = 'baja_atprimaria';
                                                    }else {
                                                        $action_controller = 'programas_vigilancia_colaborador';
                                                    }
                                                ?>
                                                <td class="text-center"> <a class="text-center" href="<?=base_url?>atprimaria/<?=$action_controller?>&id=<?=$colaborador['IDEmpleado']?>"> <i class="fa-solid fa-folder-open fa-2x"></i> </a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <?php unset($busqueda_colaboradores);?>
                                    <?php endif; ?>
                                    <?php unset($busqueda_colaboradores);?>
                                </tbody>
                                    
                            </table>
                            <?php $busqueda_colaboradores = false;?>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © 2022
                <a target="_blank" href="https://bmsa.mx/site/">BMSA - LightHouse</a>,Todos los derechos reservados.
            </p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->

<!--SCRIPT PARA PETICIONES ASINCRONAS-->
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#table_abvigilancia').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
        });

    });

</script>

<script type="text/javascript">
    $("#load_buscador").hide();
    $("#boton_buscar").click(function () {
        $("#load_buscador").show();
    });


    $("#boton_texto").click(function () {
        console.log("hola");
        texto = $("#table_abvigilancia_filter").val();
        console.log(texto);
    });
</script>

<?php require_once 'views/layout/footer.php'; ?>