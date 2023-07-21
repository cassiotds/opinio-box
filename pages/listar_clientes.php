<?php
require_once '../includes/header.php';
require_once '../classes/ClienteDAO.php';

// Verifica se há parâmetros de busca no formulário
$nomeBusca = isset($_GET['nome']) ? $_GET['nome'] : '';
$cpfBusca = isset($_GET['cpf']) ? $_GET['cpf'] : '';

$clientes = new ClienteDAO;
$lista_clientes = $clientes->listarClientes($nomeBusca, $cpfBusca);
?>

<div class="container">
<!-- Conteúdo da página cadastrar.php -->
<h1 class="text-center mt-3 mb-5">Clientes</h1>


  <form class="form-inline mb-3" method="GET" action="listar_clientes.php">
    <div class="row">
      <div class="col">
        <div class="form-group mr-2">
            <label for="nome">Filtrar por Nome:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nomeBusca; ?>">
        </div>
      </div>

      <div class="col">
        <div class="form-group">
            <label for="cpf">Filtrar por CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cpfBusca; ?>">
        </div>
      </div>

      <div class="col">
        <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
      </div>
    </div>
  </form>


<table class="table table-dark table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">CPF</th>
      <th scope="col">CEP</th>
      <th>Editar</th>
      <th>Excluir</th>
    </tr>
  </thead>
  <tbody>
    

<?php 

  foreach ($lista_clientes as $cliente) {
      echo '
      <tr>
        <td>'.$cliente['nome_completo'].'</td>
        <td>'.$cliente['cpf'].'</td>
        <td>'.$cliente['cep'].'</td>
        <td><a href="editar_cliente.php?id='.$cliente['id'].'">Editar</a></td>
        <td><a href="../actions/excluir_action.php?id='.$cliente['id'].'" onclick="return confirm(\'Deseja realmente excluir este '.$cliente['nome_completo'].'?\')">Excluir</a></td>
      <tr>';
    }
  ?>

  </tbody>
</table>
<div class="row">
  <div class="col">
    <a href="../index.php" class="btn btn-success">Cadastrar</a>
  </div>

  <div class="col">
    <a href="relatorios/bairros_mais_de_um_cep.php" class="btn btn-info">Relatório dos bairros mais de um CEP</a>
  </div>

  <div class="col">  
    <a href="relatorios/bairros_e_ceps.php" class="btn btn-info">Quantidade de CEP de cada bairro</a>
  </div>
</div>
<div class="d-grid gap-2 col-6 mx-auto">
</div>

<?php

require_once '../includes/Footer.php';

?>