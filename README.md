# Realtime-chat-application
Realtime chat application build with Pusher

My first project build with Pusher.
See [live example](https://chat.aaronvandenberg.nl/ "Live example").

### How to install
1. Clone the repository
```bash
git clone https://github.com/aaron5670/Realtime-chat-application.git
```

2. Create a account on [Pusher](http://pusher.com/ "Pusher").
3. Create a file named: **config.php**
4. Insert the follow code into **config.php**:
```php
<?php

return array(
	'auth_key' => 'PUSHER_AUTH_KEY',
	'secret'   => 'PUSHER_SECRET_KEY',
	'app_id'   => 'PUSHER_APP_ID',
	'site_url' => 'http://localhost/chat/',
);
```
