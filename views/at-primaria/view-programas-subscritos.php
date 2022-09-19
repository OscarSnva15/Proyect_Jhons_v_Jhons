

<div id="recargar_consulta_vigilancias">
<div id="toggleAccordion_pvm">
    

    <?php if ($_SESSION['Perfil'] != 'ME') : ?>
    <!--Hacemos la llamada para que el supervisor con una unica firma dinamica pueda firmar todos los documentos donde se requiere su firma -->
    <!--<div class="">
        <div class="row mb-1">
            <div class="col-md-6 d-flex justify-content-start">
                <a href="javascript:void(0);" onClick="enviarCorreoSupervisor();"><i class="fa-solid fa-paper-plane"></i> Notificar a Supervisor</a>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-4"><label>*Esta firma se aplicará en todos los documentos que se requiera</label></div>
    </div>-->
    <?php endif; ?>
    
    <div id="crear_consulta_vigilancia_quimicos">
        <?php if ($inscrito_vigilancia_quimicos == 1 && $disponible_programa_quimicos == 1) : ?>
            
            <div class="card">
                <div class="card-header" id="pvm_quimicos_Uno1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_quimicos_Uno"
                            aria-expanded="false" aria-controls="defaultAcpvm_quimicos_Uno">
                            <i class="fa-solid fa-flask-vial fa-lg mr-2"></i>QUÍMICOS <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_quimicos == 5) : ?>
                                (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_quimicos">(Aún te faltan <strong id="cont_evaluaciones_quimicos"><?=5-$cont_evaluaciones_quimicos?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_quimicos_Uno" class="collapse" aria-labelledby="pvm_quimicos_Uno1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                    <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_quimicos)[0];?></h6></div>
                    
                        <div id="crear_remover_evaluacion_quimicos_form1">
                            <?php if ($quimicos_form1 != '0') : ?>
                                    <div class="list-group-item list-group-item-action">
                                        <i class="fa-solid fa-vial"></i> Reporte de vigilancia médica (salud)
                                        <div class="float-right dropdown d-inline-block">
                                            <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                                style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                                x-placement="bottom-end">
                                                <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                                <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                                <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form2">
                            <?php if ($quimicos_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>

                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form3">
                            <?php if ($quimicos_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Cuestionario de ingreso a vigilancia médica de quimicos y agentes farmaceuticos activos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                        ¡Te falta contestar: Cuestionario de ingreso a vigilancia médica de quimicos y agentes farmaceuticos activos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form4">
                            <?php if ($quimicos_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Evaluación previa programa de vigilancia médica de quimicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                        ¡Te falta contestar: Evaluación previa programa de vigilancia médica de quimicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form5">
                            <?php if ($quimicos_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Evaluación post programa de vigilancia médica de quimicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                        ¡Te falta contestar: Evaluación post programa de vigilancia médica de quimicos!
                                </a>
                            <?php endif; ?>
                        </div>


                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div id="crear_consulta_vigilancia_respiradores">
        <?php if ($inscrito_vigilancia_respiradores == 1 && $disponible_programa_respiradores == 1) : ?>
            

            <div class="card">
                <div class="card-header" id="pvm_respiradores_Dos1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_respiradores_Dos"
                            aria-expanded="false" aria-controls="defaultAcpvm_respiradores_Dos">
                            <i class="fa-solid fa-head-side-mask fa-lg mr-3"></i>RESPIRADORES <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_respiradores == 7) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                            <i id="programa_completo_respiradores">(Aún te faltan <strong id="cont_evaluaciones_respiradores"><?=7-$cont_evaluaciones_respiradores?></strong> evaluacion(es) por
                            contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_respiradores_Dos" class="collapse" aria-labelledby="pvm_respiradores_Dos1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_respiradores)[0];?></h6></div>

                        <div id="crear_remover_evaluacion_respiradores_form1">
                            <?php if ($respiradores_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-mask-face"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div id="crear_remover_evaluacion_respiradores_form2">
                            <?php if ($respiradores_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-mask-face"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>   
                            <?php endif; ?>
                        </div>


                        <div id="crear_remover_evaluacion_respiradores_form3">
                            <?php if ($respiradores_form3 != '0') : ?>
                                
                                    <div class="list-group-item list-group-item-action">
                                        <i class="fa-solid fa-mask-face"></i> Cuestionario pre-prueba de espirometría
                                        <div class="float-right dropdown d-inline-block">
                                            <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                                style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                                x-placement="bottom-end">
                                                <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                                <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                                <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                            </div>
                                        </div>
                                    </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Cuestionario pre-prueba de espirometría!
                                </a>
                            <?php endif; ?>
                        </div>


                        <div id="crear_remover_evaluacion_respiradores_form4">
                            <?php if ($respiradores_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-mask-face"></i> Cuestionario de evaluación de salud para usuarios de respirador
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Cuestionario de evaluación de salud para usuarios de respirador!
                                </a>
                            <?php endif; ?>
                        </div>

                        
                        <div id="crear_remover_evaluacion_respiradores_form5">
                            <?php if ($respiradores_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-mask-face"></i> Requisicion, certificación médica - Entrenamiento y adecuación de respiradores
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Requisicion, certificación médica - Entrenamiento y adecuación de respiradores!
                                </a>
                            <?php endif; ?>
                        </div>

                        
                        <div id="crear_remover_evaluacion_respiradores_form6">
                            <?php if ($respiradores_form6 != '0') : ?>
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-mask-face"></i> Evaluación previa programa de vigilancia médica respiradores
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form6');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form6');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form6');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Evaluación previa programa de vigilancia médica respiradores!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_respiradores_form7">
                            <?php if ($respiradores_form7 != '0') : ?>
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-mask-face"></i> Evaluación posterior programa de vigilancia médica respiradores
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form7');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form7');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'respiradores', 'form7');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-mask-face"></i>
                                    ¡Te falta contestar: Evaluación posterior programa de vigilancia médica respiradores!
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div id="crear_consulta_vigilancia_agudezavisual">
        <?php if ($inscrito_vigilancia_agudezavisual == 1 && $disponible_programa_agudezavisual == 1) : ?>
            

            <div class="card">
                <div class="card-header" id="pvm_agudezavisual_Tres1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_agudezavisual_Tres"
                            aria-expanded="false" aria-controls="defaultAcpvm_agudezavisual_Tres">
                            <i class="fa-solid fa-eye fa-lg mr-2"></i> AGUDEZA VISUAL <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_agudezavisual == 7) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_agudezavisual">(Aún te faltan <strong id="cont_evaluaciones_agudezavisual"><?=7-$cont_evaluaciones_agudezavisual?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_agudezavisual_Tres" class="collapse" aria-labelledby="pvm_agudezavisual_Tres1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_agudezavisual)[0];?></h6></div>
                        

                        <div id="crear_remover_evaluacion_agudezavisual_form1">
                            <?php if ($agudezavisual_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-arrows-to-eye"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        
                        <div id="crear_remover_evaluacion_agudezavisual_form2">
                            <?php if ($agudezavisual_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-arrows-to-eye"></i> Carta De Aceptación/Rechazo Para El Ingreso de Vigilancia Medica y/o Monitoreos Clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Carta De Aceptación/Rechazo Para El Ingreso de Vigilancia Medica y/o Monitoreos Clinicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_agudezavisual_form3">
                            <?php if ($agudezavisual_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-arrows-to-eye"></i> Registro de Evaluación Visual
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Registro de Evaluación Visual!
                                </a>
                            <?php endif; ?>
                        </div>

                        
                        <div id="crear_remover_evaluacion_agudezavisual_form4">
                            <?php if ($agudezavisual_form4 != '0') : ?>
                                
                                    <div class="list-group-item list-group-item-action">
                                        <i class="fa-solid fa-arrows-to-eye"></i> Notificación De Resultado De Exámen De Agudeza Visual
                                        <div class="float-right dropdown d-inline-block">
                                            <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                                style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                                x-placement="bottom-end">
                                                <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                                <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                                <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                            </div>
                                        </div>
                                    </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Notificación De Resultado De Exámen De Agudeza Visual!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_agudezavisual_form5">
                            <?php if ($agudezavisual_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-arrows-to-eye"></i> Carta Compromiso Para Asociados Que Recibieron Evalución y Exámen De Agudeza Visual Con Adaptación De Lentes
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Carta Compromiso Para Asociados Que Recibieron Evalución y Exámen De Agudeza Visual Con Adaptación De Lentes!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_agudezavisual_form6">
                            <?php if ($agudezavisual_form6 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-arrows-to-eye"></i> Exámen Previo Programa De Vigilancia Médica Agudeza Visual
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form6');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form6');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form6');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Exámen Previo Programa De Vigilancia Médica Agudeza Visual!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_agudezavisual_form7">
                            <?php if ($agudezavisual_form7 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-arrows-to-eye"></i> Exámen Posterior Programa De Vigilancia Médica Agudeza Visual
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form7');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form7');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'agudezavisual', 'form7');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-arrows-to-eye"></i>
                                    ¡Te falta contestar: Exámen Posterior Programa De Vigilancia Médica Agudeza Visual!
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div id="crear_consulta_vigilancia_drogas">
        <?php if ($inscrito_vigilancia_drogas == 1 && $disponible_programa_drogas == 1) : ?>
            

            <div class="card">
                <div class="card-header" id="pvm_drogas_Cuatro1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_drogas_Cuatro"
                            aria-expanded="false" aria-controls="defaultAcpvm_drogas_Cuatro">
                            <i class="fa-solid fa-pills fa-lg mr-2"></i> MONITOREO DE DROGAS <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_drogas == 6) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_drogas">(Aún te faltan <strong id="cont_evaluaciones_drogas"><?=6-$cont_evaluaciones_drogas?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_drogas_Cuatro" class="collapse" aria-labelledby="pvm_drogas_Cuatro1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                    <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_drogas)[0];?></h6></div>

                        <div id="crear_remover_evaluacion_drogas_form1">
                            <?php if ($drogas_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-capsules"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'drogas', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-capsules"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_drogas_form2">
                            <?php if ($drogas_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-capsules"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'drogas', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-capsules"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_drogas_form3">
                            <?php if ($drogas_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-capsules"></i> Cuestionario de tratamiento previo
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'drogas', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-capsules"></i>
                                    ¡Te falta contestar: Cuestionario de tratamiento previo!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_drogas_form4">
                            <?php if ($drogas_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-capsules"></i> Formato de consentimiento para detección de drogas/alcohol
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'drogas', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-capsules"></i>
                                    ¡Te falta contestar: Formato de consentimiento para detección de drogas/alcohol!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_drogas_form5">
                            <?php if ($drogas_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-capsules"></i> Formato consentimiento de realización de prueba de detección de alcohol y/o drogas
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'drogas', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-capsules"></i>
                                    ¡Te falta contestar: Formato consentimiento de realización de prueba de detección de alcohol y/o drogas!
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div id="crear_remover_evaluacion_drogas_form6">
                            <?php if ($drogas_form6 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-capsules"></i> Comunicación de resultados del exámen de drogas y alcohol
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form6');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'drogas', 'form6');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'drogas', 'form6');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-capsules"></i>
                                    ¡Te falta contestar: Comunicación de resultados del exámen de drogas y alcohol!
                                </a>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

        
    <div id="crear_consulta_vigilancia_patogenos">
        <?php if ($inscrito_vigilancia_patogenos == 1 && $disponible_programa_patogenos == 1) : ?>
            

            <div class="card">
                <div class="card-header" id="pvm_patogenos_Cinco1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_patogenos_Cinco"
                            aria-expanded="false" aria-controls="defaultAcpvm_patogenos_Cinco">
                            <i class="fa-solid fa-droplet fa-lg mr-2"></i> PATÓGENOS SANGUÍNEOS <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_patogenos == 6) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_patogenos">(Aún te faltan <strong id="cont_evaluaciones_patogenos"><?=6-$cont_evaluaciones_patogenos?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_patogenos_Cinco" class="collapse" aria-labelledby="pvm_patogenos_Cinco1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_patogenos)[0];?></h6></div>

                        
                        <div id="crear_remover_evaluacion_patogenos_form1">
                            <?php if ($patogenos_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-droplet"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-droplet"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_patogenos_form2">
                            <?php if ($patogenos_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-droplet"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-droplet"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>
                            <?php endif; ?>
                        </div>


                        <div id="crear_remover_evaluacion_patogenos_form3">
                            <?php if ($patogenos_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-droplet"></i> Notificación al empleado de patogenos transmitidos por la sangre
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-droplet"></i>
                                    ¡Te falta contestar: Notificación al empleado de patogenos transmitidos por la sangre!
                                </a>
                            <?php endif; ?>
                        </div>

                            <!--<?php if ($patogenos_form4 != '0') : ?>
                                <div class="row list-group-item">
                                    <div class="col-md">
                                        <i class="fa-solid fa-droplet"></i> Cuestionario general de salud & Evaluación de la vigilancia
                                        <div class="float-right dropdown d-inline-block">
                                            <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                                style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                                x-placement="bottom-end">
                                                <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                                <a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="row list-group-item"><div class="col-md">
                                <a id="cargar_consulta_patogenos_form4">
                                        ¡Te falta contestar: Cuestionario general de salud & Evaluación de la vigilancia!
                                </a>
                                </div></div>
                            <?php endif; ?>-->
                            
                        <div id="crear_remover_evaluacion_patogenos_form5">
                            <?php if ($patogenos_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-droplet"></i> Cuestionario de evaluación de salud
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-droplet"></i>
                                    ¡Te falta contestar: Cuestionario de evaluación de salud!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_patogenos_form6">
                            <?php if ($patogenos_form6 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-droplet"></i> Formato de evaluación física
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form6');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form6');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form6');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-droplet"></i>
                                    ¡Te falta contestar: Formato de evaluación física!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_patogenos_form7">
                            <?php if ($patogenos_form7 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-droplet"></i> Departamento de salud ocupacional
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form7');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form7');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'patogenos', 'form7');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-droplet"></i>
                                    ¡Te falta contestar: Departamento de salud ocupacional!
                                </a>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div id="crear_consulta_vigilancia_auditiva">
        <?php if ($inscrito_vigilancia_auditiva == 1 && $disponible_programa_auditiva == 1) : ?>
            
            <div class="card">
                <div class="card-header" id="pvm_auditiva_Seis1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_auditiva_Seis"
                            aria-expanded="false" aria-controls="defaultAcpvm_auditiva_Seis">
                            <i class="fa-solid fa-ear-listen fa-lg mr-2"></i> CONSERVACION AUDITIVA <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_auditiva == 7) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_auditiva">(Aún te faltan <strong id="cont_evaluaciones_auditiva"><?=7-$cont_evaluaciones_auditiva?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_auditiva_Seis" class="collapse" aria-labelledby="pvm_auditiva_Seis1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_auditiva)[0];?></h6></div>


                        
                        <div id="crear_remover_evaluacion_auditiva_form1">
                            <?php if ($auditiva_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_auditiva_form2">                  
                            <?php if ($auditiva_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_auditiva_form3">
                            <?php if ($auditiva_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Cuestionario Audiólogico
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Cuestionario Audiólogico!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_auditiva_form4">
                            <?php if ($auditiva_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Evolución Auditiva / Notificación al Empleado
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Evolución Auditiva / Notificación al Empleado!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_auditiva_form5">
                            <?php if ($auditiva_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Exámen Audiometrico
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Exámen Audiometrico!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_auditiva_form6">
                            <?php if ($auditiva_form6 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Exámen Previo a Programa de Vigilancia Médica Conservación Auditiva
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form6');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form6');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form6');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Exámen Previo a Programa de Vigilancia Médica Conservación Auditiva!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_auditiva_form7">
                            <?php if ($auditiva_form7 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-ear-listen"></i> Exámen Posterior a Programa de Vigilancia Médica Conservación Auditiva
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form7');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form7');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'auditiva', 'form7');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-ear-listen"></i>
                                    ¡Te falta contestar: Exámen Posterior a Programa de Vigilancia Médica Conservación Auditiva!
                                </a>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

        
    <div id="crear_consulta_vigilancia_equipomovil">
        <?php if ($inscrito_vigilancia_equipomovil == 1 && $disponible_programa_equipomovil == 1) : ?>
            
            <div class="card">
                <div class="card-header" id="pvm_equipomovil_Siete1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_equipomovil_Siete"
                            aria-expanded="false" aria-controls="defaultAcpvm_equipomovil_Siete">
                            <i class="fa-solid fa-people-carry-box fa-lg mr-2"></i> EQUIPO MÓVIL <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_equipomovil == 6) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_equipomovil">(Aún te faltan <strong id="cont_evaluaciones_equipomovil"><?=6-$cont_evaluaciones_equipomovil?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_equipomovil_Siete" class="collapse" aria-labelledby="pvm_equipomovil_Siete1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_equipomovil)[0];?></h6></div>

                        <div id="crear_remover_evaluacion_equipomovil_form1">
                            <?php if ($equipomovil_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-dolly"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-dolly"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_equipomovil_form2">
                            <?php if ($equipomovil_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-dolly"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-dolly"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_equipomovil_form3">
                            <?php if ($equipomovil_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-dolly"></i> Cuestionario Audiólogico
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-dolly"></i>
                                    ¡Te falta contestar: Cuestionario Audiólogico!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_equipomovil_form4">
                            <?php if ($equipomovil_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-dolly"></i> Evolución equipo movil / Notificación al Empleado
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-dolly"></i>
                                    ¡Te falta contestar: Evolución equipo movil / Notificación al Empleado!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_equipomovil_form5">
                            <?php if ($equipomovil_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-dolly"></i> Exámen Audiometrico
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-dolly"></i>
                                    ¡Te falta contestar: Exámen Audiometrico!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_equipomovil_form6">
                            <?php if ($equipomovil_form6 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-dolly"></i> Exámen Previo Programa de Vigilancia Médica Conservación equipo movil
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form6');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form6');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'equipomovil', 'form6');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-dolly"></i>
                                    ¡Te falta contestar: Exámen Previo Programa de Vigilancia Médica Conservación equipo movil!
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div id="crear_consulta_vigilancia_riesgosfisicos">
        <?php if ($inscrito_vigilancia_riesgosfisicos == 1 && $disponible_programa_riesgosfisicos == 1) : ?>
            
            <div class="card">
                <div class="card-header" id="pvm_riesgosfisicos_Ocho1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_riesgosfisicos_Ocho"
                            aria-expanded="false" aria-controls="defaultAcpvm_riesgosfisicos_Ocho">
                            <i class="fa-solid fa-person-circle-exclamation fa-lg mr-2"></i> RIESGOS FÍSICOS <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_riesgosfisicos == 4) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_riesgosfisicos">(Aún te faltan <strong id="cont_evaluaciones_riesgosfisicos"><?=4-$cont_evaluaciones_riesgosfisicos?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_riesgosfisicos_Ocho" class="collapse" aria-labelledby="pvm_riesgosfisicos_Ocho1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_riesgosfisicos)[0];?></h6></div>

                        <div id="crear_remover_evaluacion_riesgosfisicos_form1">
                            <?php if ($riesgosfisicos_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-person-digging"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-person-digging"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_riesgosfisicos_form2">
                            <?php if ($riesgosfisicos_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-person-digging"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-person-digging"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_riesgosfisicos_form3">
                            <?php if ($riesgosfisicos_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-person-digging"></i> Exámen Pre-Entrenamiento Riesgos Físicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-person-digging"></i>
                                    ¡Te falta contestar: Exámen Pre-Entrenamiento Riesgos Físicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_riesgosfisicos_form4">
                            <?php if ($riesgosfisicos_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-person-digging"></i> Exámen Post-Entrenamiento Riesgos Físicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'riesgosfisicos', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-person-digging"></i>
                                    ¡Te falta contestar: Exámen Post-Entrenamiento Riesgos Físicos!
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>


    <div id="crear_consulta_vigilancia_ergonomia">
        <?php if ($inscrito_vigilancia_ergonomia == 1 && $disponible_programa_ergonomia == 1) : ?>
            
            <div class="card">
                <div class="card-header" id="pvm_ergonomia_Nueve1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_ergonomia_Nueve"
                            aria-expanded="false" aria-controls="defaultAcpvm_ergonomia_Nueve">
                            <i class="fa-solid fa-person-arrow-up-from-line fa-lg mr-2"></i> ERGONOMÍA <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_ergonomia == 5) : ?>
                            (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_ergonomia">(Aún te faltan <strong id="cont_evaluaciones_ergonomia"><?=5-$cont_evaluaciones_ergonomia?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_ergonomia_Nueve" class="collapse" aria-labelledby="pvm_ergonomia_Nueve1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                        <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_ergonomia)[0];?></h6></div>

                        <div id="crear_remover_evaluacion_ergonomia_form1">
                            <?php if ($ergonomia_form1 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-child-reaching"></i> Reporte de vigilancia médica (salud)
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-child-reaching"></i>
                                    ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_ergonomia_form2">
                            <?php if ($ergonomia_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-child-reaching"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-child-reaching"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_ergonomia_form3">
                            <?php if ($ergonomia_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-child-reaching"></i> Cuestionario de Vigilancia Ergonomica
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-child-reaching"></i>
                                    ¡Te falta contestar: Cuestionario de Vigilancia Ergonomica!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_ergonomia_form4">
                            <?php if ($ergonomia_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-child-reaching"></i> Exámen Pre-Entrenamiento Ergonomía
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-child-reaching"></i>
                                    ¡Te falta contestar: Exámen Pre-Entrenamiento Ergonomía!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_ergonomia_form5">
                            <?php if ($ergonomia_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-child-reaching"></i> Exámen Post-Entrenamiento Ergonomía
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'ergonomia', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-child-reaching"></i>
                                    ¡Te falta contestar: Exámen Post-Entrenamiento Ergonomía!
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- atencion primaria -->
    <div id="crear_consulta_atencion_primaria">
        <?php if ($inscrito_vigilancia_quimicos == 1 && $disponible_programa_atprimaria == 1) : ?>
            
            <div class="card">
                <div class="card-header" id="pvm_quimicos_Uno1">
                    <section class="mb-0 mt-0">
                        <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAcpvm_quimicos_Uno"
                            aria-expanded="false" aria-controls="defaultAcpvm_quimicos_Uno">
                            <i class="fa-solid fa-flask-vial fa-lg mr-2"></i>QUÍMICOS <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg></div>
                            <?php if ($cont_evaluaciones_quimicos == 5) : ?>
                                (Programa de vigilancia médica completado)
                            <?php else: ?>
                                <i id="programa_completo_quimicos">(Aún te faltan <strong id="cont_evaluaciones_quimicos"><?=5-$cont_evaluaciones_quimicos?></strong> evaluacion(es) por contestar)</i>
                            <?php endif; ?>
                        </div>
                    </section>
                </div>
                <div id="defaultAcpvm_quimicos_Uno" class="collapse" aria-labelledby="pvm_quimicos_Uno1"
                    data-parent="#toggleAccordion_pvm">
                    <div class="card-body">
                    <div class="list-group">
                    <div class="d-flex justify-content-end mb-2"><h6>Fecha de inscripción: <?=Utils_Config::formato_fecha_hora($fecha_inscrito_vigilancia_quimicos)[0];?></h6></div>
                    
                        <div id="crear_remover_evaluacion_quimicos_form1">
                            <?php if ($quimicos_form1 != '0') : ?>
                                    <div class="list-group-item list-group-item-action">
                                        <i class="fa-solid fa-vial"></i> Reporte de vigilancia médica (salud)
                                        <div class="float-right dropdown d-inline-block">
                                            <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="fa-solid fa-ellipsis"></i>
                                            </a>
                                            <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                                style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                                x-placement="bottom-end">
                                                <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                                <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                                <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form1');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> ¡Te falta contestar: Reporte de vigilancia médica (salud)!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form2">
                            <?php if ($quimicos_form2 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form2');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form2');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form2');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                    ¡Te falta contestar: Carta de aceptación/rechazo para el ingreso de vigilancia medica y/o monitoreos clinicos!
                                </a>

                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form3">
                            <?php if ($quimicos_form3 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Cuestionario de ingreso a vigilancia médica de quimicos y agentes farmaceuticos activos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form3');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form3');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form3');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                        ¡Te falta contestar: Cuestionario de ingreso a vigilancia médica de quimicos y agentes farmaceuticos activos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form4">
                            <?php if ($quimicos_form4 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Evaluación previa programa de vigilancia médica de quimicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form4');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form4');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form4');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                        ¡Te falta contestar: Evaluación previa programa de vigilancia médica de quimicos!
                                </a>
                            <?php endif; ?>
                        </div>

                        <div id="crear_remover_evaluacion_quimicos_form5">
                            <?php if ($quimicos_form5 != '0') : ?>
                                
                                <div class="list-group-item list-group-item-action">
                                    <i class="fa-solid fa-vial"></i> Evaluación post programa de vigilancia médica de quimicos
                                    <div class="float-right dropdown d-inline-block">
                                        <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="pendingTask_quimicos"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="fa-solid fa-ellipsis"></i>
                                        </a>
                                        <div class="dropdown-menu left" aria-labelledby="pendingTask_quimicos"
                                            style="will-change: transform; position: absolute; transform: translate3d(-141px, 19px, 0px); top: 0px; left: 0px;"
                                            x-placement="bottom-end">
                                            <a class="dropdown-item" onClick="abrir_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form5');" href="javascript:void(0);"><i class="fa-solid fa-eye"></i> Ver</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onClick="eliminar_evaluacion(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form5');"><i class="fa-solid fa-trash-can"></i> Eliminar</a>
                                            <!--<a class="dropdown-item" href="javascript:void(0);" onClick="firma_supervisor_posterior(<?=$colaborador->IDEmpleado?>, 'quimicos', 'form5');"><i class="fa-solid fa-signature"></i> Firma Supervisor</a>-->
                                        </div>
                                    </div>
                                </div>
                                
                            <?php else: ?>
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action"><i class="fa-solid fa-vial"></i>
                                        ¡Te falta contestar: Evaluación post programa de vigilancia médica de quimicos!
                                </a>
                            <?php endif; ?>
                        </div>


                    </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    
</div>
</div>



