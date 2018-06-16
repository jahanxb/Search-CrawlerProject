import requests
import bs4
import csv
from datetime import datetime
import json
import re
import os
import codecs

user_agent = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.64 Safari/537.11'
accept = 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8'
accept_charset = 'ISO-8859-1,utf-8;q=0.7,*;q=0.3'
accept_lang = 'en-US,en;q=0.8'
connection = 'keep-alive'

headers = {
    'User-Agent': user_agent,
    'Accept': accept,
    'Accept-Charset': accept_charset,
    'Accept-Language': accept_lang,
    'Connection': connection,
}

DOWNLOAD_PATH = "ebooks"

def download_book(url,  id):
	r = requests.get(url)
	soup = bs4.BeautifulSoup(r.text,"lxml")
	soup.body.hidden = True
	soup.p.hidden = True
	body = soup.body
	if body is not None:
		filename = os.path.join(DOWNLOAD_PATH, "book_" + str(id) + "." + "txt")
		with open(filename, "wb") as file:
			file.write((body).encode('UTF-8'))
		file.close()
		return True
	else:
		return False


try:
		if not os.path.exists(DOWNLOAD_PATH):
			os.mkdir(DOWNLOAD_PATH)
		counter = 0
		for i in range(1,45000):
			res = requests.get('http://www.gutenberg.org/ebooks/'+str(i))
			type(res)
			soup = bs4.BeautifulSoup(res.text, 'lxml')
			type(soup)
			link = soup.find(text=re.compile(r'Plain Text UTF-8'))
			if link is not None:
				link = link.parent.get('href')
				print("http:"+ link)
				if download_book("http:" + link, i):
					print(i)
					counter += 1
			else:
				with open("is_not_exist.txt", "a+") as f:
					f.write(str(i) + "\n")
					print("Book id ", i, " does not exist.")
					f.close()

	except(RuntimeError):
		print("An error occured")
		#raise TypeError



