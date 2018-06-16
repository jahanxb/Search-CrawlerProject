import requests
import bs4
import json
import urllib.request
import reviewCommentAmazonAPI







#countries=['com','co.uk','ca','de']
countries=['cn']
'''
books=[
        'http://www.amazon.%s/Glass-House-Climate-Millennium-ebook/dp/B005U3U69C',
        'http://www.amazon.%s/The-Japanese-Observer-ebook/dp/B0078FMYD6',
        'http://www.amazon.%s/Falling-Through-Water-ebook/dp/B009VJ1622',
      ]
'''
books=[
    'https://www.amazon.%s/Constitution-United-States-Declaration-Independence/dp/1631581481/'
]
for book in books:
    print ('-'*40)
    print (book.split('%s/')[1])
    for country in countries:
        asin=book.split('/')[-1]; title=book.split('/')[3]
        url='http://www.amazon.%s/product-reviews/%s'%(country,asin)

        try:
            f = urllib.request.urlopen(url).read()

        except:
            #f = urllib.urlopen(url)
            f = urllib.request.urlopen(url).read()
            page=""
            page=f.read().lower()
            print ('%s=%s'%(country, page.count('member-review')))
            print ('-'*40)