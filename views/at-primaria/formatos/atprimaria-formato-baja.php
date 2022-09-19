<?php
require_once 'views/layout/header.php';
require_once 'views/layout/loader.php';
require_once 'views/layout/navbar.php';
require_once 'views/layout/sidebar.php';
?>

<!--Importamos el archivo de configuracion PHP encargado de controlar y manejar la logica de operacion del modulo de formato de baja de programas de vigilancias medicas-->
<?php //require_once 'start/baja_programas_vigilancia_medica/config_init-baja-programas_vigilancia_medica.php'; ?>

<!-- <style>
    .error_input {
        border-color: red;
    }
</style> -->

<!-- El script de la librería html2pdf para descargar documentos en formato PDF del DOM-->
<script src="<?=base_url?>assets/js/html2pdf.bundle.min.js"></script>

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-xl-12 col-xl-12 col-xl-12 col-12 layout-spacing">
                <div class="widget widget-three">
                    <div class="widget-content">
                        <div class="row mb-1">
                            <div class="col-md-8">
                                <h4 class="text-info mb-3"><strong>SALIDA PROGRAMAS DE ATENCION PRIMARIA</strong></h4>
                                <h6 class="text-info"><strong>ASOCIADO:</strong> <?=$colaborador->Nombre?> <?=$colaborador->APaterno?> <?=$colaborador->AMaterno?></h6>
                            </div>
                        </div>

                        <!--Seccion para debbugear las respuestas asincronas al servidor-->
                        <div class="mt-1 mb-1" id="get-request"></div>

                        <div class="widget-content widget-content-area animated-underline-content">
                                    
                            <ul class="nav nav-tabs  mb-3" id="animateLine" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="animated-underline-home-tab" data-toggle="tab" href="#animated-underline-home" role="tab" aria-controls="animated-underline-home" aria-selected="true"><i class="fa-solid fa-file-signature"></i> Formato Baja P.V.M.</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="animated-underline-profile-tab" data-toggle="tab" href="#animated-underline-profile" role="tab" aria-controls="animated-underline-profile" aria-selected="false"><i class="fa-solid fa-eye"></i> Ver Historico</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" id="animated-underline-contact-tab" data-toggle="tab" href="#animated-underline-contact" role="tab" aria-controls="animated-underline-contact" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Contact</a>
                                </li> -->
                            </ul>

                            <div class="tab-content" id="animateLineContent-4">
                                <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
                                    <form id="baja_pvm_formato" method="POST" action="<?=base_url?>pdv/procesando">
                                        
                                        <input type="hidden" name="baja_pvm_id_pvm_eliminar" id="baja_pvm_id_pvm_eliminar">
                                        <input type="hidden" name="baja_pvm_nombre_vigilancia" id="baja_pvm_nombre_vigilancia">

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_nombreempleado">Nombre del Trabajador</label>
                                                <input type="text" class="form-control" id="baja_pvm_nombreempleado" name="baja_pvm_nombreempleado" value="<?=$colaborador->Nombre?> <?=$colaborador->APaterno?> <?=$colaborador->AMaterno?>" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_wwid">WWID</label>
                                                <input type="text" class="form-control" id="baja_pvm_wwid" name="baja_pvm_wwid" value="<?=$colaborador->IDEmpleado?>" readonly>
                                                
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_departamento">Departamento</label>
                                                <input type="text" class="form-control" id="baja_pvm_departamento" name="baja_pvm_departamento" >
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_fecha_ingreso">Fecha de Ingreso a la Planta</label>
                                                <input class="form-control fecha form-control flatpickr flatpickr-input active" type="text" placeholder="Seleccione una fecha..." id="baja_pvm_fecha_ingreso" name="baja_pvm_fecha_ingreso" >
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_puesto_actual">Puesto Actual</label>
                                                <input type="text" class="form-control" id="baja_pvm_puesto_actual" name="baja_pvm_puesto_actual" value="<?=$colaborador->Puesto?>" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_antiguidad_puesto">Antiguedad en el Puesto Actual (meses)</label>
                                                <input type="text" class="form-control" id="baja_pvm_antiguidad_puesto" name="baja_pvm_antiguidad_puesto" >
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_pvm">Programa de Vigilancia Médica</label>
                                                <select class="custom-select" id="bajas_programas_vigilancia_medica" name="bajas_programas_vigilancia_medica">
                                                    <option value='0'>Seleccionar P.V.M</option>
                                                </select>
                                                <div class="valid-feedback">Seleccione un Programa de Vigilancia Médica</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_fecha_ingreso_pvm">Fecha de Ingreso PVM</label>
                                                <input class="form-control fecha form-control flatpickr flatpickr-input active " type="text" placeholder="Seleccioneione una fecha..." id="baja_pvm_fecha_ingreso_pvm" name="baja_pvm_fecha_ingreso_pvm" >
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_fecha_ultimo_examen">Fecha de último exámen del PVM</label>
                                                <input type="text" placeholder="Seleccione una fecha..." class="form-control fecha form-control flatpickr flatpickr-input active " id="baja_pvm_fecha_ultimo_examen" name="baja_pvm_fecha_ultimo_examen" >
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_resultados">Resultados</label>
                                                <input type="text" class="form-control" id="baja_pvm_resultados" name="baja_pvm_resultados" >
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_fecha_salida_pvm">Fecha de salida PVM</label>
                                                <input type="text" placeholder="Seleccione una fecha..." class="form-control fecha form-control flatpickr flatpickr-input active " id="baja_pvm_fecha_salida_pvm" name="baja_pvm_fecha_salida_pvm" >
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_motivo_salida">Motivo de Salida</label>
                                                <input type="text" class="form-control" id="baja_pvm_motivo_salida" name="baja_pvm_motivo_salida">
                                            </div>
                                        </div>

                                        <h6 class="mt-3 mb-3">DATOS IMPORTANTES</h6>

                                        <div class="form-row">
                                            <div class="col-md-3 mb-3">
                                                <label for="baja_pvm_edad">Edad</label>
                                                <input type="text" class="form-control" id="baja_pvm_edad" name="baja_pvm_edad" value="<?=$colaborador->Anios?>" readonly >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="baja_pvm_peso">Peso (KG)</label>
                                                <input type="text" class="form-control" id="baja_pvm_peso" name="baja_pvm_peso" >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="baja_pvm_talla">Talla</label>
                                                <input type="text" class="form-control" id="baja_pvm_talla" name="baja_pvm_talla" >
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label for="baja_pvm_ta">T/A</label>
                                                <input type="text" class="form-control" id="baja_pvm_ta" name="baja_pvm_ta" >
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_exploracion">Exploración Física</label>
                                                <input type="text" class="form-control" id="baja_pvm_exploracion" name="baja_pvm_exploracion"  >
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_audiometria">Audiometría de Salida</label>
                                                <input type="text" class="form-control" id="baja_pvm_audiometria" name="baja_pvm_audiometria"  >
                                            </div>
                                        </div>


                                        <label class="mt-3" for="baja_pvm_bioclinicos_chk">Requiere de Estudios Bioclinicos</label>
                                        <div class="form-row">
                                            <div class="col-md-1 mb-3">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-info">
                                                        <input type="radio" class="new-control-input" id="baja_pvm_bioclinicos_chk_1" name="baja_pvm_bioclinicos_chk" value="SI">
                                                        <span class="new-control-indicator"></span>Si
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-info">
                                                        <input type="radio" class="new-control-input" id="baja_pvm_bioclinicos_chk_2" name="baja_pvm_bioclinicos_chk" value="NO">
                                                        <span class="new-control-indicator"></span>NO
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-10 mb-3">
                                                <label for="baja_pvm_bioclinicos_exp">Explique</label>
                                                <input type="text" class="form-control" id="baja_pvm_bioclinicos_exp" name="baja_pvm_bioclinicos_exp" readonly>
                                                
                                            </div>
                                        </div>


                                        <h6 class="mt-3 mb-3">DIAGNOSTICO DE SALIDA</h6>

                                        <div class="form-row">
                                            <div class="col-md-1 mb-3">
                                                <label>El Empleado</label>
                                            </div>
                                            <div class="col-md-1 mb-3 d-flex justify-content-center">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-info">
                                                        <input type="radio" class="new-control-input" id="baja_pvm_diagnostico_chk" name="baja_pvm_diagnostico_chk" value="SI">
                                                        <span class="new-control-indicator"></span>Si
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-3 d-flex justify-content-center">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-info">
                                                        <input type="radio" class="new-control-input" id="baja_pvm_diagnostico_chk" name="baja_pvm_diagnostico_chk" value="NO">
                                                        <span class="new-control-indicator"></span>NO
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-9 mb-3">
                                                <label>Presenta ninguna alteración a su salud derivada de los riesgos de trabajo a los cuales estuvo expuesto durante la realización de sus tareas  dentro de la Empresa</label>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-1 mb-3">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-info">
                                                        <input type="radio" class="new-control-input" name="baja_pvm_revaloracion" value="SI">
                                                        <span class="new-control-indicator"></span>Si
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-1 mb-3">
                                                <div class="n-chk">
                                                    <label class="new-control new-radio radio-info">
                                                        <input type="radio" class="new-control-input" name="baja_pvm_revaloracion" value="NO">
                                                        <span class="new-control-indicator"></span>NO
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-10 mb-3">
                                                <label>Requiere revaloración</label>
                                            </div>
                                        </div>

                                        <div class="form-row mt-3">
                                            <div class="col-md-12 mb-3">
                                                <label for="baja_pvm_observaciones">Observaciones</label>
                                                <input type="text" class="form-control" id="baja_pvm_observaciones" name="baja_pvm_observaciones" >
                                            </div>
                                        </div>


                                        <div class="form-row mt-3">
                                            <div class="col-md-6 mb-3">
                                                <label><strong>Firma de enterado del trabajador:</strong></label>
                                                <br><span>Debe comenzar y terminar su firma dentro del recuadro sombreado</span>
                                                <div class="wrapper d-flex justify-content-center mt-4">
                                                    <canvas id="signature_pad_baja_pvm_firma1"></canvas>
                                                    <input type="hidden" id="signature_pad_baja_pvm_firma_1" name="signature_pad_baja_pvm_firma_1">
                                                </div>
                                                <div class="clear-btn">
                                                    <a onclick="clear_baja_pvm_clean1()" class="btn btn-primary mt-3 text-white btn-sm float-right"><span>
                                                    <i class="fa-solid fa-signature"></i> Limpiar</span></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label><strong>Firma del Médico:</strong></label>
                                                <br><span>Debe comenzar y terminar su firma dentro del recuadro sombreado</span>
                                                <div class="wrapper d-flex justify-content-center mt-4">
                                                    <canvas id="signature_pad_baja_pvm_firma2"></canvas>
                                                    <input type="hidden" id="signature_pad_baja_pvm_firma_2" name="signature_pad_baja_pvm_firma_2">
                                                </div>
                                                <div class="clear-btn">
                                                    <a onclick="clear_baja_pvm_clean2()" class="btn btn-primary mt-3 text-white btn-sm float-right"><span>
                                                    <i class="fa-solid fa-signature"></i> Limpiar</span></a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="col-md-6 mb-3">
                                                <label for="baja_pvm_fecha_final">Fecha</label>
                                                <input class="form-control fecha form-control flatpickr flatpickr-input active " type="text" placeholder="Seleccione una fecha..." id="baja_pvm_fecha_final" name="baja_pvm_fecha_final" value="2000-05-05">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="guardar_baja_pvm">Guardar</button>
                                            <div class="spinner-border spinner-border-sm" id="load_baja_pvm" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>

                                    </form>    
                                </div>
                                <div class="tab-pane fade" id="animated-underline-profile" role="tabpanel" aria-labelledby="animated-underline-profile-tab">
                                    
                                    <!-- Input de tipo select para cargar dinamicamente el formato de una baja de pvm correspondiente a un colaborador -->
                                    <div class="row">
                                        <div class="col-md-5">
                                            <select class="custom-select" id="input_seleccion_consulta_bajas_pvm" style="cursor: pointer;">
                                                <option value="0" selected>Ver formato de baja P.V.M.</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row float-right">
                                        <i id="descargar_baja_pvm" class="fa-solid fa-file-pdf fa-xl" style="cursor: pointer;"></i>
                                    </div>

                                    <!-- Seccion en donde se imprimira el contenido del formato de baja pvm delegado por el input  id="input_seleccion_consulta_bajas_pvm"-->
                                    <div class="mt-5 mb-5" id="mostrar_documento_baja_pvm">
                                        <h6>No ha seleccionado ningúna baja de P.V.M.</h6>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="animated-underline-contact" role="tabpanel" aria-labelledby="animated-underline-contact-tab">
                                    <p class="dropcap  dc-outline-primary">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </p>
                                </div> -->
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

<!--Importamos el archivo de configuracion JS encargado de controlar y manejar la logica de operacion del modulo de formato de baja de Programas de Vigilancia Medica-->
<script src="<?=base_url?>components/at_primaria/atencion_primaria.js"></script>

<?php require_once 'views/layout/footer.php'; ?>