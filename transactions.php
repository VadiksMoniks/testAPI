<?php
var_dump($_POST);
    $userId = $_POST['transact'];
    $userId+=1;
function showTransactions($userId){
    echo $userId;
    $chTransaction = curl_init();
    curl_setopt($chTransaction, CURLOPT_URL, 'https://user-transaction-fetch-api.herokuapp.com/transaction/user/'.$userId);
    curl_setopt($chTransaction, CURLOPT_RETURNTRANSFER, 1);
    $resultTransaction = curl_exec($chTransaction);
    $infoTransaction = json_decode($resultTransaction, true);
    curl_close($chTransaction);
    if(count($infoTransaction)==0){
        echo "This user have 0 transactions";
    }

    else{

        for($i=0; $i<count($infoTransaction); $i++){
            echo "<table>";
            echo "<tr><td>Transaction info</td></tr>";
            echo "<tr><td>identifier: ".$infoTransaction[$i]['identifier']."</td></tr>";
            echo "<tr><td>timestamp: ".$infoTransaction[$i]['timestamp']."</td></tr>";
            echo "<tr><td>price: ".$infoTransaction[$i]['line']['price']."</td></tr>";
            echo "<tr><td>product name: ".$infoTransaction[$i]['line']['product_name']."</td></tr>";
            echo "<tr><td>quantity: ".$infoTransaction[$i]['line']['quantity']."</td></tr>";
            echo "</table>";
            echo "</br>";
        }
    }
}

echo showTransactions($userId);

?>