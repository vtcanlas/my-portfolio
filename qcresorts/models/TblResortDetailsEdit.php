<?php

namespace PHPMaker2023\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class TblResortDetailsEdit extends TblResortDetails
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "TblResortDetailsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "TblResortDetailsEdit";

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
        $this->TableVar = 'tbl_resort_details';
        $this->TableName = 'tbl_resort_details';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (tbl_resort_details)
        if (!isset($GLOBALS["tbl_resort_details"]) || get_class($GLOBALS["tbl_resort_details"]) == PROJECT_NAMESPACE . "tbl_resort_details") {
            $GLOBALS["tbl_resort_details"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'tbl_resort_details');
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
                    $result["view"] = $pageName == "TblResortDetailsView"; // If View page, no primary button
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
            $key .= @$ar['pool_id'];
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
            $this->pool_id->Visible = false;
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

    // Properties
    public $FormClassName = "ew-form ew-edit-form overlay-wrapper";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->pool_id->Visible = false;
        $this->pool_name->setVisibility();
        $this->pool_description->setVisibility();
        $this->barangay->setVisibility();
        $this->poolcat->setVisibility();
        $this->address->setVisibility();
        $this->contactno1->setVisibility();
        $this->emailaddress->setVisibility();
        $this->socmed->setVisibility();
        $this->uname->Visible = false;

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

        // Set up lookup cache
        $this->setupLookupOptions($this->poolcat);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("pool_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->pool_id->setQueryStringValue($keyValue);
                $this->pool_id->setOldValue($this->pool_id->QueryStringValue);
            } elseif (Post("pool_id") !== null) {
                $this->pool_id->setFormValue(Post("pool_id"));
                $this->pool_id->setOldValue($this->pool_id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action", "") !== "") {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("pool_id") ?? Route("pool_id")) !== null) {
                    $this->pool_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->pool_id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values

            // Set up detail parameters
            $this->setupDetailParms();
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("TblResortDetailsList"); // No matching record, return to list
                        return;
                    }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                if ($this->getCurrentDetailTable() != "") { // Master/detail edit
                    $returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
                } else {
                    $returnUrl = $this->getReturnUrl();
                }
                if (GetPageName($returnUrl) == "TblResortDetailsList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "TblResortDetailsList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "TblResortDetailsList"; // Return list page content
                        }
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsJsonResponse()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
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
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'pool_name' first before field var 'x_pool_name'
        $val = $CurrentForm->hasValue("pool_name") ? $CurrentForm->getValue("pool_name") : $CurrentForm->getValue("x_pool_name");
        if (!$this->pool_name->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pool_name->Visible = false; // Disable update for API request
            } else {
                $this->pool_name->setFormValue($val);
            }
        }

        // Check field name 'pool_description' first before field var 'x_pool_description'
        $val = $CurrentForm->hasValue("pool_description") ? $CurrentForm->getValue("pool_description") : $CurrentForm->getValue("x_pool_description");
        if (!$this->pool_description->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pool_description->Visible = false; // Disable update for API request
            } else {
                $this->pool_description->setFormValue($val);
            }
        }

        // Check field name 'barangay' first before field var 'x_barangay'
        $val = $CurrentForm->hasValue("barangay") ? $CurrentForm->getValue("barangay") : $CurrentForm->getValue("x_barangay");
        if (!$this->barangay->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->barangay->Visible = false; // Disable update for API request
            } else {
                $this->barangay->setFormValue($val);
            }
        }

        // Check field name 'poolcat' first before field var 'x_poolcat'
        $val = $CurrentForm->hasValue("poolcat") ? $CurrentForm->getValue("poolcat") : $CurrentForm->getValue("x_poolcat");
        if (!$this->poolcat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->poolcat->Visible = false; // Disable update for API request
            } else {
                $this->poolcat->setFormValue($val);
            }
        }

        // Check field name 'address' first before field var 'x_address'
        $val = $CurrentForm->hasValue("address") ? $CurrentForm->getValue("address") : $CurrentForm->getValue("x_address");
        if (!$this->address->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->address->Visible = false; // Disable update for API request
            } else {
                $this->address->setFormValue($val);
            }
        }

        // Check field name 'contactno1' first before field var 'x_contactno1'
        $val = $CurrentForm->hasValue("contactno1") ? $CurrentForm->getValue("contactno1") : $CurrentForm->getValue("x_contactno1");
        if (!$this->contactno1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contactno1->Visible = false; // Disable update for API request
            } else {
                $this->contactno1->setFormValue($val);
            }
        }

        // Check field name 'emailaddress' first before field var 'x_emailaddress'
        $val = $CurrentForm->hasValue("emailaddress") ? $CurrentForm->getValue("emailaddress") : $CurrentForm->getValue("x_emailaddress");
        if (!$this->emailaddress->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->emailaddress->Visible = false; // Disable update for API request
            } else {
                $this->emailaddress->setFormValue($val);
            }
        }

        // Check field name 'socmed' first before field var 'x_socmed'
        $val = $CurrentForm->hasValue("socmed") ? $CurrentForm->getValue("socmed") : $CurrentForm->getValue("x_socmed");
        if (!$this->socmed->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->socmed->Visible = false; // Disable update for API request
            } else {
                $this->socmed->setFormValue($val);
            }
        }

        // Check field name 'pool_id' first before field var 'x_pool_id'
        $val = $CurrentForm->hasValue("pool_id") ? $CurrentForm->getValue("pool_id") : $CurrentForm->getValue("x_pool_id");
        if (!$this->pool_id->IsDetailKey) {
            $this->pool_id->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->pool_id->CurrentValue = $this->pool_id->FormValue;
        $this->pool_name->CurrentValue = $this->pool_name->FormValue;
        $this->pool_description->CurrentValue = $this->pool_description->FormValue;
        $this->barangay->CurrentValue = $this->barangay->FormValue;
        $this->poolcat->CurrentValue = $this->poolcat->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->contactno1->CurrentValue = $this->contactno1->FormValue;
        $this->emailaddress->CurrentValue = $this->emailaddress->FormValue;
        $this->socmed->CurrentValue = $this->socmed->FormValue;
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
        $this->pool_id->setDbValue($row['pool_id']);
        $this->pool_name->setDbValue($row['pool_name']);
        $this->pool_description->setDbValue($row['pool_description']);
        $this->barangay->setDbValue($row['barangay']);
        $this->poolcat->setDbValue($row['poolcat']);
        $this->address->setDbValue($row['address']);
        $this->contactno1->setDbValue($row['contactno1']);
        $this->emailaddress->setDbValue($row['emailaddress']);
        $this->socmed->setDbValue($row['socmed']);
        $this->uname->setDbValue($row['uname']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['pool_id'] = $this->pool_id->DefaultValue;
        $row['pool_name'] = $this->pool_name->DefaultValue;
        $row['pool_description'] = $this->pool_description->DefaultValue;
        $row['barangay'] = $this->barangay->DefaultValue;
        $row['poolcat'] = $this->poolcat->DefaultValue;
        $row['address'] = $this->address->DefaultValue;
        $row['contactno1'] = $this->contactno1->DefaultValue;
        $row['emailaddress'] = $this->emailaddress->DefaultValue;
        $row['socmed'] = $this->socmed->DefaultValue;
        $row['uname'] = $this->uname->DefaultValue;
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

        // pool_id
        $this->pool_id->RowCssClass = "row";

        // pool_name
        $this->pool_name->RowCssClass = "row";

        // pool_description
        $this->pool_description->RowCssClass = "row";

        // barangay
        $this->barangay->RowCssClass = "row";

        // poolcat
        $this->poolcat->RowCssClass = "row";

        // address
        $this->address->RowCssClass = "row";

        // contactno1
        $this->contactno1->RowCssClass = "row";

        // emailaddress
        $this->emailaddress->RowCssClass = "row";

        // socmed
        $this->socmed->RowCssClass = "row";

        // uname
        $this->uname->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // pool_id
            $this->pool_id->ViewValue = $this->pool_id->CurrentValue;

            // pool_name
            $this->pool_name->ViewValue = $this->pool_name->CurrentValue;

            // pool_description
            $this->pool_description->ViewValue = $this->pool_description->CurrentValue;

            // barangay
            $this->barangay->ViewValue = $this->barangay->CurrentValue;

            // poolcat
            if (strval($this->poolcat->CurrentValue) != "") {
                $this->poolcat->ViewValue = $this->poolcat->optionCaption($this->poolcat->CurrentValue);
            } else {
                $this->poolcat->ViewValue = null;
            }

            // address
            $this->address->ViewValue = $this->address->CurrentValue;

            // contactno1
            $this->contactno1->ViewValue = $this->contactno1->CurrentValue;

            // emailaddress
            $this->emailaddress->ViewValue = $this->emailaddress->CurrentValue;

            // socmed
            $this->socmed->ViewValue = $this->socmed->CurrentValue;

            // uname
            $this->uname->ViewValue = $this->uname->CurrentValue;

            // pool_name
            $this->pool_name->HrefValue = "";

            // pool_description
            $this->pool_description->HrefValue = "";

            // barangay
            $this->barangay->HrefValue = "";

            // poolcat
            $this->poolcat->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // contactno1
            $this->contactno1->HrefValue = "";

            // emailaddress
            $this->emailaddress->HrefValue = "";

            // socmed
            $this->socmed->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // pool_name
            $this->pool_name->setupEditAttributes();
            if (!$this->pool_name->Raw) {
                $this->pool_name->CurrentValue = HtmlDecode($this->pool_name->CurrentValue);
            }
            $this->pool_name->EditValue = HtmlEncode($this->pool_name->CurrentValue);
            $this->pool_name->PlaceHolder = RemoveHtml($this->pool_name->caption());

            // pool_description
            $this->pool_description->setupEditAttributes();
            $this->pool_description->EditValue = HtmlEncode($this->pool_description->CurrentValue);
            $this->pool_description->PlaceHolder = RemoveHtml($this->pool_description->caption());

            // barangay
            $this->barangay->setupEditAttributes();
            if (!$this->barangay->Raw) {
                $this->barangay->CurrentValue = HtmlDecode($this->barangay->CurrentValue);
            }
            $this->barangay->EditValue = HtmlEncode($this->barangay->CurrentValue);
            $this->barangay->PlaceHolder = RemoveHtml($this->barangay->caption());

            // poolcat
            $this->poolcat->setupEditAttributes();
            $this->poolcat->EditValue = $this->poolcat->options(true);
            $this->poolcat->PlaceHolder = RemoveHtml($this->poolcat->caption());

            // address
            $this->address->setupEditAttributes();
            $this->address->EditValue = HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = RemoveHtml($this->address->caption());

            // contactno1
            $this->contactno1->setupEditAttributes();
            if (!$this->contactno1->Raw) {
                $this->contactno1->CurrentValue = HtmlDecode($this->contactno1->CurrentValue);
            }
            $this->contactno1->EditValue = HtmlEncode($this->contactno1->CurrentValue);
            $this->contactno1->PlaceHolder = RemoveHtml($this->contactno1->caption());

            // emailaddress
            $this->emailaddress->setupEditAttributes();
            if (!$this->emailaddress->Raw) {
                $this->emailaddress->CurrentValue = HtmlDecode($this->emailaddress->CurrentValue);
            }
            $this->emailaddress->EditValue = HtmlEncode($this->emailaddress->CurrentValue);
            $this->emailaddress->PlaceHolder = RemoveHtml($this->emailaddress->caption());

            // socmed
            $this->socmed->setupEditAttributes();
            if (!$this->socmed->Raw) {
                $this->socmed->CurrentValue = HtmlDecode($this->socmed->CurrentValue);
            }
            $this->socmed->EditValue = HtmlEncode($this->socmed->CurrentValue);
            $this->socmed->PlaceHolder = RemoveHtml($this->socmed->caption());

            // Edit refer script

            // pool_name
            $this->pool_name->HrefValue = "";

            // pool_description
            $this->pool_description->HrefValue = "";

            // barangay
            $this->barangay->HrefValue = "";

            // poolcat
            $this->poolcat->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // contactno1
            $this->contactno1->HrefValue = "";

            // emailaddress
            $this->emailaddress->HrefValue = "";

            // socmed
            $this->socmed->HrefValue = "";
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
        if ($this->pool_name->Required) {
            if (!$this->pool_name->IsDetailKey && EmptyValue($this->pool_name->FormValue)) {
                $this->pool_name->addErrorMessage(str_replace("%s", $this->pool_name->caption(), $this->pool_name->RequiredErrorMessage));
            }
        }
        if ($this->pool_description->Required) {
            if (!$this->pool_description->IsDetailKey && EmptyValue($this->pool_description->FormValue)) {
                $this->pool_description->addErrorMessage(str_replace("%s", $this->pool_description->caption(), $this->pool_description->RequiredErrorMessage));
            }
        }
        if ($this->barangay->Required) {
            if (!$this->barangay->IsDetailKey && EmptyValue($this->barangay->FormValue)) {
                $this->barangay->addErrorMessage(str_replace("%s", $this->barangay->caption(), $this->barangay->RequiredErrorMessage));
            }
        }
        if ($this->poolcat->Required) {
            if (!$this->poolcat->IsDetailKey && EmptyValue($this->poolcat->FormValue)) {
                $this->poolcat->addErrorMessage(str_replace("%s", $this->poolcat->caption(), $this->poolcat->RequiredErrorMessage));
            }
        }
        if ($this->address->Required) {
            if (!$this->address->IsDetailKey && EmptyValue($this->address->FormValue)) {
                $this->address->addErrorMessage(str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
            }
        }
        if ($this->contactno1->Required) {
            if (!$this->contactno1->IsDetailKey && EmptyValue($this->contactno1->FormValue)) {
                $this->contactno1->addErrorMessage(str_replace("%s", $this->contactno1->caption(), $this->contactno1->RequiredErrorMessage));
            }
        }
        if ($this->emailaddress->Required) {
            if (!$this->emailaddress->IsDetailKey && EmptyValue($this->emailaddress->FormValue)) {
                $this->emailaddress->addErrorMessage(str_replace("%s", $this->emailaddress->caption(), $this->emailaddress->RequiredErrorMessage));
            }
        }
        if ($this->socmed->Required) {
            if (!$this->socmed->IsDetailKey && EmptyValue($this->socmed->FormValue)) {
                $this->socmed->addErrorMessage(str_replace("%s", $this->socmed->caption(), $this->socmed->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("PoolpicsGrid");
        if (in_array("poolpics", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PoolratesGrid");
        if (in_array("poolrates", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // pool_name
        $this->pool_name->setDbValueDef($rsnew, $this->pool_name->CurrentValue, null, $this->pool_name->ReadOnly);

        // pool_description
        $this->pool_description->setDbValueDef($rsnew, $this->pool_description->CurrentValue, null, $this->pool_description->ReadOnly);

        // barangay
        $this->barangay->setDbValueDef($rsnew, $this->barangay->CurrentValue, null, $this->barangay->ReadOnly);

        // poolcat
        $this->poolcat->setDbValueDef($rsnew, $this->poolcat->CurrentValue, null, $this->poolcat->ReadOnly);

        // address
        $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, null, $this->address->ReadOnly);

        // contactno1
        $this->contactno1->setDbValueDef($rsnew, $this->contactno1->CurrentValue, null, $this->contactno1->ReadOnly);

        // emailaddress
        $this->emailaddress->setDbValueDef($rsnew, $this->emailaddress->CurrentValue, "", $this->emailaddress->ReadOnly);

        // socmed
        $this->socmed->setDbValueDef($rsnew, $this->socmed->CurrentValue, null, $this->socmed->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
                if (!$editRow && !EmptyValue($this->DbErrorMessage)) { // Show database error
                    $this->setFailureMessage($this->DbErrorMessage);
                }
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }

            // Update detail records
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            if ($editRow) {
                $detailPage = Container("PoolpicsGrid");
                if (in_array("poolpics", $detailTblVar) && $detailPage->DetailEdit) {
                    $Security->loadCurrentUserLevel($this->ProjectID . "poolpics"); // Load user level of detail table
                    $editRow = $detailPage->gridUpdate();
                    $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                }
            }
            if ($editRow) {
                $detailPage = Container("PoolratesGrid");
                if (in_array("poolrates", $detailTblVar) && $detailPage->DetailEdit) {
                    $Security->loadCurrentUserLevel($this->ProjectID . "poolrates"); // Load user level of detail table
                    $editRow = $detailPage->gridUpdate();
                    $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                }
            }

            // Commit/Rollback transaction
            if ($this->getCurrentDetailTable() != "") {
                if ($editRow) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Write JSON response
        if (IsJsonResponse() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            $table = $this->TableVar;
            WriteJson(["success" => true, "action" => Config("API_EDIT_ACTION"), $table => $row]);
        }
        return $editRow;
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("poolpics", $detailTblVar)) {
                $detailPageObj = Container("PoolpicsGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->pool_id->IsDetailKey = true;
                    $detailPageObj->pool_id->CurrentValue = $this->pool_id->CurrentValue;
                    $detailPageObj->pool_id->setSessionValue($detailPageObj->pool_id->CurrentValue);
                }
            }
            if (in_array("poolrates", $detailTblVar)) {
                $detailPageObj = Container("PoolratesGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->EventCancelled = $this->EventCancelled;
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->pool_id->IsDetailKey = true;
                    $detailPageObj->pool_id->CurrentValue = $this->pool_id->CurrentValue;
                    $detailPageObj->pool_id->setSessionValue($detailPageObj->pool_id->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TblResortDetailsList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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
                case "x_poolcat":
                    break;
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        $pageNo = Get(Config("TABLE_PAGE_NUMBER"));
        $startRec = Get(Config("TABLE_START_REC"));
        $infiniteScroll = false;
        $recordNo = $pageNo ?? $startRec; // Record number = page number or start record
        if ($recordNo !== null && is_numeric($recordNo)) {
            $this->StartRecord = $recordNo;
        } else {
            $this->StartRecord = $this->getStartRecordNumber();
        }

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || intval($this->StartRecord) <= 0) { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
        }
        if (!$infiniteScroll) {
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Get page count
    public function pageCount() {
        return ceil($this->TotalRecords / $this->DisplayRecords);
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
