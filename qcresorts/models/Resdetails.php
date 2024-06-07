<?php

namespace PHPMaker2023\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for resdetails
 */
class Resdetails extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $DbErrorMessage = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Ajax / Modal
    public $UseAjaxActions = false;
    public $ModalSearch = false;
    public $ModalView = false;
    public $ModalAdd = false;
    public $ModalEdit = false;
    public $ModalUpdate = true;
    public $InlineDelete = false;
    public $ModalGridAdd = false;
    public $ModalGridEdit = false;
    public $ModalMultiEdit = false;

    // Fields
    public $res_id;
    public $date;
    public $fname;
    public $lname;
    public $address;
    public $contactno;
    public $_email;
    public $pool_id;
    public $proofofpayment;
    public $rate_id;
    public $dateuploaded;
    public $uname;
    public $paymentamount;
    public $approved;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $CurrentLanguage, $CurrentLocale;

        // Language object
        $Language = Container("language");
        $this->TableVar = "resdetails";
        $this->TableName = 'resdetails';
        $this->TableType = "TABLE";
        $this->ImportUseTransaction = $this->supportsTransaction() && Config("IMPORT_USE_TRANSACTION");
        $this->UseTransaction = $this->supportsTransaction() && Config("USE_TRANSACTION");

        // Update Table
        $this->UpdateTable = "`resdetails`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)

        // PDF
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)

        // PhpSpreadsheet
        $this->ExportExcelPageOrientation = null; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = null; // Page size (PhpSpreadsheet only)

        // PHPWord
        $this->ExportWordPageOrientation = ""; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = ""; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UseAjaxActions = $this->UseAjaxActions || Config("USE_AJAX_ACTIONS");
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this);

        // res_id
        $this->res_id = new DbField(
            $this, // Table
            'x_res_id', // Variable name
            'res_id', // Name
            '`res_id`', // Expression
            '`res_id`', // Basic search expression
            3, // Type
            7, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`res_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'NO' // Edit Tag
        );
        $this->res_id->InputTextType = "text";
        $this->res_id->IsAutoIncrement = true; // Autoincrement field
        $this->res_id->IsPrimaryKey = true; // Primary key field
        $this->res_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->res_id->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN", "IS NULL", "IS NOT NULL"];
        $this->Fields['res_id'] = &$this->res_id;

        // date
        $this->date = new DbField(
            $this, // Table
            'x_date', // Variable name
            'date', // Name
            '`date`', // Expression
            CastDateFieldForLike("`date`", 0, "DB"), // Basic search expression
            133, // Type
            10, // Size
            0, // Date/Time format
            false, // Is upload field
            '`date`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->date->InputTextType = "text";
        $this->date->Nullable = false; // NOT NULL field
        $this->date->Required = true; // Required field
        $this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->date->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['date'] = &$this->date;

        // fname
        $this->fname = new DbField(
            $this, // Table
            'x_fname', // Variable name
            'fname', // Name
            '`fname`', // Expression
            '`fname`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`fname`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->fname->InputTextType = "text";
        $this->fname->Nullable = false; // NOT NULL field
        $this->fname->Required = true; // Required field
        $this->fname->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['fname'] = &$this->fname;

        // lname
        $this->lname = new DbField(
            $this, // Table
            'x_lname', // Variable name
            'lname', // Name
            '`lname`', // Expression
            '`lname`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`lname`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->lname->InputTextType = "text";
        $this->lname->Nullable = false; // NOT NULL field
        $this->lname->Required = true; // Required field
        $this->lname->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['lname'] = &$this->lname;

        // address
        $this->address = new DbField(
            $this, // Table
            'x_address', // Variable name
            'address', // Name
            '`address`', // Expression
            '`address`', // Basic search expression
            200, // Type
            255, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`address`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXTAREA' // Edit Tag
        );
        $this->address->InputTextType = "text";
        $this->address->Nullable = false; // NOT NULL field
        $this->address->Required = true; // Required field
        $this->address->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['address'] = &$this->address;

        // contactno
        $this->contactno = new DbField(
            $this, // Table
            'x_contactno', // Variable name
            'contactno', // Name
            '`contactno`', // Expression
            '`contactno`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`contactno`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->contactno->InputTextType = "text";
        $this->contactno->Nullable = false; // NOT NULL field
        $this->contactno->Required = true; // Required field
        $this->contactno->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['contactno'] = &$this->contactno;

        // email
        $this->_email = new DbField(
            $this, // Table
            'x__email', // Variable name
            'email', // Name
            '`email`', // Expression
            '`email`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`email`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->_email->InputTextType = "text";
        $this->_email->Nullable = false; // NOT NULL field
        $this->_email->Required = true; // Required field
        $this->_email->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['email'] = &$this->_email;

        // pool_id
        $this->pool_id = new DbField(
            $this, // Table
            'x_pool_id', // Variable name
            'pool_id', // Name
            '`pool_id`', // Expression
            '`pool_id`', // Basic search expression
            3, // Type
            7, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`pool_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->pool_id->InputTextType = "text";
        $this->pool_id->Nullable = false; // NOT NULL field
        $this->pool_id->Required = true; // Required field
        $this->pool_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->pool_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->pool_id->Lookup = new Lookup('pool_id', 'pool', false, 'pool_id', ["pool_name","","",""], '', '', [], ["x_rate_id"], [], [], [], [], '', '', "`pool_name`");
                break;
            default:
                $this->pool_id->Lookup = new Lookup('pool_id', 'pool', false, 'pool_id', ["pool_name","","",""], '', '', [], ["x_rate_id"], [], [], [], [], '', '', "`pool_name`");
                break;
        }
        $this->pool_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pool_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['pool_id'] = &$this->pool_id;

        // proofofpayment
        $this->proofofpayment = new DbField(
            $this, // Table
            'x_proofofpayment', // Variable name
            'proofofpayment', // Name
            '`proofofpayment`', // Expression
            '`proofofpayment`', // Basic search expression
            205, // Type
            0, // Size
            -1, // Date/Time format
            true, // Is upload field
            '`proofofpayment`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'IMAGE', // View Tag
            'FILE' // Edit Tag
        );
        $this->proofofpayment->InputTextType = "text";
        $this->proofofpayment->Nullable = false; // NOT NULL field
        $this->proofofpayment->Required = true; // Required field
        $this->proofofpayment->Sortable = false; // Allow sort
        $this->proofofpayment->ImageResize = true;
        $this->proofofpayment->SearchOperators = ["=", "<>"];
        $this->Fields['proofofpayment'] = &$this->proofofpayment;

        // rate_id
        $this->rate_id = new DbField(
            $this, // Table
            'x_rate_id', // Variable name
            'rate_id', // Name
            '`rate_id`', // Expression
            '`rate_id`', // Basic search expression
            3, // Type
            7, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`rate_id`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'SELECT' // Edit Tag
        );
        $this->rate_id->InputTextType = "text";
        $this->rate_id->Nullable = false; // NOT NULL field
        $this->rate_id->Required = true; // Required field
        $this->rate_id->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->rate_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->rate_id->Lookup = new Lookup('rate_id', 'poolrates', false, 'rateid', ["ratename","","",""], '', '', ["x_pool_id"], [], ["pool_id"], ["x_pool_id"], ["pool_id"], ["x_fname"], '', '', "`ratename`");
                break;
            default:
                $this->rate_id->Lookup = new Lookup('rate_id', 'poolrates', false, 'rateid', ["ratename","","",""], '', '', ["x_pool_id"], [], ["pool_id"], ["x_pool_id"], ["pool_id"], ["x_fname"], '', '', "`ratename`");
                break;
        }
        $this->rate_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rate_id->SearchOperators = ["=", "<>", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['rate_id'] = &$this->rate_id;

        // dateuploaded
        $this->dateuploaded = new DbField(
            $this, // Table
            'x_dateuploaded', // Variable name
            'dateuploaded', // Name
            '`dateuploaded`', // Expression
            '`dateuploaded`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`dateuploaded`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->dateuploaded->InputTextType = "text";
        $this->dateuploaded->Nullable = false; // NOT NULL field
        $this->dateuploaded->Required = true; // Required field
        $this->dateuploaded->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['dateuploaded'] = &$this->dateuploaded;

        // uname
        $this->uname = new DbField(
            $this, // Table
            'x_uname', // Variable name
            'uname', // Name
            '`uname`', // Expression
            '`uname`', // Basic search expression
            200, // Type
            50, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`uname`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->uname->InputTextType = "text";
        $this->uname->Nullable = false; // NOT NULL field
        $this->uname->Required = true; // Required field
        $this->uname->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['uname'] = &$this->uname;

        // paymentamount
        $this->paymentamount = new DbField(
            $this, // Table
            'x_paymentamount', // Variable name
            'paymentamount', // Name
            '`paymentamount`', // Expression
            '`paymentamount`', // Basic search expression
            200, // Type
            7, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`paymentamount`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->paymentamount->InputTextType = "text";
        $this->paymentamount->Nullable = false; // NOT NULL field
        $this->paymentamount->Required = true; // Required field
        $this->paymentamount->SearchOperators = ["=", "<>", "IN", "NOT IN", "STARTS WITH", "NOT STARTS WITH", "LIKE", "NOT LIKE", "ENDS WITH", "NOT ENDS WITH", "IS EMPTY", "IS NOT EMPTY"];
        $this->Fields['paymentamount'] = &$this->paymentamount;

        // approved
        $this->approved = new DbField(
            $this, // Table
            'x_approved', // Variable name
            'approved', // Name
            '`approved`', // Expression
            '`approved`', // Basic search expression
            3, // Type
            1, // Size
            -1, // Date/Time format
            false, // Is upload field
            '`approved`', // Virtual expression
            false, // Is virtual
            false, // Force selection
            false, // Is Virtual search
            'FORMATTED TEXT', // View Tag
            'TEXT' // Edit Tag
        );
        $this->approved->InputTextType = "text";
        $this->approved->Nullable = false; // NOT NULL field
        $this->approved->Required = true; // Required field
        $this->approved->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->approved->SearchOperators = ["=", "<>", "IN", "NOT IN", "<", "<=", ">", ">=", "BETWEEN", "NOT BETWEEN"];
        $this->Fields['approved'] = &$this->approved;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);

        // Call Table Load event
        $this->tableLoad();
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
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Render X Axis for chart
    public function renderChartXAxis($chartVar, $chartRow)
    {
        return $chartRow;
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
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
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
        return $this->getSqlAsQueryBuilder($where, $orderBy)->getSQL();
    }

    // Get QueryBuilder
    public function getSqlAsQueryBuilder($where, $orderBy = "")
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
        );
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
        try {
            $success = $this->insertSql($rs)->execute();
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }
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
        try {
            $success = $this->updateSql($rs, $where, $curfilter)->execute();
            $success = ($success > 0) ? $success : true;
            $this->DbErrorMessage = "";
        } catch (\Exception $e) {
            $success = false;
            $this->DbErrorMessage = $e->getMessage();
        }

        // Return auto increment field
        if ($success) {
            if (!isset($rs['res_id']) && !EmptyValue($this->res_id->CurrentValue)) {
                $rs['res_id'] = $this->res_id->CurrentValue;
            }
        }
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
            try {
                $success = $this->deleteSql($rs, $where, $curfilter)->execute();
                $this->DbErrorMessage = "";
            } catch (\Exception $e) {
                $success = false;
                $this->DbErrorMessage = $e->getMessage();
            }
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
        $this->date->DbValue = $row['date'];
        $this->fname->DbValue = $row['fname'];
        $this->lname->DbValue = $row['lname'];
        $this->address->DbValue = $row['address'];
        $this->contactno->DbValue = $row['contactno'];
        $this->_email->DbValue = $row['email'];
        $this->pool_id->DbValue = $row['pool_id'];
        $this->proofofpayment->Upload->DbValue = $row['proofofpayment'];
        $this->rate_id->DbValue = $row['rate_id'];
        $this->dateuploaded->DbValue = $row['dateuploaded'];
        $this->uname->DbValue = $row['uname'];
        $this->paymentamount->DbValue = $row['paymentamount'];
        $this->approved->DbValue = $row['approved'];
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
    public function getRecordFilter($row = null, $current = false)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('res_id', $row) ? $row['res_id'] : null;
        } else {
            $val = !EmptyValue($this->res_id->OldValue) && !$current ? $this->res_id->OldValue : $this->res_id->CurrentValue;
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
        return $_SESSION[$name] ?? GetUrl("ResdetailsList");
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
        if ($pageName == "ResdetailsView") {
            return $Language->phrase("View");
        } elseif ($pageName == "ResdetailsEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ResdetailsAdd") {
            return $Language->phrase("Add");
        }
        return "";
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "ResdetailsView";
            case Config("API_ADD_ACTION"):
                return "ResdetailsAdd";
            case Config("API_EDIT_ACTION"):
                return "ResdetailsEdit";
            case Config("API_DELETE_ACTION"):
                return "ResdetailsDelete";
            case Config("API_LIST_ACTION"):
                return "ResdetailsList";
            default:
                return "";
        }
    }

    // Current URL
    public function getCurrentUrl($parm = "")
    {
        $url = CurrentPageUrl(false);
        if ($parm != "") {
            $url = $this->keyUrl($url, $parm);
        } else {
            $url = $this->keyUrl($url, Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // List URL
    public function getListUrl()
    {
        return "ResdetailsList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ResdetailsView", $parm);
        } else {
            $url = $this->keyUrl("ResdetailsView", Config("TABLE_SHOW_DETAIL") . "=");
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ResdetailsAdd?" . $parm;
        } else {
            $url = "ResdetailsAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ResdetailsEdit", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl("ResdetailsList", "action=edit");
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("ResdetailsAdd", $parm);
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl("ResdetailsList", "action=copy");
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        if ($this->UseAjaxActions && ConvertToBool(Param("infinitescroll")) && CurrentPageID() == "list") {
            return $this->keyUrl(GetApiUrl(Config("API_DELETE_ACTION") . "/" . $this->TableVar));
        } else {
            return $this->keyUrl("ResdetailsDelete");
        }
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
        global $Security, $Language, $Page;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-ew-action="sort" data-ajax="' . ($this->UseAjaxActions ? "true" : "false") . '" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
            if ($this->ContextClass) { // Add context
                $attrs .= ' data-context="' . HtmlEncode($this->ContextClass) . '"';
            }
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
        global $DashboardReport;
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = "order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort();
            if ($DashboardReport) {
                $urlParm .= "&amp;dashboard=true";
            }
            return $this->addMasterUrl($this->CurrentPageName . "?" . $urlParm);
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

    // Get filter from records
    public function getFilterFromRecords($rows)
    {
        $keyFilter = "";
        foreach ($rows as $row) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter($row) . ")";
        }
        return $keyFilter;
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
        $this->date->setDbValue($row['date']);
        $this->fname->setDbValue($row['fname']);
        $this->lname->setDbValue($row['lname']);
        $this->address->setDbValue($row['address']);
        $this->contactno->setDbValue($row['contactno']);
        $this->_email->setDbValue($row['email']);
        $this->pool_id->setDbValue($row['pool_id']);
        $this->proofofpayment->Upload->DbValue = $row['proofofpayment'];
        $this->rate_id->setDbValue($row['rate_id']);
        $this->dateuploaded->setDbValue($row['dateuploaded']);
        $this->uname->setDbValue($row['uname']);
        $this->paymentamount->setDbValue($row['paymentamount']);
        $this->approved->setDbValue($row['approved']);
    }

    // Render list content
    public function renderListContent($filter)
    {
        global $Response;
        $listPage = "ResdetailsList";
        $listClass = PROJECT_NAMESPACE . $listPage;
        $page = new $listClass();
        $page->loadRecordsetFromFilter($filter);
        $view = Container("view");
        $template = $listPage . ".php"; // View
        $GLOBALS["Title"] ??= $page->Title; // Title
        try {
            $Response = $view->render($Response, $template, $GLOBALS);
        } finally {
            $page->terminate(); // Terminate page and clean up
        }
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // res_id

        // date

        // fname

        // lname

        // address

        // contactno

        // email

        // pool_id

        // proofofpayment

        // rate_id

        // dateuploaded

        // uname

        // paymentamount

        // approved

        // res_id
        $this->res_id->ViewValue = $this->res_id->CurrentValue;

        // date
        $this->date->ViewValue = $this->date->CurrentValue;
        $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());

        // fname
        $this->fname->ViewValue = $this->fname->CurrentValue;

        // lname
        $this->lname->ViewValue = $this->lname->CurrentValue;

        // address
        $this->address->ViewValue = $this->address->CurrentValue;

        // contactno
        $this->contactno->ViewValue = $this->contactno->CurrentValue;

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;

        // pool_id
        $curVal = strval($this->pool_id->CurrentValue);
        if ($curVal != "") {
            $this->pool_id->ViewValue = $this->pool_id->lookupCacheOption($curVal);
            if ($this->pool_id->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter("`pool_id`", "=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->pool_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->pool_id->Lookup->renderViewRow($rswrk[0]);
                    $this->pool_id->ViewValue = $this->pool_id->displayValue($arwrk);
                } else {
                    $this->pool_id->ViewValue = FormatNumber($this->pool_id->CurrentValue, $this->pool_id->formatPattern());
                }
            }
        } else {
            $this->pool_id->ViewValue = null;
        }

        // proofofpayment
        if (!EmptyValue($this->proofofpayment->Upload->DbValue)) {
            $this->proofofpayment->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
            $this->proofofpayment->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
            $this->proofofpayment->ImageAlt = $this->proofofpayment->alt();
            $this->proofofpayment->ImageCssClass = "ew-image";
            $this->proofofpayment->ViewValue = $this->res_id->CurrentValue;
            $this->proofofpayment->IsBlobImage = IsImageFile(ContentExtension($this->proofofpayment->Upload->DbValue));
        } else {
            $this->proofofpayment->ViewValue = "";
        }

        // rate_id
        $curVal = strval($this->rate_id->CurrentValue);
        if ($curVal != "") {
            $this->rate_id->ViewValue = $this->rate_id->lookupCacheOption($curVal);
            if ($this->rate_id->ViewValue === null) { // Lookup from database
                $filterWrk = SearchFilter("`rateid`", "=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->rate_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->rate_id->Lookup->renderViewRow($rswrk[0]);
                    $this->rate_id->ViewValue = $this->rate_id->displayValue($arwrk);
                } else {
                    $this->rate_id->ViewValue = FormatNumber($this->rate_id->CurrentValue, $this->rate_id->formatPattern());
                }
            }
        } else {
            $this->rate_id->ViewValue = null;
        }

        // dateuploaded
        $this->dateuploaded->ViewValue = $this->dateuploaded->CurrentValue;

        // uname
        $this->uname->ViewValue = $this->uname->CurrentValue;

        // paymentamount
        $this->paymentamount->ViewValue = $this->paymentamount->CurrentValue;

        // approved
        $this->approved->ViewValue = $this->approved->CurrentValue;
        $this->approved->ViewValue = FormatNumber($this->approved->ViewValue, $this->approved->formatPattern());

        // res_id
        $this->res_id->HrefValue = "";
        $this->res_id->TooltipValue = "";

        // date
        $this->date->HrefValue = "";
        $this->date->TooltipValue = "";

        // fname
        $this->fname->HrefValue = "";
        $this->fname->TooltipValue = "";

        // lname
        $this->lname->HrefValue = "";
        $this->lname->TooltipValue = "";

        // address
        $this->address->HrefValue = "";
        $this->address->TooltipValue = "";

        // contactno
        $this->contactno->HrefValue = "";
        $this->contactno->TooltipValue = "";

        // email
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // pool_id
        $this->pool_id->HrefValue = "";
        $this->pool_id->TooltipValue = "";

        // proofofpayment
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
        if ($this->proofofpayment->UseColorbox) {
            if (EmptyValue($this->proofofpayment->TooltipValue)) {
                $this->proofofpayment->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->proofofpayment->LinkAttrs["data-rel"] = "resdetails_x_proofofpayment";
            $this->proofofpayment->LinkAttrs->appendClass("ew-lightbox");
        }

        // rate_id
        $this->rate_id->HrefValue = "";
        $this->rate_id->TooltipValue = "";

        // dateuploaded
        $this->dateuploaded->HrefValue = "";
        $this->dateuploaded->TooltipValue = "";

        // uname
        $this->uname->HrefValue = "";
        $this->uname->TooltipValue = "";

        // paymentamount
        $this->paymentamount->HrefValue = "";
        $this->paymentamount->TooltipValue = "";

        // approved
        $this->approved->HrefValue = "";
        $this->approved->TooltipValue = "";

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
        $this->res_id->EditValue = $this->res_id->CurrentValue;

        // date
        $this->date->setupEditAttributes();
        $this->date->EditValue = FormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->date->PlaceHolder = RemoveHtml($this->date->caption());

        // fname
        $this->fname->setupEditAttributes();
        if (!$this->fname->Raw) {
            $this->fname->CurrentValue = HtmlDecode($this->fname->CurrentValue);
        }
        $this->fname->EditValue = $this->fname->CurrentValue;
        $this->fname->PlaceHolder = RemoveHtml($this->fname->caption());

        // lname
        $this->lname->setupEditAttributes();
        if (!$this->lname->Raw) {
            $this->lname->CurrentValue = HtmlDecode($this->lname->CurrentValue);
        }
        $this->lname->EditValue = $this->lname->CurrentValue;
        $this->lname->PlaceHolder = RemoveHtml($this->lname->caption());

        // address
        $this->address->setupEditAttributes();
        $this->address->EditValue = $this->address->CurrentValue;
        $this->address->PlaceHolder = RemoveHtml($this->address->caption());

        // contactno
        $this->contactno->setupEditAttributes();
        if (!$this->contactno->Raw) {
            $this->contactno->CurrentValue = HtmlDecode($this->contactno->CurrentValue);
        }
        $this->contactno->EditValue = $this->contactno->CurrentValue;
        $this->contactno->PlaceHolder = RemoveHtml($this->contactno->caption());

        // email
        $this->_email->setupEditAttributes();
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // pool_id
        $this->pool_id->setupEditAttributes();
        $this->pool_id->PlaceHolder = RemoveHtml($this->pool_id->caption());

        // proofofpayment
        $this->proofofpayment->setupEditAttributes();
        if (!EmptyValue($this->proofofpayment->Upload->DbValue)) {
            $this->proofofpayment->ImageWidth = Config("THUMBNAIL_DEFAULT_WIDTH");
            $this->proofofpayment->ImageHeight = Config("THUMBNAIL_DEFAULT_HEIGHT");
            $this->proofofpayment->ImageAlt = $this->proofofpayment->alt();
            $this->proofofpayment->ImageCssClass = "ew-image";
            $this->proofofpayment->EditValue = $this->res_id->CurrentValue;
            $this->proofofpayment->IsBlobImage = IsImageFile(ContentExtension($this->proofofpayment->Upload->DbValue));
        } else {
            $this->proofofpayment->EditValue = "";
        }

        // rate_id
        $this->rate_id->setupEditAttributes();
        $this->rate_id->PlaceHolder = RemoveHtml($this->rate_id->caption());

        // dateuploaded
        $this->dateuploaded->setupEditAttributes();
        if (!$this->dateuploaded->Raw) {
            $this->dateuploaded->CurrentValue = HtmlDecode($this->dateuploaded->CurrentValue);
        }
        $this->dateuploaded->EditValue = $this->dateuploaded->CurrentValue;
        $this->dateuploaded->PlaceHolder = RemoveHtml($this->dateuploaded->caption());

        // uname
        $this->uname->setupEditAttributes();
        if (!$this->uname->Raw) {
            $this->uname->CurrentValue = HtmlDecode($this->uname->CurrentValue);
        }
        $this->uname->EditValue = $this->uname->CurrentValue;
        $this->uname->PlaceHolder = RemoveHtml($this->uname->caption());

        // paymentamount
        $this->paymentamount->setupEditAttributes();
        if (!$this->paymentamount->Raw) {
            $this->paymentamount->CurrentValue = HtmlDecode($this->paymentamount->CurrentValue);
        }
        $this->paymentamount->EditValue = $this->paymentamount->CurrentValue;
        $this->paymentamount->PlaceHolder = RemoveHtml($this->paymentamount->caption());

        // approved
        $this->approved->setupEditAttributes();
        $this->approved->EditValue = $this->approved->CurrentValue;
        $this->approved->PlaceHolder = RemoveHtml($this->approved->caption());
        if (strval($this->approved->EditValue) != "" && is_numeric($this->approved->EditValue)) {
            $this->approved->EditValue = FormatNumber($this->approved->EditValue, null);
        }

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
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->fname);
                    $doc->exportCaption($this->lname);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->contactno);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->pool_id);
                    $doc->exportCaption($this->proofofpayment);
                    $doc->exportCaption($this->rate_id);
                    $doc->exportCaption($this->dateuploaded);
                    $doc->exportCaption($this->uname);
                    $doc->exportCaption($this->paymentamount);
                    $doc->exportCaption($this->approved);
                } else {
                    $doc->exportCaption($this->res_id);
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->fname);
                    $doc->exportCaption($this->lname);
                    $doc->exportCaption($this->address);
                    $doc->exportCaption($this->contactno);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->pool_id);
                    $doc->exportCaption($this->rate_id);
                    $doc->exportCaption($this->dateuploaded);
                    $doc->exportCaption($this->uname);
                    $doc->exportCaption($this->paymentamount);
                    $doc->exportCaption($this->approved);
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
                        $doc->exportField($this->date);
                        $doc->exportField($this->fname);
                        $doc->exportField($this->lname);
                        $doc->exportField($this->address);
                        $doc->exportField($this->contactno);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->pool_id);
                        $doc->exportField($this->proofofpayment);
                        $doc->exportField($this->rate_id);
                        $doc->exportField($this->dateuploaded);
                        $doc->exportField($this->uname);
                        $doc->exportField($this->paymentamount);
                        $doc->exportField($this->approved);
                    } else {
                        $doc->exportField($this->res_id);
                        $doc->exportField($this->date);
                        $doc->exportField($this->fname);
                        $doc->exportField($this->lname);
                        $doc->exportField($this->address);
                        $doc->exportField($this->contactno);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->pool_id);
                        $doc->exportField($this->rate_id);
                        $doc->exportField($this->dateuploaded);
                        $doc->exportField($this->uname);
                        $doc->exportField($this->paymentamount);
                        $doc->exportField($this->approved);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($doc, $row);
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
        global $DownloadFileName;
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
                        $ext = strtolower($pathinfo["extension"] ?? "");
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
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
                    if ($fld->hasMethod("getUploadPath")) { // Check field level upload path
                        $fld->UploadPath = $fld->getUploadPath();
                    }
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

    // Table Load event
    public function tableLoad()
    {
        // Enter your code here
    }

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
