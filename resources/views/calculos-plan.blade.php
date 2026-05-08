@push('scripts')
<script>
    $(document).data('no_auto_update_personalized', true);
    $('#fill_plazo').prop('disabled', true);
    $('#fill_interes_mensual').set_value(1.3);
    
    $(document).ready(function() {
        $('#fill_meses_sin_intereses').val(0);
        $('#fill_months_plazo').val(0); 
    });
    $('#fill_interes_mensual').on('input', function(){
        changed_personal();
    });
    $('#fill_meses_sin_intereses').on('input', function(){
        changed_personal();
    });
    $(document).on('personalized_plan_changed', function (e, final_price) {
        @if(!isset($menu))
        $('#fill_enganche').data('flag',true);

        @endif
        var interes_mensual = $('#fill_interes_mensual').get_number() / 100;
        var mensualidades_plazo = $('#fill_months_plazo').get_number();
        var meses_sin_intereses = $('#fill_meses_sin_intereses').get_number();
        if(meses_sin_intereses >= mensualidades_plazo && meses_sin_intereses != 0){
            meses_sin_intereses = mensualidades_plazo-1;
            $('#fill_meses_sin_intereses').set_value(meses_sin_intereses);
        }
        if(!mensualidades_plazo){
            mensualidades_plazo = 1;
        }
        var meses_a_financiar = mensualidades_plazo - meses_sin_intereses;
        if($('#fill_enganche').data('flag')){
            var per_plazo = $('#per_plazo').get_number();
            var enganche = $('#fill_enganche').get_number();
            var per_enganche = calculateX(
                meses_a_financiar,
                per_plazo/100, 
                final_price, 
                enganche,
                meses_sin_intereses,
                interes_mensual
            );
            var pago = enganche/per_enganche;
            var per_liquidacion = 100-per_plazo-per_enganche*100;
            $('#per_enganche').set_value(per_enganche*100);
            $('#fill_total-price-personalized').set_money(pago);
            $('#fill_plazo').set_money(per_plazo*pago/100);
            $('#per_liquidacion').set_percent(per_liquidacion);
            $('#fill_liquidacion').set_money(per_liquidacion*pago/100);
            $('#fill_mensuality_plazo').set_money($('#fill_plazo').get_number()/mensualidades_plazo);
        }
        else if($('#fill_plazo').data('flag')){
            var per_enganche = $('#per_enganche').get_number();
            var plazo = $('#fill_plazo').get_number();
            var per_plazo = calculateY(
                mensualidades_plazo,
                per_enganche/100, 
                final_price, 
                plazo
            );
            var monto_a_financiar = final_price * per_plazo / 100;
            var pago_manual = monto_a_financiar / ((1-Math.pow(1+interes_mensual,-mensualidades_plazo))/interes_mensual);
            var pago_total = pago_manual * mensualidades_plazo;
            var costo_financiero = pago_total - monto_a_financiar;
            var per_liquidacion = 100-per_plazo-per_enganche;

            var monto_nominal = per_liquidacion * final_price / 100;
            var tasa_efectiva_anualizada = Math.pow(1+interes_mensual, 12) - 1;
            var plazo_anualizado = mensualidades_plazo / 12;
            var pago_final = monto_nominal * Math.pow(1 + tasa_efectiva_anualizada, plazo_anualizado);
            var enganche = final_price * per_enganche / 100;
            var pago = enganche + pago_total + pago_final;
            $('#per_plazo').set_value(per_plazo*100);
            $('#fill_enganche').set_value(per_enganche*pago/100);
        }
        else{
            var per_enganche = $('#per_enganche').get_number();
            var per_plazo = $('#per_plazo').get_number();
            
            var monto_a_financiar = final_price * per_plazo / 100;
            
            if(interes_mensual==0 || meses_a_financiar==0){
                var pago_manual = monto_a_financiar;
            }
            else{
                var pago_manual = monto_a_financiar / (meses_sin_intereses+(1-Math.pow(1+interes_mensual,-meses_a_financiar))/interes_mensual);
            }
            var pago_total = pago_manual * mensualidades_plazo;
            var costo_financiero = pago_total - monto_a_financiar;
            var per_liquidacion = 100-per_plazo-per_enganche;

            var monto_nominal = per_liquidacion * final_price / 100;
            var pago_final = monto_nominal * Math.pow(1 + interes_mensual, mensualidades_plazo);
            var enganche = final_price * per_enganche / 100;
            var pago = enganche + pago_total + pago_final;
            $('#fill_enganche').set_value(per_enganche*pago/100);
            $('#fill_plazo').set_money(per_plazo*pago/100);

            $('#per_liquidacion').set_percent(per_liquidacion);
            $('#fill_liquidacion').set_money(per_liquidacion*pago/100);
            $('#fill_mensuality_plazo').set_money($('#fill_plazo').get_number()/mensualidades_plazo);
            $('#fill_total-price-personalized').set_money(pago);
        }
        var meses = $('#fill_months_plazo').get_number();
        var mensualidad = $('#fill_mensuality_plazo').get_number();
        var plazo = $('#fill_plazo').get_number();
        $('#pagos').empty();
        for(var i = 0; i < meses; i++){
            var fecha = mesYAnioDesdeHoy(i+1);
            
            var line = `<tr>
            <td>`+fecha+`</td>
            <td>$`+plazo.toLocaleString('en-US')+`</td>
            <td>$`+mensualidad.toLocaleString('en-US')+`</td>
            <td>$`+(meses==i+1?0:plazo-mensualidad).toLocaleString('en-US')+`</td>
            <tr>`;
            $('#pagos').append(line);
            plazo -= mensualidad;
        }
    });
    function mesYAnioDesdeHoy(n) {
      const MESES = ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                     'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
      const fecha = new Date();
      fecha.setDate(1);
      fecha.setMonth(fecha.getMonth() + n);
      return `${MESES[fecha.getMonth()]} de ${fecha.getFullYear()}`;
    }
    function calculateX(w,y, z, L,n,i) {
      const value_normalized = L/z;
      const F1 = Math.pow(i+1,w+n);
      const F2 = (n+w)/(n+(1-Math.pow(i+1,-w))/i);
      const a = 1-F1;
      const b =  F1+y*F2-y*F1;
      const root = Math.sqrt(b**2+4*a*value_normalized);
      return (-b+root)/(2*a)
    }
    function calculateY(w,x,z,L){
      const value_normalized = L/z;
      const B = Math.pow(1.013,w);
      const A = 0.013/(1-Math.pow(1.013,-w))*w;
      const a = -B+A;
      const b = x+B-x*B;
      const root = Math.sqrt(b**2+4*a*value_normalized);
      return (-b+root)/(2*a)
    }
    
</script>
@endpush
@push('hide_personal')
    $('#discount_1').hide();
@endpush