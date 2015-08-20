<?php

class AuthenticationController extends BaseObject
{
    private $userRepository;
    private $channelRepository;

    const CONTROLLER_NAME = 'authentication';
    const ACTION = 'action';
    const METHOD_POST = 'POST';
    const ACTION_REGISTER = 'register';
    const ACTION_LOGIN = 'login';
    const ACTION_LOGOUT = 'logout';

    const USER_NAME = 'username';
    const PASSWORD = 'password';
    const PASSWORD_CHECK = 'passwordCheck';
    const FIRST_NAME = 'firstname';
    const LAST_NAME = 'lastname';
    const MAIL = 'mail';
    const CHANNELS = 'channels';

    public function __construct(UserRepository $userRepository, ChannelRepository $channelRepository)
    {
        $this->userRepository = $userRepository;
        $this->channelRepository = $channelRepository;
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
                $this->login();
                break;

            case self::ACTION_LOGOUT :
                $this->logout();
                break;

            case self::ACTION_REGISTER :
                $this->register();
                break;
            default :
                throw new Exception('Unknown controller action ' . $action);

        }

    }

    private function login(){
        $errors = array();
        $username =  Util::readKeyFromRequest(self::USER_NAME);
        $password =  Util::readKeyFromRequest(self::PASSWORD);

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
            Util::redirect(Util::generateUrl("index.php", "login"), $errors);
            return;
        }
        else{
            Util::redirect(Util::generateUrl("index.php", "main"));
            return;
        }
    }

    private function logout(){
        AuthenticationManager::signOut();
        Util::redirect(Util::generateUrl("index.php", "login"));
    }

    private function register(){
        $errors = array();
        $userName =  Util::readKeyFromRequest(self::USER_NAME);
        $password =  Util::readKeyFromRequest(self::PASSWORD);
        $passwordCheck =  Util::readKeyFromRequest(self::PASSWORD_CHECK);
        $firstName =  Util::readKeyFromRequest(self::FIRST_NAME);
        $lastName =  Util::readKeyFromRequest(self::LAST_NAME);
        $mail =  Util::readKeyFromRequest(self::MAIL);
        $channels = Util::readKeyFromRequest(self::CHANNELS);


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
        if($this->userRepository->getUserForUserName($userName) != null){
            $errors[] = "Ein Benutzer mit dem angegebenen Benutzernamen existiert bereits.";
        }
        if (count($channels) == 0) {
            $errors[] = "Bitte wählen Sie einen oder mehrere Channels aus.";
        }
        if (count($errors) > 0) {
            Util::redirect("index.php?view=register", $errors, array(
                self::USER_NAME => $userName,
                self::FIRST_NAME => $firstName,
                self::LAST_NAME => $lastName,
                self::MAIL => $mail
            ));
            return;
        }
        else{
            $userId = $this->userRepository->createUser($userName, $password, $firstName, $lastName, $mail);
            foreach($channels as $channelId) {
                $this->channelRepository->createUserChannelRegistration($channelId, $userId, "1000-01-01");
            }
            Util::redirect(Util::generateUrl("index.php", "registerSuccess"));
            return;
        }
    }
}
?>