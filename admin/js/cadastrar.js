$(document).ready(function () {
   $('#inputCpf').mask("000.000.000-00");

    $('#btnCadastrar').on('click', function () {
        esconderAlerts();

        var nome = $('#inputNome').val();
        var cpf = $('#inputCpf').val();
        var email = $('#inputEmail').val();
        var senha = $('#inputSenha').val();
        var login = $('#inputLogin').val()
        var permissoes_admin = $('#checkMaster').prop('checked');

        var checkNome = validarNome(nome);
        var checkCpf = validarCpf(cpf);
        var checkEmail = validarEmail(email);
        var checkSenha = validarSenha(senha);

        if (checkNome && checkCpf && checkEmail && checkSenha && login != '') {
            cadastrarColaborador([email, senha, nome, login, permissoes_admin, cpf]);
        } else {
            if (!checkNome) {
                $('#alertNomeInvalido').removeAttr('hidden');
            }
            if (!checkCpf) {
                $('#alertCpfInvalido').removeAttr('hidden');
            }
            if (!checkEmail) {
                $('#alertEmailInvalido').removeAttr('hidden');
            }
            if (!checkSenha) {
                $('#alertSenhaInvalida').removeAttr('hidden');
            }
            if (login == '') {
                $('#alertLoginInvalido').removeAttr('hidden');
            }
        }
    });

    function esconderAlerts(){
        $('#alertNomeInvalido').attr('hidden', true);
        $('#alertCpfInvalido').attr('hidden', true);
        $('#alertLoginInvalido').attr('hidden', true);
        $('#alertEmailInvalido').attr('hidden', true);
        $('#alertSenhaInvalida').attr('hidden', true);
    }

    function validarNome(nome) {
        if (nome != '' && nome.match(' ') != null) {
            return true;
        }
        return false;
    }

    function validarCpf(cpf) {
        var numeroCpf = cpf.replace(/[^0-9]/g, '');

        if (numeroCpf.length != 11) {
            return false;
        }

        // Calculando o primeiro dígito verificador
        var x1 = 10 * numeroCpf.substr(0, 1);
        var x2 = 9 * numeroCpf.substr(1, 1);
        var x3 = 8 * numeroCpf.substr(2, 1);
        var x4 = 7 * numeroCpf.substr(3, 1);
        var x5 = 6 * numeroCpf.substr(4, 1);
        var x6 = 5 * numeroCpf.substr(5, 1);
        var x7 = 4 * numeroCpf.substr(6, 1);
        var x8 = 3 * numeroCpf.substr(7, 1);
        var x9 = 2 * numeroCpf.substr(8, 1);

        var soma = x1 + x2 + x3 + x4 + x5 + x6 + x7 + x8 + x9;
        var resto = soma % 11;

        var primeiroDigitoVerificador;
        if (resto < 2) {
            primeiroDigitoVerificador = 0;
        } else {
            primeiroDigitoVerificador = 11 - resto;
        }

        // Calculando o segundo dígito verificador
        x1 = 11 * numeroCpf.substr(0, 1);
        x2 = 10 * numeroCpf.substr(1, 1);
        x3 = 9 * numeroCpf.substr(2, 1);
        x4 = 8 * numeroCpf.substr(3, 1);
        x5 = 7 * numeroCpf.substr(4, 1);
        x6 = 6 * numeroCpf.substr(5, 1);
        x7 = 5 * numeroCpf.substr(6, 1);
        x8 = 4 * numeroCpf.substr(7, 1);
        x9 = 3 * numeroCpf.substr(8, 1);
        var x10 = 2 * primeiroDigitoVerificador;

        soma = x1 + x2 + x3 + x4 + x5 + x6 + x7 + x8 + x9 + x10;
        resto = soma % 11;

        var segundoDigitoVerificador;
        if (resto < 2) {
            segundoDigitoVerificador = 0;
        } else {
            segundoDigitoVerificador = 11 - resto;
        }

        if (numeroCpf.substr(9, 2) == primeiroDigitoVerificador.toString() + segundoDigitoVerificador.toString()) {
            return true;
        } else {
            return false;
        }
    }

    function validarEmail(email) {
        if (email != '' && email.match('@') != null && email.match('.com') != null && email.match(' ') == null) {
            return true;
        } else {
            return false;
        }
    }

    function validarSenha(senha) {
        if (senha.length >= 8 && senha.match(/[1-9]/g) != null) {
            return true;
        } else {
            return false;
        }
    }

    function cadastrarColaborador(dados){
        $.post('php/cadastrar-colaborador.php', {
            data: dados
        }, function (retorno) {
            switch (retorno) {
                case 'erro1':
                    alert('Ops, houve um problema! Por favor, contate o administrador. (1)');
                    break;
                case 'erro2':
                    alert('Ops, houve um problema! Por favor, contate o administrador. (2)');
                    break;
                case 'sucesso':
                    alert('Administrador cadastrado com sucesso!');
                    window.location.replace("cadastrar.php");
                    break;
                case 'repeticao':
                    alert('Ops, parece que já possuímos um cadastro com esse endereço de email!');
                    break;
                default:
                    alert('Ops, houve um problema! Por favor, contate o administrador.');
                    break;
            }
        });
    }
})