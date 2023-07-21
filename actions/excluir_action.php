<?php
require_once '../classes/ClienteDAO.php';

// Verifica se o ID do cliente foi passado via parâmetro na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Cria um objeto Cliente com o ID a ser excluído
    $cliente = new Cliente();
    $cliente->setId($id);

    // Exclui o cliente no banco de dados
    $clienteDAO = new ClienteDAO();
    $clienteDAO->excluirCliente($cliente);

    // Redireciona de volta para a página de listar clientes após a exclusão
    header('Location: ../pages/listar_clientes.php');
    exit;
} else {
    // Se o ID do cliente não foi especificado, redireciona de volta para a página de listar clientes
    header('Location: ../pages/listar_clientes.php');
    exit;
}
?>