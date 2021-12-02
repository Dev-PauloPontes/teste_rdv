<?php
include_once '../database/config.php';

class Contrato extends config
{
    public $pdo;
    public $err;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db, $this->usuario, $this->senha, array(PDO::ATTR_PERSISTENT => true));
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function listContratoId($contr)
    {
        try {
            $sql = "SELECT * FROM tipo_contrato".( $contr > 0 ? " WHERE id_tipo_contrato = $contr;" : ";");
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function listClientesId($id_cliente)
    {
        try {
            $qr = '';
            if ($id_cliente > 0) $qr = 'WHERE id = ' . $id_cliente;

            $sql = "SELECT * FROM cliente $qr;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function listBemContratoNull($id)
    {
        try {
            $sql = "SELECT  b.imei, b.id
            FROM bem b
            JOIN cliente c ON b.cliente = c.id
            WHERE c.id = $id AND b.contrato IS NULL;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function listBemContratoOn($id, $contr)
    {
        try {
            $sql = "SELECT  b.imei, b.id
                    FROM bem b
                    JOIN cliente c ON b.cliente = c.id
                    WHERE c.id = $id AND b.contrato = $contr;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function updateBem_null($id_bem_s)
    {
        $sql = "UPDATE `bem` SET  `contrato`= NULL  WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_bem_s]);
    }

    public function updateBem_c($id_bem_c, $id_cont)
    {
        $sql = "UPDATE `bem` SET  `contrato`= ?  WHERE id = ?;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_cont, $id_bem_c]);
    }

    public function dadosContrato($id_c)
    {
        try {
            $sql = "SELECT * FROM contrato WHERE cliente = ?;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_c]);
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function insertFormContrato($descontoIntegral, $descontoPosterior, $mapa, $valorDescontoMapa, $descontoMapa, $inicioPagamento, $tipoContr, $id_cliente, $arr_s, $arr_c)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "INSERT INTO `contrato`(`cliente`, `tipo_contrato`, `desconto`, `desconto_pos`, `mapa`, `desconto_mapa`, `valor_desconto_mapa`, `data_inicio_pagamento` ) 
                    VALUES (?,?,?,?,?,?,?,?)";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_cliente, $tipoContr, $descontoIntegral, $descontoPosterior, $mapa,  $descontoMapa, $valorDescontoMapa, $inicioPagamento]);
            $result_id = $this->pdo->lastInsertId();
             

            foreach ($arr_s as  $id_bem_s) {
                $this->err =   $this->updateBem_null($id_bem_s);
            }

            foreach ($arr_c as  $id_bem_c) {
                $this->updateBem_c($id_bem_c, $result_id);
            }

            $this->pdo->commit();

            echo json_encode($result_id);
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function updateFormContrato($descontoIntegral, $descontoPosterior, $mapa, $valorDescontoMapa, $descontoMapa, $inicioPagamento, $fimPagamento, $tipoContr, $id_cliente, $id_contr, $arr_s, $arr_c)
    {
        try {
            $this->pdo->beginTransaction();
            $sql = "UPDATE `contrato` 
                    SET `cliente` = ?, `tipo_contrato`= ?, `desconto`= ?, `desconto_pos`= ?, `mapa`= ?, `desconto_mapa`= ?,`valor_desconto_mapa` = ?, `data_inicio_pagamento`= ?, `data_fim_contrato` = ?
                    WHERE id_contrato = ?;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_cliente, $tipoContr, $descontoIntegral, $descontoPosterior, $mapa,  $descontoMapa, $valorDescontoMapa, $inicioPagamento, $fimPagamento, $id_contr]);

            foreach ($arr_s as  $id_bem_s) {
                $this->err =   $this->updateBem_null($id_bem_s);
            }

            foreach ($arr_c as  $id_bem_c) {
                $this->updateBem_c($id_bem_c, $id_contr);
            }

            $this->pdo->commit();

            echo json_encode($id_contr);
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function listarContratoAtivo($id)
    {
        try {
            $sql = "SELECT DISTINCT ct.id_contrato, tc.id_tipo_contrato, tc.nome_tipo_contrato, ct.data_inicio_contrato, ct.data_inicio_pagamento , ct.data_fim_contrato,
                    (SELECT COUNT(b.imei) FROM bem b JOIN cliente c ON b.cliente = c.id WHERE c.id = $id AND b.contrato = ct.id_contrato) AS count_imei
                    FROM  contrato ct
                    JOIN cliente c ON c.id = ct.cliente
                    JOIN tipo_contrato tc ON tc.id_tipo_contrato = ct.tipo_contrato
                    LEFT JOIN bem b ON b.cliente = c.id
                    WHERE c.id = ?;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }

    public function listarDadosContrato($id)
    {
        try {
            $sql = "SELECT * FROM contrato ct
                    JOIN cliente c ON c.id = ct.cliente
                    WHERE ct.id_contrato = ?;";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($rs);
        } catch (PDOException $e) {
            echo json_encode('ERROR: ' . $e->getMessage());
        }
    }
}
  // $result_id = $this->pdo->lastInsertId();
            // echo json_encode($result_id);
//$this->pdo->commit();