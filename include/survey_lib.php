<?
// table as constant, used by queried in various functions
define(TABLE, "fav_things");

class survey {
	
	// survey select option values
	public $ponies = array(
		0 => 'Select',
		1 => 'Alicorn',
		2 => 'Earth Pony',
		3 => 'Pegasus',
		4 => 'Unicorn',
		5 => 'Sea Pony',
		6 => 'Zebra'
	);
	public $princesses = array(
		0 => 'Select',
		1 => 'Luna',
		2 => 'Celestia',
		3 => 'Cadance',
		4 => 'Twilight'
	);
	
	public $pet = array(
		0 => 'Select',
		1 => 'Opal',
		2 => 'Owloysius',
		3 => 'Angel',
		4 => 'Tank',
		5 => 'Gummy',
		6 => 'Winona'
	);
	
	
	private $debug = true; // turn off messages

	public function open_db(){
		
		///////////////////////////////////////////////////////
		// mysql vars as constants
		// You may need to change these to match your database
		///////////////////////////////////////////////////////
	
		define(SERVERNAME, "localhost");
		define(USERNAME, "maxperez");
		define(PASSWORD, "hireme");
		define(DBNAME, "wmf_survey");
	
		// Create connection
		$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error); // this may not be nesc
		} else {
			return $conn;
		}
	}
	
	
	public function insert_survey_answers(){
	
		// open db connection
		$conn = $this->open_db();
	
		$inserted = false;
		  
		$stmt = $conn->prepare("INSERT INTO " . TABLE . " (pony, princess, pet, wanted_character, fanfic) VALUES (?,?,?,?,?) ");
		$stmt->bind_param("iiiss", $_POST['pony'], $_POST['princess'], $_POST['pet'], $_POST['wanted_character'], $_POST['fanfic']);
		
		if (($query = $stmt->execute()) === TRUE) {
			if ($debug){ echo "New record created successfully";  }
			$inserted = true;
		} else {
			if ($debug){ echo "Error: " . $sql . "<br>" . $conn->error; }
		}
		
		$conn->close();
		
		return $inserted;
	}
	
	public function get_mode_and_count($param) {
	
		// Open database connection
		$conn  = $this->open_db();
	
		// only top three results for text fields, all results for select options.
		if ($param === 'wanted_character' || $param === 'fanfic' ) {
			// this gets top three count of each kind
			$sql = "SELECT $param, COUNT( * )
			FROM " . TABLE . " 
			WHERE $param <> ''  
			GROUP BY $param
			ORDER BY COUNT( * ) DESC
			LIMIT 3";
		} else {
			// this gets all the counts of each kind
			$sql = "SELECT $param, COUNT( * )
			FROM " . TABLE . " 
			WHERE $param > 0
			GROUP BY $param
			ORDER BY COUNT( * ) DESC";
		} 
	
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
	
			// put the rows into an array to be returned
			while($row = $result->fetch_assoc()) {
				$arr[] = $row;
			}
	
			if ($debug){
				echo '<pre>';
				var_dump($arr);
				echo '</pre>';
	
				echo '**************************';
				foreach ($arr as $key=>$value) {
					echo "<br>" . $value[$param] . ": " . $value['COUNT( * )'];
				}
			}
	
			// this returns the assoc array with the selections, in order of popularity, and their count
			return $arr;
			if(!$arr) exit('No rows'); // not nesc?
	
		} else {
			if ($debug) return "<br>0 results";
		}
	
		$conn->close();
	}
}

