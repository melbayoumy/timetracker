# Time Tracker

The timetracker application is based on SPA (Single Page Application) concept.
I am using Laravel 5.6 for the Back-end and VueJS 2 for the Front-end.

The plugins used:

- vue-router (https://router.vuejs.org/en/): For SPA client side routing
- vee-validate (https://baianat.github.io/vee-validate/): For front-end forms validation
- sweetalert (https://sweetalert.js.org): For alerts
- axios (https://github.com/axios/axios): For promises and API interaction
- bootstrap4.1 (https://getbootstrap.com/): For UI styling
- fontawesome (https://fontawesome.com): For icons


I mainly depend on npm in installing them. Also, on Laravel-mix which uses webpack for JS and SASS bundling.

To run the app:

1. Upload all the files on a machine that has WAMP/XAMP/MAMP/LAMP with PHP7.1. Put it in the web directory (In my case, I used WAMP and it was C:\wamp64\www). The Public folder should be triggered by the browser(client) to load the application.
2. You need to create mysql database.
3. Import the timetrackerdb.sql file to your database, to create the required tables. It will be filled with dummy data.
4. In the .env file, change the APP_URL to match your root url (e.g. APP_URL=http://localhost/timetracker/public).
5. In the .env file, change the parameters below to match your database.

	- DB_CONNECTION=mysql
	- DB_HOST=127.0.0.1
	- DB_PORT=3306
	- DB_DATABASE=timetrackerdb
	- DB_USERNAME=root
	- DB_PASSWORD=root

Here, I have uploaded a [LIVE DEMO][1].

[1]: http://timetracker.idsarchitects.org
