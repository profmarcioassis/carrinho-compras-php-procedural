<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras procedural</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
</head>

<body>
    <div class="container m-5 mx-auto">
        <header>
            <h1 class="text-center">Lista de produtos cadastrados</h1>
            <hr>
        </header>
        <div class="row">
            <?php
            require_once 'conexao.php';
            $sql = "SELECT * FROM produtos ORDER BY id";
            $dados = $conn->query($sql) or die("Erro ao executar comando: " . mysqli_error($conn));
            while ($produto = $dados->fetch_assoc()) {
            ?>
                <div class="card col-3 text-center m-2">
                    <img class="card-img-top mx-auto d-block" style="height: 140px; width: auto;" src="imagens/<?php echo $produto['imagem'] ?>" alt="Imagem do produto">
                    <div class="card-body">
                        <h5 class="card-title h-20 p-2"><?php echo $produto['nome']; ?></h5>
                        <p class="card-text h-25 p-2"><?php echo $produto['descricao']?></p>
                        <h3 class="card-text h-25 p-2">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></h3>
                        <a href="carrinho.php?acao=add&id=<?php echo $produto['id'] ?>" class="btn btn-primary">Comprar</a>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>