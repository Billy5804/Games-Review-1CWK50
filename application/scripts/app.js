var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

// Run our Node.js / Socket.IO server on port 8080
app.listen(8080, function() {
    // Print a messaage om the terminal when the server starts.
    console.log("Server started.");
});



const newMessage = {username: "System",message: "Hello and welcome to our chat service. A member of staff will be with you shortly"};
let roomHistory = {};
let openRooms = [];
let allRooms = [];
let globalHistory = [];

roomHistory.admin = [];

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
io.sockets.on('connection', function (socket) {
    // Print a message on the terminal when a new user connects.
    console.log("Someone has connected!");

    // Join room provided by client and send the rooms history
    socket.on("join" , function(room) {
        socket.join(room);
        if (room === "admin") {
            if (openRooms.length > 0) {
                io.sockets.in(room).emit("open room", openRooms[0]);
            }
            else {
                io.sockets.in(room).emit("no rooms", true); 
            }
        }
        else io.sockets.in(room).emit("server history", roomHistory[room]);
        
    });

    // send global history
    socket.on("get global", function(){
        io.emit("global history", globalHistory);
    });

    // leave room specified by client
    socket.on("leave" , function(room) {
        socket.leave(room);
    });

    // end a chat clear its history from the server and tell the clients to leave the room
    socket.on("end" , function(room) {
        io.sockets.in(room).emit("end chat", true);
        delete roomHistory[room];
        openRooms = openRooms.filter( value => value !== room );
        allRooms = allRooms.filter( value => value !== room );
    });

    // When we recieve a support message from the client...
    socket.on("client message", function(data) {
        // Print it onto the terminal
        console.log("Client message recieved: " + data.message);

        // if this is the first message in a support room
        // add it to the server to record history and assing staff to it
        // also send a automated message to the client
        if (data.newRoom) {
            roomHistory[data.roomID] = [];
            io.sockets.in(data.roomID).emit("server message", newMessage);
            roomHistory[data.roomID].push(newMessage);
            openRooms.push(data.roomID);
            allRooms.push(data.roomID);
        }

        // Send the same message back to the client, but with a different namespace.
        io.sockets.in(data.roomID).emit("server message", data);
        // record the message to the server unless its in the admin room
        roomHistory[data.roomID].push(data);
        roomHistory.admin = [];
    });

    // When we recieve a global message from the client...
    socket.on("global client message", function(data) {
        // check the user is logged in
        if (data.loggedIn) {
            // Print it onto the terminal
            console.log("global message recieved: " + data.message);

            // Send the same message back to the client, but with a different namespace.
            io.emit("global server message", data);
            // record the message to the global chat history
            globalHistory.push(data);
        }
    });
});