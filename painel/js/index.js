$(document).ready(function () {
    var table;

    carregarDataTable();

    function construirDataTable(dataSet) {
        table = $('#example').DataTable({
            data: dataSet,
            columns: [
                { title: "ID" },
                { title: "Nome" },
                { title: "Email" },
                { title: "Telefone." },
                { title: "CEP" },
                { title: "Endereço" },
                { title: "Número" },
                { title: "Bairro" },
                { title: "Cidade" },
                { title: "Data" },
                { title: "Viável" }
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

    function carregarDataTable(){
        var date = $('#data').val();
        //console.log(date);
        $.post('php/procurar-pesquisas.php', {
            data: date
        }, function (retorno) {
            var dataSet = jQuery.parseJSON(retorno);
            construirDataTable(dataSet);
        });
    }

    $("#btnSearch").click(function (e) {
        var data = $('#data').val();

        table.destroy();

        carregarDataTable();
    });

    $("#export").click(function (e) {
        var data = $('#data').val();

        $.post("php/exportar-pesquisas.php", {
            data: data
        }, function (retorno) {

        })
    })
    
    $("#data").on("change", function (e) {
        $("#data2").val($("#data").val());
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
});