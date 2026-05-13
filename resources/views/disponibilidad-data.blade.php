<style>
    @media only screen and (min-width: 992px) {
        #imagen-unidad{
            flex-grow: 1; position: relative;
        }
    }

    @media only screen and (max-width: 992px) {
        #imagen-unidad{
            height: 100vw; position: relative;
        }
    }
</style>
<div class="responsive-row">
    <div id="checking" style="width:40%;">
        @if(isset($imp))
        <div id="image-map-pro-tower"></div>
        @else
        <x-f-image :data="$unit" id="nivel" src="Fachada/" ext=".jpg"/>
        @endif
    </div>
    <div style="width:60%;">
        @if(isset($imp))
        <div class="floor-cover no-phone" style="display:flex; align-items: center; justify-content: center; height:100%;">
            <img style="width:50%;" src="https://opera.propstudios.mx/Images/Opera Dorado.png" alt="">
        </div>
        @endif
        <div class="floor" style="display:flex; flex-direction: column; height:100%;">
            <div class="responsive-row" style="justify-content: end;">
                <div class="unit-area" style="width:50%; margin-top:24px; @if(isset($imp)) display:none; @endif">
                    <div class="floor-content" style="margin-left:36px;">
                        <h1 id="unidad-display" style="font-size: 2.5rem !important;">
                            <b>UNIDAD <x-f-text id="unit" :data="$unit"></x-f-text></b>
                        </h1>
                        <div style="">
                            <div class="icono-container">
                                <img class="icono" src="{{ image('IconosCaracteristicas/Interior.png') }}">
                                <span>INTERIOR: </span><x-f-text id="interior" :data="$unit"></x-f-text><span>M²</span>
                            </div>
                            <div class="icono-container">
                                <img class="icono" src="{{ image('IconosCaracteristicas/Exterior.png') }}">
                                <span>EXTERIOR: </span><x-f-text id="exterior" :data="$unit"></x-f-text><span>M²</span>
                            </div>
                            <div class="icono-container">
                                <img class="icono" src="{{ image('IconosCaracteristicas/Total.png') }}">
                                <span>TOTAL: </span><x-f-text id="total" :data="$unit"></x-f-text><span>M²</span>
                            </div>
                            <div class="icono-container">
                                <img class="icono" src="{{ image('IconosCaracteristicas/Recámaras.png') }}">
                                <span>RECÁMARAS: </span><x-f-text id="recamaras" :data="$unit"></x-f-text>
                            </div>
                            <div class="icono-container">
                                <img class="icono" src="{{ image('IconosCaracteristicas/Baños.png') }}">
                                <span>BAÑOS: </span><x-f-text id="baños" :data="$unit"></x-f-text>
                            </div>
                            <x-f-conditional :data="$unit" id="estacionamiento">
                            <div class="icono-container">
                                <img class="icono" src="{{ image('IconosCaracteristicas/Estacionamientos.png') }}">
                                <span>ESTACIONAMIENTOS: </span><x-f-text id="estacionamiento" :data="$unit"></x-f-text>
                                
                            </div>
                            </x-f-conditional>
                            <x-f-conditional :data="$unit" id="cuartoDeServicio">
                            <div class="icono-container" id="servicio">
                                <img class="icono" src="https://opera.propstudios.mx/Images/IconosCaracteristicas/Servicio.png">
                                <span>CUARTO DE SERVICIO: </span><x-f-text id="cuartoDeServicio" :data="$unit"></x-f-text>
                            </div>
                            </x-f-conditional>
                        </div>
                    </div>
                </div>
                <div style="width:50%">
                    @if(isset($imp))
                    <div id="image-map-pro-floor"></div>
                    @else
                    <x-f-image :data="$unit" id="tipo" src="Ubicaciones/Planta/" ext=".png" dif="-ubi"/>
                    @endif
                </div>
            </div>
            <div id="imagen-unidad">
                <x-f-image :data="$unit" id="tipo" src="Modelos/Planta/" ext=".jpg" dif="-planta" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); height: 100%; object-fit: cover;"/>
            </div>
        </div>
        
    </div>
    
</div>
@include('calculos-plan')
<script>
@push('extra_hides')
if($('#fill_enganche').get_number() == 0 && $('#per_plazo').get_number() == 0){
    $('#plan-div-personalized').hide();
}
$('#interes_mensual').hide();
$('#meses_sin_intereses').prop('disabled', true);
@endpush
</script>
<div id="plans" style="@if(empty($unit)) display:none; @endif background-color: #681a0e;">
    <h1 style="text-align: center; padding-top: 36px; color:#967754; font-weight: 500; font-size: 2.5rem !important;" >POLÍTICAS DE PAGO</h1>
    @include("full-listing-template::plans")
    @if(empty($open))
    <div style="display: none;" id="calendario-pagos">
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
            <button class="btn btn-primary" id="btn-consulta" style="margin-top: 36px; margin-bottom: 36px;" onclick="$('#tabla_pagos').toggle();">
                Ver tabla de pagos
            </button>

            <table id="tabla_pagos" style="display: none; border-collapse: collapse; width: 100%; max-width: 700px; margin-bottom: 36px; color: #f5e6d0;">
                <thead>
                  <tr style="background-color: #967754; color: #1a0a04;">
                    <th style="padding: 12px 20px; text-align: center; font-weight: 600; letter-spacing: 0.05em;">Mes</th>
                    <th style="padding: 12px 20px; text-align: right; font-weight: 600; letter-spacing: 0.05em;">Saldo al inicio</th>
                    <th style="padding: 12px 20px; text-align: right; font-weight: 600; letter-spacing: 0.05em;">Pago</th>
                    <th style="padding: 12px 20px; text-align: right; font-weight: 600; letter-spacing: 0.05em;">Saldo al final</th>
                  </tr>
                </thead>
                <tbody id="pagos">

                </tbody>
            </table>
            <style>
              #tabla_pagos tbody tr:nth-child(odd)  { background-color: rgba(150,119,84,0.15); }
              #tabla_pagos tbody tr:nth-child(even) { background-color: rgba(150,119,84,0.05); }
              #tabla_pagos tbody tr:hover           { background-color: rgba(150,119,84,0.30); }
              #tabla_pagos tbody td                 { padding: 10px 20px; text-align: right; border-bottom: 1px solid rgba(150,119,84,0.2); }
              #tabla_pagos tbody td:first-child     { text-align: center; }
            </style>
        </div>
    </div>
    @endif
</div>

@if(isset($imp))
@include('listing-utils::ImageMapPro.multi-image-map-pro',['imp'=>$imp])
@endif


