<?php

require_once '../vendor/autoload.php';

use Kreait\Firebase\Exception\FirebaseException;
use Kreait\Firebase\Factory;



class FirestoreApi{
    
    private $userCollection;
    private static $instance = null;
    private function __construct()
    {
        $factory = (new Factory)->withServiceAccount('php-c8a6e-firebase-adminsdk-xxx9v-64d193ee86.json');
        $firestore = $factory->createFirestore();
        $database = $firestore->database();
        $this->userCollection = $database->collection('users');
        
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new FirestoreApi();
        }
        return self::$instance;
    }

    public function uploadUserDetails($uid,$name,$city,$countryName,$age){
        try {
            $this->userCollection->document($uid)->set([
                'name'=>$name,
                'city'=>$city,
                'country'=>$countryName,
                'age'=>$age,
            ]);
            echo json_encode(array('success'=>true));
        } catch (FirebaseException $e) {
            echo json_encode(array('success'=>false,'error'=>$e->getMessage()));
        }
    }
    public function getBookmarks($uid){
        try {
            $bookmarksCollection=$this->userCollection->document($uid)->collection('bookmarks');
            if($bookmarksCollection->documents()->size()==0)
                echo json_encode(array('success'=>true,'data'=>[]));
            else{
                
                /*
                $data=$rows[0]->data();
                $x=sizeof($rows); */
                $rows=$bookmarksCollection->documents()->rows();
                $bookmarksArray=$this->makeBookmarksArray($rows);
                
                echo json_encode(array('success'=>true,'data'=>$bookmarksArray,
                'total'=>$bookmarksCollection->documents()->size()));
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    private function makeBookmarksArray($rows){
        $bookmarksArray=array();
        
        for ($i=0; $i <sizeof($rows); $i++) { 
            array_push(
                $bookmarksArray,
                array(
                    'verse_key'=>$rows[$i]->data()['verse_key']
                )
            );
        }
        return $bookmarksArray;

    }
    public function addBookmark($uid,$verse_key){
        try {
            $bookmarksCollection=$this->userCollection->document($uid)->collection('bookmarks');
            $bookmarksCollection->add([
                'verse_key'=>$verse_key
            ]);
            echo json_encode(array('success'=>true));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function deleteBookmark($uid){

    }
    public function getUserDetails($uid)
    {
        try {
            $userData=$this->userCollection->document($uid)->snapshot();
            echo json_encode(array('success'=>true,'data'=>$userData->data()));
        } catch (FirebaseException $e) {
            echo json_encode(array('success'=>false,'error'=>$e->getMessage()));
        }
    }
}
