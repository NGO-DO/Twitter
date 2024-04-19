<?php
class Tweet extends MyDatabase
{
    protected function displayTweet()
    {
        $stmt = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time, id_quoted_tweet FROM tweet INNER JOIN user ON id_user=user.id  WHERE id_response IS NULL ORDER BY time DESC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        foreach ($result as $results) {
            $str = "";
            $arr = explode("../", $results["content"]);
            if (key_exists(1, $arr)) {
                $str = $arr[1];
                $str = "../" . $str;
            }
            // var_dump($results["id_quoted_tweet"]);

            if ($results["id_quoted_tweet"] != NULL) {
                $stmt3 = $this->connectDb()->prepare("SELECT * FROM tweet INNER JOIN user ON user.id=tweet.id_user WHERE tweet.id=:tweetid;");
                $stmt3->bindParam(":tweetid", $results['id_quoted_tweet'], PDO::PARAM_INT);
                $stmt3->execute();
                $retweetresult = $stmt3->fetchAll();
                $retweetcontent = $retweetresult[0]["content"];
                $retweetusername = $retweetresult[0]["username"];
                $retweetat = $retweetresult[0]["at_user_name"];
                $retweetime = $retweetresult[0]["time"];
                $rarr = explode("../", $retweetresult[0]["content"]);
                if (key_exists(1, $rarr)) {
                    $rstr = $rarr[1];
                    $rstr = "../" . $rstr;
                }
                echo '<div class="border-y border-amber-400">
    <div class="flex py-3 px-2 items-center">
        <span class="material-symbols-outlined h-8">
            account_circle
        </span>
        <p class="px-3 font-bold">'
                    . $results["username"] . '
        </p>
        <p class="font-light text-sm">'
                    . $results["at_user_name"] . '
</p>
<p>' . $results["time"] . '</p>
</div>
<div class="containt">
    <p>';
                if ($arr[0]) {
                    echo $arr[0];


                } else {
                    echo $results["content"];
                }
                echo '</p>
                </div>
                <div class="flex justify-center py-4">';
                if ($str != "../") {
                    echo '<div  class="imgwidth">
                           <img src=' . $str . '>
                           </div>';
                }
                echo '
                </div>';
                echo '<div class="border-y border-amber-400">
                <div class="flex py-3 px-2 items-center">
                    <span class="material-symbols-outlined h-8">
                        account_circle
                    </span>
                    <p class="px-3 font-bold">'
                    . $retweetusername . '
                    </p>
                    <p class="font-light text-sm">'
                    . $retweetat . '
            </p>
            <p>' . $retweetime . '</p>
            </div>
            <div class="containt">
                <p>';
                if ($rarr[0]) {
                    echo $rarr[0];
                } else {
                    echo $retweetcontent;
                }
                echo '</p>
                </div>
                <div class="flex justify-center py-4">';
                if ($rstr != "../") {
                    echo '<div  class="imgwidth">
                           <img src=' . $rstr . '>
                           </div>';
                }
                echo '
                </div>
                <div class="max-w-screen-xl px-4 py-3 mx-auto">
                    <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                        <li>
                            <a href="tweetresponse.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                        </li>
                        <li>
                            <a href="tweet.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                        </li>
                    </ul>
                </div>
                </div>';
            } else {
                echo '<div class="border-y border-amber-400">
                <div class="flex py-3 px-2 items-center">
                    <span class="material-symbols-outlined h-8">
                        account_circle
                    </span>
                    <p class="px-3 font-bold">'
                    . $results["username"] . '
                    </p>
                    <p class="font-light text-sm">'
                    . $results["at_user_name"] . '
            </p>
            </div>
            <div class="containt">
                <p>';
                if ($arr[0]) {
                    echo $arr[0];

                } else {
                    echo $results["content"];
                }
                echo '</p>
            </div>
            <div class="flex justify-center py-4">';
                if ($str != "../") {
                    echo '<div  class="imgwidth">
                       <img src=' . $str . '>
                       </div>';
                }
                echo '
            </div>
            <div class="max-w-screen-xl px-4 py-3 mx-auto bordertweet">
                <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                    <li>
                        <a href="tweetresponse.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
                    </li>
                    <li>
                        <a href="tweet.php?tweetid=' . $results["tweetid"] . '"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                    </li>
                    <li>
                        <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                    </li>
                </ul>
            </div>
            </div>';
            }
        }
    }
    protected function Tweet($senderid, $message)
    {
        $stmt = $this->connectDb()->prepare("INSERT INTO tweet VALUES(NULL,:senderid,NULL,CURRENT_TIMESTAMP, :contentmessage,NULL);");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':contentmessage', $message, PDO::PARAM_STR);
        $stmt->execute();
        header("Location: ../view/mainpage.php");
    }
    protected function Displayresponse($tweetid)
    {
        $stmt = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time FROM tweet INNER JOIN user ON id_user=user.id  WHERE id_response IS NULL AND tweet.id=:tweetid");
        $stmt->bindParam(":tweetid", $tweetid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $arr = explode("../", $result[0]["content"]);
        if ($arr[1]) {
            $str = $arr[1];
            $str = "../" . $str;
        }

        echo '<div class="border-y border-amber-400 border-b-2">
            <div class="flex py-3 px-2 items-center">
                <span class="material-symbols-outlined h-8">
                    account_circle
                </span>
                <p class="px-3 font-bold">'
            . $result[0]["username"] . '
                </p>
                <p class="font-light text-sm">'
            . $result[0]["at_user_name"] . '
        </p>
        <p>' . $result[0]["time"] . '</p>
        </div>
        <div class="containt">
            <p>';
        if ($arr[0]) {
            echo $arr[0];

        } else {
            echo $result[0]["content"];
        }
        echo '</p>
        </div>
        <div class="flex justify-center py-4">';
        if ($str != "../") {
            echo '<div  class="imgwidth">
                   <img src=' . $str . '>
                   </div>';
        }
        echo '
        </div>
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                <li>
                    <span class="material-symbols-outlined h-8 max-h-6">reply</span>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                </li>
                <li>
                    <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                </li>
            </ul>
        </div>
        </div>';

        $stmt2 = $this->connectDb()->prepare("SELECT user.id AS 'userid', tweet.id AS 'tweetid', tweet.content, username, at_user_name, time FROM tweet INNER JOIN user ON id_user=user.id  WHERE id_response=:id ORDER BY time DESC");
        $stmt2->bindParam(":id", $tweetid, PDO::PARAM_INT);
        $stmt2->execute();
        $result2 = $stmt2->fetchAll();
        echo '  <form method="POST" name="tweet" action="../controllers/tweetctrl.php" enctype="multipart/form-data">
        <textarea placeholder="Post your reply. . ." name="content" id="content" cols="28" rows="5" maxlength="144"
            class="border shadow-inner" style="resize: none;"></textarea>
            <div class="flex justify-center py-2">
            <label for="file" class="label-file justify-center">Choose image</label>
            <input id="file" class="input-file" type="file" accept="image/png, image/jpeg, image/jpg">
        <button type="submit" class="border bg-white hover:bg-gray-100 text-gray-800 font-semibold  items-center border border-gray-400 rounded shadow hover:bg-lime-200 px-4 mx-3">send</button>
            </div>
    </form>';
            foreach ($result2 as $results2) {
                echo '<div class="border-y-2 border-amber-400 blockResponse">
                    <div class="flex items-center">
                    <span class="material-symbols-outlined h-8">
                        account_circle
                    </span>
                    <p class="px-3 font-bold">'
                    . $results2["username"] . '
                    </p>
                    <p class="font-light text-sm text-center">'
                    . $results2["at_user_name"] . '
                    </p>
                    <p class="px-2 text-sm">' . $results2["time"] . '</p>
                    </div>
                    <div class="containt">
                    <p>';
                echo $results2["content"];
                echo '</p>
                    </div>
                    <div class="flex justify-center py-4">';
                    if ($str != "../") {
                        echo '<div  class="imgwidth">
                        <img src=' . $str . '>
                        </div>';
                    }
                echo '
                    </div>
                    <div class="max-w-screen-xl px-4 py-1 mx-auto betweentwotweet">
                    <ul class="flex justify-around flex-row font-medium mt-0 space-x-8 text-smn">
                        <li>
                            <span class="material-symbols-outlined h-8 max-h-6">reply</span>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
                        </li>
                        <li>
                            <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
                        </li>
                    </ul>
                    </div>
            </div>';
        }
    }
    protected function Rename($directory, $extension)
    {
        $fileName = '';
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $max = strlen($alphabet) - 1;

        do {
            $fileName = '';
            for ($i = 0; $i < 5; $i++) {
                $fileName .= $alphabet[rand(0, $max)];
            }
            $fileName .= '.' . $extension;
        } while (file_exists($directory . '/' . $fileName));

        return $fileName;
    }
    protected function uploadFile($file, $destination)
    {
        return move_uploaded_file($file['tmp_name'], $destination);
    }
    protected function Retweet($tweetid, $senderid, $message)
    {
        $stmt2 = $this->connectDb()->prepare("INSERT INTO tweet VALUES(NULL,:senderid,NULL,CURRENT_TIMESTAMP, :contentmessage, :tweetid); ");
        $stmt2->bindParam(":tweetid", $tweetid, PDO::PARAM_INT);
        $stmt2->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt2->bindParam(':contentmessage', $message, PDO::PARAM_STR);
        $stmt2->execute();
        unset($_SESSION['retweetid']);
        header("Location: ../view/mainpage.php");
    }
    protected function at_hastag($searchInput)
    {
        $allAroba = [];
        $allHash = [];
        if (str_contains($searchInput, "@")) {
            $test = strstr($searchInput, "@");
            $test = trim($test);
            $arr = explode(" ", $test);
            foreach ($arr as $value) {
                if (str_starts_with($value, "@")) {
                    if ($value != "@") {
                        array_push($allAroba, $value);
                    }
                }
            }
        }
        if (str_contains($searchInput, "#")) {
            $test = strstr($searchInput, "#");
            $test = trim($test);
            $arr = explode(" ", $test);
            foreach ($arr as $value) {
                if (str_starts_with($value, "#")) {
                    if ($value != "@") {
                        array_push($allHash, $value);
                    }
                }
            }
        }
    }
}
