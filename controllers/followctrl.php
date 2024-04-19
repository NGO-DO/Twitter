<?php
include("../model/conndb.php");
include("../model/follow.php");
class Followctrl extends Follow
{
    private $senderid;
    private $receiverid;
    public function __construct($senderid, $receiverid)
    {
        $this->senderid = $senderid;
        $this->receiverid = $receiverid;
    }
    public function ctrlfollow(){
        $this->checkfollow($this->senderid,$this->receiverid);
    }
    public function seefollow()
    {
        $this->displayfollowed($this->senderid);
        $this->displayfollowers($this->senderid);
    }
}
if(isset($_GET['receiverid'])){
    session_start();
    $senderid = $_SESSION['id_user'];
    $receiverid=intval($_GET['receiverid']);
    $checkfollow = new Followctrl($senderid, $receiverid);
    $checkfollow->ctrlfollow();
    header("Location: ../view/account.php");
}

if ($_SESSION['id_user'] && !isset($_GET['receiverid'])) {
    $senderid = $_SESSION['id_user'];
    $receiverid = "test";
    $startfollow = new Followctrl($senderid, $receiverid);
    $startfollow->seefollow();
} 