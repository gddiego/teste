<?php
require 'inc/database.php';

if (!empty($_POST)) {
    $nameError = null;
    $emailError = null;
    $mobileError = null;

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $valid = true;
    if (empty($name)) {
        $nameError = 'Por favor entre com seu nome';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Por favor entre com Email';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Por favor entre com seu  Email valido';
        $valid = false;
    }

    if (empty($mobile)) {
        $mobileError = 'Por favor entre com seu numero de telefone';
        $valid = false;
    }

    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'INSERT INTO customers (name, email, mobile) values(?, ?, ?)';
        $q = $pdo->prepare($sql);
        $q->execute(array($name, $email, $mobile));
        Database::disconnect();
        header('Location: index.php');
    }
}

require 'inc/header.php';
?>






<div class="container">

    <div class="card mt-5">
        <div class="card-header">
               <div class="badge badge-primary text-wrap">
   Adicionar registros.
</div>
        </div>
    </div>
    
    

    <div class="card mt-5">
        <div class="card-body">
            <div class="shadow p-3 mb-5 bg-white rounded">
                <form action="create.php" method="post">
                    <div class="form-group <?php echo!empty($nameError) ? 'has-error' : ''; ?>">
                        <label class="col-sm-2 control-label">Nome</label>
                        <div class="form-group ">
                            <input class="form-control" name="name" type="text" placeholder="Nome" value="<?php echo!empty($name) ? $name : ''; ?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-block"><?php echo $nameError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo!empty($emailError) ? 'has-error' : ''; ?>">
                        <label class="col-sm-2 control-label">Email </label>
                        <div class="form-group-">
                            <input class="form-control" name="email" type="text" placeholder="Email " value="<?php echo!empty($email) ? $email : ''; ?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-block"><?php echo $emailError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group <?php echo!empty($mobileError) ? 'has-error' : ''; ?>">
                        <label class="col-sm-2 control-label">Telefone</label>
                        <div class="form-group">
                            <input class="form-control" name="mobile" type="text" placeholder="Telefone" value="<?php echo!empty($mobile) ? $mobile : ''; ?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-block"><?php echo $mobileError; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Adicionar</button>
                            <a class="btn btn-default" href="index.php">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'inc/footer.php'; ?>