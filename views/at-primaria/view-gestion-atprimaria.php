<?php
require_once 'views/layout/header.php';
require_once 'views/layout/loader.php';
require_once 'views/layout/navbar.php';
require_once 'views/layout/sidebar.php';
?>

<!--Importamos el archivo de configuracion PHP encargado de controlador y manejar la logica de operacion del modulo de programas de vigilancias medicas-->
<?php require_once 'components/at_primaria/atprimaria_altas_bajas.php'; ?>

<!-- Modal Para cargar las evaluaciones de cualquier programa de vigilancia-->
<!-- Solo usaremos un unico metodo para cargar todas las evaluaciones, basicamente para generalizar, por eso pasamos como parametros los distintivos de cada evaluacion -->
<div id="miModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="spinner-grow text-primary" id="loader_modal_pvm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div id="cargar_modal_pvm">
                    <h6 class="text-center">
                        Cargando evaluación...
                    </h6>
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Encargar de mostrar el pad para que el Supervisor actualice su firma en una evalación de cualquier programa de vigilancia -->
<!-- Solo usaremos un unico modal para cargar la firma de un supervisor para varias evaluaciones, basicamente para generalizar, por eso pasamos como parametros los distintivos de cada evaluacion -->
<div id="modal_cargar_firma" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Contenido del modal -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="cargar_contenido_firma">

            </div>

        </div>
    </div>
</div>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-xl-12 col-xl-12 col-xl-12 col-12 layout-spacing">
                <?php //var_dump($evaluaciones_colaborador);?>
                <div class="widget widget-three">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-info"> <strong>ASOCIADO:</strong> <?=$colaborador->Nombre?> <?=$colaborador->APaterno?> <?=$colaborador->AMaterno?></h4>
                        </div>

                        <style>
                            .teststyle {
                                width: 25px;
                                height: 25px;

                            }
                            .teststyle:hover {
                                background-color: #f6f7f8;

                            }
                        </style>

                        <!--Solo los usuarios con perfil de supervisor o administrador podran acceder a las siguinetes opciones-->
                        <?php if ($_SESSION['Perfil'] != 'ME') : ?>
                            <!--Hacemos la llamada para que el supervisor con una unica firma dinamica pueda firmar todos los documentos donde se requiere su firma -->
                            <div class="col-md-4">
                                <div class="float-right dropdown d-inline-block">
                                    <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_op_supervisor" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <div class="rounded-circle text-center teststyle"><i class="fa-solid fa-bars fa-lg"></i></div> 
                                    </a>
                                    <div class="dropdown-menu left" aria-labelledby="pendingTask_op_supervisor" style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;" x-placement="bottom-end">
                                        <a class="dropdown-item" onClick="enviarCorreoSupervisor();" href="javascript:void(0);"><i class="fa-solid fa-paper-plane"></i> Notificar a Supervisor</a>
                                        <?php if ($_SESSION['Perfil'] == 'SP' || $_SESSION['Perfil'] == 'A0') : ?>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    


                    <div class="widget-content">

                        <div class="widget-content widget-content-area border-top-tab tab-justify-centered">
                            <ul class="nav nav-tabs justify-content-center" id="borderTop" role="tablist">
                                <?php if ($_SESSION['Perfil'] != 'ME') : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="border-top-home-tab" data-toggle="tab" href="#border-top-home" role="tab" aria-controls="border-top-home" aria-selected="false"><i class="fa-solid fa-user-plus"></i> Alta/Baja</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a  class="nav-link active"
                                        id="border-top-profile-tab" data-toggle="tab" href="#border-top-profile" role="tab" aria-controls="border-top-profile" aria-selected="true"><i class="fa-solid fa-user-doctor"></i> Consultar
                                        <div id="loader_consultar_vigilancias" class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a  class="nav-link" id="border-top-contact-tab" data-toggle="tab"
                                        href="#border-top-contact" role="tab" aria-controls="border-top-contact" aria-selected="false"><i class="fa-solid fa-user-check"></i> Inscripciones 
                                        <div id="loader_inscripcion_vigilancias" class="spinner-border spinner-border-sm" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </a>  
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="border-top-setting-tab" data-toggle="tab"
                                        href="#border-top-setting" role="tab" aria-controls="border-top-setting" aria-selected="false"><i class="fa-solid fa-user"></i> Información Personal</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="borderTopContent">
                                <div class="tab-pane fade" id="border-top-home" role="tabpanel" aria-labelledby="border-top-home-tab">
                                    <?php require_once 'views/at-primaria/view-programas-desuscribir.php';?>
                                </div>
                                <div class="tab-pane fade show active" id="border-top-profile" role="tabpanel" aria-labelledby="border-top-profile-tab">
                                    <?#php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/consultar.php';?>
                                    <?#php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/consultar.php';?>
                                </div>
                                <div class="tab-pane fade" id="border-top-contact" role="tabpanel" aria-labelledby="border-top-contact-tab">
                                    <?#php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/inscripciones.php';?>
                                </div>
                                <div class="tab-pane fade" id="border-top-setting" role="tabpanel" aria-labelledby="border-top-setting-tab">
                                    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/datos-personales.php';?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <div id="cargar_modal_php_pvm"></div>
            <p class="">Copyright © 2022
                <a target="_blank" href="https://bmsa.mx/site/">BMSA - LightHouse</a>,Todos los derechos reservados.
            </p>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->



