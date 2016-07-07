# Kino

This is test Nette application where I made API for the future project. You can test is right now on demo website http://mojeapi.funsite.cz/

#API:
GET   - /translations - Out put is JSON response with translations data.
//Here you need to autheticate
//TODO: User registration API
POST  - /user/login - To login via API, send POST request with body: name='Your name' and password='Your password'. Server will save the session and log in to your services.

POST  - /user/logout - To logout via API.

GET  - /user/reservations - To see what user reservated.


POST  - /reservation/make - To make a reservation. Body: select="Select your translation by id", row="Select your row", column="Select your column"

POST  - /reservation/delete - To delete the reservation. Body: id="Id reservation"

//TODO: Admin section
