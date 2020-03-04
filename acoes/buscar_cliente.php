<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'conexao.php';
require_once 'hash.php';
session_start();


switch($_POST['action']){
    case 'buscar_cliente':
        buscar_cliente();
    break;
}
function buscar_cliente(){

    $id = Safe::decode($_SESSION['userID'], date('DMYH'), true);
    $sql = "SELECT  clt_id, clt_nome, clt_cpf, clt_nome_mae, clt_tel, clt_cel FROM clientes WHERE clt_user_id = '$id' ";
    $select = Conexao::conecta()->query($sql);
    $data = $select->fetchAll(PDO::FETCH_ASSOC);

    for($i=0; $i<count($data); $i++){
        ob_start();?>
            <a class="edit" title="editar"  onclick="buscarCliente('<?=Safe::encode($data[$i]['clt_id'], date('DMYH'), true);?>','<?=$data[$i]['clt_nome']?>', '<?=$data[$i]['clt_nome_mae']?>', '<?=$data[$i]['clt_tel']?>',' <?=$data[$i]['clt_cel']?> ',' <?=$data[$i]['clt_cpf']?>')" style="cursor:pointer;"  data-toggle="modal" data-target="#editarCliente">
                <span class="fa fa-edit text-dark font-weight-bold" aria-hidden="true"></span>
            </a>
            <a class="remove" title="remover"  style="cursor:pointer;" onclick="deletarCliente('<?=$data[$i]['clt_id']?>')">
                <span class="fa fa-trash-o text-dark font-weight-bold" aria-hidden="true"></span>
            </a>

        <?php
        $data[$i]['acoes'] = ob_get_clean();
    }
    echo json_encode($data);
}
?>