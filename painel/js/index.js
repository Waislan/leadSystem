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
    })
    
    $("#btnSearch").click(function (e) {
        procurar();
    });
    
    $("#export").click(function (e) {
        var data = $('#data').val();

        $.post("php/exportar-pesquisas.php", {
           data: data
        }, function (retorno) {
            
        })
    })
    
    function procurar(){
        var data = $('#data').val();

        $.post("php/procurar-pesquisas.php", {
            data: data
        }, function (retorno) {
            var registros = jQuery.parseJSON(retorno);
            var tbody;
            
            $('#example tbody').remove();

            for (var i = 0; i < registros.length; i++) {
                var id = registros[i].id_pesquisa;
                var cep = registros[i].cep;
                var bairro = registros[i].bairro;
                var cidade = registros[i].cidade;
                var date = registros[i].date;
                var viabilidade = registros[i].viabilidade;
                viabilidade = viabilidade == '1' ? 'Sim' : 'Não';
                
                tbody = "<tbody>" +
                    "<tr>" +
                    "<td>" + id + "</td>" +
                    "<td>" + cep + "</td>" +
                    "<td>" + bairro + "</td>" +
                    "<td>" + cidade + "</td>" +
                    "<td>" + data + "</td>" +
                    "<td style=\"text-align: center !important;\">" + viabilidade + "</td>" +
                    "</tr>" +
                    "</tbody>";
                $('#example').append(tbody);
            }
        });
    }
    
    $("#data").on("change", function(e){
        $("#data2").val($("#data").val());
    });
    
    $("#frmCSVImport").on("submit", function(e) {
        $("#response").attr("class", "");
        console.log($("#response").attr("class"));
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
            $("#response").addClass("error");
            $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});