<?
$controllers = array();

$dp = opendir("../app/controllers/");

while($dirEnt = readdir($dp)){
	if($dirEnt != "." && $dirEnt != ".." && $dirEnt != "mycomd.php" && $dirEnt != "api.php"){
		$controllers[] = preg_replace("|\.php$|", "", $dirEnt);
	}
}

closedir($dp);

sort($controllers);

if (array_key_exists("api_test_util", $_SESSION)) {
    $controller = $_SESSION['api_test_util']['controller'];
    $action = $_SESSION['api_test_util']['action'];
	$raw_output = $_SESSION['api_test_util']['raw_output'];
    $request = $_SESSION['api_test_util']['request'];
    $response = $_SESSION['api_test_util']['response'];
	$auth_token = $_SESSION['api_test_util']['auth_token'];
}
else {
    $controller = "member";
    $action = "authenticate";
	$raw_output = 0;
    $request = file_get_contents("request_templates/member_authenticate.json");
    $response = "";
	$auth_token = "";
}

class controller {}
include("../app/controllers/api.php");

$apiController = new apiController();

$actions = $apiController->getControllerMethods($controller);

include("../app/controllers/" . $controller . ".php");

$class_methods = get_class_methods($controller . "Controller");

foreach ($class_methods AS $class_method) {
	if (!in_array($class_method, $actions) and substr($class_method, 0, 8) != "onBefore" and substr($class_method, 0, 7) != "onAfter") {
		$actions[] = $class_method;
	}
}

sort($actions);
?>
<html>
<head>
    <title>API Test Util</title>
