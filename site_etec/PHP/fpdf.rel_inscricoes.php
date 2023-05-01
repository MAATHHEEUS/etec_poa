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
$curso = mysqli_real_escape_string($conn, $_GET['curso']);

# Faz a consulta dos dados para alimentar o PDF
$qry = "select tb1.id_inscricao, tb1.nome, tb1.cpf, tb1.dt_nasc, tb1.email, tb2.nome as curso
from tb_inscricoes tb1 join tb_cursos tb2 on tb2.id_curso = tb1.id_curso ";

if($curso != ''){
    $qry .= " where tb1.id_curso = '" . $curso ."'";
}

$qry .= " order by tb1.id_curso";

$resultset = mysqli_query($conn, $qry);

# Verifica se deu certo a consulta
if (!$resultset){
    echo "ERRO AO EXECUTAR A CONSULTA! CONTATE O SUPORTE COM UM PRINT DESTE ERRO!".$qry;
    return;
}

# Verifica se retornou linhas
$qntd = mysqli_num_rows($resultset);
if ($qntd <= 0) {
    echo "ERRO NÃO CONTÉM INSCRIÇÕES PARA O CURSO SELECIONADO!";
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
        $this->Cell(10,3,utf8_decode('Inscrição'),0,0,'R');
        $this->Cell(60,3,utf8_decode('Aluno'),0,0,'L');
        $this->Cell(27,3,utf8_decode('CPF'),0,0,'L');
        $this->Cell(25,3,utf8_decode('Nascimento'),0,0,'L');
        $this->Cell(60,3,utf8_decode('Email(@etec.sp.gov.br)'),0,0,'L');
        $this->Cell(20,3,utf8_decode('Curso'),0,0,'L');
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

$pdf = new PDF();
$pdf->setTitulo("Relação de Inscrições");
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);

while($row = mysqli_fetch_assoc($resultset)){
    $pdf->Cell(10,3,utf8_decode($row['id_inscricao']),0,0,'R');
    $pdf->Cell(60,3,utf8_decode(substr($row['nome'], 0, 60)),0,0,'L');
    $pdf->Cell(27,3,utf8_decode($row['cpf']),0,0,'L');
    $pdf->Cell(25,3,utf8_decode(converteData('padrao', $row['dt_nasc'])),0,0,'L');
    $pdf->Cell(60,3,utf8_decode(str_replace("@etec.sp.gov.br","",$row['email'])),0,0,'L');
    $pdf->Cell(60,3,utf8_decode($row['curso']),0,1,'L');
}

$pdf->Output('I', 'rel_inscricoes.pdf');
?>