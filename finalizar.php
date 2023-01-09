<?php
session_start();

function limparCarrinho()
{
    session_destroy();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar pedido</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
<header>
        <h1 class="text-center">Finalizar pedido</h1>
        <hr>
    </header>
    <?php
    require_once("conexao.php");

    if (isset($_SESSION['carrinho']) && isset($_SESSION['total'])) {
        if (is_numeric($_SESSION['total'])) {
            $valorVenda = $_SESSION['total'];
            $sqlInserirVenda = "INSERT INTO venda (valor) VALUES ($valorVenda)";
            $conn->query("$sqlInserirVenda");
            $idVenda = $conn->insert_id; //pegando o id da última venda realizada
            foreach ($_SESSION['carrinho'] as $id => $qtd) {
                $sqlInserirItensVenda = "INSERT INTO itensvenda(idvenda, idproduto, qtd) VALUES($idVenda, $id, $qtd)";
                $conn->query("$sqlInserirItensVenda");
            }
    ?>
            <div class="alert alert-success" role="alert">
                Venda realizada com sucesso!
                <a href="index.php" class="btn btn-primary">Continuar comprando...</a>
            </div>
        <?php
        }
        limparCarrinho();
    } else {
        ?>
        <div class="alert alert-warning" role="alert">
            Nenhum item foi escolhido para compra!
            <a href="index.php" class="btn btn-primary">Continuar comprando...</a>
        </div>
    <?php
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>