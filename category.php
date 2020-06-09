<!DOCTYPE html>
<html>
    <body>
        <?php
// Include the database configuration file
        require 'dbConfig.php';

        function category() {
            global $db;
            $query = $db->query("SELECT "
                    . "c.Name as category_name, COUNT(icr.categoryId) as product_number"
                    . " FROM "
                    . "category as c"
                    . " left Join item_category_relations as icr on c.id=icr.categoryId "
                    . "Group By icr.categoryId "
                    . "ORDER BY product_number DESC"
            );

            if ($query->num_rows > 0) {
                while ($row = $query->fetch_assoc()) {
                    echo '<p>' . $row['category_name'] . '(' . $row['product_number'] . ')' . '</p>';
                }
            }
        }
        ?>
        <?php category(); ?>

    </body>
</html>