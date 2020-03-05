<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<?php

require_once 'acoes/conexao.php';
require_once 'acoes/hash.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$login = Safe::decode($_SESSION['userNome'], date('DMYH'), true);

if(!isset($_SESSION['sessaoID']) || $login != $_SESSION['sessaoID']){
  //verificando se ha sessao
    session_destroy();            //destruindo a sessao para ter segurança
    header("Location: logout.php"); exit;  
}

$home = "http://localhost/sistema_crud/";

?>
<body class="p-3 mb-2 bg-info text-white">
<?php include_once 'acoes/mensagem.php'; 
?>
    <!-- MENU -->
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a href="#" class="dropdown-toggle" id="perfil" data-toggle="dropdown">Usuário, <?php echo $login;?></a>
            <ul class="dropdown-menu">
                <li><a href="editar.php" id="subper"><i class="fa fa-fw fa-user"></i> Editar Perfil</a></li>
                <li><a href="senha.php" id="subper"><i class="fa fa-fw fa-key"></i> Mudar senha</a></li>
                <li><a href="logout.php" id="subper"><i class="fa fa-fw fa-power-off"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
<!-- LISTA DE CLIENTES -->
<table 
    id="cliente-table"
    class="table table-light" 
    data-toggle="table"
    data-pagination="true"
    data-search="true"
    data-search-align="left"
    data-show-columns="true"
    data-show-fullscreen="true"
    data-show-Pagination-Switch="true"
    data-show-export="true"
    data-pagination-pre-text="Anterior"
    data-pagination-next-text="Próximo"
    data-pagination-h-align="left"
    data-pagination-detail-h-align="right"
    data-page-list="[10,20,30,40,50,all]"

    >
  <thead class="thead-dark">
    <tr>
      <th scope="col" data-field="clt_nome" data-sortable="true">NOME</th>
      <th scope="col" data-field="clt_cpf" data-sortable="false">CPF</th>
      <th scope="col" data-field="clt_nome_mae" data-sortable="false">NOME DA MAE</th>
      <th scope="col" data-field="clt_tel" data-sortable="false">TELEFONE</th>
      <th scope="col" data-field="clt_cel"data-sortable="false">CELULAR</th>
      <th data-field="acoes">
            <a href="#"><i class="fa fa-address-card fa-lg" style="color:white" aria-hidden="true" data-toggle="modal" data-target="#cadeCliente"></i></a>
            <a href="#" onclick="pdf()"><i class="fa fa-file-pdf-o fa-lg" aria-hidden="true" style="color:white"></i></a>
      </th>
      
    </tr>
  </thead>
</table>
<script>
 document.addEventListener("DOMContentLoaded", function(event){
  $('#cliente-table').bootstrapTable()
  buscar_cliente()
 });
  function buscar_cliente(){
    $.ajax({
      url:'<?=$home ?>acoes/buscar_cliente.php',
      type:'POST',
      dataType:'JSON',
      data:{
        action: 'buscar_cliente'
      },
      success:function(data){
        $('#cliente-table').bootstrapTable('load',data)
      },
      error:function(e){
				console.log(e)
      }
    })
  }



function pdf(){
  $('#cliente-table').tableExport({
    type:'pdf',
    jspdf: {orientation: 'R',
    format: 'a4',
    margins: {left:10, right:10, top:20, bottom:20},
      autotable: {styles: {fillColor: 'inherit', 
      textColor: 'inherit'},
      tableWidth: 'auto'}
    }
    
  });
}

