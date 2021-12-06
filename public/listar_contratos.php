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
    <title>Listar Contratos</title>
</head>

<body>
    <div id="cover-spin"></div>
    <div class="container">

        <div class="row text-center">
            <div class="col-12 ">
                <h2>Contratos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="list-group-item" style="list-style-type: none;">
                    <a href="../public/contrato" class="btn btn-success">Novo Contrato</button>
                        <a href="../public/" class="btn btn-outline-info  ml-1"><span>Tipos de contrato</span></a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col mt-1">
                <div class="form-group">
                    <label>
                        <h6>Empresas</h6>
                    </label>
                    <select class="form-control" id="listContr" onchange="listarClientescontrato(this.value)">
                        <option value="0">Selecione</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col" id="listContratos"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../service/listar_contratos_service.js"></script>
</body>

</html>