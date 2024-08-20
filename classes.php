<?php
    class Database
    {
        public static $conn;
        public static  $db_name = 'blog_db';

        // Initialize the connection in a static method
        static function satart_connection($database =null)
        {
            $servername = "localhost";
            $username = "root";
            $password = "";
            if($database != null) $db = $database;
    
            // Connect to Server
            try{
                
                if($database !== null)//CONNECTION AFTER CREATING THE DATABASE
                {
                    self::$conn = mysqli_connect($servername, $username, $password,$db);
                    return self::$conn;
                }
                else //THIS CONNECTION JUST FOR THE FIRST TIME WHEN CONNECTING TO CREATE DATABSE AND POST TABLE(INDEX.PHP LINE 14)
                {
                    self::$conn = mysqli_connect($servername, $username, $password);
                }
                    
                }
            catch(Exception $a)
                { 
                echo"<h3>You Have An Errror : Check Your Connection !</h3>";   
                }  
        }


        // Excuting querry
         public static function query($sql, $params = [])
        {
            // Prepare the SQL statement
            $stmt = self::satart_connection(self::$db_name)->prepare($sql);
            // Check if the preparation was successful
            if ($stmt === false) {
                die("Prepare failed: " . mysqli_error(Database::$conn));
            }

            if ($params) 
            {
                // Bind the id parameter to the statement (i = integer)
                $stmt->bind_param(...$params);
            }
            $stmt->execute();
            return $stmt;
        }

        public static function fetch($stmt)
        {
            return $stmt->get_result()->fetch_assoc();
        }


        //Craete Database with the posts table
        static function create_Database()
        {
            
            self::satart_connection();
     
            // Path to sql file
            $sql_file = './database.sql';

            // Read the SQL file
            $sql = file_get_contents($sql_file);

            // Execute the SQL queries
            if (self::$conn->multi_query($sql)) {
                do {
                    // Process each query result
                    if ($result = self::$conn->store_result()) {
                        $result->free();
                    }
                } while (self::$conn->next_result());
                echo "SQL file executed , Database with  the post table created successfully ";
            } else {
                echo "Error executing SQL file: " . self::$conn->error;
            }
            
            //End Connection
            mysqli_close(self::$conn);
        }   
         
   }
   
   class Posts
   {
        public $id;
        public $title;
        public $content;
        public $author;
        public $created_at;
        public $updated_at;

        //Show all Rows 
        public static function listAll()  
        {
            Database::satart_connection(Database::$db_name);
            $query = "SELECT * FROM blog_db.posts";
            $result = mysqli_query(Database::$conn,$query);

            mysqli_close(Database::$conn); 
            return $result;
        }

        //Show one row
        static function read($id) 
        { 
               // Prepare the SQL statement
                $sql = "SELECT * FROM posts WHERE id = ?";
            
                //Excute the query
                $stmt = Database::query($sql, ['i', $id]);
                //fetch the data
                $old_data =  Database::fetch($stmt);
                
                // Close the statement
                mysqli_stmt_close($stmt);
            
                // Close the connection
                mysqli_close(Database::$conn);
            
                // Return the fetched data
                return $old_data;
                       
        }

        //create post 
        public static function create($title,$content,$author)
        {
            // Prepare the SQL statement
            $sql = "INSERT INTO  posts (title, content, author) VALUES (?, ?, ?)";

            //excute the query
            $stmt = Database::query($sql, ['sss', $title, $content, $author]);

            // Close the statement and connection
            $stmt->close();
            //close connection
            mysqli_close(Database::$conn);

            //back to index view
            session_start();
            $_SESSION['create'] = "Post add successfully";
            header('location:index.php');

        }

        //Update Posts
        public static function update($id,$title,$content,$author)
        {  

            // Prepare the SQL statement            
            $sql = "UPDATE $db_name.posts SET title = ?, content = ?, author = ? WHERE id = ?";
           
            //excute the query
            $stmt = Database::query($sql, ['sssi', $title, $content, $author, $id]);

            // Close the statement and connection
            $stmt->close();
            //close connection
            mysqli_close(Database::$conn);

            //back to index view
            session_start();
            $_SESSION['update'] = "Post updated successfully";
            header('location:index.php');
           
        }

        //Delete Posts
        static function delete($id) 
        {

            $q = "DELETE FROM posts WHERE id=?" ;

            //Excute the query
            $stmt = Database::query($q, ['i', $id]);
            
            // Close the statement and connection
            $stmt->close();
            //close connection
            mysqli_close(Database::$conn);

            //back to index view
            session_start();
            $_SESSION['delete'] = "Post deleted successfully";
            header('location:index.php');

            
        }

        //validate the data
        public static function chk_daata($data)
        {
            if($data != $_POST['content']) $data = str_replace(' ', ' ', $data);

            Database::satart_connection(Database::$db_name);
                
            $data = stripslashes($data);
        
            $data = htmlspecialchars($data);
    
            $data = mysqli_real_escape_string(Database::$conn,$data);
            mysqli_close(Database::$conn);

            if (!preg_match("/^[a-zA-Z-' ]*$/",$data))
            {
                session_start();
                $_SESSION['error'] = " Only letters and white space allowed";
                header('location:index.php');//header('location:'.$_SERVER['HTTP_REFERER']);//back tp preveous page
            }else
            {
                return $data;  
            }
        
        }

   }


?>