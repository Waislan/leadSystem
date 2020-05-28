$(document).ready(function(){
    function removerTodasClasses(){
        $('#sidebar_index').removeClass('active');
        $('#sidebar_colaboradores').removeClass('active');
        $('#sidebar_campos').removeClass('active');
        $('#sidebar_redirecionamento').removeClass('active');
        $('#sidebar_ceps').removeClass('active');
    }

    removerTodasClasses();

    function setarClasseNoItem(){
        var url = window.location.href;

        switch(url){
            case 'http://localhost/leaderAdmin/admin/index.php':
                $('#sidebar_index').addClass('active');
                break;
            case 'http://localhost/leaderAdmin/admin/gerenciar-colaboradores.php':
                $('#sidebar_colaboradores').addClass('active');
                break;
            case 'http://localhost/leaderAdmin/admin/gerenciar-campos.php':
                $('#sidebar_campos').addClass('active');
                break;  
            case 'http://localhost/leaderAdmin/admin/gerenciar-redirecionamento.php':
                $('#sidebar_redirecionamento').addClass('active');
                break;
            case 'http://localhost/leaderAdmin/admin/gerenciar-ceps.php':
                $('#sidebar_ceps').addClass('active');
                break;
        }
    }

    setarClasseNoItem();    
})