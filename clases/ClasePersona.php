<?php
require_once '../recursos/db/db.php';

/*/////////////////////////////
Clase abstracta Persona
////////////////////////////*/

 class PersonaDAO
{
    protected $id;
    protected $rut;
    protected $mail;
    protected $contraseña;
    protected $vigencia;

    /*///////////////////////////////////////
    Login 
    //////////////////////////////////////*/
    public static function login($rut,$pwd){

        try{

                
                $pdo = AccesoDB::getCon();

                $sql_login = "select id_usu id, concat(NOM1_USU,' ',APEPAT_USU,' ',APEMAT_USU) nom, mail_usu mail, id_perfil perfil, pass_usu pass
                                from usuarios where vig_usu = 1 and rut_usu = :rut
                                union all 
                                select id_cli, nom_cli, MAIL_CLI, 0, pass_cli
                                from clientes
                                where vig_cli= 1 and rut_cli = :rut ";

                $stmt = $pdo->prepare($sql_login);
                $stmt->bindParam(":rut", $rut, PDO::PARAM_STR);
           
                $stmt->execute();

               

                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($pwd == $row["pass"]){
                    session_start();
                        $_SESSION['id_fac'] = $row['id'];
                        $_SESSION['mail_fac'] = $row['mail'];
                        $_SESSION['nom_fac'] = $row['nom'];
                        $_SESSION['perfil_fac'] = $row['perfil'];
                        $_SESSION['start_fac'] = time();
                        $_SESSION['expire_fac'] = $_SESSION['start_fac'] + (5 * 60);
                        
                        if ($row['perfil'] == 0 ) {
                            echo"<script type=\"text/javascript\">      window.location='../paginas_cli/entrenamiento.php';</script>"; 
                        }else  {
                            echo"<script type=\"text/javascript\">       window.location='../paginas_fa/datos_pers.php';</script>"; 
                        }
                }else{
                    echo"<script type=\"text/javascript\">alert('Error, favor verifique sus datos e intente nuevamente o comuniquese con Viracocha Factoring para revisar su vigencia.');window.location='../index.html';        </script>"; 
                }
             
 

        

        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }


    /*///////////////////////////////////////
    Actualizar Contraseña 
    //////////////////////////////////////*/
    public static function actualizar_contraseña($id,$pwd,$iden){

        try{

                
                $pdo = AccesoDB::getCon();

                if ($iden == 0) {
                     $sql_pwd = "update clientes
                                  set pass_cli = :pwd
                                  where id_cli = :id";
                }elseif ($iden == 1) {
                    $sql_pwd = "update usuarios
                                  set pass_usu = :pwd
                                  where id_usu = :id";

                }

                
                $stmt = $pdo->prepare($sql_pwd);
                $stmt->bindParam(":pwd", $pwd, PDO::PARAM_STR);
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
           
                $stmt->execute();
        

        } catch (Exception $e) {
                echo"<script type=\"text/javascript\">alert('Error, comuniquese con el administrador".  $e->getMessage()." '); window.location='../../index.html';</script>"; 
        }
    }


 


}



?>





