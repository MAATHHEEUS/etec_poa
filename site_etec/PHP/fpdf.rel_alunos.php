<?php

require('./../../fpdf/fpdf.php');
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
$id_usuario = mysqli_real_escape_string($conn, $_GET['usuario']);
$materia = mysqli_real_escape_string($conn, $_GET['materia']);

# Faz a consulta dos dados para alimentar o PDF
$qry = "select tb1.id_inscricao as num_inscricao, tb1.nome, tb1.cpf, tb1.mae, tb1.rg, tb1.uf, dt_nasc, tb1.nome_resp, tb1.cpf_resp, tb1.email,
tb2.nome as curso, tb2.resumo, tb2.tipo, tb2.periodo, tb2.diassemana
from tb_inscricoes tb1 join tb_cursos tb2 on tb2.id_curso = tb1.id_curso
where tb2.id_curso =" . $materia ." order by tb1.nome";

$resultset = mysqli_query($conn, $qry);

# Verifica se deu certo a consulta
if (!$resultset){
    echo "ERRO AO EXECUTAR A CONSULTA! CONTATE O SUPORTE COM UM PRINT DESTE ERRO!";
    return;
}

# Verifica se retornou linhas
$qntd = mysqli_num_rows($resultset);
if ($qntd <= 0) {
    echo "ERRO CURSO NÃO CONTÉM ALUNOS INSCRITOS!";
    return;
}

#Monta o PDF
class PDF extends FPDF{
    private $titulo;

    //Gets e Sets
    function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    function getTitulo(){
        return $this->titulo;
    }
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
        $this->Cell(30,10,utf8_decode($this->getTitulo()),0,0,'C');
        $this->Cell(55);
        // Data Atual
        $this->SetFont('Arial','',8);
        $this->Cell(30,10,utf8_decode('Emitido em: '.$dtAtual),0,0,'C');
        // Line break
        $this->Ln(20);
        //Cabeçalho
        $this->SetFont('Arial','B',8);
        $this->Cell(10,3,utf8_decode('Matrícula'),0,0,'R');
        $this->Cell(60,3,utf8_decode('Aluno'),0,0,'L');
        $this->Cell(80,3,utf8_decode('Email(@etec.sp.gov.br)'),0,0,'L');
        $this->Cell(30,3,utf8_decode('Data Nasc.'),0,0,'L');
        //Line break
        $this->Ln(5);
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

# Faz a consulta para buscar o nome do curso
$qry = "select nome
from tb_cursos
where id_curso =" . $materia;

$res = mysqli_query($conn, $qry);

$row = mysqli_fetch_assoc($res);

$curso = $row['nome'];

$pdf = new PDF();
$pdf->setTitulo("Relação de Alunos ".$curso);
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);

while($row = mysqli_fetch_assoc($resultset)){
    $pdf->Cell(10,3,utf8_decode($row['num_inscricao']),0,0,'R');
    $pdf->Cell(60,3,utf8_decode(substr($row['nome'], 0, 60)),0,0,'L');
    $pdf->Cell(80,3,utf8_decode(str_replace("@etec.sp.gov.br","",$row['email'])),0,0,'L');
    $pdf->Cell(30,3,utf8_decode(converteData('padrao', $row['dt_nasc'])),0,1,'L');
}

$pdf->Output('I', 'rel_alunos.pdf');
?>