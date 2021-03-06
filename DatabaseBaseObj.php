<!--AUTHOR: WILLI HERTEL-->
<?php

    //!!Don't give a User the chance to Input $table variable
    // => it can easily be used to read data one might not want everybody to see
    //KeyValueArray data will be ignored if more data got defined than there are PK columns
    function fetchByPrimaryKey($table, $keyValueArray, $connection)
    {
        //Selects the names of all primary key columns for the given table
        $sql = "Select key_column_usage.column_name
                from information_schema.key_column_usage 
                where table_schema = schema()
                   and constraint_name = 'PRIMARY'
                   and table_name = ? ";
        //Execution/Binding-Code
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "s", $table);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        //Building dynamic sql-String to fetch data defined by given primaryKey-Data
        //1 = 1 is always true => wont have any impact on execution
        // and I wont have any problems with "and" in SQL-Syntax
        //mysqli_real_escape_string has to be used because of security-reasons
        $sql2 = "Select * from " . mysqli_real_escape_string($connection, $table) . " where 1=1";
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 .= " and ".$row["column_name"] . " = '" . mysqli_real_escape_string($connection, $keyValueArray[$i])."'";
            $i++;
        }
        //if mysqli_fetch_assoc($result) returns null for the first row $i will never be incremented
        // => $i == 0 means table either does not exist or does not have any PKs
        if ($i == 0)
            throw new InvalidArgumentException("Table " . $table . " does not have any primary keys or does not exist");
        //Execution/Binding-code
        $stmt2 = mysqli_prepare($connection, $sql2);
        if (!$stmt2){
            throw new MySqlException("Table " . $table . " does not return results for given keyValueArray!" .json_encode($keyValueArray)."<br>". $sql2);
        }

        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);
        $row = mysqli_fetch_assoc($result2);
        if($row == null)
            throw new Exception("Result is null");
        return $row;
    }