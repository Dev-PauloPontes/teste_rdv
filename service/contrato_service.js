var url = new URL(location.href);
var id_url = (url.search == '' ? '' : url.searchParams.get("id"));
(isNaN(id_url) ? listContrato() : '')

var erro = '';
var textoCorpo = '';
var data_fim_contrato = '';

///CARREGA COMBO CLIENTES
async function listarClientes(id) {

	if (id_url) $('#list').prop('disabled', 'disabled');
	var response = await fetch('../controller/contrato_controller.php?func=listId' + (id_url ? '&id_cliente=' + id : ''))
	let data = await response.json();
	var element = $('#list');
	element.find('option').remove();
	if (!id_url) $("<option>").val(0).text('Selecione').appendTo('#list').hide()

	data.forEach(function (res) {
		$("<option " + (id == res['id'] ? 'selected=true' : '') + ">").val(res['id']).text(res['nome']).appendTo('#list')
	});
	// " + (id == res['id'] ? 'selected=true' : (id != res['id'] && id_url ? "style='display: none;'" : '')) + "
	if (id) listarBensOut(id)

}


/// CARREGA COMBO TIPO DE CONTRATO
async function listarContratos(contr) {
	if (id_url) $('#contSel').prop('disabled', 'disabled');
	var response = await fetch('../controller/contrato_controller.php?func=contSelId&contr=' + contr)
	let data = await response.json();
	var element = $('#contSel');
	element.find('option').remove();
	if (!id_url) $("<option>").val(0).text('Selecione').appendTo('#contSel').hide();
	data.forEach(function (data) {
		$("<option >").val(data['id_tipo_contrato']).text(data['nome_tipo_contrato']).appendTo('#contSel');
	});
	// " + (contr == data['id_tipo_contrato'] ? 'selected=true style="background: #5cb85c; color: #fff;"' : '') + "
}

///CARREGA DISPOSITIVOS SEM CONTRATO
async function listarBensOut(id) {

	const response = await fetch('../controller/contrato_controller.php?func=listBem&id=' + id)
	let data = await response.json();
	var element = $('#multiselect');
	element.find('option').remove();
	data.forEach(function (res) {
		$('<option>').val(res['id']).text(res['imei']).appendTo('#multiselect').addClass('active');
	});

	$('#count1').text(($('#multiselect option').length));
}

///CARREGA DISPOSITIVOS COM CONTRATO
async function listarBensContr(id, contr) {

	const response = await fetch('../controller/contrato_controller.php?func=listContr&id=' + id + '&contr=' + contr)
	let data = await response.json();
	var contr = ''
	var element = $('#multiselect_to');
	element.find('option').remove();
	data.forEach(function (res) {
		$('<option>').val(res['id']).text(res['imei']).appendTo('#multiselect_to').addClass('active_to');
	});

	$('#count2').text(($('#multiselect_to option').length));

}


/// REUNE OS DADOS DOS BENS
async function storeData() {
	$("#loader").show();
	contr = $('#contSel').val();

	var arr_s = [];
	$("#multiselect > option").each(function () {
		arr_s.push(this.value);
	});

	var arr_c = [];
	$("#multiselect_to > option").each(function () {
		arr_c.push(this.value);
	});

	if (contr == 0) {
		$("#semTipoContrato").modal('show');
		$("#loader").hide();
		return
	}
	storeContrato(contr, arr_c, arr_s)

	$("#loader").hide();
}

//INSERE OU ATUALIZA CONTRATO
async function storeContrato(contr, arr_c, arr_s) {

	var id_cliente = $('#list').val();
	var descontoIntegral = $('#descontoIntegral').val().replace(",", ".");
	var descontoPosterior = $('#descontoPosterior').val().replace(",", ".");
	var mapa = $('#mapa').val();
	var valorDescontoMapa = $('#descMapa').val().replace(",", ".");
	var descontoMapa = ($('#descontoMapa:checked').val() ? 'S' : 'N');
	var inicioPagamento = $('#inicioPagamento').val();
	var fimPagamento = $('#fimPagamento').val();


	const response = await fetch('../controller/contrato_controller.php', {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: 'func=storeFormContrato&descontoIntegral=' + descontoIntegral + '&descontoPosterior=' + descontoPosterior + '&mapa=' + mapa + '&descontoMapa='
			+ descontoMapa + '&valorDescontoMapa=' + valorDescontoMapa + '&inicioPagamento=' + inicioPagamento + '&fimPagamento=' + fimPagamento + '&contr='
			+ contr + '&id_cliente=' + id_cliente + '&id_contr=' + id_url + '&arr_s=' + arr_s + '&arr_c=' + arr_c

	})

	let result_id = await response.json();

	erroForm(result_id)
}

