<?php
session_start();
$dateElems = explode("-", $_SESSION['birthdate']);
$year = $dateElems[0];
$month = $dateElems[1];
$day = $dateElems[2];
$monthNum  = $month;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../stylesheet/accountTail.css">
  <link rel="stylesheet" href="../stylesheet/layouts/general.css">
  <link rel="stylesheet" href="../stylesheet/mainpageTail.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="shortcut icon" href="#">
  <title>Your account</title>
</head>

<body>
<div class="grid lg:grid-cols-3">
        <div class="hidden4">
            <?php
            include("shared/navbarPc.php");
            ?>
        </div>
  <script src="../stylesheet/modifyaccount.js"></script>
  <div id="accountpage">
    <div class="grid md:grid-cols-1">
      <!-- DEBUT SIDEBAR -->
      <div class="hidden5">
        <?php
        include("shared/navbarIpad.php")
        ?>
      </div>
      <!-- FIN SIDEBAR -->
      <div class="padding-left p-0">
        <header class="mx-10">

          <div class="banner flex justify-between">
            <button class="p-1"><span class="material-symbols-outlined rounded-full bg-button text-white">arrow_back</span></button>
            <form action="">
              <button class="p-1"><span class="material-symbols-outlined rounded-full bg-button text-white">search</span></button>
            </form>
          </div>

          <div class="container">

            <div class="flex justify-between items-center">
              <button class="btn-edit border p-1" id="showForm"><span class="text-sm">Modify account</span></button>
              <button class="btn-edit border p-1" action="../model/logout.php"><span class="text-sm">Log out</span></button>
            </div>
            <div>
              <img src="../img/pp-logo-with-circle-rounded-negative-space-design-vector-29230298.jpg" class="avatar rounded-full" alt="">
            </div>
            <div class="flex items-center">
              <span><?php echo $_SESSION["username"] ?></span>
              <span class="material-symbols-outlined">lock</span>
            </div>
            <p class="text-sm m-bottom text-gray-600"><?php echo $_SESSION["atusername"] ?></p>
            <p><?php echo $_SESSION['bio'] ?></p>

            <br>

            <div class="flex">
              <div class="flex items-center">
                <span class="material-symbols-outlined text-sm text-gray-600">
                  location_on
                </span>
                <span class="text-sm text-gray-600">
                  <?php echo $_SESSION['city'] ?>
                </span>
              </div>
              <div class="flex items-center">
                <span class="material-symbols-outlined text-gray-600 px-1">
                  cake
                </span>
                <span class="text-sm text-gray-600">
                  Born on the
                  <?php echo ("$day of $monthName $year") ?>
                </span>
              </div>
            </div>

            <div class="flex items-center">
              <span class="material-symbols-outlined text-gray-600">
                calendar_month
              </span>
              <span class="text-sm text-gray-600 ">
                A rejoint Twitter en ocotobre 2019
              </span>
            </div>

            <div class="flex">
              <span class="text-sm px-1">
                42
              </span>
              <span class="text-sm  text-gray-600">
                <a href="followlist.php">
                  Abonnements
                </a>
              </span>
              <span class="text-sm px-1">
                8424
              </span>
              <span class="text-sm text-gray-600">
                Abonnés
              </span>
            </div>
          </div>



      </header>

      <div class="border-y-2 border-yellow-500 ">
        <div class="flex py-3 px-2 items-center">
          <span class="material-symbols-outlined h-8 center">account_circle</span>
          <p class="px-3 font-bold">Nicolas</p>
          <p class="font-light text-sm">@Nicolas</p>
        </div>
        <div class="containt">
          <p>bonjour tout le monde, je suis cringeetsadenmemetempshahahahaha</p>
        </div>
        <div class="flex justify-center py-4">
          <div class="arrondir">
            <img src="data:image/jpeg;base64,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" />
          </div>
        </div>
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
          <ul class="flex justify-center flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
            <li>
              <a href="#"><span class="material-symbols-outlined h-8 max-h-6">quick_phrases</span></a>
            </li>
            <li>
              <a href="#"><span class="material-symbols-outlined h-8 max-h-6">reply</span></a>
            </li>
            <li>
              <a href="#"><span class="material-symbols-outlined h-8 max-h-6">favorite</span></a>
            </li>
            <li>
              <a href="#"><span class="material-symbols-outlined h-8 max-h-6">bar_chart</span></a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <form id="modifyForm" method="POST" class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8" name="modifyForm" action="../controllers/updatectrl.php">
      <button id="return" class="p-1"><span class="material-symbols-outlined rounded-full bg-button text-white">arrow_back</span></button>
      <div>
        <label for="modifyUsername" class="block text-sm font-medium leading-6 text-gray-900"> Username </label>
        <div class="mt-2">
          <input id="modifyUsername" name="modifyUsername" value="<?= $_SESSION["username"] ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="profile_picture" class="block text-sm font-medium leading-6 text-gray-900"> Image de profil </label>
        <div class="mt-2">
          <input id="profile_picture" accept="image/png, image/jpeg, image/jpg" type="file" name="profile_picture" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="bio" class="block text-sm font-medium leading-6 text-gray-900"> Bio </label>
        <div class="mt-2">
          <input id="bio" name="bio" value="<?= $_SESSION["bio"] ?>" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="banner" class="block text-sm font-medium leading-6 text-gray-900"> Bannière </label>
        <div class="mt-2">
          <input id="banner" name="banner" accept="image/png, image/jpeg, image/jpg" type="file" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="modifyEmail" class="block text-sm font-medium leading-6 text-gray-900"> Email </label>
        <div class="mt-2">
          <input id="modifyEmail" name="modifyEmail" value='<?= $_SESSION["mail"] ?>' class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="modifyPassword" class="block text-sm font-medium leading-6 text-gray-900"> Mot de passe </label>
        <div class="mt-2">
          <input id="modifyPassword" name="modifyPassword" type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="confModifyPassword" class="block text-sm font-medium leading-6 text-gray-900"> Confirmation du mot de passe </label>
        <div class="mt-2">
          <input id="confModifyPassword" name="confModifyPassword" required type="password" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="birth" class="block text-sm font-medium leading-6 text-gray-900"> Date de naissance </label>
        <div class="mt-2">
          <input id="birth" name="birth" type="date" disabled value='<?= $_SESSION["birthdate"] ?>' class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>

      <div>
        <label for="city" class="block text-sm font-medium leading-6 text-gray-900"> Ville </label>
        <div class="mt-2">
          <input id="city" name="city" required value='<?= $_SESSION["city"] ?>' class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
        </div>
      </div>
      <div>
        <button type="submit" id="endModify" name="wesh" class="justify-center rounded-md bg-amber-300 px-3 py-1.5 text-sm font-semibold leading-6 text-black"> Modifier </button>
      </div>
    </form>
  </div>
  </div>
          <!-- DEBUT SIDEBAR RIGHT FOR PC -->
          <div class="hidden4">
            <?php
            include("shared/rightbarPc.php");
            ?>
        </div>
</div>
  <!-- DEBUT FOOTER -->
  <footer class="sticky bottom-0 bg-slate-300 blop3 hidden3">
    <div class="grid sm:grid-cols-1 hidden3">
      <?php
      include("shared/navbar.php")
      ?>
    </div>
  </footer>
  <!-- FIN FOOTER -->
</body>

</html>