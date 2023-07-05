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
    $massagemController = new ControllerMassagem();

    if(isset($_POST['Submit'])) {
        $massagemController->addMassagem();       
    }
    ?>

    <form method="post" name="form1" action="">
        <center>
            <h1>Formulário - Incluir Massagens</h1>
        </center> 
        <table width="588" border="0" align="center">
            <tr>
                <td width="118">
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Nome:</font>
                </td>
                <td width="460">
                    <input name="nome" type="text" class="formbutton" id="nome" size="52" maxlength="150">
                </td>
            </tr>

            <tr>
                <td>
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Valor R$:</font>
                </td>
                <td>
                    <font size="2">
                        <input name="valor" type="number" id="valor" size="05" maxlength="150" class="formbutton">
                    </font>
                </td>
            </tr>
            <tr>
                <td>
                    <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Tipo:</font>
                </td>
                <td>
                    <font size="2">
                        <select name="tipo" id="tipo">
                            <option value="Simples">Simples</option>
                            <option value="Completa">Completa</option>
                        </select>
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