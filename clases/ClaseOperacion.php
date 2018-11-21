<?php
require_once '../recursos/db/db.php';
   

/*/////////////////////////////
Clase Operación
////////////////////////////*/

class OperacionDAO 
{
    private $id_ope ;
    private $fec_ope ;
    private $id_usu ;
    private $tipo_ope ;
    private $obs_ope ;
    private $tasa_ope ;
    private $com_cob ;
    private $com_cur ;
    private $ape_ope ;
    private $dia_ope ;
    private $otros_desc_ope ;
    private $nro_cta_dest_ope ;
    private $monto_giro ;
    private $cli_ope;
    private $bco_giro_ope;
    private $bco_dep_ope;
    private $fec_reg;
    private $est_ope;
    private $iva_com_cob;
    private $iva_comi_tot;
    private $forma_giro;


    public function __construct(    $id_ope=null,
                                    $fec_ope=null,
                                    $id_usu=null,
                                    $tipo_ope=null,
                                    $obs_ope=null,
                                    $tasa_ope=null,
                                    $com_cob=null,
                                    $com_cur=null,
                                    $ape_ope=null,
                                    $dia_ope=null,
                                    $otros_desc_ope=null,
                                    $nro_cta_dest_ope=null,
                                    $monto_giro=null,
                                    $cli_ope=null,
                                    $bco_giro_ope=null,
                                    $bco_dep_ope=null,
                                    $fec_reg=null,
                                    $est_ope=null,
                                    $iva_com_cob=null,
                                    $iva_comi_tot=null,
                                    $forma_giro=null) {


    $this->id_ope =$id_ope;
    $this->fec_ope =$fec_ope;
    $this->id_usu=$id_usu;
    $this->tipo_ope=$tipo_ope;
    $this->obs_ope=$obs_ope;
    $this->tasa_ope=$tasa_ope;
    $this->com_cob=$com_cob;
    $this->com_cur=$com_cur;
    $this->ape_ope=$ape_ope;
    $this->dia_ope=$dia_ope;
    $this->otros_desc_ope=$otros_desc_ope;
    $this->nro_cta_dest_ope=$nro_cta_dest_ope;
    $this->monto_giro=$monto_giro;
    $this->cli_ope=$cli_ope;
    $this->bco_giro_ope=$bco_giro_ope;
    $this->bco_dep_ope=$bco_dep_ope;
    $this->fec_reg=$fec_reg;
    $this->est_ope=$est_ope;
    $this->iva_com_cob=$iva_com_cob;
    $this->iva_comi_tot=$iva_comi_tot;
    $this->forma_giro=$forma_giro;


    }

    public function getOpe() {
    return $this->id_ope;
    }

