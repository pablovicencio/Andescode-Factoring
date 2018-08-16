<?php
require_once '../recursos/db/db.php';
   

/*/////////////////////////////
Clase Gastos Operacionales
////////////////////////////*/

class GastosOpeDAO 
{
    private $id;
	private $not_deudor_gasto;
    private $envio_correo_gasto;
    private $proc_gasto;
    private $copia_fac_gasto;
    private $sii_cert_gasto;
    private $vig_gasto;

    public function __construct($id=null,
                                $not_deudor_gasto=null,
                                $envio_correo_gasto=null,
                                $proc_gasto=null,
                                $copia_fac_gasto=null,
                                $sii_cert_gasto=null,
                            	$vig_gasto=null) {



    $this->id = $id;
    $this->not_deudor = $not_deudor_gasto;
    $this->envio_correo = $envio_correo_gasto;
    $this->proc = $proc_gasto;
    $this->copia_fac = $copia_fac_gasto;
    $this->sii_cert = $sii_cert_gasto;
    $this->vig = $vig_gasto;
    }

    public function getGastosOpe() {
    return $this->id;
    }

    /*///////////////////////////////////////
    Crear Gastos Operacionales
    //////////////////////////////////////*/
    public function crear_GastosOpe($id_cli) {

    			 try{
             
                $pdo = AccesoDB::getCon();

                $sql_crear_gastos = "INSERT INTO `gastos_ope`(`NOT_DEUDOR_GASTO`,`ENVIO_CORREO_GASTO`,`PROC_GASTO`,`COPIA_FAC_GASTO`,`SII_CERT_GASTO`,`VIG_GASTO`,`ID_CLI_GASTO`)
									VALUES(:not_deudor,:envio_correo,:proc_gasto,:copia_fac,:sii_cert,:vig,:cli)";


                $stmt = $pdo->prepare($sql_crear_gastos);
                $stmt->bindParam(":not_deudor", $this->not_deudor, PDO::PARAM_INT);
                $stmt->bindParam(":envio_correo", $this->envio_correo, PDO::PARAM_INT);
                $stmt->bindParam(":proc_gasto", $this->proc, PDO::PARAM_INT);
                $stmt->bindParam(":copia_fac", $this->copia_fac, PDO::PARAM_INT);
                $stmt->bindParam(":sii_cert", $this->sii_cert, PDO::PARAM_INT);
                $stmt->bindParam(":vig", $this->vig, PDO::PARAM_BOOL);
                $stmt->bindParam(":cli", $id_cli, PDO::PARAM_INT);
                $stmt->execute();
        

            } catch (Exception $e) {
                echo"Error, comuniquese con el administrador".  $e->getMessage().""; 
            }

    }

}