<?php

// EL SIGUIENTE ARCHIVO DE CONFIGURACION ES IMPORTADO EN LA SIGUIENTE RUTA
// lighthouse\views\programa-vigilancia\administracion\alta-baja-pvm\mis-pvm-colaborador.php

// CONFIGURACION PARA MOSTRAR O NO UN PROGRAMAS DE VIGILANCIA MEDICA
// VALOR => 0 SIGNIFICA QUE NO ESTARA DISPONIBLE
// VALOR => 1 SIGNIFICA QUE SI ESTARA DISPONIBLE
$disponible_programa_quimicos = 1;
$disponible_programa_respiradores = 1;
$disponible_programa_agudezavisual = 1;
$disponible_programa_drogas = 1;
$disponible_programa_patogenos = 1;
$disponible_programa_auditiva = 1;
$disponible_programa_equipomovil = 1;
$disponible_programa_riesgosfisicos = 1;
$disponible_programa_ergonomia = 1;
// oscar forms
$disponible_programa_atprimaria = 1;


// $evaluaciones_colaborador hace una llamada al metodo estattico de la clase Utils_Pvm la cual se encarga de ir a la base de datos y consultar que evaluaciones ya respondio o no el colaborador, revisa en todos los programas de vigilancia
$evaluaciones_colaborador = Utils_Pvm::verificar_evaluciones_colaborador($colaborador->IDEmpleado);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA QUMICOS
$inscrito_vigilancia_quimicos = ($evaluaciones_colaborador['inscripcion_quimicos'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_quimicos = $evaluaciones_colaborador['fecha_inscripcion_quimicos'];
$array_evaluaciones_quimicos = [] ;
$quimicos_form1 = $evaluaciones_colaborador['quimicos_form1']; 
$array_evaluaciones_quimicos[] = $quimicos_form1;
$quimicos_form2 = $evaluaciones_colaborador['quimicos_form2']; 
$array_evaluaciones_quimicos[] = $quimicos_form2;
$quimicos_form3 = $evaluaciones_colaborador['quimicos_form3']; 
$array_evaluaciones_quimicos[] = $quimicos_form3;
$quimicos_form4 = $evaluaciones_colaborador['quimicos_form4']; 
$array_evaluaciones_quimicos[] = $quimicos_form4;
$quimicos_form5 = $evaluaciones_colaborador['quimicos_form5']; 
$array_evaluaciones_quimicos[] = $quimicos_form5;
$cont_evaluaciones_quimicos = Utils_Pvm::contar_evaluaciones($array_evaluaciones_quimicos);

// CONFIGURACION DE INICIALIZACION DEL PROGRAMA ATENCION PRIMARIA
$inscrito_atencion_primaria = ($evaluaciones_colaborador['inscripcion_atprimaria'] != '0') ? 1 : 0 ;
$fecha_inscrito_atencion_primaria = $evaluaciones_colaborador['fecha_inscripcion_atprimaria'];
$array_evaluaciones_quimicos = [] ;
$quimicos_form1 = $evaluaciones_colaborador['quimicos_form1']; 
$array_evaluaciones_quimicos[] = $quimicos_form1;
$quimicos_form2 = $evaluaciones_colaborador['quimicos_form2']; 
$array_evaluaciones_quimicos[] = $quimicos_form2;
$quimicos_form3 = $evaluaciones_colaborador['quimicos_form3']; 
$array_evaluaciones_quimicos[] = $quimicos_form3;
$quimicos_form4 = $evaluaciones_colaborador['quimicos_form4']; 
$array_evaluaciones_quimicos[] = $quimicos_form4;
$quimicos_form5 = $evaluaciones_colaborador['quimicos_form5']; 
$array_evaluaciones_quimicos[] = $quimicos_form5;
$cont_evaluaciones_quimicos = Utils_Pvm::contar_evaluaciones($array_evaluaciones_quimicos);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA RESPIRADORES
$inscrito_vigilancia_respiradores = ($evaluaciones_colaborador['inscripcion_respiradores'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_respiradores = $evaluaciones_colaborador['fecha_inscripcion_respiradores'];
$array_evaluaciones_respiradores = [] ;
$respiradores_form1 = $evaluaciones_colaborador['respiradores_form1']; 
$array_evaluaciones_respiradores[] = $respiradores_form1;
$respiradores_form2 = $evaluaciones_colaborador['respiradores_form2']; 
$array_evaluaciones_respiradores[] = $respiradores_form2;
$respiradores_form3 = $evaluaciones_colaborador['respiradores_form3']; 
$array_evaluaciones_respiradores[] = $respiradores_form3;
$respiradores_form4 = $evaluaciones_colaborador['respiradores_form4']; 
$array_evaluaciones_respiradores[] = $respiradores_form4;
$respiradores_form5 = $evaluaciones_colaborador['respiradores_form5']; 
$array_evaluaciones_respiradores[] = $respiradores_form5;
$respiradores_form6 = $evaluaciones_colaborador['respiradores_form6']; 
$array_evaluaciones_respiradores[] = $respiradores_form6;
$respiradores_form7 = $evaluaciones_colaborador['respiradores_form7']; 
$array_evaluaciones_respiradores[] = $respiradores_form7;
$cont_evaluaciones_respiradores = Utils_Pvm::contar_evaluaciones($array_evaluaciones_respiradores);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA AGUDEZA VISUAL
$inscrito_vigilancia_agudezavisual = ($evaluaciones_colaborador['inscripcion_agudezavisual'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_agudezavisual = $evaluaciones_colaborador['fecha_inscripcion_agudezavisual'];
$array_evaluaciones_agudezavisual = [] ;
$agudezavisual_form1 = $evaluaciones_colaborador['agudezavisual_form1']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form1;
$agudezavisual_form2 = $evaluaciones_colaborador['agudezavisual_form2']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form2;
$agudezavisual_form3 = $evaluaciones_colaborador['agudezavisual_form3']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form3;
$agudezavisual_form4 = $evaluaciones_colaborador['agudezavisual_form4']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form4;
$agudezavisual_form5 = $evaluaciones_colaborador['agudezavisual_form5']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form5;
$agudezavisual_form6 = $evaluaciones_colaborador['agudezavisual_form6']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form6;
$agudezavisual_form7 = $evaluaciones_colaborador['agudezavisual_form7']; 
$array_evaluaciones_agudezavisual[] = $agudezavisual_form7;
$cont_evaluaciones_agudezavisual = Utils_Pvm::contar_evaluaciones($array_evaluaciones_agudezavisual);


// CONFIGURACION DE INICIALIZACION DEL MONITOREO DE DROGAS
$inscrito_vigilancia_drogas = ($evaluaciones_colaborador['inscripcion_drogas'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_drogas = $evaluaciones_colaborador['fecha_inscripcion_drogas'];
$array_evaluaciones_drogas = [] ;
$drogas_form1 = $evaluaciones_colaborador['drogas_form1']; 
$array_evaluaciones_drogas[] = $drogas_form1;
$drogas_form2 = $evaluaciones_colaborador['drogas_form2']; 
$array_evaluaciones_drogas[] = $drogas_form2;
$drogas_form3 = $evaluaciones_colaborador['drogas_form3']; 
$array_evaluaciones_drogas[] = $drogas_form3;
$drogas_form4 = $evaluaciones_colaborador['drogas_form4']; 
$array_evaluaciones_drogas[] = $drogas_form4;
$drogas_form5 = $evaluaciones_colaborador['drogas_form5']; 
$array_evaluaciones_drogas[] = $drogas_form5;
$drogas_form6 = $evaluaciones_colaborador['drogas_form6']; 
$array_evaluaciones_drogas[] = $drogas_form6;
$cont_evaluaciones_drogas = Utils_Pvm::contar_evaluaciones($array_evaluaciones_drogas);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA PATOGENOS SANGUINEOS
$inscrito_vigilancia_patogenos = ($evaluaciones_colaborador['inscripcion_patogenos'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_patogenos = $evaluaciones_colaborador['fecha_inscripcion_patogenos'];
$array_evaluaciones_patogenos = [] ;
$patogenos_form1 =  $evaluaciones_colaborador['patogenos_form1'];
$array_evaluaciones_patogenos[] = $patogenos_form1;
$patogenos_form2 =  $evaluaciones_colaborador['patogenos_form2'];
$array_evaluaciones_patogenos[] = $patogenos_form2;
$patogenos_form3 =  $evaluaciones_colaborador['patogenos_form3'];
$array_evaluaciones_patogenos[] = $patogenos_form3;
//Vamos a "simular" el llenado de la evaluacion 4 de patogenos porque no es una evaluacion como tal, no hay datos que mandar
//$patogenos_form4 = /*Utils_Pvm::obtener_evalucion_patogenos_form4($colaborador->IDEmpleado);*/ '1' 
//$array_evaluaciones_patogenos[] = $patogenos_form4
$patogenos_form5 =  $evaluaciones_colaborador['patogenos_form5'];
$array_evaluaciones_patogenos[] = $patogenos_form5;
$patogenos_form6 =  $evaluaciones_colaborador['patogenos_form6'];
$array_evaluaciones_patogenos[] = $patogenos_form6;
$patogenos_form7 =  $evaluaciones_colaborador['patogenos_form7'];
$array_evaluaciones_patogenos[] = $patogenos_form7;
$cont_evaluaciones_patogenos = Utils_Pvm::contar_evaluaciones($array_evaluaciones_patogenos);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA CONSERVACION AUDITIVA
$inscrito_vigilancia_auditiva = ($evaluaciones_colaborador['inscripcion_auditiva'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_auditiva = $evaluaciones_colaborador['fecha_inscripcion_auditiva'];
$array_evaluaciones_auditiva = [] ;
$auditiva_form1 = $evaluaciones_colaborador['auditiva_form1']; 
$array_evaluaciones_auditiva[] = $auditiva_form1;
$auditiva_form2 = $evaluaciones_colaborador['auditiva_form2']; 
$array_evaluaciones_auditiva[] = $auditiva_form2;
$auditiva_form3 = $evaluaciones_colaborador['auditiva_form3']; 
$array_evaluaciones_auditiva[] = $auditiva_form3;
$auditiva_form4 = $evaluaciones_colaborador['auditiva_form4']; 
$array_evaluaciones_auditiva[] = $auditiva_form4;
$auditiva_form5 = /*$evaluaciones_colaborador['auditiva_form5'];*/false; 
$array_evaluaciones_auditiva[] = $auditiva_form5;
$auditiva_form6 = $evaluaciones_colaborador['auditiva_form6']; 
$array_evaluaciones_auditiva[] = $auditiva_form6;
$auditiva_form7 = $evaluaciones_colaborador['auditiva_form7']; 
$array_evaluaciones_auditiva[] = $auditiva_form7;
$cont_evaluaciones_auditiva = Utils_Pvm::contar_evaluaciones($array_evaluaciones_auditiva);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA EQUIPO MOVIL
$inscrito_vigilancia_equipomovil = ($evaluaciones_colaborador['inscripcion_equipomovil'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_equipomovil = $evaluaciones_colaborador['fecha_inscripcion_equipomovil'];
$array_evaluaciones_equipomovil = [] ;
$equipomovil_form1 = $evaluaciones_colaborador['equipomovil_form1']; 
$array_evaluaciones_equipomovil[] = $equipomovil_form1;
$equipomovil_form2 = $evaluaciones_colaborador['equipomovil_form2']; 
$array_evaluaciones_equipomovil[] = $equipomovil_form2;
$equipomovil_form3 = $evaluaciones_colaborador['equipomovil_form3']; 
$array_evaluaciones_equipomovil[] = $equipomovil_form3;
$equipomovil_form4 = $evaluaciones_colaborador['equipomovil_form4']; 
$array_evaluaciones_equipomovil[] = $equipomovil_form4;
$equipomovil_form5 = $evaluaciones_colaborador['equipomovil_form5']; 
$array_evaluaciones_equipomovil[] = $equipomovil_form5;
$equipomovil_form6 = $evaluaciones_colaborador['equipomovil_form6']; 
$array_evaluaciones_equipomovil[] = $equipomovil_form6;
$cont_evaluaciones_equipomovil = Utils_Pvm::contar_evaluaciones($array_evaluaciones_equipomovil);


// CONFIGURACION DE INICIALIZACION DEL PROGRAMA RIESGOS FISICOS
$inscrito_vigilancia_riesgosfisicos = ($evaluaciones_colaborador['inscripcion_riesgosfisicos'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_riesgosfisicos = $evaluaciones_colaborador['fecha_inscripcion_riesgosfisicos'];
$array_evaluaciones_riesgosfisicos = [] ;
$riesgosfisicos_form1 = $evaluaciones_colaborador['riesgosfisicos_form1']; 
$array_evaluaciones_riesgosfisicos[] = $riesgosfisicos_form1;
$riesgosfisicos_form2 = $evaluaciones_colaborador['riesgosfisicos_form2']; 
$array_evaluaciones_riesgosfisicos[] = $riesgosfisicos_form2;
$riesgosfisicos_form3 = $evaluaciones_colaborador['riesgosfisicos_form3']; 
$array_evaluaciones_riesgosfisicos[] = $riesgosfisicos_form3;
$riesgosfisicos_form4 = $evaluaciones_colaborador['riesgosfisicos_form4']; 
$array_evaluaciones_riesgosfisicos[] = $riesgosfisicos_form4;
$riesgosfisicos_form5 = /*$evaluaciones_colaborador['riesgosfisicos_form5']*/false; 
$array_evaluaciones_riesgosfisicos[] = $riesgosfisicos_form5;
$riesgosfisicos_form6 = /*$evaluaciones_colaborador['riesgosfisicos_form6']*/false; 
$array_evaluaciones_riesgosfisicos[] = $riesgosfisicos_form6;
$cont_evaluaciones_riesgosfisicos = Utils_Pvm::contar_evaluaciones($array_evaluaciones_riesgosfisicos);



// CONFIGURACION DE INICIALIZACION DEL PROGRAMA ERGONOMIA
$inscrito_vigilancia_ergonomia = ($evaluaciones_colaborador['inscripcion_ergonomia'] != '0') ? 1 : 0 ;
$fecha_inscrito_vigilancia_ergonomia = $evaluaciones_colaborador['fecha_inscripcion_ergonomia'];
$array_evaluaciones_ergonomia = [] ;
$ergonomia_form1 = $evaluaciones_colaborador['ergonomia_form1']; 
$array_evaluaciones_ergonomia[] = $ergonomia_form1;
$ergonomia_form2 = $evaluaciones_colaborador['ergonomia_form2']; 
$array_evaluaciones_ergonomia[] = $ergonomia_form2;
$ergonomia_form3 = $evaluaciones_colaborador['ergonomia_form3']; 
$array_evaluaciones_ergonomia[] = $ergonomia_form3;
$ergonomia_form4 = $evaluaciones_colaborador['ergonomia_form4']; 
$array_evaluaciones_ergonomia[] = $ergonomia_form4;
$ergonomia_form5 = $evaluaciones_colaborador['ergonomia_form5']; 
$array_evaluaciones_ergonomia[] = $ergonomia_form5;
$cont_evaluaciones_ergonomia = Utils_Pvm::contar_evaluaciones($array_evaluaciones_ergonomia);

?>