<?php

require_once '../classes/Database.php';

class Cliente
{
    private $id;
    private $nome_completo;
    private $cpf;
    private $cep;
    private $endereco;
    private $numero;
    private $bairro;
    private $cidade;
    private $estado;
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNomeCompleto()
    {
        return $this->nome_completo;
    }

    public function setNomeCompleto($nome_completo)
    {
        $this->nome_completo = $nome_completo;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        // Remove caracteres não numéricos do CPF
        $cpf = preg_replace('/[^0-9]/', '', $cpf);

        // Verifica se o CPF tem 11 dígitos
        if (strlen($cpf) !== 11) {
            throw new Exception('CPF inválido. O CPF deve conter exatamente 11 dígitos.');
        }

        // Verifica se o CPF possui todos os números iguais
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            throw new Exception('CPF inválido. O CPF não pode ter todos os números iguais.');
        }

        // Verificação dos dígitos verificadores do CPF
        for ($i = 9; $i < 11; $i++) {
            $soma = 0;
            for ($j = 0; $j < $i; $j++) {
                $soma += $cpf[$j] * (($i + 1) - $j);
            }
            $resto = $soma % 11;
            $digito = ($resto < 2) ? 0 : 11 - $resto;
            if ($cpf[$i] != $digito) {
                throw new Exception('CPF inválido. O número do CPF não é válido.');
            }
        }

        // Se a validação passou, armazena o CPF no atributo da classe
        $this->cpf = $cpf;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
}