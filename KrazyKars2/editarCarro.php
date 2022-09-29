<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/stylecarro.css">
</head>
<body>
    <div class="container">
    <form method = 'GET' action='index.php'>
        <input type='hidden' name='id' value='$id'>
        <button>Voltar</button>
    </form>

    <?php
        require_once "configs/carro.php";
        require_once "configs/marca.php";
        if(isset($_POST["id"]) and !empty($_POST["id"])){
            if(isset($_POST["placa"]) and !empty($_POST["placa"])){
                if(isset($_POST["modelo"]) and !empty($_POST["modelo"])){
                    if(isset($_POST["idmarca"]) and !empty($_POST["idmarca"])){
                        if(isset($_POST["ano"]) and !empty($_POST["ano"])){
                            $placa = $_POST["placa"];
                            $modelo = $_POST["modelo"];
                            $idmarca = $_POST["idmarca"];
                            $ano = $_POST["ano"];
                            $id = $_POST["id"];

                            if(Carro::existeId($id)){
                                $resultado = Carro::Atualizar($placa, $modelo, $idmarca, $ano, $id);
                                if($resultado){
                                    echo "<script>alert('Carro editado com sucesso!')</script>";
                                    die;
                                }else{
                                    echo "<script>alert('Houve um erro na edição.')</script>";
                                    die;
                                }
                            }else{
                                echo "<script>alert('Esse carro não existe!')</script>";
                                die;
                            }
                        }
                    }
                }
            }
        }

        $carroeditar = null;
                            if(isset($_GET["id"]) and !empty($_GET["id"])){
                                $id = $_GET["id"];
                                if(Carro::existeId($id)){
                                    $carroeditar = Carro::getCarroId($id);
                                }else{
                                    echo "<script>alert('Esse carro não existe!')</script>";
                                }
                            }else{
                                echo "<script>alert('Você não pode editar um carro sem dizer qual é.')</script>";
                            }
    ?>

    <h2>Editar <?=$carroeditar["modelo"]?>:</h2>
    <form method="POST">
        <div class="input-group">
            <input type="text" name="placa" class="input" required>
            <label class="user-label">Placa</label>
        </div>
        <div class="input-group">
            <input required type="text" name="modelo" class="input">
            <label class="user-label">Modelo</label>
        </div>
        Marca:
        <div class="select">
            <select name="idmarca">
            <?php
                $listaMarcas = Marca::Listar();
                foreach ($listaMarcas as $marca){
                    $nomemarca = $marca["nomemarca"];
                    $id = $marca["id"];

                    echo "<option value='$id'>$nomemarca</option>" ;
                }
            ?>
            </select>
            <div class="select_arrow">
            </div>
        </div>
        
        <div class="input-group">
            <input required type="text" name="ano" class="input">
            <label class="user-label">Ano</label>
        </div>
        <input type="hidden" name="id" value="<?=$carroeditar["id"]?>">
        <button class="cadastro">Atualizar</button>
    </form>
    </div>
</body>
</html>