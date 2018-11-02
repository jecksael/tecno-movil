
$(document).ready(function(){
        $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
        $('.phone').mask('0000-0000000',{reverse:false});
        $('.cedula').mask('#');
        $('.cedulaEdit').mask('V-00000000');
        $('.abc').mask('S');
        $('.price').mask('00,000,000,000.00',{reverse:true});
        $('.number').mask('#');

})
function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.-]/g, '')); // elimino cualquier cosa que no sea numero o punto

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
};
