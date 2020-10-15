// Initialize tooltip component
/* $(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
// Initialize popover component
$(function () {
    $('[data-toggle="popover"]').popover()
}) */
$(document).ready(function () {
    /* $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    }); */
    //Checkbox active & value add
    $('.checkbox-switch').click(function(event) {
        if (this.checked) {
            $(this).val(1);
        } else {
            $(this).val(0);
        }
    });
    //Transacction active contact 
    $('#DocumentoAsociado_Tran').change(function(event) {
        validar_asociacion();
    });
    
});
// table cell change functions
$(document).on('change', '.cell-formar-sum', function(event) {
    modSubtotales();
});
// table cell delete row tr
$(document).on('click', '.delete', function (event) {
    event.preventDefault();
    $(this).closest('tr').remove();
    modSubtotales();
});
// new row push tab
$(document).on('keydown', '.subtotal', function(event) {
    var evt = event;
    var key = window.Event ? evt.which : evt.keyCode;
    var obj=document.getElementById('add');
    if(key){
        var i = 0;
        var split_id = 0;
        var lastname_id = $('.tr').last().attr('id');
        if (lastname_id) {
            split_id = lastname_id.split('_');
            i = Number(split_id[1]) + 1;
        }
        obj.click();
        // document.getElementById("item_value_" + i).focus();
    }
    modSubtotales();
});
function mensaje(argument) {
    bootbox.alert({
        title: "Mensaje de Financia",
        message: "<h6><strong><i class=\"far fa-smile fa-md\"></i> "+argument+"</strong></h6>",
        className: 'rubberBand animated'
    });
}

function cargar() {
    var dialog = bootbox.dialog({
        message: '<div class="loader"></div>',
        className: 'background-clear',
        closeButton: false
    });
                
    // do something in the background
    // dialog.modal('hide');
}

function contact_datatable(type, contact) {
    /* datatable */
    var tableDocs = $('#mytable').DataTable({
        processing: true,
        serverSide: true,
        bDestroy: true,
        ajax: {
            url: base_url+'table/get_documents/'+type+'/'+contact,
            method: 'post'
        },
        "language": {
            "url": base_url+"/assets/js/spanish.json"
        },
        columns: [
            {
                "data": "Id_Doc",
                "orderable": false,
                "title": "#"
            },
            {
                "data" : "opciones",
                "orderable": false,
                "className" : "text-center"
            },
            {"data": "Id_Per"}, {"data": "Numero_Doc"},{"data": "Id_DocEst"},{"data": "total_doc","className" : "text-right"},{"data": "Id_TerPag"},{"data": "FechaDocumento_Doc"},{"data": "FechaRegistro_Doc"},{"data": "FechaVencimiento_Doc"}
        ]
    });
}
// Funciones extras.
function format_moneda(amount, decimals)
{
    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
    decimals = decimals || 0; // por si la variable no fue fue pasada
    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0) 
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);
    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

    return amount_parts.join('.');
}

function FechaAdicion(fecha, intervalo, dma, separador) {
    // adicionar_restar_fecha("2017-01-01", "+-5", "d m a");
    var separador = separador || "-";
    var arrayFecha = fecha.split(separador);
    var dia = arrayFecha[2];
    var mes = arrayFecha[1];
    var anio = arrayFecha[0];  
     
    var fechaInicial = new Date(anio, mes - 1, dia);
    var fechaFinal = fechaInicial;
    if(dma=="m" || dma=="M"){
        fechaFinal.setMonth(fechaInicial.getMonth()+parseInt(intervalo));
    }else if(dma=="y" || dma=="Y"){
        fechaFinal.setFullYear(fechaInicial.getFullYear()+parseInt(intervalo));
    }else if(dma=="d" || dma=="D"){
        fechaFinal.setDate(fechaInicial.getDate()+parseInt(intervalo));
    }else{
        return fecha;
    }
    dia = fechaFinal.getDate();
    mes = fechaFinal.getMonth() + 1;
    anio = fechaFinal.getFullYear();

    dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
    mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;

    // return dia + "-" + mes + "-" + anio;
    return anio+"-"+mes+"-"+dia;
}

function validar_asociacion(vaciar = true) {
    var check = document.getElementById('DocumentoAsociado_Tran'); 
    var contact = document.getElementById('Id_Per');
    var type = document.getElementById('type').value;
    var html = '';
    console.log(contact.text);
    if (check.checked) {
        if (contact.value !='') {
            if (vaciar == true) {
                html = '<th class="text-center color-danger"><i class="fas fa-times-circle"></i></th>'+
                    '<th class="doc">Documento</th>'+
                    '<th>Cantidad</th>'+
                    '<th>Valor</th>'+
                    '<th>Observación</th>'+                        
                    '<th>Subtotal</th>';
                $('#itemsHead').empty()
                $('#itemsbody').empty();
                $('#itemsHead').append(html);
            }
            contact_datatable(type, contact.value);
            $('#documentsModal').modal('show');
        } else {
            bootbox.alert({
                title: "Mensaje de Financia",
                message: "<h6><strong><i class=\"far fa-smile fa-md\"></i> Debe seleccionar un contacto</strong></h6>"
            });
            document.getElementById(check.id).checked = false;
            $(check).val(0);
        }
    } else {
        if (vaciar == true) {
            html = '<th class="text-center color-danger"><i class="fas fa-times-circle"></i></th>'+
                '<th>Cuenta</th>'+
                '<th>Impuestos</th>'+
                '<th>Cantidad</th>'+
                '<th>Valor</th>'+
                '<th>Observación</th>'+                        
                '<th>Subtotal</th>';
            $('#itemsHead').empty()
            $('#itemsbody').empty();
            $('#itemsHead').append(html);
        }
        $('#add').click();
    }
}