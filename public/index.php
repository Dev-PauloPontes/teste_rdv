<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="../img/favicons.png" />
    <title>Tipos de contrato</title>
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-12 ">
                <h2>Cadastro - Tipo de Contrato</h2>
            </div>
        </div>
        <div class="col-12">
            <ul>
                <li class="list-group-item" style="list-style-type: none;">
                    <button type="button" onclick="novoTipoContrato()" class="btn btn-success" data-bs-dismiss=" modal">Novo Tipo Contrato</button>
                    <a href="listar_contratos" class="btn btn-outline-info"><span>Voltar</span></a>
                </li>
            </ul>
            <ul id="list">

            </ul>
        </div>

        <!--  Modal -->
        <div id="add" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="add_contrato_form">
                        <div class="modal-header">
                            <h4 class="modal-title">Novo Tipo de Contrato</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nome tipo contrato</label>
                                <input type="text" id="nome_tipo_contrato" name="nome_tipo_contrato" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Código tipo contrato</label>
                                <input type="text" id="cod_tipo_contrato" name="cod_tipo_contrato" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Meses</label>
                                <input type="number" id="meses" name="meses" min="0" max="24" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Valor</label>
                                <input type="number" id="valor" name="valor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Valor pós</label>
                                <input type="number" id="valor_pos" name="valor_pos" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Observação</label>
                                <textarea class="form-control" id="obs" name="obs" style="height: 100px"></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label>Data fim pagamento</label>
                                <input type="date" id="fimPagamento" name="fimPagamento" class="form-control">
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="add" name="func">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-dark" id="btn-add">Salvar</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <!-- Edit Modal HTML -->
        <div id="edit" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="update_form">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Tipo de Contrato</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_tipo_contrato_u" name="id_tipo_contrato" class="form-control" required>
                            <div class="form-group">
                                <label>nome_tipo_contrato</label>
                                <input type="text" id="nome_tipo_contrato_u" name="nome_tipo_contrato" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>cod_tipo_contrato</label>
                                <input type="text" id="cod_tipo_contrato_u" name="cod_tipo_contrato" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>meses</label>
                                <input type="number" id="meses_u" name="meses" class="form-control" min="0" max="24" required>
                            </div>
                            <div class="form-group">
                                <label>valor</label>
                                <input type="number" id="valor_u" name="valor" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>valor pós</label>
                                <input type="number" id="valor_pos_u" name="valor_pos" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Observação</label>
                                <textarea class="form-control" id="obs_u" name="obs" style="height: 100px"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Data fim pagamento</label>
                                <input type="date" id="fimPagamento_u" name="fimPagamento" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="edit" name="func">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-dark" id="update">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="del" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>

                        <div class="modal-header">
                            <h4 class="modal-title">Apagar Tipo de Contrato</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id_d" name="id" class="form-control">
                            <p>Apagar Registro?</p>
                            <p class="text-danger"><small>Esta ação não poderá ser desfeita.</small></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="delete">Apagar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="end_Contrato" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Contrato Atualizado</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <p id="mensage_e"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="confirmUpdate()" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="confirmModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Atualizar Contrato? </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">x</button>
                        </div>
                        <div class="alert alert-danger" id="corpoModal" role="alert"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-dark" onclick="updateTipoContrato()" data-bs-dismiss="modal">OK</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.13/jquery.mask.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="../service/tipo_contrato_service.js"></script>
</body>

</html>