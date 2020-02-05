$(document).ready(function(){

    $.post('php/select-campos.php', function(retorno){
        var registros = jQuery.parseJSON(retorno);

        if (registros[0].nome == '1')
            $('#inputNome').prop('required', 'true');
        if (registros[0].email == '1')
            $('#inputEmail').prop('required', 'true');
        if (registros[0].telefone == '1')
            $('#inputTelefone').prop('required', 'true');
        if (registros[0].cep == '1')
            $('#inputCep').prop('required', 'true');
        if (registros[0].endereco == '1')
            $('#inputEndereco').prop('required', 'true');
        if (registros[0].numero == '1')
            $('#inputNumero').prop('required', 'true');
        if (registros[0].bairro == '1')
            $('#inputBairro').prop('required', 'true');
        if (registros[0].cidade == '1')
            $('#inputCidade').prop('required', 'true');
    })
    
    $("#inputNome").focusout(function (e) {
        if (!validaNome($(e.target).val()) && $("#inputNome").prop('required')) {
            $(e.target).addClass('form-invalido');
            tooltip($(e.target), 'Digite um nome.');
        } else {
            $(e.target).removeClass('form-invalido');
            $(e.target).tooltip('disable');
        }
    });
    
    function validaNome(nome) {
        var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

        if (nome.match(illegalChars) || nome == '') {
            return false;
        } else {
            return true;
        }
    }
    
    $("#inputEmail").focusout(function (e) {
        if (!validaEmail($(e.target).val())) {
            $(e.target).addClass('form-invalido');
            tooltip($(e.target), 'Digite um email válido.');
        } else {
            $(e.target).removeClass('form-invalido');
            $(e.target).tooltip('disable');
        }
    });
    
    function validaEmail(email) {
        var emailFilter = /^.+@.+\..{2,}$/;
        var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

        if (!(emailFilter.test(email)) || email.match(illegalChars)) {
            return false;
        } else {
            return true;
        }
    }
    
    $('#inputTelefone').mask("(00) 00000-0000")
        .focusin(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            element = $(target);
            element.unmask();
            element.mask("(00) 00000-0000");
        })
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if (phone.length > 10) {
                element.mask("(00) 00000-0000");
            } else {
                element.mask("(00) 0000-0000");
            }
            if (!validaTelefone(phone)) {
                $(target).addClass('form-invalido');
                tooltip($(target), 'Digite um telefone válido.');
            } else {
                $(target).removeClass('form-invalido');
                $(target).tooltip('disable');
            }
        });
    
    function validaTelefone(telefone) {
        var numeroTelefone = telefone.replace(/[^0-9]/g, '');
        if (numeroTelefone.length < 10) {
            return false;
        }
        return true;
    }
    
    $('#inputCep').mask('00000-000').focusout(function (e) {
        var campoCidade = $('#inputCidade');
        var campoBairro = $('#inputBairro');
        var campoEndereco = $('#inputEndereco');
        var campoNumero = $('#inputNumero');

        campoEndereco.val('...');
        campoBairro.val('...');
        campoCidade.val('...');

        pesquisaCep($(e.target).val(), function (dados) {
            if (dados.erro) {
                campoEndereco.val('');
                campoBairro.val('');
                campoCidade.val('');

                $(e.target).addClass('form-invalido');
                tooltip($(e.target), 'Digite um CEP válido.');
            } else {
                campoEndereco.val(dados.logradouro);
                campoBairro.val(dados.bairro);
                campoCidade.val(dados.localidade);

                $(e.target).removeClass('form-invalido');
                $(e.target).tooltip('disable');

                campoNumero.focus();
            }
        });
    });
    
    function pesquisaCep(cep, callback) {
        cep = cep.replace(/\D/g, '');

        if (cep.length != 8) {
            callback({
                erro: 'Quantidade de dígitos inválida'
            });
        } else {
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                if (!("erro" in dados)) {
                    callback(dados); // dados possui dados.logradouro, dados.bairro, dados.localidade, dados.uf e dados.ibge
                } else {
                    callback({
                        erro: 'CEP não encontrado'
                    });
                }
            });
        }
    }
    
    $("inputEndereco").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputEndereco]").prop('required')) {
            $(e.target).addClass('form-invalido');
            tooltip($(e.target), 'Digite um endereço.');
        } else {
            $(e.target).removeClass('form-invalido');
            $(e.target).tooltip('disable');
        }
    });
    
    function validaCampoVazio(valor) {
        if (valor == '') {
            return false;
        } else {
            return true;
        }
    }
    
    $("inputNumero").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputNumero").prop('required')) {
            $(e.target).addClass('form-invalido');
            tooltip($(e.target), 'Digite um número.');
        } else {
            $(e.target).removeClass('form-invalido');
            $(e.target).tooltip('disable');
        }
    });
    
    $("inputBairro").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputBairro").prop('required')) {
            $(e.target).addClass('form-invalido');
            tooltip($(e.target), 'Digite um bairro.');
        } else {
            $(e.target).removeClass('form-invalido');
            $(e.target).tooltip('disable');
        }
    });
    
    $("inputCidade").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputCidade").prop('required')) {
            $(e.target).addClass('form-invalido');
            tooltip($(e.target), 'Digite uma cidade.');
        } else {
            $(e.target).removeClass('form-invalido');
            $(e.target).tooltip('disable');
        }
    });   
})