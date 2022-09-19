// Ocultar el loader del botom de guardar formato SOAP
$("#load_atprimaria_formato").hide();
// Ocultar loader de descargar formato SOAP
$("#load2_atprimaria_formato").hide();

const form = document.getElementById('atprimaria_perfilsalud_formato');
    
    form.addEventListener("submit", function(e){
        e.preventDefault();

        //bloquear el bottom de guardar, desactivamos un bottom con el metodo disabled = true
        document.querySelector('#guardar_formato_atprimaria').disabled = true;
        
        // Aparecer el sppiner de carga alado del boton guardar
        $("#load_formato_atprimaria").show();

        // capturas la clase "fecha" para verificar que ninguna fecha este vacia
        var verificar_fechas = $('.fecha').toArray().some(function(elemento) {
        // Si la fecha esta vacia, le agregamos la calse error_input que colorea el borde de color rojo, indicando que esta vacio. 
        if ($(elemento).val() === '') {
            $(elemento).addClass('error_input');
        }else{
            $(elemento).removeClass('error_input');
        } 
        return $(elemento).val().length < 1
        });

        // Si minimo falta una fecha, cancela el envio del formato
        if (verificar_fechas) {
            // Mostramos un mensaje por pantalla de que faltan agregar fechas
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'warning',
                title: '¡No se han capturado todas las fechas!'
            })
            // Desbloquear el boton de guardar
            document.querySelector('#guardar_formato_atprimaria').disabled = false;

            // Cancelamos el evento submit
            return false;
        }
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

        //Creamos el formdata
        var data = new FormData(form);
        console.log(data)
        //utilzamos el metodo fecth para comunicar con el backend ,es decir, enviar la info guardar_atencion_primaria
        fetch(`${base_url}atprimaria/guardar_datos_atprimaria`,{
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data =>{
            if(data.code == 200){
                Toast.fire({
                    icon: 'success',
                    title: 'Formato de Atencion primaria llenado Correctamente',
                    text: 'Hemos recibido la información, gracias por su tiempo'
                })
                //Habilitamos botom
                document.querySelector('#guardar_formato_atprimaria').disabled = false;
                //Limpiar las firmas
                window.signaturePad_auditiva_form8_firma1.clear();
                window.signaturePad_auditiva_form8_firma2.clear();
                //Limpiar form
                form.reset();
                
            }
            else{
                Toast.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: data.message
                })
            }
            
        });
    });
    
    $(function () {
		window.signaturePad_auditiva_form8_firma1 = new SignaturePad($('#signature_pad_auditiva_form8_firma1').get(0), {});
		window.signaturePad_auditiva_form8_firma2 = new SignaturePad($('#signature_pad_auditiva_form8_firma2').get(0), {});
    });
    
    //limpiador del area de firma empleado
	var clear_auditiva_form8_clean1 = function () {
		window.signaturePad_auditiva_form8_firma1.clear()
	}

    //limpiador del area de firma supervisor
    var clear_auditiva_form8_clean2 = function () {
		window.signaturePad_auditiva_form8_firma2.clear()
	}

    //Ocupamos dos variables una para la firma de empleado y otra para firma de supervisor
    var mycanvas_pvm_auditiva_form8_firma_1 = document.getElementById("signature_pad_auditiva_form8_firma1");
    var mycanvas_pvm_auditiva_form8_firma_2 = document.getElementById("signature_pad_auditiva_form8_firma2");

    //Firma empleado (responsive ordenadores)
	mycanvas_pvm_auditiva_form8_firma_1.addEventListener("click", function () {
		var img_pvm_auditiva_form8_firma_1 = mycanvas_pvm_auditiva_form8_firma_1.toDataURL("image/png");
		$("#signature_pad_auditiva_form8_firma_1").val(img_pvm_auditiva_form8_firma_1);
		// console.log(img_pvm_auditiva_form8_firma_1);
	});

    //firma supervisor (responsive ordenadores)
    mycanvas_pvm_auditiva_form8_firma_2.addEventListener("click", function () {
		var img_pvm_auditiva_form8_firma_2 = mycanvas_pvm_auditiva_form8_firma_2.toDataURL("image/png");
		$("#signature_pad_auditiva_form8_firma_2").val(img_pvm_auditiva_form8_firma_2);
		console.log(img_pvm_auditiva_form8_firma_2);
	});

	//firma empleado (responsive tabletas)
    mycanvas_pvm_auditiva_form8_firma_1.addEventListener("touchend", function () {
		var img_pvm_auditiva_form8_firma_1 = mycanvas_pvm_auditiva_form8_firma_1.toDataURL("image/png");
		$("#signature_pad_auditiva_form8_firma_1").val(img_pvm_auditiva_form8_firma_1);
		console.log(img_pvm_auditiva_form8_firma_1);
	});

    //firma supervisor (responsive tabletas)
    mycanvas_pvm_auditiva_form8_firma_2.addEventListener("touchend", function () {
		var img_pvm_auditiva_form8_firma_2 = mycanvas_pvm_auditiva_form8_firma_2.toDataURL("image/png");
		$("#signature_pad_auditiva_form8_firma_2").val(img_pvm_auditiva_form8_firma_2);
		console.log(img_pvm_auditiva_form8_firma_2);
	});
//**Section de script para la consulta de informacion del formato**/

// Obtenemos el id del select en el documento html
let formato_seleccionado = document.getElementById('input_seleccion_formato_atprimaria');

document.addEventListener('DOMContentLoaded',function(event){

    let wwid = document.querySelector('#atprimaria_perfilsalud_wwid').value;
    dato = {id: wwid}

    fetch(`${base_url}atprimaria/consultar_datos_atprimaria`,{
        method: 'POST',
        headers: {'Contend-Type':'application/json' },
        body: JSON.stringify(dato)
    })
    .then(response => response.json())
    .then(data =>{
        if (data.data === 'SIN_DATOS') {
            return false;
        }
        for(let i = 0; i<data.data.length; i++){
            let data_to_text =  JSON.stringify(data.data[i]);
            let option = new Option(data.data[i]['atprimaria_perfilsalud_nombre'],data.data[i]['atprimaria_perfilsalud_wwid']);
            let x = document.querySelector('#input_seleccion_formato_atprimaria');
            // option.setAttribute("id",'formulario_colaborador'+data.data[i].id);
            x.appendChild(option);
        }
        
    })
    .catch (error => {
        element.parentElement.innerHTML = `Error en recuperar formatos para consulta: ${error}`;
        console.error('There was an error!', error);
    })
});

