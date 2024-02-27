<?php
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

require_once 'import.php';
require_once $documentRoot . '/model/DAO/teamDAO.php';
require_once $documentRoot . '/model/DAO/classes/gamematch.php';
require_once $documentRoot . '/views/team.php';

function printQr($qr){
    ?>
  <div class="basis-full m-3 mb-5 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
    <div class="mb-2 flex items-center gap-3">
      <a href=" /qr.php?id=<?php echo $qr->getId(); ?>" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500">
        Name: <?php echo $qr->getFriendlyName(); ?>
      </a>
      <div class="center relative inline-block whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
        <div class="mt-px">Match id: <?php  echo $qr->getUUID(); ?></div>
      </div>
    </div>
    <?php //here put all the related questions ?>
  </div>   
    <?php
}

function createQrForm($matchId)
{

  $qrDAO = new QrDAO();


  ?>
  <div class="flex-2 mb-5 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
    <form action="/controllers/createQr.php" method="post">
      <div class="mb-2 flex items-center gap-3">
        <label>Create new qr:</label>
        <input type="text" name="qrName" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors" placeholder="Qr name">
        </input>
        <input type="hidden" name="matchId" value="<?php echo $matchId; ?>"></input>
        <input type="hidden" name="uuid" value="<?php echo $qrDAO->generateUuid() ?>"></input>
        <div class="center relative inline-block select-none whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
          <input type="submit" value="submit" class="mt-px cursor-pointer"></input>
        </div>
      </div>
    </form>
  </div>
  <?php
}
?>