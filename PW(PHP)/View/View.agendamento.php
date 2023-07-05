<body>
    <?php
    include_once '../Controller/ControllerAgendamentos.php';
    $ControllerAgendamentos = new ControllerAgendamentos();
    $Agendamentos = $ControllerAgendamentos->viewAgendamentos();
    ?>

    <h2 size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif;margin-bottom: 40px;">Consulta de Agendamentos</h2>

    <table width='80%' border=0 align='center' style="font-weight: bold;color: darkblue;">
        <tr bgcolor='#CCCCCC'>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Código</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Data e Hora</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Massagista</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Contato</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Massagem</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>R$</strong></font>
            </td>
            <td>
                <font size="3" face="Verdana, Arial, Helvetica, sans-serif"><strong>Ações</strong></font>
            </td>
        </tr>
        <?php
        foreach ($Agendamentos as $Agendamento) {
            echo "<tr>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Agendamento['id'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Agendamento['data_hr'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Agendamento['massagista'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Agendamento['contato'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Agendamento['massagem'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'>" . $Agendamento['valor'] . "</td>";
            echo "<td size='1' style='font-family: Verdana, Arial, Helvetica, sans-serif;'><a href=\"View/edit-agendamento.php?id={$Agendamento['id']}\" style='color: greenyellow;font-weight: bold;text-decoration: none;background: black;padding: 5px;border-radius: 10px;margin: 5px;'>Editar</a> | <a href=\"View/delete-agendamento.php?id={$Agendamento['id']}\" style='color: red;font-weight: bold;text-decoration: none;background: black;padding: 5px;border-radius: 10px;margin: 5px;''>Excluir</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <button size="1" style="font-family: Verdana, Arial, Helvetica, sans-serif;margin-top: 40px;color: gold;background: black;border-radius: 10px;font-weight: bold;" class="styled-button" onclick="window.location.href='View/add-agendamentos.php'">Adicionar Novo Agendamento</button>
</body>