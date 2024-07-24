<?
set_time_limit(0);

switch ($_GET['action']) {
    case "load_controller_actions":
		class controller {}
		include("../app/controllers/api.php");

		$apiController = new apiController();

		$actions = $apiController->getControllerMethods($_GET['controller']);

		include("../app/controllers/" . $_GET['controller'] . ".php");

		$class_methods = get_class_methods($controller . "Controller");

		foreach ($class_methods AS $class_method) {
			if (!in_array($class_method, $actions) and substr($class_method, 0, 8) != "onBefore" and substr($class_method, 0, 7) != "onAfter") {
				$actions[] = $class_method;
			}
		}

		sort($actions);

		echo json_encode($actions);
    break;
    case "load_request_template":
		if (file_exists("request_templates/" . $_GET['request_template'] . ".json")) {
			$template = file_get_contents("request_templates/" . $_GET['request_template'] . ".json");
		}
		else {
			$template = file_get_contents("request_templates/default.json");
		}

		echo $template;
    break;
    case "send_json_request":
		$endpoint = ((gethostname() == "dev01") ? "http://" : "https://") . $_SERVER['HTTP_HOST'] . preg_replace("|/api_test_util.*\$|", "/", $_SERVER['REQUEST_URI']) . "app/api.php?controller=" . $_POST['controller'] . "&action=" . $_POST['action'] . "&auth_token=" . $_SESSION['api_test_util']['auth_token'];

        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
        curl_setopt($ch, CURLOPT_URL, $endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST['request']);
        
        $response = curl_exec($ch);

		$struct_response = print_r(json_decode($response, true), true);

		if($_POST['raw_output'] == 0){
			$response = $struct_response;
		}

        $_SESSION['api_test_util']['controller'] = $_POST['controller'];
        $_SESSION['api_test_util']['action'] = $_POST['action'];
        $_SESSION['api_test_util']['request'] = $_POST['request'];
        $_SESSION['api_test_util']['response'] = $response;
        
		if (preg_match("|\[auth_token\] => (.*)|", $struct_response, $matches)) {
			$_SESSION['api_test_util']['auth_token'] = $matches[1];
		}
		else if (!array_key_exists("auth_token", $_SESSION['api_test_util'])) {
			$_SESSION['api_test_util']['auth_token'] = "";
		}

		echo $response;
    break;
}
?>