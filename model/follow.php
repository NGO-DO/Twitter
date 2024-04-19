<?php
class Follow extends MyDatabase
{

    protected function checkfollow($senderid, $receiverid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow WHERE id_user=:senderid AND id_follow=:receiverid;");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':receiverid', $receiverid, PDO::PARAM_INT);
        $stmt->execute();
        $result1 = $stmt->fetchAll();
        if (count($result1) == 0) {
            $this->follow($senderid, $receiverid);
            $this->countfollow($senderid);
        } else {
            $this->unfollow($senderid, $receiverid);
        }
    }
    protected function follow($senderid, $receiverid)
    {
        $stmt = $this->connectDb()->prepare("INSERT INTO follow VALUES (:senderid, :receiverid,CURRENT_TIMESTAMP);");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':receiverid', $receiverid, PDO::PARAM_INT);
        $stmt->execute();
    }
    protected function unfollow($senderid, $receiverid)
    {
        $stmt = $this->connectDb()->prepare("DELETE FROM follow WHERE id_user=:senderid AND id_follow=:receiverid;");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->bindParam(':receiverid', $receiverid, PDO::PARAM_INT);
        $stmt->execute();
    }
    protected function countfollow($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * FROM follow WHERE id_user=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return count($result);
    }
    protected function displayfollowed($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user ON follow.id_follow=user.id WHERE  follow.id_user=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();
        echo '<div id="tab1" class="tabcontent p-4"> ';
        if ($results) {
            foreach ($results as $result) {
                echo '<div class=" mt-2 flex flex-row justify-between">';
                echo '<img src="../images/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg"
                alt="logo test" class="avatar rounded-full"> ';
                echo '<div class="flex flex-col -mt-4 ml-2">';
                echo '<p class="text-sm">' . $result['username'] . '</p>';
                echo '<small>' . $result['at_user_name'] . '</small>';
                if ($result['bio'] !== NULL) {
                    echo "<p class='py-2 text-xs'>" . $result['bio'] . "</p>";
                } else {
                    echo "<p class='py-2 text-xs'>This user doesn't have a bio</p>";
                }
                echo '</div>';
                echo '<a href="../controllers/followctrl.php?receiverid=' . $result['id'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
                Followed </button></a>';
                echo '</div>';
            }
        } else {
            echo "<h2>You don't follow anyone</h2>";
        }
        echo "</div>";
    }
    protected function displayfollowers($senderid)
    {
        $stmt = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user ON follow.id_user=user.id WHERE  follow.id_follow=:senderid");
        $stmt->bindParam(':senderid', $senderid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll();
        echo '<div id="tab2" class="tabcontent p-4 hidden">';
        if ($results) {
            foreach ($results as $result) {
                try {
                    $stmt2 = $this->connectDb()->prepare("SELECT * from follow INNER JOIN user on follow.id_follow=user.id WHERE follow.id_user=:senderid AND follow.id_follow=:receiverid");
                    $stmt2->bindParam(':senderid', $senderid, PDO::PARAM_INT);
                    $stmt2->bindParam(':receiverid', $result['id'], PDO::PARAM_INT);
                    $stmt2->execute();
                    $result2 = $stmt2->fetchAll();
                } catch (PDOException $e) {
                    var_dump($e->getMessage());
                }
                echo '<div class=" mt-2 flex flex-row justify-between">';
                echo '<img src="../images/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg"
                alt="logo test" class="avatar rounded-full"> ';
                echo '<div class="flex flex-col -mt-4 ml-2">';
                echo '<p class="text-sm">' . $result['username'] . '</p>';
                echo '<small>' . $result['at_user_name'] . '</small>';
                if ($result['bio'] !== NULL) {
                    echo "<p class='py-2 text-xs'>" . $result['bio'] . "</p>";
                } else {
                    echo "<p class='py-2 text-xs'>This user doesn't have a bio</p>";
                }
                echo '</div>';
                if (count($result2) !== 0) {
                    echo '<a href="../controllers/followctrl.php?receiverid=' . $result['id'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
                Followed </button></a>';
                } else {
                    echo '<a href="../controllers/followctrl.php?receiverid=' . $result['id'] . '"> <button class="bg-amber-500 hover:bg-amber-400 text-white font-bold py-1 px-5 rounded-full h-12">
                    Follow </button></a>';
                }
                echo '</div>';
            }
        } else {
            echo "<h2>No one following</h2>";
        }
        echo '</div>';
    }
}
