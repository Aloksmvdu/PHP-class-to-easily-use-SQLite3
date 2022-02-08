# Introduction

A simple PHP class for easily working with SQLite3

## _Connect to DB_
Creates a new DB object. 

```bash
define('DB_NAME', 'mydb.sqlite.db');
define('BASE_PATH', '/www/database');
$con = new DB(BASE_PATH.'/'.DB_NAME);
```

## _SQL query_
Executes any valid SQL query, including ALTER TABLE. Returns array on success.

```bash
$con->db_query("SELECT * FROM employees"); 
```

## _Fetch Rows_
Fetches the next row from the given result handle. The row will be indexed by the result_type. Possible values for result_type are SQLITE3_ASSOC, SQLITE3_NUM, or SQLITE3_BOTH.

* SQLITE3_ASSOC: returns an array indexed by column name as returned in the corresponding result set
* SQLITE3_NUM: returns an array indexed by column number as returned in the corresponding result set, starting at column 0
* SQLITE3_BOTH: returns an array indexed by both column name and number as returned in the corresponding result set, starting at column 0

```bash
$row = $result->fetchArray(SQLITE3_ASSOC);
```

## _Print error_
Contains the error message generated from the last query, or empty if none

```bash
echo $con->error;
```

## _Enable Debug Logs_
Enables the class HTML debug logs

```bash
echo $con->db_logEnable(true);
```

## _Frame String_
Adds escape character before the ' or "

```bash
echo $con->db_frameString($string, "'");
```
## _Close DB Connection_
Close the DB connection

```bash
echo $con-> db_close();
```
