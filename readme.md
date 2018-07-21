<h1>Time Tracker</h1>

The timetracker application is based on SPA (Single Page Application) concept.
I am using Laravel 5.6 for the Back-end and VueJS 2 for the Front-end.

The plugins used:
<ul>
	<li>vue-router (https://router.vuejs.org/en/): For SPA client side routing</li>
	<li>vee-validate (https://baianat.github.io/vee-validate/): For front-end forms validation</li>
	<li>sweetalert (https://sweetalert.js.org): For alerts</li>
	<li>axios (https://github.com/axios/axios): For promises and API interaction</li>
	<li>bootstrap4.1 (https://getbootstrap.com/): For UI styling</li>
	<li>fontawesome (https://fontawesome.com): For icons</li>
</ul>

I mainly depend on npm in installing them. Also, on Laravel-mix which uses webpack for JS and SASS bundling.

To run the app:
1. Upload all the files on a machine that has WAMP/XAMP/MAMP/LAMP with PHP7.1. Put it in the web directory (In my case, I used WAMP and it was C:\wamp64\www). The Public folder should be triggered by the browser(client) to load the application.
2. You need to create mysql database.
3. Import the timetrackerdb.sql file to your database, to create the required tables. It will be filled with dummy data.
4. In the .env file, change the APP_URL to match your root url (e.g. APP_URL=http://localhost/timetracker/public).
5. In the .env file. Change the parameters below to match your database.
<ul>
	<li>DB_CONNECTION=mysql</li>
	<li>DB_HOST=127.0.0.1</li>
	<li>DB_PORT=3306</li>
	<li>DB_DATABASE=timetrackerdb</li>
	<li>DB_USERNAME=root</li>
	<li>DB_PASSWORD=root</li>
</ul>

Here, I have uploaded a <a target="_blank" href="http://timetracker.idsarchitects.org">LIVE DEMO</a>.

Time Elapsed to finish the application till this point: 12 hours over 3 days

Recommended future work:
	-Avail scalability. Separate totally the front-end and the back-end.
	-Allow server-side rendering for better user experience. I recommend using NUXT.JS.
	-Enable user profiles (register/login), authentication, secure API's. OAuth2 can be used here.
	-The time should be shown per time zone
	-Support different languages
	-Search by each word in the search box. Now, the whole phrase is used
