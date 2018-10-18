<?php
require_once '../recursos/db/db.php';
   

/*/////////////////////////////
Clase Documento
////////////////////////////*/

class DocumentoDAO 
{
    private $id;
	private $rut_deudor;
    private $nom_deudor;
    private $nro_doc;
    private $monto_doc;
    private $anticipo_doc;
    private $fec_ope_doc;
    private $fec_ven_doc;
    private $plazo_doc;
    private $fec_reg_doc;
    private $tipo_doc;
    private $est_doc;

    public function __construct($id=null,
                                $rut_deudor=null,
                                $nom_deudor=null,
                                $nro_doc=null,
                                $monto_doc=null,
                                $anticipo_doc=null,
                            	$fec_ope_doc=null,
                                $fec_ven_doc=null,
                                $plazo_doc=null,
                                $fec_reg_doc=null,
                                $tipo_doc=null,
                                $est_doc=null) {



    $this->id = $id;
    $this->rut_deudor = $rut_deudor;
    $this->nom_deudor = $nom_deudor;
    $this->nro = $nro_doc;
    $this->monto = $monto_doc;
    $this->anticipo = $anticipo_doc;
    $this->fec_ope = $fec_ope_doc;
    $this->fec_ven = $fec_ven_doc;
    $this->plazo = $plazo_doc;
    $this->fec_reg = $fec_reg_doc;
    $this->tipo = $tipo_doc;
    $this->est = $est_doc;
    }

    public function getDoc() {
    return $this->id;
    }

    /*///////////////////////////////////////
    Ingresar Documento
    //////////////////////////////////////*/
    public function ing_doc($id_usu, $id_cli) {

    			 try{
             
                $pdo = AccesoDB::getCon();

                $sql_ing_doc = "INSERT INTO `documentos`(`RUT_DEU_DOC`,`NOM_DEU_DOC`,`NRO_DOC`,`MONTO_DOC`,`ANTICIPO_DOC`,`FEC_OPE_DOC`,`FEC_VEN_DOC`,`PLAZO_DOC`,`FEC_REGI_DOC`,`USU_REG_DOC`,`ID_CLI`,`TIPO_DOC`,`EST_DOC`)
                VALUES(:rut_deudor,:nom_deudor,:nro,:monto,:ant,:fec_ope,:fec_ven,:plazo,:fec_reg,:usu,:cli,:tipo,:est)";


                $stmt = $pdo->prepare($sql_ing_doc);
                $stmt->bindParam(":rut_deudor", $this->rut_deudor, PDO::PARAM_STR);
                $stmt->bindParam(":nom_deudor", $this->nom_deudor, PDO::PARAM_STR);
                $stmt->bindParam(":nro", $this->nro, PDO::PARAM_INT);
                $stmt->bindParam(":monto", $this->monto, PDO::PARAM_INT);
                $stmt->bindParam(":ant", $this->anticipo, PDO::PARAM_INT);
                $stmt->bindParam(":fec_ope", $this->fec_ope, PDO::PARAM_STR);
                $stmt->bindParam(":fec_ven", $this->fec_ven, PDO::PARAM_STR);
                $stmt->bindParam(":plazo", $this->plazo, PDO::PARAM_INT);
                $stmt->bindParam(":fec_reg", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $id_usu, PDO::PARAM_INT);
                $stmt->bindParam(":cli", $id_cli, PDO::PARAM_INT);
                $stmt->bindParam(":tipo", $this->tipo, PDO::PARAM_INT);
                $stmt->bindParam(":est", $this->est, PDO::PARAM_INT);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }

    }

}