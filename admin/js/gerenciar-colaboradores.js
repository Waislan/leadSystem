$(document).ready(function() {
    $('#example').DataTable({
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nada a mostrar",
            "info": "Exibindo _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Sem registros disponíveis",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "paginate": {
                "first": "Primeira",
                "last": "Última",
                "next": "Próxima",
                "previous": "Anterior"},
        },
        "searching": false
    });

    $.post('php/verificar-master.php', function(retorno){
        switch(retorno){
            case 'true':
                $('#btnCadastrar').attr('disabled', false);
                break;
            case 'false':
                $('#btnCadastrar').attr('disabled', true);
                break;
            default:
                console.log(retorno);
                break;
        }
    });

    $('#btnCadastrar').on('click', function(){
        if ($('#btnCadastrar').attr('disabled')){
            alert('Para acessar esta funcionalidade é necessário ter permisões de usuário master.');
        } else {
            window.location.replace('novo-colaborador.php');
        }
    });
});