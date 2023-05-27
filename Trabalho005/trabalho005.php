<?php
include("../classes/banco.php");

class Cliente extends Banco{
    public $nome;
    public $cpf;
    private $possui_emprestimo = false;
    private $valor_emprestimo;

    public function emprestimo($valor)
    {
        if ($this->possui_emprestimo)
        {
            echo "<br/>Infelizmente não podemos " .
                 "abrir outro emprestimo";
        }
        else {
            $this->possui_emprestimo = true;
            $this->valor_emprestimo = $valor;
            $this->depositar($valor);
        }
    }

    public function quitar_emprestimo($valor)
    {
        if (!$this->possui_emprestimo)
        {
            echo "<br/>Não há empréstimo para quitar.";
        }
        else {
            if ($valor == $this->valor_emprestimo)
            {
                $this->saldo -= $valor;
                
                if ($this->saldo >= 0) {
                    $this->possui_emprestimo = false;
                    $this->valor_emprestimo = 0;
                    echo "<br/>Empréstimo quitado. Seu saldo atual é R$ " . $this->saldo;
                    $this->emprestimo(10000); // novo empréstimo após quitação bem-sucedida
                } else {
                    echo "<br/>Saldo insuficiente para quitar o empréstimo.";
                }
            }
            else
            {
                echo "<br/>Valor de quitação incorreto, o valor correto é R$ " . $this->valor_emprestimo;
            }
        }
    }
}

$pessoa = new Cliente();
$pessoa->nome = "Josefina";
$pessoa->cpf  = "1111111";
$pessoa->saldo = 1000;
$pessoa->depositar(800);

echo "<br/>O saldo atual de pessoa é R$" . $pessoa->saldo;

$pessoa->emprestimo(7000);

echo "<br/>O saldo atual de pessoa é R$" . $pessoa->saldo;

$pessoa->quitar_emprestimo(7000);

echo "<br/>O saldo atual de pessoa é R$" . $pessoa->saldo;

?>
