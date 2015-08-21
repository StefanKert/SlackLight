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
            Logger::saveRequestLog('Action not specified');
            throw new Exception('Action not specified');
            return null;
        }


        $action = $_REQUEST[self::ACTION];

        switch ($action) {
            case self::ACTION_LOGIN:
                Logger::saveRequestLog("Trying to perform login.");
                $this->login();
                break;

            case self::ACTION_LOGOUT :
                Logger::saveRequestLog("Trying to perform logout.");
                $this->logout();
                break;

            case self::ACTION_REGISTER :
                Logger::saveRequestLog("Trying to perform register.");
                $this->register();
                break;
            default :
                Logger::saveRequestLog("Error. Unknown action: " . $action);
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
            Logger::saveRequestLog("Logging in $username had errors.", $errors);
            Util::redirect(Util::generateUrl("index.php", "login"), $errors);
            return;
        }
        else{
            Logger::saveRequestLog("Logging in $username successful.");
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
        $channels = Util::readKeyFromRequestWithoutEscape(self::CHANNELS);
        Logger::saveRequestLog("Channels ". count($channels) . serialize($channels));

        if(!isset($userName) || strlen($userName) < 4){
            $errors[] = "Kein oder ein zu kurzer Benutzername angegeben. Der Benutzername muss mindestens 4 Zeichen lang sein.";
        }
        if(!isset($password) || strlen($password) < 4){
            $errors[] = "Kein oder ein zu kurzes Passwort angegeben. Das Passwort muss mindestens 4 Zeichen lang sein.";
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
        if($this->userRepository->getUserForMail($mail) != null){
            $errors[] = "Ein Benutzer mit der angegebenen EMail Adresse existiert bereits.";
        }
        if($this->userRepository->getUserForUserName($userName) != null){
            $errors[] = "Ein Benutzer mit dem angegebenen Benutzernamen existiert bereits.";
        }
        if (!isset($channels) || count($channels) == 0) {
            $errors[] = "Bitte selektieren Sie einen oder mehrere Channels.";
        }
        if (count($errors) > 0) {
            Logger::saveRequestLog("Registering for $userName failed.", $errors);
            Util::redirect(Util::generateUrl("index.php", "register"), $errors, array(
                self::USER_NAME => $userName,
                self::FIRST_NAME => $firstName,
                self::LAST_NAME => $lastName,
                self::MAIL => $mail
            ));
            return;
        }
        else{
            Logger::saveRequestLog("Channels ". count($channels) . serialize($channels));
            $userId = $this->userRepository->createUser($userName, hash('sha1', "$userName|$password"), $firstName, $lastName, $mail);
            foreach($channels as $channelId) {
                $this->channelRepository->createUserChannelRegistration($channelId, $userId, "0001-01-01");
            }
            Logger::saveRequestLog("Registered $userName successful.");
            Util::redirect(Util::generateUrl("index.php", "registerSuccess"));
            return;
        }
    }
}
?>