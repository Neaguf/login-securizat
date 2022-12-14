<?php
 
namespace App\Controllers;


use stdClass;
 
class Login extends BaseController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    
    private function createNewToken( $id_user )
    {
        $now = date("Y-m-d H:i:s");
        return md5( $id_user."-".$now );
    }
    
    public function index()
    {
        $db = db_connect();
        
        
        
        
        $email = $this->request->getJsonVar('email');
        $password = $this->request->getJsonVar('password');
        $raspuns = new stdClass();
        
        $query = "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'";
        $results = $db->query($query)->getResult();

       

        
             if (count($results) == 0) {
                $raspuns->error = "User sau parola gresita";
            } else {
                $raspuns->succes = true;
                $token = $this->createNewToken($results[0]->id);
                $idUser = $results[0]->id;
                $expira = date("Y-m-d H:i:s", strtotime('+24 h'));

                $queryInsert = "INSERT INTO tokens (token, id_user, expira) VALUES ('{$token}', {$idUser}, '{$expira}')";
                
                $db->query($queryInsert);
                $raspuns->token = $token;

          }

            // email si parola
            echo json_encode($raspuns);

            
    }


}