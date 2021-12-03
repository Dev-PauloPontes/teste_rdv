var fim_pagamento = '';

$(document).on('click', '#btn-add', function (e) {
    $("#loader").show();
    e.preventDefault();
    var data = $("#add_contrato_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: '../controller/tipo_contrato_controller.php',
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#add').modal('hide');
                $("#end_Contrato").modal('show');
                $('#mensage_e').text('Novo contrato incluído!');
            }
            else if (dataResult.statusCode == 201) {
                alert("Nenhum dado alterado :/");
            }
            $("#loader").hide();
        }
    });

});

$(document).on('click', '.update', function (e) {

    $('#id_tipo_contrato_u').val($(this).attr("data-id_tipo_contrato"));
    $('#nome_tipo_contrato_u').val($(this).attr("data-nome_tipo_contrato"));
    $('#cod_tipo_contrato_u').val($(this).attr("data-cod_tipo_contrato"));
    $('#meses_u').val($(this).attr("data-meses"));
    $('#valor_u').val($(this).attr("data-valor"));
    $('#valor_pos_u').val($(this).attr("data-valor_pos"));
    $('#obs_u').val($(this).attr("data-obs"));
    $('#fimPagamento_u').val($(this).attr("data-fimPagamento"));
    fim_pagamento = $(this).attr("data-fimPagamento");
});





$(document).on("click", ".delete", function () {
    $('#id_tipo_contrato_u').val($(this).attr("data-id_tipo_contrato"));

});

$(document).on("click", "#delete", function (e) {
    $("#loader").show();
    e.preventDefault();
    $.ajax({
        url: '../controller/tipo_contrato_controller.php',
        type: "POST",
        cache: false,
        data: {
            func: 'del',
            id_tipo_contrato: $('#id_tipo_contrato_u').val()
        },
        success: function (dataResult) {
            $('#del').modal('hide');
            // $("#" + dataResult).remove();
            location.reload();
            $("#loader").hide();
        }
    });

});


$(document).ready(function () {
    $("#loader").show();
    $.ajax({
        url: '../controller/tipo_contrato_controller.php',
        data: { func: "list" },
        success: function (response) {
            const obj = JSON.parse(response);
            $.each(obj, function (i, data) {
                var li = '<li class="list-group-item">' + data.nome_tipo_contrato + (data.data_encerramento ? '<span class="badge badge-danger ml-3" > Inativo </span>' : '') + '<div class="float-right" > '
                    + ' <a href="#" onclick="editContrato()" class="edit" data-toggle="modal"><i class="fa fa-edit  update" "  data-toggle="tooltip" '
                    + ' data-id_tipo_contrato="' + data.id_tipo_contrato
                    + '" data-nome_tipo_contrato="' + data.nome_tipo_contrato
                    + '" data-cod_tipo_contrato="' + data.cod_tipo_contrato
                    + '" data-meses="' + data.meses
                    + '" data-valor="' + data.valor
                    + '" data-valor_pos="' + data.valor_pos
                    + '" data-obs="' + data.obs
                    + '" data-fimPagamento="' + (data.data_encerramento ? data.data_encerramento.slice(0, -9) : '')
                    + '" title = "Editar" style = "font-size:24px; width: 40px;"></i></a></div></li>';
                $('#list').append(li);
            });
            $("#loader").hide();
        }
    })
});

$(document).on('click', '#update', function (e) {

    if ($('#fimPagamento_u').val() != '' && fim_pagamento == '') {
        $('#confirmModal').modal('show')
        $('#corpoModal').text('A data de fim pagamento foi preenchida. Confirma ação?');
        return
    }

    if (fim_pagamento != '' && $('#fimPagamento_u').val() == '') {
        $('#confirmModal').modal('show')
        $('#corpoModal').text('Deseja reativar o tipo de contrato?');
        return
    }
    updateTipoContrato()
});

function updateTipoContrato() {
    $("#loader").show();
    var data = $("#update_form").serialize();
    $.ajax({
        data: data,
        type: "post",
        url: '../controller/tipo_contrato_controller.php',
        success: function (dataResult) {
            var dataResult = JSON.parse(dataResult);
            if (dataResult.statusCode == 200) {
                $('#edit').modal('hide');
                $("#end_Contrato").modal('show');
                $('#mensage_e').text('Contrato Atualizado!');
                $("#loader").hide();
                // location.reload();
            }
            else if (dataResult.statusCode == 201) {
                $("#loader").hide();
                alert("Nenhum dado alterado :/");

            }
        }
    });
}

function novoTipoContrato() {
    $("#add").modal('show');
}
function editContrato() {
    $("#edit").modal('show');
}
function delContrato() {
    $("#del").modal('show');
}
function confirmUpdate() {
    location.reload();
}

$(document).ready(function () {
    $('.modal')
        .on({
            'show.bs.modal': function () {
                var idx = $('.modal:visible').length;
                $(this).css('z-index', 1040 + (10 * idx));
            },
            'shown.bs.modal': function () {
                var idx = ($('.modal:visible').length) - 1;
                $('.modal-backdrop').not('.stacked')
                    .css('z-index', 1039 + (10 * idx))
                    .addClass('stacked');
            },
            'hidden.bs.modal': function () {
                if ($('.modal:visible').length > 0) {
                    $(document.body).addClass('modal-open');
                }
            }
        });
});