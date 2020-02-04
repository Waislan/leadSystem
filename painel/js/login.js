$(document).ready(function () {
    $('#btnEntrar').on('click', function () {
        $('#alertLoginInvalido').attr('hidden', true);

        var email = $('#inputEmail').val();
        var senha = $('#inputSenha').val();

        $.post('php/validar-login.php', {
            data: [email, senha]
        }, function (retorno) {
            switch(retorno){
                case 'invalid':
                    $('#alertLoginInvalido').attr('hidden', false);
                    break;
                case 'erro':
                    alert('Ops, parece que houve um erro! Por favor, contate o administrador. (1)');
                    break;
                case 'true':
                    console.log(retorno);
                    window.location.replace("index.php");
                    break;
                default:
                    console.log(retorno);
                    alert('Ops, parece que houve um erro! Por favor, contate o administrador. (2)');
                    break;
            }
        });
    });
});