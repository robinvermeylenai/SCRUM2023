<?php

// DAO en Service Tests controller

spl_autoload_register();

use Entities\ActionCode;
use Entities\Address;
use Entities\Article;
use Entities\Category;
use Entities\Client;
use Entities\Company;
use Entities\Review;
use Entities\PaymentMode;
use Entities\OrderStatus;
use Entities\Order;
use Entities\OrderDetail;
use Entities\UserAccount;
use Entities\WishlistItem;

use Data\BaseDAO;
use Data\CompanyDAO;
use Data\ContactPersonDAO;
use Data\FaqItemDAO;
use Data\ReviewDAO;
use Data\PlaceDAO;
use Data\PaymentModeDAO;
use Data\OrderStatusDAO;
use Data\OrderDAO;
use Data\OrderDetailDAO;
use Data\UserAccountDAO;
use Data\WishlistItemDAO;
use Data\ClientDAO;

/* DAO TESTS START*/
$ActionCode = new CompanyDAO;
print('#ActionCode');
var_dump($ActionCode);

$ContactPersonDAO = new ContactPersonDAO;
print('#ContactPersonDAO');
var_dump($ContactPersonDAO);

$FaqItemDAO = new FaqItemDAO;
print('#FaqItemDAO');
var_dump($FaqItemDAO);

$ReviewDAO = new ReviewDAO;
print('#ReviewDAO');
var_dump($ReviewDAO);

$PlaceDAO = new PlaceDAO;
print('#PlaceDAO');
var_dump($PlaceDAO);

$PaymentModeDAO = new PaymentModeDAO;
print('#PaymentModeDAO');
var_dump($PaymentModeDAO);

$OrderStatusDAO = new OrderStatusDAO;
print('#OrderStatusDAO');
var_dump($OrderStatusDAO);

$OrderDAO = new OrderDAO;
print('#OrderDAO');
var_dump($OrderDAO);

$OrderDetailDAO = new OrderDetailDAO;
print('#OrderDetailDAO');
var_dump($OrderDetailDAO);

$UserAccountDAO = new UserAccountDAO;
print('#UserAccountDAO');
var_dump($UserAccountDAO);

$WishlistItemDAO = new WishlistItemDAO;
print('#WishlistItemDAO');
var_dump($WishlistItemDAO);

$ClientDAO = new ClientDAO;
print('#ClientDAO');
var_dump($ClientDAO);


print('#cart');
var_dump($_SESSION["cart"]);
/* DAO TESTS END*/