$(document).ready(function () {
    var table;

    carregarDataTable();

    function construirDataTable(dataSet) {
        table = $('#dataTable').DataTable({
            data: dataSet,
            columns: [
                { title: "ID" },
                { title: "CEP" }
            ],
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
                    "previous": "Anterior"
                },
            },
            "searching": false
        });
    }

    function carregarDataTable() {
        $.post('php/select-cep.php', function (retorno) {
            var dataSet = jQuery.parseJSON(retorno);
            construirDataTable(dataSet);
        });
    }

    $('input[id^=inputCep]').mask('00000-000');

    $("#btnImportarCep").on("click", function () {
        var cep = $("#inputCep").val().replace(/[^0-9]/g, '');
        $.post("php/inserir-cep.php", {
            data: cep
        }, function (r) {
            if (r == 'cepExistente') {
                //console.log("cep existente");
                alert("Ops! Parece que você tentou inserir um CEP existente.\nUtilize a barra de busca para conferir se o CEP já está no banco.");
            } else if (r == 'cepIncorreto') {
                //console.log("cep incorreto");
                alert("Ops! Parece que parece que você digitou um CEP incorreto.\nTente novamente.");
            } else if (r == 'false') {
                //console.log("erro");
                alert("Ops! Parece que ocorreu um erro inseperado.\nSe persistir, contate o administrador.");
            } else {
                //console.log(r);
                alert("CEP inserido com sucesso!");
                table.destroy();
                carregarDataTable();
            }
        })
    })

    $("#btnPesquisarCep").on("click", function () {
        var cep = $("#inputCep").val().replace(/[^0-9]/g, '');

        if (cep === '') {
            table.destroy();
            carregarDataTable();
        } else {
            $.post("php/pesquisar-cep.php", {
                data: cep
            }, function (retorno) {
                if (retorno == 'false') {
                    //console.log("cep inexistente");
                    alert("Ops! CEP inexistente");
                } else if (retorno == 'cepIncorreto') {
                    //console.log("cep incorreto");
                    alert("Ops! Parece que parece que você digitou um CEP incorreto.\nTente novamente.");
                } else {
                    //console.log(r);
                    var dataSet = jQuery.parseJSON(retorno);
                    table.destroy();
                    construirDataTable(dataSet);                    
                }
            });
        }
    });

    $("#frmCSVImport").on("submit", function (e) {
        $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");

        if (!regex.test($("#file").val().toLowerCase())) {
            $("#response").addClass("error");
            $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        table.destroy();
        carregarDataTable();

        return true;
    });
})
