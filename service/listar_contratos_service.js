var url = new URL(location.href);
var id_url = (url.search == '' ? '' : url.searchParams.get("id"));

// CARREGA COMBO CLIENTES
async function listarClientescontrato(id_url) {
    $('#cover-spin').show();
    const response = await fetch('../controller/contrato_controller.php?func=listId')
    let data = await response.json();

    var element = $('#listContr');
    element.find('option').remove();
    $("<option>").val(0).text('Selecione').appendTo('#listContr');
    data.forEach(function (res) {
        $("<option " + (id_url == res['id'] ? 'selected=true' : '') + ">").val(res['id']).text(res['nome']).appendTo('#listContr');
    });

    if (id_url){ listarContratosAtivos(id_url) }else{ $('#cover-spin').hide(); }

}

//LISTA CONTRATOS DO CLIENTE SELECIONADO
async function listarContratosAtivos(id_url) {
    const response = await fetch('../controller/contrato_controller.php?func=listarContratoAtivo&id=' + id_url)
    let data = await response.json();
    var element = $('#listContratos');
    element.find('li').remove();
    data.forEach(function (res) {
        var inicio_contrato = new Date(res.data_inicio_contrato);
        var inicio_pagamento = new Date(res.data_inicio_pagamento);
        var fim_contrato = new Date(res.data_fim_contrato);
        var li = '<li class="list-group-item">' + res.id_contrato +' - '+ res.nome_tipo_contrato + ' - Contrato: ' + inicio_contrato.toLocaleDateString("pt-BR")
            + ' - Pagamento: ' + inicio_pagamento.toLocaleDateString("pt-BR") +(res.data_fim_contrato != null ?  ' <span class="badge badge-pill badge-warning"> <i> Encerrado: </i>' + fim_contrato.toLocaleDateString("pt-BR") : '' )+ ' </span><span class="badge badge-' + ( res.count_imei > 0 ? 'success' : 'danger') + ' ml-3" style="left: 100%;">' + res.count_imei +' </span>'  
            + '<div class="pull-right" ><a href="#" onclick="editContrato(' + res.id_contrato + ')" class="edit" data-toggle="modal"><i class="fa fa-edit  update" '
            + '" title = "Editar" style = "font-size:24px; width: 40px;"></i></a></div></li>';
        $('#listContratos').append(li);
    });
    $('#cover-spin').hide();
}

//CHAMA PAGINA DE EDITAR CONTRATO PASSANDO ID DO CONTRATO
function editContrato(id_contr) {
    location.replace("contrato?id=" + id_contr);
}

listarClientescontrato(id_url)
