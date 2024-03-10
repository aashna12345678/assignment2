<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'assignment2';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

class Factory
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db->getConnection();
    }

    // Product CRUD methods for table 1
    public function getAllProducts()
    {
        $stmt = $this->conn->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO products (description, image, price, shipping_cost) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['description'], $data['image'], $data['price'], $data['shipping_cost']]);
        return $this->conn->lastInsertId();
    }

    public function updateProduct($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE products SET description = ?, image = ?, price = ?, shipping_cost = ? WHERE id = ?");
        $stmt->execute([$data['description'], $data['image'], $data['price'], $data['shipping_cost'], $id]);
    }

    public function deleteProduct($id, $entity)
    {
        $stmt = $this->conn->prepare("DELETE FROM $entity WHERE id = ?");
        $stmt->execute([$id]);
    }

    //table2USER
    public function getAllUser()
    {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO users (email, password, username, purchase_history, shipping_address) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['email'], $data['password'], $data['username'], $data['purchase_history'], $data['shipping_address']]);
        return $this->conn->lastInsertId();
    }

    public function updateUser($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE users SET email = ?, password = ?, username= ?, purchase_history = ?, shipping_address = ? WHERE id = ?");
        $stmt->execute([$data['email'], $data['password'], $data['username'], $data['purchase_history'], $data['shipping_address']]);
    }

    public function deleteUser($id, $entity)
    {
        $stmt = $this->conn->prepare("DELETE FROM $entity WHERE id = ?");
        $stmt->execute([$id]);
    }
    //table3 COMMENTS
    public function getAllComments()
    {
        $stmt = $this->conn->prepare("SELECT * FROM comments");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createComments($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO comments (product_id, user_id, rating, images, comment) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$data['product_id'], $data['user_id'], $data['rating'], $data['images'], $data['comment']]);
        return $this->conn->lastInsertId();
    }

    public function updateComments($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE comments SET product_id = ?, user_id = ?, rating= ?, images = ?, comment = ? WHERE id = ?");
        $stmt->execute([$data['product_id'], $data['user_id'], $data['rating'], $data['images'], $data['comment']]);
    }

    public function deleteComments($id, $entity)
    {
        $stmt = $this->conn->prepare("DELETE FROM $entity WHERE id = ?");
        $stmt->execute([$id]);
    }
    //table4 CART
    public function getAllCart()
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCartById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM cart WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createCart($data)
    {
        $stmt = $this->conn->prepare("INSERT INTO cart (product_id, user_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$data['product_id'], $data['user_id'], $data['quantity']]);
        return $this->conn->lastInsertId();
    }

    public function updateCart($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE cart SET product_id = ?, quantity= ?, user_id = ? WHERE id = ?");
        $stmt->execute([$data['product_id'], $data['quantity'], $data['user_id']]);
    }

    public function deleteCart($id, $entity)
    {
        $stmt = $this->conn->prepare("DELETE FROM $entity WHERE id = ?");
        $stmt->execute([$id]);
    }
     //table5 ORDER
     public function getAllOrder()
     {
         $stmt = $this->conn->prepare("SELECT * FROM order");
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
 
     public function getOrderById($id)
     {
         $stmt = $this->conn->prepare("SELECT * FROM order WHERE id = ?");
         $stmt->execute([$id]);
         return $stmt->fetch(PDO::FETCH_ASSOC);
     }
 
     public function createOrder($data)
     {
         $stmt = $this->conn->prepare("INSERT INTO orders (product_id, user_id, quantity, order_id) VALUES (?, ?, ?, ?)");
         $stmt->execute([$data['product_id'], $data['order_id'], $data['quantity'], $data['user_id']]);
         return $this->conn->lastInsertId();
     }
 
     public function updateOrder($id, $data)
     {
         $stmt = $this->conn->prepare("UPDATE orders SET product_id = ?, quantity = ?, user_id = ?, order_id = ? WHERE id = ?");
         $stmt->execute([$data['product_id'], $data['quantity'], $data['user_id'], $data['order_id'],$id]);
     }
 
     public function deleteOrder($id, $entity)
     {
         $stmt = $this->conn->prepare("DELETE FROM $entity WHERE id = ?");
         $stmt->execute([$id]);
     }
     //order
     public function isOrderExists($id)
     {
         try {
             $stmt = $this->conn->prepare("SELECT COUNT(*) FROM orders WHERE id = ? ");
             $stmt->execute([$id]);
             $count = $stmt->fetchColumn();
             return $count > 0;
         } catch (PDOException $e) {
             // Handle the error
             return false;
         }
     }
     //comments
     public function isCommentsExists($id)
     {
         try {
             $stmt = $this->conn->prepare("SELECT COUNT(*) FROM comments WHERE id = ? ");
             $stmt->execute([$id]);
             $count = $stmt->fetchColumn();
             return $count > 0;
         } catch (PDOException $e) {
             // Handle the error
             return false;
         }
     }
     //user
     public function isUserExists($id)
     {
         try {
             $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE id = ? ");
             $stmt->execute([$id]);
             $count = $stmt->fetchColumn();
             return $count > 0;
         } catch (PDOException $e) {
             // Handle the error
             return false;
         }
     }
     //product
     public function isProductExists($id)
     {
         try {
             $stmt = $this->conn->prepare("SELECT COUNT(*) FROM product WHERE id = ? ");
             $stmt->execute([$id]);
             $count = $stmt->fetchColumn();
             return $count > 0;
         } catch (PDOException $e) {
             // Handle the error
             return false;
         }
     }
     //cart
     public function isCartExists($id)
     {
         try {
             $stmt = $this->conn->prepare("SELECT COUNT(*) FROM cart WHERE id = ? ");
             $stmt->execute([$id]);
             $count = $stmt->fetchColumn();
             return $count > 0;
         } catch (PDOException $e) {
             // Handle the error
             return false;
         }
     }





}

$db = new Database();
$factory = new Factory($db);

// Handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['entity'])) {
    $entity = $_GET['entity'];
    //table 1
    if ($entity === 'product') {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            echo json_encode($factory->getProductById($productId));
        } else {
            echo json_encode($factory->getAllProducts());
        }
    }
    //table2
    if ($entity === 'users') {
        if (isset($_GET['id'])) {
            $userId = $_GET['id'];
            echo json_encode($factory->getUserById($userId));
        } else {
            echo json_encode($factory->getAllUser());
        }
    }
    //table 3
    if ($entity === 'comments') {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            echo json_encode($factory->getCommentsById($productId));
        } else {
            echo json_encode($factory->getAllComments());
        }
    }
    //table4
    if ($entity === 'cart') {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            echo json_encode($factory->getCartById($productId));
        } else {
            echo json_encode($factory->getAllCart());
        }
    }
    //table5
    if ($entity === 'orders') {
        if (isset($_GET['id'])) {
            $productId = $_GET['id'];
            echo json_encode($factory->getOrderById($productId));
        } else {
            echo json_encode($factory->getAllOrder());
        }
    }

}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['entity'])) {
    $entity = $_GET['entity'];
    $postData = json_decode(file_get_contents("php://input"), true);
    if ($entity === 'products') {
        // Debug: Echo the received POST data
        var_dump($postData);

        // Check if description field exists and is not empty

        if (
            isset($postData['description']) && !empty($postData['description']) &&
            isset($postData['image']) && !empty($postData['image']) &&
            isset($postData['price']) && !empty($postData['price']) &&
            isset($postData['shipping_cost']) && !empty($postData['shipping_cost'])
        ) {
            // Create the product
            $productId = $factory->createProduct($postData);
            
            echo json_encode(array("id" => $productId));
        } 
        else {
            // Return a 400 Bad Request response if any required field is missing or empty
            http_response_code(400);
            echo json_encode(array("message" => "One or more required fields are missing or empty"));
        }
    }
    if ($entity === 'users') {
        // Debug: Echo the received POST data
        var_dump($postData);
        //table 2
        if (
            isset($postData['email']) && !empty($postData['email']) &&
            isset($postData['password']) && !empty($postData['password']) &&
            isset($postData['username']) && !empty($postData['username']) &&
            isset($postData['purchase_history']) && !empty($postData['purchase_history'])&&
            isset($postData['shipping_address']) && !empty($postData['shipping_address'])
        ) {
            // Create the product
            $userId = $factory->createUser($postData);
            echo json_encode(array("id" => $usertId));
            
        } 
        
        else {
            // Return a 400 Bad Request response if any required field is missing or empty
            http_response_code(400);
            echo json_encode(array("message" => "One or more required fields are missing or empty"));
        }
    }
    
    //table3
    if ($entity === 'comments') {
        // Debug: Echo the received POST data
        var_dump($postData);
    
        // Check if all required fields are present
        if (
            isset($postData['product_id']) && !empty($postData['product_id']) &&
            isset($postData['user_id']) && !empty($postData['user_id']) &&
            isset($postData['rating']) && !empty($postData['rating']) &&
            isset($postData['images']) && !empty($postData['images']) &&
            isset($postData['comment']) && !empty($postData['comment'])
        ) {
            // All required fields are present, create the comment
            $commentId = $factory->createComments($postData);
            echo json_encode(array("id" => $commentId));
        } else {
            // Some required fields are missing or empty, return an error response
            echo json_encode(array("error" => "Missing or empty required fields"));
        }
    }
    
//table 4
if ($entity === 'cart') {
    // Debug: Echo the received POST data
    var_dump($postData);

    // Check if all required fields are present
    if (
        isset($postData['product_id']) && !empty($postData['product_id']) &&
        isset($postData['user_id']) && !empty($postData['user_id']) &&
        isset($postData['quantity']) && !empty($postData['quantity'])
    ) {
        // All required fields are present, create the cart
        $cartId = $factory->createCart($postData);
        echo json_encode(array("id" => $cartId));
    } else {
        // Return a 400 Bad Request response if any required field is missing or empty
        http_response_code(400);
        echo json_encode(array("message" => "One or more required fields are missing or empty"));
    }
}
//table5
if ($entity === 'orders') {
    // Debug: Echo the received POST data
    var_dump($postData);

    // Check if all required fields are present
    if (
        isset($postData['product_id']) && !empty($postData['product_id']) &&
        isset($postData['user_id']) && !empty($postData['user_id']) &&
        isset($postData['quantity']) && !empty($postData['quantity']) &&
        isset($postData['order_id']) && !empty($postData['order_id'])
    ) {
        // All required fields are present, create the order
        $orderId = $factory->createOrder($postData);
        echo json_encode(array("id" => $orderId));
    } else {
        // Return a 400 Bad Request response if any required field is missing or empty
        http_response_code(400);
        echo json_encode(array("message" => "One or more required fields are missing or empty"));
    }
}

}


