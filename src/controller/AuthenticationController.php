<?php

class AuthenticationController extends BaseObject
{
    private $repository;

    const ACTION = 'action';
    const METHOD_POST = 'POST';
    const ACTION_REGISTER = 'register';
    const ACTION_LOGIN = 'login';
    const ACTION_LOGOUT = 'logout';

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    public function handleAction()
    {
        if (!isset($_REQUEST[self::ACTION])) {
            throw new Exception('Action not specified');
            return null;
        }


        $action = $_REQUEST[self::ACTION];

        switch ($action) {
            case self::ACTION_LOGIN:
                self::login();
                break;

            case self::ACTION_LOGOUT :
                self::logout();
                break;

            case self::ACTION_REGISTER :
                self:: register();
                break;
            default :
                throw new Exception('Unknown controller action ' . $action);

        }

    }

    private function login(){
        $errors = array();
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!isset($username) || strlen($username) == 0){
            $errors[] = "Kein Benutzername angegeben.";
        }
        if(!isset($password) || strlen($password) == 0){
            $errors[] = "Kein Passwort angegeben.";
        }
        if(!AuthenticationManager::Authenticate($username, $password)){
            $errors[] = "Die Kombination aus Benutzername und Passwort existiert nicht in der Datenbank.";
        }
        if (count($errors) > 0) {
            Util::redirect("index.php?view=login", $errors);
            return;
        }
        else{
            Util::redirect("index.php?view=main");
            return;
        }
    }

    private function logout(){
        AuthenticationManager::signOut();
        Util::redirect("index.php?view=login");
    }

    private function register(){
        $errors = array();
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        $passwordCheck = $_POST['passwordCheck'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $mail = $_POST['mail'];


        if(!isset($userName) || strlen($userName) == 0){
            $errors[] = "Kein Benutzername angegeben.";
        }
        if(!isset($password) || strlen($password) == 0){
            $errors[] = "Kein Passwort angegeben.";
        }
        if(!isset($firstName) || strlen($firstName) == 0){
            $errors[] = "Kein Vorname angegeben.";
        }
        if(!isset($lastName) || strlen($lastName) == 0){
            $errors[] = "Kein Nachname angegeben.";
        }
        if(!isset($mail) || strlen($mail) == 0){
            $errors[] = "Keine EMail Adresse angegeben.";
        }
        if(!isset($passwordCheck) || strlen($passwordCheck) == 0){
            $errors[] = "Kein Wiederholungspasswort angegeben.";
        }
        if($password != $passwordCheck){
            $errors[] = "Das Wiederholungspasswort ist nicht das selbe wie das Passwort.";
        }
        if($this->repository->getUserForUserName($userName) != null){
            $errors[] = "Ein Benutzer mit dem angegebenen Benutzernamen existiert bereits.";
        }
        if (count($errors) > 0) {
            Util::redirect("index.php?view=register", $errors);
            return;
        }
        else{
            $this->repository->createUser($userName, $password, $firstName, $lastName, $mail);
            Util::redirect("index.php?view=registerSuccess");
            return;
        }
    }
}

?>