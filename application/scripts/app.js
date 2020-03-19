var app = require('http').createServer(handler)
var io = require('socket.io')(app);
var fs = require('fs');

// Create a new server using the listen function, specifying the port number here.

// Handle if the user connecting is new or not.
var newConnection = true;
const newMessage = {username: "System",message: "Hello and welcome to our chat service. A member of staff will be with you shortly"};
let roomHistory = {};
let openRooms = [];
let allRooms = [];

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

    socket.on("join" , function(room) {
        console.log("a")
        socket.join(room);
        if (room === "admin") {
            if (openRooms.length > 0) {
                io.sockets.in(room).emit("open room", openRooms[0]);
            }
            else {
                console.log(1)
                io.sockets.in(room).emit("no rooms", true); 
            }
        }
        else io.sockets.in(room).emit("server history", roomHistory[room]);
    });

    socket.on("leave" , function(room) {
        socket.leave(room);
    });

    socket.on("end" , function(room) {
        io.sockets.in(room).emit("end chat", true);
        delete roomHistory[room];
        openRooms = openRooms.filter( value => value !== room );
        allRooms = allRooms.filter( value => value !== room );
    });

    // When we recieve a message from the client...
    socket.on("client message", function(data) {
        // Print it onto the terminal
        console.log("Client message recieved: " + data.message);

        if (data.newRoom) {
            roomHistory[data.roomID] = [];
            io.sockets.in(data.roomID).emit("server message", newMessage);
            roomHistory[data.roomID].push(newMessage);
            openRooms.push(data.roomID);
            allRooms.push(data.roomID);
        }

        // Send the same message back to the client, but with a different namespace.
        io.sockets.in(data.roomID).emit("server message", data);
        roomHistory[data.roomID].push(data);
    });
});

// Run our Node.js / Socket.IO server on port 8080
app.listen(8080, function() {
    // Print a messaage om the terminal when the server starts.
    console.log("Server started.");
});
