$(document).ready(function () {
    $('#btnEntrar').on('click', function () {
        $('#alertLoginInvalido').attr('hidden', true);

        var username = $('#inputUsername').val();
        var senha = $('#inputSenha').val();

        $.post('php/validar-login.php', {
            data: [username, senha]
        }, function (retorno) {
            //console.log(retorno);
            switch(retorno){
                case 'invalid':
                    $('#alertLoginInvalido').attr('hidden', false);
                    break;
                case 'erro':
                    alert('Ops, parece que houve um erro! Por favor, contate o administrador. (1)');
                    break;
                case 'true':
                    window.location.replace("index.php");
                    break;
                default:
                    alert('Ops, parece que houve um erro! Por favor, contate o administrador. (2)');
                    break;
            }
        });
    });
});