/**Comienza la seccion para mostrar las información */
// Para poder ver el formato de algun pvm que previamente hemos llenado. hacemos uso del siguiente input select dinamico que cargara la informacion dinamicamente dependiendo del id del formato
let input_seleccion_consulta_formato = document.querySelector('#input_seleccion_formato_atprimaria');

    input_seleccion_consulta_formato.addEventListener('input', function(event){
    let mostrar_documento_atprimaria = document.querySelector('#mostrar_formato_atprimaria');

    // Si no selecciona ningun formato de SOAP, se cancela el evento y la consulta asincrona
    if (input_seleccion_consulta_formato.value == '0') {
        // Como NO se ha seleccionado ningun pvm en concreto, en la seccion de despliegue de formatos no mostraremos nada
        mostrar_formato_atprimaria.innerHTML = `No ha seleccionado ningúna baja de P.V.M.`;
        return false
    };

    // Peticion asincrona del servidor que traera la informacion del formato SOAP por medio de su id para imprimir por pantalla
    let id_formato = input_seleccion_consulta_formato.value;
    dato = {id:id_formato}
    controller = `atprimaria/consultar_datos_atprimaria`;
    const requestOptions = {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(dato)
    };

    fetch(base_url+controller, requestOptions)
        .then(response => response.json())
        .then(data => {  
            // Si al momento de solicitar el formato de SOAP por medio de su id al webservice
            if (data.data === 'SIN_DATOS') {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: 'No se ha encontrado ningún formato de con ese ID'
                });
                return false;
            }

            // Aignamos el campo "data" de la respuesta JSON proporcioanda por el controlador
            let objeto_json_formato_atprimaria = data.data;
            // console.log(objeto_json_formato_atprimaria)
            //Por medio de la funcion "obtener_plantilla_formato_soap_pvm" cargamos y mostramos la plantilla con los datos dinamicos del formato de baja de pvm
            mostrar_formato_atprimaria.innerHTML = obtener_plantilla_atprimaria(objeto_json_formato_atprimaria);

        })
        .catch(error => {
                console.error('There was an error!', error);
        });
});
// function obtener_plantilla_atprimaria(form_data){
//       console.log((form_data[0].atprimaria_perfilsalud_check1 == 'ENDO ') ?  true : false);
// } 
function obtener_plantilla_atprimaria(form_data) {
    return `<div class="tab-content" id="animateLineContent-4">
    <div class="tab-pane fade show active" id="animated-underline-home" role="tabpanel" aria-labelledby="animated-underline-home-tab">
        <form id="atprimaria_perfilsalud_formato">
            <div class="table-responsive">
                <table class="table table-bordered mb-4">
                    <tbody>
                        <div class="container">
                            <!-- COMIENZA HOJA 1 Y 2 CORESPONDIENTE AL FORMULARIO -->
                            <!-- Comienza parte de llenar datos -->
                            <div class="row mt-4">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="atprimaria_perfilsalud_nombre" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">NOMBRE:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_nombre" name="atprimaria_perfilsalud_nombre" value="${form_data[0].atprimaria_perfilsalud_nombre}"  readonly>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_edad" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">EDAD:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_edad" name="atprimaria_perfilsalud_edad" value="${form_data[0].atprimaria_perfilsalud_edad}" readonly>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_wwid" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">WWID:</label>
                                    <input type="text" class="form-control" id="atprimaria_perfilsalud_wwid" name="atprimaria_perfilsalud_wwid" value="${form_data[0].atprimaria_perfilsalud_edad}" readonly>  
                                </div>
                            </div>
                            <!-- termina parte de llenar datos-->
                            <!-- Comienza segundo renglon para la parte de correo y email -->
                            <div class="row mt-4">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="email" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Email:</label>
                                    <input type="email" class="form-control" id="atprimaria_perfilsalud_email" name="atprimaria_perfilsalud_email" value="${form_data[0].atprimaria_perfilsalud_email}" readonly>  
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <label for="atprimaria_perfilsalud_fecha1" class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">Fecha:</label>
                                    <input id="atprimaria_perfilsalud_fecha1" name="atprimaria_perfilsalud_fecha1" value="${form_data[0].atprimaria_perfilsalud_fecha1}"  class="form-control fecha flatpickr flatpickr-input" readonly>
                                    
                                </div>
                            </div>
                            <!-- Termina segundo renglon para la parte de correo y email -->
                                
                            <!-- COMIENZA PLANTA -->
                            <div class="row  border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label for="atprimaria_perfilsalud_check1" class="text-info new-control new-radio radio-info">PLANTA:</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="ENDO"  id="atprimaria_perfilsalud_check1A" name="atprimaria_perfilsalud_check1" ${(form_data[0].atprimaria_perfilsalud_check1 == 'ENDO ') ?  "CHECKED" : ""} readonly>
                                            <span class="new-control-indicator"></span>ENDO
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="INC"  id="atprimaria_perfilsalud_check1B" name="atprimaria_perfilsalud_check1" ${(form_data[0].atprimaria_perfilsalud_check1 == 'INC ') ?  "CHECKED" : ""} readonly>
                                            <span class="new-control-indicator"></span>INC
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="BWI"  id="atprimaria_perfilsalud_check1C" name="atprimaria_perfilsalud_check1" ${(form_data[0].atprimaria_perfilsalud_check1 == 'BWI ') ?  "CHECKED" : ""} readonly>
                                            <span class="new-control-indicator"></span>BWI
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="CERENOVUS"  id="atprimaria_perfilsalud_check1D" name="atprimaria_perfilsalud_check1" ${(form_data[0].atprimaria_perfilsalud_check1 == 'CERENOVUS ') ?  "CHECKED" : ""} readonly>
                                            <span class="new-control-indicator"></span>CERENOVUS
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="CORDIS"  id="atprimaria_perfilsalud_check1E" name="atprimaria_perfilsalud_check1" ${(form_data[0].atprimaria_perfilsalud_check1 == 'CORDIS ') ?  "CHECKED" : ""} readonly>
                                            <span class="new-control-indicator"></span>CORDIS
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- TERMINA PLANTA -->
                            <!-- comienzan label radio LOCACION -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="text-info new-control new-radio radio-info">LOCACION:</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="INDEPENDENCIA"  id="atprimaria_perfilsalud_check2A" name="atprimaria_perfilsalud_check2" ${(form_data[0].atprimaria_perfilsalud_check2 == 'INDEPENDENCIA ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>INDEPENDENCIA
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="TORRES"  id="atprimaria_perfilsalud_check2B" name="atprimaria_perfilsalud_check2" ${(form_data[0].atprimaria_perfilsalud_check2 == 'TORRES ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>TORRES
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="SALVARCAR"  id="atprimaria_perfilsalud_check2C" name="atprimaria_perfilsalud_check2" ${(form_data[0].atprimaria_perfilsalud_check2 == 'SALVARCAR ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>SALVARCAR
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina section para LOCACION-->
                            <!-- COMIENZA SITUACION LABORAL -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="text-info new-control new-radio radio-info">SITUACION LABORAL:</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="JORNADA COMPLETA"  id="atprimaria_perfilsalud_check3A" name="atprimaria_perfilsalud_check3" ${(form_data[0].atprimaria_perfilsalud_check3 == 'JORNADA COMPLETA ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>JORNADA COMPLETA
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="TIEMPO PARCIAL"  id="atprimaria_perfilsalud_check3B" name="atprimaria_perfilsalud_check3" ${(form_data[0].atprimaria_perfilsalud_check3 == 'TIEMPO PARCIAL ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>TIEMPO PARCIAL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="OTRO"  id="atprimaria_perfilsalud_check3C" name="atprimaria_perfilsalud_check3" ${(form_data[0].atprimaria_perfilsalud_check3 == 'OTRO ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>OTRO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- TERMINA SITUACION LABORAL -->
                            <!-- comienza renglo de grupo de tabajo -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="text-info new-control new-radio radio-info">GRUPO DE TRABAJO:</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="ASOCIADO"  id="atprimaria_perfilsalud_check4A" name="atprimaria_perfilsalud_check4" ${(form_data[0].atprimaria_perfilsalud_check4 == 'ASOCIADO ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>ASOCIADO
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="ADMINISTRATIVO"  id="atprimaria_perfilsalud_check4B" name="atprimaria_perfilsalud_check4" ${(form_data[0].atprimaria_perfilsalud_check4 == 'ADMINISTRATIVO ') ?  "CHECKED" : ""} >
                                            <span class="new-control-indicator"></span>ADMINISTRATIVO
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="PROFESIONAL"  id="atprimaria_perfilsalud_check4C" name="atprimaria_perfilsalud_check4" ${(form_data[0].atprimaria_perfilsalud_check4 == 'PROFESIONAL ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>PROFESIONAL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="TECNICO UNICO"  id="atprimaria_perfilsalud_check4D" name="atprimaria_perfilsalud_check4" ${(form_data[0].atprimaria_perfilsalud_check4 == 'TECNICO UNICO ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>TECNICO UNICO
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="OTRO"  id="atprimaria_perfilsalud_check4E" name="atprimaria_perfilsalud_check4" ${(form_data[0].atprimaria_perfilsalud_check4 == 'OTRO ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>OTRO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- termina renglo de grupo de tabajo -->
                            <!-- comienza renglo horario de trabajo -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="text-info new-control new-radio radio-info">HORARIO DE TRABAJO:</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="HORARIO OFICINA"  id="atprimaria_perfilsalud_check5A" name="atprimaria_perfilsalud_check5" ${(form_data[0].atprimaria_perfilsalud_check5 == 'HORARIO OFICINA ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>HORARIO OFICINA
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="1er Turno"  id="atprimaria_perfilsalud_check5B" name="atprimaria_perfilsalud_check5" ${(form_data[0].atprimaria_perfilsalud_check5 == '1er Turno ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>1er Turno
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="2do Turno"  id="atprimaria_perfilsalud_check5C" name="atprimaria_perfilsalud_check5" ${(form_data[0].atprimaria_perfilsalud_check5 == '2do Turno ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>2do Turno
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="3er turno"  id="atprimaria_perfilsalud_check5D" name="atprimaria_perfilsalud_check5" ${(form_data[0].atprimaria_perfilsalud_check5 == '3er turno ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>3er turno
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Turno Especial"  id="atprimaria_perfilsalud_check5E" name="atprimaria_perfilsalud_check5" ${(form_data[0].atprimaria_perfilsalud_check5 == 'Turno Especial ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Turno Especial
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- termina renglon horario de trabajo -->
                            <!-- comienza tiempo en la organizacion -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="text-info new-control new-radio radio-info">TIEMPO EN LA ORGANIZACION</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Menos de 1 año"  id="atprimaria_perfilsalud_check6A" name="atprimaria_perfilsalud_check6" ${(form_data[0].atprimaria_perfilsalud_check6 == 'Menos de 1 año ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Menos de 1 año
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Menos de 1 a 5 años"  id="atprimaria_perfilsalud_check6B" name="atprimaria_perfilsalud_check6" ${(form_data[0].atprimaria_perfilsalud_check6 == 'Menos de 1 a 5 años ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Menos de 1 a 5 años
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Menos de 6 a 10 años"  id="atprimaria_perfilsalud_check6C" name="atprimaria_perfilsalud_check6" ${(form_data[0].atprimaria_perfilsalud_check6 == 'Menos de 6 a 10 años ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Menos de 6 a 10 años
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Mas de 10 años"  id="atprimaria_perfilsalud_check6D" name="atprimaria_perfilsalud_check6" ${(form_data[0].atprimaria_perfilsalud_check6 == 'Mas de 10 años ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Mas de 10 años
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- tiempo en la organizacion -->
                            <!-- comienza renglon contendedor de varios campos()estatura, peso , cintura, cadera -->
                            
                            <div class="row mt-4">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_estatura" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">ESTATURA:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_estatura" name="atprimaria_perfilsalud_estatura" value="${form_data[0].atprimaria_perfilsalud_estatura}" readonly>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_peso" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">PESO:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_peso" name="atprimaria_perfilsalud_peso" value="${form_data[0].atprimaria_perfilsalud_estatura}" readonly>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_cintura" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">CINTURA:</label>
                                    <input type="text" class="form-control" id="atprimaria_perfilsalud_cintura" name="atprimaria_perfilsalud_cintura" value="${form_data[0].atprimaria_perfilsalud_cintura}" readonly>  
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_cadera" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">CADERA:</label>
                                    <input type="text" class="form-control" id="atprimaria_perfilsalud_cadera" name="atprimaria_perfilsalud_cadera" value="${form_data[0].atprimaria_perfilsalud_cadera}" readonly>  
                                </div>
                            </div>
                            <!-- Termina renglon contendedor de varios campos()estatura, peso , cintura, cadera -->
                            <!-- comienza renglon del sexo del paciente -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">SEXO</label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="HOMBRE"  id="atprimaria_perfilsalud_check7A" name="atprimaria_perfilsalud_check7" ${(form_data[0].atprimaria_perfilsalud_check7 == 'HOMBRE ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>HOMBRE
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="MUJER"  id="atprimaria_perfilsalud_check7B" name="atprimaria_perfilsalud_check7" ${(form_data[0].atprimaria_perfilsalud_check7 == 'MUJER ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>MUJER
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina el renglon del sexo del paciente -->
                            <!-- comienza renglon contendedor de varios campos()glucosa, tension arterial , colesterol, colesterol -->
                            <div class="row mt-4">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_glucosa" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">GLUCOSA:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_glucosa" name="atprimaria_perfilsalud_glucosa" value="${form_data[0].atprimaria_perfilsalud_glucosa}" readonly >
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_tension" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">TENSION:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_tension" name="atprimaria_perfilsalud_tension" value="${form_data[0].atprimaria_perfilsalud_tension}" readonly>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_colesterol" class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-7">COLESTEROL:</label>
                                    <input type="text" class="form-control" id="atprimaria_perfilsalud_colesterol" name="atprimaria_perfilsalud_colesterol" value="${form_data[0].atprimaria_perfilsalud_colesterol}" readonly>  
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_hdl" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">HDL:</label>
                                    <input type="text" class="form-control" id="atprimaria_perfilsalud_hdl" name="atprimaria_perfilsalud_hdl" value="${form_data[0].atprimaria_perfilsalud_hdl}" readonly>  
                                </div>
                            </div>
                            <!-- Termina renglon contendedor de varios campos()glucosa, tension arterial , colesterol, colesterol -->
                            <!-- SECTION DE TRCIGECIDLIDOS MIUSMOS DATOSK -->
                            <div class="row mt-4">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
                                    <label for="atprimaria_perfilsalud_ld" class="col-5 col-sm-5 col-md-5 col-lg-5 col-xl-5">LD:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_ld" name="atprimaria_perfilsalud_ld" value="${form_data[0].atprimaria_perfilsalud_colesterol}" readonly>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <label for="atprimaria_perfilsalud_trigliceridos" class="col-7 col-sm-7 col-md-7 col-lg-7 col-xl-6">TRIGLICERIDOS:</label>
                                    <input type="text" class="form-control" id="atprimaria_perfilsalud_trigliceridos" name="atprimaria_perfilsalud_trigliceridos" value="${form_data[0].atprimaria_perfilsalud_trigliceridos}" readonly>  
                                </div>
                            </div>
                            <!-- SECTION DE TRCIGECIDLIDOS MIUSMOS DATOSK -->
                            <!-- titulo div gluscosa -->
                            <div class="row mt-4">
                                <div class="text-info col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">GLUCOSA</div>
                            </div>
                            <!-- titulo div gluscosa -->
                            <!-- comienza la secction de pregunta 8 section glucosa -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    8.- Cuando se le extrajeron las muestras de sangre para el análisis ¿Cuántas horas llevaba aproximadamente sin comer, ni beber nada (excepto agua o bebidas sin azúcar como café o té   
                                </div>
                            </div>
                            <!-- termina la secction de pregunta 8 section glucosa -->
                            <!-- comienza la secction de raidios buttoms de la pregunta 8, section glucosa -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="2 horas" id="atprimaria_perfilsalud_check8A" name="atprimaria_perfilsalud_check8" ${(form_data[0].atprimaria_perfilsalud_check8 == 'Menos de 2 Horas ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Menos de 2 Horas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="2 - 3 horas"  id="atprimaria_perfilsalud_check8B" name="atprimaria_perfilsalud_check8" ${(form_data[0].atprimaria_perfilsalud_check8 == '2 - 3 horas ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Entre 2 y 3 horas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="4 - 8 horas"  id="atprimaria_perfilsalud_check8C" name="atprimaria_perfilsalud_check8" ${(form_data[0].atprimaria_perfilsalud_check8 == 'Entre 4 y 8 horas ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Entre 4 y 8 horas 
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="9 horas o mas"  id="atprimaria_perfilsalud_check8D" name="atprimaria_perfilsalud_check8" ${(form_data[0].atprimaria_perfilsalud_check8 == '9 horas o mas ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>9 horas o mas
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="No se"  id="atprimaria_perfilsalud_check8E" name="atprimaria_perfilsalud_check8" ${(form_data[0].atprimaria_perfilsalud_check8 == 'No se ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>No se
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- termina la secction de raidios buttoms de la pregunta 8, section glucosa -->
                            <!-- Termina la section de GLUCOSA -->
                            <!-- comienza la section de percepcion salud -->
                            <!-- comienza la section de persecpcion de salud el titulo-->
                            <div class="row mt-4 ">
                                <div class="text-info col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">PERCEPCIONES SOBRE SU SALUD<br> </div>
                            </div>
                            <!-- Termina la section de persepcion de salud el titulo -->
                            <!-- comienza la pregunta 9 section de percepciones sobre glucosa -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    9. En general diría que su salud es:   
                                </div>
                            </div>
                            <!-- Termina la pregunta 9 section de percepciones sobre glucosa -->
                                
                            <!-- comienza la section de radio buttoms correspondientes a la pregunta 9 -->
                            <div class="row border-bottom mt-4">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Excelente"  id="atprimaria_perfilsalud_check9A" name="atprimaria_perfilsalud_check9" ${(form_data[0].atprimaria_perfilsalud_check9 == 'Excelente ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Excelente
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Muy buena"  id="atprimaria_perfilsalud_check9B" name="atprimaria_perfilsalud_check9" ${(form_data[0].atprimaria_perfilsalud_check9 == 'Muy buena ') ?  "CHECKED" : ""} >
                                            <span class="new-control-indicator"></span>Muy buena
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Buena"  id="atprimaria_perfilsalud_check9C" name="atprimaria_perfilsalud_check9" ${(form_data[0].atprimaria_perfilsalud_check9 == 'Buena ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Buena 
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Regular"  id="atprimaria_perfilsalud_check9D" name="atprimaria_perfilsalud_check9" ${(form_data[0].atprimaria_perfilsalud_check9 == 'Regular ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Regular
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                    <div class="n-chk">
                                        <label class="new-control new-radio radio-info">
                                            <input type="radio" class="new-control-input" value="Mala"  id="atprimaria_perfilsalud_check9E" name="atprimaria_perfilsalud_check9" ${(form_data[0].atprimaria_perfilsalud_check9 == 'Mala ') ?  "CHECKED" : ""}>
                                            <span class="new-control-indicator"></span>Mala
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- termina la section de radio buttoms correspondientes a la pregunta 9 -->
                            <!-- comienza renglo div , pregunta 10 de la persepcion de salud -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top border-right border-left">
                                    10.	Durante los últimos 30 días ¿Con que frecuencia ha sentido estrés?
                                </div>
                            </div>
                            <!-- termina renglo div , pregunta 10 de la persepcion de salud -->
                            <!-- comienza div renglon contenedor de la pregunta 10 -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left border-bottom">
                                    <!-- comienza radios buttoms correspondientes a la pregunta 10 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Pocas veces o nunca"  id="atprimaria_perfilsalud_check10A" name="atprimaria_perfilsalud_check10" ${(form_data[0].atprimaria_perfilsalud_check10 == 'Pocas veces o nunca ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Pocas veces o nunca
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="A veces"  id="atprimaria_perfilsalud_check10B" name="atprimaria_perfilsalud_check10" ${(form_data[0].atprimaria_perfilsalud_check10 == 'A veces ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>A veces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="La mitad del tiempo aproximadamente"  id="atprimaria_perfilsalud_check10C" name="atprimaria_perfilsalud_check10" ${(form_data[0].atprimaria_perfilsalud_check10 == 'La mitad del tiempo aproximadamente ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>La mitad del tiempo aproximadamente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Gran parte del tiempo"  id="atprimaria_perfilsalud_check10C" name="atprimaria_perfilsalud_check10" ${(form_data[0].atprimaria_perfilsalud_check10 == 'Gran parte del tiempo ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Gran parte del tiempo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Casi todo el tiempo o todo el tiempo"  id="atprimaria_perfilsalud_check10D" name="atprimaria_perfilsalud_check10" ${(form_data[0].atprimaria_perfilsalud_check10 == 'Casi todo el tiempo o todo el tiempo ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Casi todo el tiempo o todo el tiempo
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms correspondientes a la pregunta 10 -->
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-bottom">
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            Estrés<br>(Solo para ser contestado por el médico o personal de salud
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="SI"  id="atprimaria_perfilsalud_check11A" name="atprimaria_perfilsalud_check11" ${(form_data[0].atprimaria_perfilsalud_check11 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NO"  id="atprimaria_perfilsalud_check11B" name="atprimaria_perfilsalud_check11" ${(form_data[0].atprimaria_perfilsalud_check11 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- termina div renglon contendedor la pregunta 10 -->
                            <!-- comienza div renglon de la pregunta 11 -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top border-right border-left">
                                    11.	Los siguientes son acontecimientos importantes que ocurren en la vida de las personas. ¿Cuántos de estos acontecimientos o de acontecimientos similares le sucedieron en el último año
                                </div>
                            </div>
                            <!-- termina div renglon de la pregunta 11 -->
                            <!-- comienza div renglon de las respuestas pregunta 11 -->
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-left border-bottom">
                                    <div class="row mt-4">
                                        <ol>
                                            <li>Muerte conyugue</li>
                                            <li>Separacion de pareja</li>
                                            <li>Perdida financiera considerable</li>
                                            <li>Enfermedad grave en su familia inmediata</li>
                                            <li>Discapacidad</li>
                                            <li>Víctima de un crimen</li>
                                            <li>Pérdida del empleo</li>
                                            <li>Mudanza a otra ciudad</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <div class="row mt-4">
                                        <ol>
                                            <li>Reconsiliacion marital</li>
                                            <li>Demanda o encarcelamiento</li>
                                            <li>Desastre natural</li>
                                            <li>Muerte de un familiar cercano</li>
                                            <li>Nacimiento de un hijo o adopción</li>
                                            <li>Nuevo empleo o ascenso</li>
                                            <li>Compra de casa</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <!-- comienza radio buttoms correspondientes a la pregunta 11 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Ninguno"  id="atprimaria_perfilsalud_check12A" name="atprimaria_perfilsalud_check12" ${(form_data[0].atprimaria_perfilsalud_check12 == 'Ninguno ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Ninguno
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="1 acontecimiento"  id="atprimaria_perfilsalud_check12B" name="atprimaria_perfilsalud_check12" ${(form_data[0].atprimaria_perfilsalud_check12 == '1 acontecimiento ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 acontecimiento
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 acontecimientos"  id="atprimaria_perfilsalud_check12C" name="atprimaria_perfilsalud_check12" ${(form_data[0].atprimaria_perfilsalud_check12 == '2 acontecimientos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 acontecimientos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="3 acontecimientos"  id="atprimaria_perfilsalud_check12D" name="atprimaria_perfilsalud_check12" ${(form_data[0].atprimaria_perfilsalud_check12 == '3 acontecimientos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 acontecimientos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 o mas acontecimeintos"  id="atprimaria_perfilsalud_check12E" name="atprimaria_perfilsalud_check12" ${(form_data[0].atprimaria_perfilsalud_check12 == '4 o mas acontecimeintos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 o mas acontecimeintos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 días"  id="atprimaria_perfilsalud_check12F" name="atprimaria_perfilsalud_check12" ${(form_data[0].atprimaria_perfilsalud_check12 == '5 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 días
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radio buttoms correspondientes a la pregunta 11 -->
                                </div>
                            </div>
                            <!-- Termina div renglon de las respuestas pregunta 11 -->
                            <!-- comienza div renglon de la pregunta 12 doce section percesepcion salud -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top border-right border-left">
                                    12.	En las últimas 2 semanas ¿con que frecuencia se ha visto afectado por uno de los siguientes problemas?:
                                </div>
                            </div>
                            <!-- termina div renglon de la pregunta 12 doce section percesepcion salud -->
                            <!-- comienza div renglon de las respuestas pregunta 12 section pers. salud -->
                            <div class="row">
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 border-top border-right border-left border-bottom">
                                    <!-- comienzan radio buttom respuesta 12 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            Poco interes en hacer cosas o dificultad para disfrutarlas    
                                        </div>
                                    </div>
                                    <!-- terminan radio buttom -->
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 border-top border-right border-bottom">
                                    <!-- comienza section de radio buttoms pregunta 12 columna 2 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Nada en absoluto"  id="atprimaria_perfilsalud_check13A" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'Nada en absoluto ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Nada en absoluto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Algunos dias"  id="atprimaria_perfilsalud_check13B" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'Algunos dias ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Algunos dias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="Mas de la mitad de los dias"  id="atprimaria_perfilsalud_check13C" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'Mas de la mitad de los dias ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Mas de la mitad de los dias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="casi todos los dias"  id="atprimaria_perfilsalud_check13D" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'casi todos los dias ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>casi todos los dias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 o mas acontecimeintos"  id="atprimaria_perfilsalud_check13E" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == '4 o mas acontecimeintos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 o mas acontecimeintos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 días"  id="atprimaria_perfilsalud_check13F" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == '5 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 días
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina section de radio buttoms pregunta 12 columna 2 -->
                                </div>
                                <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2 border-top border-right border-bottom">
                                    <!-- comienza radio buttoms correspondientes a la pregunta 11 columna 3 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            Sentirse triste o deprimido o sin esperanzas    
                                        </div>
                                    </div>
                                    <!-- Terminan radio buttoms correspondientes a la pregunta 11 columna 3-->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-bottom">
                                    <!-- comienza la seccion de radio buttom pregunta 12 columna 4 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Nada en absoluto"  id="atprimaria_perfilsalud_check13A" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'Nada en absoluto ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Nada en absoluto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Algunos dias"  id="atprimaria_perfilsalud_check13B" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'Algunos dias ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Algunos dias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Mas de la mitad de los dias"  id="atprimaria_perfilsalud_check13C" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'Mas de la mitad de los dias ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Mas de la mitad de los dias
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="casi todos los dias"  id="atprimaria_perfilsalud_check13D" name="atprimaria_perfilsalud_check13" ${(form_data[0].atprimaria_perfilsalud_check13 == 'casi todos los dias ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>casi todos los dias
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina la seccion de radio buttom pregunta 12 columna 4 -->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-bottom">
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            Depresión<br>(Solo para ser contestado por el médico o personal de salud
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <!-- comienza section de checbox radio buttoms correspondientes a la pregunta 14 columna 5 -->
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="SI"  id="atprimaria_perfilsalud_check14A" name="atprimaria_perfilsalud_check14" ${(form_data[0].atprimaria_perfilsalud_check14 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NO"  id="atprimaria_perfilsalud_check14B" name="atprimaria_perfilsalud_check14" ${(form_data[0].atprimaria_perfilsalud_check14 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                        <!-- termina section de checbox radio buttoms correspondientes a la pregunta 14 columnas 5 -->
                                    </div>
                                </div>
                            </div>
                            <!-- Termina div renglon de las respuestas pregunta 12 section pers. salud -->
                            <!-- comienza div renglon de la pregunta 13 -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top border-right border-left">
                                    13.Enfermedad crónica: ¿Algún profesional médico le ha dicho que ACTUALMENTE TIENE una o más de las siguientes enfermedades crónicas o que duran mucho tiempo? (Marque todas las que corresponden
                                </div>
                            </div>
                            <!-- termina div renglon de la pregunta 13 -->
                            <!-- comienza div renglon de las respuestas pregunta 13 -->
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-left border-bottom">
                                    <!-- comienza section de radio buttoms pregunta 13 columna 1 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Diabetes tipo 1"  id="atprimaria_perfilsalud_check15A" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Diabetes tipo 1 ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Diabetes tipo 1
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Presion alta (Hipertensión arterial)"  id="atprimaria_perfilsalud_check15B" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Presion alta (Hipertensión arterial) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Presion alta (Hipertensión arterial)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Colesterol alto"  id="atprimaria_perfilsalud_check15C" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Colesterol alto ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Colesterol alto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Enfermedad del corazón"  id="atprimaria_perfilsalud_check15D" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Enfermedad del corazón ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Enfermedad del corazón
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina section de radio buttoms pregunta 13 columna 1 -->
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <!-- comienza section de radio buttoms pregunta 13 columna 2 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Cualquier cáncer excepto el carcinoma baso celular"  id="atprimaria_perfilsalud_check15E" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Cualquier cáncer excepto el carcinoma baso celular ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Cualquier cáncer excepto el carcinoma baso celular
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Afección pulmonar (asma, enfisema)"  id="atprimaria_perfilsalud_check15F" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Afección pulmonar (asma, enfisema) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Afección pulmonar (asma, enfisema)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina section de radio buttoms pregunta 13 columna 2 -->
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <!-- comienza radio buttoms correspondientes a la pregunta 13 columna 3 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Otras enfermedades crónicas de larga duración (artritis, problemas de espada)"  id="atprimaria_perfilsalud_check15G" name="atprimaria_perfilsalud_check15" ${(form_data[0].atprimaria_perfilsalud_check15 == 'Otras enfermedades crónicas de larga duración (artritis, problemas de espada) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Otras enfermedades crónicas de larga duración (artritis, problemas de espada)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina radio buttoms correspondientes a la pregunta 13 columna 3 -->
                                </div>
                            </div>
                            <!-- Termina div renglon de las respuestas pregunta 13 -->
                            <!-- comienza div renglon de la pregunta 14 section percep salud -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top border-right border-left">
                                    ¿ESTA RECIBIENDO tratamiento para una de las siguientes enfermedades crónicas o afecciones de larga duración? (Marque todas las que corresponden)
                                </div>
                            </div>
                            <!-- termina div renglon de la pregunta 14 section percep salud -->
                            <!-- comienza renglon de respuestas pregunta 13 complemento -->
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-left border-bottom">
                                    <!-- comienza section de radio buttoms pregunta 13 columna 1 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Diabetes tipo 1"  id="atprimaria_perfilsalud_check16A" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Diabetes tipo 1 ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Diabetes tipo 1
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Presion alta (Hipertensión arterial)"  id="atprimaria_perfilsalud_check16B" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Presion alta (Hipertensión arterial) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Presion alta (Hipertensión arterial)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Colesterol alto"  id="atprimaria_perfilsalud_check16C" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Colesterol alto ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Colesterol alto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Enfermedad del corazón"  id="atprimaria_perfilsalud_check16D" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Enfermedad del corazón ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Enfermedad del corazón
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina section de radio buttoms pregunta 13 columna 1 -->
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <!-- comienza section de radio buttoms pregunta 13 columna 2 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Cualquier cáncer excepto el carcinoma baso celular"  id="atprimaria_perfilsalud_check16A" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Cualquier cáncer excepto el carcinoma baso celular ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Cualquier cáncer excepto el carcinoma baso celular
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Afección pulmonar (asma, enfisema)"  id="atprimaria_perfilsalud_check16B" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Afección pulmonar (asma, enfisema) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Afección pulmonar (asma, enfisema)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina section de radio buttoms pregunta 13 columna 2 -->
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <!-- comienza radio buttoms correspondientes a la pregunta 13 columna 3 -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Otras enfermedades crónicas de larga duración (artritis, problemas de espada)"  id="atprimaria_perfilsalud_check16A" name="atprimaria_perfilsalud_check16" ${(form_data[0].atprimaria_perfilsalud_check16 == 'Otras enfermedades crónicas de larga duración (artritis, problemas de espada) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Otras enfermedades crónicas de larga duración (artritis, problemas de espada)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina radio buttoms correspondientes a la pregunta 13 columna 3 -->
                                </div>
                            </div>
                            <!-- termina div renglon de las respuestas pregunta 13 section perceo salud -->
                            <!-- Termina la section de percepcion salud -->
                            <!-- comienza la secction de Nutricion -->
                            <!-- comienza renglon del titulo section Nutricion -->
                            <div class="row mt-4">
                                <div class="text-info col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">NUTRICION</div>
                            </div>
                            <!-- Termina renglon del titulo section glucosa -->
                            <!-- comienza mi primer renglon de la sección Nutricion-->
                            <div class="row mt-4">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6  border-top border-right border-left">
                                    Buena alimentación<br>(Solo para ser contestado por el médico o personal de salud)
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    <!-- radios buttons -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="SI"  id="atprimaria_perfilsalud_check17A" name="atprimaria_perfilsalud_check17" ${(form_data[0].atprimaria_perfilsalud_check17 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NO"  id="atprimaria_perfilsalud_check17B" name="atprimaria_perfilsalud_check17" ${(form_data[0].atprimaria_perfilsalud_check17 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina los radio buttoms -->
                                </div>
                            </div>
                            <!-- Termina mi primer renglon de la seccion ejercicio-->
                            <!-- comienza mi segun renglon section ejercicio-->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    14.	En promedio ¿Cuántas porciones de fruta come en un día?
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    15.	En promedio ¿Cuántas porciones de verdura come en un día? Cuente las verduras cocidas, crudas, frescas, congeladas y enlatadas, y zumos de verduras.
                                </div>
                            </div>
                            <!-- termina mi segundo renglon section ejercicio-->
                            <!-- Comienza mi tercer renglon section ejercicio-->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos de porcion:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    120ml (1/2 vaso) de fruta fresca, congelada o enlatada
                                                </li>
                                                <li>
                                                    60ml (1/4 vaso) de frutas secas
                                                </li>
                                                <li>
                                                    120ml (1/2 vaso) de jugo de frutas naturales
                                                </li>
                                                <li>
                                                    1 manzana pequeña
                                                </li>
                                                <li>
                                                    1 plátano pequeño 
                                                </li>
                                                <li>
                                                    1 naranja grande
                                                </li>
                                            </ol>
                                        </div>
                                    </div>     
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de una porción"  id="atprimaria_perfilsalud_check18A" name="atprimaria_perfilsalud_check18" ${(form_data[0].atprimaria_perfilsalud_check18 == 'Menos de una porción ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de una porción
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="1 porciones"  id="atprimaria_perfilsalud_check18B" name="atprimaria_perfilsalud_check18" ${(form_data[0].atprimaria_perfilsalud_check18 == '1 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 porciones"  id="atprimaria_perfilsalud_check18C" name="atprimaria_perfilsalud_check18" ${(form_data[0].atprimaria_perfilsalud_check18 == '2 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="3 porciones"  id="atprimaria_perfilsalud_check18D" name="atprimaria_perfilsalud_check18" ${(form_data[0].atprimaria_perfilsalud_check18 == '3 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 porciones"  id="atprimaria_perfilsalud_check18E" name="atprimaria_perfilsalud_check18" ${(form_data[0].atprimaria_perfilsalud_check18 == '4 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 porciones o más"  id="atprimaria_perfilsalud_check18F" name="atprimaria_perfilsalud_check18" ${(form_data[0].atprimaria_perfilsalud_check18 == '5 porciones o más ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 porciones o más
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos de porcion:
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    120ml (1/2 vaso) de verdura cruda o cocida
                                                </li>
                                                <li>
                                                    240ml (1 vaso) de verduras crudas de hoja verde
                                                </li>
                                                <li>
                                                    120ml (1/2 vaso) de jugo de verdurass
                                                </li>
                                                <li>
                                                    120ml (1/2) vaso frijol, lentejas, maíz
                                                </li>
                                                <li>
                                                    1 zanahoria mediana 
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de una porción"  id="atprimaria_perfilsalud_check19A" name="atprimaria_perfilsalud_check19" ${(form_data[0].atprimaria_perfilsalud_check19 == 'Menos de una porción ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de una porción
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="1 porciones"  id="atprimaria_perfilsalud_check19B" name="atprimaria_perfilsalud_check19" ${(form_data[0].atprimaria_perfilsalud_check19 == '1 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 porciones"  id="atprimaria_perfilsalud_check19C" name="atprimaria_perfilsalud_check19" ${(form_data[0].atprimaria_perfilsalud_check19 == '2 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="3 porciones"  id="atprimaria_perfilsalud_check19D" name="atprimaria_perfilsalud_check19" ${(form_data[0].atprimaria_perfilsalud_check19 == '3 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 porciones"  id="atprimaria_perfilsalud_check19E" name="atprimaria_perfilsalud_check19" ${(form_data[0].atprimaria_perfilsalud_check19 == '4 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 porciones o más"  id="atprimaria_perfilsalud_check19E" name="atprimaria_perfilsalud_check19" ${(form_data[0].atprimaria_perfilsalud_check19 == '5 porciones o más ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 porciones o más
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                            </div>
                            <!-- Termina mi tercer renglon section ejecrcicio-->
                            <!-- comienza mi quinto renglon -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    16.	De todos los alimentos consumidos ¿Con que frecuencia ingiere los alimentos similares a los descritos en el siguiente cuadro
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    17.	De todos los alimentos consumidos ¿Con que frecuencia ingiere alimentos similares a los descritos en el siguiente cuadro
                                </div>
                            </div>
                            <!-- termina mi quinto renglon -->
                            <!-- Comienza mi tercer renglon section ejercicio-->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    Queso
                                                </li>
                                                <li>
                                                    Carene de vaca
                                                </li>
                                                <li>
                                                    Leche y natas enteras
                                                </li>
                                                <li>
                                                    Helado(nieve)
                                                </li>
                                                <li>
                                                    Pasteles, galletas, pastas 
                                                </li>
                                                <li>
                                                    Mantequilla o margarina
                                                </li>
                                                <li>
                                                    Fritos
                                                </li>
                                                <li>
                                                    Hot dogs y salchichas 
                                                </li>
                                                <li>
                                                    Papas fritas
                                                </li>
                                            </ol>
                                        </div>
                                    </div>     
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="1 vez al mes o menos"  id="atprimaria_perfilsalud_check20A" name="atprimaria_perfilsalud_check20" ${(form_data[0].atprimaria_perfilsalud_check20 == '1 vez al mes o menos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 vez al mes o menos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 o 3 veces al mes"  id="atprimaria_perfilsalud_check20B" name="atprimaria_perfilsalud_check20" ${(form_data[0].atprimaria_perfilsalud_check20 == '2 o 3 veces al mes ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 o 3 veces al mes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="De 1 a 3 veces a la semana"  id="atprimaria_perfilsalud_check20C" name="atprimaria_perfilsalud_check20" ${(form_data[0].atprimaria_perfilsalud_check20 == 'De 1 a 3 veces a la semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>De 1 a 3 veces a la semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="De 4 a 6 veces a la semana"  id="atprimaria_perfilsalud_check20D" name="atprimaria_perfilsalud_check20" ${(form_data[0].atprimaria_perfilsalud_check20 == 'De 4 a 6 veces a la semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>De 4 a 6 veces a la semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="De 1 a 3 veces al dia"  id="atprimaria_perfilsalud_check20E" name="atprimaria_perfilsalud_check20" ${(form_data[0].atprimaria_perfilsalud_check20 == 'De 1 a 3 veces al dia ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>De 1 a 3 veces al dia
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 o más veces al día"  id="atprimaria_perfilsalud_check20F" name="atprimaria_perfilsalud_check20" ${(form_data[0].atprimaria_perfilsalud_check20 == '4 o más veces al día ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 o más veces al día
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos de porcion:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    Crema de cacahuatE o semillas
                                                </li>
                                                <li>
                                                    Aguacates
                                                </li>
                                                <li>
                                                    Pescado (salmón o atún
                                                </li>
                                                <li>
                                                    Aderezos de ensalada con aceite
                                                </li>
                                                <li>
                                                    Margarina 
                                                </li>
                                                <li>
                                                    Alimentos cocinados con aceite de oliva 
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="1 vez al mes o menos"  id="atprimaria_perfilsalud_check21A" name="atprimaria_perfilsalud_check21" ${(form_data[0].atprimaria_perfilsalud_check21 == '1 vez al mes o menos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 vez al mes o menos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 o 3 veces al mes"  id="atprimaria_perfilsalud_check21B" name="atprimaria_perfilsalud_check21" ${(form_data[0].atprimaria_perfilsalud_check21 == '2 o 3 veces al mes ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 o 3 veces al mes
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="De 1 a 3 veces a la semana"  id="atprimaria_perfilsalud_check21C" name="atprimaria_perfilsalud_check21" ${(form_data[0].atprimaria_perfilsalud_check21 == 'De 1 a 3 veces a la semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>De 1 a 3 veces a la semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="De 4 a 6 veces a la semana"  id="atprimaria_perfilsalud_check21D" name="atprimaria_perfilsalud_check21" ${(form_data[0].atprimaria_perfilsalud_check21 == 'De 4 a 6 veces a la semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>De 4 a 6 veces a la semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="De 1 a 3 veces al día"  id="atprimaria_perfilsalud_check21E" name="atprimaria_perfilsalud_check21" ${(form_data[0].atprimaria_perfilsalud_check21 == 'De 1 a 3 veces al día ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>De 1 a 3 veces al día
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 o más veces al día"  id="atprimaria_perfilsalud_check21F" name="atprimaria_perfilsalud_check21" ${(form_data[0].atprimaria_perfilsalud_check21 == '4 o más veces al día ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 o más veces al día
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                            </div>
                            <!-- Termina mi tercer renglon section ejecrcicio-->
                            <!-- comienza renglon -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    18.	En promedio, ¿Cuántas porciones con alimentos con grano integral come en un día? (Entre los productos están la avena, palomitas de maíz, arroz integral, harina de trigo integral)
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    19.En promedio ¿Cuántas bebidas azucaradas (Sin edulcorantes artificiales) toma cada día? 1 bebida equivale a 360mL (1 taza y media)
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    20. ¿Con que frecuencia limita cuidadosamente la cantidad de sal (sodio) en los alimentos que come o de las bebidas que toma?
                                </div>
                            </div>
                                
                            <!-- Termina renglon -->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos de porcion:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    1 rebanada de pan con 100% de trigo integral
                                                </li>
                                                <li>
                                                    28 gramos o 240 ml (1 vaso) de cereal de grano integral listo para comer
                                                </li>
                                                <li>
                                                    120 ml (1/2) vaso de cereal cocido tal como la avena
                                                </li>
                                                <li>
                                                    120 ml (1/2) vaso de arroz integral
                                                </li>
                                            </ol>
                                        </div>
                                    </div>     
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de una porción"  id="atprimaria_perfilsalud_check22A" name="atprimaria_perfilsalud_check22" ${(form_data[0].atprimaria_perfilsalud_check22 == 'Menos de una porción ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de una porción
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="2 porciones"  id="atprimaria_perfilsalud_check22B" name="atprimaria_perfilsalud_check22" ${(form_data[0].atprimaria_perfilsalud_check22 == '2 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="3 porciones"  id="atprimaria_perfilsalud_check22C" name="atprimaria_perfilsalud_check22" ${(form_data[0].atprimaria_perfilsalud_check22 == '3 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 porciones"  id="atprimaria_perfilsalud_check22D" name="atprimaria_perfilsalud_check22" ${(form_data[0].atprimaria_perfilsalud_check22 == '4 porciones ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 porciones
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 porciones o más"  id="atprimaria_perfilsalud_check22D" name="atprimaria_perfilsalud_check22" ${(form_data[0].atprimaria_perfilsalud_check22 == '5 porciones o más ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 porciones o más
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de 1 bebida"  id="atprimaria_perfilsalud_check23A" name="atprimaria_perfilsalud_check23" ${(form_data[0].atprimaria_perfilsalud_check23 == 'Menos de 1 bebida ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de 1 bebida
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="1 bebida"  id="atprimaria_perfilsalud_check23B" name="atprimaria_perfilsalud_check23" ${(form_data[0].atprimaria_perfilsalud_check23 == '1 bebida ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 bebida
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 bebidas"  id="atprimaria_perfilsalud_check23C" name="atprimaria_perfilsalud_check23" ${(form_data[0].atprimaria_perfilsalud_check23 == '2 bebidas ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 bebidas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="3 bebidas"  id="atprimaria_perfilsalud_check23D" name="atprimaria_perfilsalud_check23" ${(form_data[0].atprimaria_perfilsalud_check23 == '3 bebidas ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 bebidas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 bebida"  id="atprimaria_perfilsalud_check23D" name="atprimaria_perfilsalud_check23" ${(form_data[0].atprimaria_perfilsalud_check23 == '4 bebida ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 bebida
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 bebidas"  id="atprimaria_perfilsalud_check23D" name="atprimaria_perfilsalud_check23" ${(form_data[0].atprimaria_perfilsalud_check23 == '5 bebidas ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 bebidas o más
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Rara vez o nunca"  id="atprimaria_perfilsalud_check24A" name="atprimaria_perfilsalud_check24" ${(form_data[0].atprimaria_perfilsalud_check24 == 'Rara vez o nunca ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Rara vez o nunca
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="A veces"  id="atprimaria_perfilsalud_check24B" name="atprimaria_perfilsalud_check24" ${(form_data[0].atprimaria_perfilsalud_check24 == 'A veces ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>A veces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="La mitad de las veces"  id="atprimaria_perfilsalud_check24C" name="atprimaria_perfilsalud_check24" ${(form_data[0].atprimaria_perfilsalud_check24 == 'La mitad de las veces ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>La mitad de las veces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="La mayoria de las veces"  id="atprimaria_perfilsalud_check24D" name="atprimaria_perfilsalud_check24" ${(form_data[0].atprimaria_perfilsalud_check24 == 'La mayoria de las veces ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>La mayoria de las veces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Siempre o casi siempre"  id="atprimaria_perfilsalud_check24D" name="atprimaria_perfilsalud_check24" ${(form_data[0].atprimaria_perfilsalud_check24 == 'Siempre o casi siempre ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Siempre o casi siempre
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                            </div>
                            <!-- Termina renflon-->
                            <!-- comienza mi cuarto renglon section ejercicio-->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left"> <br> </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right"> <br> </div>
                            </div>
                            <!-- Termina mi cuarto renglon section ejercicio-->
                            <!-- comienza renglon -->
                            <div class="row mt">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    21. ¿Cuántas porciones de bebidas alcohólicas consume en una semana típica?
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    <br>
                                </div>
                            </div>
                            <!-- termina renglon -->
                            <!-- comienza respuestas del renglon -->
                            <!-- comienza div renglon de las respuestas pregunta 11 -->
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-left border-bottom">
                                    <div class="row mt-4">
                                        <ol>
                                            <li>Ejemplos de una porción:</li>
                                            <li>360ml o (1 vaso y medio) cerveza</li>
                                            <li>150mL (3/4 de vaso) de vino</li>
                                            <li>45 mL (1/5 de vaso) de bebidas con un 40% de alcohol (ejemplos brandi, whisky escoces, vodka, whisky)</li>
                                            <li>360 mL o (1 vaso y medio) de sangría</li>
                                        </ol>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Nunca he consumido bebidas alcohólicas"  id="atprimaria_perfilsalud_check25A" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Nunca he consumido bebidas alcohólicas ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Nunca he consumido bebidas alcohólicas
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de 1 bebida alcohólica por semana"  id="atprimaria_perfilsalud_check25B" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Menos de 1 bebida alcohólica por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de 1 bebida alcohólica por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 1 a y 4 bebidas alcohólicas por semana"  id="atprimaria_perfilsalud_check25C" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Entre 1 a y 4 bebidas alcohólicas por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 1 a y 4 bebidas alcohólicas por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 5 y 7 bebidas alcohólicas"  id="atprimaria_perfilsalud_check25D" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Entre 5 y 7 bebidas alcohólicas ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 5 y 7 bebidas alcohólicas                                                          
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 8 y 14 bebidas alcohólicas por semana"  id="atprimaria_perfilsalud_check25E" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Entre 8 y 14 bebidas alcohólicas por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 8 y 14 bebidas alcohólicas por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 15 y 21 bebidas alcohólicas por semana"  id="atprimaria_perfilsalud_check25F" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Entre 15 y 21 bebidas alcohólicas por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 15 y 21 bebidas alcohólicas por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 22 y 28 bebidas alcohólicas por semana"  id="atprimaria_perfilsalud_check25G" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Entre 22 y 28 bebidas alcohólicas por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 22 y 28 bebidas alcohólicas por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 29 y 35 bebidas alcohólicas por semana"  id="atprimaria_perfilsalud_check25H" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == 'Entre 29 y 35 bebidas alcohólicas por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 29 y 35 bebidas alcohólicas por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="36 bebidas alcohólicas por semana o más (un promedio de 5 bebidas al día)"  id="atprimaria_perfilsalud_check25" name="atprimaria_perfilsalud_check25" ${(form_data[0].atprimaria_perfilsalud_check25 == '36 bebidas alcohólicas por semana o más (un promedio de 5 bebidas al día) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>36 bebidas alcohólicas por semana o más (un promedio de 5 bebidas al día)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 border-top border-right border-bottom">
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            Bebidas alcohólicas <br> (Solo para ser contestado por el médico o personal de salud)
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="SI"  id="atprimaria_perfilsalud_check26A" name="atprimaria_perfilsalud_check26" ${(form_data[0].atprimaria_perfilsalud_check26 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input"  value="NO"  id="atprimaria_perfilsalud_check26B" name="atprimaria_perfilsalud_check26" ${(form_data[0].atprimaria_perfilsalud_check26 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina div renglon de las respuestas pregunta 11 -->
                            <!-- Termina renglon de las respuestas del renglon -->
                        
                            <!-- COMIENZA LA SECCION DE JERCICIO -->
                            <!-- titulo div EJERCICIO -->
                            <div class="row mt-4">
                                <div class="text-info col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">EJERCICIO</div>
                            </div>
                            <!-- titulo div EJERCICIO -->
                            <!-- comienza mi primer renglon de la sección Ejercicio-->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6  border-top border-right border-left">
                                    Actividad Fisica <br> (Solo para ser contestado por el médico o personal de salud)
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    <!-- radios buttons -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="SI" id="atprimaria_perfilsalud_check27A" name="atprimaria_perfilsalud_check27" ${(form_data[0].atprimaria_perfilsalud_check27 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NO" id="atprimaria_perfilsalud_check27B" name="atprimaria_perfilsalud_check27" ${(form_data[0].atprimaria_perfilsalud_check27 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina los radio buttoms -->
                                </div>
                            </div>
                            <!-- Termina mi primer renglon de la seccion ejercicio-->
                            <!-- comienza mi segun renglon section ejercicio-->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    22. La actividad moderada implica ejercitarse lo suficiente como para elevar el ritmo cardiaco y comenzar a sudar. Una forma de determinar si se ha alcanzado este nivel es ser capaz de hablar, pero no de cantar la letra de su canción favorita. Durante los últimos 30 días ¿Cuántos días a la semana solía realizar algún tipo de actividad física moderada?
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    Los días que realizo actividad física moderada ¿Cuántos minutos dedico normalmente a esa actividad? Solo cuente periodos de actividad moderada de 10 minutos o más. Súmelos para poder obtener un total de minutos de actividad física por día. Por ejemplo: tres periodos en 10 minutos de actividad física moderada cuentan cómo un total de 30 minutos.
                                </div>
                            </div>
                            <!-- termina mi segundo renglon section ejercicio-->
                            <!-- Comienza mi tercer renglon section ejercicio-->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    Caminar rápido
                                                </li>
                                                <li>
                                                    Practicar aerobic acuático
                                                </li>
                                                <li>
                                                    Montar en bicicleta en terreno llano o con pocas cuestas
                                                </li>
                                                <li>
                                                    Jugar al tenis en modalidad de dobles
                                                </li>
                                                <li>
                                                    Empujar un corta césped
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- Comienzan radio bottoms sobre dias selection de la pregunta 22  -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="0 días por semana" id="atprimaria_perfilsalud_check28A" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '0 días por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>0 días por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="1 dia" id="atprimaria_perfilsalud_check28B" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '1 dia ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 dia
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 días" id="atprimaria_perfilsalud_check28C" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '2 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="3 días" id="atprimaria_perfilsalud_check28D" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '3 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 días" id="atprimaria_perfilsalud_check28E" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '4 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 días" id="atprimaria_perfilsalud_check28F" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '5 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="6 días" id="atprimaria_perfilsalud_check28G" name="atprimaria_perfilsalud_check28" ${(form_data[0].atprimaria_perfilsalud_check28 == '6 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>6 días
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radios buttoms  sobre dias selection de la pregunta 22-->
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    <!-- Comienzan mis radios sobre minutos selection de la pregunta 22 -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de 10 minutos" id="atprimaria_perfilsalud_check29A" name="atprimaria_perfilsalud_check29" ${(form_data[0].atprimaria_perfilsalud_check29 == 'Menos de 10 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de 10 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 10 y 19 minutos" id="atprimaria_perfilsalud_check29B" name="atprimaria_perfilsalud_check29" ${(form_data[0].atprimaria_perfilsalud_check29 == 'Entre 10 y 19 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 10 y 19 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 20 y 29 minutos" id="atprimaria_perfilsalud_check29C" name="atprimaria_perfilsalud_check29" ${(form_data[0].atprimaria_perfilsalud_check29 == 'Entre 20 y 29 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 20 y 29 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 30 y 44 minutos" id="atprimaria_perfilsalud_check29D" name="atprimaria_perfilsalud_check29" ${(form_data[0].atprimaria_perfilsalud_check29 == 'Entre 30 y 44 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 30 y 44 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 45 y 60 minutos" id="atprimaria_perfilsalud_check29E" name="atprimaria_perfilsalud_check29" ${(form_data[0].atprimaria_perfilsalud_check29 == 'Entre 45 y 60 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 45 y 60 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Mas de una hora" id="atprimaria_perfilsalud_check29F" name="atprimaria_perfilsalud_check29" ${(form_data[0].atprimaria_perfilsalud_check29 == 'Mas de una hora ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Mas de una hora
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan mis radios sobre minutos selection -->
                                </div>
                            </div>
                            <!-- Termina mi tercer renglon section ejecrcicio-->
                            <!-- comienza mi cuarto renglon section ejercicio-->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left"> <br> </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right"> <br> </div>
                            </div>
                            <!-- Termina mi cuarto renglon section ejercicio-->
                            <!-- comienza mi quinto renglon -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    23. La actividad intensa o vigorosa implica una respiración rápida y dificultosa, así como una elevación considerable del ritmo cardiaco. Al ejercitarse a este nivel, solo será capaz de decir unas pocas palabras sin hacer una pausa para respirar. Por lo general ¿Cuántos días a la semana realizo actividad física intensa durante los últimos tres meses?
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    Los días que realizo actividad intensa o vigorosa. ¿Cuántos minutos dedico normalmente a esta actividad? Solo cuente periodos de actividad intensa o vigorosa de 10 minutos o más. Súmelos para obtener un total de minutos de actividad física por día.
                                </div>
                            </div>
                            <!-- termina mi quinto renglon -->
                            <!-- Comienza mi sexto y ultimo renglon de la seccion Ejercicio -->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-left border-right border-top border-bottom">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>Correr</li>
                                                <li>Nadar</li>
                                                <li>Montar en bicicleta a gran velocidad o en terreno a cuestas</li>
                                                <li>Jugar baloncesto </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-right border-top border-bottom">
                                    <!-- Comienzan los correspondientes radio buttoms de la pregunta 23   -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="0 días por semana" id="atprimaria_perfilsalud_check30A" name="atprimaria_perfilsalud_check30" ${(form_data[0].atprimaria_perfilsalud_check30 == '0 días por semana ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>0 días por semana
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="1 dia" id="atprimaria_perfilsalud_check30B" name="atprimaria_perfilsalud_check30" ${(form_data[0].atprimaria_perfilsalud_check30 == '1 dia ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>1 dia
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="2 días" id="atprimaria_perfilsalud_check30C" name="atprimaria_perfilsalud_check30" ${(form_data[0].atprimaria_perfilsalud_check30 == '2 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>2 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="3 días" id="atprimaria_perfilsalud_check30D" name="atprimaria_perfilsalud_check30" ${(form_data[0].atprimaria_perfilsalud_check30 == '3 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>3 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="4 días" id="atprimaria_perfilsalud_check30E" name="atprimaria_perfilsalud_check30" ${(form_data[0].atprimaria_perfilsalud_check30 == '4 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>4 días
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="5 días" id="atprimaria_perfilsalud_check30F" name="atprimaria_perfilsalud_check30" ${(form_data[0].atprimaria_perfilsalud_check30 == '5 días ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>5 días
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan los correspondientes radio buttoms de la pregunta 23 -->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-right border-top border-bottom">
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-bottom">
                                            Ejemplos:
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <ol>
                                                <li>
                                                    Dos periodos de 10 minutos de actividad física intensa o vigorosa cuentan como 20 minutos
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-right border-top border-bottom">
                                    <!-- comienzan radio buttom sobre minutos de la pregunta 25 -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Menos de 10 minutos" id="atprimaria_perfilsalud_check31A" name="atprimaria_perfilsalud_check31" ${(form_data[0].atprimaria_perfilsalud_check31 == 'Menos de 10 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Menos de 10 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 10 y 19 minutos" id="atprimaria_perfilsalud_check31B" name="atprimaria_perfilsalud_check31" ${(form_data[0].atprimaria_perfilsalud_check31 == 'Entre 10 y 19 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 10 y 19 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 20 y 29 minutos" id="atprimaria_perfilsalud_check31C" name="atprimaria_perfilsalud_check31" ${(form_data[0].atprimaria_perfilsalud_check31 == 'Entre 20 y 29 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 20 y 29 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 30 y 44 minutos" id="atprimaria_perfilsalud_check31D" name="atprimaria_perfilsalud_check31" ${(form_data[0].atprimaria_perfilsalud_check31 == 'Entre 30 y 44 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 30 y 44 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Entre 45 y 60 minutos" id="atprimaria_perfilsalud_check31E" name="atprimaria_perfilsalud_check31" ${(form_data[0].atprimaria_perfilsalud_check31 == 'Entre 45 y 60 minutos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Entre 45 y 60 minutos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Mas de una hora" id="atprimaria_perfilsalud_check31F" name="atprimaria_perfilsalud_check31" ${(form_data[0].atprimaria_perfilsalud_check31 == 'Mas de una hora ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Mas de una hora
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radio butttoms sobre minutos de la pregunta 25k -->
                                </div>
                            </div>
                            <!-- Termina mi sexto y ultimo renglon de la seccion Ejercicio -->
                            
                            <!-- Termina mi sexto y ultimo renglon de la seccion Ejercicio -->
                            <!-- TERMINA SECTION DE JERCICIO -->
                  
                            <!-- termina renglon div invisble de serparacion -->
                            <div class="row mt-4">
                                <div class="text-info col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">TABACO</div>
                            </div>
                            <!-- Comienza renglons 1 de la seccion Tabaco -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6  border-top border-right border-left">
                                    Tabaco <br> (Solo para ser contestado por el médico o personal de salud) <br> Si ha fumado menos de 100 cigarrillos (5 paquetes grandes) en su vida se considera una persona no fumadora
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    <!-- radios buttons -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="SI" id="atprimaria_perfilsalud_check32A" name="atprimaria_perfilsalud_check32" ${(form_data[0].atprimaria_perfilsalud_check32 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NO" id="atprimaria_perfilsalud_check32B" name="atprimaria_perfilsalud_check32" ${(form_data[0].atprimaria_perfilsalud_check32 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina los radio buttoms -->
                                </div>
                            </div>
                            <!-- Termina renglon 1 de la secion de Tabaco -->
                            <!-- Comienza el renglon 2 de la seccion de tabaco -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left">
                                    24. ¿Qué tipo de tabaco consume actualmente?
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    25. ¿Trabajo, vive o pasa tiempo a menudo con personas que fuman con regularidad a su alrededor?
                                </div>
                            </div>
                            <!-- Termina el renglon 2 de laseccion de tabaco -->
                            <!-- Comienza renglon 3 de la seccion de Tabaco -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left border-bottom">
                                    <!-- comienzan radios buttom correspondientes a la regunta 24 section tabaco-->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Nunca he consumido tabaco" id="atprimaria_perfilsalud_check33A" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Nunca he consumido tabaco ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Nunca he consumido tabaco
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Solía consumir tabaco, pero lo deje" id="atprimaria_perfilsalud_check33B" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Solía consumir tabaco, pero lo deje ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Solía consumir tabaco, pero lo deje
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Cigarrillos" id="atprimaria_perfilsalud_check33C" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Cigarrillos ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Cigarrillos
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Pipa" id="atprimaria_perfilsalud_check33D" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'atprimaria_perfilsalud_check33D ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Pipa
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Puros" id="atprimaria_perfilsalud_check33E" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Puros ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Puros
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Tabaco de mascar" id="atprimaria_perfilsalud_check33F" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Tabaco de mascar ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Tabaco de mascar
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Rape" id="atprimaria_perfilsalud_check33G" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Rape ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Rape
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Cualquier otro derivado del tabaco" id="atprimaria_perfilsalud_check33I" name="atprimaria_perfilsalud_check33" ${(form_data[0].atprimaria_perfilsalud_check33 == 'Cualquier otro derivado del tabaco ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Cualquier otro derivado del tabaco
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminann radios coreepondietes sobre a la pregunta 24 secction tabaco -->
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-bottom">
                                    <!-- Comienzan radio buttoms correspondientes a la pregunta 25 section tabaco -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="No" id="atprimaria_perfilsalud_check34A" name="atprimaria_perfilsalud_check34" ${(form_data[0].atprimaria_perfilsalud_check34 == 'No ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>No
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Si, paso tiempo a menudo con personas que fuman con regularidad a mi alrededor" id="atprimaria_perfilsalud_check34B" name="atprimaria_perfilsalud_check34" ${(form_data[0].atprimaria_perfilsalud_check34 == 'Si, paso tiempo a menudo con personas que fuman con regularidad a mi alrededor ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Si, paso tiempo a menudo con personas que fuman con regularidad a mi alrededor
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Si, trabajo con personas que con reguladidad fuman a mi alrededor" id="atprimaria_perfilsalud_check34C" name="atprimaria_perfilsalud_check34" ${(form_data[0].atprimaria_perfilsalud_check34 == 'Si, trabajo con personas que con reguladidad fuman a mi alrededor ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Si, trabajo con personas que con reguladidad fuman a mi alrededor
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Si, vivo con prsonas que fuman con regulardad a mi alrededor" id="atprimaria_perfilsalud_check34D" name="atprimaria_perfilsalud_check34" ${(form_data[0].atprimaria_perfilsalud_check34 == 'Si, vivo con prsonas que fuman con regulardad a mi alrededor ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Si, vivo con prsonas que fuman con regulardad a mi alrededor
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Terminan radio buttoms correspondientes a la pregunta 25 section tabaco -->
                                </div>
                            </div>
                            <!-- Termina el renglon 3 de la seccion de tabaco -->
                            <!-- TERMINA LA SECCION DE TABACO -->
                            <!-- COMIENZA LA SECCIÓN DE OTROS -->
                            <!-- Comienza renglon div invisible de separacion -->
                            <div class="row">
                                <div class="text-info mt-4 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">OTROS<br> </div>
                            </div>
                            <!-- termina renglon div invisble de serparacion -->
                            <!-- Comienza renglon 1 de la section de Otros -->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    26. Piense únicamente en los últimos 30 días. Al despertarse para ir a trabajar ¿Cuántas veces lo hacía despejado/a y descansado/a?
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    27. ¿Su padre, madre, hermano, hermana o hijo tuvo un ataque al corazón o enfermedad cardiaca siendo varón menor de 55 años, o de 65 siendo mujer?
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    28. Indique si toma actualmente medicación para las siguientes afecciones. (Marque todas las que corresponden)
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    29. ¿Con que frecuencia usa el cinturón de seguridad cuando conduce o viaje en coche, camión, autobús o taxi?
                                </div>
                            </div>
                            <!-- Termina renglon 1 de la section  de Otros -->
                            <!-- Comienza el 2 renglon de lasseccion de otros -->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    <!-- Comienza la section de radio bottoms correspondientes a la pregunta 26 -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Casi nunca o nunca" id="atprimaria_perfilsalud_check35A" name="atprimaria_perfilsalud_check35" ${(form_data[0].atprimaria_perfilsalud_check35 == 'Casi nunca o nunca ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Casi nunca o nunca
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="A veces" id="atprimaria_perfilsalud_check35B" name="atprimaria_perfilsalud_check35" ${(form_data[0].atprimaria_perfilsalud_check35 == 'A veces ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>A veces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Cerca de la mitad de las veces" id="atprimaria_perfilsalud_check35C" name="atprimaria_perfilsalud_check35" ${(form_data[0].atprimaria_perfilsalud_check35 == 'Cerca de la mitad de las veces ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Cerca de la mitad de las veces
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Habitualmente" id="atprimaria_perfilsalud_check35D" name="atprimaria_perfilsalud_check35" ${(form_data[0].atprimaria_perfilsalud_check35 == 'Habitualmente ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Habitualmente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Casi siempre o siempre" id="atprimaria_perfilsalud_check35E" name="atprimaria_perfilsalud_check35" ${(form_data[0].atprimaria_perfilsalud_check35 == 'Casi siempre o siempre ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Casi siempre o siempre
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Tewrmina la section de radio bottoms correspondientes a la pregunta 26 -->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- radio buttom correspondiente a la pregunta 27 de la section otros-->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="SI" id="atprimaria_perfilsalud_check36A" name="atprimaria_perfilsalud_check36" ${(form_data[0].atprimaria_perfilsalud_check36 == 'SI ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>SI
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NO" id="atprimaria_perfilsalud_check36B" name="atprimaria_perfilsalud_check36" ${(form_data[0].atprimaria_perfilsalud_check36 == 'NO ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NO
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <!-- termina radio buttom correspondiente a la pregunta 27 de la section otros-->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- radio buttom correspondiente a la pregunta 28 de la setcion Otros -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Tensión alta(Hipertensión arterial o presión alta)" id="atprimaria_perfilsalud_check37A" name="atprimaria_perfilsalud_check37" ${(form_data[0].atprimaria_perfilsalud_check37 == 'Tensión alta(Hipertensión arterial o presión alta) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Tensión alta(Hipertensión arterial o presión alta)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Colesterol alto" id="atprimaria_perfilsalud_check37B" name="atprimaria_perfilsalud_check37" ${(form_data[0].atprimaria_perfilsalud_check37 == 'Colesterol alto ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Colesterol alto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Diabetes (Insulina o medicamentos orales)" id="atprimaria_perfilsalud_check37C" name="atprimaria_perfilsalud_check37" ${(form_data[0].atprimaria_perfilsalud_check37 == 'Diabetes (Insulina o medicamentos orales) ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Diabetes (Insulina o medicamentos orales)
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <!--termina radio butoms de la pregunta 28 de ña section Otros -->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <!-- comienza radio buttoms de la pregunta 29, section Otros -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="NUNCA conduzco ni viajo en coche, camión, autobús o taxi" id="atprimaria_perfilsalud_check38A" name="atprimaria_perfilsalud_check38" ${(form_data[0].atprimaria_perfilsalud_check38 == 'NUNCA conduzco ni viajo en coche, camión, autobús o taxi ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>NUNCA conduzco ni viajo en coche, camión, autobús o taxi
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Rara vez uso el cinturón de seguridad" id="atprimaria_perfilsalud_check38B" name="atprimaria_perfilsalud_check38" ${(form_data[0].atprimaria_perfilsalud_check38 == 'Rara vez uso el cinturón de seguridad ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Rara vez uso el cinturón de seguridad
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="A veces uso el cinturón de seguridad" id="atprimaria_perfilsalud_check38C" name="atprimaria_perfilsalud_check38" ${(form_data[0].atprimaria_perfilsalud_check38 == 'A veces uso el cinturón de seguridad ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>A veces uso el cinturón de seguridad
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Uso el cinturón de seguridad la mitad del tiempo aproximadamente" id="atprimaria_perfilsalud_check38D" name="atprimaria_perfilsalud_check38" ${(form_data[0].atprimaria_perfilsalud_check38 == 'Uso el cinturón de seguridad la mitad del tiempo aproximadamente ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Uso el cinturón de seguridad la mitad del tiempo aproximadamente
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Por lo general uso el cinturón de seguridad" id="atprimaria_perfilsalud_check38E" name="atprimaria_perfilsalud_check38" ${(form_data[0].atprimaria_perfilsalud_check38 == 'Por lo general uso el cinturón de seguridad ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Por lo general uso el cinturón de seguridad
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Siempre uso el cinturón de seguridad" id="atprimaria_perfilsalud_check38F" name="atprimaria_perfilsalud_check38" ${(form_data[0].atprimaria_perfilsalud_check38 == 'Siempre uso el cinturón de seguridad ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Siempre uso el cinturón de seguridad
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Termina la section de radio buttoms de la pregunta 29 section Otros -->
                                </div>
                            </div>
                            <!-- Termina el renglon 2 de de la section otros -->
                            <!-- Comienza 3er renglon de la section otros -->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    30. ¿Con que frecuencia lleva un casco protector cuando monta bicicleta o motocicleta?
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    31. Durante el último año. ¿Cuántos días falto al trabajo por motivos de salud u otros problemas médicos personales?
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    32. Productividad laboral)
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    Definiciones:<br>Tener un a productividad al 0% es estar presente en su oficina o lugar de trabajo, pero no poder hacer ningún trabajo útil.<br>Tener productividad al 100% significa: Producir la cantidad y calidad de trabajo que se espera normalmente de un empleado saludable, plenamente capacitado y que toma su trabajo en serio.
                                </div>
                            </div>
                            <!-- Termina el 3 renglon de la section  otros -->
                            <!-- Comienza el 4 renglon de la section otros -->
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right border-left">
                                    <!-- comienza el radio buttom correspondiente a la pregunta 30 de la secion de otros -->
                                    <div class="row mt-2">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Nunca monto bicicleta o moto" id="atprimaria_perfilsalud_check39A" name="atprimaria_perfilsalud_check39" ${(form_data[0].atprimaria_perfilsalud_check39 == 'Nunca monto bicicleta o moto ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Nunca monto bicicleta o moto
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Rara vez llevo casco o nunca" id="atprimaria_perfilsalud_check39B" name="atprimaria_perfilsalud_check39" ${(form_data[0].atprimaria_perfilsalud_check39 == 'Rara vez llevo casco o nunca ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Rara vez llevo casco o nunca
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="A veces llevo casco" id="atprimaria_perfilsalud_check39C" name="atprimaria_perfilsalud_check39" ${(form_data[0].atprimaria_perfilsalud_check39 == 'A veces llevo casco ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>A veces llevo casco
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Llevo casco la mitad del tiempo" id="atprimaria_perfilsalud_check39D" name="atprimaria_perfilsalud_check39" ${(form_data[0].atprimaria_perfilsalud_check39 == 'Llevo casco la mitad del tiempo ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Llevo casco la mitad del tiempo
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Por lo general llevo casco" id="atprimaria_perfilsalud_check39E" name="atprimaria_perfilsalud_check39" ${(form_data[0].atprimaria_perfilsalud_check39 == 'Por lo general llevo casco ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Por lo general llevo casco
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 pl-5">
                                            <div class="n-chk">
                                                <label class="new-control new-radio radio-info">
                                                    <input type="radio" class="new-control-input" value="Siempre llevo casco" id="atprimaria_perfilsalud_check39F" name="atprimaria_perfilsalud_check39" ${(form_data[0].atprimaria_perfilsalud_check39 == 'Siempre llevo casco ') ?  "CHECKED" : ""}>
                                                    <span class="new-control-indicator"></span>Siempre llevo casco
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                <!-- termina el radio buttom correspondiente a la pregunta 30 de la secion de otros -->
                                </div>
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 border-top border-right">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                        <label for="fecha" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">Numero de dias:</label>
                                        <input type="int" class="form-control" id="atprimaria_perfilsalud_dias" name="atprimaria_perfilsalud_dias" value="${form_data[0].atprimaria_perfilsalud_dias}" readonly>  
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right">
                                    En un día de trabajo típico en los últimos 12 meses cual fue su productividad (Marque una línea)
                                    <div class="row mb-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="atprimaria_perfilsalud_productividad" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Escala de 0% - 50% - 100%</label>
                                                <input type="range" class="form-control" id="atprimaria_perfilsalud_productividad" name="atprimaria_perfilsalud_dias" value="${form_data[0].atprimaria_perfilsalud_productividad}" readonly>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina el 4 renglon de la section optros -->
                            <!-- comienza 5 renglon de la seccion de ejercicios -->
                            <div class="row">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-left border-bottom">
                                    33. ¿Cómo se siente de satisfecho con su trabajo?(Marque sobre la línea)
                                    <div class="row mb-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="atprimaria_perfilsalud_satisfaccion1" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Escala de 0% - 50% - 100%</label>
                                                <input type="range" class="form-control" id="atprimaria_perfilsalud_satisfaccion1" name="atprimaria_perfilsalud_satisfaccion1" value="${form_data[0].atprimaria_perfilsalud_satisfaccion1}" readonly>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 border-top border-right border-bottom">
                                    34. ¿Cómo se siente de satisfecho con el aspecto personal (que no tiene que ver con el trabajo) de su vida?
                                    <div class="row mb-4">
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 border-top">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label for="atprimaria_perfilsalud_satisfaccion2" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">Escala de 0% - 50% - 100%</label>
                                                <input type="range" class="form-control" id="atprimaria_perfilsalud_satisfaccion2" name="atprimaria_perfilsalud_satisfaccion2" value="${form_data[0].atprimaria_perfilsalud_satisfaccion2}" readonly>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina 5 renglon de la seccion de ejercicios -->
                            <!-- TERMINA LA SECCIÓN DE OTROS -->
                            <!-- COMIENZA EL APENDICE II DE LA CARTA COMPROMISO DE PERFIL DE SALUD -->
                            <!-- comienza para el titulo del apendice -->
                            <div class="row mt-4">
                                <div class="text-info col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ml-6">
                                    APÉNDICE II-CARTA COMPROMISO DE PERFIL DE SALUD
                                </div>
                            </div>
                            <!-- termina div pata el titulo del apendice -->
                            <!-- comienza para la fecha del apendice -->
                            <div class="row mt-4">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <br>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label>Cd. Juárez, Chihuahua a:</label>
                                    <input class="fecha form-control fecha flatpickr flatpickr-input active" type="date" placeholder="Seleccione una fecha..." id="atprimaria_perfilsalud_fecha2" name="atprimaria_perfilsalud_fecha2" value="${form_data[0].atprimaria_perfilsalud_fecha2}" readonly>
                                    <script>
                                        var f3 = flatpickr(document.getElementById('atprimaria_perfilsalud_fecha2'), {mode: "range"});
                                    </script>
                                </div>
                            </div>
                            <!-- termina div pata el titulo del apendice -->
                            <!-- comienza para la 1ra parte de la carta del apendice -->
                            <div class="row mt-4">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    ACEPTO participar en el Programa Perfil de Salud el cual es VOLUNTARIO. Entiendo que este programa es parte de la estrategia corporativa denominada “Cultura de Salud” que será evaluada en el Campus de Juárez dentro de los procesos de auditoría a Salud Ocupacional
                                </div>
                            </div>
                            <!-- termina div la 1ra parte de la carta del apendice -->
                            <!-- comienza para la 2da parte de la carta del apendice -->
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    ACEPTO EL COMPROMISO de respetar la dieta que se me indique así como las indicaciones de apoyo como actividad física, y seguimiento a tratamientos médicos y/o a las evaluaciones anuales que el departamento médico programe.
                                </div>
                            </div>
                            <!-- termina div la 2daa parte de la carta del apendice -->
                            <!-- comienza para la 3ra parte de la carta del apendice -->
                            <div class="row mt-1">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    Se me informo que el departamento médico mantendrá siempre la confidencialidad de la información sobre diagnósticos y tratamientos de los empleados
                                </div>
                            </div>
                            <!-- termina div la 3ra parte de la carta del apendice -->
                            <!-- TERMINA EL APENDICE II DE LA CARTA COMPROMISO DE PERFIL DE SALUD-->
                            <!-- comienza div section de firmas -->
                            <div class="row mt-4">
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label for="atprimaria_perfilsalud_nombre2" class="col-form-label">NOMBRE:</label>
                                    <input type="text" class="form-control form-control-sm" id="atprimaria_perfilsalud_nombre2" name="atprimaria_perfilsalud_nombre2" value="${form_data[0].atprimaria_perfilsalud_nombre2}" onlyread>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label><strong>Firma del asociado</strong></label>
                                    <br><span>Debe comenzar y terminar su firma dentro del recuadro sombreado</span>
                                    <div class="wrapper mt-4 d-flex justify-content-center">
                                        <canvas id="signature_pad_auditiva_form8_firma1"></canvas>
                                        <input type="hidden" id="signature_pad_auditiva_form8_firma_1" name="signature_pad_auditiva_form8_firma_1">
                                    </div>
                                    <div class="clear-btn">
                                        <a onclick="clear_auditiva_form8_clean1()" class="btn btn-primary mt-3 text-white btn-sm float-right"><span>
                                                <i class="fa-solid fa-signature"></i> Limpiar</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-xl-3"> <br>
                                </div>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                    <label><strong>Firma departamento Médico</strong></label>
                                    <br><span>Debe comenzar y terminar su firma dentro del recuadro sombreado</span>
                                    <div class="wrapper mt-4 d-flex justify-content-center">
                                        <canvas id="signature_pad_auditiva_form8_firma2"></canvas>
                                        <input type="hidden" id="signature_pad_auditiva_form8_firma_2" name="signature_pad_auditiva_form8_firma_2">
                                    </div>
                                    <div class="clear-btn">
                                        <a onclick="clear_auditiva_form8_clean2()" class="btn btn-primary mt-3 text-white btn-sm float-right"><span>
                                        <i class="fa-solid fa-signature"></i> Limpiar</span></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Termina div section de firmas -->
                            
                            <!-- Termina secion de Jercicio -->
                        </div>
                    </tbody>
                </table>
            </div>
            <!-- Boton para enviar los datos -->
            <div class="modal-footer mt-5">
                <button type="submit" class="btn btn-primary" id="guardar_formato_atprimaria">Editar Datos</button>
            </div>
        </form>
    </div>
</div>`;
}