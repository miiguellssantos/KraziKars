<?php
    require_once "BancoDados.php";

    class Associacao
    {
        public static function Cadastrar($idcarro, $idpessoa)
        {
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("INSERT INTO associacao(idcarro, idpessoa) values (?, ?)");
                $sql->execute([
                    $idcarro, 
                    $idpessoa
                ]);

                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function Listar()
        {
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT a.* FROM (carro c JOIN associacao a ON c.id=a.idcarro) JOIN pessoa p ON a.idpessoa=p.id");
                $resultado = $sql->execute();

                return $sql->fetchAll();
            } catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function existeId($idassoc)
        {
                try {
                    $conexao = Conexao::getConexao();
                    $sql = $conexao->prepare("SELECT COUNT(*) FROM associacao WHERE idassoc = ?");
                    $sql->execute([$idassoc]);

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

        public static function Atualizar($idcarro, $idpessoa, $idassoc)
        {
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("UPDATE associacao SET idcarro=?, idpessoa=? WHERE idassoc=?");
                $sql->execute([
                    $idcarro, 
                    $idpessoa, 
                    $idassoc
                ]);

                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch(Exception $e){
                echo $e->getMessage();
                exit;
            }

        }

        public static function Deletar($idassoc)
        {
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare('DELETE FROM associacao WHERE idassoc=?');
                $sql->execute([$idassoc]);

                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function deletarCarro($idcarro) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("DELETE FROM associacao WHERE idcarro=?");
                $sql->execute([$idcarro]);

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

        public static function deletarDono($idpessoa) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("DELETE FROM associacao WHERE idpessoa=?");
                $sql->execute([$idpessoa]);

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

        public static function GetAssocId($idassoc){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT * FROM associacao WHERE idassoc = ?");
                $sql->execute([$idassoc]);

                return $sql->fetchAll()[0];
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>