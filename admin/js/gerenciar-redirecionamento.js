$(document).ready(function () {
    
    $('#btnAtualizar').click(function () {
        $.post("php/atualizar-redirecionamento.php", {
            url: $('#inputRedirecionamento').val()
        }, function (retorno) {
            if (retorno == 'true'){
                alert('Atualização feita com sucesso!');
            } else if (retorno == 'false') {
                alert('Falha na atualização!');
            }
        });
    });
});
