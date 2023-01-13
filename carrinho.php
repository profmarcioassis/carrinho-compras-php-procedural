<?php
session_start();
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

//adicionar produto
if (isset($_GET['acao'])) {
    //adicionar carrinho
    if ($_GET['acao'] == 'add') {
        $id = intval($_GET['id']); //intval() verifica se o número vindo é um inteiro
        if (!isset($_SESSION['carrinho'][$id])) {
            $_SESSION['carrinho'][$id] = 1;
        } else {
            $_SESSION['carrinho'][$id]++;
        }
    }
    //remover produto
    if ($_GET['acao'] == 'del') {
        $id = intval($_GET['id']); //intval() verifica se o número vindo é um inteiro
        if (isset($_SESSION['carrinho'][$id])) {
            unset($_SESSION['carrinho'][$id]);
        }
    }

    //atualizar carrinho
    if ($_GET['acao'] == 'up') {
        if (is_array($_POST['prod'])) {
            foreach ($_POST['prod'] as $id => $qtd) {
                //intval() verifica se o número vindo é um inteiro
                //trim() remove o caracter indicado
                $id = intval(trim($id, "'"));
                $qtd = intval($qtd);
                if (!empty($qtd) || $qtd <> 0) {
                    $_SESSION['carrinho'][intval($id)] = $qtd;
                } else {
                    unset($_SESSION['carrinho'][$id]);
                }
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Carrinho de compras</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" />

</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <h4 class="card-title">Carrinho</h4>
                <a href="index.php">Lista de Produtos</a>
            </div>
        </div>

        <form action="carrinho.php?acao=up" method="post">
            <table class="table table-strip">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Subtotal</th>
                        <th>Ação</th>

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
                            require_once('conexao.php');
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
                                <input type="text" size="3" name="prod['<?php echo $id; ?>']" value="<?php echo $qtd; ?>">

                            </td>
                            <td style="text-align: right;"><?php echo $preco; ?></td>
                            <td style="text-align: right;"><?php echo $sub; ?></td>
                            <td><a class="btn btn-danger" href="?acao=del&id=<?php echo $id; ?>">Remover</a></td>

                        </tr>


                    <?php
                            }

                    ?>
                    <tr>
                        <td colspan="4" style="text-align: right; font-weight: bold;">Total</td>
                        <td style="text-align: right; font-weight: bold;"><?php echo number_format($total, 2, ',', '.'); ?></td>
                    </tr>
                <?php
                            $_SESSION['total'] = $total;
                        }
                ?>
            </table>

            <a class="btn btn-info" href="index.php">Continuar Comprando</a>
            <button class="btn btn-primary" type="submit">Atualizar Carrinho</button>
            <a class="btn btn-success" href="finalizar.php">Finalizar Pedido</a>

        </form>

    </div>

</body>

</html>