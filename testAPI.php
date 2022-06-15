<?php
/*<table>
    <tr>
    <td><table border="1">
        <tr>
            <td>Username</td>
            <td>Number of transactions</td>
            <td>Transactions</td>
  
    <?php

    for($i=0; $i<$size; $i++){
                echo "<tr>";
                $chTransaction = curl_init();
                curl_setopt($chTransaction, CURLOPT_URL, 'https://user-transaction-fetch-api.herokuapp.com/transaction/user/'.$i+1);
                curl_setopt($chTransaction, CURLOPT_RETURNTRANSFER, 1);
                $resultTransaction = curl_exec($chTransaction);
                $infoTransaction = json_decode($resultTransaction, true);
                curl_close($chTransaction);
                echo "<td>".$infoUser[$i]['name']."</td>";
                echo "<td>".count($infoTransaction)."</td>";
                echo "<td><button value='".$i."' name='transact' class='btn'>show transactions</button></td>";
               // echo "<td>""</td>";
                echo "</tr>";
    }
    
    //showTransactions(2);
        
    ?>*/
    $chUser = curl_init();
    curl_setopt($chUser, CURLOPT_URL, "https://user-transaction-fetch-api.herokuapp.com/user");
    curl_setopt($chUser, CURLOPT_RETURNTRANSFER, 1);
    $resultUser = curl_exec($chUser);
    $infoUser = json_decode($resultUser, true);
    curl_close($chUser);
    var_dump($infoUser);
    $size = count($infoUser);

?>

<!DOCTYPE HTML PUBLIC>
<!DOCTYPE html>
<html>
<head>
<tittle></tittle>
<div>
    <a href="#popup">Modal</a>
</div>
<meta charset="utf-8">
<link href="myStyles.css" rel="stylesheet" type="text/css">
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

</head>
<body>

<p>Most active users</p>
<form action="testAPI.php" method="POST">
        <table border ='1'>
            <tr>
            <td>Username</td>
            <td>UserEmail</td>
            <td>Transaction info</td>
            
            <?php
                $value;
                for($i=0; $i<$size; $i++){
                     if($infoUser[$i]['status']=='active'){ 
                         $value = $i; 
                            echo "<tr>";
                           // $chTransaction = curl_init();
                          //  curl_setopt($chTransaction, CURLOPT_URL, 'https://user-transaction-fetch-api.herokuapp.com/transaction/user/'.$i+1);
                          //  curl_setopt($chTransaction, CURLOPT_RETURNTRANSFER, 1);
                          //  $resultTransaction = curl_exec($chTransaction);
                          //  $infoTransaction = json_decode($resultTransaction, true);
                           // curl_close($chTransaction);
                            echo "<td>".$infoUser[$i]['name']."</td>";
                            //echo "<td>".count($infoTransaction)."</td>";
                            echo "<td>".$infoUser[$i]['email']."</td>";
                            echo "<td><button type='button' value='".$value."' class='btn popup-link'>Show transactions</button>";
                            echo "</tr>";  
                        }
                       
                    }
?>
            </tr>
        </table>
</form>
<script>
    $(document).ready(function(){
       // var id;
        $(document).on('click','.btn', function(){
            transact = $(this).val();
            //console.log(
            console.log(transact);
            if(transact!=null){
                $.ajax({
                type: "POST",
                url: 'transactions.php',
                data: {transact: transact},
                success:function(data){
                                $('.popup_text').fadeIn();
                                $('.popup_text').html(data);
                            }
                })
                .done(function(msg) {
                //  alert( "Data Saved: " + msg);
                });
            }
        })
    });
</script>
<div id="popup" class="popup">
    <div class="popup_body">
        <div class="popup_content">
            <button class="popup_close">close</button>
            <div class="popup_title"></div>
            <div class='popup_text'>
                <?php
                /*  $chTransaction = curl_init();
                    curl_setopt($chTransaction, CURLOPT_URL, 'https://user-transaction-fetch-api.herokuapp.com/transaction/user/1');
                    curl_setopt($chTransaction, CURLOPT_RETURNTRANSFER, 1);
                    $resultTransaction = curl_exec($chTransaction);
                    $infoTransaction = json_decode($resultTransaction, true);
                    curl_close($chTransaction);
                    var_dump($infoTransaction);*/

                ?>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
        $('.popup-link').click(function(){
         $('.popup').css('visibility' ,'visible');
         $('.popup').css('opacity','1');
      })
    });

    $(document).ready(function(){
        //$('.red').css('background','url([url]http://mirgif.com/6/45.gif)');
        $('.popup_close').click(function(){
         $('.popup').css('visibility' ,'hidden');
         $('.popup').css('opacity','0');
      })
    }); 
</script>
  
</body>
</html>