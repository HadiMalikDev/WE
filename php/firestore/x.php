<?php

require_once '../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\FirebaseException;
class FirebaseApi{
    
    private $factory;
    private $auth;
    private $user;
    

    private static $instance = null;
    private function __construct()
    {
        $this->factory = (new Factory)->withServiceAccount('php-c8a6e-firebase-adminsdk-xxx9v-64d193ee86.json');
        $this->auth = $this->factory->createAuth();
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new FirebaseApi();
        }
        return self::$instance;
    }
    public function registerUser($email,$password){
        try {
            $this->user=$this->auth->createUserWithEmailAndPassword($email, $password);
            echo json_encode(array("success"=>true,"uid"=>$this->user->uid));
        } 
        catch (FirebaseException $e) {
            echo json_encode(
                array(
                    "message" => $e->getMessage(),
                    "success" => false
                )
            );
        } catch (Exception $e) {
            echo json_encode(
                array(
                    'success' => false,
                    'message' => strval($e->getMessage())
                )
            );
        }
        
    }

    public function loginUser($email,$password)
    {
        try {
            $this->auth->signInWithEmailAndPassword($email, $password);
            echo json_encode(array("success"=>true));
            } 
            catch (FirebaseException $e) {
            echo json_encode(
                array(
                    "message" => $e->getMessage(),
                    "success" => false
                )
            );
        } catch (Exception $e) {
            echo json_encode(
                array(
                    'success' => false,
                    'message' => strval($e->getMessage())
                )
            );
        }
        
    }
}
