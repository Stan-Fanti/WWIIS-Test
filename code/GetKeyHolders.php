<?php
    /* It is not necessarily a fault, but – were it not outside the scope of this test – I would have reorganised the function to conform with OOP principles. */

        $database_user = "test";

        /* $database_password = "testP$ssw0rd";
            By using double quotes to store this password, PHP interprets $ as indicating a variable and creates a syntax problem. */
        $database_password = 'testP$ssw0rd';

        /* $pdo = new PDO('host=localhost;dbname=test', $database_user, $database_password, ...
            The first argument of PDO must be a data source, otherwise it will not connect. */
        $pdo = new PDO('mysql:host=localhost;dbname=test', $database_user, $database_password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NUM, PDO::ATTR_AUTOCOMMIT => 1, PDO::ATTR_STRINGIFY_FETCHES => 1));

        try {
            /* $query = $pdo->query("SELECT name, key FROM key_holders WHERE active = 1 ORDER BY order");.
                "Key" and "order" are operative commands in SQL. To invoke them without conflicting with SQL we must specify we are referring to columns. */
            $query = $pdo->query("SELECT name, key_holders.key FROM key_holders WHERE active = 1 ORDER BY key_holders.order;");
            
            /* $contacts = $query->fetchAll();
            Without associating the column names as keys in the array, it's impossible to access the array through them. */
            $contacts = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach($contacts as $contact) {
                $telephone = $pdo->prepare("SELECT telephone FROM contact_details WHERE name = ?");

                /* $telephone->execute($contact['name']);
                    The execute function of PDO requires the values to be sorted in the form of an array, even if just one. */
                $telephone->execute(array($contact['name']));

                $telephone = $telephone->fetchColumn();

                /* print("%s %d %s\n", $contact['name'], $contact['telephone'], $contact['key']);.
                    The function to be called was printf rather than print, since we want to output a formatted string.
                    Furthermore, the "telephone" record is not contained within $contact but we obtained it with our query.
                    Also, we must note that leading zeros in phone numbers are removed by converting them to integers rather than keeping them as strings. */
                printf("%s %s %s\n", $contact['name'], $telephone, $contact['key']);
            }
        } catch(Exception $exception) {
            // Echoing something more detailed about our exception might be of better use for debugging. But this technically works.
            echo "An exception occurred!";
        }
    
?>