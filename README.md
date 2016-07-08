# Kino

This is test API based on Nette which I made for mine future project. You can test is right now on demo website http://mojeapi.funsite.cz/

#API:
GET   - /translations - Output is JSON response with translations data.

POST - /user/registration - Register yourself by using API. Body: name='Your name',password='Your password',email='Your email'

POST  - /user/login - To login via API, send POST request with body: name='Your name' and password='Your password'. Server will save the session and log in to your services.

POST  - /user/logout - To logout via API.

GET  - /user/reservations - To see what user reservated.


POST  - /reservation/make - To make a reservation. Body: select="Select your translation by id", row="Select your row", column="Select your column"

POST  - /reservation/delete - To delete the reservation. Body: id="Id reservation"

//TODO: Admin section
