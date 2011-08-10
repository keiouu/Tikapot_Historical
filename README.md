Tikapot is a pot of simple, easy-to-understand PHP libraries to reduce development time.


#Examples

##Timer
```php
require("lib/timer.php");
$uid = Timer::start();
for ($i=0; $i<=100000; $i++){}
$time = Timer::end($uid);
print("Time for 100,000 iterations: $time seconds");
```

##Session
```php
require("lib/session.php");
$session = new Session();
print("Your ID: " . $session->id);
```

##Database
```php
require("lib/database.php");
$db = Database::create();
$query = $db->query("SELECT * FROM example;");
$results = $db->fetch($query);
print_r($results);
```
