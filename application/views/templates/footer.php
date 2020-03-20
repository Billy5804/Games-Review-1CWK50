        </main>
        <!-- button to toggle chat screen  -->
        <button id="chatButton" class="open-button btn btn-success fixed-bottom" onclick="openForm(event)" disabled>Chat</button>
        <!-- chat system -->
        <div id="chatSystem" class="ml-auto invisible fixed-bottom float-right <?php echo $headerFooter?>">
            <!-- button to close the chat screen -->
            <button id="chatButtonClose" class="close-button float-left  btn btn-danger" onclick="closeForm(event)"> X </button>
            <h2 id="chatTitle" class="<?php echo $textSecondary?>">Support</h2>
            <!-- button to end support chat -->
            <button id="chatButtonEnd" class="close-button btn btn-warning float-right">End Chat</button>
            <div id="chatsArea">
                <!-- buttons to switch between support and global chats -->
                <button id="chatButtonSupport" class="close-button  btn btn-success" onclick="showSupport(event)">Support Chat</button>
                <button id="chatButtonGlobal" class="close-button  btn btn-success invisible" onclick="showGlobal(event)">Global Chat</button>
                
                <!-- support chat -->
                <div id="supportChatArea" class="overflow-auto">

                </div>
                <form id="supportChatForm" class=" form-inline form-container">
                    <textarea rows="1" type="text" class="form-control" id="supportMessage" autocomplete="off" ></textarea>
                    <button class="btn btn-primary float-right" id="sendButton">Send</button>
                </form>

                <!-- global chat -->
                <div id="globalChatArea" class="overflow-auto invisible">

                </div>
                <form id="globalChatForm" class="invisible form-inline form-container">
                    <textarea rows="1" type="text" class="form-control" id="globalMessage" autocomplete="off" ></textarea>
                    <button class="btn btn-primary float-right" id="sendGlobalButton">Send</button>
                </form>
            </div>
        </div>
        <!-- Footer -->
        <footer class="page-footer font-small <?php echo $headerFooter?>">
        
            <img class="float-left <?php echo $mode?>" src="<?php echo base_url('application/images/Manchester_Metropolitan_University_logo.svg');?>"/>

            <!-- Copyright -->
            <div class="text-center <?php echo $textSecondary?> py-3">
                <a href="#top" alt="A link that scrolls back to the page start.">©6G5Z2107 - Alex Royle - 18026718 - <?php echo date("Y"); ?></a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

        <?php  echo $alert //load any alerts passed from the controller ?>
    </body>
</html>