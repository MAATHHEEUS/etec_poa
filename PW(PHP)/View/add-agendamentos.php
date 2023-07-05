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
    $ControllerAgendamentos = new ControllerAgendamentos();

    if(isset($_POST['Submit'])) {
        $ControllerAgendamentos->addAgendamento();       
    }
    ?>

    <form method="post" name="form1" action="">
        <center>
            <h1>Formulário - Incluir Agendamentos</h1>
        </center> 
        <table width="588" border="0" align="center">
            <tr>
                <td width="118">
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Massagista:</font>
                </td>
                <td width="460">
                    <select name='id_massagista' id='id_massagista'><?php echo $ControllerAgendamentos->buscaMassagistas(); ?></select>
                </td>
            </tr>

            <tr>
                <td>
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Massagem:</font>
                </td>
                <td>
                    <select name='id_massagem' id='id_massagem'><?php echo $ControllerAgendamentos->buscaMassagens(); ?></select>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Data e Hora:</font>
                </td>
                <td>
                    <font size="2">
                        <input type="datetime-local" name="data_hr" id="data_hr">
                    </font>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <input type="submit" name="Submit" value="Cadastrar">
                    <button type='submit' formaction='../index.php'>Voltar</button>
                </td>
            </tr>
        </table>
    </form>
    <script src="https://www.w3schools.com/lib/w3.js"></script>
</body>
</html>