    /*///////////////////////////////////////
    Guardar Operación
    //////////////////////////////////////*/
    public function ing_ope($cargo) {

    			 try{
             
                $pdo = AccesoDB::getCon();

                $sql_ing_ope = "INSERT INTO `operaciones`(`FEC_OPE`,`USU_OPE`,`TIPO_OPE`,`OBS_OPE`,`TASA_OPE`,`COM_COB_OPE`,`COM_CUR_OPE`,`APERTURA_OPE`,`DIA_OPE`,`OTROS_DESC_OPE`,`MONTO_GIRO_OPE`,`CLI_OPE`,`FEC_REG_OPE`,`EST_OPE`,`IVA_COM_COB_OPE`,`IVA_COM_OPE`)
                    VALUES(:fec_ope, :usu_ope, :tipo_ope, :obs_ope, :tasa_ope, :com_cob_ope, :com_cur_ope, :apertura_ope, :dia_ope, :otros_desc_ope, :monto_giro_ope, :cli_ope, :fec_reg_ope, :est_ope, :iva_com_cob, :iva_comi_tot)";


                $stmt = $pdo->prepare($sql_ing_ope);
                $stmt->bindParam(":fec_ope", $this->fec_ope, PDO::PARAM_STR);
                $stmt->bindParam(":usu_ope", $this->id_usu, PDO::PARAM_INT);
                $stmt->bindParam(":tipo_ope", $this->tipo_ope, PDO::PARAM_INT);
                $stmt->bindParam(":obs_ope", $this->obs_ope, PDO::PARAM_STR);
                $stmt->bindParam(":tasa_ope", $this->tasa_ope, PDO::PARAM_INT);
                $stmt->bindParam(":com_cob_ope", $this->com_cob, PDO::PARAM_INT);
                $stmt->bindParam(":com_cur_ope", $this->com_cur, PDO::PARAM_INT);
                $stmt->bindParam(":apertura_ope", $this->ape_ope, PDO::PARAM_INT);
                $stmt->bindParam(":dia_ope", $this->dia_ope, PDO::PARAM_INT);
                $stmt->bindParam(":otros_desc_ope", $this->otros_desc_ope, PDO::PARAM_INT);
                $stmt->bindParam(":monto_giro_ope", $this->monto_giro, PDO::PARAM_INT);
                $stmt->bindParam(":cli_ope", $this->cli_ope, PDO::PARAM_INT);
                $stmt->bindParam(":fec_reg_ope", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":est_ope", $this->est_ope, PDO::PARAM_INT);
                $stmt->bindParam(":iva_com_cob", $this->iva_com_cob, PDO::PARAM_INT);
                $stmt->bindParam(":iva_comi_tot", $this->iva_comi_tot, PDO::PARAM_INT);
                $stmt->execute();

                $sql_ope = "select  id_ope from operaciones order by id_ope desc limit 1";


                $stmt = $pdo->prepare($sql_ope);
                $stmt->execute();

                $response = $stmt->fetchAll();

                $id_ope =($response[0]['id_ope']);

                $sql_ing_log_ope = "INSERT INTO `log_ope`
                                    (`id_ope`,
                                    `est_ant_ope`,
                                    `est_nue_ope`,
                                    `obs_log_ope`,
                                    `id_usu`,
                                    `fec_log_ope`,
                                    `cargo_usu_log`)
                                    VALUES
                                    (:id_ope,
                                    0,
                                    1,
                                    '',
                                    :usu,
                                    :fec,
                                    :cargo)";


                $stmt = $pdo->prepare($sql_ing_log_ope);
                $stmt->bindParam(":id_ope", $id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":cargo", $cargo, PDO::PARAM_INT);
                
                $stmt->execute();





                return $response;


        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }

    }