if ($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['entity']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $id = $_GET['id'];
    $putData = json_decode(file_get_contents("php://input"), true);
    if ($entity === 'product') {
        // Check if the required fields exist in the request data
        if (isset($putData['description']) && isset($putData['image']) && isset($putData['price']) && isset($putData['shipping_cost'])) {
            if (!$factory->isProductExists($id)) {
                echo json_encode(array("message" => "Product with ID $id does not exist"));
                exit;
            }
            // Perform the update operation
            $factory->updateProduct($id, $putData);
            echo json_encode(array("message" => "Product updated successfully"));
        } else {
            // Return a 400 Bad Request response if any required fields are missing
            http_response_code(400);
            echo json_encode(array("message" => "Missing required fields"));
        }
    }
    if ($entity === 'user') {
        // Check if the required fields exist in the request data
        if (isset($putData['email']) && isset($putData['password']) && isset($putData['username']) && isset($putData['shipping_address']) && isset($putData['purchase_history'])) {
            if (!$factory->isUserExists($id)) {
                echo json_encode(array("message" => "User with ID $id does not exist"));
                exit;
            }
            // Perform the update operation
            $factory->updateUser($id, $putData);
            echo json_encode(array("message" => "User updated successfully"));
        } else {
            // Return a 400 Bad Request response if any required fields are missing
            http_response_code(400);
            echo json_encode(array("message" => "Missing required fields"));
        }
    }
    if ($entity === 'comments') {
        // Check if the required fields exist in the request data
        if (isset($putData['product_id']) && isset($putData['user_id']) && isset($putData['ratings']) && isset($putData['images']) && isset($putData['comments'])) {
            if (!$factory->isCommentsExists($id)) {
                echo json_encode(array("message" => "Comment with ID $id does not exist"));
                exit;
            }
            // Perform the update operation
            $factory->updateComments($id, $putData);
            echo json_encode(array("message" => "Comments updated successfully"));
        } else {
            // Return a 400 Bad Request response if any required fields are missing
            http_response_code(400);
            echo json_encode(array("message" => "Missing required fields"));
        }
    }
    if ($entity === 'cart') {
        // Check if the required fields exist in the request data
        if (isset($putData['product_id']) && isset($putData['quantity']) && isset($putData['user_id'])) {
            if (!$factory->isCartExists($id)) {
                echo json_encode(array("message" => "Cart with ID $id does not exist"));
                exit;
            }
            // Perform the update operation
            $factory->updateCart($id, $putData);
            echo json_encode(array("message" => "Cart updated successfully"));
        } else {
            // Return a 400 Bad Request response if any required fields are missing
            http_response_code(400);
            echo json_encode(array("message" => "Missing required fields"));
        }
    }
    if ($entity === 'orders') {
        // Check if the required fields exist in the request data
        if (isset($putData['product_id']) && isset($putData['quantity']) && isset($putData['user_id']) && isset($putData['order_id'])) {
            if (!$factory->isOrderExists($id)) {
                echo json_encode(array("message" => "Order with ID $id does not exist"));
                exit;
            }
            // Perform the update operation
            $factory->updateOrder($id, $putData);
            echo json_encode(array("message" => "Order updated successfully"));
        } 
        else {
            // Return a 400 Bad Request response if any required fields are missing
            http_response_code(400);
            echo json_encode(array("message" => "Missing required fields"));
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['entity']) && isset($_GET['id'])) {
    $entity = $_GET['entity'];
    $id = $_GET['id'];
    if ($entity === 'product')
     {
        $factory->deleteProduct($id, $entity);
        echo json_encode(array("message" => "product deleted successfully"));
    }
    elseif ($entity === 'users') {

      $factory->deleteUser($id, $entity);
      echo json_encode(array("message" => "user deleted successfully"));

    }
    elseif ($entity === 'comments') {

        $factory->deleteComments($id, $entity);
        echo json_encode(array("message" => "comments deleted successfully"));
  
      }
    elseif ($entity === 'cart') {

        $factory->deleteCart($id, $entity);
        echo json_encode(array("message" => "cart deleted successfully"));  
      }
    elseif ($entity === 'orders') {
        $factory->deleteOrder($id, $entity);
        echo json_encode(array("message" => "Order deleted successfully"));
      }
    else
    {
        echo json_encode(array("message" => "Table does not exist"));
    }
}
?>