</script>
<!-- Modal Cadastro cliente -->
<div class="modal fade" id="cadeCliente" tabindex="-1" role="dialog" aria-labelledby="cadeCliente" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cadeCliente">Cadastrar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
      <form class="p-3 mb-5 bg-white rounded" method="POST" > 
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Nome completo:  </label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Ex: Fulano da silva" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Nome da Mãe:  </label>
                <input type="text" class="form-control" name="nomeMae" id="nomeMae" placeholder="Ex: Fulano da silva" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>CPF:  </label>
                <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Ex: Fulano da silva" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>TELEFONE FIXO:  </label>
                <input type="text" class="form-control" name="telefone" id="telefone"required>
            </div>
            <div class="form-group col-md-6">
                <label>CELULAR: </label>
                <input type="text" class="form-control" name="celular" id="celular"required>
            </div>
        </div>    
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="cadastrarCliente()" data-dismiss="modal" class="btn btn-primary">Cadastrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar cliente -->
<div class="modal fade fechar" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="editarCliente" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarCliente">Editar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">  
      <form class="p-3 mb-5 bg-white rounded" method="POST" > 
        <div class="form-row">
            <div>
                <input style="display:none;" name="idEditar" id="idEditar">
            </div>
            <div class="form-group col-md-12">
                <label>Nome completo:  </label>
                <input type="text" class="form-control" name="nomeEditar" id="nomeEditar" placeholder="Ex: Fulano da silva" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Nome da Mãe:  </label>
                <input type="text" class="form-control" name="nomeMaeEditar" id="nomeMaeEditar" placeholder="Ex: Fulano da silva" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>CPF:  </label>
                <input type="text" class="form-control" name="cpfEditar" id="cpfEditar" placeholder="Ex: Fulano da silva" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>TELEFONE FIXO:  </label>
                <input type="text" class="form-control" name="telefoneEditar" id="telefoneEditar"required>
            </div>
            <div class="form-group col-md-6">
                <label>CELULAR: </label>
                <input type="text" class="form-control" name="celularEditar" id="celularEditar"required>
            </div>
        </div>    
     </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" onclick="editarCliente()"  data-dismiss="modal" class="btn btn-primary">Atualizar</button>
      </div>
    </div>
  </div>
</div>


<script>
function cadastrarCliente(){
  $.ajax({
    url:'<?=$home?>acoes/cadastrarCliente.php', // Send
    type:'POST', // Back
    dataType:'JSON',//Back
    data://Send and Back
    { 
      
      action   : 'cad_cliente',
      nome     : $('#nome').val(),
      nomeMae  : $('#nomeMae').val(),
      cpf      : $('#cpf').val(),
      tel      : $('#telefone').val(),
      cel      : $('#celular').val()
    },
    success:function(data){//Did Back
      if(data.status == true){
        swal(data.msg)
        buscar_cliente()
        $('#cadeCliente').cadeCliente('hide')
      }else{
        swal(data.msg,'')
      }
    },
    error:function(e){//nem foi deu erro de conexao ou url
      swal('Erro ao se comunicar com o servidor.')
    }
  })
}
function deletarCliente(value){
  swal({
    title: "Você tem certeza?",
    text: "Uma vez excluído, você não poderá recuperar este cliente!",
    icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
    $.ajax({
      url:'<?=$home?>acoes/deletarCliente.php', // Send
      type:'POST', // Back
      dataType:'JSON',//Back
      data://Send and Back
      {    
      action   : 'cad_cliente',
      id       : value
      },
            //aqui
      success:function(data){//Did Back
        if(data.status == true){
          //alert(data.msg);
          swal("Seu cliente foi excluído!", {
            icon: "success",
          });
          buscar_cliente()
        }else{
          swal("erro ao excluir cliente!")
        }

      },
      error:function(e){//nem foi deu erro de conexao ou url
        alert('Erro ao se comunicar com o servidor.')
      }
    })
   

  } else {
    swal("Seu cliente não foi excluido!");
  }
});
}
function buscarCliente(id, nome,mae,cel,tel,cpf){
  document.getElementById("idEditar").value = id
  document.getElementById("nomeEditar").value = nome
  document.getElementById("nomeMaeEditar").value = mae
  document.getElementById("cpfEditar").value = cpf
  document.getElementById("telefoneEditar").value = tel
  document.getElementById("celularEditar").value = cel
}
function editarCliente(){
  $.ajax({
    url:'<?=$home?>acoes/updateCliente.php', // Send
    type:'POST', // Back
    dataType:'JSON',//Back
    data://Send and Back
    { 
      
      action   : 'edt_cliente',
      id       : $('#idEditar').val(),
      nome     : $('#nomeEditar').val(),
      nomeMae  : $('#nomeMaeEditar').val(),
      cpf      : $('#cpfEditar').val(),
      tel      : $('#telefoneEditar').val(),
      cel      : $('#celularEditar').val()
    },
    success:function(data){//Did Back
      if(data.status == true){
        swal(data.msg)
        buscar_cliente()
      }else{
        swal(data.msg,'')
      }
    },
    error:function(e){//nem foi, deu erro de conexao ou url
      swal('Erro ao se comunicar com o servidor.')
    }
  })
}


</script>

<!-- icons -->
<script src="https://use.fontawesome.com/19a91ab86c.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js" ></script> 
<script src="js/script.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>

<!-- boot strap table -->
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF/jspdf.min.js"></script>
<script src="https://unpkg.com/tableexport.jquery.plugin/libs/jsPDF-AutoTable/jspdf.plugin.autotable.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>

</body>
</html>


