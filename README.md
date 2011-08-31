Tikapot is a pot of simple, easy-to-understand PHP libraries to reduce development time.

Current Library List:
*Timer Class
*Database Layer
*Session Layer


#Examples

##Timer
```php
require("framework/timer.php");
$timer = Timer::start();
for ($i=0; $i<=100000; $i++){}
$time = $timer->ping();
print("Time for 100,000 iterations: $time seconds");
for ($i=0; $i<=1000000; $i++){}
$time = $timer->end();
print("Time for 1,000,000 iterations: $time seconds");
```

##Session
```php
require("framework/session.php");
Session::store("Test", 2);
Session::get("Test"); // Returns 2
Session::remove("Test");
Session::put("Test", 4);
Session::get("Test"); // Returns 4
Session::store("Test", 5); // Returns 4
Session::get("Test"); // Returns 5
Session::put("Test", 2); // Returns False
Session::get("Test"); // Returns 5
```

##Database
```php
require("framework/database.php");
$db = Database::create();
$query = $db->query("SELECT * FROM example;");
$results = $db->fetch($query);
print_r($results);
```
