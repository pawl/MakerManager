import binascii
from socket import *
import sys

def removeUser(ADDR, formattedID):
	c = socket(AF_INET, SOCK_STREAM)
	c.connect((ADDR))
	
	s1 = "A5FFFFFF" # Passwd string - A5 and the 6 digit password
	
	s2 = "09" + "A944454C4C535400" + "AF" # Command to remove an user 
	# "44454C4C5354" means DELLST (like delete list)
	#s2 = "09A8" + "4144444C5354" + "00A2" # 00A2 may specify the door #
	#erase 2nd user 09:a9:44:45:4c:4c:53:54:00:af
	#erase 3rd user 09:a9:44:45:4c:4c:53:54:00:af

	s3 = formattedID # Hex value of ID
	#s3 = "005E4440" # different id example

	#function to generate the checksum of s3
	def addChecksum( hexStr ):
		xor = 0
		for i in range(0, len(hexStr)):
			xor = xor ^ ord(hexStr[i])
		return chr(xor)

	#s4 = "4C" # Appears to be an acknowledgement string
	#erase 2nd user 00:45:69:b6 - 9A
	#erase 3rd user 00:5e:44:40 - 5A
	 
	# Convert to binary / hex (yes, there are a ton of ways to do this)
	b1 = binascii.a2b_hex(s1)
	b2 = binascii.a2b_hex(s2)
	b3 = binascii.a2b_hex(s3)
	b4 = addChecksum(binascii.a2b_hex(s3)) # assign checksum to variable
	 
	c.settimeout(10)
	c.send(b1) # Send passwd string
	c.send(b2) # send open door command
	c.recv(1) # Wait for acknowledgement (\x26)
	c.send(b3) # Send key
	c.send(b4) # Send checksum
	response = ""
	while True:
		x = c.recv(1)
		if len(x) == 0:
			break
		else:
			if (x == "5"):
				response = "Response Received - User Not Registered"
	c.close()
	return response