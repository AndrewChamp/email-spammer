<?php
	/**
	 *
	 *	REMOTE EXECUTION
	 *	or	
	 *	IFRAME (runs everytime a visitor loads the page)
	 *	<iframe src="class.spammer.php" height="0' width="0"></iframe>
	 *
	 * 	NOTE:
	 *	The $spammer->chance(20) variable is a "1 in ?" setting.  If you use "1" then it will execute everytime.
	 *	The default setting is "1 in 20".  Meaning there's a 5% chance of it running on every execution.
	 */
	
	
	/**
	 *	EXAMPLE USAGE:
	 *
	 *	$spammer = new spammer('http://domain.com/contact.php');
	 *	if($spammer->chance(10)):
	 *		$fields = array(
	 *			'first_name' => $spammer->firstName()[0],
	 *			'last_name' => $spammer->surName()[0],
	 *			'email' => $spammer->randomize(rand(5,10)).'@'.$spammer->randomize(rand(5,10)).$spammer->tld[0],
	 *			'message' => urlencode('This is a spammy message!'),
	 *			'submit' => 'send'
	 *		);
	 *		$spammer->fields = $fields;
	 *		$spammer->execute();
	 *	endif;
	 */
	
	class spammer{
		
		
		public $tld = array('.com', '.edu', '.net', '.org');
		public $url;
		public $fields = array();
		
		
		public function __construct($_url){
			$this->url = $_url;			
		}
		
		
		public function randomize($length=5){
			$chars = "abcdefghijklmnopqrstuvwxyz0123456789";	
			$size = strlen($chars);
			for($i = 0; $i < $length; $i++):
				$str .= $chars[rand(0, $size-1)];
			endfor;
			return $str;
		}
		
		
		public function firstName(){
			$firstname = array('Andrea', 'Andrew', 'Angela', 'Brittany', 'Cheryl', 'Dick', 'Emily', 'George', 'Gordon', 'Heather', 'John', 'Josh', 'Mike', 'Mark', 'Matt', 'Nick', 'Nicole', 'Nikki', 'Pam', 'Richard', 'Rick', 'Sally', 'Sam', 'Sarah', 'Scott', 'Shane', 'Tom');
			shuffle($firstname);
			return $firstname;
		}
		
		
		public function surName(){
			$surname = array('Barbetti', 'Burns', 'Crane', 'Feinberg', 'Fisk', 'Griffith', 'Gowen', 'Hobbs', 'Jacobs', 'Jerkins', 'Keller', 'Lundberg', 'Mercer', 'Miller', 'Otteman', 'Sadler', 'Smith', 'Talbott');
			shuffle($surname);
			return $surname;
		}
		
		
		public function posts($fields=array()){
			foreach($fields as $key=>$value):
				$fields_string .= $key.'='.$value.'&';
			endforeach;
			return rtrim($fields_string, '&');
		}
		
		
		public function chance($odds=20){
			if(rand(1, $odds) == 1)
				return true;
			
			return false;
		}
		
		
		public function userAgents(){
			$agents = array(
				/* Chrome 41.0.2228.0 */
				'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
				/* Chrome 37.0.2062.124 */
				'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
				
				/* Firefox 40.1 */
				'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1',
				/* Firefox 36.0 */
				'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
				
				/* Edge 12.246 */
				'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
				/* IE 11.0 */
				'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko',
				/* IE 10.0 */
				'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
				/* IE 9.0 */
				'Mozilla/5.0 (Windows; U; MSIE 9.0; WIndows NT 9.0; en-US))'
			);
			shuffle($agents);
			return $agents;
		}
		
		
		public function execute(){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->url);
			curl_setopt($ch, CURLOPT_USERAGENT, $this->userAgents());
			curl_setopt($ch, CURLOPT_REFERER, $this->url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_POST, count($this->fields));
			curl_setopt($ch, CURLOPT_POSTFIELDS, $this->posts($this->fields));
			curl_setopt($ch, CURLOPT_VERBOSE, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
			$result = curl_exec($ch);
			curl_close($ch);
		}
		
	}
	
?>
