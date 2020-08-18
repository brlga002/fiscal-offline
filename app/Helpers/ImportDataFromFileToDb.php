<?php

namespace App\Helpers;

use PDO;
use PDOException;

class ImportDataFromFileToDb
{
    

    public function upload(string $arquivo,$tabela): void
    {
        $arquivo = fopen(__DIR__. "/../../storage/app/uploads/{$arquivo}",'r');
        $conteudoArquivo = "" ;

        if ($arquivo) {
            while(true) {
                $linha = fgets($arquivo);
                if ($linha==null) break;
                $temp = str_replace("\r\n", "", $linha);
                $temp = str_replace("<html><body>", "", $temp);
                $temp = str_replace("<table border='0'>", "", $temp);
                $temp = str_replace("</table></body></html>", "", $temp);
                $temp = str_replace("</tr>", "\n", $temp);
                $conteudoArquivo .= $temp;
            }
            $conteudoArquivo = str_replace("<tr><th nowrap>", '("', $conteudoArquivo);
            $conteudoArquivo = str_replace("</th><th nowrap>", '","', $conteudoArquivo);
            $conteudoArquivo = str_replace("</th>", '")', $conteudoArquivo);
            fclose($arquivo);
        }

        //criamos o arquivo
        $arquivo = fopen(__DIR__. '/../../storage/app/uploads/resultado.txt','w');
        if ($arquivo == false) die('Não foi possível criar o arquivo.');
        fwrite($arquivo, $conteudoArquivo);
        fclose($arquivo);

       // Aqui você abre e lê o arquivo
        $arquivo = fopen (__DIR__. '/../../storage/app/uploads/resultado.txt','r');
        $data = array();
        while(!feof($arquivo)){
            $data[] = utf8_encode(fgets($arquivo));
        }
        fclose($arquivo);

        $colunas = $data[0];
        unset($data[0]);

        $this->bigInsertData($colunas,$tabela,$data);

    }

    public function bigInsertData(string $colunas,string $tabela,array $data)
    {
        $colunas = $this->ajustaNomeColunas($colunas);
        //echo $colunas;
        //die;
        $maximo = 10;
        $contagem = 1;
        $arrTempValues = array();
        $sqlResult = "";


        $sqlHeader =  "INSERT INTO {$tabela} $colunas VALUES ";

        $pdo = new PDO(
            env('DB_CONNECTION').':host='.env('DB_HOST').
            ';dbname='. env('DB_DATABASE'),
            env('DB_USERNAME'),
            env('DB_PASSWORD')
            );

        try{
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("TRUNCATE TABLE `{$tabela}`");
            $stmt->execute();

            foreach ($data as $linha => $linhaAtual) {
                if ($contagem == $maximo) {

                    if($linhaAtual !== "") $arrTempValues[] = $linhaAtual;
                    $sqlResult = $sqlHeader . implode(",", $arrTempValues) . ";";
                    $stmt = $pdo->prepare($sqlResult);
                    $stmt->execute();

                    $sqlResult = "";
                    $arrTempValues = array();
                    $contagem = 0;
                } else {
                    if($linhaAtual !== "") $arrTempValues[] = $linhaAtual;
                }
                $contagem ++;
            }

            if ($arrTempValues !== array()){
                    $sqlResult = $sqlHeader . implode(",", $arrTempValues) . ";";
                    //echo $sqlResult . "<br><br>";;
                    $stmt = $pdo->prepare($sqlResult);
                    $stmt->execute();
            }

        } catch(Exception $e){
           echo $e->getMessage();
           $pdo->rollBack();
        }
    }

    public function ajustaNomeColunas($string): String
    {
        //$string = utf8_encode($string);
        $comAcentos = array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','O','Ù','Ü','Ú');
        $semAcentos = array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','O','U','U','U');
        $string =  str_replace($comAcentos, $semAcentos, $string);

        $string = str_replace("Ó", "O", $string);
        $string = str_replace(" DE ", "_", $string);
        $string = str_replace(" DO ", "_", $string);
        $string = str_replace("-", "", $string);
        $string = str_replace("/", "_", $string);
        $string = str_replace("  ", "_", $string);
        $string = str_replace(" ", "_", $string);
        $string = str_replace('"', "`", $string);
        $string = strtolower($string);
        return $string;
    }

}
