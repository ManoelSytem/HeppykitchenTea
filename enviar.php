<?php

$nome = $_GET['nome'];
$telefone = $_GET['tel'];
$mensagem = $_GET['mesagem'];
$product =  $_GET['produto'];
$dadoConvidado = $nome.";".$telefone.";".$mensagem.";".$product.";";

echo $dadoConvidado;
 
AdicionarLinha("convidados.txt", $linhas, $dadoConvidado);

function AdicionarLinha($arquivo, $numeroLinha, $conteudo){
    $arquivoTemporario = "novo";
    $linhaAtual = 0;

    $fpRead  = fopen($arquivo, 'r');
    $fpWrite = fopen($arquivoTemporario, 'w');

    try{
        if ($fpRead) {
            while (($linha = fgets($fpRead)) !== false) {
                if ($linhaAtual == $numeroLinha){
                    $linha .= $conteudo . PHP_EOL; // Para substituir, use "="
                }

                fwrite($fpWrite, $linha);
                $linhaAtual += 1;       
            }
        }
    }
    catch (Exception $err) {
        echo $err->getMessage() . PHP_EOL;
    }
    finally {
        fclose($fpRead);
        fclose($fpWrite);

        unlink($arquivo); // Para deletar o arquivo original
        rename($arquivoTemporario, $arquivo); // Para renomear o arquivo
        return true;
    }
}
?>