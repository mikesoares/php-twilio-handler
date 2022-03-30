# php-twilio-handler
PHP-based handler for Twilio Calls and Messaging.

## How To Use
- Clone the [Twilio PHP SDK](https://github.com/twilio/twilio-php) to your web server.
- Clone this repo into a web-accessible location. (e.g., `http://www.example.com/twilio/`)
- Fill in your auth details in `run.php`. Alternatively, grab them from environment variables.
- In `run.php`, update the path to the Twilio PHP SDK `autoload.php` file.
- In your Twilio account, set up webhooks for Voice and SMS using `HTTP POST`. Point them to your publicly-accesible `run.php` file.
![image](https://user-images.githubusercontent.com/350493/160733965-10692570-29d0-4b7a-8deb-5088926ffac2.png)
- Make a phone call or send a SMS to your Twilio number.
- ...
- Profit!
