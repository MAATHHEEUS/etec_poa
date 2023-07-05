<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <title>Casa de Massagem</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
</head>
<body style="background-image: url('imgback.png'); background-repeat: no-repeat; background-size: cover;" >
    <!-- Menu -->
    <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
        <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Fechar &times;</button>
        <a onclick="$('#pagPrincipal').load('principal.html');" class="w3-bar-item w3-button">Principal</a>
        <a onclick="$('#pagPrincipal').load('View/View.massagem.php');" class="w3-bar-item w3-button">Massagens</a>
        <a onclick="$('#pagPrincipal').load('View/View.massagistas.php');" class="w3-bar-item w3-button">Massagistas</a>
        <a onclick="$('#pagPrincipal').load('View/View.agendamento.php');" class="w3-bar-item w3-button">Agendamentos</a>
    </div>

    <!-- Conteudo -->
    <div id="main">
        <div class="w3-teal">
            <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
            <div class="w3-container">
                <h1>Projeto POO - MVC</h1>
            </div>
        </div>

        <div class="w3-container w3-padding-64" id="pagPrincipal">
            <h1>Casa de Massagem</h1>
            <p class="w3-wide" style="font-weight: bold;color: darkblue;">Projeto desenvolvido com objetivo de demonstrar meus conhecimentos em PHP aplicando os conceitos orientados pelo professor de Programação Web e Banco de Dados.</p>
            <p class="w3-wide" style="font-weight: bold;color: darkblue;">MVC - Model, View, Controller</p>
            <p class="w3-wide" style="font-weight: bold;color: darkblue;">POO - Programação Orientada a Objeto</p>
            <p class="w3-wide" style="font-weight: bold;color: darkblue;">Aqui você pode cadastrar massagistas, massagens e fazer agendamentos!</p>
            <p class="w3-wide" style="font-weight: bold;color: darkblue;">Nos agendamentos temos duas relações com os massagistas e as massagens cadastradas</p>
        </div>
    </div>

    
    <script src="https://www.w3schools.com/lib/w3.js"></script>
    <script src="script.js"></script>
</body>
</html>
