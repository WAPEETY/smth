<?php

$server_root = $_SERVER['DOCUMENT_ROOT'];
require_once $server_root . '/views/question.php';

function setupList(){
    ?>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        // Faq
        document.addEventListener("alpine:init", () => {
        Alpine.store("accordion", {
            tab: 0
        });

        Alpine.data("accordion", (idx) => ({
            init() {
            this.idx = idx;
            },
            idx: -1,
            handleClick() {
            this.$store.accordion.tab =
                this.$store.accordion.tab === this.idx ? 0 : this.idx;
            },
            handleRotate() {
            return this.$store.accordion.tab === this.idx ? "-rotate-180" : "";
            },
            handleToggle() {
            return this.$store.accordion.tab === this.idx
                ? `max-height: ${this.$refs.tab.scrollHeight}px`
                : "";
            }
        }));
        });
        //  end faq

        </script>

<style>
    [x-cloak] {
        display: none !important;
    }
</style>
    
    <?php
}

function printAddQuestion($qr, $teamId){
    $QrDao = new QrDAO();
    $availableTeams = $QrDao->getAvailableTeams($qr->getId());
    ?>

    
    <div class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
    <div class="w-full p-4 text-left cursor-pointer">
                <div class="flex items-center center">
                <svg class="w-5 h-5" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12H20M12 4V20" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<script xmlns="" id="bw-fido2-page-script"/></svg> <h2> Aggiungi squadra</h2>
                </div>


            <form action="controllers/createQuestion.php" method="post">
                <input type="hidden" name="qrId" value="<?php echo $qr->getId(); ?>"></input>
                <input type="text" name="q_text" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors" placeholder="Question">
                </input>
                <textarea name="answers" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors" placeholder="Answers"></textarea>
                <input type="text" name="hint" class="block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors" placeholder="Hint">
                </input>
                <select name="teamId" class="mt-2 mb-2 block font-sans text-base font-medium leading-relaxed tracking-normal text-blue-gray-900 antialiased transition-colors">
                    <?php
                    foreach($availableTeams as $team){
                        ?>
                        <option value="<?php echo $team->getId(); ?>"><?php echo $team->getName(); ?></option>
                        <?php
                    }
                    ?>
                </select>
                <div class="center relative inline-block select-none whitespace-nowrap rounded-full bg-purple-500 py-1 px-2 align-baseline font-sans text-xs font-medium capitalize leading-none tracking-wide text-white">
                    <input type="submit" value="submit" class="mt-px cursor-pointer"></input>
                </div>
            </form>
            </div>
    </div>
    
    <?php
}

function printQuestionForCard($question){
    $server_root = $_SERVER['DOCUMENT_ROOT'];
    require_once $server_root . '/model/DAO/questionsDAO.php';
    ?>
        <div x-data="accordion(<?php echo $question['id']?>)" class="relative transition-all duration-700 border rounded-xl hover:shadow-2xl">
            <div @click="handleClick()" class="w-full p-4 text-left cursor-pointer">
            <div class="flex items-center justify-between">
                <span class="tracking-wide"><?php echo $question['question'] ?> - <?php echo $question['team']->getName(); ?></span>
                <span :class="handleRotate()" class="transition-transform duration-500 transform fill-current ">
                <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                </svg>
                </span>
            </div>
            </div>

            <div x-ref="tab" :style="handleToggle()" class="relative overflow-hidden transition-all duration-700 max-h-0">
                <div class="px-6 pb-4 text-gray-600">
                    <ul style="
                        list-style-type: circle;
                    ">
                        
                        <?php
                        $answers = json_decode($question['answers'], true);

                        foreach($answers as $answer){
                            ?>
                            <li <?php echo $answer[1] ? 'style="list-style-type: disc;"' : ''; ?> ><?php echo $answer[0]; ?></li>
                            <?php
                        }
                        ?>
                    </ul>    
                </div>
            </div>
        </div>
    <?php
}
?>