<?php
/**
 * Controlador que también maneja las sesiones
 */
class SessionController extends Controller{
    
    private $userSession;
    private $username;
    private $userid;

    private $session;
    private $sites;

    private $user;
    public $defaultSites;

    function __construct(){
        parent::__construct();
    }

    public function getUserSession(){
        return $this->userSession;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getUserId(){
        return $this->userid;
    }

    function validateSession(){
        return;
    }
}


?>