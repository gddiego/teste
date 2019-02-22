<?php require 'inc/header.php'; ?>


<div class="container">
    <div class="card mt-5">
        <div class="card-body"
             <div class="row">
                <p><a href="create.php" class="btn btn-success">Adicionar</a></p>
                
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr class="table-primary">
                            <th>Nome</th>
                            <th>Email </th>
                            <th>Telefone</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require 'inc/database.php';
                        

                        $pdo = Database::connect();
                        $getCustomers = $pdo->prepare('SELECT * FROM customers ORDER BY id DESC');
                        $getCustomers->execute();

                        if ($getCustomers->rowCount() > 0) {
                            while ($row = $getCustomers->fetch()) {
                                echo '<tr>';
                                echo '<td>' . $row['name'] . '</td>' . PHP_EOL;
                                echo '<td>' . $row['email'] . '</td>' . PHP_EOL;
                                echo '<td>' . $row['mobile'] . '</td>' . PHP_EOL;
                                echo '<td>' . PHP_EOL;
                                echo '<a class="btn btn-default" href="read.php?id=' . $row['id'] . '">Visualizar</a>' . PHP_EOL;
                                echo '<a class="btn btn-success" href="update.php?id=' . $row['id'] . '">Atualizar</a>' . PHP_EOL;
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $row['id'] . '">Deletar</a>' . PHP_EOL;
                                echo '</td>' . PHP_EOL;
                                echo '</tr>' . PHP_EOL;
                            }
                        } else {
                            echo '<tr>';
                            echo '<td>Nenhum Registro...</td>' . PHP_EOL;
                            echo '<td>Nenhum Registro...</td>' . PHP_EOL;
                            echo '<td>Nenhum Registro...</td>' . PHP_EOL;
                            echo '<td>Nenhum Registro...</td>' . PHP_EOL;
                            echo '</tr>';
                        }

                        Database::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php require 'inc/footer.php'; ?>