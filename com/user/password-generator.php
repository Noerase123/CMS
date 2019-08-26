<?php
$length		=    $_REQUEST['length'];
$password	= "";
if(isset($_REQUEST['all'])){
    $conso=array("b","B","*","1","c","@","C","2","d","!","D","f","^","3","F","g","#","4","G","h","&","5","H","%","j","6","(","J","k","K",")","l","7","-","L","m","M","8","_","n","N","+","9","O","=","p","r","|","0","R","s","<","S","t",">","T","v",",","V","w","?","W","x",",","X","/","y","[","Y","]","z",":","Z",";");
    $vocal=array("a","1","!","4","A","%","2","e","$","5","E","*","3","i","^","7","I","&","9","o",")","6","(","O","8","u",":","0","U");
}

if(isset($_REQUEST['nonumberandsymbol'])){
    $conso=array("b","B","c","C","d","D","f","F","g","G","h","H","j","J","k","K","L","m","M","n","N","O","p","r","R","s","S","t","T","v",",","V","w","W","x","X","y","Y","z","Z");
    $vocal=array("a","A","e","E","i","I","o","O","u","U");
}


if(isset($_REQUEST['all_tw'])){
	$conso=array("B","@","1","~","G","5","J","*","8","4","N","0","R","!","T","9","W","%","Y","3");
    $vocal=array("1","~","I","}","2");
}

if(isset($_REQUEST['symbolsonly'])){
   	$conso=array("*","@","!","^","#","&","%","(",")","-","_","+","=","|","<",">",",","?",",","/","[","]",":",";");
    $vocal=array("!","%","$","*","^","&",")","(",":");
}


if(isset($_REQUEST['nouppercaseandlowercase'])){
   	$conso=array("*","1","@","2","!","3","^","4","#","5","&","%","6","(","7",")","l","8","-","_","+","=","|","9","<",">",",","0","?",",","/","[","]",":",";");
    $vocal=array("!","1","%","2","$","3","4","*","5","^","6","&","7",")","8","(","9",":", "0",);
}


if(isset($_REQUEST['onlynumber'])){
   	$conso=array("1","2","3","4","5","6","7","8","9","0",);
    $vocal=array("0","9","8","5","3","1");
}

if(isset($_REQUEST['nosymbol'])){
	$conso=array("b","B","1","c","C","2","d","D","f","3","F","g","4","G","h","5","H","j","6","J","k","K","l","7","L","m","M","8","n","N","9","O","p","r","0","R","s","S","t","T","v","V","w","W","x","X","y","Y","z","Z",);
    $vocal=array("a","1","4","A","2","e","5","E","3","i","7","I","9","o","6","O","8","u","0","U");
}

if(isset($_REQUEST['nonumber'])){
	$conso=array("b","B","*","c","@","C","d","!","D","f","^","F","g","#","G","h","&","H","%","j","(","J","k","K",")","-","L","m","M","_","n","N","+","O","=","p","r","|","R","s","<","S","t",">","T","v",",","V","w","?","W","x",",","X","/","y","[","Y","]","z",":","Z",";");
    $vocal=array("a","!","A","%","e","$","E","*","i","^","I","&","o",")","(","O","u",":","U");
}

if(isset($_REQUEST['all_t'])){
    $conso=array("b","*","1","c","@","2","d","!","f","^","3","g","#","4","h","&","5","%","j","6","(","J","k",")","l","7","-","m","8","_","n","+","9","O","=","p","r","|","s","<","t",">","v",",","w","?","x",",","/","[","]","z",":",";");
    $vocal=array("a","1","!","4","%","2","e","$","5","*","3","i","^","7","&","9","o",")","6","(","8","u",":","0");
}

if(isset($_REQUEST['onlylowercase'])){
    $conso=array("b","c","d","f","g","h","j","k","l","m","n","p","r","s","t","v","w","x","y","z");
    $vocal=array("a","e","i","o","u");
}


if(isset($_REQUEST['onlylowercaseSymbol'])){
	$conso=array("b","~","d","&","g","*","j","$","l","|","n","[","r","{","t","_","w","-","y","@");
    $vocal=array("a","e","i","o","u");
}

if(isset($_REQUEST['lowercaseandnumberonly'])){
    $conso=array("b","2","d","4","g","6","j","8","l","m","n","p","r","8","t","v","w","7","y","0");
    $vocal=array("a","1","i","5","u");
}

if(isset($_REQUEST['uppercaseonly'])){
    $conso=array("B","C","D","F","G","H","J","K","L","M","N","P","R","S","T","V","W","X","Y","Z");
    $vocal=array("A","E","I","O","U");
}

if(isset($_REQUEST['uppercasesymbolsonly'])){
    $conso=array("B","@","D","~","G",":","J","*","L","?","N","<","R","!","T","$","W","%","Y","*");
    $vocal=array("A","~","I","}","U");
}

if(isset($_REQUEST['num_up'])){
    $conso=array("B","1","D","3","G","5","J","0","L","8","N","7","R","0","T","9","W","2","Y","4");
    $vocal=array("A","3","I","5","U");
}
 
srand ((double)microtime()*1000000);
$max = 100;
for($i=1; $i<=$max; $i++){
	$password.=$conso[rand(0,19)];
	$password.=$vocal[rand(0,4)];
}
$newpass = $password;
echo substr($newpass, 0, $length);

?>