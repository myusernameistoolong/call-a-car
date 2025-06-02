<?php
//Result amount
if(Cookie::get('result_amount'))
{
    $_GET['result_amount'] = Cookie::get('result_amount');
}

//10 is always the first option
$result_amounts = array(10, 25, 50, 100, 150, 200, 250, 500, 750, 1000);

if(isset($_GET['result_amount']) && $_GET['result_amount'])
{
    $result_amount = $_GET['result_amount'];
}
else
{
    $result_amount = 10;
}

//Init
switch($cookie_objects)
{
    case "employees":
        $default_sort_by = "brand";
        break;
    case "cars":
        $default_sort_by = "brand";
        break;
    case "clients":
        $default_sort_by = "brand";
        break;
    case "invoices":
        $default_sort_by = "created_at";
        break;
    default:
        $default_sort_by = "brand";
}

//Filter system
if(isset($_GET['sort_by']) && $_GET['sort_by'])
{
    $sort_by = $_GET['sort_by'];
    Cookie::queue("sort_by_" . $cookie_objects, $sort_by, 10080);
}
elseif(Cookie::get('sort_by_' . $cookie_objects))
{
    $sort_by = Cookie::get('sort_by_' . $cookie_objects);
}
else
{
    $sort_by = $default_sort_by;
}

if(isset($_GET['sort_order']) && $_GET['sort_order'])
{
    $sort_order = $_GET['sort_order'];
    Cookie::queue("sort_order_" . $cookie_objects, $sort_order, 10080);
}
elseif(Cookie::get('sort_order_' . $cookie_objects))
{
    $sort_order = Cookie::get('sort_order_' . $cookie_objects);
}
else
{
    $sort_order = "ASC";
}

$sorting[] = array('sort_by' => $sort_by, 'sort_order' => $sort_order);