//CARREGA DADOS DO CONTRATO CASO EDITAR
async function listarDadosContrato(id_url) {
	$("#loader").show();

	const response = await fetch("../controller/contrato_controller.php", {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/x-www-form-urlencoded',
		},
		body: "func=listarDadosContrato&id=" + id_url
	})

	let data = await response.json();
	if (data == '') listContrato()

	listarBensContr(data[0].cliente, data[0].id_contrato)
	listarClientes(data[0].cliente)
	listarContratos(data[0].tipo_contrato);

	$('#descontoIntegral').val(formataMoeda(data[0].desconto));
	$('#descontoPosterior').val(formataMoeda(data[0].desconto_pos));
	$('#mapa').val((data[0].mapa ? data[0].mapa : ''));
	$("#descontoMapa").prop('checked', (data[0].desconto_mapa == 'S' ? true : false));
	$('#descMapa').val(formataMoeda(data[0].valor_desconto_mapa));
	$('#inicioPagamento').val((data[0].data_inicio_pagamento ? data[0].data_inicio_pagamento.slice(0, -9) : ''));
	$('#fimPagamento').val((data[0].data_fim_contrato ? data[0].data_fim_contrato.slice(0, -9) : ''));
	(data[0].desconto_mapa == 'N' ? $('input[name="descMapa"]').hide() : '');
	$("#loader").hide();
	data_fim_contrato = data[0].data_fim_contrato;
}


// BOTAO SALVAR CHAMA MODAL DE CONFIRMACAO
function confirmUpdate() {
	if ($('#list').val() == 0) { // verifica cliente selecionado
		$("#semValidacao").modal('show');
		$('#messageValidacao').text('Selecione algum cliente').fadeIn();
		return
	}
	if ($('#contSel').val() == 0) { // verifica cliente selecionado
		$("#semValidacao").modal('show');
		$('#messageValidacao').text('Selecione algum contrato').fadeIn();
		return
	}

	$("#updateContrato").modal('show');

	if (data_fim_contrato == null && $('#fimPagamento').val() != '') {
		$('#corpoModal').text('A data de fim do contrato foi preenchida. Confirma ação?').fadeIn();
	} else {
		$('#corpoModal').hide();
	}
	console.log(data_fim_contrato)
	if (data_fim_contrato != null && $('#fimPagamento').val() == '' && id_url) {
		$('#corpoModal').text('Deseja reativar o contrato?').fadeIn();
	} else {
		//	$('#corpoModal').hide();
	}
}

//EXIBE/OCULTA INPUT VALOR DESCONTO MAPA    
$('input[name="descontoMapa"]').on('click', function () {
	if ($(this).prop('checked')) {
		$('input[name="descMapa"]').fadeIn();
	} else {
		$('input[name="descMapa"]').hide();
	}
});

//FORMATA MOEDA
$(".real").mask('#.##0,00', {
	reverse: true
});
function formataMoeda(valor) {
	var valor_c = parseFloat(valor).toLocaleString('pt-br', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
	return valor_c;
}

// INPUT DE PESQUISA DO MULTISELECT
$('#multiselect').multiselect({
	search: {
		left: '<input type="text" name="q" class="form-control" placeholder="Pesquisar..." />',
		right: '<input type="text" name="q" class="form-control" placeholder="Pesquisar..." />',
	}
});

//CHAMA MODAL DE CONFIRMACAO
if (id_url) {
	$('#title').text('Atualizar contrato');
	$('#titleModal').text('Atualizar contrato?');
	listarDadosContrato(id_url);
} else {
	$('#title').text('Novo contrato');
	$('#titleModal').text('Cadastrar contrato?');
	listarClientes()
	listarContratos()
	$('input[name="descMapa"]').hide()
	$('#rowFimPagamento').hide();
}

///VOLTAR PARA LISTA DE CONTRATOS 
function listContrato() {
	location.replace("listar_contratos" + (id_url ? "?id=" + $('#list').val() : ''));
}

///TRATAMENTO EM CASO DE ERROS
function erroForm(result_id) {
	if (result_id >= 0) {
		$("#ContratoAtualizado").modal('show');
	} else {
		$("#erroContrato").modal('show');
		$('#titleModalErro').text('Erro');
		$('#erro').text('Erro ao cadastrar o contrato')
		$("#loader").hide();
	}
}

// function erroUpdateBem(message) {
// 	if (message == '') {
// 		$("#loader").hide();
// 	} else {
// 		$("#erroContrato").modal('show');
// 		$('#titleModalErro').text('Erro');
// 		$('#erro').text('Erro ao cadastrar o(s) imei(s) do contrato')
// 		$("#loader").hide();
// 	}
//}




