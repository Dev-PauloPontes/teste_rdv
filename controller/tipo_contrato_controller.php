<?php
include_once '../model/tipo_contrato_model.php';

$model = new TipoContrato();

switch ($_REQUEST['func']) {
	case 'list':
		$model->listContrato();
		break;

	case 'edit':
		$dataFim = $_REQUEST['fimPagamento'];
		($dataFim == '' ? $dataFim = NULL : $dataFim);
		$model->edit($_REQUEST['id_tipo_contrato'], $_REQUEST['nome_tipo_contrato'], $_REQUEST['cod_tipo_contrato'], $_REQUEST['meses'], $_REQUEST['valor'], $_REQUEST['valor_pos'], $_REQUEST['obs'], $dataFim);
		break;

	case 'add':
		$model->add($_REQUEST['nome_tipo_contrato'], $_REQUEST['cod_tipo_contrato'], $_REQUEST['meses'], $_REQUEST['valor'], $_REQUEST['valor_pos'], $_REQUEST['obs']);
		break;

	case 'del':
		$model->del($_REQUEST['id_tipo_contrato']);
		break;
}
