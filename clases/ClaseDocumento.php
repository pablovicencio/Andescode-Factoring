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
    private $fec_pago_final;
    private $dias_mora;
    private $abono_capital;
    private $intereses;
    private $total_cobrar_mora;
    private $bco_deposito;
    private $fec_depo_;
    private $tipo_depo;
    private $obs_doc;
    private $vbg;
    private $vba;
    private $vbc;


    public function __construct($id=null,
                                $fec_reg=null,
                                $usu_reg=null,
                                $est_doc=null,
                                $data=null,
                                $fec_pago_final = null,
                                $dias_mora = null,
                                $abono_capital = null,
                                $intereses = null,
                                $total_cobrar_mora = null,
                                $bco_deposito = null,
                                $fec_depo_ = null,
                                $tipo_depo = null,
                                $obs_doc=null,
                                $vbg=null,
                                $vba=null,
                                $vbc=null) {


    $this->id = $id;
    $this->fec_reg = $fec_reg;
    $this->usu_reg = $usu_reg;
    $this->est_doc = $est_doc;
    $this->data = $data;
    $this->fec_pago_final = $fec_pago_final;
    $this->dias_mora = $dias_mora;
    $this->abono_capital = $abono_capital;
    $this->intereses = $intereses;
    $this->total_cobrar_mora = $total_cobrar_mora;
    $this->bco_deposito = $bco_deposito;
    $this->fec_depo_ = $fec_depo_;
    $this->tipo_depo= $tipo_depo;
    $this->obs_doc =$obs_doc;
    $this->vbg =$vbg ;
    $this->vba = $vba;
    $this->vbc = $vbc;
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
                              $nom_deu = strtoupper($row['nom_deudor']);
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
    ///////////////////////////////////////
    ///Modificar Documento
    //////////////////////////////////////
    public function mod_doc() {

        try{
           
            $pdo = AccesoDB::getCon();

            $sql_mod_doc = "UPDATE `documentos`
            SET
            `FEC_PAGO_FINAL` = :fecha_pago,
            `DIAS_MORA` = :dias_mora,
            `ABONO_CAPITAL` = :abono_capital,
            `INTERESES` = :intereses,
            `TOTAL_COBRAR_MORA` = :total_cobrar,
            `BCO_DEPOSITO` = :banco_abono,
            `FEC_DEPO_` = :fecha_depo,
            `TIPO_DEPO` = :tipo_abono,
            `OBS_DOC` = :obs_doc,
            `VB_ADMIN` = :vba,
            `VB_GENERAL` = :vbg,
            `VB_COMERCIAL` = :vbc,
            `EST_DOC` = :est_doc

            
            WHERE `NRO_DOC` = :num_doc";




            $stmt = $pdo->prepare($sql_mod_doc);
            $stmt->bindParam(":fecha_pago", $this->fec_pago_final, PDO::PARAM_STR);
            $stmt->bindParam(":num_doc", $this->id, PDO::PARAM_INT);
            $stmt->bindParam(":dias_mora", $this->dias_mora, PDO::PARAM_INT);
            $stmt->bindParam(":abono_capital", $this->abono_capital, PDO::PARAM_INT);
            $stmt->bindParam(":intereses", $this->intereses, PDO::PARAM_INT);
            $stmt->bindParam(":total_cobrar", $this->total_cobrar_mora, PDO::PARAM_INT);
            $stmt->bindParam(":banco_abono", $this->bco_deposito, PDO::PARAM_INT);
            $stmt->bindParam(":fecha_depo", $this->fec_depo_, PDO::PARAM_STR);
            $stmt->bindParam(":tipo_abono", $this->tipo_depo, PDO::PARAM_INT);
            $stmt->bindParam(":obs_doc", $this->obs_doc, PDO::PARAM_STR);
            $stmt->bindParam(":vbg", $this->vbg, PDO::PARAM_INT);
            $stmt->bindParam(":vba", $this->vba, PDO::PARAM_INT);
            $stmt->bindParam(":vbc", $this->vbc, PDO::PARAM_INT);
            $stmt->bindParam(":est_doc", $this->est_doc, PDO::PARAM_INT);

            $stmt->execute();
       
}


    catch (Exception $e) {
       echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
   }

}
}

?>