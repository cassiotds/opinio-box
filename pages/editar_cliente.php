<?php
require_once '../includes/header.php';
require_once '../includes/Cliente.php';
require_once '../classes/ClienteDAO.php';

?>

<section id="editar-cliente">
    <div class="container">

    <h1 class="text-center mt-3 mb-5">Editar Cliente</h1>

    <?php
    // Verifica se o ID do cliente foi passado via parâmetro na URL
    if (isset($_GET['id'])) {
        $clienteDAO = new ClienteDAO();
        $cliente = $clienteDAO->buscarClientePorId($_GET['id']);

        // Verifica se o cliente foi encontrado pelo ID
        if ($cliente) {
            ?>
            
            <form action="../actions/editar_action.php" method="post">
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="nome_completo" class="form-label">Nome completo:</label>
                        <input type="text" class="form-control" id="nome_completo" aria-describedby="nome_completo" placeholder="Nome completo" name="nome_completo" value="<?php echo $cliente['nome_completo']; ?>" required>
                        </div>
                    </div>  

                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" class="form-control" placeholder="CPF" name="cpf" value="<?php echo $cliente['cpf']; ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" placeholder="CEP" name="cep" value="<?php echo $cliente['cep']; ?>" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" id="endereco" class="form-control" placeholder="Endereço" name="endereco" value="<?php echo $cliente['endereco']; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" id="numero" class="form-control" placeholder="Número" name="numero" value="<?php echo $cliente['numero']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" placeholder="Bairro" name="bairro" value="<?php echo $cliente['bairro']; ?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">    
                        <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" placeholder="Cidade" name="cidade" value="<?php echo $cliente['cidade']; ?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" class="form-control" placeholder="Estado" name="estado" value="<?php echo $cliente['estado']; ?>">
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" class="btn btn-primary" value="Atualizar">
                    <a href="listar_clientes.php" class="btn btn-success mt-3">Lista dos clientes</a>
                </div>
            </form>
            <?php
        } else {
            echo "<p>Cliente não encontrado.</p>";
        }
    } else {
        echo "<p>ID do cliente não foi especificado.</p>";
    }
    ?>
    </div>
</section>

<script src="../assets/js/script.js"></script>

<?php
require_once '../includes/footer.php';
?>