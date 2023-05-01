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
$periodo = mysqli_real_escape_string($conn, $_GET['periodo']);

switch ($periodo) {
    case 'semana':
        $data = new DateTime(' -7 days');
        $data = $data->format('Y-m-d');
        break;
    case 'mes':
        $data = new DateTime(' -1 month');
        $data = $data->format('Y-m-d');
        break;
    case 'meses':
        $data = new DateTime(' -3 month');
        $data = $data->format('Y-m-d');
        break;

    case 'ano':
        $data = new DateTime(' -1 year');
        $data = $data->format('Y-m-d');
        break;
}

# Faz a consulta dos dados para alimentar o PDF
$qry = "select * from tb_denuncias
where dtcad >='" . $data ."' order by 1";

$resultset = mysqli_query($conn, $qry);

# Verifica se deu certo a consulta
if (!$resultset){
    echo "ERRO AO EXECUTAR A CONSULTA! CONTATE O SUPORTE COM UM PRINT DESTE ERRO!";
    return;
}

# Verifica se retornou linhas
$qntd = mysqli_num_rows($resultset);
if ($qntd <= 0) {
    echo "ERRO NÃO CONTÉM DENÚNCIAS OU SUGESTÕES PARA O PERÍODO SELECIONADO!";
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
        $this->Cell(20,3,utf8_decode('Data'),0,0,'L');
        $this->Cell(160,3,utf8_decode('Descrição'),0,0,'L');
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
$pdf->setTitulo("Relação de Denúncias e Sugestões");
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Times','',12);

while($row = mysqli_fetch_assoc($resultset)){
    $pdf->Cell(20,3,utf8_decode(converteData('padrao', $row['dtcad'])),0,0,'R');
    $pdf->MultiCell(160,3,utf8_decode($row['descricao']),0,'L', );
    $pdf->ln(3);
}

$pdf->Output('I', 'rel_denuncias&sugestoes.pdf');
?>