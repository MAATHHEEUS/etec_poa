<?php
require('../../../fpdf/fpdf.php');
include_once "conexao.php";

# Checa a conexão com banco
if($conect == false){
    echo json_encode(array(
        'tipo' => 'E',
        'msg' => $error
    ));
    return;
}

# Pega o usuario pela url para usar na consulta
$id_usuario = $_GET['usuario'];

# Faz a consulta dos dados para alimentar o PDF
$qry = "select tb1.id_inscricao as num_inscricao, tb1.nome, tb1.cpf, tb1.mae, tb1.rg, tb1.uf, dt_nasc, tb1.nome_resp, tb1.cpf_resp, tb1.email,
tb2.nome as curso, tb2.resumo, tb2.tipo, tb2.periodo, tb2.diassemana
from tb_inscricoes tb1 join tb_cursos tb2 on tb2.id_curso = tb1.id_curso
join tb_usuarios tb3 on tb3.email = tb1.email
where tb3.usuario_id =" . $id_usuario;

$resultset = mysqli_query($conn, $qry);

# Verifica se deu certo a consulta
if (!$resultset){
    echo "Erro ao consultar o Email. " . mysqli_error($conn);
    return;
}

# Verifica se retornou linhas
$qntd = mysqli_num_rows($resultset);
if ($qntd <= 0) {
    echo "ERRO USUÁRIO NÃO ENCONTRADO!";
    return;
}

$row = mysqli_fetch_assoc($resultset);

#Monta o PDF
class PDF extends FPDF{
    // Page header
    function Header() {
        $today = getdate();
        $dtAtual = $today['mday']."/".$today['mon']."/".$today['year'];
        // Logo
        $this->Image('../../imagens/logotipo-etec.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,utf8_decode('Declaração de Matrícula'),0,0,'C');
        $this->Cell(55);
        // Data Atual
        $this->SetFont('Arial','',8);
        $this->Cell(30,10,utf8_decode('Emitido em: '.$dtAtual),0,0,'C');
        // Line break
        $this->Ln(20);
    }

    // Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        // Marca d'água
        $this->Image('../../imagens/logo-governo.png',70,150,30);
        $this->Image('../../imagens/logotipo-cps.png',100,150,30);
    }
}
$pdf = new PDF();
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);
$pdf->MultiCell(190,10,utf8_decode("Declaramos que o Aluno: " . $row['nome'] . ", portador do CPF de nº: " . $row['cpf'] . ", está inscrito na Instituição ETEC-Poá sob a inscrição de nº: " . $row['num_inscricao'] . ", no presente curso '" . $row['curso'] . "' no período: " . $row['periodo'] . " de " . $row['diassemana']),0,1);
$pdf->Output('I', 'dec_matricula.pdf');
?>