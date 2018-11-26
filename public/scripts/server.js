// Load the default NodeJS HTTP module.
const http = require('http');


// Create server.
const hostname 	= 'localhost';
const port 		= 8080;

const server = http.createServer((req, res) => {
  	// Prevent error "No Access-Control-Allow-Origin header is present on the requested resource".
	res.setHeader('Access-Control-Allow-Origin', '*');
	res.setHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');

	res.setHeader('Content-Type', 'text/plain');
	res.statusCode = 200;

	let datetime = new Date().toLocaleString();

	res.end(datetime);
});


// Listen to server.
server.listen(port, hostname, () => {
	
});