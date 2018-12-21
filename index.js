var socket = require('socket.io');
var express = require('express');
var app = express();
var server = require('http').createServer(app);
var io = socket.listen(server);
var port = process.env.PORT || 3000;

server.listen(port, function () {
    console.log('Server listening at port %d', port);
});
/*
http.listen(3000, function(){
  console.log('listening on *:3000');
});*/

io.on('connection', function(socket){
  socket.on('call_message', function(data){
  	//var data = JSON.parse(data);
    console.log('message from User: ' + data.user + ', Message: '+ data.message);
    io.sockets.emit('notification', data);
  });
});