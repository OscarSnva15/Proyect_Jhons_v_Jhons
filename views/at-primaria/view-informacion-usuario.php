

<div class="container">

    <div class="container d-flex justify-content-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
            <circle cx="12" cy="7" r="4"></circle>
        </svg>
    </div>

    <h6 class="text-center"><?=$colaborador->Nombre?> <?=$colaborador->APaterno?> <?=$colaborador->AMaterno?></h6>

    <div class="row mt-4 mb-3">
        <div class="col-md">
            <i class="fas fa-hashtag fa-lg mr-3 mt-3"></i>Número empleado: <?=$colaborador->IDEmpleado?>
        </div>
        <div class="col-md">
            <i class="far fa-calendar fa-lg mr-3 mt-3"></i> Fecha de Nacimiento: <?=$colaborador->FechaNaci?>
        </div>
        <div class="col-md">
            <i class="fas fa-venus-mars fa-lg mr-3 mt-3"></i> Género: 
            <?php if($colaborador->Genero == 'M'): ?>
                Masculino
            <?php elseif($colaborador->Genero == 'F'): ?>
                Femenino
            <?php endif; ?>
        </div>
    </div>

    <div class="row mt-4 mb-3">
        <div class="col-md">
            <i class="far fa-address-card fa-lg mr-3 mt-3"></i> RFC: <?=$colaborador->RFC?>
        </div>
        <div class="col-md">
            <i class="far fa-id-card fa-lg mr-3 mt-3"></i> NSS: <?=$colaborador->NSS?>
        </div>
        <div class="col-md">
            <i class="fas fa-address-card fa-lg mr-3 mt-3"></i> CURP: <?=$colaborador->CURP?>
        </div>
    </div>

    <div class="row mt-4 mb-3">
        <div class="col-md">
            <i class="far fa-building fa-lg mr-3 mt-3"></i> Puesto: <?=$colaborador->Puesto?>
        </div>
        <div class="col-md">
            <i class="fas fa-briefcase fa-lg mr-3 mt-3"></i> WWID Manager: <p id="id_supervisor"><?=$colaborador->ManagerID?></p>
        </div>
        <div class="col-md">
            <i class="fas fa-briefcase fa-lg mr-3 mt-3"></i> Manager: <?=$colaborador->NombreManager?>
        </div>
    </div>

    

    <div class="row mt-4 mb-3">
        <div class="col-md">
            <i class="far fa-building fa-lg mr-3 mt-3"></i> Planta: <?=$colaborador->PlantaPertenece?>
        </div>
        <div class="col-md">
            <i class="fas fa-address-card fa-lg mr-3 mt-3"></i> Tipo de Empleado: <?=$colaborador->TipoEmpleado?>
        </div>
        <div class="col-md">
            <i class="fas fa-business-time fa-lg mr-3 mt-3"></i> Turno: <?=$colaborador->Turno?>
        </div>
    </div>

    <div class="row mt-4 mb-3">
        <div class="col-md-4">
            <i class="fas fa-building fa-lg mr-3 mt-3"></i> Centro de Costos: <?=$colaborador->CostCenter?>
        </div>
    </div>

    

</div>
