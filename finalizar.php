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
    <div class="container">
        <header>
        <div class="card mt-5 text-center">
            <div class="card-body">
                <h3 class="card-title">Finalização de compra</h3>
            </div>
        </div>
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
                <div class="alert alert-success mt-3" role="alert" >
                    Venda realizada com sucesso!
                    <a href="index.php" class="btn btn-primary">Continuar comprando...</a>
                </div>
                <h2>Resumo do pedido</h2>
                <table class="table table-strip mt-3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Subtotal</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            if (count($_SESSION['carrinho']) == 0) {
                            ?>
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-warning">
                                    Nenhum produto no carrinho.
                                </div>
                            </td>
                        </tr>
                        <?php
                            } else {
                                $total = 0;
                                //var_dump($_SESSION['carrinho']);
                                foreach ($_SESSION['carrinho'] as $id => $qtd) {
                                    $sql        = "SELECT * FROM produtos WHERE id = $id";
                                    //echo $sql;
                                    $dados      = $conn->query($sql) or die(mysqli_error($conn));
                                    $produto    = $dados->fetch_assoc();
                                    $nome       = $produto['nome'];
                                    $preco      = number_format($produto['preco'], 2, ',', '.');
                                    $sub        = number_format($produto['preco'] * $qtd, 2, ',', '.');
                                    $total      += floatval(str_replace('.', '', $sub));

                        ?>
                            <tr>
                                <td><?php echo $id; ?></td>
                                <td><?php echo $nome; ?></td>
                                <td>
                                    <?php echo $qtd; ?>

                                </td>
                                <td style="text-align: right;"><?php echo $preco; ?></td>
                                <td style="text-align: right;"><?php echo $sub; ?></td>

                            </tr>


                        <?php
                                }

                        ?>
                        <tr style=" background-color: #ccc;">
                            <td colspan="4" style="text-align: right; font-weight: bold;">Total</td>
                            <td style="text-align: right; font-weight: bold;"><?php echo number_format($total, 2, ',', '.'); ?></td>
                        </tr>
                    <?php
                                $_SESSION['total'] = $total;
                            }
                    ?>
                </table>
                <div class="text-center alert alert-primary p-5">
                    <h2>Muito obrigado!!!</h2>
                    <h3>Em breve o seu pedido será enviado e você receberá o código de rastreio...</h3>
                </div>
            <?php
            }
            limparCarrinho();
        } else {
            ?>
            <div class="alert alert-warning mt-3" role="alert">
                Nenhum item foi escolhido para compra!
                <a href="index.php" class="btn btn-primary">Continuar comprando...</a>
            </div>
        <?php
        }
        ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>