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
    include_once '../Controller/ControllerAgendamentos.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $ControllerAgendamentos = new ControllerAgendamentos();

        // Atualizar
        if (isset($_POST['Submit'])) {
            $id_massagista = $_POST['id_massagista'];
            $id_massagem = $_POST['id_massagem'];
            $data_hr = $_POST['data_hr'];

            $ControllerAgendamentos->updateAgendamento($id, $id_massagista, $id_massagem, $data_hr);
        }

        // Buscar
        $Agendamento = $ControllerAgendamentos->getAgendamentoById($id);

        if (!$Agendamento) {
            echo 'AGENDAMENTO NÃO ENCONTRADO';
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
                <td>Massagista: </td>
                <td><select name='id_massagista' id='id_massagista' value="<?php echo $Agendamento['id_massagista']; ?>"><?php echo $ControllerAgendamentos->buscaMassagistas(); ?></select></td>
            </tr>
            <tr>
                <td>Massagem: </td>
                <td><select name='id_massagem' id='id_massagem' value="<?php echo $Agendamento['id_massagem']; ?>"><?php echo $ControllerAgendamentos->buscaMassagens(); ?></select></td>
            </tr>
            <tr>
                <td>Data e Hora: </td>
                <td>
                    <input type="datetime-local" name="data_hr" id="data_hr" value="<?php echo $Agendamento['data_hr']; ?>">
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