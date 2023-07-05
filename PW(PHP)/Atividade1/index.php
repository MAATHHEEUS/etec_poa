<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cadastro de Times</title>
</head>

<body>

  <form method="get" name="dados" action="enviar_get.php">
    <center>
      <h1>Formulário - Incluir registro</h1>
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
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Abreviação:</font>
        </td>
        <td>
          <font size="2">
            <input name="abreviacao" type="text" id="abreviacao" size="52" maxlength="3" class="formbutton">
          </font>
        </td>
      </tr>
      <tr>
        <td>
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Fundação:</font>
        </td>
        <td>
          <font size="2">
            <input name="fundacao" type="date" id="fundacao" class="formbutton">
          </font>
        </td>
      </tr>
      
      <tr>
        <td>
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Cor primária:</font>
        </td>
        <td>
          <font size="2">
            <input name="cor1" type="text" id="cor1" class="formbutton">
          </font>
        </td>
      </tr>

      <tr>
        <td>
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Cor secundária:</font>
        </td>
        <td>
          <font size="2">
            <input name="cor2" type="text" id="cor2" class="formbutton">
          </font>
        </td>
      </tr>

      <tr>
        <td>
          <font face="Verdana, Arial, Helvetica, sans-serif">
            <font size="1">Observações:</font>
          </font>
        </td>
        <td rowspan="2">
          <font size="2">
            <textarea name="obs" cols="50" rows="8" class="formbutton" id="obs" input></textarea>
          </font>
        </td>
      </tr>

      <tr></tr>

      <tr>
        <td height="22"></td>
        <td>
          <input name="Submit" type="submit" class="formobjects" value="Cadastrar">
          <input name="Reset" type="reset" class="formobjects" value="Limpar campos">
          <button type='submit' formaction='pegar.php'>Consultar</button>
        </td>
      </tr>
    </table>
  </form>

</body>

</html>