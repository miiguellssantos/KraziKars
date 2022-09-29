<?php
    require_once "BancoDados.php";

    class Pessoa 
    {
        public static function Cadastrar($nome, $login, $senha) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("INSERT INTO pessoa(nome, login, senha) VALUES (?, ?, ?)");
                $sql->execute([
                    $nome,
                    $login,
                    $senha
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
        
        public static function listar(){
                try{
                    $conexao = Conexao::getConexao();
                    $sql = $conexao->prepare("SELECT * from pessoa ORDER BY id");
                    $resultado = $sql->execute();

                    return $sql->fetchAll();
                } catch(Exception $e){
                    echo $e->getMessage();
                    exit;
                }
        }

        public static function existe($login){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT COUNT(*) FROM pessoa WHERE login =?");
                $sql->execute([$login]);
           
                $quantidade = $sql->fetchColumn();
                if($quantidade > 0){
                    return true;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit();
            }
        }

        public static function existeId($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT COUNT(*) FROM pessoa WHERE id = ?");
                $sql->execute([$id]);

                $quantidade = $sql->fetchColumn();
                if ($quantidade > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch(Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function getPessoaId($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT * FROM pessoa WHERE id = ?");
                $sql->execute([$id]);

                return $sql->fetchAll()[0];
            } catch(Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function Atualizar($nome, $login, $senha, $id) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("UPDATE pessoa SET nome=?, login=?, senha=? WHERE id=?");
                $sql->execute([
                    $nome,
                    $login,
                    $senha, 
                    $id
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function Deletar($id) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("DELETE FROM pessoa WHERE id = ?");
                $sql->execute([
                    $id
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
    }

?>