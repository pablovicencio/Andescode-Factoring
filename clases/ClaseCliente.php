<?php
require_once '../recursos/db/db.php';
require_once 'ClasePersona.php';

/*/////////////////////////////
Clase Usuario
////////////////////////////*/

class ClienteDAO extends PersonaDAO
{
    
    private $nom_cli;
    private $tasa_cli;
    private $com_cob_cli;
    private $com_cur_cli;
    private $aper_cli;
    private $dia_cli;
    private $fec_cre_cli;
    private $usu_cre_cli;
    private $ot_desc_cli;
    private $gg_cli;
    private $gf_cli;

    public function __construct($id=null,
                                $rut_cli=null,
                                $nom_cli=null,
                                $tasa_cli=null,
                                $com_cob_cli=null,
                                $com_cur_cli=null,
                                $aper_cli=null,
                                $dia_cli=null,
                                $fec_cre_cli=null,
                                $usu_cre_cli=null,
                                $vigencia=null,
                                $contraseña=null,
                                $mail=null,
                                $ot_desc_cli=null,
                                $gg_cli=null,
                                $gf_cli=null) {



    $this->id = $id;
    $this->rut = $rut_cli;
    $this->nom_cli = $nom_cli;
    $this->tasa_cli = $tasa_cli;
    $this->com_cob_cli = $com_cob_cli;
    $this->com_cur_cli = $com_cur_cli;
    $this->aper_cli = $aper_cli;
    $this->dia_cli = $dia_cli;
    $this->fec_cre_cli = $fec_cre_cli;
    $this->usu_cre_cli = $usu_cre_cli;
    $this->ot_desc_cli = $ot_desc_cli;
    $this->gg_cli = $gg_cli;
    $this->gf_cli = $gf_cli;
    $this->contraseña = $contraseña;
    $this->vigencia = $vigencia;
    $this->mail = $mail;
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

                $sql_crear_cli = "INSERT INTO `bd_factoring`.`clientes`(`RUT_CLI`,`NOM_CLI`,`TASA_CLI`,`COM_COB_CLI`,`COM_CUR_CLI`,`APERTURA_CLI`,`DIA_CLI`,`FEC_CRE_USU`,`USU_CRE_CLI`,`VIG_CLI`,`PASS_CLI`,`MAIL_CLI`.`OTROS_DESC_CLI`,`GG_CLI`,`GF_CLI`)
                            VALUES(:rut,:nom,:tasa,:comicob,:comicur,:apertura,:dia,:fecha,:usuario,:vig,:pass,:mail,:otros,:gg,:gf);
                            ";


                $stmt = $pdo->prepare($sql_crear_cli);
                $stmt->bindParam(":rut", $this->rut, PDO::PARAM_STR);
                $stmt->bindParam(":nom", $this->nom_cli, PDO::PARAM_STR);
                $stmt->bindParam(":tasa", $this->tasa_cli, PDO::PARAM_STR);
                $stmt->bindParam(":comicob", $this->com_cob_cli, PDO::PARAM_STR);
                $stmt->bindParam(":comicur", $this->com_cur_cli, PDO::PARAM_STR);
                $stmt->bindParam(":apertura", $this->aper_cli, PDO::PARAM_STR);
                $stmt->bindParam(":dia", $this->dia_cli, PDO::PARAM_INT);
                $stmt->bindParam(":fecha", $this->fec_cre_cli, PDO::PARAM_STR);
                $stmt->bindParam(":usuario", $this->usu_cre_cli, PDO::PARAM_INT);
                $stmt->bindParam(":vig", $this->contraseña, PDO::PARAM_STR);
                $stmt->bindParam(":pass", $this->vigencia, PDO::PARAM_BOOL);
                $stmt->bindParam(":mail", $this->mail, PDO::PARAM_STR);
                $stmt->bindParam(":otros", $this->ot_desc_cli, PDO::PARAM_STR);
                $stmt->bindParam(":gg", $this->gg_cli, PDO::PARAM_STR);
                $stmt->bindParam(":gf", $this->gf_cli, PDO::PARAM_STR);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()."'); window.location='../paginas_co/crear_co.php';</script>";; 
            }
    }


}

    ?>