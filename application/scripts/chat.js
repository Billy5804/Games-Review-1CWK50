$(document).ready(function() {
    // Connect to the Socket.IO server
    var socket = io.connect("http://localhost:8080");

    socket.on('connect', function(){
        $("#chatButton").prop('disabled', false);
        $("#sendButton").prop('disabled', false);
    });

    socket.on('connect_failed', function(){
        $("#chatButton").prop('disabled', true);
        $("#sendButton").prop('disabled', true);
    });

    socket.on('disconnect', function(){
        $("#chatButton").prop('disabled', true);
        $("#sendButton").prop('disabled', true);
    });

    // When the form submits...
    $("#chatform").submit(function(e) {
        e.preventDefault();
        // Send a message to the server in the client message namespace
        socket.emit("client message", $("#message").get(0).value);
        // Reset the input field to blank
        $("#message").get(0).value = "";
    });
    // When we recieve a message from the server...
    socket.on("server message", function(data) {
        // Add the message to the output area and create a new line.
        $("#chatArea").append(data + "<br>");
    }); 
});