# PayU PHP API

## Requirements

PHP >= 5.5

## Order creation example

```php
use Payu\Payu;
use Payu\Order\Order;
use Payu\Entity\Product;

$payu = new Payu('301205', 'dc1798776bb518a354e7892a09366ec4', true);

$order = new Order();
$order->setNotifyUrl('http://localhost:8000/notify');
$order->setContinueUrl('http://localhost:8000/continue');
$order->setDescription('my product');
$order->setCurrencyCode('pln');
$order->setTotalAmount(18.99);

$product = new Product();
$product->setName('my item');
$product->setQuantity(1);
$product->setUnitPrice(18.99);

$order->addProduct($product);

$request = $payu->sendRequest($order);
$response = $request->getResponse();

$response->doRedirect();
```
