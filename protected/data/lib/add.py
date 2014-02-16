import sys
import binascii
from socket import *

def addUser(ADDR, formattedID):
	c = socket(AF_INET, SOCK_STREAM)
	c.connect((ADDR))
	
	#print formattedID
	#print (formattedID == "00434B23")
	
	s1 = "A5FFFFFF" # Passwd string - A5 and the 6 digit password

	s2 = "09" + "A84144444C535400" + "A2" # Command to add an user,
	#ends with checksum A2

	s3 = "55" + formattedID + "E0E0" + "888888" + "3232323232323232323232" + "3131313131313131" + "E3FC" + "00" # Hex value of key
	#Description of each part of the string:
	#1. "55" U (for User)
	#2. the user's ID
	#3. which door to grant access, E0EE is just door 1, E0E0 is both doors
	#4. "888888" ???
	#5. 11 character max field showing user's "code", possibly for employee ID
	#6. 8 character max field for user's name
	#7. "E3FC" ???
	#This key usually ends with a checksum value which is generated later in this code 


	s4 = "00" # Appears to be an acknowledgement string

	# function to change final hex value to correct checksum
	def addChecksum( hexStr ):
		xor = 0
		for i in range(0, len(hexStr)-1):
			xor = xor ^ ord(hexStr[i])
		return hexStr[0:-1] + chr(xor)
	 
	# Convert to binary / hex (yes, there are a ton of ways to do this)
	b1 = binascii.a2b_hex(s1)
	#b2 = "\t" + addChecksum(binascii.a2b_hex(s2))
	b2 = binascii.a2b_hex(s2)
	b3 = addChecksum(binascii.a2b_hex(s3))
	b4 = binascii.a2b_hex(s4)

	#print (binascii.hexlify(b1))
	#print (binascii.hexlify(b2))
	#print (binascii.hexlify(b3)) # debug
	#print (binascii.hexlify(b4))

	c.settimeout(10)
	c.send(b1) # Send passwd string
	c.send(b2) # send add user command
	c.recv(1) # Wait for acknowledgement (\x26)
	c.send(b3) # Send key
	c.send(b4) # Send acknowledgement
	response = ""
	while True:
		x = c.recv(1)
		if len(x) == 0:
			response = "User Added"
			break
	c.close()
	return response