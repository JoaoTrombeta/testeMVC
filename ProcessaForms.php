<?php
include("./controller/almoxarifPCP.php");

echo $_POST["FormProc"];
if ($_POST["FormProc"] == "editarComposicao") {

    /*if ($proceder == 0) {
            foreach ($_POST["cod_componente"] as $key => $value) {
                # code...
                }
                }*/
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codComp'])) {
        $proceder = DeleteCompPCP($_POST["CodProd"]);
        $URLRetorno = $_POST["URLRetorno"];
        $CodProd = $_POST["CodProd"];
        $Modelo = $_POST["Modelo"];


        $numLinhas = count($_POST['codComp']);


        for ($i = 0; $i < $numLinhas; $i++) {
            $codComp = htmlspecialchars($_POST['codComp'][$i] ?? '');
            $componente = htmlspecialchars($_POST['componente'][$i] ?? '');
            $qtdUtilizada = htmlspecialchars($_POST['qtdUtilizada'][$i] ?? '');
            $local = htmlspecialchars($_POST['Local'][$i] ?? '');
            $armazem = htmlspecialchars($_POST['Armazem'][$i] ?? '');

            InsertCompPCP($Modelo, $CodProd, $codComp, $componente, $qtdUtilizada, $local, $armazem);
        }
        header('location:' . $URLRetorno);
    } else {
        header('location:' . $URLRetorno);
    }
}elseif($_POST["FormProc"] == "RegistroComent"){
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codProd']) && isset($_POST['coment'])) {
        $URLRetorno = $_POST["URLRetorno"];
        $codProd = htmlspecialchars($_POST['codProd'] ?? '');
        $coment = htmlspecialchars($_POST['coment'] ?? '');

        InsertComentAlmx($codProd, $coment);
        header('location:' . $URLRetorno);
    } else {
        header('location:' . $URLRetorno);
    }
}
