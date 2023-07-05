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
    include_once '../Controller/ControllerMassagistas.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $ControllerMassagistas = new ControllerMassagistas();

        // Atualizar
        if (isset($_POST['Submit'])) {
            $nome = $_POST['nome'];
            $dataNasc = $_POST['dataNasc'];
            $contato = $_POST['contato'];
            
            $ControllerMassagistas->updateMassagista($id, $nome, $dataNasc, $contato);
        }

        // Buscar
        $Massagista = $ControllerMassagistas->getMassagistaById($id);

        if (!$Massagista) {
            echo 'MASSAGISTA NÃO ENCONTRADO';
            exit;
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
                <td><input type="text" name="nome" value="<?php echo $Massagista['nome']; ?>"></td>
            </tr>
            <tr>
                <td>Data de Nascimento: </td>
                <td><input type="date" name="dataNasc" value="<?php echo $Massagista['dataNasc']; ?>"></td>
            </tr>
            <tr>
                <td>Contato: </td>
                <td><input type="text" name="contato" value="<?php echo $Massagista['contato']; ?>"></td>
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