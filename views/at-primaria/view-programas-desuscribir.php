<div class="container-fluid mt-3 mb-3">
    <p id="IDEmpleado_Alta_Baja_PVM"><?=$colaborador->IDEmpleado?></p>
    <table class="table responsive">
        <tbody>
            <!-- atencion primaria -->
            <?php if ($disponible_programa_atprimaria == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-notes-medical fa-lg mr-3"></i>Atención primaria</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="programa_atprimaria" <?php if($inscrito_atencion_primaria == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_agudezavisual == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-eye fa-lg mr-3"></i>Agudeza visual</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6 ">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_agudezavisual" title="checkbox_agudeza_visual" <?php if($inscrito_vigilancia_agudezavisual == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_quimicos == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-flask-vial fa-lg mr-3"></i> Químicos</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_quimicos" <?php if($inscrito_vigilancia_quimicos == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_respiradores == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-head-side-mask fa-lg mr-3"></i> Respiradores</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_respiradores" <?php if($inscrito_vigilancia_respiradores == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_drogas == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-capsules fa-lg mr-3"></i> Monitoreo De Drogas</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_drogas" <?php if($inscrito_vigilancia_drogas == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_patogenos == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-droplet fa-lg mr-3"></i> Patógenos Sanguíneos</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_patogenos" <?php if($inscrito_vigilancia_patogenos == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_auditiva == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-ear-listen fa-lg mr-3"></i> Conservación Auditiva</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_auditiva" <?php if($inscrito_vigilancia_auditiva == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_equipomovil == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-dolly fa-lg mr-3"></i> Equipo Móvil</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_equipomovil" <?php if($inscrito_vigilancia_equipomovil == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_riesgosfisicos == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-person-arrow-up-from-line fa-lg mr-3"></i> Riesgos Físicos</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_riesgosfisicos" <?php if($inscrito_vigilancia_riesgosfisicos == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>

            <?php if ($disponible_programa_ergonomia == 1) : ?>
                <tr>
                    <td class=""></td>
                    <td >
                        <h6 class=""><i class="fa-solid fa-person-arrow-up-from-line fa-lg mr-3"></i> Ergonomia</h6>
                    </td>
                    <td>
                        <div class="col-lg-3 col-md-3 col-sm-4 col-6">
                            <label class="switch s-icons s-outline s-outline-success  mb-4 mr-2">
                                <input type="checkbox" id="pvm_ergonomia" <?php if($inscrito_vigilancia_ergonomia == 1) echo 'checked';?>>
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            
        </tbody>
    </table>
</div>

