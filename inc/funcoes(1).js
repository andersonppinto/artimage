function formatDate(value) {
    var caracteres = '0123456789';
    var sData = '';
    var data = '';
    if (value != 'undefined' && value != '') {
        for (i = 0; (i <= value.length - 1 && sData.length < 8); i++) {
            if (caracteres.search(value[i]) != -1) sData += value[i];
        }
        while (sData.length < 8) sData = '0' + sData;
        for (i = 0; i <= sData.length - 1; i++) {
            data += sData[i];
            if (data.length == 2 || data.length == 5) data += '/';
        }
    }
    return data;
}

function formatValorMonetario(value) {
    var caracteres = '0123456789,';
    var valor = '';

    if (value != 'undefined' && value != '') {
        sValor = value.replace(/\./g, '');
        if (sValor != '') {
            idx = sValor.search(',');
            if (sValor.substring(idx,sValor.length -1).search(',') != -1)
                sValor = sValor.substring(0, idx + 1) + sValor.substring(idx + 1, sValor.length).replace(/\,/g, '');

            for (i = 0; i <= sValor.length - 1; i++)
                if (caracteres.search(sValor[i]) != -1) valor += sValor[i];

            if (valor != '') {
                
                if (idx == -1)
                    valor += ',00';
                else {
                    
                    if (idx == 0) {
                        valor = '0' + valor;
                        idx += 1;
                    }
                    
                    if (idx + 1 == valor.length) {
                        valor += '00';
                    }
                    else if (idx + 2 == valor.length) {
                        valor += '0';
                    }
                    else if (idx + 4 <= valor.length) {
                        valor = valor.substring(0, idx + 3);
                    }

                }

            }

        }
        
    }
    return valor;
}