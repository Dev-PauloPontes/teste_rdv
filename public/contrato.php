<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="icon" href="../img/favicons.png" />
    <title>Contrato</title>
</head>
<div class="row">
    <div class="">
        <img src="../img/loading.gif" class="loader" id="loader">
    </div>
</div>

<body>
    <div class="container">

        <div class="row text-center">
            <div class="col-12 ">
                <h2 id="title"></h2>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <form name="id" id="form select">
                    <div class="form-group">
                        <label>Clientes</label>
                        <select class="form-control" id="list" onchange="listarClientes(this.value)">
                        </select>
                    </div>
                </form>
            </div>

            <div class="col">
                <div class="form-group">
                    <label>Tipo de Contratos</label>
                    <select class="form-control" id="contSel">
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div class="form " role="form">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="descontoIntegral">Valor desconto integral:</label>
                    </div>
                </div>
                <div class="col">
                    <input id="descontoIntegral" class="real form-control" type="text" placeholder="0,00" />
                </div>
            </div>
            <div class="row" style="padding-top:10px ;">
                <div class="col">
                    <div class="form-group">
                        <label for="descontoPosterior">Valor desconto posterior:</label>
                    </div>
                </div>
                <div class="col">
                    <input id="descontoPosterior" class="real form-control" type="text" placeholder="0,00" />
                </div>
            </div>
            <div class="row" style="padding-top:10px ;">
                <div class="col">
                    <div class="form-group">
                        <label for="mapa" class="col-xs-4">Mapa:</label>
                    </div>
                </div>
                <div class="col">
                    <select class="form-control" id="mapa">
                        <option value="OPEN">Open</option>
                        <option value="GOOGLE">Google</option>
                    </select>
                </div>
            </div>
            <div class="row" style="padding-top:10px ;">
                <div class="col">
                    <div class="form-group">
                        <label for="descontoMapa">Desconto mapa</label>
                        <div class="float-right" style="margin: 11px;">
                            <label class="switch">
                                <input type="checkbox" name="descontoMapa" id="descontoMapa">
                                <span class="slider round"></span>
                            </label>
                            <!-- <input class="form-check-input" type="checkbox" name="descontoMapa" id="descontoMapa"> -->
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group ">
                        <input class="real form-control " name="descMapa" id="descMapa" type="text" placeholder="0,00">
                    </div>
                </div>
            </div>
            <div class="row" >
                <div class="col">
                    <div class="form-group ">
                        <label for="inicioPagamento" class="col-xs-4">Data início pagamento:</label>
                    </div>
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="inicioPagamento">
                </div>
            </div>
            <div class="row pt-1" id="rowFimPagamento">
                <div class="col">
                    <div class="form-group ">
                        <label for="fimPagamento" class="col-xs-4">Data fim contrato:</label>
                    </div>
                </div>
                <div class="col">
                    <input type="date" class="form-control" id="fimPagamento">
                </div>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col-5 text-center">
                <label class="">Equipamentos sem contratos </label>
                <select name="from[]" id="multiselect" class="form-control" size="10" multiple="multiple">
                </select>
            </div>

            <div class="col-2 align-middle" style="padding-top: 80px;">
                <div class="form-group">
                    <div class="col-auto text-center p-1">
                        <button type="button" id="multiselect_rightSelected" class="btn btn-outline-dark"><i class="fa fa-arrow-right"></i></button>
                    </div>
                    <div class="col-auto text-center">
                        <button type="button" id="multiselect_leftSelected" class="btn btn-outline-dark"><i class="fa fa-arrow-left"></i></button>
                    </div>
                    <div class="col-auto text-center p-3">
                        <button type="button" id="multiselect_rightAll" class="btn btn-outline-primary btn-sm">Selecionar todos</button>
                    </div>
                    <div class="col-auto text-center">
                        <button type="button" id="multiselect_leftAll" class="btn btn-outline-danger btn-sm">Remover todos</button>
                    </div>
                </div>
            </div>

            <div class="col-5 text-center">
                <label class="">Equipamentos com contratos </label>
                <select name="to[]" id="multiselect_to" class="form-control" size="10" multiple="multiple" data-live-search="true"></select>
            </div>

        </div>
        <hr>
        <!-- <div class="row" style="padding-top: 10px;">
            <div class="col">
                <div class="form-group ">
                     <div class="form-check form-switch">   ///apenas no editar e confirmar caso preenchido 
                        <input class="form-check-input" type="checkbox" id="mostrarComContrato">
                        <label for="mostrarComContrato" class="col-xs-4">Mostrar equipamento com contrato</label>
                    </div>
                </div>

            </div>
        </div>
        <hr> -->
        <div class="row mb-5">
            <div class="col">
                <div class="pull-right">
                    <a href="JavaScript:void(0);" class="btn btn-default" onclick="listContrato()"><span>Voltar</span></a>
                    <a href="JavaScript:void(0);" class="btn btn-dark" onclick="confirmUpdate()" id="contrato" style="margin-left: 10px;">Salvar<span></a>
                </div>
            </div>
        </div>
        <div id="semTipoContrato" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Tipo de Contrato</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_d" name="id" class="form-control">
                            <p>Selecione algum tipo de contrato</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="semContrato" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Contrato</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_d" name="id" class="form-control">
                            <p>Selecione algum contrato</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="semCliente" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Contrato</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_d" name="id" class="form-control">
                            <p>Selecione algum cliente</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="ContratoAtualizado" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Contrato Atualizado</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_d" name="id" class="form-control">
                            <p>Contrato Atualizado</p>
                        </div>
                        <div class="modal-footer">
                            <a href="JavaScript:void(0);" onclick="listContrato()" class="btn btn-secondary" data-dismiss="modal">OK</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="updateContrato" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title" id="titleModal"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <!-- <h6 class="text-danger" id="corpoModal"></h6> -->
                            <div class="alert alert-danger" id="corpoModal" role="alert">
                            </div>
                            <!-- <input type="hidden" id="id_d" name="id" class="form-control"> -->
                            <p>Está ação irá salvar o contrato</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="storeData()">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="erroContrato" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title" id="titleModalErro"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <p id=erro></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../js/jquery.mask.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/multiselect.js"></script>
    <script src="../service/contrato_service.js"></script>
</body>

</html>