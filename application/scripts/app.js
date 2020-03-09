var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

// Create a new server using the listen function, specifying the port number here.

// Handle if the user connecting is new or not.
var newConnection = true;

// Handle the head response.
function handler (req, res) {
    fs.readFile(__dirname + '/index.html',
        function (err, data) {
            if (err) {
                res.writeHead(500);
                return res.end('Error loading index.html');
            }
            res.writeHead(200);
            res.end(data);
        });
}

// Create an event handler that monitors new connections.
io.on('connection', function (socket) {
    // Print a message on the terminal when a new user connects.
    console.log("Someone has connected!");

    // When we recieve a message from the client...
    socket.on("client message", function(data) {
       
        // Print it onto the terminal
        console.log("Client message recieved: " + data);

        // Send the same message back to the client, but with a different namespace.
        io.emit("server message", data);
    });
});

// Run our Node.js / Socket.IO server on port 8080
app.listen(8080, function() {
    // Print a messaage om the terminal when the server starts.
    console.log("Server started.");
});
