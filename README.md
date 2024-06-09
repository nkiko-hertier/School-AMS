# LMS
 Loan Management System
## initialization of this system
**DataBase Name:** school_ams

## DATABASE CONFIG AREA

*/dashboard/php/conn.php*

```php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_ams";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function counter($table, $conn){
    $sql = "SELECT * FROM " . $table;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return mysqli_num_rows($result);
    }
}
```
*/dashboard/api/middleware.php*

```php
class Table {
    private $pdo;
    private $table;

    public function __construct($pdo, $table) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->conn = mysqli_connect('localhost', 'root','', 'school_ams');
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $stmt = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES ($placeholders)");
        return $stmt->execute(array_values($data));
    }

    public function update($data, $where) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = ?, ";
        }
        $set = rtrim($set, ", ");
        $stmt = $this->pdo->prepare("UPDATE $this->table SET $set WHERE $where");
        return $stmt->execute(array_values($data));
    }
    public function fetchAll($where = "1") {
        $stmt = mysqli_query($this->conn, "SELECT * FROM $this->table WHERE $where");
        return $stmt;
    }

    public function delete($where) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE $where");
        return $stmt->execute();
    }
}

$db = new Database('localhost', 'school_ams', 'root', '');
```

To set up your custom domain `ams.com` for your XAMPP project, follow these detailed steps:

### 1. Modify the `hosts` File

1. **Open the hosts file**:
   - **Windows**: Open `C:\Windows\System32\drivers\etc\hosts` using a text editor with administrative privileges (e.g., Notepad run as administrator).
   - **Mac/Linux**: Open `/etc/hosts` using a text editor with superuser privileges (e.g., using `sudo nano /etc/hosts`).

2. **Edit the hosts file**:
   - Add the following line to the end of the file:
     ```
     127.0.0.1   ams.com
     ```

3. **Save the hosts file**:
   - Ensure you have the necessary permissions to save the changes.

### 2. Configure Apache in XAMPP

1. **Open the XAMPP Control Panel** and start the Apache server if it is not already running.

2. **Edit the `httpd-vhosts.conf` file**:
   - The file is usually located in `C:\xampp\apache\conf\extra\httpd-vhosts.conf` on Windows or `/opt/lampp/etc/extra/httpd-vhosts.conf` on Linux.
   - Add the following configuration to the file:
     ```apache
     <VirtualHost *:80>
         ServerAdmin webmaster@ams.com
         DocumentRoot "C:/xampp/htdocs/yourproject"
         ServerName ams.com
         ErrorLog "logs/ams.com-error.log"
         CustomLog "logs/ams.com-access.log" common
     </VirtualHost>
     ```
   - Replace `C:/xampp/htdocs/yourproject` with the path to your project directory, for example, `C:/xampp/htdocs/ams`.

3. **Ensure the `httpd-vhosts.conf` file is included**:
   - Open the `httpd.conf` file located in `C:\xampp\apache\conf\httpd.conf`.
   - Make sure the following line is not commented out (remove the `#` if it is):
     ```apache
     Include conf/extra/httpd-vhosts.conf
     ```

4. **Restart Apache**:
   - Go back to the XAMPP Control Panel and restart Apache to apply the changes.

### 3. Access Your Project

1. **Open your web browser**:
   - Navigate to `http://ams.com`.
   - Your XAMPP project should now load using the custom domain `ams.com`.

By following these steps, you will configure your XAMPP environment to recognize and serve your project at the custom domain `ams.com`. This setup will create a more realistic development environment, simulating a production domain name.