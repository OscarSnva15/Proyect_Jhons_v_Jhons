// Ocultar el loader del botom de guardar formato SOAP
$("#load_atprimaria_formato").hide();

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

        //utilzamos el metodo fecth para comunicar con el backend ,es decir, enviar la info guardar_atencion_primaria
        fetch(`${base_url}atprimaria/guardar_atencion_primaria`,{
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
                formulario.reset();
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


    // El siguiente Evento se hace cargo de precargar para consultar todos los formatos SOAP que ha llenado un colaborador por medio de un <select>, construye los elementos <option> del input <select> padre
    document.addEventListener('DOMContentLoaded', function(event) {

    let wwid = document.querySelector('#soap_pvm_wwid').value;

    controller = `pdv/consultar_formatos_soap_colaborador`;

    const requestOptions = {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id_colaborador: wwid })
    };
    fetch(base_url+controller, requestOptions)
        .then(response => response.json())
        .then(data => {
            
            if (data.data === 'SIN_DATOS') {
                return false;
            }

            for (let i = 0; i < data.data.length; i++) {
                let json_to_text = JSON.stringify(data.data[i]);
                let value_pvm = JSON.parse(json_to_text);
                let x = document.querySelector('#input_seleccion_consulta_soap_pvm');
                // Dinamicamente por medio del id del pvm asignamos su titulo para mejor visualizacion
                let titulo_pvm = seleccionar_titulo_pvm(data.data[i].pvm);
                // Al elemento <option> recien creado le asignamos el valor de su atributo value
                let option = new Option(titulo_pvm, value_pvm.id);
                // Al elemento <option> recien creado le asignamos el valor de su atributo id
                option.setAttribute("id",'soap_pvm_consulta_'+data.data[i].id);
                // Añadimos el hijo <option> al <select> padre
                x.appendChild(option);
            }
        })
        .catch(error => {
                element.parentElement.innerHTML = `Error en recuperar formatos SOAP para consulta: ${error}`;
                console.error('There was an error!', error);
        });
    });