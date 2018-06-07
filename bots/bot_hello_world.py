#!/usr/bin/python
import urllib2
from urlparse import urlparse
import httplib
from BaseHTTPServer import BaseHTTPRequestHandler,HTTPServer

PORT_NUMBER = 8080

conn = httplib.HTTPConnection("localhost")
#conn.request("GET", "/index.php")
#message = "'my name is hello_world and my url is hello_world.simuino.com'"
message = str("My name is hello_world and my url is hello_world.simuino.com:8080. I want to register");
message = urllib2.quote(message)
url = "/git/conversational-api/bds/index.php?msg=" + message
#print url
conn.request("GET", url)
r1 = conn.getresponse()
#print r1.status, r1.reason
data = r1.read()
print data

#This class will handles any incoming request from
#the browser
class myHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        self.send_response(200)
        self.send_header('Content-type','text/html')
        self.end_headers()
	# Send the html message
        self.wfile.write("Hello World !")

        query = urlparse(self.path).query
        print query
        #query_components = dict(qc.split("=") for qc in query.split("&"))
        #print query_components
        #msg = query_components["msg"]
        #print msg

    # Or use the parse_qs method

        #query_components = parse_qs(urlparse(self.path).query)
        #print query_components
        #msg = query_components["msg"]
        #print msg
    # query_components = { "imsi" : ["Hello"] }

try:
#Create a web server and define the handler to manage the
#incoming request
    server = HTTPServer(('', PORT_NUMBER), myHandler)
    print 'Started httpserver on port ' , PORT_NUMBER

#Wait forever for incoming htto requests
    server.serve_forever()

except KeyboardInterrupt:
    print '^C received, shutting down the web server'
    server.socket.close()
