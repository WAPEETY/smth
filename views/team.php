<?php

require_once 'import.php';
require_once $documentRoot . '/model/DAO/teamDAO.php';
require_once $documentRoot . '/model/DAO/classes/team.php';

function printTeam($team){
    ?>

<div
  class="max-w-[36rem] whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none"
>
  <div class="mb-2 flex items-center gap-3">
    <a
      href="#"
      class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500"
    >
      <?php echo $team->getName(); ?>
    </a>
    <div
      class="center relative inline-block whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white"
      
    >
      <div class="mt-px">Team secret: <?php echo $team->getSecret() ?></div>
    </div>
  </div> 
</div>
    <?php
}

function addTeamForm($matchid){
  ?>
  <div class="flex-2 mb-5 whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none">
    <form action="controllers/createTeam.php" method="post">
      <div class="mb-2 flex items-center gap-3">
        <input type="hidden" name="matchId" value="<?php echo $matchid; ?>"></input>
        <input type="hidden" name="secret" value="<?php echo bin2hex(random_bytes(1)); ?>"></input>
        <input type="text" name="teamName" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors" placeholder="Team name">
        </input>
        <div class="center relative inline-block select-none whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
          <input type="submit" value="submit" class="mt-px cursor-pointer"></input>
        </div>
      </div>
    </form>
  </div>
  <?php
}

?>