    /*///////////////////////////////////////
    Actualizar Operación
    //////////////////////////////////////*/
    public function act_ope( $contratocesion, $dicomdeudorescli, $informeconfir, $ivaform , $cobrogastos , $garantia, $cargo,$est_ope) {

                 try{
             
                $pdo = AccesoDB::getCon();

                $sql_act_ope = "UPDATE `operaciones`
                                SET
                                `EST_OPE` = :est
                                WHERE `ID_OPE` =  :id_ope";


                $stmt = $pdo->prepare($sql_act_ope);
                $stmt->bindParam(":est", $est_ope, PDO::PARAM_INT);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);

                $stmt->execute();


                $sql_ing_log_ope = "INSERT INTO `log_ope`
                                    (`id_ope`,
                                    `est_ant_ope`,
                                    `est_nue_ope`,
                                    `obs_log_ope`,
                                    `id_usu`,
                                    `fec_log_ope`,
                                    `cargo_usu_log`)
                                    VALUES
                                    (:id_ope,
                                    :est_act,
                                    :est,
                                    :obs,
                                    :usu,
                                    :fec,
                                    :cargo)";


                $stmt = $pdo->prepare($sql_ing_log_ope);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":est_act", $this->est_ope, PDO::PARAM_INT);
                $stmt->bindParam(":est", $est_ope, PDO::PARAM_INT);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                $stmt->bindParam(":obs", $this->obs_ope, PDO::PARAM_STR);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":cargo", $cargo, PDO::PARAM_INT);
                
                $stmt->execute();

                if ($contratocesion <> 0) {
                    $sql_ing_check_ope = "INSERT INTO `bd_factoring`.`check_ope`
                                                (`ID_OPE`,
                                                `ID_GRUPO`,
                                                `ID_PARAM`,
                                                `OBS_LOG`,
                                                `VIG_LOG`,
                                                `FEC_LOG`,
                                                `ID_USU`)
                                                VALUES
                                                (:id_ope,
                                                9,
                                                :param,
                                                ' ',
                                                1,
                                                :fec,
                                                :usu)";


                $stmt = $pdo->prepare($sql_ing_check_ope);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":param", $contratocesion, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                
                
                $stmt->execute();
                }

                if ($dicomdeudorescli <> 0) {
                    $sql_ing_check_ope = "INSERT INTO `bd_factoring`.`check_ope`
                                                (`ID_OPE`,
                                                `ID_GRUPO`,
                                                `ID_PARAM`,
                                                `OBS_LOG`,
                                                `VIG_LOG`,
                                                `FEC_LOG`,
                                                `ID_USU`)
                                                VALUES
                                                (:id_ope,
                                                9,
                                                :param,
                                                ' ',
                                                1,
                                                :fec,
                                                :usu)";


                $stmt = $pdo->prepare($informeconfir);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":param", $dicomdeudorescli, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                
                
                $stmt->execute();
                }

                if ($informeconfir <> 0) {
                    $sql_ing_check_ope = "INSERT INTO `bd_factoring`.`check_ope`
                                                (`ID_OPE`,
                                                `ID_GRUPO`,
                                                `ID_PARAM`,
                                                `OBS_LOG`,
                                                `VIG_LOG`,
                                                `FEC_LOG`,
                                                `ID_USU`)
                                                VALUES
                                                (:id_ope,
                                                9,
                                                :param,
                                                ' ',
                                                1,
                                                :fec,
                                                :usu)";


                $stmt = $pdo->prepare($ivaform);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":param", $informeconfir, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                
                
                $stmt->execute();
                }

                if ($ivaform <> 0) {
                    $sql_ing_check_ope = "INSERT INTO `bd_factoring`.`check_ope`
                                                (`ID_OPE`,
                                                `ID_GRUPO`,
                                                `ID_PARAM`,
                                                `OBS_LOG`,
                                                `VIG_LOG`,
                                                `FEC_LOG`,
                                                `ID_USU`)
                                                VALUES
                                                (:id_ope,
                                                9,
                                                :param,
                                                ' ',
                                                1,
                                                :fec,
                                                :usu)";


                $stmt = $pdo->prepare($sql_ing_check_ope);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":param", $ivaform, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                
                
                $stmt->execute();
                }

                 if ($cobrogastos <> 0) {
                    $sql_ing_check_ope = "INSERT INTO `bd_factoring`.`check_ope`
                                                (`ID_OPE`,
                                                `ID_GRUPO`,
                                                `ID_PARAM`,
                                                `OBS_LOG`,
                                                `VIG_LOG`,
                                                `FEC_LOG`,
                                                `ID_USU`)
                                                VALUES
                                                (:id_ope,
                                                9,
                                                :param,
                                                ' ',
                                                1,
                                                :fec,
                                                :usu)";


                $stmt = $pdo->prepare($sql_ing_check_ope);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":param", $cobrogastos, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                
                
                $stmt->execute();
                }

                if ($garantia <> 0) {
                    $sql_ing_check_ope = "INSERT INTO `bd_factoring`.`check_ope`
                                                (`ID_OPE`,
                                                `ID_GRUPO`,
                                                `ID_PARAM`,
                                                `OBS_LOG`,
                                                `VIG_LOG`,
                                                `FEC_LOG`,
                                                `ID_USU`)
                                                VALUES
                                                (:id_ope,
                                                9,
                                                :param,
                                                ' ',
                                                1,
                                                :fec,
                                                :usu)";


                $stmt = $pdo->prepare($sql_ing_check_ope);
                $stmt->bindParam(":id_ope", $this->id_ope, PDO::PARAM_INT);
                $stmt->bindParam(":param", $garantia, PDO::PARAM_INT);
                $stmt->bindParam(":fec", $this->fec_reg, PDO::PARAM_STR);
                $stmt->bindParam(":usu", $this->id_usu, PDO::PARAM_INT);
                
                
                $stmt->execute();
                }

                





        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }

    }

}