<?php
header('Content-Type: text/html; charset=UTF-8');

class SQLServer
{

    //------- PARÂMETROS DE CONEXÃO -----------------------------------------------------------------------
    var $db;
    var $host;
    var $usuario;
    var $senha;
    var $isProducao = true; // <---- EM PRODUÇÃO?


    //------- HANDLE DA CONEXÃO ---------------------------------------------------------------------------
    var $conn;

    //------- RESULTADO DE INSERT/UPDATE/DELETE -----------------------------------------------------------
    var $resIUD;
    var $resIUD2;
    var $resIUD3;
    var $resIUD4;
    var $resIUD5;
    var $resIUD6;
    var $resIUD7;

    //------- RESULTADO DE QUERIE ------------------------------------------------------------------------
    var $result;
    var $numReg;

    var $result2;
    var $numReg2;

    var $result3;
    var $numReg3;

    var $result4;
    var $numReg4;

    var $result5;
    var $numReg5;

    var $result6;
    var $numReg6;

    var $result7;
    var $numReg7;

    //------- CONFIGURAÇÃO DAS CONEXÕES --------------------------------------------------------------------
    function Estoque()
    {
        $varDb = "Estoque";
        $varHost = "192.168.1.6";
        $varUsuario = "rm";
        $varSenha = "rm";
        $this->db = $varDb;
        $this->host = $varHost;
        $this->usuario = $varUsuario;
        $this->senha = $varSenha;
    }

    function CorporeRM()
    {
        $varDb = $this->isProducao ? "CorporeRM" : "CorporeRM_Teste";
        $varHost = "192.168.1.6";
        $varUsuario = "rm";
        $varSenha = "rm";
        $this->db = $varDb;
        $this->host = $varHost;
        $this->usuario = $varUsuario;
        $this->senha = $varSenha;
    }


    function CRM()
    {
        $varDb = $this->isProducao ? "CRM" : "CRM2";
        $varHost = "192.168.1.6";
        $varUsuario = "rm";
        $varSenha = "rm";
        $this->db = $varDb;
        $this->host = $varHost;
        $this->usuario = $varUsuario;
        $this->senha = $varSenha;
    }

    function CRM_TESTE()
    {
        $varDb = "CRM2";
        $varHost = "192.168.1.6";
        $varUsuario = "rm";
        $varSenha = "rm";
        $this->db = $varDb;
        $this->host = $varHost;
        $this->usuario = $varUsuario;
        $this->senha = $varSenha;
    }

    function notaFiscal()
    {
        $varDb = "NotaFiscal";
        $varHost = "192.168.1.6";
        $varUsuario = "sa";
        $varSenha = "Concreto@2020";
        $this->db = $varDb;
        $this->host = $varHost;
        $this->usuario = $varUsuario;
        $this->senha = $varSenha;
    }

    function boleto()
    {
        $varDb = "Boleto";
        $varHost = "192.168.1.6";
        $varUsuario = "sa";
        $varSenha = "Concreto@2020";
        $this->db = $varDb;
        $this->host = $varHost;
        $this->usuario = $varUsuario;
        $this->senha = $varSenha;
    }

