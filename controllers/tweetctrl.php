<?php
if (isset($_POST["content"])) {
    session_start();
    $img = $_FILES["image"];
    $message = $_POST["content"];
    $userid = $_SESSION["id_user"];
} else {
    $message = "No Message";
    $userid = "no id";
    $img = "no img";
}
if (isset($_GET["tweetid"])) {
    $idtweet = intval($_GET["tweetid"]);
} else if (isset($_SESSION["retweetid"])) {
    $idtweet = intval($_SESSION["retweetid"]);
} else {
    $idtweet = "no tweet selected";
}
include('../model/conndb.php');
include('../model/tweetclass.php');
class Tweetctrl extends Tweet
{
    private $id;
    private $at_username;
    private $username;
    public $message;
    public $messageimg;
    public $response;

    public function __construct($id, $message, $messageimg, $response)
    {
        $this->id = $id;
        $this->message = $message;
        $this->messageimg = $messageimg;
        $this->response = $response;
    }
    public function tweetshow()
    {
        $this->displayTweet();
    }
    public function getTweet()
    {
        $this->Tweet($this->id, $this->message);
    }
    public function GetRetweet()
    {
        $this->Retweet($this->response, $this->id, $this->message);
    }
    public function handleupload()
    {
        $uploadDirectory = '../img';
        if (!file_exists($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $file = $this->messageimg;
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = $this->Rename($uploadDirectory, $extension);
        $destination = $uploadDirectory . '/' . $fileName;
        if ($this->uploadFile($file, $destination)) {
            $this->message .= " " . $destination;
        }
    }
    public function getresponse()
    {
        $this->Displayresponse($this->response);
    }
    public function checkfortweet(){
        $this->at_hastag($this->message);
    }
}
$display = new Tweetctrl($userid, $message, $img, $idtweet);
if (isset($_POST["content"]) && isset($_FILES["image"]) && !isset($_SESSION["retweetid"])) {
    $display->handleupload();
    $display->getTweet();
} elseif (isset($_POST["content"]) && !isset($_FILES["image"]) && !isset($_SESSION["retweetid"])) {
    $display->getTweet();
}
if (isset($_GET["tweetid"])) {
    $display->getresponse();
} else if (isset($_SESSION["retweetid"]) && isset($_POST["content"])) {
  var_dump($_SESSION["retweetid"]);
  session_destroy();
  exit();
    $display->GetRetweet();
} else {
    $display->tweetshow();
}
