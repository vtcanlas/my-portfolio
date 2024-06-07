<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for approved
 */
class Approved extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $res_id;
    public $pool_id;
    public $date;
    public $rate_id;
    public $fname;
    public $lname;
    public $address;
    public $contactno;
    public $_email;
    public $proofofpayment;
    public $dateuploaded;
    public $approved;
    public $uname;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'approved';
        $this->TableName = 'approved';
        $this->TableType = 'LINKTABLE';

        // Update Table
        $this->UpdateTable = "`resdetails`";
        $this->Dbid = 'qcresorts_db1';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // res_id
        $this->res_id = new DbField(
            'approved',
            'approved',
            'x_res_id',
            'res_id',
            '`res_id`',
            '`res_id`',
            3,
            7,
            -1,
            false,
            '`res_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->res_id->InputTextType = "text";
        $this->res_id->IsAutoIncrement = true; // Autoincrement field
        $this->res_id->IsPrimaryKey = true; // Primary key field
        $this->res_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['res_id'] = &$this->res_id;

        // pool_id
        $this->pool_id = new DbField(
            'approved',
            'approved',
            'x_pool_id',
            'pool_id',
            '`pool_id`',
            '`pool_id`',
            3,
            7,
            -1,
            false,
            '`pool_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pool_id->InputTextType = "text";
        $this->pool_id->Nullable = false; // NOT NULL field
        $this->pool_id->Required = true; // Required field
        $this->pool_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pool_id'] = &$this->pool_id;

        // date
        $this->date = new DbField(
            'approved',
            'approved',
            'x_date',
            'date',
            '`date`',
            CastDateFieldForLike("`date`", 0, "qcresorts_db1"),
            133,
            10,
            0,
            false,
            '`date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date->InputTextType = "text";
        $this->date->Nullable = false; // NOT NULL field
        $this->date->Required = true; // Required field
        $this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date'] = &$this->date;

        // rate_id
        $this->rate_id = new DbField(
            'approved',
            'approved',
            'x_rate_id',
            'rate_id',
            '`rate_id`',
            '`rate_id`',
            3,
            7,
            -1,
            false,
            '`rate_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->rate_id->InputTextType = "text";
        $this->rate_id->Nullable = false; // NOT NULL field
        $this->rate_id->Required = true; // Required field
        $this->rate_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['rate_id'] = &$this->rate_id;

        // fname
        $this->fname = new DbField(
            'approved',
            'approved',
            'x_fname',
            'fname',
            '`fname`',
            '`fname`',
            200,
            50,
            -1,
            false,
            '`fname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->fname->InputTextType = "text";
        $this->fname->Nullable = false; // NOT NULL field
        $this->fname->Required = true; // Required field
        $this->Fields['fname'] = &$this->fname;

        // lname
        $this->lname = new DbField(
            'approved',
            'approved',
            'x_lname',
            'lname',
            '`lname`',
            '`lname`',
            200,
            50,
            -1,
            false,
            '`lname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->lname->InputTextType = "text";
        $this->lname->Nullable = false; // NOT NULL field
        $this->lname->Required = true; // Required field
        $this->Fields['lname'] = &$this->lname;

        // address
        $this->address = new DbField(
            'approved',
            'approved',
            'x_address',
            'address',
            '`address`',
            '`address`',
            200,
            255,
            -1,
            false,
            '`address`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->address->InputTextType = "text";
        $this->address->Nullable = false; // NOT NULL field
        $this->address->Required = true; // Required field
        $this->Fields['address'] = &$this->address;

        // contactno
        $this->contactno = new DbField(
            'approved',
            'approved',
            'x_contactno',
            'contactno',
            '`contactno`',
            '`contactno`',
            200,
            50,
            -1,
            false,
            '`contactno`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->contactno->InputTextType = "text";
        $this->contactno->Nullable = false; // NOT NULL field
        $this->contactno->Required = true; // Required field
        $this->Fields['contactno'] = &$this->contactno;

        // email
        $this->_email = new DbField(
            'approved',
            'approved',
            'x__email',
            'email',
            '`email`',
            '`email`',
            200,
            50,
            -1,
            false,
            '`email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_email->InputTextType = "text";
        $this->_email->Nullable = false; // NOT NULL field
        $this->_email->Required = true; // Required field
        $this->Fields['email'] = &$this->_email;

        // proofofpayment
        $this->proofofpayment = new DbField(
            'approved',
            'approved',
            'x_proofofpayment',
            'proofofpayment',
            '`proofofpayment`',
            '`proofofpayment`',
            205,
            0,
            -1,
            true,
            '`proofofpayment`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->proofofpayment->InputTextType = "text";
        $this->proofofpayment->Nullable = false; // NOT NULL field
        $this->proofofpayment->Required = true; // Required field
        $this->proofofpayment->Sortable = false; // Allow sort
        $this->Fields['proofofpayment'] = &$this->proofofpayment;

        // dateuploaded
        $this->dateuploaded = new DbField(
            'approved',
            'approved',
            'x_dateuploaded',
            'dateuploaded',
            '`dateuploaded`',
            '`dateuploaded`',
            200,
            50,
            -1,
            false,
            '`dateuploaded`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->dateuploaded->InputTextType = "text";
        $this->dateuploaded->Nullable = false; // NOT NULL field
        $this->dateuploaded->Required = true; // Required field
        $this->Fields['dateuploaded'] = &$this->dateuploaded;

        // approved
        $this->approved = new DbField(
            'approved',
            'approved',
            'x_approved',
            'approved',
            '`approved`',
            '`approved`',
            3,
            1,
            -1,
            false,
            '`approved`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->approved->InputTextType = "text";
        $this->approved->Nullable = false; // NOT NULL field
        $this->approved->Required = true; // Required field
        $this->approved->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['approved'] = &$this->approved;

        // uname
        $this->uname = new DbField(
            'approved',
            'approved',
            'x_uname',
            'uname',
            '`uname`',
            '`uname`',
            200,
            50,
            -1,
            false,
            '`uname`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->uname->InputTextType = "text";
        $this->uname->Nullable = false; // NOT NULL field
        $this->uname->Required = true; // Required field
        $this->Fields['uname'] = &$this->uname;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`resdetails`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "uname = '".CurrentUserName()."' && approved=1";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->res_id->setDbValue($conn->lastInsertId());
            $rs['res_id'] = $this->res_id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('res_id', $rs)) {
                AddFilter($where, QuotedName('res_id', $this->Dbid) . '=' . QuotedValue($rs['res_id'], $this->res_id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->res_id->DbValue = $row['res_id'];
        $this->pool_id->DbValue = $row['pool_id'];
        $this->date->DbValue = $row['date'];
        $this->rate_id->DbValue = $row['rate_id'];
        $this->fname->DbValue = $row['fname'];
        $this->lname->DbValue = $row['lname'];
        $this->address->DbValue = $row['address'];
        $this->contactno->DbValue = $row['contactno'];
        $this->_email->DbValue = $row['email'];
        $this->proofofpayment->Upload->DbValue = $row['proofofpayment'];
        $this->dateuploaded->DbValue = $row['dateuploaded'];
        $this->approved->DbValue = $row['approved'];
        $this->uname->DbValue = $row['uname'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`res_id` = @res_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->res_id->CurrentValue : $this->res_id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->res_id->CurrentValue = $keys[0];
            } else {
                $this->res_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('res_id', $row) ? $row['res_id'] : null;
        } else {
            $val = $this->res_id->OldValue !== null ? $this->res_id->OldValue : $this->res_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@res_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("ApprovedList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "ApprovedView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ApprovedEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ApprovedAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "ApprovedView";
            case Config("API_ADD_ACTION"):
                return "ApprovedAdd";
            case Config("API_EDIT_ACTION"):
                return "ApprovedEdit";
            case Config("API_DELETE_ACTION"):
                return "ApprovedDelete";
            case Config("API_LIST_ACTION"):
                return "ApprovedList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ApprovedList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ApprovedView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ApprovedView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ApprovedAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "ApprovedAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ApprovedEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("ApprovedAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("ApprovedDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"res_id\":" . JsonEncode($this->res_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->res_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->res_id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("res_id") ?? Route("res_id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->res_id->CurrentValue = $key;
            } else {
                $this->res_id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->res_id->setDbValue($row['res_id']);
        $this->pool_id->setDbValue($row['pool_id']);
        $this->date->setDbValue($row['date']);
        $this->rate_id->setDbValue($row['rate_id']);
        $this->fname->setDbValue($row['fname']);
        $this->lname->setDbValue($row['lname']);
        $this->address->setDbValue($row['address']);
        $this->contactno->setDbValue($row['contactno']);
        $this->_email->setDbValue($row['email']);
        $this->proofofpayment->Upload->DbValue = $row['proofofpayment'];
        $this->dateuploaded->setDbValue($row['dateuploaded']);
        $this->approved->setDbValue($row['approved']);
        $this->uname->setDbValue($row['uname']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // res_id

        // pool_id

        // date

        // rate_id

        // fname

        // lname

        // address

        // contactno

        // email

        // proofofpayment

        // dateuploaded

        // approved

        // uname

        // res_id
        $this->res_id->ViewValue = $this->res_id->CurrentValue;
        $this->res_id->ViewCustomAttributes = "";

        // pool_id
        $this->pool_id->ViewValue = $this->pool_id->CurrentValue;
        $this->pool_id->ViewValue = FormatNumber($this->pool_id->ViewValue, $this->pool_id->formatPattern());
        $this->pool_id->ViewCustomAttributes = "";

        // date
        $this->date->ViewValue = $this->date->CurrentValue;
        $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());
        $this->date->ViewCustomAttributes = "";

        // rate_id
        $this->rate_id->ViewValue = $this->rate_id->CurrentValue;
        $this->rate_id->ViewValue = FormatNumber($this->rate_id->ViewValue, $this->rate_id->formatPattern());
        $this->rate_id->ViewCustomAttributes = "";

        // fname
        $this->fname->ViewValue = $this->fname->CurrentValue;
        $this->fname->ViewCustomAttributes = "";

        // lname
        $this->lname->ViewValue = $this->lname->CurrentValue;
        $this->lname->ViewCustomAttributes = "";

        // address
        $this->address->ViewValue = $this->address->CurrentValue;
        $this->address->ViewCustomAttributes = "";

        // contactno
        $this->contactno->ViewValue = $this->contactno->CurrentValue;
        $this->contactno->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // proofofpayment
        if (!EmptyValue($this->proofofpayment->Upload->DbValue)) {
            $this->proofofpayment->ViewValue = $this->res_id->CurrentValue;
            $this->proofofpayment->IsBlobImage = IsImageFile(ContentExtension($this->proofofpayment->Upload->DbValue));
        } else {
            $this->proofofpayment->ViewValue = "";
        }
        $this->proofofpayment->ViewCustomAttributes = "";

        // dateuploaded
        $this->dateuploaded->ViewValue = $this->dateuploaded->CurrentValue;
        $this->dateuploaded->ViewCustomAttributes = "";

        // approved
        $this->approved->ViewValue = $this->approved->CurrentValue;
        $this->approved->ViewValue = FormatNumber($this->approved->ViewValue, $this->approved->formatPattern());
        $this->approved->ViewCustomAttributes = "";

        // uname
        $this->uname->ViewValue = $this->uname->CurrentValue;
        $this->uname->ViewCustomAttributes = "";

        // res_id
        $this->res_id->LinkCustomAttributes = "";
        $this->res_id->HrefValue = "";
        $this->res_id->TooltipValue = "";

        // pool_id
        $this->pool_id->LinkCustomAttributes = "";
        $this->pool_id->HrefValue = "";
        $this->pool_id->TooltipValue = "";

        // date
        $this->date->LinkCustomAttributes = "";
        $this->date->HrefValue = "";
        $this->date->TooltipValue = "";

        // rate_id
        $this->rate_id->LinkCustomAttributes = "";
        $this->rate_id->HrefValue = "";
        $this->rate_id->TooltipValue = "";

        // fname
        $this->fname->LinkCustomAttributes = "";
        $this->fname->HrefValue = "";
        $this->fname->TooltipValue = "";

        // lname
        $this->lname->LinkCustomAttributes = "";
        $this->lname->HrefValue = "";
        $this->lname->TooltipValue = "";

        // address
        $this->address->LinkCustomAttributes = "";
        $this->address->HrefValue = "";
        $this->address->TooltipValue = "";

        // contactno
        $this->contactno->LinkCustomAttributes = "";
        $this->contactno->HrefValue = "";
        $this->contactno->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // proofofpayment
        $this->proofofpayment->LinkCustomAttributes = "";
        if (!empty($this->proofofpayment->Upload->DbValue)) {
            $this->proofofpayment->HrefValue = GetFileUploadUrl($this->proofofpayment, $this->res_id->CurrentValue);
            $this->proofofpayment->LinkAttrs["target"] = "";
            if ($this->proofofpayment->IsBlobImage && empty($this->proofofpayment->LinkAttrs["target"])) {
                $this->proofofpayment->LinkAttrs["target"] = "_blank";
            }
            if ($this->isExport()) {
                $this->proofofpayment->HrefValue = FullUrl($this->proofofpayment->HrefValue, "href");
            }
        } else {
            $this->proofofpayment->HrefValue = "";
        }
        $this->proofofpayment->ExportHrefValue = GetFileUploadUrl($this->proofofpayment, $this->res_id->CurrentValue);
        $this->proofofpayment->TooltipValue = "";

        // dateuploaded
        $this->dateuploaded->LinkCustomAttributes = "";
        $this->dateuploaded->HrefValue = "";
        $this->dateuploaded->TooltipValue = "";

        // approved
        $this->approved->LinkCustomAttributes = "";
        $this->approved->HrefValue = "";
        $this->approved->TooltipValue = "";

        // uname
        $this->uname->LinkCustomAttributes = "";
        $this->uname->HrefValue = "";
        $this->uname->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // res_id
        $this->res_id->setupEditAttributes();
        $this->res_id->EditCustomAttributes = "";
        $this->res_id->EditValue = $this->res_id->CurrentValue;
        $this->res_id->ViewCustomAttributes = "";

        // pool_id
        $this->pool_id->setupEditAttributes();
        $this->pool_id->EditCustomAttributes = "";
        $this->pool_id->EditValue = $this->pool_id->CurrentValue;
        $this->pool_id->PlaceHolder = RemoveHtml($this->pool_id->caption());
        if (strval($this->pool_id->EditValue) != "" && is_numeric($this->pool_id->EditValue)) {
            $this->pool_id->EditValue = FormatNumber($this->pool_id->EditValue, null);
        }

        // date
        $this->date->setupEditAttributes();
        $this->date->EditCustomAttributes = "";
        $this->date->EditValue = FormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->date->PlaceHolder = RemoveHtml($this->date->caption());

        // rate_id
        $this->rate_id->setupEditAttributes();
        $this->rate_id->EditCustomAttributes = "";
        $this->rate_id->EditValue = $this->rate_id->CurrentValue;
        $this->rate_id->PlaceHolder = RemoveHtml($this->rate_id->caption());
        if (strval($this->rate_id->EditValue) != "" && is_numeric($this->rate_id->EditValue)) {
            $this->rate_id->EditValue = FormatNumber($this->rate_id->EditValue, null);
        }

        // fname
        $this->fname->setupEditAttributes();
        $this->fname->EditCustomAttributes = "";
        if (!$this->fname->Raw) {
            $this->fname->CurrentValue = HtmlDecode($this->fname->CurrentValue);
        }
        $this->fname->EditValue = $this->fname->CurrentValue;
        $this->fname->PlaceHolder = RemoveHtml($this->fname->caption());

        // lname
        $this->lname->setupEditAttributes();
        $this->lname->EditCustomAttributes = "";
        if (!$this->lname->Raw) {
            $this->lname->CurrentValue = HtmlDecode($this->lname->CurrentValue);
        }
        $this->lname->EditValue = $this->lname->CurrentValue;
        $this->lname->PlaceHolder = RemoveHtml($this->lname->caption());

        // address
        $this->address->setupEditAttributes();
        $this->address->EditCustomAttributes = "";
        if (!$this->address->Raw) {
            $this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
        }
        $this->address->EditValue = $this->address->CurrentValue;
        $this->address->PlaceHolder = RemoveHtml($this->address->caption());

        // contactno
        $this->contactno->setupEditAttributes();
        $this->contactno->EditCustomAttributes = "";
        if (!$this->contactno->Raw) {
            $this->contactno->CurrentValue = HtmlDecode($this->contactno->CurrentValue);
        }
        $this->contactno->EditValue = $this->contactno->CurrentValue;
        $this->contactno->PlaceHolder = RemoveHtml($this->contactno->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // proofofpayment
        $this->proofofpayment->setupEditAttributes();
        $this->proofofpayment->EditCustomAttributes = "";
        if (!EmptyValue($this->proofofpayment->Upload->DbValue)) {
            $this->proofofpayment->EditValue = $this->res_id->CurrentValue;
            $this->proofofpayment->IsBlobImage = IsImageFile(ContentExtension($this->proofofpayment->Upload->DbValue));
        } else {
            $this->proofofpayment->EditValue = "";
        }

        // dateuploaded
        $this->dateuploaded->setupEditAttributes();
        $this->dateuploaded->EditCustomAttributes = "";
        if (!$this->dateuploaded->Raw) {
            $this->dateuploaded->CurrentValue = HtmlDecode($this->dateuploaded->CurrentValue);
        }
        $this->dateuploaded->EditValue = $this->dateuploaded->CurrentValue;
        $this->dateuploaded->PlaceHolder = RemoveHtml($this->dateuploaded->caption());

        // approved
        $this->approved->setupEditAttributes();
        $this->approved->EditCustomAttributes = "";
        $this->approved->EditValue = $this->approved->CurrentValue;
        $this->approved->PlaceHolder = RemoveHtml($this->approved->caption());
        if (strval($this->approved->EditValue) != "" && is_numeric($this->approved->EditValue)) {
            $this->approved->EditValue = FormatNumber($this->approved->EditValue, null);
        }

        // uname
        $this->uname->setupEditAttributes();
        $this->uname->EditCustomAttributes = "";
        if (!$this->uname->Raw) {
            $this->uname->CurrentValue = HtmlDecode($this->uname->CurrentValue);
        }
        $this->uname->EditValue = $this->uname->CurrentValue;
        $this->uname->PlaceHolder = RemoveHtml($this->uname->caption());

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->res_id);
                    $doc->exportCaption($this->pool_id);
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->rate_id);
                    $doc->exportCaption($this->fname);
                    $doc->exportCaption($this->lname);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->contactno);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->proofofpayment);
                    $doc->exportCaption($this->dateuploaded);
                    $doc->exportCaption($this->approved);
                    $doc->exportCaption($this->uname);
                } else {
                    $doc->exportCaption($this->res_id);
                    $doc->exportCaption($this->pool_id);
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->rate_id);
                    $doc->exportCaption($this->fname);
                    $doc->exportCaption($this->lname);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->contactno);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->dateuploaded);
                    $doc->exportCaption($this->approved);
                    $doc->exportCaption($this->uname);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->res_id);
                        $doc->exportField($this->pool_id);
                        $doc->exportField($this->date);
                        $doc->exportField($this->rate_id);
                        $doc->exportField($this->fname);
                        $doc->exportField($this->lname);
                        $doc->exportField($this->address);
                        $doc->exportField($this->contactno);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->proofofpayment);
                        $doc->exportField($this->dateuploaded);
                        $doc->exportField($this->approved);
                        $doc->exportField($this->uname);
                    } else {
                        $doc->exportField($this->res_id);
                        $doc->exportField($this->pool_id);
                        $doc->exportField($this->date);
                        $doc->exportField($this->rate_id);
                        $doc->exportField($this->fname);
                        $doc->exportField($this->lname);
                        $doc->exportField($this->address);
                        $doc->exportField($this->contactno);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->dateuploaded);
                        $doc->exportField($this->approved);
                        $doc->exportField($this->uname);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'proofofpayment') {
            $fldName = "proofofpayment";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->res_id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
