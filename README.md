# instilla

You are expected to develop a simple web app using plain HTML and PHP (and of course any HTML parsing library you find online). The web app should be hosted on Heroku (heroku.com) and available on a public repository on GitHub.

Here you can find the specifications:

1) the web app is a single page application containing two text input fields and a submit button

2) the user can fill the two input fields with the homepage address of two websites (i.e. http://www.gazzetta.it and http://www.tuttosport.com )

3) when the user clicks on the submit button, the application calls the "findAndCompare" function in the back-end

4) the findAndCompare function will execute the following operations

	- retrieve the href attributes within all the anchor tags on both homepage urls provided by the user

	- crawl both websites by one level depth, and retrieve the href attributes within all the anchor tags found on the crawled pages

	- aggregate all the inbound links (hrefs pointing to the same domain) found in the two domains into two different arrays

	- compare the links in the two arrays, and for each link in the first array find the most similar link in the second array (you can use the string similarity algorithm you can find in Oliver 1993, "Programming Classics: Implementing the World's Best Algorithms.")

	- force the client browser to download a csv file having on each row: 
	url from the first domain, url from the second domain, percentage of similarity between the two strings


The output will look like the following:

http://www.gazzetta.it, http://www.tuttosport.com, 100.00%
http://www.gazzetta.it/messi-all-inter, http://www.tuttosport.com/l-inter-compra-messi, 46.00%
http://www.gazzetta.it/udinese-esonerato-massimo-oddo, http://www.tuttosport.com/massimo-oddo-lascia-l-udinese, 55.00%
http://www.gazzetta.it/il-napoli-vince-lo-scudetto, http://www.tuttosport.com/grande-sarri-scudetto-al-napoli, 21.66%

 
You are expected to solve the test within 24 hours and provide 
- the link to your public GitHub repository
- the link to the app hosted on Heroku


Once you completed the exercise above, you can add the following features to the web app in plain JavaScript.

BONUS 1
You can add in the main HTML page of your app a label which shows the sum of the number of characters contained in the two inputs. The label content is updated every time the user types a new character.

BONUS 2
You can add another label containing the sum of positions in the alphabet of each character contained in the first input (i.e. "ciao" => 3+9+1+15 )
