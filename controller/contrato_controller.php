<?php
include_once '../model/contrato_model.php';

$model = new Contrato();

switch ($_REQUEST['func']) {

	case 'listId':
		$model->listClientesID(@$_REQUEST['id_cliente']);
		break;

	case 'contSelId':
		$contr =  $_REQUEST['contr'];
		$model->listContratoId($contr);
		break;

	case 'listBem':
		$model->listBemContratoNull($_REQUEST['id']);
		break;

	case 'listContr':
		$model->listBemContratoOn($_REQUEST['id'], $_REQUEST['contr']);
		break;

	case 'dadosContr':
		$model->dadosContrato($_REQUEST['id']);
		break;

	case 'storeFormContrato':
		$descontoIntegral =  $_REQUEST['descontoIntegral'];
		$descontoPosterior =  $_REQUEST['descontoPosterior'];
		$mapa =  $_REQUEST['mapa'];
		$valorDescontoMapa =  $_REQUEST['valorDescontoMapa'];
		$descontoMapa =  $_REQUEST['descontoMapa'];
		$inicioPagamento =  $_REQUEST['inicioPagamento'];		
		$contr =  $_REQUEST['contr'];
		$id_cliente =  $_REQUEST['id_cliente'];
		$id_contr =  @$_REQUEST['id_contr'];
		$fimPagamento =  $_REQUEST['fimPagamento'];
		($fimPagamento == '' ? $fimPagamento = NULL : $fimPagamento);
		$arr_s = explode(",", $_REQUEST['arr_s']);
		$arr_c = explode(",", $_REQUEST['arr_c']);

		if (!$id_contr) {
			$model->insertFormContrato($descontoIntegral, $descontoPosterior, $mapa, $valorDescontoMapa, $descontoMapa, $inicioPagamento, $contr, $id_cliente, $arr_s, $arr_c);
		} else {
			$model->updateFormContrato($descontoIntegral, $descontoPosterior, $mapa, $valorDescontoMapa, $descontoMapa, $inicioPagamento, $fimPagamento, $contr, $id_cliente, $id_contr, $arr_s, $arr_c);
		}

		break;

	case 'listarContratoAtivo':
		$model->listarContratoAtivo($_REQUEST['id']);
		break;

	case 'listarDadosContrato':
		$model->listarDadosContrato($_REQUEST['id']);
		break;
}
