<?php  

$siblingDiscountAmount=0;
$campaignDiscount = 0;
$couponDiscount = 0;
$orderType=$data->data->orderType;

if($_REQUEST['orderid'] && $orderType=='sessionPurchase'){
     echo  fieldday()->engine->getView('checkout/session-purchase-thankyou', ['data' => $data]);
}elseif($_REQUEST['orderid'] && $orderType=='eventBooking'){
    echo fieldday()->engine->getView('checkout/event-ticket-purchase-thankyou', ['data' => $data]);
}elseif($_REQUEST['orderid'] && $orderType=='multiWeekPurchase'){
    echo  fieldday()->engine->getView('checkout/multiweek-session-thankyou', ['data' => $data]);
}else{
    echo '<h3 style="text-align:center">Invalid Order Id</h3>';
}

