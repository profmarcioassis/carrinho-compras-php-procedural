<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras procedural</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container m-3 mx-auto">
        <header>
            <div class="card mt-5">
                <div class="card-body text-center">
                    <h3 class="card-title">Produtos disponíveis</h3>
                </div>
            </div>
        </header>
        <div class="row">
            <?php
            require_once 'conexao.php';
            $sql = "SELECT * FROM produtos ORDER BY id";
            $dados = $conn->query($sql) or die("Erro ao executar comando: " . mysqli_error($conn));
            while ($produto = $dados->fetch_assoc()) {
            ?>
                <div class="card text-center m-3" style="width: 250px;">
                    <div class="imagem">
                        <img class="card-img-top mx-auto" src="imagens/<?php echo $produto['imagem'] ?>" alt="Imagem do produto">
                    </div>
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $produto['nome']; ?></h4>
                        <p class="card-text descricao"><?php echo $produto['descricao']; ?></p>
                        <?php
                        if ($produto['oferta'] > 0) {
                        ?>
                            <h6 class="card-text"><del>R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?><del></h6>
                            <?php
                            $precoOferta = $produto['preco'] - $produto['preco'] * ($produto['oferta'] / 100);
                            ?>
                            <h3 class="card-text">R$<?php echo number_format($precoOferta, 2, ',', '.'); ?></h3>
                            <p>no PIX <span style="color: green;">(<?php echo $produto['oferta'] ?>% de desconto)</span></p>
                        <?php
                        } else {
                        ?>
                            <h3 class="card-text">R$<?php echo number_format($produto['preco'], 2, ',', '.'); ?></h3>
                        <?php
                        }
                        ?>

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