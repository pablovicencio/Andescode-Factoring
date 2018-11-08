<?php
require_once '../recursos/db/db.php';
require_once 'ClasePersona.php';

/*/////////////////////////////
Clase CLIENTE
////////////////////////////*/

class ClienteDAO extends PersonaDAO
{
    
    private $nom_cli;
    private $tasa_cli;
    private $com_cob_cli;
    private $com_cur_cli;
    private $aper_cli;
    private $num_cta_cli;
    private $lin_cre_cli;
    private $fec_cre_cli;
    private $usu_cre_cli;
    private $gg_cli;
    private $gf_cli;
    private $bco_cli;
    private $fec_ven_cli;



    public function __construct($id=null,
                                $rut_cli=null,
                                $nom_cli=null,
                                $tasa_cli=null,
                                $com_cob_cli=null,
                                $com_cur_cli=null,
                                $aper_cli=null,
                                $num_cta_cli=null,
                                $lin_cre_cli=null,
                                $fec_cre_cli=null,
                                $usu_cre_cli=null,
                                $vigencia=null,
                                $contraseña=null,
                                $mail=null,
                                $gg_cli=null,
                                $gf_cli=null,
                                $bco_cli=null,
                                $fec_ven_cli=null) {



    $this->id = $id;
    $this->rut = $rut_cli;
    $this->nom_cli = $nom_cli;
    $this->tasa_cli = $tasa_cli;
    $this->com_cob_cli = $com_cob_cli;
    $this->com_cur_cli = $com_cur_cli;
    $this->aper_cli = $aper_cli;
    $this->fec_cre_cli = $fec_cre_cli;
    $this->usu_cre_cli = $usu_cre_cli;
    $this->vigencia = $vigencia;
    $this->contraseña = $contraseña;
    $this->mail = $mail;
    $this->gg_cli = $gg_cli;
    $this->gf_cli = $gf_cli;
    $this->lin_cre_cli = $lin_cre_cli;
    $this->num_cta_cli = $num_cta_cli;
    $this->bco_cli = $bco_cli;
    $this->fec_ven_cli = $fec_ven_cli;
    }

    public function getCli() {
    return $this->id;
    }


    /*///////////////////////////////////////
    Crear Cliente
    //////////////////////////////////////*/
    public function crear_cliente() {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_crear_cli = "INSERT INTO `clientes`(`RUT_CLI`,
                                                        `NOM_CLI`,
                                                        `TASA_INICIAL`,
                                                        `COM_COB_INICIAL`,
                                                        `COM_CUR_INICIAL`,
                                                        `APERTURA_INICIAL`,
                                                        `FEC_CRE_CLI`,
                                                        `USU_CRE_CLI`,
                                                        `VIG_CLI`,
                                                        `PASS_CLI`,
                                                        `MAIL_CLI`,
                                                        `GG_CLI`,
                                                        `GF_CLI`,
                                                        `LINEA_CRED_CLI`,
                                                        `NRO_CTA_CLI`,
                                                        `BCO_CLI`,
                                                        `VENC_LIN_CRED_CLI`)
                                VALUES( :rut,
                                        :nom,
                                        :tasa,
                                        :comicobini,
                                        :comicurini,
                                        :aperturaini,
                                        :fecha,
                                        :usuario,
                                        :vig,
                                        :pass,
                                        :mail,
                                        :gg,
                                        :gf,
                                        :lineacred,
                                        :numcta,
                                        :bco_cli,
                                        :fec_ven_cli)";


                $stmt = $pdo->prepare($sql_crear_cli);
                $stmt->bindParam(":rut", $this->rut, PDO::PARAM_STR); 
                $stmt->bindParam(":nom", $this->nom_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":tasa", $this->tasa_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":comicobini", $this->com_cob_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":comicurini", $this->com_cur_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":aperturaini", $this->aper_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":fecha", $this->fec_cre_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":usuario", $this->usu_cre_cli, PDO::PARAM_INT); 
                $stmt->bindParam(":vig", $this->vigencia, PDO::PARAM_BOOL); 
                $stmt->bindParam(":pass", $this->contraseña, PDO::PARAM_STR);
                $stmt->bindParam(":mail", $this->mail, PDO::PARAM_STR); 
                $stmt->bindParam(":gg", $this->gg_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":gf", $this->gf_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":lineacred", $this->lin_cre_cli, PDO::PARAM_STR); 
                $stmt->bindParam(":numcta", $this->num_cta_cli, PDO::PARAM_INT); 
                $stmt->bindParam(":bco_cli", $this->bco_cli, PDO::PARAM_INT); 
                $stmt->bindParam(":fec_ven_cli", $this->fec_ven_cli, PDO::PARAM_STR); 
                $stmt->execute();
            
               

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }
    }

     /*///////////////////////////////////////
    Modificar Cliente
    //////////////////////////////////////*/
    public function modificar_cliente() {


        try{
             
                $pdo = AccesoDB::getCon();

                $sql_mod_cli = "UPDATE `clientes`
                                    SET
                                    `NOM_CLI` = :nom_cli,
                                    `GG_CLI` = :gg_cli,
                                    `GF_CLI` = :gf_cli,
                                    `MAIL_CLI` = :mail_cli,
                                    `TASA_INICIAL` = :tasa_inicial,
                                    `NRO_CTA_CLI` = :nro_cta_cli,
                                    `LINEA_CRED_CLI` = :linea_cred_cli,
                                    `COM_COB_INICIAL` = :com_cob_inicial,
                                    `COM_CUR_INICIAL` = :com_cur_inicial,
                                    `APERTURA_INICIAL` = :apertura_inicial
                                    WHERE `ID_CLI` = :id";


                $stmt = $pdo->prepare($sql_mod_cli);
                $stmt->bindParam(":nom_cli", $this->nom_cli, PDO::PARAM_STR);
                $stmt->bindParam(":gg_cli", $this->gg_cli, PDO::PARAM_STR);
                $stmt->bindParam(":gf_cli", $this->gf_cli, PDO::PARAM_STR);
                $stmt->bindParam(":mail_cli", $this->mail, PDO::PARAM_STR);
                $stmt->bindParam(":tasa_inicial", $this->tasa_cli, PDO::PARAM_STR);
                $stmt->bindParam(":nro_cta_cli", $this->num_cta_cli, PDO::PARAM_INT);
                $stmt->bindParam(":linea_cred_cli", $this->lin_cre_cli, PDO::PARAM_INT);
                $stmt->bindParam(":com_cob_inicial", $this->com_cob_cli, PDO::PARAM_BOOL);
                $stmt->bindParam(":com_cur_inicial", $this->com_cur_cli, PDO::PARAM_INT);
                $stmt->bindParam(":apertura_inicial", $this->aper_cli, PDO::PARAM_INT);
                $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage()."";
            }
    }
    

}

    ?>