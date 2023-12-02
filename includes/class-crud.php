<?php

class Crud {
    public static $page_name = 'crudplugin';
    
    public static function create() {
        echo '<div class="wrap">
            <h3>Add items</h3>
            <form method="post">
                <input type="text" name="name">
                <input type="number" name="age">
                <input type="submit" name="submit">
            </form>
          </div>';
    
    
        if(isset($_POST['submit'])) {
            if( isset($_POST['name']) && (isset($_POST['age']))) {
                global $wpdb;
                $name = $_POST['name'];
                $age = $_POST['age'];
                $table_name = $wpdb->prefix.'crud_plugin_table';
                $wpdb->query(
                    $wpdb->prepare(
                        "INSERT INTO {$table_name} (name, age) 
                        VALUES (%s, %d)",
                        $name,
                        $age
                    )
                );
            }
            
        }
    }
    public static function read() {
        global $wpdb;
        $table_name = $wpdb->prefix.'crud_plugin_table';
        
        $results = $wpdb->get_results("SELECT * FROM {$table_name}");
        echo "<h3>All items</h3>
        <table>
        <tr><th>Name</th><th>Age</th></tr>";
        foreach($results as $result) {
            echo '<tr>
                    <td>'.$result->name.'</td>
                    <td>'.$result->age.'</td>
                    <td><a href="admin.php?page='.self::$page_name.'&del='.$result->id.'">x</a></td>
                </tr>';
        }
        echo "</table>";
        }
    public static function update() {

    }
    public static function delete() {
        global $wpdb;
        $table_name = $wpdb->prefix.'crud_plugin_table';
        if(isset($_GET['del'])) {
           $id = $_GET['del'];
            $wpdb->delete($table_name, array('id' => $id), array('%d'));
            echo '<script>location.replace("admin.php?page='.self::$page_name.'");</script>';
        }
    }
}