</head>
<body style="font-family:Arial">
<script language="javascript">
function getHTTPObj()
{
    try {
        obj = new XMLHttpRequest();
    }	
    catch (err1) {
        try {
            obj = new ActiveXObject("Msxml2.XMLHTTP");
        } 
        catch (err2) {
            try {
                obj = new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch (err3) {
                obj = false;
            }
        }
    }
    
    return obj;
}

function loadControllerActions(s)
{
    var controller = s.options[s.selectedIndex].value;
    
    HTTPObj.onreadystatechange = loadControllerActionsStateChange;
    HTTPObj.open('GET', 'ajax.php?action=load_controller_actions&controller=' + controller, true);
    HTTPObj.send(null);
    
    return;
}

function loadControllerActionsStateChange()
{
    if (HTTPObj.readyState == 4 && HTTPObj.status == 200) {
		var actions = JSON.parse(HTTPObj.responseText);

		document.api_test_util.action.options.length = 1;

		for (var i in actions) {
			document.api_test_util.action.options[document.api_test_util.action.options.length] = new Option(actions[i], actions[i]);
		}
    }
    
    return;
}

function loadRequestTemplate(s)
{
    var requestTemplate = document.api_test_util.controller.options[document.api_test_util.controller.options.selectedIndex].value + '_' + s.options[s.selectedIndex].value;
    
    if (requestTemplate.length > 0) {
        HTTPObj.onreadystatechange = loadRequestTemplateStateChange;
        HTTPObj.open('GET', 'ajax.php?action=load_request_template&request_template=' + requestTemplate, true);
        HTTPObj.send(null);
    }
    
    return;
}

function loadRequestTemplateStateChange()
{
    if (HTTPObj.readyState == 4 && HTTPObj.status == 200) {
		if (HTTPObj.responseText != 'N/A') {
			document.api_test_util.request.value = HTTPObj.responseText;
		}
		else{
			document.api_test_util.request.value = '';
		}
    }
    
    return;
}

function sendJSONRequest()
{
    var controller = document.api_test_util.controller.options[document.api_test_util.controller.selectedIndex].value;
    var action = document.api_test_util.action.options[document.api_test_util.action.selectedIndex].value;
	var rawOutput = (document.getElementById('rawOutputCheckbox').checked) ? 1 : 0;
    var request = document.api_test_util.request.value;
    var postData = 'controller=' + escape(controller) + '&action=' + escape(action) + '&raw_output=' + rawOutput + '&request=' + escape(request);
    var requestMessage = document.getElementById('requestMessage');
    
    HTTPObj.onreadystatechange = sendJSONRequestStateChange;
    HTTPObj.open('POST', 'ajax.php?action=send_json_request', true);
    HTTPObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    HTTPObj.setRequestHeader("Content-length", postData.length);
    HTTPObj.setRequestHeader("Connection", "close");    
    HTTPObj.send(postData);
    
    requestMessage.innerHTML = 'Request sent...';
    requestMessage.style.visibility = 'visible';
    
    return;
}

function sendJSONRequestStateChange()
{
    if (HTTPObj.readyState == 4 && HTTPObj.status == 200) {
		var authToken = HTTPObj.responseText.match(/\[auth_token\] => (.*)/);

		if (authToken != null) {
			document.getElementById('authToken').value = authToken[1];
		}

        document.api_test_util.response.value = HTTPObj.responseText;
        
        document.getElementById('requestMessage').innerHTML = 'Response received';
        
        setTimeout('document.getElementById(\'requestMessage\').style.visibility = \'hidden\'', 2000);        
    }
    
    return;
}

function copyToClipboard()
{
    var response = document.test_util.response.value;
    var flashId = 'flashId-HKxmj5';
    var clipboardSWF = 'clipboard.swf';
    
    if (!document.getElementById(flashId)) {
        var div = document.createElement('div');
        div.id = flashId;
        document.body.appendChild(div);
    }
    
    document.getElementById(flashId).innerHTML = '';
    var content = '<embed src="' + clipboardSWF + '" FlashVars="clipboard=' + encodeURIComponent(response) + '" width="0" height="0" type="application/x-shockwave-flash"></embed>';
    alert(content);
    document.getElementById(flashId).innerHTML = content;
    
    return;
}

var HTTPObj = getHTTPObj();
</script>
<form name="api_test_util">
Controller: <select name="controller" onChange="loadControllerActions(this);">
<?
foreach ($controllers AS $app_controller) {
?>
    <option value="<?=$app_controller?>"<?=(($app_controller == $controller) ? " SELECTED" : "")?>><?=$app_controller?></option>
<?
}
?>
</select>&nbsp;&nbsp;&nbsp;Action: <select name="action" onChange="loadRequestTemplate(this);">
	<option value="">[Select an Action]</option>
<?
foreach ($actions AS $controller_action) {
?>
    <option value="<?=$controller_action?>"<?=(($controller_action == $action) ? " SELECTED" : "")?>><?=$controller_action?></option>
<?
}
?>
</select>&nbsp;&nbsp;&nbsp;Auth Token: <input id="authToken" size="32" type="text" value="<?=$auth_token?>">&nbsp;&nbsp;&nbsp;Raw Output: <input id="rawOutputCheckbox" type="checkbox" name="raw_output" value="1"<?=(($raw_output == 1) ? " CHECKED" : "")?>><input type="hidden" name="raw_output" value="0"><br>
<br>
<table cellspacing="0" cellpadding="0" width="100%" height="70%">
    <tr>
        <td valign="top" width="50%" height="100%">
            Request:<br>
            <textarea name="request" wrap="off" style="width:100%;height:100%;font-family:arial;font-size:12px" spellcheck="false"><?=htmlspecialchars($request)?></textarea><br>
            <br>
            <input type="button" value="Send Request" onClick="sendJSONRequest();">&nbsp;&nbsp;&nbsp;<span id="requestMessage" style="visibility:hidden"></span>
        </td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td valign="top" width="50%" height="100%">
            Response:<br>
            <textarea name="response" wrap="off" style="width:100%;height:100%;font-family:arial;font-size:12px" spellcheck="false" READONLY><?=htmlspecialchars($response)?></textarea><br>
            <br>
            <input id="copyToClipboard" type="button" value="Copy to Clipboard">&nbsp;&nbsp;&nbsp;<span id="clipboardMessage" style="visibility:hidden">Response copied to clipboard</span>            
        </td>
    </tr>
</table>
</form>
<script type="text/javascript" src="ZeroClipboard.js"></script>
<script language="javascript">
function copyToClipboardHandler()
{
    var response = document.test_util.response.value
    
    clipObj.setText(response);
    
    document.getElementById('clipboardMessage').style.visibility = 'visible';
    
    setTimeout('document.getElementById(\'clipboardMessage\').style.visibility = \'hidden\'', 2000);
    
    return;
}

var clipObj = new ZeroClipboard.Client();
clipObj.setHandCursor(false);
clipObj.glue('copyToClipboard');
clipObj.addEventListener('onMouseUp', copyToClipboardHandler);
</script>
</body>
</html>