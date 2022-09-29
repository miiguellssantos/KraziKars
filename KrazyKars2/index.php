<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>KraziKars 2.0</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header>
        <h1>Krazi Kars 2.0</h1>
        <hr>
        </header>
        <div class="container">

            <?php
                require_once "configs/pessoa.php";
                require_once "configs/associacao.php";

                if(isset($_GET["deletarPessoa"]) and !empty(isset($_GET["deletarPessoa"]))){
                    $id = $_GET["deletarPessoa"];
                    if (Pessoa::existeID($id)){
                        Associacao::deletarDono($id);
                        $resultado = Pessoa::Deletar($id);
                        if($resultado){
                            echo "<script>alert('O usuário foi deletado com sucesso!')</script>";
                        }else{
                            echo "<script>alert('Houve um erro para deletar a pessoa.')</script>";
                        }
                    }else{
                        echo "<script>alert('Essa pessoa não existe!')</script>";
                    }
                }

                if(isset($_POST["nome"]) and !empty($_POST["nome"])){
                    if(isset($_POST["login"]) and !empty($_POST["login"])){
                        if(isset($_POST["senha"]) and !empty($_POST["senha"])){
                            $nome = $_POST["nome"];
                            $login = $_POST["login"];
                            $senha = $_POST["senha"];
                            
                            if(!Pessoa::existe($login)){
                                $resultado = Pessoa::Cadastrar($nome, $login, $senha);
                                if($resultado){
                                    echo "<script>alert('Cadstro realizado com sucesso!')</script>";
                                }else{
                                    echo "<script>alert('Houve um erro no cadastro.')</script>";
                                }
                            }else{
                                echo "<script>alert('Essa pessoa já existe!')</script>";
                            }
                        }
                    }
                }
            ?>

            <div id="form01">
                <h2>Cadastro de Pessoas</h2> 
                <form method="POST">
                    <div class="input-group">
                        <input required type="text" name="nome" autocomplete="off" class="input">
                        <label class="user-label">Nome</label>
                    </div>
                    <div class="input-group">
                        <input required type="text" name="login" autocomplete="off" class="input">
                        <label class="user-label">Login</label>
                    </div>
                    <div class="input-group">
                        <input required type="password" name="senha" autocomplete="off" class="input">
                        <label class="user-label">Senha</label>
                    </div>
                    <button class="cadastro">Cadastrar</button> 
                </form>
            </div>

            <?php
                require_once "configs/marca.php";
                require_once "configs/carro.php";

                if(isset($_POST["nomemarca"]) and !empty($_POST["nomemarca"])){
                    $nomemarca = $_POST["nomemarca"];

                    if(!Marca::Existe($nomemarca)){
                        $resultado = Marca::Cadastrar($nomemarca);
                        if($resultado){
                            echo "<script>alert('Cadastro realizado com sucesso!')</script>";
                        }else{
                            echo "<script>alert('Houve um erro no cadastro.')</script>";
                        }
                    }else{
                        echo "<script>alert('Essa marca já existe!')</script>";
                    }
                }

                if(isset($_GET["deletarMarca"]) and !empty($_GET["deletarMarca"])){
                    $id = $_GET["deletarMarca"];
                    if(Marca::ExisteId($id)){
                        Carro::deletarMarca($id);
                        $resultado = Marca::Deletar($id);
                        if($resultado){
                            echo "<script>alert('Marca deletada com sucesso!')</script>";
                        }else{
                            echo "<script>alert('Houve um erro ao deletar a marca.')</script>";    
                        }
                    }else{
                        echo "<script>alert('Essa marca não existe!')</script>";
                    }
                }
            ?>

            <div id="form02">
                <h2>Cadastro de Marcas</h2>
                <form method="POST">
                <div class="input-group">
                        <input required type="text" name="nomemarca" autocomplete="off" class="input">
                        <label class="user-label">Nome</label>
                    </div>
                    <button class="cadastro">Cadastrar</button> 
                </form>
            </div>

            <?php
                require_once "configs/carro.php";
                require_once "configs/associacao.php";

                if(isset($_GET["deletarCarro"]) and !empty(isset($_GET["deletarCarro"]))){
                    $id = $_GET["deletarCarro"];
                    if (Carro::existeID($id)){
                        Associacao::deletarCarro($id);
                        $resultado = Carro::Deletar($id);
                        if($resultado){
                            echo "<script>alert('O carro foi deletado com sucesso!')</script>";
                        }else{
                            echo "<script>alert('Houve um erro para deletar o carro.')</script>";
                        }
                    }else{
                        echo "<script>alert('Esse carro não existe!')</script>";
                    }
                }

                if(isset($_POST["placa"]) and !empty($_POST["placa"])){
                    if(isset($_POST["modelo"]) and !empty($_POST["modelo"])){
                        if(isset($_POST["idmarca"]) and !empty($_POST["idmarca"])){
                            if(isset($_POST["ano"]) and !empty($_POST["ano"])){
                                        $placa = $_POST["placa"];
                                        $modelo = $_POST["modelo"];
                                        $idmarca = $_POST["idmarca"];
                                        $ano = $_POST["ano"];

                                        $resultado = Carro::Cadastrar($placa, $modelo, $idmarca, $ano);
                                        if($resultado){
                                            echo "<script>alert('Cadastro realizado com sucesso!')</script>";
                                        }else{
                                            echo "<script>alert('Houve um erro no cadastro.')</script>";
                                        }
                            }else{
                                echo "<script>alert('Esse carro já existe!')</script>";
                            }
                        }
                    }
                }
            ?>

            <div id="form03">
                <h2>Cadastro de Carros</h2>
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
                    <button class="cadastro">Cadastrar</button>
                </form>
            </div>

            <?php
                require_once "configs/associacao.php";

                if(isset($_GET["deletarAssociacao"]) and !empty(isset($_GET["deletarAssociacao"]))){
                    $idassoc = $_GET["deletarAssociacao"];
                    if(Associacao::existeID($idassoc)){
                        $resultado = Associacao::Deletar($idassoc);
                        if($resultado){
                            echo "<script>alert('Associação deletada com sucesso!')</script>";
                        }else{
                            echo "<script>alert('Houve um erro ao deletar.')</script>";
                        }
                    }else{
                        echo "<script>alert('Essa associação não existe!')</script>";
                    }
                }

                if(isset($_POST["idcarro"]) and !empty($_POST["idcarro"])){
                    if(isset($_POST["idpessoa"]) and !empty($_POST["idpessoa"])){
                        $idcarro = $_POST["idcarro"];
                        $idpessoa = $_POST["idpessoa"];

                        $resultado = Associacao::Cadastrar($idcarro, $idpessoa);
                        if($resultado){
                            echo "<script>alert('Cadastro realizado com sucesso!')</script>";
                        }else{
                            echo "<script>alert('Houve um erro no cadastro.')</script>";
                        }
                    }else{
                        echo "<script>alert('Essa associação já existe!')</script>";
                    }
                }

                
            ?>

            <div id="form04">
                <h2>Adicionar Dono ao Carro</h2>
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
                    </div><br><br>
                    <button class="cadastro">Cadastrar</button>
                </form>
            </div>
        </div>

        <div id="tab">
                <h2>Pessoas Cadastradas</h2>
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Login</td>
                            <td>Senha</td>
                            <th id="opcao">Opções</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        require_once "configs/pessoa.php";
                            $listaPessoas = Pessoa::listar();
                            foreach($listaPessoas as $pessoa){
                                echo "<tr>";
                                echo "<td>" . $pessoa["id"] . "</td>";
                                echo "<td>" . $pessoa["nome"] . "</td>";
                                echo "<td>" . $pessoa["login"] . "</td>";
                                echo "<td>" . $pessoa["senha"] . "</td>";
                                $id = $pessoa["id"];
                                echo "<td> <a class='editar' href='editarPessoa.php?id=$id'>Editar</a>
                                        <a class='noselect'href='index.php?deletarPessoa=$id'>
                                            <span class='text'>Delete</span>
                                            <span class='icon'>
                                                <svg xmlns='http://w3.org/2000/svg'
                                                    width='24' height='24' viewBox='0 0 24 24'>
                                                    <path d='M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z'></path></svg>
                                            </span>
                                        </a>
                                        </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            
        </div>

        <div id="tab">
            <h2>Lista de Marcas Cadastradas</h2>
            
                <table>
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nome</td>
                            <td>Opções</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            require_once "configs/marca.php";
                            $listaMarcas = Marca::Listar();
                            foreach($listaMarcas as $marca){
                                echo "<tr>";
                                echo "<td>" . $marca["id"] . "</td>";
                                echo "<td>" . $marca["nomemarca"] . "</td>";
                                $id = $marca["id"];
                                echo "<td> <a class='editar' href='editarMarca.php?id=$id'>Editar</a><br>
                                <a class='noselect'href='index.php?deletarMarca=$id'>
                                <span class='text'>Delete</span>
                                <span class='icon'>
                                    <svg xmlns='http://w3.org/2000/svg'
                                        width='24' height='24' viewBox='0 0 24 24'>
                                        <path d='M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z'></path></svg>
                                </span>
                            </a>
                                        </td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            
        </div>

        <div id="tab">
            <h2>Lista de carros Cadastrados</h2>
            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Placa</td>
                        <td>Modelo</td>
                        <td>Marca</td>
                        <td>Ano</td>
                        <td>Data_Cadastro</td>
                        <td>Opções</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        require_once "configs/carro.php";
                        $listaCarros = Carro::Listar();
                        foreach($listaCarros as $carro){
                            echo "<tr>";
                            echo "<td>" . $carro["id"] . "</td>";
                            echo "<td>" . $carro["placa"] . "</td>";
                            echo "<td>" . $carro["modelo"] . "</td>";
                            echo "<td>" . $carro["idmarca"] . "</td>";
                            echo "<td>" . $carro["ano"] . "</td>";
                            echo "<td>" . $carro["datacad"] . "</td>";
                            $id = $carro["id"];
                            echo "<td> <a class='editar' href='editarCarro.php?id=$id'>Editar</a><br>
                            <a class='noselect'href='index.php?deletarCarro=$id'>
                            <span class='text'>Delete</span>
                            <span class='icon'>
                                <svg xmlns='http://w3.org/2000/svg'
                                        width='24' height='24' viewBox='0 0 24 24'>
                                        <path d='M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z'></path></svg>
                            </span>
                            </a>
                                    </td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <div id="tab">
            <h2>Lista de Associações Cadastradas</h2>
            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>IdCarro</td>
                        <td>IdDono</td>
                        <td>Opções</td>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    require_once "configs/associacao.php";
                    $listaAssoc = Associacao::Listar();
                    foreach($listaAssoc as $associacao){
                        echo "<tr>";
                        echo "<td>" . $associacao["idassoc"] . "</td>";
                        echo "<td>" . $associacao["idcarro"] . "</td>";
                        echo "<td>" . $associacao["idpessoa"] . "</td>";
                        $idassoc = $associacao["idassoc"];
                        echo "<td> 
                                <a class='editar' href='editarAssoc.php?idassoc=$idassoc'>Editar</a><br>
                                <a class='noselect'href='index.php?deletarAssociacao=$idassoc'>
                                        <span class='text'>Delete</span>
                                        <span class='icon'>
                                            <svg xmlns='http://w3.org/2000/svg'
                                                    width='24' height='24' viewBox='0 0 24 24'>
                                                    <path d='M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z'></path></svg>
                                        </span>
                                        </a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        
    </body>
</html>