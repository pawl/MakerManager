import cherrypy
from lib.remove import removeUser
from lib.add import addUser
import os

HOST = '10.0.0.30' # IP of the reader
PORT = 1868
ADDR = (HOST, PORT)

class RootServer:
    @cherrypy.expose
    def index(self, apiKey=None, action=None, badge=None):
		if (apiKey == "secret"):
			if badge:
				if len(badge) > 8:
					return "Error: Too many digits in Badge"
				formattedID = str(("{0:x}".format(int(badge))).zfill(8))
				if (action == "remove"):	
					# try to terminate the user up to 5 times
					userRemoved = 0
					for x in range(0,4):
						result = removeUser(ADDR, formattedID)
						if result == "Response Received - User Not Registered":
							userRemoved = 1
							break
					if userRemoved == 1:
						return "User Removed Successfully"
					else:
						return "Failed To Remove User"
				elif (action == "add"):
					result = addUser(ADDR, formattedID)
					if result == "User Added":
						return "User Added Successfully"
					else:
						return "Failed To Add User"
				else:
					return "must specify an action"
			else:
				return "no badge number entered"
		else:
			return "" #return nothing when no API key is entered

if __name__ == '__main__':
    server_config={
        'server.socket_host': '0.0.0.0',
        'server.socket_port':443,

        'server.ssl_module':'pyopenssl',
        'server.ssl_certificate':'server.crt',
        'server.ssl_private_key':'server.key',
		'log.access_file' : os.path.join("access.log"),
    }

    cherrypy.config.update(server_config)
    cherrypy.quickstart(RootServer(), '/accessControlApi')
