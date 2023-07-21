<?php
require_once 'includes/header.php';
?>

<section id="cadastro-cliente">
  <div class="container">
    <!-- Conteúdo da página cadastrar.php -->
    <h1 class="text-center mt-3 mb-5">Cadastro dos Clientes</h1>

    <form action="actions/cadastrar_action.php" method="post">

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="nome_completo" class="form-label">Nome completo:</label>
            <input type="text" class="form-control" id="nome_completo" aria-describedby="nome_completo" placeholder="Nome completo" name="nome_completo" required>
          </div>
        </div>  

        <div class="col-md-6">
          <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" id="cpf" class="form-control" placeholder="CPF" name="cpf" required>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" id="cep" class="form-control" placeholder="CEP" name="cep" required>
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" id="endereco" class="form-control" placeholder="Endereço" name="endereco">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" id="numero" class="form-control" placeholder="Número" name="numero" required>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" id="bairro" class="form-control" placeholder="Bairro" name="bairro">
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">    
          <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" id="cidade" class="form-control" placeholder="Cidade" name="cidade">
          </div>
        </div>

        <div class="col-md-6">
          <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" id="estado" class="form-control" placeholder="Estado" name="estado">
          </div>
        </div>
      </div>

      <?php
        session_start();
        if (isset($_SESSION['cpf_error'])) {
            echo '<div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3 mt-3 mb-3">' . $_SESSION['cpf_error'] . '</div>';
            unset($_SESSION['cpf_error']); // Limpa a mensagem de erro para que ela não seja exibida novamente em recarregamentos subsequentes da página
        }
      ?>

      <div class="d-grid gap-2 col-6 mx-auto">
        <input type="submit" class="btn btn-primary" value="Cadastrar">
        <a href="pages/listar_clientes.php" class="btn btn-success mt-3">Lista dos clientes</a>
      </div>

    </form>

  </div>

</section>

<script src="assets/js/script.js"></script>

<?php

require_once 'includes/footer.php';
?>