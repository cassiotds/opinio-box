<?php
require_once '../includes/Cliente.php';
require_once '../classes/ClienteDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Recebe os dados do formulário
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
        $cliente->setNomeCompleto($nome);
        $cliente->setCpf($cpf);
        $cliente->setCep($cep);
        $cliente->setEndereco($endereco);
        $cliente->setNumero($numero);
        $cliente->setBairro($bairro);
        $cliente->setCidade($cidade);
        $cliente->setEstado($estado);

        // Cadastra o cliente no banco de dados
        $clienteDAO = new ClienteDAO();
        $clienteDAO->cadastrarCliente($cliente);

        // Armazene o ID do cliente na sessão
        $_SESSION['cliente_id'] = $cliente->getId();

        // Redireciona de volta para a página de listar clientes após o cadastro
        header('Location: ../pages/listar_clientes.php');
        exit;
    } catch (Exception $e) {
        $error_message = $e->getMessage();
        
        session_start();
        $_SESSION['cpf_error'] = $error_message;
        header('Location: ../index.php'); // Redireciona de volta para a página de cadastro
        exit;
    }
}
?>