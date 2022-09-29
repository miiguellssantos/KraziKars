<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleassoc.css">
</head>
<body>

    <div class="container">
    <form method = 'GET' action='index.php'>
        <input type='hidden' name='id' value='$id'>
        <button>Voltar</button>
    </form>

    <?php
        require_once "configs/associacao.php";
        require_once "configs/carro.php";
        require_once "configs/pessoa.php";

        if(isset($_POST["idassoc"]) and !empty($_POST["idassoc"])){
            if(isset($_POST["idcarro"]) and !empty($_POST["idcarro"])){
                if(isset($_POST["idpessoa"]) and !empty($_POST["idpessoa"])){
                    $idcarro = $_POST["idcarro"];
                    $idpessoa = $_POST["idpessoa"];
                    $idassoc = $_POST["idassoc"];

                    if(Associacao::existeId($idassoc)){
                        $resultado = Associacao::Atualizar($idcarro, $idpessoa, $idassoc);
                        if($resultado){
                            echo "<script>alert('Associação editada com sucesso!')</script>";
                            die;
                        }else{
                            echo "<script>alert('Houve um erro na edição.')</script>";
                            die;
                        }
                    }else{
                        echo "<script>alert('Essa associação não existe!')</script>";
                        die;
                    }
                }
            }
        }

        $assoceditar = null;
        if(isset($_GET["idassoc"]) and !empty($_GET["idassoc"])){
            $idassoc = $_GET["idassoc"];
            if(Associacao::existeId($idassoc)){
                $assoceditar = Associacao::GetAssocId($idassoc);
            }else{
                echo "<script>alert('Essa associação não existe!')</script>";
            }
        }else{
            echo "<script>alert('Você não pode editar uma associação sem dizer qual é.')</script>";
        }
    ?>
    
    <h2>Editar Associação <?= $assoceditar["idassoc"]?></h2>
    <form method="POST">
        Carro:
        <div class="select">
            <select name="idcarro">
                <?php
                    $listaCarros = Carro::Listar();
                    foreach ($listaCarros as $carro){
                        $modelo = $carro["modelo"];
                        $idcarro = $carro["id"];

                        echo "<option value='$idcarro'>$modelo</option>" ;
                    }
                ?>
            </select>
            <div class="select_arrow">
            </div>
        </div><br><br>
        Pessoa:
        <div class="select">
            <select name="idpessoa">
                <?php
                    $listaPessoas = Pessoa::listar();
                    foreach($listaPessoas as $pessoa){
                        $nome = $pessoa["nome"];
                        $idpessoa = $pessoa["id"];

                        echo "<option value='$idpessoa'>$nome</option>" ;
                    }
                ?>
            </select>
            <div class="select_arrow">
            </div>
        </div>
        <input type="hidden" name="idassoc" value="<?=$assoceditar["idassoc"]?>"><br><br>
        <button>Editar</button>
    </form>

</div>
</body>
</html>