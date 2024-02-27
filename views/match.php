<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'];

require_once 'import.php';
require_once $documentRoot . '/model/DAO/teamDAO.php';
require_once $documentRoot . '/model/DAO/classes/gamematch.php';
require_once $documentRoot . '/views/team.php';
require_once $documentRoot . '/model/DAO/qrDAO.php';
require_once $documentRoot . '/views/qr.php';

function printMatch($match, $printTeams = false)
{
  ?>
  <div class="basis-full m-3 mb-5 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
    <div class="mb-2 flex items-center gap-3">
      <a href=" /match.php?id=<?php echo $match->getId(); ?>" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500">
        Match: <?php echo $match->getName(); ?>
      </a>
      <div class="center relative inline-block whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
        <div class="mt-px">Match id: <?php echo $match->getId() ?></div>
      </div>
    </div>
    <?php 
      
      if ($printTeams) {
        ?>
        <div class="flex flex-wrap gap-3">
        <?php
        $dao = new TeamDAO();
        $teams = $dao->getTeamsByMatchId($match->getId());
        foreach ($teams as $team) {
          ?> <div class=""> <?php
          printTeam($team);
          ?> </div> <?php
        }
        addTeamForm($match->getId());
        ?>
        </div>
        <?php
      }

      ?>
  </div>
  <?php
}

function createMatchForm()
{
  ?>
  <div class="flex-2 mb-5 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
    <form action="controllers/createMatch.php" method="post">
      <div class="mb-2 flex items-center gap-3">
        <label>Create new match:</label>
        <input type="text" name="matchName" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors" placeholder="Match name">
        </input>
        <div class="center relative inline-block select-none whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
          <input type="submit" value="submit" class="mt-px cursor-pointer"></input>
        </div>
      </div>
    </form>
  </div>
  <?php
}

function printMatchPage($match){
  ?>
  <div class="flex flex-col items-center justify-center">
    <div class="flex flex-col w-full m-3 mb-5 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10">
      <div class="mb-2 flex items-center gap-3">
        <a href=" /match.php?id=<?php echo $match->getId(); ?>" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500">
          Match: <?php echo $match->getName(); ?>
        </a>
        <div class="center relative inline-block whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
          <div class="mt-px">Match id: <?php echo $match->getId() ?></div>
        </div>
      </div>
      <div class="flex flex-wrap gap-3 flex-col">
        <h3>Teams:</h3>
        <div class="flex flex-wrap gap-3">
      <?php
      $dao = new TeamDAO();
      $teams = $dao->getTeamsByMatchId($match->getId());
      foreach ($teams as $team) {
        ?> <div class=""> <?php
        printTeam($team);
        ?> </div> <?php
      }
      addTeamForm($match->getId());
      ?>
      </div>
    </div>
    <div class="flex flex-wrap gap-3 flex-col">
        <h3>Qr codes (Places):</h3>
      <?php
      $dao = new QrDAO();
      $qrs = $dao->getQrsByMatchId($match->getId());
      foreach ($qrs as $qr) {
        ?> <div class=""> <?php
          printQr($qr);
        ?> </div> <?php
      }
      createQrForm($match->getId());
      ?>
    </div>
  <?php
}

?>