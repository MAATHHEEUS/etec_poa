<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../icon.png">
    <title>Casa de Massagem</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <?php
    include_once '../Controller/ControllerMassagem.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $MassagemController = new ControllerMassagem();

        // Atualizar
        if (isset($_POST['Submit'])) {
            $nome = $_POST['nome'];
            $valor = $_POST['valor'];
            $tipo = $_POST['tipo'];

            $MassagemController->updateMassagem($id, $nome, $valor, $tipo);
        }

        // Buscar
        $Massagem = $MassagemController->getMassagemById($id);

        if (!$Massagem) {
            echo 'MASSAGEM NÃO ENCONTRADA';
            exit;
        }else{
            // Monta os options do tipo
            if($Massagem['tipo'] == 'Completa'){
                $options = '<option value="Simples">Simples</option>
                <option value="Completa" selected>Completa</option>';
            }else{
                $options = '<option value="Simples" selected>Simples</option>
                <option value="Completa">Completa</option>';
            }
        }
    } else {
        echo 'ID NÃO FORNECIDO';
        exit;
    }
    ?>

    <form name="form1" method="post" action="">
        <table border="0">
            <tr>
                <td>Nome: </td>
                <td><input type="text" name="nome" value="<?php echo $Massagem['nome']; ?>"></td>
            </tr>
            <tr>
                <td>Valor: </td>
                <td><input type="number" name="valor" value="<?php echo $Massagem['valor']; ?>"></td>
            </tr>
            <tr>
                <td>Tipo: </td>
                <td>
                    <select name="tipo" id="tipo">
                        <?php echo $options; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="submit" name="Submit" value="Atualizar"></td>
                <td><button type='submit' formaction='../index.php'>Voltar</button></td>
            </tr>
        </table>
    </form>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</body>
</html>