<?php



function check_active_user($sessionAdminID,$activeID,$type,$sessionBrowserString,$activeuBrowser) {

$data = array(
      "user" => array(
      	"session" => $sessionBrowserString,
        "active" => $activeID 
      ),
      "type" => array(
      	"customer" => "C",
      	"admin" => "A",
      	"active" => $type
      	),
      "browser" => array(
          "session" => $sessionBrowserString,
          "active" => $activeuBrowser
      	)
      );


return $data;
}


$data = check_active_user("man1","man2","man3","man4","man5");

// Return data back in JSON format 
$value = json_encode($data);

echo $value.$data[0].$user[0];


?>