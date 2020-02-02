$(document).ready(function () {
    $('#dataTable').DataTable({
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
        "searching": false,
    })

    $('input[id^=inputCep]').mask('00000-000');

    //tableCep();

    $('#inserirCep').click(function () {
        var cep = $('#inputCep').val().replace("-", "");

        $.post("php/inserir-cep.php", {
            data: cep
        }, function (retorno) {
            tableCep();
        });
    });

    function tableCep() {
        $.post("php/select-cep.php", function (retorno) {
            if (retorno == 'erro') {
                alert('Erro ao carregar dados.');
                //console.log("erro");
            } else {
                var registros = jQuery.parseJSON(retorno);
                var tbody;

                $('#dataTable tbody').remove();

                for (var i = 0; i < registros.length; i++) {
                    var id = registros[i].id_cep;
                    var cep = registros[i].cep.substring(0, 5) + "-" + registros[i].cep.substring(5, 8);

                    tbody = "<tbody>" +
                        "<tr>" +
                        "<td>" + id + "</td>" +
                        "<td>" + cep + "</td>" +
                        "</tr>" +
                        "</tbody>";
                    $('#dataTable').append(tbody);
                }
            }
        })
    }

    $("#btnImportarCep").on("click", function(){
        var cep = $("#inputCep").val().replace(/[^0-9]/g, '');
        $.post("php/inserir-cep.php", {
            data: cep
        }, function(r){
            if(r == 'cepExistente'){
                //console.log("cep existente");
                alert("Ops! Parece que você tentou inserir um CEP existente.\nUtilize a barra de busca para conferir se o CEP já está no banco.");
            } else if (r == 'cepIncorreto') {
                //console.log("cep incorreto");
                alert("Ops! Parece que parece que você digitou um CEP incorreto.\nTente novamente.");
            } else if (r == 'false') {
                //console.log("erro");
                alert("Ops! Parece que ocorreu um erro inseperado.\nSe persistir, contate o administrador.");
            } else  {
                //console.log(r);
                alert("CEP inserido com sucesso!");
            }
        })
    })

    $("#btnPesquisarCep").on("click", function(){
        var cep = $("#inputCep").val().replace(/[^0-9]/g, '');
        $.post("php/pesquisar-cep", {
            data: cep
        }, function(retorno){
            if(retorno == 'false'){
                //console.log("cep inexistente");
                alert("Ops! CEP inexistente");
            } else if (retorno == 'cepIncorreto') {
                //console.log("cep incorreto");
                alert("Ops! Parece que parece que você digitou um CEP incorreto.\nTente novamente.");
            } else  {
                //console.log(r);
                var registros = jQuery.parseJSON(retorno);
                var tbody;
                
                $('#dataTable tbody').remove();

                for (var i = 0; i < registros.length; i++) {
                    var id = registros[i].id_cep;
                    var cep = registros[i].cep.substring(0, 5) + "-" + registros[i].cep.substring(5, 9);
                    
                    tbody = "<tbody>" +
                        "<tr>" +
                        "<td>" + id + "</td>" +
                        "<td>" + cep + "</td>" +
                        "</tr>" +
                        "</tbody>";
                    $('#dataTable').append(tbody);
                }
            }
        })
    })

    $("#frmCSVImport").on("submit", function () {
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
        return true;
    })
})
