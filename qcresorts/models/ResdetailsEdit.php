<?php

namespace PHPMaker2023\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ResdetailsEdit extends Resdetails
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ResdetailsEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ResdetailsEdit";

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
        $this->TableVar = 'resdetails';
        $this->TableName = 'resdetails';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-edit-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (resdetails)
        if (!isset($GLOBALS["resdetails"]) || get_class($GLOBALS["resdetails"]) == PROJECT_NAMESPACE . "resdetails") {
            $GLOBALS["resdetails"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'resdetails');
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
                    $result["view"] = $pageName == "ResdetailsView"; // If View page, no primary button
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
            $key .= @$ar['res_id'];
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
            $this->res_id->Visible = false;
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
        $this->res_id->setVisibility();
        $this->date->setVisibility();
        $this->fname->setVisibility();
        $this->lname->setVisibility();
        $this->address->setVisibility();
        $this->contactno->setVisibility();
        $this->_email->setVisibility();
        $this->pool_id->setVisibility();
        $this->proofofpayment->setVisibility();
        $this->rate_id->setVisibility();
        $this->dateuploaded->setVisibility();
        $this->uname->setVisibility();
        $this->paymentamount->setVisibility();
        $this->approved->setVisibility();

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
        $this->setupLookupOptions($this->pool_id);
        $this->setupLookupOptions($this->rate_id);

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
            if (($keyValue = Get("res_id") ?? Key(0) ?? Route(2)) !== null) {
                $this->res_id->setQueryStringValue($keyValue);
                $this->res_id->setOldValue($this->res_id->QueryStringValue);
            } elseif (Post("res_id") !== null) {
                $this->res_id->setFormValue(Post("res_id"));
                $this->res_id->setOldValue($this->res_id->FormValue);
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
                if (($keyValue = Get("res_id") ?? Route("res_id")) !== null) {
                    $this->res_id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->res_id->CurrentValue = null;
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
                        $this->terminate("ResdetailsList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ResdetailsList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) {
                    // Handle UseAjaxActions with return page
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "ResdetailsList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ResdetailsList"; // Return list page content
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
        $this->proofofpayment->Upload->Index = $CurrentForm->Index;
        $this->proofofpayment->Upload->uploadFile();
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'res_id' first before field var 'x_res_id'
        $val = $CurrentForm->hasValue("res_id") ? $CurrentForm->getValue("res_id") : $CurrentForm->getValue("x_res_id");
        if (!$this->res_id->IsDetailKey) {
            $this->res_id->setFormValue($val);
        }

        // Check field name 'date' first before field var 'x_date'
        $val = $CurrentForm->hasValue("date") ? $CurrentForm->getValue("date") : $CurrentForm->getValue("x_date");
        if (!$this->date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date->Visible = false; // Disable update for API request
            } else {
                $this->date->setFormValue($val, true, $validate);
            }
            $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        }

        // Check field name 'fname' first before field var 'x_fname'
        $val = $CurrentForm->hasValue("fname") ? $CurrentForm->getValue("fname") : $CurrentForm->getValue("x_fname");
        if (!$this->fname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->fname->Visible = false; // Disable update for API request
            } else {
                $this->fname->setFormValue($val);
            }
        }

        // Check field name 'lname' first before field var 'x_lname'
        $val = $CurrentForm->hasValue("lname") ? $CurrentForm->getValue("lname") : $CurrentForm->getValue("x_lname");
        if (!$this->lname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lname->Visible = false; // Disable update for API request
            } else {
                $this->lname->setFormValue($val);
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

        // Check field name 'contactno' first before field var 'x_contactno'
        $val = $CurrentForm->hasValue("contactno") ? $CurrentForm->getValue("contactno") : $CurrentForm->getValue("x_contactno");
        if (!$this->contactno->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->contactno->Visible = false; // Disable update for API request
            } else {
                $this->contactno->setFormValue($val);
            }
        }

        // Check field name 'email' first before field var 'x__email'
        $val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
        if (!$this->_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_email->Visible = false; // Disable update for API request
            } else {
                $this->_email->setFormValue($val);
            }
        }

        // Check field name 'pool_id' first before field var 'x_pool_id'
        $val = $CurrentForm->hasValue("pool_id") ? $CurrentForm->getValue("pool_id") : $CurrentForm->getValue("x_pool_id");
        if (!$this->pool_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pool_id->Visible = false; // Disable update for API request
            } else {
                $this->pool_id->setFormValue($val);
            }
        }

        // Check field name 'rate_id' first before field var 'x_rate_id'
        $val = $CurrentForm->hasValue("rate_id") ? $CurrentForm->getValue("rate_id") : $CurrentForm->getValue("x_rate_id");
        if (!$this->rate_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rate_id->Visible = false; // Disable update for API request
            } else {
                $this->rate_id->setFormValue($val);
            }
        }

        // Check field name 'dateuploaded' first before field var 'x_dateuploaded'
        $val = $CurrentForm->hasValue("dateuploaded") ? $CurrentForm->getValue("dateuploaded") : $CurrentForm->getValue("x_dateuploaded");
        if (!$this->dateuploaded->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dateuploaded->Visible = false; // Disable update for API request
            } else {
                $this->dateuploaded->setFormValue($val);
            }
        }

        // Check field name 'uname' first before field var 'x_uname'
        $val = $CurrentForm->hasValue("uname") ? $CurrentForm->getValue("uname") : $CurrentForm->getValue("x_uname");
        if (!$this->uname->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->uname->Visible = false; // Disable update for API request
            } else {
                $this->uname->setFormValue($val);
            }
        }

        // Check field name 'paymentamount' first before field var 'x_paymentamount'
        $val = $CurrentForm->hasValue("paymentamount") ? $CurrentForm->getValue("paymentamount") : $CurrentForm->getValue("x_paymentamount");
        if (!$this->paymentamount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->paymentamount->Visible = false; // Disable update for API request
            } else {
                $this->paymentamount->setFormValue($val);
            }
        }

        // Check field name 'approved' first before field var 'x_approved'
        $val = $CurrentForm->hasValue("approved") ? $CurrentForm->getValue("approved") : $CurrentForm->getValue("x_approved");
        if (!$this->approved->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->approved->Visible = false; // Disable update for API request
            } else {
                $this->approved->setFormValue($val, true, $validate);
            }
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->res_id->CurrentValue = $this->res_id->FormValue;
        $this->date->CurrentValue = $this->date->FormValue;
        $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->fname->CurrentValue = $this->fname->FormValue;
        $this->lname->CurrentValue = $this->lname->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->contactno->CurrentValue = $this->contactno->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->pool_id->CurrentValue = $this->pool_id->FormValue;
        $this->rate_id->CurrentValue = $this->rate_id->FormValue;
        $this->dateuploaded->CurrentValue = $this->dateuploaded->FormValue;
        $this->uname->CurrentValue = $this->uname->FormValue;
        $this->paymentamount->CurrentValue = $this->paymentamount->FormValue;
        $this->approved->CurrentValue = $this->approved->FormValue;
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
        $this->res_id->setDbValue($row['res_id']);
        $this->date->setDbValue($row['date']);
        $this->fname->setDbValue($row['fname']);
        $this->lname->setDbValue($row['lname']);
        $this->address->setDbValue($row['address']);
        $this->contactno->setDbValue($row['contactno']);
        $this->_email->setDbValue($row['email']);
        $this->pool_id->setDbValue($row['pool_id']);
        $this->proofofpayment->Upload->DbValue = $row['proofofpayment'];
        if (is_resource($this->proofofpayment->Upload->DbValue) && get_resource_type($this->proofofpayment->Upload->DbValue) == "stream") { // Byte array
            $this->proofofpayment->Upload->DbValue = stream_get_contents($this->proofofpayment->Upload->DbValue);
        }
        $this->rate_id->setDbValue($row['rate_id']);
        $this->dateuploaded->setDbValue($row['dateuploaded']);
        $this->uname->setDbValue($row['uname']);
        $this->paymentamount->setDbValue($row['paymentamount']);
        $this->approved->setDbValue($row['approved']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['res_id'] = $this->res_id->DefaultValue;
        $row['date'] = $this->date->DefaultValue;
        $row['fname'] = $this->fname->DefaultValue;
        $row['lname'] = $this->lname->DefaultValue;
        $row['address'] = $this->address->DefaultValue;
        $row['contactno'] = $this->contactno->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['pool_id'] = $this->pool_id->DefaultValue;
        $row['proofofpayment'] = $this->proofofpayment->DefaultValue;
        $row['rate_id'] = $this->rate_id->DefaultValue;
        $row['dateuploaded'] = $this->dateuploaded->DefaultValue;
        $row['uname'] = $this->uname->DefaultValue;
        $row['paymentamount'] = $this->paymentamount->DefaultValue;
        $row['approved'] = $this->approved->DefaultValue;
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

        // res_id
        $this->res_id->RowCssClass = "row";

        // date
        $this->date->RowCssClass = "row";

        // fname
        $this->fname->RowCssClass = "row";

        // lname
        $this->lname->RowCssClass = "row";

        // address
        $this->address->RowCssClass = "row";

        // contactno
        $this->contactno->RowCssClass = "row";

        // email
        $this->_email->RowCssClass = "row";

        // pool_id
        $this->pool_id->RowCssClass = "row";

        // proofofpayment
        $this->proofofpayment->RowCssClass = "row";

        // rate_id
        $this->rate_id->RowCssClass = "row";

        // dateuploaded
        $this->dateuploaded->RowCssClass = "row";

        // uname
        $this->uname->RowCssClass = "row";

        // paymentamount
        $this->paymentamount->RowCssClass = "row";

        // approved
        $this->approved->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
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

            // date
            $this->date->HrefValue = "";

            // fname
            $this->fname->HrefValue = "";

            // lname
            $this->lname->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // contactno
            $this->contactno->HrefValue = "";

            // email
            $this->_email->HrefValue = "";

            // pool_id
            $this->pool_id->HrefValue = "";

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

            // rate_id
            $this->rate_id->HrefValue = "";

            // dateuploaded
            $this->dateuploaded->HrefValue = "";

            // uname
            $this->uname->HrefValue = "";

            // paymentamount
            $this->paymentamount->HrefValue = "";

            // approved
            $this->approved->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // res_id
            $this->res_id->setupEditAttributes();
            $this->res_id->EditValue = $this->res_id->CurrentValue;

            // date
            $this->date->setupEditAttributes();
            $this->date->EditValue = HtmlEncode(FormatDateTime($this->date->CurrentValue, $this->date->formatPattern()));
            $this->date->PlaceHolder = RemoveHtml($this->date->caption());

            // fname
            $this->fname->setupEditAttributes();
            if (!$this->fname->Raw) {
                $this->fname->CurrentValue = HtmlDecode($this->fname->CurrentValue);
            }
            $this->fname->EditValue = HtmlEncode($this->fname->CurrentValue);
            $this->fname->PlaceHolder = RemoveHtml($this->fname->caption());

            // lname
            $this->lname->setupEditAttributes();
            if (!$this->lname->Raw) {
                $this->lname->CurrentValue = HtmlDecode($this->lname->CurrentValue);
            }
            $this->lname->EditValue = HtmlEncode($this->lname->CurrentValue);
            $this->lname->PlaceHolder = RemoveHtml($this->lname->caption());

            // address
            $this->address->setupEditAttributes();
            $this->address->EditValue = HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = RemoveHtml($this->address->caption());

            // contactno
            $this->contactno->setupEditAttributes();
            if (!$this->contactno->Raw) {
                $this->contactno->CurrentValue = HtmlDecode($this->contactno->CurrentValue);
            }
            $this->contactno->EditValue = HtmlEncode($this->contactno->CurrentValue);
            $this->contactno->PlaceHolder = RemoveHtml($this->contactno->caption());

            // email
            $this->_email->setupEditAttributes();
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

            // pool_id
            $this->pool_id->setupEditAttributes();
            $curVal = trim(strval($this->pool_id->CurrentValue));
            if ($curVal != "") {
                $this->pool_id->ViewValue = $this->pool_id->lookupCacheOption($curVal);
            } else {
                $this->pool_id->ViewValue = $this->pool_id->Lookup !== null && is_array($this->pool_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->pool_id->ViewValue !== null) { // Load from cache
                $this->pool_id->EditValue = array_values($this->pool_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`pool_id`", "=", $this->pool_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->pool_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->pool_id->EditValue = $arwrk;
            }
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
            if ($this->isShow()) {
                RenderUploadField($this->proofofpayment);
            }

            // rate_id
            $this->rate_id->setupEditAttributes();
            $curVal = trim(strval($this->rate_id->CurrentValue));
            if ($curVal != "") {
                $this->rate_id->ViewValue = $this->rate_id->lookupCacheOption($curVal);
            } else {
                $this->rate_id->ViewValue = $this->rate_id->Lookup !== null && is_array($this->rate_id->lookupOptions()) ? $curVal : null;
            }
            if ($this->rate_id->ViewValue !== null) { // Load from cache
                $this->rate_id->EditValue = array_values($this->rate_id->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = SearchFilter("`rateid`", "=", $this->rate_id->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->rate_id->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->rate_id->EditValue = $arwrk;
            }
            $this->rate_id->PlaceHolder = RemoveHtml($this->rate_id->caption());

            // dateuploaded
            $this->dateuploaded->setupEditAttributes();
            if (!$this->dateuploaded->Raw) {
                $this->dateuploaded->CurrentValue = HtmlDecode($this->dateuploaded->CurrentValue);
            }
            $this->dateuploaded->EditValue = HtmlEncode($this->dateuploaded->CurrentValue);
            $this->dateuploaded->PlaceHolder = RemoveHtml($this->dateuploaded->caption());

            // uname
            $this->uname->setupEditAttributes();
            if (!$this->uname->Raw) {
                $this->uname->CurrentValue = HtmlDecode($this->uname->CurrentValue);
            }
            $this->uname->EditValue = HtmlEncode($this->uname->CurrentValue);
            $this->uname->PlaceHolder = RemoveHtml($this->uname->caption());

            // paymentamount
            $this->paymentamount->setupEditAttributes();
            if (!$this->paymentamount->Raw) {
                $this->paymentamount->CurrentValue = HtmlDecode($this->paymentamount->CurrentValue);
            }
            $this->paymentamount->EditValue = HtmlEncode($this->paymentamount->CurrentValue);
            $this->paymentamount->PlaceHolder = RemoveHtml($this->paymentamount->caption());

            // approved
            $this->approved->setupEditAttributes();
            $this->approved->EditValue = HtmlEncode($this->approved->CurrentValue);
            $this->approved->PlaceHolder = RemoveHtml($this->approved->caption());
            if (strval($this->approved->EditValue) != "" && is_numeric($this->approved->EditValue)) {
                $this->approved->EditValue = FormatNumber($this->approved->EditValue, null);
            }

            // Edit refer script

            // res_id
            $this->res_id->HrefValue = "";

            // date
            $this->date->HrefValue = "";

            // fname
            $this->fname->HrefValue = "";

            // lname
            $this->lname->HrefValue = "";

            // address
            $this->address->HrefValue = "";

            // contactno
            $this->contactno->HrefValue = "";

            // email
            $this->_email->HrefValue = "";

            // pool_id
            $this->pool_id->HrefValue = "";

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

            // rate_id
            $this->rate_id->HrefValue = "";

            // dateuploaded
            $this->dateuploaded->HrefValue = "";

            // uname
            $this->uname->HrefValue = "";

            // paymentamount
            $this->paymentamount->HrefValue = "";

            // approved
            $this->approved->HrefValue = "";
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
        if ($this->res_id->Required) {
            if (!$this->res_id->IsDetailKey && EmptyValue($this->res_id->FormValue)) {
                $this->res_id->addErrorMessage(str_replace("%s", $this->res_id->caption(), $this->res_id->RequiredErrorMessage));
            }
        }
        if ($this->date->Required) {
            if (!$this->date->IsDetailKey && EmptyValue($this->date->FormValue)) {
                $this->date->addErrorMessage(str_replace("%s", $this->date->caption(), $this->date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date->FormValue, $this->date->formatPattern())) {
            $this->date->addErrorMessage($this->date->getErrorMessage(false));
        }
        if ($this->fname->Required) {
            if (!$this->fname->IsDetailKey && EmptyValue($this->fname->FormValue)) {
                $this->fname->addErrorMessage(str_replace("%s", $this->fname->caption(), $this->fname->RequiredErrorMessage));
            }
        }
        if ($this->lname->Required) {
            if (!$this->lname->IsDetailKey && EmptyValue($this->lname->FormValue)) {
                $this->lname->addErrorMessage(str_replace("%s", $this->lname->caption(), $this->lname->RequiredErrorMessage));
            }
        }
        if ($this->address->Required) {
            if (!$this->address->IsDetailKey && EmptyValue($this->address->FormValue)) {
                $this->address->addErrorMessage(str_replace("%s", $this->address->caption(), $this->address->RequiredErrorMessage));
            }
        }
        if ($this->contactno->Required) {
            if (!$this->contactno->IsDetailKey && EmptyValue($this->contactno->FormValue)) {
                $this->contactno->addErrorMessage(str_replace("%s", $this->contactno->caption(), $this->contactno->RequiredErrorMessage));
            }
        }
        if ($this->_email->Required) {
            if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
            }
        }
        if ($this->pool_id->Required) {
            if (!$this->pool_id->IsDetailKey && EmptyValue($this->pool_id->FormValue)) {
                $this->pool_id->addErrorMessage(str_replace("%s", $this->pool_id->caption(), $this->pool_id->RequiredErrorMessage));
            }
        }
        if ($this->proofofpayment->Required) {
            if ($this->proofofpayment->Upload->FileName == "" && !$this->proofofpayment->Upload->KeepFile) {
                $this->proofofpayment->addErrorMessage(str_replace("%s", $this->proofofpayment->caption(), $this->proofofpayment->RequiredErrorMessage));
            }
        }
        if ($this->rate_id->Required) {
            if (!$this->rate_id->IsDetailKey && EmptyValue($this->rate_id->FormValue)) {
                $this->rate_id->addErrorMessage(str_replace("%s", $this->rate_id->caption(), $this->rate_id->RequiredErrorMessage));
            }
        }
        if ($this->dateuploaded->Required) {
            if (!$this->dateuploaded->IsDetailKey && EmptyValue($this->dateuploaded->FormValue)) {
                $this->dateuploaded->addErrorMessage(str_replace("%s", $this->dateuploaded->caption(), $this->dateuploaded->RequiredErrorMessage));
            }
        }
        if ($this->uname->Required) {
            if (!$this->uname->IsDetailKey && EmptyValue($this->uname->FormValue)) {
                $this->uname->addErrorMessage(str_replace("%s", $this->uname->caption(), $this->uname->RequiredErrorMessage));
            }
        }
        if ($this->paymentamount->Required) {
            if (!$this->paymentamount->IsDetailKey && EmptyValue($this->paymentamount->FormValue)) {
                $this->paymentamount->addErrorMessage(str_replace("%s", $this->paymentamount->caption(), $this->paymentamount->RequiredErrorMessage));
            }
        }
        if ($this->approved->Required) {
            if (!$this->approved->IsDetailKey && EmptyValue($this->approved->FormValue)) {
                $this->approved->addErrorMessage(str_replace("%s", $this->approved->caption(), $this->approved->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->approved->FormValue)) {
            $this->approved->addErrorMessage($this->approved->getErrorMessage(false));
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

        // date
        $this->date->setDbValueDef($rsnew, UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern()), CurrentDate(), $this->date->ReadOnly);

        // fname
        $this->fname->setDbValueDef($rsnew, $this->fname->CurrentValue, "", $this->fname->ReadOnly);

        // lname
        $this->lname->setDbValueDef($rsnew, $this->lname->CurrentValue, "", $this->lname->ReadOnly);

        // address
        $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, "", $this->address->ReadOnly);

        // contactno
        $this->contactno->setDbValueDef($rsnew, $this->contactno->CurrentValue, "", $this->contactno->ReadOnly);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, "", $this->_email->ReadOnly);

        // pool_id
        $this->pool_id->setDbValueDef($rsnew, $this->pool_id->CurrentValue, 0, $this->pool_id->ReadOnly);

        // proofofpayment
        if ($this->proofofpayment->Visible && !$this->proofofpayment->ReadOnly && !$this->proofofpayment->Upload->KeepFile) {
            if ($this->proofofpayment->Upload->Value === null) {
                $rsnew['proofofpayment'] = null;
            } else {
                $rsnew['proofofpayment'] = $this->proofofpayment->Upload->Value;
            }
        }

        // rate_id
        $this->rate_id->setDbValueDef($rsnew, $this->rate_id->CurrentValue, 0, $this->rate_id->ReadOnly);

        // dateuploaded
        $this->dateuploaded->setDbValueDef($rsnew, $this->dateuploaded->CurrentValue, "", $this->dateuploaded->ReadOnly);

        // uname
        $this->uname->setDbValueDef($rsnew, $this->uname->CurrentValue, "", $this->uname->ReadOnly);

        // paymentamount
        $this->paymentamount->setDbValueDef($rsnew, $this->paymentamount->CurrentValue, "", $this->paymentamount->ReadOnly);

        // approved
        $this->approved->setDbValueDef($rsnew, $this->approved->CurrentValue, 0, $this->approved->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ResdetailsList"), "", $this->TableVar, true);
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
                case "x_pool_id":
                    break;
                case "x_rate_id":
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