<!--MODAL DE TODAS LAS EVALUACIONES CORRESPONDIENTES A LOS PROGRAMAS DE VIGILANCIA-->
<!--Agudeza Visual-->
<?php if ($disponible_programa_agudezavisual == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/6-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/7-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/agudeza-visual/1-ejercicio.php';?>
<?php endif; ?>

<!--Monitoreo de Drogas-->
<?php if ($disponible_programa_drogas == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/drogas/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/drogas/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/drogas/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/drogas/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/drogas/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/drogas/6-formulario.php';?>
<?php endif; ?>

<!--Patogena Sanguinea-->
<?php if ($disponible_programa_patogenos == 1) : ?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/1-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/2-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/3-formulario.php';?>
    <?php ////require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/4-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/5-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/6-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/patogenos/7-formulario.php';?>
<?php endif; ?>


<!--Riesgos Fisicos-->
<?php if ($disponible_programa_riesgosfisicos == 1) : ?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/riesgos-fisicos/1-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/riesgos-fisicos/2-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/riesgos-fisicos/3-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/riesgos-fisicos/4-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/riesgos-fisicos/1-ejercicio.php';?>
<?php endif; ?>

<!--Equipo Movil-->
<?php if ($disponible_programa_equipomovil == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/1-ejercicio.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/equipo-movil/6-formulario.php';?>
<?php endif; ?>

<!--Conservacion auditiva-->
<?php if ($disponible_programa_auditiva == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/6-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/7-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/conservacion-auditiva/1-ejercicio.php';?>
<?php endif; ?>


<!--Quimicos-->
<?php if ($disponible_programa_quimicos == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/1-ejercicio.php';?>
<?php endif; ?>

<!--Ergonomia-->
<?php if ($disponible_programa_ergonomia == 1) : ?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/ergonomia/1-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/ergonomia/2-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/ergonomia/4-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/ergonomia/5-formulario.php';?>
    <?php require_once 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/ergonomia/1-ejercicio.php';?>
<?php endif; ?>

<!--Respiradores-->
<?php if ($disponible_programa_respiradores == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/6-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/7-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/respiradores/1-ejercicio.php';?>
<?php endif; ?>

<!--Atención primaria-->
<?php if ($disponible_programa_atprimaria == 1) : ?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/1-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/2-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/3-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/4-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/5-formulario.php';?>
    <?php include 'views/programa-vigilancia/administracion/alta-baja-pvm/evaluaciones/quimicos/1-ejercicio.php';?>
<?php endif; ?>


<!--Importamos el archivo de configuracion JS encargado de controlador y manejar la logica de operacion del modulo de programas de vigilancias medicas-->
<script src="<?=base_url?>components/programas_vigilancia_medica/alta_baja/alta_baja.js"></script>

<?php require_once 'views/layout/footer.php'; ?>