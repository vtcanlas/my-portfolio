<?php

namespace PHPMaker2023\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PoolratesAdd extends Poolrates
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "PoolratesAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "PoolratesAdd";

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        return rtrim(UrlFor($route->getName(), $args), "/") . "?";
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Constructor
    public function __construct()
    {
        parent::__construct();
        global $Language, $DashboardReport, $DebugTimer, $UserTable;
        $this->TableVar = 'poolrates';
        $this->TableName = 'poolrates';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (poolrates)
        if (!isset($GLOBALS["poolrates"]) || get_class($GLOBALS["poolrates"]) == PROJECT_NAMESPACE . "poolrates") {
            $GLOBALS["poolrates"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'poolrates');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] ??= $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents(): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

        // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show response for API
                $ar = array_merge($this->getMessages(), $url ? ["url" => GetUrl($url)] : []);
                WriteJson($ar);
            }
            $this->clearMessages(); // Clear messages for API request
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response (Assume return to modal for simplicity)
            if ($this->IsModal) { // Show as modal
                $result = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page => View page
                    $result["caption"] = $this->getModalCaption($pageName);
                    $result["view"] = $pageName == "PoolratesView"; // If View page, no primary button
                } else { // List page
                    // $result["list"] = $this->PageID == "search"; // Refresh List page if current page is Search page
                    $result["error"] = $this->getFailureMessage(); // List page should not be shown as modal => error
                    $this->clearFailureMessage();
                }
                WriteJson($result);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['rateid'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->rateid->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;
        $name = $ar["name"] ?? Post("name");
        $isQuery = ContainsString($name, "query_builder_rule");
        if ($isQuery) {
            $lookup->FilterFields = []; // Skip parent fields if any
        }

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $CopyRecord;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $UserProfile, $Language, $Security, $CurrentForm, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = ConvertToBool(Param("modal"));
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param(Config("PAGE_LAYOUT"), true));

        // View
        $this->View = Get(Config("VIEW"));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->rateid->Visible = false;
        $this->ratename->setVisibility();
        $this->ratedesc->setVisibility();
        $this->rateprice->setVisibility();
        $this->ratearrivaltime->setVisibility();
        $this->ratedeparturetime->setVisibility();
        $this->pool_id->setVisibility();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Hide fields for add/edit
        if (!$this->UseAjaxActions) {
            $this->hideFieldsForAddEdit();
        }
        // Use inline delete
        if ($this->UseAjaxActions) {
            $this->InlineDelete = true;
        }

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action", "") !== "") {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("rateid") ?? Route("rateid")) !== null) {
                $this->rateid->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record or default values
        $rsold = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: Must be after loadOldRecord to prevent master key values being overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$rsold) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("PoolratesList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($rsold)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "PoolratesList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PoolratesView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "PoolratesList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "PoolratesList"; // Return list page content
                        }
                    }
                    if (IsJsonResponse()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->IsModal && $this->UseAjaxActions) { // Return JSON error message
                    WriteJson([ "success" => false, "error" => $this->getFailureMessage() ]);
                    $this->clearFailureMessage();
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'ratename' first before field var 'x_ratename'
        $val = $CurrentForm->hasValue("ratename") ? $CurrentForm->getValue("ratename") : $CurrentForm->getValue("x_ratename");
        if (!$this->ratename->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ratename->Visible = false; // Disable update for API request
            } else {
                $this->ratename->setFormValue($val);
            }
        }

        // Check field name 'ratedesc' first before field var 'x_ratedesc'
        $val = $CurrentForm->hasValue("ratedesc") ? $CurrentForm->getValue("ratedesc") : $CurrentForm->getValue("x_ratedesc");
        if (!$this->ratedesc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ratedesc->Visible = false; // Disable update for API request
            } else {
                $this->ratedesc->setFormValue($val);
            }
        }

        // Check field name 'rateprice' first before field var 'x_rateprice'
        $val = $CurrentForm->hasValue("rateprice") ? $CurrentForm->getValue("rateprice") : $CurrentForm->getValue("x_rateprice");
        if (!$this->rateprice->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rateprice->Visible = false; // Disable update for API request
            } else {
                $this->rateprice->setFormValue($val);
            }
        }

        // Check field name 'ratearrivaltime' first before field var 'x_ratearrivaltime'
        $val = $CurrentForm->hasValue("ratearrivaltime") ? $CurrentForm->getValue("ratearrivaltime") : $CurrentForm->getValue("x_ratearrivaltime");
        if (!$this->ratearrivaltime->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ratearrivaltime->Visible = false; // Disable update for API request
            } else {
                $this->ratearrivaltime->setFormValue($val);
            }
        }

        // Check field name 'ratedeparturetime' first before field var 'x_ratedeparturetime'
        $val = $CurrentForm->hasValue("ratedeparturetime") ? $CurrentForm->getValue("ratedeparturetime") : $CurrentForm->getValue("x_ratedeparturetime");
        if (!$this->ratedeparturetime->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ratedeparturetime->Visible = false; // Disable update for API request
            } else {
                $this->ratedeparturetime->setFormValue($val);
            }
        }

        // Check field name 'pool_id' first before field var 'x_pool_id'
        $val = $CurrentForm->hasValue("pool_id") ? $CurrentForm->getValue("pool_id") : $CurrentForm->getValue("x_pool_id");
        if (!$this->pool_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pool_id->Visible = false; // Disable update for API request
            } else {
                $this->pool_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'rateid' first before field var 'x_rateid'
        $val = $CurrentForm->hasValue("rateid") ? $CurrentForm->getValue("rateid") : $CurrentForm->getValue("x_rateid");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->ratename->CurrentValue = $this->ratename->FormValue;
        $this->ratedesc->CurrentValue = $this->ratedesc->FormValue;
        $this->rateprice->CurrentValue = $this->rateprice->FormValue;
        $this->ratearrivaltime->CurrentValue = $this->ratearrivaltime->FormValue;
        $this->ratedeparturetime->CurrentValue = $this->ratedeparturetime->FormValue;
        $this->pool_id->CurrentValue = $this->pool_id->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->rateid->setDbValue($row['rateid']);
        $this->ratename->setDbValue($row['ratename']);
        $this->ratedesc->setDbValue($row['ratedesc']);
        $this->rateprice->setDbValue($row['rateprice']);
        $this->ratearrivaltime->setDbValue($row['ratearrivaltime']);
        $this->ratedeparturetime->setDbValue($row['ratedeparturetime']);
        $this->pool_id->setDbValue($row['pool_id']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['rateid'] = $this->rateid->DefaultValue;
        $row['ratename'] = $this->ratename->DefaultValue;
        $row['ratedesc'] = $this->ratedesc->DefaultValue;
        $row['rateprice'] = $this->rateprice->DefaultValue;
        $row['ratearrivaltime'] = $this->ratearrivaltime->DefaultValue;
        $row['ratedeparturetime'] = $this->ratedeparturetime->DefaultValue;
        $row['pool_id'] = $this->pool_id->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        if ($this->OldKey != "") {
            $this->setKey($this->OldKey);
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            if ($rs && ($row = $rs->fields)) {
                $this->loadRowValues($row); // Load row values
                return $row;
            }
        }
        $this->loadRowValues(); // Load default row values
        return null;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // rateid
        $this->rateid->RowCssClass = "row";

        // ratename
        $this->ratename->RowCssClass = "row";

        // ratedesc
        $this->ratedesc->RowCssClass = "row";

        // rateprice
        $this->rateprice->RowCssClass = "row";

        // ratearrivaltime
        $this->ratearrivaltime->RowCssClass = "row";

        // ratedeparturetime
        $this->ratedeparturetime->RowCssClass = "row";

        // pool_id
        $this->pool_id->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // rateid
            $this->rateid->ViewValue = $this->rateid->CurrentValue;

            // ratename
            $this->ratename->ViewValue = $this->ratename->CurrentValue;

            // ratedesc
            $this->ratedesc->ViewValue = $this->ratedesc->CurrentValue;

            // rateprice
            $this->rateprice->ViewValue = $this->rateprice->CurrentValue;

            // ratearrivaltime
            $this->ratearrivaltime->ViewValue = $this->ratearrivaltime->CurrentValue;

            // ratedeparturetime
            $this->ratedeparturetime->ViewValue = $this->ratedeparturetime->CurrentValue;

            // pool_id
            $this->pool_id->ViewValue = $this->pool_id->CurrentValue;
            $this->pool_id->ViewValue = FormatNumber($this->pool_id->ViewValue, $this->pool_id->formatPattern());

            // ratename
            $this->ratename->HrefValue = "";

            // ratedesc
            $this->ratedesc->HrefValue = "";

            // rateprice
            $this->rateprice->HrefValue = "";

            // ratearrivaltime
            $this->ratearrivaltime->HrefValue = "";

            // ratedeparturetime
            $this->ratedeparturetime->HrefValue = "";

            // pool_id
            $this->pool_id->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // ratename
            $this->ratename->setupEditAttributes();
            if (!$this->ratename->Raw) {
                $this->ratename->CurrentValue = HtmlDecode($this->ratename->CurrentValue);
            }
            $this->ratename->EditValue = HtmlEncode($this->ratename->CurrentValue);
            $this->ratename->PlaceHolder = RemoveHtml($this->ratename->caption());

            // ratedesc
            $this->ratedesc->setupEditAttributes();
            $this->ratedesc->EditValue = HtmlEncode($this->ratedesc->CurrentValue);
            $this->ratedesc->PlaceHolder = RemoveHtml($this->ratedesc->caption());

            // rateprice
            $this->rateprice->setupEditAttributes();
            if (!$this->rateprice->Raw) {
                $this->rateprice->CurrentValue = HtmlDecode($this->rateprice->CurrentValue);
            }
            $this->rateprice->EditValue = HtmlEncode($this->rateprice->CurrentValue);
            $this->rateprice->PlaceHolder = RemoveHtml($this->rateprice->caption());

            // ratearrivaltime
            $this->ratearrivaltime->setupEditAttributes();
            if (!$this->ratearrivaltime->Raw) {
                $this->ratearrivaltime->CurrentValue = HtmlDecode($this->ratearrivaltime->CurrentValue);
            }
            $this->ratearrivaltime->EditValue = HtmlEncode($this->ratearrivaltime->CurrentValue);
            $this->ratearrivaltime->PlaceHolder = RemoveHtml($this->ratearrivaltime->caption());

            // ratedeparturetime
            $this->ratedeparturetime->setupEditAttributes();
            if (!$this->ratedeparturetime->Raw) {
                $this->ratedeparturetime->CurrentValue = HtmlDecode($this->ratedeparturetime->CurrentValue);
            }
            $this->ratedeparturetime->EditValue = HtmlEncode($this->ratedeparturetime->CurrentValue);
            $this->ratedeparturetime->PlaceHolder = RemoveHtml($this->ratedeparturetime->caption());

            // pool_id
            $this->pool_id->setupEditAttributes();
            if ($this->pool_id->getSessionValue() != "") {
                $this->pool_id->CurrentValue = GetForeignKeyValue($this->pool_id->getSessionValue());
                $this->pool_id->ViewValue = $this->pool_id->CurrentValue;
                $this->pool_id->ViewValue = FormatNumber($this->pool_id->ViewValue, $this->pool_id->formatPattern());
            } else {
                $this->pool_id->EditValue = HtmlEncode($this->pool_id->CurrentValue);
                $this->pool_id->PlaceHolder = RemoveHtml($this->pool_id->caption());
                if (strval($this->pool_id->EditValue) != "" && is_numeric($this->pool_id->EditValue)) {
                    $this->pool_id->EditValue = FormatNumber($this->pool_id->EditValue, null);
                }
            }

            // Add refer script

            // ratename
            $this->ratename->HrefValue = "";

            // ratedesc
            $this->ratedesc->HrefValue = "";

            // rateprice
            $this->rateprice->HrefValue = "";

            // ratearrivaltime
            $this->ratearrivaltime->HrefValue = "";

            // ratedeparturetime
            $this->ratedeparturetime->HrefValue = "";

            // pool_id
            $this->pool_id->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language, $Security;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->ratename->Required) {
            if (!$this->ratename->IsDetailKey && EmptyValue($this->ratename->FormValue)) {
                $this->ratename->addErrorMessage(str_replace("%s", $this->ratename->caption(), $this->ratename->RequiredErrorMessage));
            }
        }
        if ($this->ratedesc->Required) {
            if (!$this->ratedesc->IsDetailKey && EmptyValue($this->ratedesc->FormValue)) {
                $this->ratedesc->addErrorMessage(str_replace("%s", $this->ratedesc->caption(), $this->ratedesc->RequiredErrorMessage));
            }
        }
        if ($this->rateprice->Required) {
            if (!$this->rateprice->IsDetailKey && EmptyValue($this->rateprice->FormValue)) {
                $this->rateprice->addErrorMessage(str_replace("%s", $this->rateprice->caption(), $this->rateprice->RequiredErrorMessage));
            }
        }
        if ($this->ratearrivaltime->Required) {
            if (!$this->ratearrivaltime->IsDetailKey && EmptyValue($this->ratearrivaltime->FormValue)) {
                $this->ratearrivaltime->addErrorMessage(str_replace("%s", $this->ratearrivaltime->caption(), $this->ratearrivaltime->RequiredErrorMessage));
            }
        }
        if ($this->ratedeparturetime->Required) {
            if (!$this->ratedeparturetime->IsDetailKey && EmptyValue($this->ratedeparturetime->FormValue)) {
                $this->ratedeparturetime->addErrorMessage(str_replace("%s", $this->ratedeparturetime->caption(), $this->ratedeparturetime->RequiredErrorMessage));
            }
        }
        if ($this->pool_id->Required) {
            if (!$this->pool_id->IsDetailKey && EmptyValue($this->pool_id->FormValue)) {
                $this->pool_id->addErrorMessage(str_replace("%s", $this->pool_id->caption(), $this->pool_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pool_id->FormValue)) {
            $this->pool_id->addErrorMessage($this->pool_id->getErrorMessage(false));
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // ratename
        $this->ratename->setDbValueDef($rsnew, $this->ratename->CurrentValue, "", false);

        // ratedesc
        $this->ratedesc->setDbValueDef($rsnew, $this->ratedesc->CurrentValue, "", false);

        // rateprice
        $this->rateprice->setDbValueDef($rsnew, $this->rateprice->CurrentValue, "", false);

        // ratearrivaltime
        $this->ratearrivaltime->setDbValueDef($rsnew, $this->ratearrivaltime->CurrentValue, "", false);

        // ratedeparturetime
        $this->ratedeparturetime->setDbValueDef($rsnew, $this->ratedeparturetime->CurrentValue, "", false);

        // pool_id
        $this->pool_id->setDbValueDef($rsnew, $this->pool_id->CurrentValue, 0, false);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'poolrates'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pool_id"] = $this->pool_id->CurrentValue;
        $masterTable = Container("tbl_resort_details");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "tbl_resort_details", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            } elseif (!EmptyValue($this->DbErrorMessage)) { // Show database error
                $this->setFailureMessage($this->DbErrorMessage);
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_ADD_ACTION"), $table => $row]);
        }
        return $addRow;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        $foreignKeys = [];
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "tbl_resort_details") {
                $validMaster = true;
                $masterTbl = Container("tbl_resort_details");
                if (($parm = Get("fk_pool_id", Get("pool_id"))) !== null) {
                    $masterTbl->pool_id->setQueryStringValue($parm);
                    $this->pool_id->QueryStringValue = $masterTbl->pool_id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->pool_id->setSessionValue($this->pool_id->QueryStringValue);
                    $foreignKeys["pool_id"] = $this->pool_id->QueryStringValue;
                    if (!is_numeric($masterTbl->pool_id->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "pool") {
                $validMaster = true;
                $masterTbl = Container("pool");
                if (($parm = Get("fk_pool_id", Get("pool_id"))) !== null) {
                    $masterTbl->pool_id->setQueryStringValue($parm);
                    $this->pool_id->QueryStringValue = $masterTbl->pool_id->QueryStringValue; // DO NOT change, master/detail key data type can be different
                    $this->pool_id->setSessionValue($this->pool_id->QueryStringValue);
                    $foreignKeys["pool_id"] = $this->pool_id->QueryStringValue;
                    if (!is_numeric($masterTbl->pool_id->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "tbl_resort_details") {
                $validMaster = true;
                $masterTbl = Container("tbl_resort_details");
                if (($parm = Post("fk_pool_id", Post("pool_id"))) !== null) {
                    $masterTbl->pool_id->setFormValue($parm);
                    $this->pool_id->FormValue = $masterTbl->pool_id->FormValue;
                    $this->pool_id->setSessionValue($this->pool_id->FormValue);
                    $foreignKeys["pool_id"] = $this->pool_id->FormValue;
                    if (!is_numeric($masterTbl->pool_id->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
            if ($masterTblVar == "pool") {
                $validMaster = true;
                $masterTbl = Container("pool");
                if (($parm = Post("fk_pool_id", Post("pool_id"))) !== null) {
                    $masterTbl->pool_id->setFormValue($parm);
                    $this->pool_id->FormValue = $masterTbl->pool_id->FormValue;
                    $this->pool_id->setSessionValue($this->pool_id->FormValue);
                    $foreignKeys["pool_id"] = $this->pool_id->FormValue;
                    if (!is_numeric($masterTbl->pool_id->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "tbl_resort_details") {
                if (!array_key_exists("pool_id", $foreignKeys)) { // Not current foreign key
                    $this->pool_id->setSessionValue("");
                }
            }
            if ($masterTblVar != "pool") {
                if (!array_key_exists("pool_id", $foreignKeys)) { // Not current foreign key
                    $this->pool_id->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PoolratesList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0 && count($fld->Lookup->FilterFields) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $key = $row["lf"];
                    if (IsFloatType($fld->Type)) { // Handle float field
                        $key = (float)$key;
                    }
                    $ar[strval($key)] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Page Breaking event
    public function pageBreaking(&$break, &$content)
    {
        // Example:
        //$break = false; // Skip page break, or
        //$content = "<div style=\"break-after:page;\"></div>"; // Modify page break content
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
