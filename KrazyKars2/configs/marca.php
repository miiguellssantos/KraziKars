<?php
    require_once "BancoDados.php";

    class Marca
    {
        public static function Cadastrar($nomemarca){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("INSERT INTO marca(nomemarca) VALUES (?)");
                $sql->execute([$nomemarca]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }catch(Exception $e){
                echo $e -> getMessage();
                exit;
            }
        }

        public static function Deletar($id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("DELETE FROM marca WHERE id = ?");
                $sql->execute([
                    $id
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
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

        public static function Atualizar($nomemarca, $id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("UPDATE marca SET nomemarca=? WHERE id=?");
                $sql->execute([
                    $nomemarca, 
                    $id
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public static function Listar(){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT * FROM marca ORDER BY id");
                $resultado = $sql->execute();

                return $sql->fetchAll();
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function Existe($nomemarca){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT count(*) FROM marca WHERE nomemarca=?");
                $sql->execute([$nomemarca]);

                $quantidade = $sql->fetchColumn();
                if($quantidade > 0){
                    return true;
                } else {
                    return false;
                }
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function ExisteId($id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT COUNT(*) FROM marca WHERE id = ?");
                $sql->execute([$id]);

                $quantidade =$sql->fetchColumn();
                if($quantidade > 0){
                    return true;
                }else{
                    return false;
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function GetMarcaId($id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT * FROM marca WHERE id = ?");
                $sql->execute([$id]);

                return $sql->fetchAll()[0];
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }


    }
?>