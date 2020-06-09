<!DOCTYPE html>
<html>
    <body>
        <?php
// Include the database configuration file
        require 'dbConfig.php';

        function categoryTree($parent_id) {
            global $db;
            $tree = "";
            $query = $db->query(" "
                    . "SELECT c.Name,c.id "
                    . "FROM category as c "
                    . "left Join catetory_relations as cr on c.id=cr.ParentcategoryId"
                    . " WHERE cr.ParentcategoryId='" . $parent_id . "' "
            );

            while ($row = $query->fetch_assoc()) {
                $tree .= "<li><a href='#'>" . $row['Name'] . "</a>";

                $tree .= "<ul>" . categoryTree($row['id']) . "</ul>"; //call  recursively

                $tree .= "</li>";
            }

            return $tree;
        }
        ?>


        <?php categoryTree(0); ?>

    </body>
</html>