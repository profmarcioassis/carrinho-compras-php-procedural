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

    <?php
    require_once 'conexao.php';
    $sql = "select * from produtos order by id";
    $dados = $conn->query($sql) or die("Erro ao executar comando: " . mysqli_error($conn));
    while ($produto = $dados->fetch_assoc()) {
    ?>
        <h3><?php echo $produto['nome']; ?></h3>
        <h4>R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?><h4>
                <img src="imagens/<?php echo $produto['imagem'] ?>" alt="Imagem do produto"><br>
                <a href="carrinho.php?acao=add&id=<?php echo $produto['id'] ?>">Comprar</a><br>
                <hr>
            <?php
        }
            ?>
</body>

</html>