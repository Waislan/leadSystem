$(document).ready(function () {

    $('#btnProcurarEmpresa').click(function () {
        console.log("entrou");

        var nomeBuscado = $('#campoBuscaEmpresa').val();

        if (nomeBuscado != '') {
            console.log("nome buscado: " + nomeBuscado);
            $.post("ajax/procurar-empresa.php", {
                nome: nomeBuscado
            }, function (retorno) {

                var empresas = jQuery.parseJSON(retorno);

                if (empresas.length != 0) {
                    $('#bodyTabelaClientes').empty();

                    for (var i = 0; i < empresas.length; i++) {
                        var apelido = empresas[i].apelido;
                        var nomeEmpresa = empresas[i].nome;
                        var cnpjEmpresa = empresas[i].cnpj;
                        var qtdFuncionarios = empresas[i].qtdFuncionarios;
                        var proxCod = empresas[i].proxCod;

                        $('#bodyTabelaClientes').append(
                            '<tr>' +
                            '<td>' + apelido + '</td>' +
                            '<td>' + nomeEmpresa + '</td>' +
                            '<td>' + cnpjEmpresa + '</td>' +
                            '<td>' + qtdFuncionarios + '</td>' +
                            '<td style="text-align: center !important;">' +
                            '<form method="POST" action="novo-cliente.php" class="btnForm">' +
                            '<input type="hidden" name="apelido" value="' + apelido + '"/>' +
                            '<input type="hidden" name="nome" value="' + nomeEmpresa + '"/>' +
                            '<input type="hidden" name="cnpj" value="' + cnpjEmpresa + '"/>' +
                            '<input type="hidden" name="proxCod" value="' + proxCod + '"/>' +
                            '<button type="submit"><i class="fas fa-edit"></i></button>' +
                            '</form>' +
                            '<form method="POST" action="actions/remove-cliente.php" class="btnForm remover">' +
                            '<input type="hidden" name="nome" value="' + nomeEmpresa + '"/>' +
                            '<input type="hidden" name="cnpj" value="' + cnpjEmpresa + '"/>' +
                            '<button type="submit"><i class="fas fa-trash"></i></button>' +
                            '</form>' +
                            '</tr>');
                    }
                    
                    adicionaFuncaoBtnRemover();
                }
            });
        }
    });
});
