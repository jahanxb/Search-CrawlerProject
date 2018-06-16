Following are the files Order: 
We have Crawled more than 40,000 books from 
http://www.gutenberg.org

There are 4 parts of our project each with some specific tasks. 

1)To Crawl The books Information and Store them in a JSON File Name "BookDatasetLarge.json"

Run Script name "crawler.py"

2) To Download books from the site and Store them in the directory name "ebooks" 
Run Script name "GutenbergBookDownloader.py"

3) To Crawl Reviews of these books from Amazon as the BASE Site doesn't provide reviews/comment we have use Amazon.['com','cn']
For this Purpose we have use AmazonIntegrationAPI 
to run this code you have to install some libraries as well. For further details contact us 

In case you are fimilar then run Script Name "ReviewComment.py" and it will store the reviews in a "books_review.json"

4) After all this work.
You can install an apache server with PHP install on the top of symfony framework (not necessary) 
and goto localhost/Machine IP and open up the "index.php" page. 
You will find a search box there. type the keyword and click on Search. (note it's a input type:"button" not "submit" so you have to click) 

------------------------------------------------
===============================================
------------------------------------------------
In case of any problem Please do let us know 
------------------------------------------------
ABOUT OUR DATASET
We have Crawled: 
(total number of books > 40,000)
15 GB Worth of books (total number of books > 40,000)
21 MB of Books Information e.g like Author name, title, subject e.t.c
5 GB of Comments from Amazon. 

NOTE: Right now we are only providing you with a very small dataset size. So at the day of evaluation we will show you the data files 
and also will run our Search code on that. 

 