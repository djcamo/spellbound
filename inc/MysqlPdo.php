<?php
/**
 * Worksorted MySQL PDO driver wrapper class.
 * JIRA WS-5844
 * Worksorted - MysqlPdo.php
 *
 * @package    Database
 * @subpackage MySQL Driver
 * @author Jay Gao <jgao@worksorted.com>
 * @date 3/11/2020
 */

class MysqlPdo
{
    /**
     * A PDO instance representing a connection to a database
     * @var \PDO
     * */
    public $pdo = null;

    /**
     * Connect to the MySQL database with PDO driver
     * @param  string $host     host name or IP and database name
     * @param  string $user     database username
     * @param  string $pwd      database password
     * @param  array $opt       PDO options
     */

    public function __construct($host, $user, $pwd, $opt)
    {
        try {
            $dbh = new PDO($host, $user, $pwd, $opt);
            $this->pdo = $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Query the connected database with the provided string
     * @param  string $sql SQL statement
     * @return mixed Returns false on failure. For successful queries which produce a result set.
     */
    public function query($sql){
        return $this->pdo->query($sql);
    }

    /**
     * get results of query, compatible with old mysql_query()
     *
     * @param string $query query string
     * @param string $result_type result type
     *
     * @return PDOStatement query result
     * @access public
     * @static
     */
    public function fetch_array($query, $result_type = PDO::FETCH_BOTH)
    {
        if($result_type == MYSQLI_ASSOC){
            return $query->fetch(PDO::FETCH_ASSOC);
        }else if($result_type == MYSQLI_NUM) {
            return $query->fetch(PDO::FETCH_NUM);
        }else{
            return $query->fetch(PDO::FETCH_BOTH);
        }
    }

    /**
     * get the id of the last row inserted
     *
     * @return integer Id return the id of the last row inserted
     * @access public
     * @static
     */
    public function insert_id()
    {
        return $this->pdo->lastInsertId();
    }

    /**
     * returns the number of rows returned by the query
     *
     * @param PDOStatement $query
     *
     * @return integer numRows return the number of rows of the query
     * @access public
     * @static
     */
    public function num_rows($query)
    {
        return $query->rowCount();
    }

    /**
     * Query the connected database with the provided string
     * @param  string $sql SQL statement
     * @return mixed If the database server successfully prepares the statement, PDO::prepare() returns a PDOStatement object.
     * If the database server cannot successfully prepare the statement, PDO::prepare() returns false or emits PDOException
     */
    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    /**
     * Fetch extended error information associated with the last operation on the database handle
     * @return mixed returns an array of error information about the last operation performed by this database handle.
     */
    public function errorInfo()
    {
        return $this->pdo->errorInfo();
    }

    /**
     * Execute an SQL statement and return the number of affected rows
     * @return mixed returns the number of rows that were modified or deleted by the SQL statement you issued. If no rows were affected, PDO::exec() returns 0.
     */
    public function exec($sql)
    {
        return $this->pdo->exec($sql);
    }

    /**
     * close database connection
     *
     * @return null
     * @access public
     * @static
     */
    public function close()
    {
        $this->pdo = null;
    }

}