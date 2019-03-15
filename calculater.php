<?php
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Calculator</title>
	
  </head>
  <body>
  <?php
 
// basic calculator program
function showForm() {
?>
    <!-- <img src="images/cal.jpg" width="550" height="350" align="center"></img>--> 
      <p style="text-align: center; color:red;">All field are required, however, if you forget any, we will put a random number in for you.</font>  <br />
	<hr>
	<table border="0" style="margin:0 auto;">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <tr>
            <td><font face="verdana" color="green">Number:</font></td>
            <td><input type="number" maxlength="3" name="number" size="4"  /></td>
        </tr>
        
        <span id="square">
        <tr>
            <td><font face="verdana" color="green">Another number:</font></td>
            <td><input type="number" maxlength="4" name="number2" size="4" /></td>
        </tr>
        </span>
        
        <tr>
            <td valign="top"><font face="verdana" color="green">Operator:</font></td>
            <td><input type="radio" name="opt" value="+" </>+<br />
                <input type="radio" name="opt" value="-"   />-<br />
                <input type="radio" name="opt" value="*"  />*<br />
                <input type="radio" name="opt" value="/" />/<br />
                <input type="radio" name="opt" value="^2" />x<sup>2</sup><br />
                <input type="radio" name="opt" value="sqrt" />sqrt<br />
                <input type="radio" name="opt" value="^" />^<br />
            </td>
        </tr>
        <tr>
            <td><font face="verdana" color="green">Rounding:</font></td>
            <td><input type="text" name="rounding" value="4" size="4" maxlength="4" /></td>
            <td><small><font face="verdana" color="green">(Enter how many digits you would like to round to)</font></small>
            </td>
        </tr>
        
        <tr>
            <td><input type="submit" value="Calculate" name="submit" /></td>
        </tr>
        </form>
    </table>
    <?php
}

if (empty($_POST['submit'])) {
    showForm();
} else {
    $errors = array();
    $error = false;
    
    if (!is_numeric($_POST['number'])) {
        (int)$_POST['number'] = rand(1,200);
    }
    
    if (empty($_POST['number'])) {
        (int)$_POST['number'] = rand(1,200);
    }
    
    if (!is_numeric($_POST['number2'])) {
        (int)$_POST['number2'] = rand(1,200);
    }
    
    if (empty($_POST['number2'])) {
        (int)$_POST['number2'] = rand(1,200);
    }
    
    if (empty($_POST['rounding'])) {
        $round = 0;
    }
    
    if (!isset($_POST['opt'])) {
        $errors[] = "You must select an operation.";
        $error = true;
    }
    
    if (strpbrk($_POST['number'],"-") and strpbrk($_POST['number2'],"0.") and $_POST['opt'] == "^") {
        $errors[] = "You cannot raise a negative number to a decimal, this is impossible. <a href=\"http://hudzilla.org/phpwiki/index.php?title=Other_mathematical_conversion_functions\">Why?</a>";
        $error = true;
    }
    
    if ($error != false) {
        echo "We found these errors:";
        echo "<ul>";
        foreach ($errors as $e) {
            echo "<li>$e</li>";
        }
        echo "</ul>";
    } else {
        switch ($_POST['opt']) {
            case "+":
                $result = (int)strip_tags($_POST['number']) + (int)strip_tags($_POST['number2']);
                echo "The answer to " . (int)strip_tags($_POST['number']) . " $_POST[opt] " . (int)strip_tags($_POST['number2']) . " is $result.";
                break;
            case "-";
                $result = (int)strip_tags($_POST['number']) - (int)strip_tags($_POST['number2']);
                echo "The answer to " . (int)strip_tags($_POST['number']) . " $_POST[opt] " . (int)strip_tags($_POST['number2']) . " is $result.";
                break;
            case "*";
                $result = (int)strip_tags($_POST['number']) * (int)strip_tags($_POST['number2']);
                echo "The answer to " . (int)strip_tags($_POST['number']) . " $_POST[opt] " . (int)$_POST['number2'] . " is $result.";
                break;
            case "/";
                $result = (int)strip_tags($_POST['number']) / (int)strip_tags($_POST['number2']);
                $a = ceil($result);
                    echo "<br />";
                    echo "<hr />";
                    echo "<h2>Rounding</h2>";
                    echo "$result rounded up is $a";
                    echo "<br />";
                    $b = floor($result);
                    echo "$result rounded down is $b";
                    echo "<br />";
                    $h = round($result,(int)$_POST['rounding']);
                    echo "$result rounded to $_POST[rounding] digits is " . $h;
                break;
            case "^2":
                $result = (int)strip_tags($_POST['number']) * (int)strip_tags($_POST['number2']);
                $a = (int)$_POST['number2'] * (int)$_POST['number2'];
                    echo "The answer to " . (int)$_POST['number'] . "<sup>2</sup> is " . $result;
                    echo "<br />";
                    echo "The answer to " . (int)$_POST['number2'] . "<sup>2</sup> is " . $a;
                break;
            case "sqrt":
                $result = (int)strip_tags(sqrt($_POST['number']));
                $sqrt2 = (int)strip_tags(sqrt($_POST['number2']));
                echo "The square root of " . (int)strip_tags($_POST['number']) . " is " . $result;
                    echo "<br />";
                    echo "The square root of " . (int)strip_tags($_POST['number2']) . " is " . $sqrt2;
                    echo "<br />";
                    echo "The square root of " . (int)strip_tags($_POST['number']) . " rounded to " . strip_tags($_POST[rounding]) . " digits is " . round($result,(int)$_POST['rounding']);
                    echo "<br />";
                    echo "The square root of " . (int)strip_tags($_POST['number2']) . " rounded to " . strip_tags($_POST[rounding]) . " digits is " . round($sqrt2,(int)strip_tags($_POST['rounding']));
                break;
            case "^":
                $result = (int)strip_tags(pow($_POST['number'],$_POST['number2']));
                $pow2 = (int)strip_tags(pow($_POST['number2'],$_POST['number']));
                echo (int)$_POST['number'] . "<sup>" . strip_tags($_POST[number2]) . "</sup> is " . $result;
                    echo "<br />";
                    echo (int)$_POST['number2'] . "<sup>" . strip_tags($_POST[number]) . "</sup> is " . $pow2;
                    break;
        }
            
    }
}
echo "<br />";

?>
<a href="calculater.php">Go Back</a>
<hr>
  </body>
</html>