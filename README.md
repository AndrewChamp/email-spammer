# Email Spammer

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
