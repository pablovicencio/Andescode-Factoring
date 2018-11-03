<?php
require_once '../recursos/db/db.php';
   

/*/////////////////////////////
Clase Documento
////////////////////////////*/

class DocumentoDAO 
{
    private $id;
	private $fec_reg;
    private $usu_reg;
    private $est_doc;
    private $data;
    

    public function __construct($id=null,
                                $fec_reg=null,
                                $usu_reg=null,
                                $est_doc=null,
                                $data=null) {



    $this->id = $id;
    $this->fec_reg = $fec_reg;
    $this->usu_reg = $usu_reg;
    $this->est_doc = $est_doc;
    $this->data = $data;
    }

    public function getDoc() {
    return $this->id;
    }

    /*///////////////////////////////////////
    Ingresar Documento
    //////////////////////////////////////*/
    public function ing_doc($id_ope) {

    			 try{
                $pdo = AccesoDB::getCon();
                
                foreach ($this->data as $row) {
                              $rut_deu = $row['rut_deudor'];
                              $nom_deu = $row['nom_deudor'];
                              $nro_doc = $row['nro_doc'];
                              $monto_doc = $row['monto_doc'];
                              $anticipo_doc = $row['anticipo'];
                              $fec_ope = $row['fec_ope'];
                              $fec_ven = $row['fec_ven'];
                              $plazo = $row['plazo'];
                              $tipo_doc = $row['tipo_doc'];
                              $fec_ven = $row['fec_ven'];
                              $financiado = $row['financiado'];
                              $com_cob = $row['com_cob'];
                              $dif_pre = $row['dif_precio'];
                              $anticipo_porc = $row['anticipo_porc'];

                              
                                  $sql_ing_doc = "INSERT INTO `documentos`(`RUT_DEU_DOC`,`NOM_DEU_DOC`,`NRO_DOC`,`MONTO_DOC`,`ANTICIPO_DOC`,
                                    `FEC_OPE_DOC`,`FEC_VEN_DOC`,`PLAZO_DOC`,`FEC_REGI_DOC`,`USU_REG_DOC`,`TIPO_DOC`,`EST_DOC`,
                                    `ID_OPE`,`MONTO_FINAN_DOC`,`COM_COB_DOC`,`DIF_PRE_DOC`,`ANTICIPO_PORC`)
                                    VALUES(:rut_deu, :nom_deu, :nro_doc, :monto_doc, :anticipo_doc, :fec_ope, :fec_ven,:plazo,:fec_reg,:usu_reg, :tipo_doc, :est_doc, :id_ope, :monto_finan, :com_cob, :dif_pre, :anticipo_porc)";



                $stmt = $pdo->prepare($sql_ing_doc);
                        $stmt->bindParam("rut_deu", $rut_deu, PDO::PARAM_STR);
                        $stmt->bindParam("nom_deu", $nom_deu, PDO::PARAM_STR);
                        $stmt->bindParam("nro_doc", $nro_doc, PDO::PARAM_INT);
                        $stmt->bindParam("monto_doc", $monto_doc, PDO::PARAM_INT);
                        $stmt->bindParam("anticipo_doc", $anticipo_doc, PDO::PARAM_INT);
                        $stmt->bindParam("fec_ope", $fec_ope, PDO::PARAM_STR);
                        $stmt->bindParam("fec_ven", $fec_ven, PDO::PARAM_STR);
                        $stmt->bindParam("plazo", $plazo, PDO::PARAM_INT);
                        $stmt->bindParam("fec_reg", $this->fec_reg, PDO::PARAM_INT);
                        $stmt->bindParam("usu_reg", $this->usu_reg, PDO::PARAM_INT);
                        $stmt->bindParam("tipo_doc", $tipo_doc, PDO::PARAM_INT);
                        $stmt->bindParam("est_doc", $this->est_doc, PDO::PARAM_INT);
                        $stmt->bindParam("id_ope", $id_ope, PDO::PARAM_INT);
                        $stmt->bindParam("monto_finan", $financiado, PDO::PARAM_INT);
                        $stmt->bindParam("com_cob", $com_cob, PDO::PARAM_INT);
                        $stmt->bindParam("dif_pre", $dif_pre, PDO::PARAM_INT);
                        $stmt->bindParam("anticipo_porc", $anticipo_porc, PDO::PARAM_INT);
                $stmt->execute();




                             

                
    }
        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }

    }

}