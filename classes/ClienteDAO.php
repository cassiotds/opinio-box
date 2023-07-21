<?php

require_once '../classes/Database.php';
require_once '../includes/Cliente.php';

class ClienteDAO
{
    public function listarClientes($nomeBusca = '', $cpfBusca = '')
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            $sql = "SELECT * FROM cadastro WHERE 1";

            // Verifica se foi informado algum nome para a busca
            if (!empty($nomeBusca)) {
                $sql .= " AND nome_completo LIKE :nomeBusca";
            }

            // Verifica se foi informado algum CPF para a busca
            if (!empty($cpfBusca)) {
                $sql .= " AND cpf LIKE :cpfBusca";
            }

            $stmt = $conn->prepare($sql);

            // Associa os parâmetros de busca aos placeholders, se existirem
            if (!empty($nomeBusca)) {
                $stmt->bindValue(':nomeBusca', '%' . $nomeBusca . '%');
            }

            if (!empty($cpfBusca)) {
                $stmt->bindValue(':cpfBusca', '%' . $cpfBusca . '%');
            }

            // Executa a consulta
            $stmt->execute();

            // Retorna o resultado da consulta
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            throw new Exception('Erro ao listar clientes: ' . $e->getMessage());
        }
    }

    public function cadastrarCliente(Cliente $cliente)
    {
        $db = Database::getInstance()->getConnection();

        try {
            // Inserção dos dados do cliente no banco de dados
            $query = "INSERT INTO cadastro (nome_completo, cpf, cep, endereco, numero, bairro, cidade, estado ) VALUES (:nome_completo, :cpf, :cep, :endereco, :numero, :bairro, :cidade, :estado)";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':nome_completo', $cliente->getNomeCompleto());
            $stmt->bindValue(':cpf', $cliente->getCpf());
            $stmt->bindValue(':cep', $cliente->getCep());
            $stmt->bindValue(':endereco', $cliente->getEndereco());
            $stmt->bindValue(':numero', $cliente->getNumero());
            $stmt->bindValue(':bairro', $cliente->getBairro());
            $stmt->bindValue(':cidade', $cliente->getCidade());
            $stmt->bindValue(':estado', $cliente->getEstado());
            
            $stmt->execute();

            // Aqui chamamos o método para cadastrar os CEPs do bairro na tabela bairros_ceps
            $this->cadastrarCepsPorBairro($cliente->getCep(), $cliente->getBairro().' - '.$cliente->getCidade().' - '.$cliente->getEstado() );
        } catch (PDOException $e) {
            // Tratamento de erros na inserção
            die("Erro ao cadastrar cliente: " . $e->getMessage());
        }
    }

    public function cadastrarCepsPorBairro($cep, $nome_bairro)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            // Verifica se o bairro já possui esse CEP cadastrado na tabela bairros_ceps
            $stmt = $conn->prepare("SELECT COUNT(*) FROM bairros_ceps WHERE cep = :cep AND nome_bairro = :nome_bairro");
            $stmt->bindValue(':cep', $cep);
            $stmt->bindValue(':nome_bairro', $nome_bairro);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            // Se o CEP não estiver cadastrado para esse bairro, faz o cadastro
            if ($count === '0') {
                $stmt = $conn->prepare("INSERT INTO bairros_ceps (cep, nome_bairro) VALUES (:cep, :nome_bairro)");
                $stmt->bindValue(':cep', $cep);
                $stmt->bindValue(':nome_bairro', $nome_bairro);
                $stmt->execute();
            }

        } catch (PDOException $e) {
            throw new Exception('Erro ao cadastrar CEP por bairro: ' . $e->getMessage());
        }
    }

    public function atualizarCliente(Cliente $cliente)
    {
        // Código para atualizar as informações do cliente no banco de dados
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("UPDATE cadastro SET nome_completo = :nome_completo, cpf = :cpf, cep = :cep, endereco = :endereco, numero = :numero, bairro = :bairro, cidade = :cidade, estado = :estado WHERE id = :id");
        $stmt->bindValue(':nome_completo', $cliente->getNomeCompleto(), PDO::PARAM_STR);
        $stmt->bindValue(':cpf', $cliente->getCpf(), PDO::PARAM_STR);
        $stmt->bindValue(':cep', $cliente->getCep(), PDO::PARAM_STR);
        $stmt->bindValue(':endereco', $cliente->getEndereco());
        $stmt->bindValue(':numero', $cliente->getNumero());
        $stmt->bindValue(':bairro', $cliente->getBairro());
        $stmt->bindValue(':cidade', $cliente->getCidade());
        $stmt->bindValue(':estado', $cliente->getEstado());

        $stmt->bindValue(':id', $cliente->getId(), PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function excluirCliente(Cliente $cliente)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            // Prepara a consulta SQL para excluir o cliente pelo ID
            $stmt = $conn->prepare("DELETE FROM cadastro WHERE id = :id");
            $stmt->bindValue(':id', $cliente->getId(), PDO::PARAM_INT);

            // Execute a consulta
            $stmt->execute();
        } catch (PDOException $e) {
            // Trata qualquer exceção lançada durante a consulta ao banco de dados
            throw new Exception('Erro ao excluir cliente: ' . $e->getMessage());
        }
    }

    public function buscarClientePorId($id)
    {
        try {
            $db = Database::getInstance();
            $conn = $db->getConnection();

            // Prepara a consulta SQL para buscar o cliente pelo ID
            $stmt = $conn->prepare("SELECT * FROM cadastro WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Verifica se a consulta está sendo preparada corretamente
            if (!$stmt) {
                var_dump($conn->errorInfo());
                return null;
            }

            // Execute a consulta
            $stmt->execute();

            // Verifique se o cliente foi encontrado
            if ($stmt->rowCount() > 0) {
                // Retorne os dados do cliente como um objeto da classe Cliente
                $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
                return $cliente;
            } else {
                // Se o cliente não for encontrado, retorna nulo
                return null;
            }
        } catch (PDOException $e) {
            // Trata qualquer exceção lançada durante a consulta ao banco de dados
            throw new Exception('Erro ao buscar cliente por ID: ' . $e->getMessage());
        }
    }
}