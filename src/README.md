### 找家纺支付系统PHP SDK
#### 1. 初始化系统配置
```php
$config = include __DIR__.'/config/config-local.php';
zjf\pay\Pay::init($config);
```
#### 接口说明
##### 用户相关接口
1. 创建用户
    ```php
    $user = new \zjf\pay\apis\user\User();
    $user->create($data);
    ```
2. 查询用户详情
    ```php
    $user = new \zjf\pay\apis\user\User();
    $user->query($data);
    ```
3. 查询用户列表
    ```php
    $user = new \zjf\pay\apis\user\User();
    $user->lists($data);
    ```
4. 更新用户
    ```php
    $user = new \zjf\pay\apis\user\User();
    $user->update($data);
    ```
5. 删除用户
    ```php
    $user = new \zjf\pay\apis\user\User();
    $user->delete($data);
    ```

##### 用户订单相关接口
1. 创建订单
    ```php
    $order = new \zjf\pay\apis\user\Order();
    $order->create($data);
    ```
2. 支付订单
    ```php
    $order = new \zjf\pay\apis\user\Order();
    $order->pay($data);
    ```
3. 查询订单
    ```php
    $order = new \zjf\pay\apis\user\Order();
    $order->query($data);
    ```
4. 查询订单列表
    ```php
    $order = new \zjf\pay\apis\user\Order();
    $order->lists($data);
    ```
5. 取消订单
    ```php
    $order = new \zjf\pay\apis\user\Order();
    $order->cancel($data);
    ```

##### 订单退款相关接口
1. 创建订单
    ```php
    $refund = new \zjf\pay\apis\user\Refund();
    $refund->create($data);
    ```
2. 查询订单
    ```php
    $refund = new \zjf\pay\apis\user\Refund();
    $refund->query($data);
    ```
3. 查询订单列表
    ```php
    $refund = new \zjf\pay\apis\user\Refund();
    $refund->lists($data);
    ```
##### 余额充值相关接口
1. 创建订单
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->create($data);
    ```
2. 支付订单
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->pay($data);
    ```
3. 查询订单
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->query($data);
    ```
4. 查询订单列表
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->lists($data);
    ```
5. 取消订单
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->cancel($data);
    ```
##### 余额转账相关接口
1. 创建订单
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->create($data);
    ```
2. 查询订单
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->query($data);
    ```
3. 查询订单列表
    ```php
    $recharge = new \zjf\pay\apis\balance\ReCharge();
    $recharge->lists($data);
    ```