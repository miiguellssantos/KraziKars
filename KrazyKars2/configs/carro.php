<?php
    require_once "BancoDados.php";

    class Carro{
        public static function Cadastrar($placa, $modelo, $idmarca, $ano){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("INSERT INTO carro(placa, modelo, idmarca, ano, datacad) values (?, ?, ?, ?, NOW())");
                
                $sql->execute([
                    $placa,
                    $modelo,
                    $idmarca,
                    $ano
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function Listar(){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT c.* FROM carro c JOIN marca m ON c.idmarca=m.id");
                $resultado = $sql->execute();

                return $sql->fetchAll();
            }catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }

        public static function existeId($id)
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT COUNT(*) FROM carro WHERE id = ?");
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

        public static function Atualizar($placa, $modelo, $idmarca, $ano, $id) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("UPDATE carro SET placa=?, modelo=?, idmarca=?, ano=? WHERE id=?");
                $sql->execute([
                    $placa,
                    $modelo,
                    $idmarca,
                    $ano,
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
                $sql = $conexao->prepare("DELETE FROM carro WHERE id = ?");
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

        public static function deletarMarca($idmarca)
        {
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("DELETE FROM carro WHERE idmarca = ?");
                $sql->execute([$idmarca]);

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

        public static function GetCarroId($id){
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT * FROM carro WHERE id = ?");
                $sql->execute([$id]);

                return $sql->fetchAll()[0];
            }catch (Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>