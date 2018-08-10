
<?php
require_once '../recursos/db/db.php';
require_once 'ClasePersona.php';

/*/////////////////////////////
Clase Usuario
////////////////////////////*/

class UsuarioDAO extends PersonaDAO
{
    
    private $nom1_usu;
    private $nom2_usu;
    private $apepat_usu;
    private $apemat_usu;
    private $perfil_usu;
    private $fec_cre_usu;
    private $cargo_usu;
    private $nick_usu;

    public function __construct($id=null,$nom1_usu=null,$nom2_usu=null, $apepat_usu=null, $apemat_usu=null, $rut=null,$mail=null,$perfil_usu=null, $fec_cre_usu=null, $cargo_usu=null, $contraseña=null, $vigencia=null, $nick_usu=null) {



    $this->id = $id;
    $this->nom1_usu = $nom1_usu;
    $this->nom2_usu = $nom2_usu;
    $this->apepat_usu = $apepat_usu;
    $this->apemat_usu = $apemat_usu;
    $this->rut = $rut;
    $this->mail_usu = $mail;
    $this->perfil_usu = $perfil_usu;
    $this->fec_cre_usu = $fec_cre_usu;
    $this->cargo_usu = $cargo_usu;
    $this->contraseña = $contraseña;
    $this->vigencia = $vigencia;
    $this->nick_usu = $nick_usu;
    }

    public function getUsu() {
    return $this->id;
    }


    /*///////////////////////////////////////
    Crear Usuario
    //////////////////////////////////////*/
    public function crear_usuario() {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_crear_usu = "INSERT INTO `bd_factoring`.`usuarios`(`NOM1_USU`,`NOM2_USU`,`APEPAT_USU`,`APEMAT_USU`,`RUT_USU`,`MAIL_USU`,`ID_PERFIL`,`FEC_CRE_USU`,`CARGO_USU`,`PASS_USU`,`VIG_USU`,`NICK_USU`)
                            VALUES(:nom1,:nom2,:apepat,:apemat,:rut,:mail,:perfil,:fec_cre,:cargo,:pass,:vig,:nick);
                            ";


                $stmt = $pdo->prepare($sql_crear_usu);
                $stmt->bindParam(":nom1", $this->nom1_usu, PDO::PARAM_STR);
                $stmt->bindParam(":nom2", $this->nom2_usu, PDO::PARAM_STR);
                $stmt->bindParam(":apepat", $this->apepat_usu, PDO::PARAM_STR);
                $stmt->bindParam(":apemat", $this->apemat_usu, PDO::PARAM_STR);
                $stmt->bindParam(":rut", $this->rut, PDO::PARAM_STR);
                $stmt->bindParam(":mail", $this->mail_usu, PDO::PARAM_STR);
                $stmt->bindParam(":perfil", $this->perfil_usu, PDO::PARAM_INT);
                $stmt->bindParam(":fec_cre", $this->fec_cre_usu, PDO::PARAM_STR);
                $stmt->bindParam(":cargo", $this->cargo_usu, PDO::PARAM_INT);
                $stmt->bindParam(":pass", $this->contraseña, PDO::PARAM_STR);
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":nick", $this->nick_usu, PDO::PARAM_STR);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage()."";
            }
    }


}

    ?>