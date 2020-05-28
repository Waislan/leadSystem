$(document).ready(function () {

    $('#btnProcurarUsuario').click(function () {

        var nomeBuscado = $('#campoBuscaUsuario').val();

        if (nomeBuscado != '') {
            $.post("ajax/procurar-usuario.php", {
                nome: nomeBuscado
            }, function (retorno) {

                var usuarios = jQuery.parseJSON(retorno);

                if (usuarios.length != 0) {
                    $('#bodyTabelaUsuarios').empty();

                    for (var i = 0; i < usuarios.length; i++) {
                        var nome = usuarios[i].nome;
                        var login = usuarios[i].login;

                        $('#bodyTabelaUsuarios').append(
                            '<tr>' +
                            '<td>' + nome + '</td>' +
                            '<td>' + login + '</td>' +
                            '<td style="text-align: center !important;"><i class="fas fa-edit"></i> <i class="fas fa-trash"></i></td>' +
                            '</tr>');
                    }
                    
                    adicionaFuncaoBtnRemoverUsuario();
                }
            });
        }
    });
});
