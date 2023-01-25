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
                <a href="produtos.php">Lista de Produtos</a>
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
                            foreach ($_SESSION['carrinho'] as $id => $qtd) {
                                $sql        = "SELECT * FROM produtos WHERE id = $id";
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
                                <button class="btn btn-primary" type="submit" title="Atualizar carrinho"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                                        <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                                    </svg></button>
                            </td>
                            <td style="text-align: right;"><?php echo $preco; ?></td>
                            <td style="text-align: right;"><?php echo $sub; ?></td>
                            <td><a class="btn btn-danger" href="?acao=del&id=<?php echo $id; ?>" title="Remover item"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg></a></td>

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

            <a class="btn btn-info" href="produtos.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
  <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"/>
</svg>Continuar Comprando</a>

            <a class="btn btn-success" href="finalizar.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
  <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
</svg>Finalizar Pedido</a>

        </form>

    </div>

</body>

</html>