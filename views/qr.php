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
        <div class="mt-px">Match id: <?php // echo $match->getId() ?></div>
      </div>
    </div>
    <?php //here put all the related questions ?>
  </div>   
    <?php
}
?>