<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta charset="utf-8" />
  <title>Crud txt em PHP</title>
</head>

<body>

  <form method="get" name="dados" action="enviar_get.php" onSubmit="return enviardados();">
    <center>
      <h1>Formulário - Incluir registro</h1>
    </center>
    <table width="588" border="0" align="center">
      <tr>
        <td width="118">
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Nome completo:</font>
        </td>
        <td width="460">
          <input name="nome" type="text" class="formbutton" id="nome" size="52" maxlength="150">
        </td>
      </tr>

      <tr>
        <td>
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">E-mail:</font>
        </td>
        <td>
          <font size="2">
            <input name="email" type="text" id="email" size="52" maxlength="150" class="formbutton">
          </font>
        </td>
      </tr>
      <tr>
        <td>
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Data:</font>
        </td>
        <td>
          <font size="2">
            <input name="data" type="date" id="data" class="formbutton">
          </font>
        </td>
      </tr>

      <tr>
        <td>
          <font face="Verdana, Arial, Helvetica, sans-serif">
            <font size="1">Mensagem: </font>
          </font>
        </td>
        <td rowspan="2">
          <font size="2">
            <textarea name="mensagem" cols="50" rows="8" class="formbutton" id="mensagem" input></textarea>
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