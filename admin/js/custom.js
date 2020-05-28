function adicionaFuncaoBtnRemover() {
    $('.btnForm.remover').submit(function (e) {
        var form = this;
        e.preventDefault();
        bootbox.confirm({
            message: "Você realmente deseja remover " + $(form).find('input[name="nome"]').val() + "?",
            locale: "br",
            callback: function (result) {
                if (result) {
                    form.submit();
                }
            }
        })
    });
}

$(document).ready(function () {
    adicionaFuncaoBtnRemover();
});
