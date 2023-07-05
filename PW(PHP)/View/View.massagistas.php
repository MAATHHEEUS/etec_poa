<body>
    <?php
    include_once '../Controller/ControllerMassagistas.php';
    $ControllerMassagistas = new ControllerMassagistas();
    $Massagistas = $ControllerMassagistas->viewMassagistas();
    ?>

    <h2 size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif;margin-bottom: 40px;">Consulta de Massagistas</h2>
    
    <table width='80%' border=0 align='center' style="font-weight: bold;color: darkblue;">
        <tr bgcolor='#CCCCCC'>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Código</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Nome</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Data de Nascimento</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Contato</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Ações</strong></font>
            </td>
        </tr>
        <?php
        foreach ($Massagistas as $Massagista) {
            echo "<tr>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagista['id'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagista['nome'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagista['dataNasc'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Massagista['contato'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'><a href=\"View/edit-massagista.php?id={$Massagista['id']}\" style='color: greenyellow;font-weight: bold;text-decoration: none;background: black;padding: 5px;border-radius: 10px;margin: 5px;''>Editar</a> | <a href=\"View/delete-massagista.php?id={$Massagista['id']}\" style='color: red;font-weight: bold;text-decoration: none;background: black;padding: 5px;border-radius: 10px;margin: 5px;''>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif;margin-top: 40px;color: gold;background: black;border-radius: 10px;font-weight: bold;" class="styled-button" onclick="window.location.href='View/add-massagista.php'">Adicionar Novo Massagista</button>
</body>