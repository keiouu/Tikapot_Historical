Tikapot is a simple PHP MVC framework

Contrib List:
1. Timer Class
2. Session Layer
3. Auth Layer


#Examples

##Timer
```php
require("contrib/timer.php");
$timer = Timer::start();
for ($i=0; $i<=100000; $i++){}
$time = $timer->ping();
print("Time for 100,000 iterations: $time seconds");
for ($i=0; $i<=1000000; $i++){}
$time = $timer->stop();
print("Time for 1,000,000 iterations: $time seconds");
```

##Session
```php
require("contrib/session.php");
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

##Model
```php
require("framework/model.php");
require("framework/modelfields.php");

class ExampleModel extends Model
{
	public function __construct() {
		parent::__construct();
		$this->add_field("first_name", new CharField());
		$this->add_field("last_name", new CharField());
		$this->add_field("age", new NumericField());
	}
}
$obj = ExampleModel()
$obj->first_name = "John";
$obj->save();
```

