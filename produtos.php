<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho de compras procedural</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container m-3 mx-auto">
        <header>
            <div class="card mt-5">
                <div class="card-body text-center">
                    <h3 class="card-title">Lista de Produtos Disponíveis</h3>
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
                <div class="card text-center m-3" style="width: 252px;">
                    <div class="imagem align-top">
                        <img class="card-img-top mx-auto" src="imagens/<?php echo $produto['imagem'] ?>" alt="Imagem do produto">
                    </div>
                    <div class="card-body align-bottom"">
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

                        <a href="carrinho.php?acao=add&id=<?php echo $produto['id'] ?>" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                </svg>&nbsp;Comprar</a>
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>