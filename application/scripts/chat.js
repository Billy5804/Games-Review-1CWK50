$(document).ready(function() {
    // Connect to the Socket.IO server
    var socket = io.connect("http://localhost:8080", { 'connect timeout': 5000 });

    // Enable chat function when connected to serve
    // Enable global chat for logged in users
    socket.on('connect', async function(){
        $("#chatButton").prop('disabled', false);
        $("#sendButton").prop('disabled', false);
        $("#sendGlobalButton").prop('disabled', false);
        const userDetails = await getUserDetails();
        if (userDetails.loggedIn) 
            $("#chatButtonGlobal").removeClass("invisible");

        if (typeof getCookie("chatRoom") === 'undefined')
            joinNewSupportChat();
        else 
            socket.emit('join', getCookie("chatRoom"));
    });

    // Join new support room / admin waiting room
    async function joinNewSupportChat() {
        let roomID = (+new Date).toString(36);
        let newRoom = true;
        const userDetails = await getUserDetails();
        if (userDetails.admin) {
            roomID = "admin";
            newRoom = false;
        }
        socket.emit('join', roomID);
        setCookie("chatRoom", roomID, 1);
        setCookie("newRoom", newRoom, 1);
        $("#supportChatArea").empty();
        $("#globalChatArea").empty();
    }

    // clear Chat related cookies
    function removeChatCookie() {
        clearCookie("chatRoom");
        clearCookie("newRoom");
    }

    // Clear chats on disconnect from server and disables chat
    socket.on('diconnect', function(){
        $("#chatButton").prop('disabled', true);
        $("#sendButton").prop('disabled', true);
        $("#sendGlobalButton").prop('disabled', true);
        removeChatCookie()
    });

    // Clear chats on connection error and disables chat function
    socket.on('connect_error', function(){
        $("#chatButton").prop('disabled', true);
        $("#sendButton").prop('disabled', true);
        $("#sendGlobalButton").prop('disabled', true);
        removeChatCookie()
    });

     // Clear chats on connection timeout and disables chat function
    socket.on('connect_timeout', function(){
        $("#chatButton").prop('disabled', true);
        $("#sendButton").prop('disabled', true);
        $("#sendGlobalButton").prop('disabled', true);
        removeChatCookie()
    });





    // When the form submits for a support message...
    $("#supportChatForm").submit(async function(e) {
        // Prevent page redirect and other defauld behaviour
        e.preventDefault();

        // prepare the message details
        let messageDetails = await getUserDetails();
        messageDetails.newRoom = (getCookie("newRoom") == "true");
        messageDetails.message = $("#supportMessage").get(0).value;
        messageDetails.roomID = getCookie("chatRoom");
        if (messageDetails.newRoom) setCookie("newRoom", false, 1);

        // Send a message to the server in the client message namespace
        socket.emit("client message", messageDetails);
        // Reset the input field to blank
        $("#supportMessage").get(0).value = "";
    });

    // When we recieve a support message from the server...
    socket.on("server message", function(data) {
        displayRecievedMessage($("#supportChatArea"), [data]);
    }); 

    // When we recieve support chat history from the server...
    socket.on("server history", function(data) {
        $("#supportChatArea").empty();
        displayRecievedMessage($("#supportChatArea"), data);
    }); 




    // When the form submits for a global message...
    $("#globalChatForm").submit(async function(e) {
        e.preventDefault();
        let messageDetails = await getUserDetails();
        messageDetails.message = $("#globalMessage").get(0).value;

        // Send a message to the server in the client message namespace
        socket.emit("global client message", messageDetails);
        // Reset the input field to blank
        $("#globalMessage").get(0).value = "";
    });

    // When we recieve a global message
    socket.on("global server message", function(data) {
        displayRecievedMessage($('#globalChatArea'), [data]);
    }); 

    // When we recieve global chat history from the server...
    socket.on("global history", function(data) {
        $("#globalChatArea").empty();
        displayRecievedMessage($('#globalChatArea'), data);
    }); 





    // Admin Join open support room
    socket.on("open room", function(room) {
        setCookie("chatRoom", room, 1);
        socket.emit('join', room);
    });

    // No Rooms available to provide support display message and try again in 10 seconds
    socket.on("no rooms", function() {
        setTimeout(() => {
            $("#supportChatArea").empty();
            displayRecievedMessage($("#supportChatArea"), [{username: "System", message: "Your Help isn't required at the moment"}]);
        }, 500);
        getCookie()
        setTimeout(() => {
            socket.emit('join', getCookie("chatRoom"));  
        }, 10000);
    });

    // Close current support room
    $("#chatButtonEnd").click(function() {
        if (getCookie("newRoom") != "true") {
            socket.emit('end', getCookie("chatRoom"));
        }
    });

    // Leave closed support room and ready new support room
    socket.on("end chat", function() {
        socket.emit('leave', getCookie("chatRoom"));
        joinNewSupportChat();
        const endMessage = {username: "System",message: "Thanks for using our chat service. To start a new chat simply type a message below."};
        setTimeout(() => {
            displayRecievedMessage($("#supportChatArea"), [endMessage]);
        }, 500);
        
    });

    // Display messages and sender with a preix added to admin usernames
    async function displayRecievedMessage(chatArea, messagesData) {
        let userDetails = await getUserDetails();
        $.map(messagesData, function (messageData) {
            // Add the message to the output area and create a new line.
            if (userDetails.username === messageData.username) {
                if (messageData.admin) messageData.username = "[ADMIN] " + messageData.username;
                chatArea.append("<p class='ml-auto' style='width: fit-content;margin-right: 15px;margin-bottom: 0;'>"
                    +messageData.username
                    +"</p><p class='bg-primary'style='margin: 0 10px 0 30px; border-radius:0.75rem; padding: 0.5rem'>"
                    + messageData.message + "</p>");
            }
            else {
                if (messageData.admin) messageData.username = "[ADMIN] " + messageData.username;
                chatArea.append("<p class='mr-auto' style='width: fit-content;margin-left: 15px;margin-bottom: 0;'>"
                    +messageData.username
                    +"</p><p class='bg-info'style='margin: 0 30px 0 10px; border-radius:0.75rem; padding: 0.5rem'>"
                    + messageData.message + "</p>");
            }
        });
        chatArea.animate({scrollTop: chatArea.get(0).scrollHeight}, 500); // Scroll to most recent message
    }
});