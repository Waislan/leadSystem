$(document).ready(function () {
    $('#alertCamposVazios').attr('hidden', true);
    $('#alertNomeInvalido').attr('hidden', true);
    $('#alertEmailInvalido').attr('hidden', true);
    $('#alertTelefoneInvalido').attr('hidden', true);
    $('#alertCepInvalido').attr('hidden', true);
    $('#alertEnderecoInvalido').attr('hidden', true);
    $('#alertNumeroInvalido').attr('hidden', true);
    $('#alertBairroInvalido').attr('hidden', true);
    $('#alertCidadeInvalido').attr('hidden', true);


    $.post('php/select-campos.php', function (retorno) {
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

    $('#inputNome').focusout(function (e) {
        if (!validaNome($(e.target).val()) && $('#inputNome').prop('required')) {
            $(e.target).addClass('form-invalido');
            //tooltip($(e.target), 'Digite um nome.');
        } else {
            $(e.target).removeClass('form-invalido');
            //$(e.target).tooltip('disable');
        }
    });

    function validaNome(nome) {
        var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

        if ((nome == '' && $('#inputNome').prop('required')) || nome.match(illegalChars)) {
            return false;
        } else {
            return true;
        }
    }

    $('#inputEmail').focusout(function (e) {
        if (!validaEmail($(e.target).val()) && $('#inputEmail').prop('required')) {
            $(e.target).addClass('form-invalido');
            //tooltip($(e.target), 'Digite um email válido.');
        } else {
            $(e.target).removeClass('form-invalido');
            //$(e.target).tooltip('disable');
        }
    });

    function validaEmail(email) {
        var emailFilter = /^.+@.+\..{2,}$/;
        var illegalChars = /[\(\)\<\>\,\;\:\\\/\"\[\]]/;

        if ((!emailFilter.test(email) && $('#inputEmail').prop('required')) || email.match(illegalChars)) {
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
            if (!validaTelefone(phone) && $('#inputTelefone').prop('required')) {
                $(target).addClass('form-invalido');
                //($(target), 'Digite um telefone válido.');
            } else {
                $(target).removeClass('form-invalido');
                //$(target).tooltip('disable');
            }
        });

    function validaTelefone(telefone) {
        var numeroTelefone = telefone.replace(/[^0-9]/g, '');

        if ($('#inputTelefone').prop('required')){
            if (numeroTelefone.length < 10) {
                return false;
            }
            return true;
        } else {
            if (numeroTelefone.length < 10 && numeroTelefone != '') {
                return false;
            }
            return true;
        }
        
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
            if ((dados.erro || $('#inputCep').val() == '') && $('#inputCep').prop('required')) {
                campoEndereco.val('');
                campoBairro.val('');
                campoCidade.val('');

                $(e.target).addClass('form-invalido');
                //tooltip($(e.target), 'Digite um CEP válido.');
            } else {
                campoEndereco.val(dados.logradouro);
                campoBairro.val(dados.bairro);
                campoCidade.val(dados.localidade);

                $(e.target).removeClass('form-invalido');
                //$(e.target).tooltip('disable');

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

    $("#inputEndereco").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputEndereco").prop('required')) {
            $(e.target).addClass('form-invalido');
            //tooltip($(e.target), 'Digite um endereço.');
        } else {
            $(e.target).removeClass('form-invalido');
            //$(e.target).tooltip('disable');
        }
    });

    function validaCampoVazio(valor) {
        if (valor == '') {
            return false;
        } else {
            return true;
        }
    }

    $("#inputNumero").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputNumero").prop('required')) {
            $(e.target).addClass('form-invalido');
            //tooltip($(e.target), 'Digite um número.');
        } else {
            $(e.target).removeClass('form-invalido');
            //$(e.target).tooltip('disable');
        }
    });

    $("#inputBairro").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputBairro").prop('required')) {
            $(e.target).addClass('form-invalido');
            //tooltip($(e.target), 'Digite um bairro.');
        } else {
            $(e.target).removeClass('form-invalido');
            //$(e.target).tooltip('disable');
        }
    });

    $("#inputCidade").focusout(function (e) {
        if (!validaCampoVazio($(e.target).val()) && $("inputCidade").prop('required')) {
            $(e.target).addClass('form-invalido');
            //tooltip($(e.target), 'Digite uma cidade.');
        } else {
            $(e.target).removeClass('form-invalido');
            //$(e.target).tooltip('disable');
        }
    });

    $('form').on('submit', function (event) {
        $('#alertCamposVazios').attr('hidden', true);
        $('#alertNomeInvalido').attr('hidden', true);
        $('#alertEmailInvalido').attr('hidden', true);
        $('#alertTelefoneInvalido').attr('hidden', true);
        $('#alertCepInvalido').attr('hidden', true);
        $('#alertEnderecoInvalido').attr('hidden', true);
        $('#alertNumeroInvalido').attr('hidden', true);
        $('#alertBairroInvalido').attr('hidden', true);
        $('#alertCidadeInvalido').attr('hidden', true);

        event.preventDefault();

        var nome = $('#inputNome').val();
        var email = $('#inputEmail').val();
        var telefone = $('#inputTelefone').val();
        var cep = $('#inputCep').val().replace('-', '');
        var endereco = $('#inputEndereco').val();
        var numero = $('#inputNumero').val();
        var bairro = $('#inputBairro').val();
        var cidade = $('#inputCidade').val();

        if (!validaNome(nome)) {
            $('#inputNome').addClass('form-invalido');
            $('#alertNomeInvalido').attr('hidden', false);
        } else if (!validaEmail(email)) {
            $('#inputEmail').addClass('form-invalido');
            $('#alertEmailInvalido').attr('hidden', false);
        } else if (!validaTelefone(telefone)) {
            $('#inputTelefone').addClass('form-invalido');
            $('#alertTelefoneInvalido').attr('hidden', false);
        } else if (endereco == '' && $('#inputCep').prop('required')) {
            $('#inputEndereco').addClass('form-invalido');
            $('#alertEnderecoInvalido').attr('hidden', false);
        } else if (numero == '' && $('#inputNumero').prop('required')) {
            $('#inputNumero').addClass('form-invalido');
            $('#alertNumeroInvalido').attr('hidden', false);
        } else if (bairro == '' && $('#inputBairro').prop('required')) {
            $('#inputBairro').addClass('form-invalido');
            $('#alertBairroInvalido').attr('hidden', false);
        } else if (cidade == '' && $('#inputCidade').prop('required')) {
            $('#inputCidade').addClass('form-invalido');
            $('#alertCidadeInvalido').attr('hidden', false);
        } else if (nome == '' && email == '' && telefone == '' && cep == '' && endereco == '' && numero == '' && bairro == '' && cidade == '') {
            $('#alertCamposVazios').attr('hidden', false);
        }
        else {
            pesquisaCep(cep, function (dados) {
                if (dados.erro && ($('#inputCep').val() != '' || $('#inputCep').prop('required'))) {
                    $('#inputCep').addClass('form-invalido');
                    $('#alertCepInvalido').prop('hidden', false);
                    //tooltip('#inputCep', 'Digite um CEP válido.');
                } else {
                    $('#inputCep').removeClass('form-invalido');
                    //$('#inputCep').tooltip('disable');

                    $.post('php/validar-index.php', {
                        data: [nome, email, telefone, cep, endereco, numero, bairro, cidade]
                    }, function(retorno){
                        console.log(retorno);
                        switch(retorno){
                            case 'erro1':
                                alert('Ops, parece que houve um erro! Por favor, contate o administrador. (1)')
                                break;
                            case 'erro2':
                                alert('Ops, parece que houve um erro! Por favor, contate o administrador. (2)')
                                break;
                            case 'erro3':
                                alert('Ops, parece que houve um erro! Por favor, contate o administrador. (3)')
                                break;
                            case 'inviavel':
                                alert('CEP indisponível no momento. Deseja fazer outra pesquisa?')
                                break;
                            case 'success':
                                $.post('php/get-redirecionamento', function(retorno){
                                    console.log(retorno);
                                    if (retorno == 'erro'){
                                        alert('Ops, parece que houve um erro! Por favor, contate o administrador.');
                                    } else {
                                        window.location.replace('http://' + retorno);
                                    }
                                })
                                break;
                            default:
                                alert('Ops, parece que houve um erro! Por favor, contate o administrador. (4)')
                                break;
                        }
                    });
                }
            });
        }

    })

})