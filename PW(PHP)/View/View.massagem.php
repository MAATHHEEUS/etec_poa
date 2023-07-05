<body>
    <?php
    
    include_once '../Controller/ControllerMassagem.php';
    $MassagemController = new ControllerMassagem();
    $Massagems = $MassagemController->viewMassagems();
    ?>

    <h2 size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif;margin-bottom: 40px;">Consulta de Massagens</h2>
    
    <table width='80%' border=0 align='center' style="font-weight: bold;color: darkblue;">
        <tr bgcolor='#CCCCCC'>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Código</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Nome</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Valor</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Tipo</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Ações</strong></font>
            </td>
        </tr>
        <?php
        foreach ($Massagems as $Massagem) {
            echo "<tr>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagem['id'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagem['nome'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagem['valor'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagem['tipo'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'><a href=\"View/edit-massagem.php?id={$Massagem['id']}\" style='color: greenyellow;font-weight: bold;text-decoration: none;background: black;padding: 5px;border-radius: 10px;margin: 5px;''>Editar</a> | <a href=\"View/delete-massagem.php?id={$Massagem['id']}\" style='color: red;font-weight: bold;text-decoration: none;background: black;padding: 5px;border-radius: 10px;margin: 5px;''>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif;margin-top: 40px;color: gold;background: black;border-radius: 10px;font-weight: bold;" class="styled-button" onclick="window.location.href='View/add-massagens.php'">Adicionar Nova Massagem</button>
</body>