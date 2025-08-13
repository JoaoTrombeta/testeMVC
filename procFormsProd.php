<?php
    include("./controller/producaoPCP.php");
    date_default_timezone_set("America/Sao_Paulo");
    $URLRetorno = $_POST["URLRetorno"];

    $Nop = $_POST['op'];
    $NSi = $_POST['NS1'];
    $NSf = $_POST['NS2'];
    $Gi = $_POST['G1'];
    $Gf = $_POST['G2'];
    $qtd = $_POST['quantidade'];
    $codprod = $_POST['codigo'];
    $modelo = $_POST['modelo'];
    $Emp = $_POST['empresa'];
    $Di = $_POST['data_inicio'];
    $Df = $_POST['data_fim'];
    $Col = $_POST['colabs'];
    $IM = $_POST['RevIM'];
    $DataRegistro = date('Y-m-d');

    $busca = buscaProdutoPCP($codprod);
    $qtdGarantias = $busca['garantias'];

    if($Gi != 'Garantias Aleatórias') {
        $SepararGarantia = separarTextoNumeros($_POST['G1']);
        
        
        $TextoGar = $SepararGarantia['texto'];
        $NumGar = $SepararGarantia['numeros'];
        $comprimento = strlen($SepararGarantia['numeros']);
    }
    
    if($NSi != 'Números Aleatórios') {
        $SepararNS1 = separarTextoNumeros($_POST['NS1']);
        $SepararNS2 = separarTextoNumeros($_POST['NS2']);
        echo $_POST['NS1'] . " - " . $_POST['NS2'] . "<br>";


        $TextoNS = $SepararNS1['texto'];
        $NumNS1 = $SepararNS1['numeros'];
        $NumNS2 = $SepararNS2['numeros'];
        $garCont = 1;
        while ($NumNS1 <= $NumNS2) {
    
            $NumeroSerial = $TextoNS . $NumNS1;
            while ($garCont <= $qtdGarantias) {
                while(strlen($NumGar) != $comprimento){
                    $NumGar = "0" . $NumGar;
                }
                if($garCont == 1){
                    if($qtdGarantias > 1){
                        $vetGar = "['".$TextoGar . $NumGar."',";
                    }else{
                        $vetGar = "['".$TextoGar . $NumGar."']";
                    }
                }elseif($garCont < $qtdGarantias) {
                    $vetGar = $vetGar . "'".$TextoGar . $NumGar."',";
                }else{
                    $vetGar = $vetGar ."'".$TextoGar . $NumGar."']";
                }
                $garCont++;
                $NumGar++;
            }
            echo "Produto: " . $codprod . " - Modelo: " . $modelo . " - NºOP: " . $Nop . " - NºSerial: " . $NumeroSerial . " - Garantias: " . $vetGar;
            SalvarDadosProduto($codprod, $modelo, $DataRegistro, $Emp, $Nop, $NumeroSerial, $vetGar) ;
            $garCont = 1;
            echo"<br>";
            $NumNS1++;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
        GerarProductOrder($Nop, $NSi, $NSf, $Gi, $Gf, $qtd, $codprod, $modelo, $Emp, $Di, $Df, $Col, $IM);
        header('location:'.$URLRetorno);
    } else {
        header('location:'.$URLRetorno);
    }

    function separarTextoNumeros($Separar)
    {
        // A expressão regular para capturar texto e números:
        // ^([a-zA-Z]+) : Captura um ou mais caracteres de letra (a-z, A-Z) no INÍCIO da string.
        // (\d+)$      : Captura um ou mais dígitos (\d) no FIM da string.
        $pattern = '/^([a-zA-Z]+)(\d+)$/';

        $matches = [];
        if (preg_match($pattern, $Separar, $matches)) {
            // $matches[0] será a string completa ("AB123123")
            // $matches[1] será a primeira parte capturada (as letras - "AB" ou "CDE")
            // $matches[2] será a segunda parte capturada (os números - "123123")
            return [
                'texto' => $matches[1],
                'numeros' => $matches[2]
            ];
        } else {
            // Se a string não corresponder ao padrão esperado (ex: "123AB" ou "ABC" ou "123")
            // Você pode retornar um array vazio, null, ou um array com valores padrão/erro.
            // Depende de como você quer tratar strings que não seguem o formato.
            return [
                'texto' => '', // Ou null
                'numeros' => '' // Ou null
            ];
        }
    }