    function conectar()
    {
        try {
            $options = array(
                PDO::SQLSRV_ATTR_DIRECT_QUERY => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            $this->conn = new PDO("sqlsrv:Server=$this->host;Database=$this->db", $this->usuario, $this->senha, $options);
        } catch (PDOException $e) {
            echo "Erro de Conexão " . $e->getMessage() . "\n";
            exit;
        }
    }

    function conectarBanco()
    {
        if ($this->conn) {
            #return sqlsrv_select_db($this->db, $this->conn) or die("Couldn't open database DB");

        }
    }

    //------- EXECUTAR SELECT -----------------------------------------------------------------------

    function executarQuery($str)
    {

        try {
            $this->result = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result->execute();
            if ($this->result == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result) {

                $this->numReg =  $this->result->rowCount();

                return  $this->result;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQuery2($str)
    {
        try {
            $this->result2 = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result2->execute();

            if ($this->result2 == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result2) {

                $this->numReg2 = ($this->result2->rowCount());

                return  $this->result2;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQuery3($str)
    {
        try {
            $this->result3 = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result3->execute();

            if ($this->result3 == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result3) {

                $this->numReg3 = ($this->result3->rowCount());

                return  $this->result3;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQuery4($str)
    {
        try {
            $this->result4 = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result4->execute();

            if ($this->result4 == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result4) {

                $this->numReg4 = ($this->result4->rowCount());

                return  $this->result4;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQuery5($str)
    {
        try {
            $this->result5 = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result5->execute();

            if ($this->result5 == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result5) {

                $this->numReg5 = ($this->result5->rowCount());

                return  $this->result5;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQuery6($str)
    {
        try {
            $this->result6 = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result6->execute();

            if ($this->result6 == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result6) {

                $this->numReg6 = ($this->result6->rowCount());

                return  $this->result6;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQuery7($str)
    {
        try {
            $this->result7 = $this->conn->prepare($str, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $this->result7->execute();

            if ($this->result7 == false) {
                die(print_r($conn->errorInfo(), true));
            }
            if ($this->result7) {

                $this->numReg7 = ($this->result7->rowCount());

                return  $this->result7;
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    //------- EXECUTAR INSERT/DELETE/UPDATE -----------------------------------------------------------------------

    function executarQueryIUD($str)
    {
        try {
            $resIUD = $this->conn->prepare($str);
            $resIUD->execute();

            if ($resIUD) {
                $this->resIUD = $resIUD;                               
                $ultimoIDInserido = $this->conn->lastInsertId(); //<-------- PEGAR O ÚLTIMO ID?                
                return $ultimoIDInserido;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQueryIUD2($str)
    {
        try {
            $resIUD2 = $this->conn->prepare($str);
            $resIUD2->execute();

            if ($resIUD2) {
                $this->resIUD2 = $resIUD2;
                return  true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQueryIUD3($str)
    {
        try {
            $resIUD3 = $this->conn->prepare($str);
            $resIUD3->execute();

            if ($resIUD3) {
                $this->resIUD3 = $resIUD3;
                return  true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQueryIUD4($str)
    {
        try {
            $resIUD4 = $this->conn->prepare($str);
            $resIUD4->execute();

            if ($resIUD4) {
                $this->resIUD4 = $resIUD4;
                return  true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQueryIUD5($str)
    {
        try {
            $resIUD5 = $this->conn->prepare($str);
            $resIUD5->execute();

            if ($resIUD5) {
                $this->resIUD5 = $resIUD5;
                return  true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQueryIUD6($str)
    {
        try {
            $resIUD6 = $this->conn->prepare($str);
            $resIUD6->execute();

            if ($resIUD6) {
                $this->resIUD6 = $resIUD6;
                return  true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }

    function executarQueryIUD7($str)
    {
        try {
            $resIUD7 = $this->conn->prepare($str);
            $resIUD7->execute();

            if ($resIUD7) {
                $this->resIUD7 = $resIUD7;
                return  true;
            }
            return false;
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    }


    //------- RETORNAR ARRAY DE ÍNDICES E COLUNAS / SELETCT  ---------------------------------------   
    function fetchArray()
    {
        return $this->result->fetch(PDO::FETCH_ASSOC);
    }

    function fetchArray2()
    {
        return $this->result2->fetch(PDO::FETCH_ASSOC);
    }

    function fetchArray3()
    {
        return $this->result3->fetch(PDO::FETCH_ASSOC);
    }

    function fetchArray4()
    {
        return $this->result4->fetch(PDO::FETCH_ASSOC);
    }

    function fetchArray5()
    {
        return $this->result5->fetch(PDO::FETCH_ASSOC);
    }
    function fetchArray6()
    {
        return $this->result6->fetch(PDO::FETCH_ASSOC);
    }

    function fetchArray7()
    {
        return $this->result7->fetch(PDO::FETCH_ASSOC);
    }

    //------- RETORNAR QUANTIDADE DE LINHAS/SELETCT  ---------------------------------------   
    function numRows()
    {
        return $this->result->rowCount();
    }

    function numRows2()
    {
        return  $this->result2->rowCount();
    }

    function numRows3()
    {
        return $this->result3->rowCount();
    }


    function numRows4()
    {
        return $this->result4->rowCount();
    }

    function numRows5()
    {
        return  $this->result5->rowCount();
    }

    function numRows6()
    {
        return $this->result6->rowCount();
    }

    function numRows7()
    {
        return $this->result7->rowCount();
    }
}
