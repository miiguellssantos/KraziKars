<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylepessoa.css">
</head>
<body>
    <div class="container">
    <form method = 'GET' action='index.php'>
        <input type='hidden' name='id' value='$id'>
        <button>Voltar</button>
    </form>

    <?php
        require_once "configs/pessoa.php";
        if(isset($_POST["id"]) and !empty($_POST["id"])){
            if(isset($_POST["nome"]) and !empty($_POST["nome"])){
                if(isset($_POST["login"]) and !empty($_POST["login"])){
                    if(isset($_POST["senha"]) and !empty($_POST["senha"])){
                        $nome = $_POST["nome"];
                        $login = $_POST["login"];
                        $senha = $_POST["senha"];
                        $id = $_POST["id"];

                        if(Pessoa::existeId($id)){
                            $resultado = Pessoa::Atualizar($nome, $login, $senha, $id);
                            if($resultado) {
                                echo "<script>alert('$nome foi alterado com sucesso!')</script>";
                                die;
                            } else{
                                echo "<script>alert('Houve um erro na edição de $nome')</script>";
                                die;
                            }
                        } else{ 
                            echo "<script>alert('Não foi possível editar.')</script>";
                            die;
                        }
                        }

                    }
                }
            }
    $pessoaEditar = NULL;
    if(isset($_GET['id']) and !empty($_GET['id'])){
        $id = $_GET['id'];
        if(Pessoa::existeId($id)){
            $pessoaEditar = Pessoa::getPessoaId($id);
            
        } else {
            echo "<script>alert('Essa pessoa não existe!')</script>";
            die;
        }
    } else{
        echo "<script>alert('Você não pode editar uma pessoa sem me dizer quem é!')</script>";
        die;
    }
    ?>

    <h3>Editar <?= $pessoaEditar["nome"]?>:</h3>

    <form method="POST">
        <div class="input-group">
            <input required type="text" name="nome" autocomplete="off" class="input">
            <label class="user-label">Nome</label>
        </div>
        <div class="input-group">
            <input required type="email" name="login" autocomplete="off" class="input">
            <label class="user-label">Login</label>
        </div>
        <div class="input-group">
            <input required type="password" name="senha" autocomplete="off" class="input">
            <label class="user-label">Senha</label>
        </div>
        <button class="cadastro">Cadastrar</button> 
        <input type="hidden" name="id" value="<?=$pessoaEditar["id"]?>">
    </form>
</div>
</body>
</html>