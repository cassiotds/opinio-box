<?php

require_once '../includes/Cliente.php';
require_once '../classes/ClienteDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Recebe os dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome_completo'];
        $cpf = $_POST['cpf'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];

        // Cria um objeto Cliente com os dados do formulário
        $cliente = new Cliente();
        $cliente->setId($id);
        $cliente->setNomeCompleto($nome);
        $cliente->setCpf($cpf);
        $cliente->setCep($cep);
        $cliente->setEndereco($endereco);
        $cliente->setNumero($numero);
        $cliente->setBairro($bairro);
        $cliente->setCidade($cidade);
        $cliente->setEstado($estado);

        // Atualiza o cliente no banco de dados
        $clienteDAO = new ClienteDAO();
        $clienteDAO->atualizarCliente($cliente);

        // Redireciona de volta para a página de listar clientes após a edição
        header('Location: ../pages/listar_clientes.php');
        exit;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        session_start();
        $_SESSION['edit_error'] = $error_message;

        echo $error_message.'<br>';
        echo $_SESSION['edit_error'];
        exit;
    }
}
?>