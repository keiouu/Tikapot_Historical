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