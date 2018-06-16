import requests
import bs4
import re
import os

DOWNLOAD_PATH = "ebooks"


def book_url(url, id):
    r = requests.get(url)
    soup = bs4.BeautifulSoup(r.text, "lxml")
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
        for i in range(1, 45000):
            res = requests.get('http://www.gutenberg.org/ebooks/'+str(i))
            type(res)
            soup = bs4.BeautifulSoup(res.text, 'lxml')
            type(soup)
            link = soup.find(text=re.compile(r'Plain Text UTF-8'))
            if link is not None:
                link = link.parent.get('href')
                print("http:"+ link)
                if book_url("http:" + link, i):
                    print("Book Downloaded: ", i)
                else:
                    with open("is_not_exist.txt", "a+") as f:
                        f.write(str(i) + "\n")
                        print("Book  ", i, " does not exist.")
                    f.close()
except(RuntimeError):
    print("Book not found", i)




