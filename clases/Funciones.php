<?php

require_once '../recursos/db/db.php';


class Funciones 
{



    /*///////////////////////////////////////
    Cargar cartera cursatura
    //////////////////////////////////////*/
        public function cargar_cartera($id_cli, $id) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($id == 1) {
                    $sql = "select 
                            sum(a.monto_finan_doc) monto,
                            case 
                                when DATEDIFF(curdate(), a.fec_ven_doc) <= 15 then '15'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 15 and DATEDIFF(curdate(), a.fec_ven_doc) <= 30 then '30'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 30 and DATEDIFF(curdate(), a.fec_ven_doc) <= 60 then '60'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 60 then '70'
                            end rango,

                            case 
                                when DATEDIFF(curdate(), a.fec_ven_doc) <= 15 then '0 a 15 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 15 and DATEDIFF(curdate(), a.fec_ven_doc) <= 30 then '15 a 30 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 30 and DATEDIFF(curdate(), a.fec_ven_doc) <= 60 then '30 a 60 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 60 then 'Más de 60 Días:'
                            end desc_rango
                             from documentos a where a.fec_ven_doc < curdate()
                                  and a.id_ope in (select id_ope from operaciones where cli_ope = :cli)
                             group by  a.fec_ven_doc order by 2";
                }else if ($id = 2) {
                    $sql = "select 
                            sum(a.monto_finan_doc) monto,
                            case 
                                when DATEDIFF(curdate(), a.fec_ven_doc) <= 15 then '15'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 15 and DATEDIFF(curdate(), a.fec_ven_doc) <= 30 then '30'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 30 and DATEDIFF(curdate(), a.fec_ven_doc) <= 60 then '60'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 60 and DATEDIFF(curdate(), a.fec_ven_doc) <= 90 then '90'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 90 then '100'
                            end rango,

                            case 
                                when DATEDIFF(curdate(), a.fec_ven_doc) <= 15 then '0 a 15 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 15 and DATEDIFF(curdate(), a.fec_ven_doc) <= 30 then '15 a 30 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 30 and DATEDIFF(curdate(), a.fec_ven_doc) <= 60 then '30 a 60 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 60 and DATEDIFF(curdate(), a.fec_ven_doc) <= 90 then '61 a 90 Días:'
                                when DATEDIFF(curdate(), a.fec_ven_doc) > 90 then 'Más de 90 Días:'
                            end desc_rango
                             from documentos a where a.fec_ven_doc > curdate()
                                  and a.id_ope in (select id_ope from operaciones where cli_ope = :cli)
                             group by  a.fec_ven_doc order by 2";
                }

                
                    
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":cli", $id_cli, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }









    /*///////////////////////////////////////
    Cargar monto giro cursatura
    //////////////////////////////////////*/
        public function cargar_monto_giro($id_ope) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                
                    $sql = "select sum(monto_finan_doc) monto from documentos where id_ope = :ope";
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":ope", $id_ope, PDO::PARAM_INT);
                $stmt->execute();

                $response = $stmt->fetchAll();
                return $response;

            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }



    /*///////////////////////////////////////
    Cargar formas de giro
    //////////////////////////////////////*/
        public function cargar_formas_giro($vig_giro) {

            try{
                
                
                $pdo = AccesoDB::getCon();

                if ($vig_giro == 0) {
                    $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 8 and cod_item <> 0";
                }else if ($vig_giro == 1) {
                    $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 8 and cod_item <> 0 and vig_item = 1";
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
    Cargar Datos de aprobaciones de usuarios para form cursatura
    //////////////////////////////////////*/
    public function cargar_aprobaciones($idope){

        try{
            $pdo = AccesoDB::getCon();
                
                
                $sql = " select a.est_nue_ope, concat(b.nom1_usu,' ', b.apepat_usu) nom, c.desc_item,a.obs_log_ope
                         from log_ope a, usuarios b, tab_param c 
                         where a.id_usu = b.id_usu and id_ope = :ope
                         and c.cod_grupo = 2 and c.cod_item = a.cargo_usu_log and c.vig_item = 1";
            
            
               

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":ope", $idope, PDO::PARAM_INT);
            $stmt->execute();

            $response = $stmt->fetchAll();
            return $response;

        } catch (Exception $e) {
            echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
        }
    }



    /*///////////////////////////////////////
    Cargar Datos de detalle de la operacion (check_cursatura) 
    //////////////////////////////////////*/
    public function cargar_datos_det_ope($idope){

        try{
            $pdo = AccesoDB::getCon();
                
                
                $sql = "select a.est_ope,t_o.desc_item tipo_ope, a.id_ope,a.fec_ope,
                        (select count(id_doc) from documentos d where d.id_ope = a.id_ope) cant_doc,
                        (select t_d.desc_item from tab_param t_d where cod_grupo = 3 and t_d.cod_item = 
                                (select distinct tipo_doc from documentos e where e.id_ope = a.id_ope)) tipo_doc,
                        round(((select sum(plazo_doc) from documentos e where e.id_ope = a.id_ope)/
                        (select count(id_doc) from documentos d where d.id_ope = a.id_ope)
                        ),0) plazo_prom,
                         round(((select sum(anticipo_porc) from documentos e where e.id_ope = a.id_ope)/
                        (select count(id_doc) from documentos d where d.id_ope = a.id_ope)
                        ),0) anticipo_prom,
                        a.com_cob_ope, a.tasa_ope,
                        round(((select sum(COM_COB_DOC) from documentos e where e.id_ope = a.id_ope)/
                        (select count(id_doc) from documentos d where d.id_ope = a.id_ope)
                        ),0) ing_por_ope,
                        (select sum(monto_doc) from documentos d where d.id_ope = a.id_ope) monto_docs,
                        (select sum(monto_finan_doc) from documentos d where d.id_ope = a.id_ope) monto_finan,
                        (select sum(dif_pre_doc) from documentos d where d.id_ope = a.id_ope) dif_pre,
                        (select sum(anticipo_doc) from documentos d where d.id_ope = a.id_ope) ant_doc,
                        round(((select sum(monto_doc) from documentos d where d.id_ope = a.id_ope)*
                        (select (sum(com_cob_doc) /100)/30 from documentos d where d.id_ope = a.id_ope)
                        *((select sum(plazo_doc) from documentos e where e.id_ope = a.id_ope)/
                        (select count(id_doc) from documentos d where d.id_ope = a.id_ope)
                        )),0) serv_fact,
                        (a.com_cur_ope + a.iva_com_ope) serv_adm,
                        (select total_gasto_ope from gastos_ope g where g.id_ope_gasto = a.id_ope) gasto_ope,
                        a.monto_giro_ope, a.obs_ope
                        from operaciones a, tab_param t_o
                        where a.id_ope = :ope and  t_o.cod_grupo = 6 and t_o.COD_ITEM = a.tipo_ope";
            
            
               

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":ope", $idope, PDO::PARAM_INT);
            $stmt->execute();

            $response = $stmt->fetchAll();
            return $response;

        } catch (Exception $e) {
            echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
        }
    }




   /*///////////////////////////////////////
    Contar Ope para resumen por cargo
    //////////////////////////////////////*/
        public function contador_ope($cargo){

            try{
                
                
                $pdo = AccesoDB::getCon();


               if ($cargo == 2) {
                  $sql = "select count(id_ope) ope from operaciones where est_ope = 1";
               }elseif ($cargo == 3) {
                   $sql = "select count(id_ope) ope from operaciones where est_ope = 3";
               }
                    
                
                

                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                

                $totalFilas    =    $stmt->rowCount();

                if ($totalFilas == 0 ) {
                    return ('0');
                 }else{
                $response = $stmt->fetchAll();
                   return $response;
                 }


            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }




   /*///////////////////////////////////////
    Validar rut deudor
    //////////////////////////////////////*/
        public function validar_rut_deudor($rut) {

            try{
                
                
                $pdo = AccesoDB::getCon();

               
                    $sql = "select nom_deu_doc from documentos where rut_deu_doc = :rut order by 1 limit 1";
                
                

                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":rut", $rut, PDO::PARAM_STR);
                $stmt->execute();

                

                $totalFilas    =    $stmt->rowCount();

                if ($totalFilas == 0 ) {
                    return ('0');
                 }else{
                $response = $stmt->fetchAll();
                   return $response;
                 }


            } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
            }
        }








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
    Cargar Bancos
    //////////////////////////////////////*/
    public function formas_pago_doc($vig_bcos) {

        try{
            
            
            $pdo = AccesoDB::getCon();

            if ($vig_bcos == 0) {
                $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 9 and cod_item <> 0";
            }else if ($vig_bcos == 1) {
                $sql = "select cod_item , desc_item  from tab_param where cod_grupo = 9 and cod_item <> 0 and vig_item = 1";
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
    Cargar Datos de Operaciones 
    //////////////////////////////////////*/
    public function cargar_datos_ope($cargo){

        try{
            $pdo = AccesoDB::getCon();
            if($cargo == 1){
                $sql = "SELECT O.ID_OPE OPE,O.FEC_OPE FECHA,U.NICK_USU USUARIO,T1.DESC_ITEM TIPO,TASA_OPE TASA,MONTO_GIRO_OPE GIRADO,C.NOM_CLI CLIENTE,C.RUT_CLI RUT,T2.DESC_ITEM AS ESTADO
                FROM OPERACIONES O, USUARIOS U,TAB_PARAM T1,CLIENTES C,TAB_PARAM T2
                WHERE O.EST_OPE = T2.COD_ITEM AND T2.COD_GRUPO = 7 AND T2.VIG_ITEM = 1
                AND O.TIPO_OPE = T1.COD_ITEM AND T1.COD_GRUPO = 3 AND T1.VIG_ITEM = 1
                AND U.ID_USU = O.USU_OPE AND  C.ID_CLI = O.CLI_OPE  ORDER BY fecha DESC";
            }elseif($cargo == 2){
                $sql = "SELECT O.ID_OPE OPE,O.FEC_OPE FECHA,U.NICK_USU USUARIO,T1.DESC_ITEM TIPO,TASA_OPE TASA,MONTO_GIRO_OPE GIRADO,C.NOM_CLI CLIENTE,C.RUT_CLI RUT,T2.DESC_ITEM AS ESTADO
                FROM OPERACIONES O, USUARIOS U,TAB_PARAM T1,CLIENTES C,TAB_PARAM T2
                WHERE O.EST_OPE = T2.COD_ITEM AND T2.COD_GRUPO = 7 AND T2.VIG_ITEM = 1
                AND O.TIPO_OPE = T1.COD_ITEM AND T1.COD_GRUPO = 3 AND T1.VIG_ITEM = 1
                AND U.ID_USU = O.USU_OPE AND O.EST_OPE = 1 AND  C.ID_CLI = O.CLI_OPE  ORDER BY fecha DESC";
            }elseif($cargo == 3){
                $sql = "SELECT O.ID_OPE OPE,O.FEC_OPE FECHA,U.NICK_USU USUARIO,T1.DESC_ITEM TIPO,TASA_OPE TASA,MONTO_GIRO_OPE GIRADO,C.NOM_CLI CLIENTE,C.RUT_CLI RUT,T2.DESC_ITEM AS ESTADO
                FROM OPERACIONES O, USUARIOS U,TAB_PARAM T1,CLIENTES C,TAB_PARAM T2
                WHERE O.EST_OPE = T2.COD_ITEM AND T2.COD_GRUPO = 7 AND T2.VIG_ITEM = 1
                AND O.TIPO_OPE = T1.COD_ITEM AND T1.COD_GRUPO = 3 AND T1.VIG_ITEM = 1
                AND U.ID_USU = O.USU_OPE AND T2.COD_ITEM = 3 AND  C.ID_CLI = O.CLI_OPE  ORDER BY fecha DESC";
            }
            // }else if ($opc == 2){
            //     $sql = "SELECT O.ID_OPE OPE,DATE_FORMAT(O.FEC_OPE, '%d-%m-%Y') FECHA,U.NICK_USU USUARIO,T1.DESC_ITEM TIPO,TASA_OPE TASA,MONTO_GIRO_OPE GIRADO,C.NOM_CLI CLIENTE,C.RUT_CLI RUT,T2.DESC_ITEM AS ESTADO
            //     FROM OPERACIONES O, USUARIOS U,TAB_PARAM T1,CLIENTES C,TAB_PARAM T2
            //     WHERE O.EST_OPE = T2.COD_ITEM AND T2.COD_GRUPO = 7 AND T2.VIG_ITEM = 1
            //     AND O.TIPO_OPE = T1.COD_ITEM AND T1.COD_GRUPO = 3 AND T1.VIG_ITEM = 1
            //     AND U.ID_USU = O.USU_OPE AND  C.ID_CLI = O.CLI_OPE and T2.DESC_ITEM = 'APROBADA'";

            //}
            
            
               

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            


            $totalFilas    =    $stmt->rowCount();

                if ($totalFilas == 0 ) {
                    return ('0');
                 }else{
                   $response = $stmt->fetchAll();
                   return $response;
                 }
         

        } catch (Exception $e) {
            echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
        }
    }
    /*///////////////////////////////////////
    Cargar Facturas
    //////////////////////////////////////*/
    public function cargar_facturas($opcion,$doc){

        try{
            $pdo = AccesoDB::getCon();
            
            if($opcion == 1){
                $sql = "SELECT D.ID_OPE,D.NOM_DEU_DOC,D.RUT_DEU_DOC,D.NRO_DOC,D.MONTO_DOC,D.MONTO_FINAN_DOC,O.TASA_OPE,DATE_FORMAT(D.FEC_VEN_DOC, '%d-%m-%Y') vencimiento,D.PLAZO_DOC
                FROM DOCUMENTOS D,OPERACIONES O
                WHERE FEC_VEN_DOC < CURDATE() AND D.ID_OPE = O.ID_OPE AND D.EST_DOC <> 2";
            }elseif($opcion== 2){
                $sql = "SELECT *
                FROM DOCUMENTOS D,OPERACIONES O,CLIENTES C,TAB_PARAM T
                WHERE O.CLI_OPE = C.ID_CLI AND D.FEC_VEN_DOC < CURDATE() AND D.ID_OPE = O.ID_OPE AND D.NRO_DOC = :doc AND D.TIPO_DOC = T.COD_ITEM AND T.COD_GRUPO = 6 AND T.VIG_ITEM = 1 ;";
            }
            

        
            
            
               

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":doc", $doc, PDO::PARAM_INT);
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
    Cargar datos de usuario
    //////////////////////////////////////*/
    public function cargar_datos_perfiles(){

        try{
            
            
            $pdo = AccesoDB::getCon();
            $sql = "select u.id_usu,concat(u.NOM1_USU,' ',u.APEPAT_USU) nom,RUT_USU as rut,MAIL_USU as mail,a.desc_item as perf, DATE_FORMAT(u.fec_cre_usu, '%d-%m-%Y') as crea,b.desc_item as carg,if(u.vig_usu=1, 'Vigente','No Vigente') as vig
            from usuarios u , tab_param a,tab_param b
            where u.id_perfil = a.cod_item and a.cod_grupo = 1 and a.vig_item = 1
            and u.cargo_usu =  b.cod_item and b.cod_grupo = 2 and b.vig_item = 1";
        



                   
            

            $stmt = $pdo->prepare($sql);
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
    public function cargar_datos_cli_ope($ope){

        try{
            
            
            $pdo = AccesoDB::getCon();


                    
            
                $sql = "select a.id_cli,
                        a.nom_cli, b.fec_ope ,
                        a.linea_cred_cli, 
                        (select sum(monto_giro_ope) from operaciones c where (c.est_ope = 3 or c.cli_ope = a.id_cli)) ocupada,
                        a.linea_cred_cli, a.bco_cli,a.nro_cta_cli, a.mail_cli
                        from clientes a inner join  operaciones b on a.id_cli = b.cli_ope where id_ope = :ope";
    



                   
            

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":ope", $ope, PDO::PARAM_INT);
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

    /*///////////////////////////////////////
    Llenar Info Deudores cursatura
    //////////////////////////////////////*/

    public function infodeudores($idope){

        try{
            
            
            $pdo = AccesoDB::getCon();

            //OJO CON EL CALCULO DE LA MORA, SOLO SE TOMARA EL MONTO FINANCIADO
            
                
            
            // $sql = "select 
            //         a.nom_deu_doc, 
            //         round((sum(a.dif_pre_doc) + sum(a.com_cob_doc) + sum(a.anticipo_doc)), 0) deuda_ope,
            //         (select round((sum(a.dif_pre_doc) + sum(a.com_cob_doc) + sum(a.anticipo_doc)), 0) 
            //             from documentos b 
            //             where b.rut_deu_doc = a.rut_deu_doc and b.est_doc = 1 group by b.rut_deu_doc) deuda_cli,
            //         round(((select round((sum(a.dif_pre_doc) + sum(a.com_cob_doc) + sum(a.anticipo_doc)), 0) 
            //             from documentos b 
            //             where b.rut_deu_doc = a.rut_deu_doc and b.est_doc = 1 group by b.rut_deu_doc) / c.LINEA_CRED_CLI),2) conc_cli,
            //         round((1.5/(select DATEDIFF(CURDATE() ,b.fec_ven_doc) * b.monto_finan_doc
            //             from documentos b 
            //             where b.rut_deu_doc = a.rut_deu_doc and b.est_doc = 1 group by b.rut_deu_doc) ) ,0) mora_cli
            //         from documentos a inner join operaciones b on a.id_ope = b.id_ope
            //         inner join clientes c on b.cli_ope = c.id_cli
            //         where a.id_ope = :idope
            //         group by a.NOM_DEU_DOC order by a.nom_deu_doc";

            $sql = "select 
                    a.nom_deu_doc, 
                    round((sum(a.dif_pre_doc) + sum(a.com_cob_doc) + sum(a.anticipo_doc)), 0) deuda_ope,
                    (select round((sum(a.dif_pre_doc) + sum(a.com_cob_doc) + sum(a.anticipo_doc)), 0) 
                        from documentos b 
                        where b.rut_deu_doc = a.rut_deu_doc and b.est_doc = 1 group by b.rut_deu_doc) deuda_cli,
                    round(((select round((sum(a.dif_pre_doc) + sum(a.com_cob_doc) + sum(a.anticipo_doc)), 0) 
                        from documentos b 
                        where b.rut_deu_doc = a.rut_deu_doc and b.est_doc = 1 group by b.rut_deu_doc) / c.LINEA_CRED_CLI),2) conc_cli,
                    round((select b.monto_finan_doc
                        from documentos b 
                        where b.rut_deu_doc = a.rut_deu_doc and b.est_doc = 1 group by b.rut_deu_doc)  ,0) mora_cli
                    from documentos a inner join operaciones b on a.id_ope = b.id_ope
                    inner join clientes c on b.cli_ope = c.id_cli
                    where a.id_ope = :idope
                    group by a.NOM_DEU_DOC order by a.nom_deu_doc";




                   
            

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":idope", $idope, PDO::PARAM_INT);
            $stmt->execute();

            $response = $stmt->fetchAll();
            return $response;

        } catch (Exception $e) {
            echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_fa/datos_pers.php';</script>";
        }
    }




}
