<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylemarca.css">
</head>
<body>
    <div class="container">
    <form method = 'GET' action='index.php'>
        <input type='hidden' name='id' value='$id'>
        <button>Voltar</button>
    </form>

    <?php
        require_once "configs/marca.php";
        if (isset($_POST["id"]) and !empty($_POST["id"])){
            if(isset($_POST["nomemarca"]) and !empty($_POST["nomemarca"])){
                $nomemarca = $_POST["nomemarca"];
                $id = $_POST["id"];
                if(Marca::ExisteId($id)){
                    $resultado = Marca::Atualizar($nomemarca, $id);
                    if($resultado){
                        echo "<script>alert('A marca foi editada com sucesso!')</script>";
                        die;
                    }else{
                        echo "<script>alert('Houve um erro na edição.')</script>";
                        die;
                    }
                }else{
                    echo "<script>alert('Não foi possível editar.')</script>";
                    die;
                }
            }
        }
        
        $marcaEditar = null;
        if(isset($_GET["id"]) and !empty($_GET["id"])){
            $id = $_GET["id"];
            if(Marca::ExisteId($id)){
                $marcaEditar = Marca::GetMarcaId($id);
                print_r($marcaEditar);
            } else {
                echo "<script>alert('Essa marca não existe!')</script>";
                die;
            }
        } else{
            echo "<script>alert('Você não pode editar uma marca sem dizer qual é')</script>";
            die;
        }
    ?>

    <h2>Editar <?= $marcaEditar["nomemarca"]?>:</h2>
    <form method="POST">    
        <div class="input-group">
            <input required type="text" name="nomemarca" value="<?=$marcaEditar["nomemarca"]?>" autocomplete="off" class="input">
            <label class="user-label">Nome</label>
        </div>
        <input type="hidden" name="id" value="<?=$marcaEditar["id"]?>">
        <button>Atualizar</button> 
    </form>

    </div>
</body>
</html>