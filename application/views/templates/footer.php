        </main>
        <!-- This section needs editing to create the chat system using HTML -->
        <button id="chatButton" class="open-button btn btn-success fixed-bottom" onclick="openForm(event)" disabled>Chat</button>
        <div id="chatSystem" class="ml-auto invisible fixed-bottom float-right <?php echo $headerFooter?>">
            <button id="chatButtonClose" class="close-button btn btn-danger" onclick="closeForm(event)"> X </button>
            <h2 class="<?php echo $textSecondary?>">Chat</h2>
            <div id="chatArea" class="overflow-auto">

            </div>
            <form id="chatform" class=" form-inline form-container">
                <textarea rows="1" type="text" class="form-control" id="message" autocomplete="off" ></textarea>
                <button class="btn btn-primary float-right" id="sendButton">Send</button>
            </form>
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
        <?php echo $alert ?>
    </body>
</html>