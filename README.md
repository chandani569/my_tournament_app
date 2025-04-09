**Implementation of a Two-Step Tournament Creation Feature**

**System requirements**

- Operating System:  Linux OR Windows OS
- PHP Version: 8.1+
- Symfony Installed
- Composer Installed

 **Setup Instructions**

1. Clone the Project Repository
- git clone https://github.com/chandani569/my_tournament_app.git
cd my_tournament_app
  
2. Configure the Database
- Ensure your .env file has the correct database credentials, then run:
  
  php bin/console doctrine:migrations:migrate
  
3. Start the Symfony Server:
   
    symfony server:start


 **Usage**
   
1. Test at API Endpoint (Backend)
   
 - Make a POST request to add Tournament:

   Endpoint:

    POST http://localhost:8000/api/tournaments

   Content-Type: application/json
   Body:
   {"name":"tournament1","type":"elimination"}
   Response:
   {
    "message": "Tournament created successfully"
   }

  - Make GET request for output:

    Endpoint:

    http://localhost:8000/api/tournaments_list

   Authorization: Bearer your-jwt-token

   Response:
   [
    {
        "id": 1,
        "name": "tournament1",
        "type": "elimination"
    }
   ]

2. Test in browser (Frontend)

   - http://localhost:8000/tournament/new
   - open this link, You will get one form in which you can add Tournament Name
   - After that click on 'Next' button
   - Now in second window, you have to choose any one Tournament Type
   - Finally click on 'Submit' button and Your Tournament will creat successfully.
