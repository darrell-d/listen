JAN 16 2013
#MYSQL PARAMETERIZED QUERIES

Most applications use a database of some form. For PHP MySQL is a popular choice of database for a variety of reasons:

* It's free
* It usually comes bundled with a PHP installation (shared hosting, WAMP, LAMP etc.)
* There are a variety of tutorials for it on the web and it's easy to learn

The final point has much to do with why many people who programme in PHP get bogged down with security issues. The first 5 tutorials that I found all showed users how to perform MySQL queries using the [myql_*](http://us1.php.net/manual/en/intro.mysql.php) library.

Notice how on the documentation for this library the first thing it says is that it's deprecated as of PHP 5.5.0? It's been deprecated as of PHP 5.5.0. That was in 2013, I can remember the PHP.net and community at large recommending no longer using mysql_* functions as far back as 2009. In the tech world that might as well have been in the age of the dinosaurs.

The main reason for it being deprecated is that it is simply not a secure way to write MySQL statements. It treats a MySQL statement as a string rather than an immutable object.

With mysql_* functions you create a statement as a string and pass that string to your database to be executed. The problem begins when you want to pass user generated information such as a username into your database. Users can directly insert new MySQL commands from your webpage into your database. This is called an SQL Injection attacks. It's one of the most basic attacks against any website that uses a database.

Here is a typical MySQL command:

`$query = "SELECT * FROM mySuperImportantTable WHERE user =  '" + $userInput +''";`

Assume `$userInput` will come from any user visiting the site and is entered through a user name textfield.

In the example above this line is ripe for SQL injection.  If `$query` were to be run with a the command `mysql_query($query)` a user could pass in 'dirty' input. For example a user could enter as input
>a'; drop mySuperImportantTable WHERE 1=1

Noticed the '**a';**' at the start of the query. It makes the above query:

`$query = "SELECT * FROM mySuperImportantTable WHERE user =  'a'; DROP mySuperImportantTable WHERE 1=1 '";`

See where the trouble begins? No? Here is the query by itself:

`SELECT * FROM mySuperImportantTable WHERE user =  'a'; `

`DROP mySuperImportantTable WHERE 1=1 '";`

See how what was mean to be a simple select query has now turned into a select query and a drop query? That is an injection attack. The above example is mostly harmless if you had backups, but your attacker can now run any MySQL command on your server. They can dump your full table structure, give themselves full administrative privileges, delete your account, get other users email address, password and anything else they see fit to do.

Many new to PHP will attempt to go through great hoops of fire to prevent this with clever functions to look out for 'dirty' user input to stop injection attacks. This inevitably always fails. When I first started I used to write functions to scrub the strings for any MySQL keywords and escape harmful characters.

This is a losers game. There are more vectors to exploit this than you can reasonable fix while maintaining the rest of your life.

The solution is to use parametrized queries. With a parametrized query the resulting query that comes from your user input isn't treated as a MySQL command, rather it's treated as dumb text that is simply to be inserted into your database. So going back to the example from earlier your query simply looks for a user named `'a'; `
`DROP mySuperImportantTable WHERE 1=1 '` instead of executing an extra statement.

###Writing better MySQL statements
So how do we write parametrized queries?

The first step is to choose a either the [mysqli](http://us1.php.net/manual/en/book.mysqli.php) or [PDO_MySQL](http://us1.php.net/manual/en/ref.pdo-mysql.php) library. I'll show how to use mysqli since it's similar to the mysql library.

####The dangerous way
Your typical mysql connection looks like this:
<blockquote class = "code">
$link = mysql_connect('localhost', 'mysql_user', 'mysql_password'); //Database connection

mysql_select_db('foo', $link); //Select database

$query = "SELECT * FROM mySuperImportantTable WHERE user =  '" + $userInput +''"; //query setup

$result = mysql_query($query); //query execution

while($row = mysql_fecth_assoc($result)
{
     //Do stuff with $row variable
}
</blockquote>

That is the general form that most tutorial sites teach how to use MySQL with PHP. Look at it well and repeat to yourself :"I will never write MySQL code like that every again."

####A safer way
Here is a good template for parametrized MySQL statements:

<blockquote class = "code">
$mysqliConnection = new mysqli("localhost","user","password","database");// Connect to database and choose database

$query = "SELECT * FROM mySuperImportantTable WHERE user = ?"; // Query saved into a string. Note the '?'

$stmt = $mysqli->prepare($query); //Query prepared for execution

$stmt->bind_param('s',$userInput); // Bind user data to the query.

$stmt->execute(); // Execure the query

$result = $stmt->get_result(); //Only needed if we are expecting to get data back from the db

while($row = $result->fetch_assoc())
{
	//Do stuff with $row variable
}
</blockquote>

Above we in the `$query` string instead of inserting the `$userInput` variable, we substitute it with a '?'. **Note**: the '?' is not surrounded by single quotes in the string. This is because if we surrounded it with single quotes we would simply be doing a search for a '?'.

The '?' is a special symbol which the `bind_param()` function replaces with the contents of `$userInput`.

If we had more than one variable user input to add to our query we would edit the `bind_param` method to accept them:
$stmt->bind_param('ssi',$userInput,$otherTextInput,$integer)

Note the first parameter of `bind_param()` dictates how many variables we are passing in. For each  variable passed we denote it by an 's' or an 'i'. 's' for String data types and 'i' for integers. There also exist the options 'd' and 'b' for the types Double and Blob respectively.

That's it! You're now safe from basic injection attacks. This is not to say that you can now relax. There are always nefarious people out there looking for new ways to break into your database, but at least with this approach you won't be a sitting duck with a target on its back.
