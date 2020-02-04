$(document).ready(function(){

    $('#formCadastro, #formLogin').validate({
        messages: {
            inputNome: 'Informe o nome do usuário',
            inputLogin: 'Informe um login para o usuário',
            inputEmail: 'Informe o email do usuário',
            inputSenha: 'Crie uma senha',
        }
    });

    $('#btnCadastrar, #btnEntrar').on('click', function () {
        console.log("oi");
        $('#alertNomeInvalido').attr('hidden', true);
        $('#alertLoginInvalido').attr('hidden', true);
        $('#alertEmailInvalido').attr('hidden', true);
        $('#alertSenhaInvalida').attr('hidden', true);

        var nome = $('#inputNome').val();
        var login = $('#inputLogin').val();
        var email = $('#inputEmail').val();
        var senha = $('#inputSenha').val();
        var master_admin = $('#checkMaster').prop('checked');

        var checkNome = verificarNome(nome);
        var checkEmail = verificarEmail(email);
        var checkSenha = verificarSenha(senha);

        if (checkNome && checkEmail && checkSenha && login != '') {
            $.post('php/validar-cadastro.php', {
                data: [email, senha, nome, login, master_admin]
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
                        break;
                    case 'repeticao':
                        alert('Ops, parece que já possuímos um cadastro com esse endereço de email!');
                        break;
                    default:
                        alert('Ops, houve um problema! Por favor, contate o administrador.')
                }
            });
        } else {
            if (!checkNome) {
                $('#alertNomeInvalido').removeAttr('hidden');
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

    function verificarNome(nome) {
        if (nome != '' && nome.match(' ') != null) {
            return true;
        }
        return false;
    }

    function verificarEmail(email) {
        if (email != '' && email.match('@') != null && email.match('.com') != null && email.match(' ') == null) {
            return true;
        } else {
            return false;
        }
    }

    function verificarSenha(senha) {
        if (senha.length >= 8 && senha.match(/[1-9]/g) != null) {
            return true;
        } else {
            return false;
        }
    }
})