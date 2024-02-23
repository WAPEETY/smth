<?php

require_once 'import.php';

function printTeam($team){
    ?>

<div
  class="absolute max-w-[26rem] whitespace-normal break-words rounded-lg border border-blue-gray-50 bg-white p-4 font-sans text-sm font-normal text-blue-gray-500 shadow-lg shadow-blue-gray-500/10 focus:outline-none"
>
  <div class="mb-2 flex items-center gap-3">
    <a
      href="#"
      class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors hover:text-pink-500"
    >
      <?php echo $team->getName(); ?>
    </a>
    <div
      class="center relative inline-block select-none whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white"
      
    >
      <div class="mt-px">Team id: <?php $team->getId() ?></div>
    </div>
  </div> 
</div>
    <?php
}

function createTeamForm($match){
}

?>