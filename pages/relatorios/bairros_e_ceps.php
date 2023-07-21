<?php
require_once '../../includes/header.php';
require_once '../../classes/Database.php';

$db = Database::getInstance();
$conn = $db->getConnection();

// Prepara a consulta SQL para listar a quantidade de CEPs que cada bairro possui
$stmt = $conn->prepare("SELECT nome_bairro, COUNT(*) as quantidade_cep FROM bairros_ceps GROUP BY nome_bairro");

// Execute a consulta
$stmt->execute();

// Obtem os resultados da consulta
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <h1 class="text-center mt-3 mb-5">Relatório de Bairros e Quantidade de CEPs</h1>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Bairro</th>
                <th scope="col">Quantidade de CEPs</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $bairro) {
                echo '
                <tr>
                    <td>' . $bairro['nome_bairro'] . '</td>
                    <td>' . $bairro['quantidade_cep'] . '</td>
                </tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<div class="d-grid gap-2 col-6 mx-auto">
        <a href="../../index.php" class="btn btn-success">Cadastrar</a>
        <a href="../listar_clientes.php" class="btn btn-success mt-3">Lista dos clientes</a>
    <div class="d-grid gap-2 col-6 mx-auto">
</div>

<?php
require_once '../../includes/footer.php';
?>