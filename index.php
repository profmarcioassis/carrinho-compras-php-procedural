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
    <header>
        <h1 class="text-center">Lista de produtos</h1>
        <hr>
    </header>
    <div class="row">
        <?php
        require_once 'conexao.php';
        $sql = "select * from produtos order by id";
        $dados = $conn->query($sql) or die("Erro ao executar comando: " . mysqli_error($conn));
        while ($produto = $dados->fetch_assoc()) {
        ?>
             <div class="card col-2">
                <img class="card-img-top" src="imagens/<?php echo $produto['imagem'] ?>" alt="Imagem do produto">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $produto['nome']; ?></h5>
                    <p class="card-text">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                    <a href="carrinho.php?acao=add&id=<?php echo $produto['id'] ?>" class="btn btn-primary">Comprar</a>
                </div>
            </div>

        <?php
        }
        ?>
    </div>
</body>

</html>