import requests
import bs4
import json
myBook = []
for i in range(1, 3):
    try:
        res = requests.get('http://www.gutenberg.org/ebooks/' + str(i))
        type(res)
        soup = bs4.BeautifulSoup(res.text, 'lxml')
        type(soup)
        table = soup.find("table", {"class": "bibrec"})
        rows = table.findAll(lambda tag: tag.name == 'tr')
        output = {}
        attr = 0
        for row in rows:
            title = row.find_all('th')[0].contents[0]
            data = str(row.text)
            data = str.replace(data, '\n', '')
            data = str.replace(data, title, '')
            title = str.replace(title, '\u00a0', ' ')
            data = str(data)
            output[title] = data
        myBook.append( output)
        print(i)
    except(RuntimeError):
        pass
file = open("myData.json", "w+")
json.dump(myBook, file)
file.close()