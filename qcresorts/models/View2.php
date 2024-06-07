<?php

namespace PHPMaker2022\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for view2
 */
class View2 extends DbTable
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
    public $pool_name;
    public $pool_description;
    public $poolcat;
    public $address;
    public $contactno1;
    public $socmed;
    public $emailaddress;
    public $barangay;
    public $user_id;
    public $img;
    public $active;
    public $pool_id;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'view2';
        $this->TableName = 'view2';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`view2`";
        $this->Dbid = 'DB';
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

        // pool_name
        $this->pool_name = new DbField(
            'view2',
            'view2',
            'x_pool_name',
            'pool_name',
            '`pool_name`',
            '`pool_name`',
            200,
            50,
            -1,
            false,
            '`pool_name`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pool_name->InputTextType = "text";
        $this->pool_name->Required = true; // Required field
        $this->Fields['pool_name'] = &$this->pool_name;

        // pool_description
        $this->pool_description = new DbField(
            'view2',
            'view2',
            'x_pool_description',
            'pool_description',
            '`pool_description`',
            '`pool_description`',
            200,
            255,
            -1,
            false,
            '`pool_description`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->pool_description->InputTextType = "text";
        $this->pool_description->Required = true; // Required field
        $this->Fields['pool_description'] = &$this->pool_description;

        // poolcat
        $this->poolcat = new DbField(
            'view2',
            'view2',
            'x_poolcat',
            'poolcat',
            '`poolcat`',
            '`poolcat`',
            3,
            11,
            -1,
            false,
            '`poolcat`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->poolcat->InputTextType = "text";
        $this->poolcat->Required = true; // Required field
        $this->poolcat->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->poolcat->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->poolcat->Lookup = new Lookup('poolcat', 'view2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->poolcat->Lookup = new Lookup('poolcat', 'view2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->poolcat->OptionCount = 2;
        $this->poolcat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['poolcat'] = &$this->poolcat;

        // address
        $this->address = new DbField(
            'view2',
            'view2',
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
            'TEXTAREA'
        );
        $this->address->InputTextType = "text";
        $this->address->Required = true; // Required field
        $this->Fields['address'] = &$this->address;

        // contactno1
        $this->contactno1 = new DbField(
            'view2',
            'view2',
            'x_contactno1',
            'contactno1',
            '`contactno1`',
            '`contactno1`',
            200,
            50,
            -1,
            false,
            '`contactno1`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->contactno1->InputTextType = "text";
        $this->contactno1->Required = true; // Required field
        $this->Fields['contactno1'] = &$this->contactno1;

        // socmed
        $this->socmed = new DbField(
            'view2',
            'view2',
            'x_socmed',
            'socmed',
            '`socmed`',
            '`socmed`',
            200,
            255,
            -1,
            false,
            '`socmed`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->socmed->InputTextType = "text";
        $this->Fields['socmed'] = &$this->socmed;

        // emailaddress
        $this->emailaddress = new DbField(
            'view2',
            'view2',
            'x_emailaddress',
            'emailaddress',
            '`emailaddress`',
            '`emailaddress`',
            200,
            250,
            -1,
            false,
            '`emailaddress`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->emailaddress->InputTextType = "text";
        $this->emailaddress->Nullable = false; // NOT NULL field
        $this->emailaddress->Required = true; // Required field
        $this->Fields['emailaddress'] = &$this->emailaddress;

        // barangay
        $this->barangay = new DbField(
            'view2',
            'view2',
            'x_barangay',
            'barangay',
            '`barangay`',
            '`barangay`',
            200,
            50,
            -1,
            false,
            '`barangay`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->barangay->InputTextType = "text";
        $this->Fields['barangay'] = &$this->barangay;

        // user_id
        $this->user_id = new DbField(
            'view2',
            'view2',
            'x_user_id',
            'user_id',
            '`user_id`',
            '`user_id`',
            3,
            7,
            -1,
            false,
            '`user_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->user_id->InputTextType = "text";
        $this->user_id->Nullable = false; // NOT NULL field
        $this->user_id->Required = true; // Required field
        $this->user_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['user_id'] = &$this->user_id;

        // img
        $this->img = new DbField(
            'view2',
            'view2',
            'x_img',
            'img',
            '`img`',
            '`img`',
            205,
            0,
            -1,
            true,
            '`img`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->img->InputTextType = "text";
        $this->img->Nullable = false; // NOT NULL field
        $this->img->Required = true; // Required field
        $this->img->Sortable = false; // Allow sort
        $this->Fields['img'] = &$this->img;

        // active
        $this->active = new DbField(
            'view2',
            'view2',
            'x_active',
            'active',
            '`active`',
            '`active`',
            3,
            7,
            -1,
            false,
            '`active`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'CHECKBOX'
        );
        $this->active->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->active->Lookup = new Lookup('active', 'view2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->active->Lookup = new Lookup('active', 'view2', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->active->OptionCount = 1;
        $this->active->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['active'] = &$this->active;

        // pool_id
        $this->pool_id = new DbField(
            'view2',
            'view2',
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
            'NO'
        );
        $this->pool_id->InputTextType = "text";
        $this->pool_id->IsAutoIncrement = true; // Autoincrement field
        $this->pool_id->IsPrimaryKey = true; // Primary key field
        $this->pool_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pool_id'] = &$this->pool_id;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`view2`";
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
        $this->DefaultFilter = "";
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
            $this->pool_id->setDbValue($conn->lastInsertId());
            $rs['pool_id'] = $this->pool_id->DbValue;
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
            if (array_key_exists('pool_id', $rs)) {
                AddFilter($where, QuotedName('pool_id', $this->Dbid) . '=' . QuotedValue($rs['pool_id'], $this->pool_id->DataType, $this->Dbid));
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
        $this->pool_name->DbValue = $row['pool_name'];
        $this->pool_description->DbValue = $row['pool_description'];
        $this->poolcat->DbValue = $row['poolcat'];
        $this->address->DbValue = $row['address'];
        $this->contactno1->DbValue = $row['contactno1'];
        $this->socmed->DbValue = $row['socmed'];
        $this->emailaddress->DbValue = $row['emailaddress'];
        $this->barangay->DbValue = $row['barangay'];
        $this->user_id->DbValue = $row['user_id'];
        $this->img->Upload->DbValue = $row['img'];
        $this->active->DbValue = $row['active'];
        $this->pool_id->DbValue = $row['pool_id'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`pool_id` = @pool_id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->pool_id->CurrentValue : $this->pool_id->OldValue;
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
                $this->pool_id->CurrentValue = $keys[0];
            } else {
                $this->pool_id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('pool_id', $row) ? $row['pool_id'] : null;
        } else {
            $val = $this->pool_id->OldValue !== null ? $this->pool_id->OldValue : $this->pool_id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@pool_id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("View2List");
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
        if ($pageName == "View2View") {
            return $Language->phrase("View");
        } elseif ($pageName == "View2Edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "View2Add") {
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
                return "View2View";
            case Config("API_ADD_ACTION"):
                return "View2Add";
            case Config("API_EDIT_ACTION"):
                return "View2Edit";
            case Config("API_DELETE_ACTION"):
                return "View2Delete";
            case Config("API_LIST_ACTION"):
                return "View2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "View2List";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("View2View", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("View2View", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "View2Add?" . $this->getUrlParm($parm);
        } else {
            $url = "View2Add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("View2Edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("View2Add", $this->getUrlParm($parm));
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
        return $this->keyUrl("View2Delete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"pool_id\":" . JsonEncode($this->pool_id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->pool_id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->pool_id->CurrentValue);
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
            if (($keyValue = Param("pool_id") ?? Route("pool_id")) !== null) {
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
                $this->pool_id->CurrentValue = $key;
            } else {
                $this->pool_id->OldValue = $key;
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
        $this->pool_name->setDbValue($row['pool_name']);
        $this->pool_description->setDbValue($row['pool_description']);
        $this->poolcat->setDbValue($row['poolcat']);
        $this->address->setDbValue($row['address']);
        $this->contactno1->setDbValue($row['contactno1']);
        $this->socmed->setDbValue($row['socmed']);
        $this->emailaddress->setDbValue($row['emailaddress']);
        $this->barangay->setDbValue($row['barangay']);
        $this->user_id->setDbValue($row['user_id']);
        $this->img->Upload->DbValue = $row['img'];
        $this->active->setDbValue($row['active']);
        $this->pool_id->setDbValue($row['pool_id']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // pool_name

        // pool_description

        // poolcat

        // address

        // contactno1

        // socmed

        // emailaddress

        // barangay

        // user_id

        // img

        // active

        // pool_id

        // pool_name
        $this->pool_name->ViewValue = $this->pool_name->CurrentValue;
        $this->pool_name->ViewCustomAttributes = "";

        // pool_description
        $this->pool_description->ViewValue = $this->pool_description->CurrentValue;
        $this->pool_description->ViewCustomAttributes = "";

        // poolcat
        if (strval($this->poolcat->CurrentValue) != "") {
            $this->poolcat->ViewValue = $this->poolcat->optionCaption($this->poolcat->CurrentValue);
        } else {
            $this->poolcat->ViewValue = null;
        }
        $this->poolcat->ViewCustomAttributes = "";

        // address
        $this->address->ViewValue = $this->address->CurrentValue;
        $this->address->ViewCustomAttributes = "";

        // contactno1
        $this->contactno1->ViewValue = $this->contactno1->CurrentValue;
        $this->contactno1->ViewCustomAttributes = "";

        // socmed
        $this->socmed->ViewValue = $this->socmed->CurrentValue;
        $this->socmed->ViewCustomAttributes = "";

        // emailaddress
        $this->emailaddress->ViewValue = $this->emailaddress->CurrentValue;
        $this->emailaddress->ViewCustomAttributes = "";

        // barangay
        $this->barangay->ViewValue = $this->barangay->CurrentValue;
        $this->barangay->ViewCustomAttributes = "";

        // user_id
        $this->user_id->ViewValue = $this->user_id->CurrentValue;
        $this->user_id->ViewValue = FormatNumber($this->user_id->ViewValue, $this->user_id->formatPattern());
        $this->user_id->ViewCustomAttributes = "";

        // img
        if (!EmptyValue($this->img->Upload->DbValue)) {
            $this->img->ViewValue = $this->pool_id->CurrentValue;
            $this->img->IsBlobImage = IsImageFile(ContentExtension($this->img->Upload->DbValue));
        } else {
            $this->img->ViewValue = "";
        }
        $this->img->ViewCustomAttributes = "";

        // active
        if (strval($this->active->CurrentValue) != "") {
            $this->active->ViewValue = new OptionValues();
            $arwrk = explode(",", strval($this->active->CurrentValue));
            $cnt = count($arwrk);
            for ($ari = 0; $ari < $cnt; $ari++)
                $this->active->ViewValue->add($this->active->optionCaption(trim($arwrk[$ari])));
        } else {
            $this->active->ViewValue = null;
        }
        $this->active->ViewCustomAttributes = "";

        // pool_id
        $this->pool_id->ViewValue = $this->pool_id->CurrentValue;
        $this->pool_id->ViewCustomAttributes = "";

        // pool_name
        $this->pool_name->LinkCustomAttributes = "";
        $this->pool_name->HrefValue = "";
        $this->pool_name->TooltipValue = "";

        // pool_description
        $this->pool_description->LinkCustomAttributes = "";
        $this->pool_description->HrefValue = "";
        $this->pool_description->TooltipValue = "";

        // poolcat
        $this->poolcat->LinkCustomAttributes = "";
        $this->poolcat->HrefValue = "";
        $this->poolcat->TooltipValue = "";

        // address
        $this->address->LinkCustomAttributes = "";
        $this->address->HrefValue = "";
        $this->address->TooltipValue = "";

        // contactno1
        $this->contactno1->LinkCustomAttributes = "";
        $this->contactno1->HrefValue = "";
        $this->contactno1->TooltipValue = "";

        // socmed
        $this->socmed->LinkCustomAttributes = "";
        $this->socmed->HrefValue = "";
        $this->socmed->TooltipValue = "";

        // emailaddress
        $this->emailaddress->LinkCustomAttributes = "";
        $this->emailaddress->HrefValue = "";
        $this->emailaddress->TooltipValue = "";

        // barangay
        $this->barangay->LinkCustomAttributes = "";
        $this->barangay->HrefValue = "";
        $this->barangay->TooltipValue = "";

        // user_id
        $this->user_id->LinkCustomAttributes = "";
        $this->user_id->HrefValue = "";
        $this->user_id->TooltipValue = "";

        // img
        $this->img->LinkCustomAttributes = "";
        if (!empty($this->img->Upload->DbValue)) {
            $this->img->HrefValue = GetFileUploadUrl($this->img, $this->pool_id->CurrentValue);
            $this->img->LinkAttrs["target"] = "";
            if ($this->img->IsBlobImage && empty($this->img->LinkAttrs["target"])) {
                $this->img->LinkAttrs["target"] = "_blank";
            }
            if ($this->isExport()) {
                $this->img->HrefValue = FullUrl($this->img->HrefValue, "href");
            }
        } else {
            $this->img->HrefValue = "";
        }
        $this->img->ExportHrefValue = GetFileUploadUrl($this->img, $this->pool_id->CurrentValue);
        $this->img->TooltipValue = "";

        // active
        $this->active->LinkCustomAttributes = "";
        $this->active->HrefValue = "";
        $this->active->TooltipValue = "";

        // pool_id
        $this->pool_id->LinkCustomAttributes = "";
        $this->pool_id->HrefValue = "";
        $this->pool_id->TooltipValue = "";

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

        // pool_name
        $this->pool_name->setupEditAttributes();
        $this->pool_name->EditCustomAttributes = "";
        if (!$this->pool_name->Raw) {
            $this->pool_name->CurrentValue = HtmlDecode($this->pool_name->CurrentValue);
        }
        $this->pool_name->EditValue = $this->pool_name->CurrentValue;
        $this->pool_name->PlaceHolder = RemoveHtml($this->pool_name->caption());

        // pool_description
        $this->pool_description->setupEditAttributes();
        $this->pool_description->EditCustomAttributes = "";
        $this->pool_description->EditValue = $this->pool_description->CurrentValue;
        $this->pool_description->PlaceHolder = RemoveHtml($this->pool_description->caption());

        // poolcat
        $this->poolcat->setupEditAttributes();
        $this->poolcat->EditCustomAttributes = "";
        $this->poolcat->EditValue = $this->poolcat->options(true);
        $this->poolcat->PlaceHolder = RemoveHtml($this->poolcat->caption());

        // address
        $this->address->setupEditAttributes();
        $this->address->EditCustomAttributes = "";
        $this->address->EditValue = $this->address->CurrentValue;
        $this->address->PlaceHolder = RemoveHtml($this->address->caption());

        // contactno1
        $this->contactno1->setupEditAttributes();
        $this->contactno1->EditCustomAttributes = "";
        if (!$this->contactno1->Raw) {
            $this->contactno1->CurrentValue = HtmlDecode($this->contactno1->CurrentValue);
        }
        $this->contactno1->EditValue = $this->contactno1->CurrentValue;
        $this->contactno1->PlaceHolder = RemoveHtml($this->contactno1->caption());

        // socmed
        $this->socmed->setupEditAttributes();
        $this->socmed->EditCustomAttributes = "";
        if (!$this->socmed->Raw) {
            $this->socmed->CurrentValue = HtmlDecode($this->socmed->CurrentValue);
        }
        $this->socmed->EditValue = $this->socmed->CurrentValue;
        $this->socmed->PlaceHolder = RemoveHtml($this->socmed->caption());

        // emailaddress
        $this->emailaddress->setupEditAttributes();
        $this->emailaddress->EditCustomAttributes = "";
        if (!$this->emailaddress->Raw) {
            $this->emailaddress->CurrentValue = HtmlDecode($this->emailaddress->CurrentValue);
        }
        $this->emailaddress->EditValue = $this->emailaddress->CurrentValue;
        $this->emailaddress->PlaceHolder = RemoveHtml($this->emailaddress->caption());

        // barangay
        $this->barangay->setupEditAttributes();
        $this->barangay->EditCustomAttributes = "";
        if (!$this->barangay->Raw) {
            $this->barangay->CurrentValue = HtmlDecode($this->barangay->CurrentValue);
        }
        $this->barangay->EditValue = $this->barangay->CurrentValue;
        $this->barangay->PlaceHolder = RemoveHtml($this->barangay->caption());

        // user_id
        $this->user_id->setupEditAttributes();
        $this->user_id->EditCustomAttributes = "";
        $this->user_id->EditValue = $this->user_id->CurrentValue;
        $this->user_id->PlaceHolder = RemoveHtml($this->user_id->caption());
        if (strval($this->user_id->EditValue) != "" && is_numeric($this->user_id->EditValue)) {
            $this->user_id->EditValue = FormatNumber($this->user_id->EditValue, null);
        }

        // img
        $this->img->setupEditAttributes();
        $this->img->EditCustomAttributes = "";
        if (!EmptyValue($this->img->Upload->DbValue)) {
            $this->img->EditValue = $this->pool_id->CurrentValue;
            $this->img->IsBlobImage = IsImageFile(ContentExtension($this->img->Upload->DbValue));
        } else {
            $this->img->EditValue = "";
        }

        // active
        $this->active->EditCustomAttributes = "";
        $this->active->EditValue = $this->active->options(false);
        $this->active->PlaceHolder = RemoveHtml($this->active->caption());

        // pool_id
        $this->pool_id->setupEditAttributes();
        $this->pool_id->EditCustomAttributes = "";
        $this->pool_id->EditValue = $this->pool_id->CurrentValue;
        $this->pool_id->ViewCustomAttributes = "";

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
                    $doc->exportCaption($this->pool_name);
                    $doc->exportCaption($this->pool_description);
                    $doc->exportCaption($this->poolcat);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->contactno1);
                    $doc->exportCaption($this->socmed);
                    $doc->exportCaption($this->emailaddress);
                    $doc->exportCaption($this->barangay);
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->img);
                    $doc->exportCaption($this->active);
                    $doc->exportCaption($this->pool_id);
                } else {
                    $doc->exportCaption($this->pool_name);
                    $doc->exportCaption($this->pool_description);
                    $doc->exportCaption($this->poolcat);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->contactno1);
                    $doc->exportCaption($this->socmed);
                    $doc->exportCaption($this->emailaddress);
                    $doc->exportCaption($this->barangay);
                    $doc->exportCaption($this->user_id);
                    $doc->exportCaption($this->active);
                    $doc->exportCaption($this->pool_id);
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
                        $doc->exportField($this->pool_name);
                        $doc->exportField($this->pool_description);
                        $doc->exportField($this->poolcat);
                        $doc->exportField($this->address);
                        $doc->exportField($this->contactno1);
                        $doc->exportField($this->socmed);
                        $doc->exportField($this->emailaddress);
                        $doc->exportField($this->barangay);
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->img);
                        $doc->exportField($this->active);
                        $doc->exportField($this->pool_id);
                    } else {
                        $doc->exportField($this->pool_name);
                        $doc->exportField($this->pool_description);
                        $doc->exportField($this->poolcat);
                        $doc->exportField($this->address);
                        $doc->exportField($this->contactno1);
                        $doc->exportField($this->socmed);
                        $doc->exportField($this->emailaddress);
                        $doc->exportField($this->barangay);
                        $doc->exportField($this->user_id);
                        $doc->exportField($this->active);
                        $doc->exportField($this->pool_id);
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
        if ($fldparm == 'img') {
            $fldName = "img";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->pool_id->CurrentValue = $ar[0];
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
