        </main>
        <!-- This section needs editing to create the chat system using HTML -->
        <div id="chatSystem" class="fixed-bottom" style="z-index: 1000;">
        <button id="chatButton" class="open-button btn btn-success float-right" onclick="openForm()">Chat</button>
            <div class="chat-popup pull-right" id="myForm">
            <form id="myform" class="form-container">
            </form>
            </div>
        </div>
        <!-- Footer -->
        <footer class="page-footer font-small bg-light">
        
            <img class="float-left" src="application/images/Manchester_Metropolitan_University_logo.svg"/>

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">
                <a href="#top" alt="A link that scrolls back to the page start.">©6G5Z2107 - Alex Royle - 18026718 - <?php echo date("Y"); ?></a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->

        <!-- Load in the required scripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <!-- Don't forget to load in Vue abd socket.io -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vue"></script> 

        <!-- Load in your custom scripts -->
        <script src="<?php echo base_url('application/scripts/CustomVue.js');?>"></script>
        <script src="<?php echo base_url('application/scripts/app.js');?>"></script>
    </body>
</html>