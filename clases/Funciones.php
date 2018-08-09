<?php

require_once '../recursos/db/db.php';


class Funciones 
{

    
    /*///////////////////////////////////////
    Generar password
    //////////////////////////////////////*/
    public function generaPass(){
            //Se define una cadena de caractares. Te recomiendo que uses esta.
            $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
            //Obtenemos la longitud de la cadena de caracteres
            $longitudCadena=strlen($cadena);
             
            //Se define la variable que va a contener la contraseña
            $pass = "";
            //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
            $longitudPass=6;
             
            //Creamos la contraseña
            for($i=1 ; $i<=$longitudPass ; $i++){
                //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
                $pos=rand(0,$longitudCadena-1);
             
                //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
                $pass .= substr($cadena,$pos,1);
            }
            return $pass;
        }



    /*///////////////////////////////////////
    Validar rut nuevo
    //////////////////////////////////////*/
        public function validar_rut($rut, $id) {

            try{
                $pdo = AccesoDB::getCon();


                if ($id == 0) {
                    $sql = "SELECT rut_cli FROM clientes where rut_cli = :rut";
                }else{
                    $sql = "SELECT rut_usu FROM usuarios where rut_usu = :rut";
                }


                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":rut", $rut, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }


    /*///////////////////////////////////////
    Cargar Cargos
    //////////////////////////////////////*/
        public function cargar_cargos($vig_cargo) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($vig_cargo == 0) {
                    $sql = "select cod_item id_cargo, desc_item cargo from tab_param where cod_grupo = 2 and cod_item <> 0";
                }else if ($vig_cargo == 1) {
                    $sql = "select cod_item id_cargo, desc_item cargo from tab_param where cod_grupo = 2 and cod_item <> 0 and vig_item = 1";
                }  
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar Perfiles
    //////////////////////////////////////*/
        public function cargar_perfiles($vig_usu) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($vig_usu == 0) {
                    $sql = "select cod_item id_perfil, desc_item perfil from tab_param where cod_grupo = 1 and cod_item <> 0";
                }else if ($vig_usu == 1) {
                    $sql = "select cod_item id_perfil, desc_item perfil from tab_param where cod_grupo = 1 and cod_item <> 0 and vig_item = 1";
                }  
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }




    /*///////////////////////////////////////
    Cargar datos de usuario
    //////////////////////////////////////*/
        public function cargar_datos_usu($id_usu){

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        $sql = "select concat(a.NOM1_USU,' ',a.NOM2_USU) nom, concat(a.APEPAT_USU,' ',a.APEPAT_USU) ape, a.RUT_USU rut,
                                a.MAIL_USU mail,c.desc_item perfil, a.FEC_CRE_USU fec, b.DESC_ITEM cargo, if(a.VIG_USU=1,'Vigente','No Vigente') vig, a.NICK_USU nick
                                from usuarios a, tab_param b, tab_param c
                                where a.CARGO_USU = b.COD_ITEM and b.COD_GRUPO = 2 and b.VIG_ITEM = 1 
                                and a.ID_PERFIL = c.COD_ITEM and c.COD_GRUPO = 1 and c.VIG_ITEM = 1
                                and a.ID_USU = :id_usu";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id_usu", $id_usu, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }
  




}
