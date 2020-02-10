$(document).ready(function(){
    $('#atualizar').on('click', function(){
        $.post('php/atualizar-campos.php', {
            data: [$('#selectNome').val(), $('#selectEmail').val(), $('#selectTelefone').val(), $('#selectCep').val(), $('#selectEndereco').val(),
            $('#selectNumero').val(), $('#selectBairro').val(), $('#selectCidade').val()]
        }, function(retorno){
            console.log(retorno);
            switch(retorno){
                case 'success':
                    alert('Atualização feita com sucesso!');
                    break;
                case 'error':
                    alert('Ops, parece que houve um erro! Por favor, contate o administrador');
                    break;
                default:
                    alert('Ops, parece que houve um erro inesperado! Por favor, contate o administrador');
                    break;
            }
        });
    });
});