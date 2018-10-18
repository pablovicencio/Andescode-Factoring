<?php

require_once '../recursos/db/db.php';


class Funciones 
{






   /*///////////////////////////////////////
    Cargar tipos de operaciones
    //////////////////////////////////////*/
        public function cargar_tipo_ope($vig_ope) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($vig_ope == 0) {
                    $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 6 and cod_item <> 0";
                }else if ($vig_ope == 1) {
                    $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 6 and cod_item <> 0 and vig_item = 1";
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
    Cargar Bancos
    //////////////////////////////////////*/
        public function cargar_bcos($vig_bcos) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($vig_bcos == 0) {
                    $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 5 and cod_item <> 0";
                }else if ($vig_bcos == 1) {
                    $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 5 and cod_item <> 0 and vig_item = 1";
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
    Validar usuario reset contraseña
    //////////////////////////////////////*/
        public function validar_usu($rut,$mail,$ident){

            try{
                
                
                $pdo = AccesoDB::getCon();

                            if ($ident == 0) {
                                $sql = "select id_cli id from clientes where rut_cli = :rut and mail_cli = :mail";
                            
                            }else if ($ident == 1) {
                                $sql = "select id_usu id from usuarios where rut_usu = :rut and mail_usu = :mail";
                            }
        
                       
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":rut", $rut, PDO::PARAM_STR);
                $stmt->bindParam(":mail", $mail, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchColumn();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Validar contraseña 
    //////////////////////////////////////*/
        public function validar_pwd($id,$ident){

            try{
                
                
                $pdo = AccesoDB::getCon();

                            if ($ident == 0) {
                                $sql = "select pass_cli pass
                                        from clientes where id_cli = :id";
                            
                            }else if ($ident == 1) {
                                $sql = "select pass_usu pass
                                        from usuarios where id_usu = :id";
                            }
        
                       
                                
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar dia +/- Cliente para calculo de plazo
    //////////////////////////////////////*/
        public function cargar_dia_cli($cli){

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                       
                                $sql = "select dia_cli
                                        from clientes where id_cli = :cli";
                            
                            

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar lista despegable de tipos de documentos
    //////////////////////////////////////*/
        public function cargar_tipo_doc($vig){

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        if ($vig == 0) {
                                $sql = "select cod_item, desc_item
                                        from tab_param where cod_grupo = 3 and cod_item <> 0 order by 2";
                            }else if ($vig == 1){
                                $sql = "select cod_item, desc_item
                                        from tab_param where cod_grupo = 3 and vig_item = 1 and cod_item <> 0 order by 2";
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
    Cargar lista despegable de clientes
    //////////////////////////////////////*/
        public function cargar_clientes($vig){

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        if ($vig == 0) {
                                $sql = "select id_cli, nom_cli
                                        from clientes order by 2";
                            }else if ($vig == 1){
                                $sql = "select id_cli, nom_cli
                                        from clientes where vig_cli = 1 order by 2";
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
    Cargar id de cliente
    //////////////////////////////////////*/
        public function cargar_id_cli($rut_cli){

            try{
                
                
                $pdo = AccesoDB::getCon();


                        
                     $sql = "select id_cli from clientes where rut_cli = :rut_cli";
                


                       
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":rut_cli", $rut_cli, PDO::PARAM_STR);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }



    
    /*///////////////////////////////////////
    Cargar lista despegable de usuarios
    //////////////////////////////////////*/
        public function cargar_usuarios($vig){

            try{
                
                
                $pdo = AccesoDB::getCon();


        
                        if ($vig == 0) {
                                $sql = "select id_usu, concat(nom1_usu,' ',apepat_usu,' ',apemat_usu,'-',nick_usu) usuario
                                        from usuarios order by 2";
                            }else if ($vig == 1){
                                $sql = "select id_usu, concat(nom1_usu,' ',apepat_usu,' ',apemat_usu,'-',nick_usu) usuario
                                        from usuarios where vig_usu = 1 order by 2";
                            }
                            

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }
        // /*///////////////////////////////////////
        // Cargar lista despegable de clientes
        // //////////////////////////////////////*/
        // public function cargar_clientes($vig){

        //     try{
                
                
        //         $pdo = AccesoDB::getCon();


        
        //                 if ($vig == 0) {
        //                         $sql = "select `ID_CLI`, `NOM_CLI`,`RUT_CLI` from clientes order by 2";
        //                     }else if ($vig == 1){
        //                         $sql = "select `ID_CLI`, `NOM_CLI`,`RUT_CLI` from clientes where `VIG_CLI` = 1 order by 2";
        //                     }
                            

        //         $stmt = $pdo->prepare($sql);
        //         $stmt->execute();

        //         $response = $stmt->fetchAll();
        //         return $response;

        //     } catch (Exception $e) {
        //         echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
        //     }
        // }

      

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
        public function cargar_datos_usu($id_usu,$sel){

            try{
                
                
                $pdo = AccesoDB::getCon();


                        
                if ($sel == 1) {
                     $sql = "select concat(a.NOM1_USU,' ',a.NOM2_USU) nom, concat(a.APEPAT_USU,' ',a.APEMAT_USU) ape, a.RUT_USU rut,
                                a.MAIL_USU mail,c.desc_item perfil, a.FEC_CRE_USU fec, b.DESC_ITEM cargo, if(a.VIG_USU=1,'Vigente','No Vigente') vig, a.NICK_USU nick
                                from usuarios a, tab_param b, tab_param c
                                where a.CARGO_USU = b.COD_ITEM and b.COD_GRUPO = 2 and b.VIG_ITEM = 1 
                                and a.ID_PERFIL = c.COD_ITEM and c.COD_GRUPO = 1 and c.VIG_ITEM = 1
                                and a.ID_USU = :id_usu";
                }else if ($sel == 2) {
                    $sql = "select a.NOM1_USU,a.NOM2_USU , a.APEPAT_USU,a.APEMAT_USU, a.RUT_USU ,
                                a.MAIL_USU ,a.id_perfil, DATE_FORMAT(a.fec_cre_usu, '%d-%m-%Y') fec_cre_usu, a.cargo_usu, a.VIG_USU, a.NICK_USU
                                from usuarios a
                                where 
                                a.ID_USU = :id_usu";
                }  



                       
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":id_usu", $id_usu, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }


    /*///////////////////////////////////////
    Cargar datos de Cliente
    //////////////////////////////////////*/
    public function cargar_datos_cli($id_cli,$sel){

        try{
            
            
            $pdo = AccesoDB::getCon();


                    
            if ($sel == 1) {
                 $sql = "";
            }else if ($sel == 2) {
                $sql = "select *                

                from clientes where ID_CLI = :id_cli";
            }  



                   
            

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":id_cli", $id_cli, PDO::PARAM_INT);
            $stmt->execute();

            $response = $stmt->fetchAll();
            return $response;

        } catch (Exception $e) {
            echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
        }
    }
  






}
