<?php
session_start();

 if( isset($_SESSION['id_fac']) and ($_SESSION['perfil_fac'] <> 0) ){
  		//Si la sesión esta seteada no hace nada
  		$id = $_SESSION['id_fac'];
  	}
  	else{
 		//Si no lo redirige a la pagina index para que inicie la sesion	
 		echo("0");
 		goto salir;
 	}         
	     
	require_once '../clases/Funciones.php';
 	require_once '../clases/ClaseDocumento.php';

	try{

        

        $nro_doc = $_POST['num_doc'];
        $fecha_pago = $_POST['fec_pag'];
        $dias_mora =$_POST['dias_mora'];
        $intereses = $_POST['intereses'];
        $total_cobrar = $_POST['total_cobrar'];
        $abono_capital = $_POST['abonocapital'];
        $tipo_abono = $_POST['forma_pago_doc'];
        $fecha_depo = $_POST['fec_depo'];
        $banco_abono = $_POST['bco_depo_deu'];
 		$obs_doc = $_POST['obs_doc'];
        if (isset($_POST['vbg'])) {
			$vbg = 1;
		}else{
			$vbg = 0;
        }
        if (isset($_POST['vba'])) {
			$vba = 1;
		}else{
			$vba = 0;
        }
        if (isset($_POST['vbc'])) {
			$vbc = 1;
		}else{
			$vbc = 0;
		}

        $est_doc = 2;


         
        //echo ("NRO DOC : ".$nro_doc."FECHA PAGO: ". $fecha_pago." DIAS MORA: ". $dias_mora." INTERESES: ". $intereses." TOTAL COBRAR: ". $total_cobrar." ABONO CAPITAL: ".$abono_capital." TIPO ABONO: ".$tipo_abono." FECHA DEPO: ". $fecha_depo);
        //echo ("BANCO ABONO: ".$banco_abono."OBS DOC : ". $obs_doc." VISTO BUENO GERENCIA : ". $vbg." VISTO BUENO ADMINISTRACION : ". $vba." VISTO BUENO COMERCIAL : ". $vbc);
        
        $dao = new DocumentoDAO($nro_doc,'','',$est_doc,'',$fecha_pago,$dias_mora,$intereses,$abono_capital,$total_cobrar,$banco_abono,$fecha_depo,$tipo_abono,$obs_doc,$vbg,$vba,$vbc); 		
        $mod_doc = $dao->mod_doc();
        if (count($mod_doc)>0){
            echo "1";    
        } else {
        
        echo "Documento Modificado Correctamente.";  
            
                }
	salir:
	
	} catch (Exception $e) {
		echo"1"; 
	}
?>