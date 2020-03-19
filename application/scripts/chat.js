$(document).ready(function() {
    // Connect to the Socket.IO server
    var socket = io.connect("http://localhost:8080");

    socket.on('connect', async function(){
        $("#chatButton").prop('disabled', false);
        $("#sendButton").prop('disabled', false);
        if (typeof getCookie("chatRoom") === 'undefined') {
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
        }
        else {
            socket.emit('join', getCookie("chatRoom"));
        }
    });

    // socket.on('connect_failed', function(){
    //     $("#chatButton").prop('disabled', true);
    //     $("#sendButton").prop('disabled', true);
    // });

    socket.on('disconnect', function(){
        $("#chatButton").prop('disabled', true);
        $("#sendButton").prop('disabled', true);
    });

    // When the form submits...
    $("#chatform").submit(async function(e) {
        e.preventDefault();
        let messageDetails = await getUserDetails();
        messageDetails.newRoom = false;
        messageDetails.message = $("#message").get(0).value;
        messageDetails.roomID = getCookie("chatRoom");
        if (getCookie("newRoom") == "true") {
            messageDetails.newRoom = true;
            setCookie("newRoom", false, 1);
        }

        // Send a message to the server in the client message namespace
        socket.emit("client message", messageDetails);
        // Reset the input field to blank
        $("#message").get(0).value = "";
        $('#chatArea').animate({
            scrollTop: $('#chatArea').get(0).scrollHeight}, 500);
    });
    // When we recieve a message from the server...
    socket.on("server message", async function(data) {
        let userDetails = await getUserDetails();
        // Add the message to the output area and create a new line.
        if (userDetails.username === data.username) {
            if (data.admin) data.username = "[ADMIN] " + data.username;
            $("#chatArea").append("<p class='ml-auto' style='width: fit-content;margin-right: 15px;margin-bottom: 0;'>"
                +data.username
                +"</p><p class='bg-primary'style='margin: 0 10px 0 30px; border-radius:0.75rem; padding: 0.5rem'>"
                + data.message + "</p>");
        }
        else {
            if (data.admin) data.username = "[ADMIN] " + data.username;
            $("#chatArea").append("<p class='mr-auto' style='width: fit-content;margin-left: 15px;margin-bottom: 0;'>"
                +data.username
                +"</p><p class='bg-info'style='margin: 0 30px 0 10px; border-radius:0.75rem; padding: 0.5rem'>"
                + data.message + "</p>");
        }
    }); 

    socket.on("open room", function(room) {
        setCookie("chatRoom", room, 1);
        socket.emit('join', room);
    });

    socket.on("no rooms", function() {
        setTimeout(() => {
            $("#chatArea").empty();
            $("#chatArea").append("System: Your Help isn't required at the moment<br>");
        }, 500);
        getCookie()
        setTimeout(() => {
            socket.emit('join', getCookie("chatRoom"));  
        }, 10000);
    });


    $("#chatButtonEnd").click(function() {
        if (getCookie("newRoom") != "true") {
            socket.emit('end', getCookie("chatRoom"));
        }
    });

    socket.on("end chat", async function() {
        socket.emit('leave', getCookie("chatRoom"));
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
        const endMessage = {username: "System",message: "Thanks for using our chat service. To start a new chat simply type a message below"};
        setTimeout(() => {
            $("#chatArea").append(endMessage.username+":"+ endMessage.message + "<br>"); 
        }, 500);
        
    });

    // When we recieve a chat history from the server...
    socket.on("server history", async function(data) {
        $("#chatArea").empty();
        let userDetails = await getUserDetails();
        $.map(data, function (messageData) {
            // Add the message to the output area and create a new line.
            if (userDetails.username === messageData.username) {
                if (messageData.admin) messageData.username = "[ADMIN] " + messageData.username;
                $("#chatArea").append("<p class='ml-auto' style='width: fit-content;margin-right: 15px;margin-bottom: 0;'>"
                    +messageData.username
                    +"</p><p class='bg-primary'style='margin: 0 10px 0 30px; border-radius:0.75rem; padding: 0.5rem'>"
                    + messageData.message + "</p>");
            }
            else {
                if (messageData.admin) messageData.username = "[ADMIN] " + messageData.username;
                $("#chatArea").append("<p class='mr-auto' style='width: fit-content;margin-left: 15px;margin-bottom: 0;'>"
                    +messageData.username
                    +"</p><p class='bg-info'style='margin: 0 30px 0 10px; border-radius:0.75rem; padding: 0.5rem'>"
                    + messageData.message + "</p>");
            }
        });
    }); 
});