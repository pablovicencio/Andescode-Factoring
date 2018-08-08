<?php

require_once '../recursos/db/db.php';


class Funciones 
{

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
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../paginas_usu/clientes.php';</script>";
            }
        }
  




}
