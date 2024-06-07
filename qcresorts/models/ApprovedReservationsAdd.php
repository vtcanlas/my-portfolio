<?php

namespace PHPMaker2023\project1;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ApprovedReservationsAdd extends ApprovedReservations
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "ApprovedReservationsAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // CSS class/style
    public $CurrentPageName = "ApprovedReservationsAdd";

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
        $this->TableVar = 'ApprovedReservations';
        $this->TableName = 'ApprovedReservations';

        // Table CSS class
        $this->TableClass = "table table-striped table-bordered table-hover table-sm ew-desktop-table ew-add-table";

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Table object (ApprovedReservations)
        if (!isset($GLOBALS["ApprovedReservations"]) || get_class($GLOBALS["ApprovedReservations"]) == PROJECT_NAMESPACE . "ApprovedReservations") {
            $GLOBALS["ApprovedReservations"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'ApprovedReservations');
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
                    $result["view"] = $pageName == "ApprovedReservationsView"; // If View page, no primary button
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
        $this->res_id->Visible = false;
        $this->pool_id->Visible = false;
        $this->date->setVisibility();
        $this->rate_id->setVisibility();
        $this->fname->setVisibility();
        $this->lname->setVisibility();
        $this->address->setVisibility();
        $this->contactno->setVisibility();
        $this->_email->setVisibility();
        $this->proofofpayment->setVisibility();
        $this->paymentamount->setVisibility();
        $this->dateuploaded->setVisibility();
        $this->approved->setVisibility();
        $this->uname->setVisibility();

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
            if (($keyValue = Get("res_id") ?? Route("res_id")) !== null) {
                $this->res_id->setQueryStringValue($keyValue);
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
                    $this->terminate("ApprovedReservationsList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "ApprovedReservationsList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ApprovedReservationsView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }

                    // Handle UseAjaxActions
                    if ($this->IsModal && $this->UseAjaxActions) {
                        $this->IsModal = false;
                        if (GetPageName($returnUrl) != "ApprovedReservationsList") {
                            Container("flash")->addMessage("Return-Url", $returnUrl); // Save return URL
                            $returnUrl = "ApprovedReservationsList"; // Return list page content
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
        $this->proofofpayment->Upload->Index = $CurrentForm->Index;
        $this->proofofpayment->Upload->uploadFile();
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

        // Check field name 'rate_id' first before field var 'x_rate_id'
        $val = $CurrentForm->hasValue("rate_id") ? $CurrentForm->getValue("rate_id") : $CurrentForm->getValue("x_rate_id");
        if (!$this->rate_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rate_id->Visible = false; // Disable update for API request
            } else {
                $this->rate_id->setFormValue($val, true, $validate);
            }
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

        // Check field name 'paymentamount' first before field var 'x_paymentamount'
        $val = $CurrentForm->hasValue("paymentamount") ? $CurrentForm->getValue("paymentamount") : $CurrentForm->getValue("x_paymentamount");
        if (!$this->paymentamount->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->paymentamount->Visible = false; // Disable update for API request
            } else {
                $this->paymentamount->setFormValue($val);
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

        // Check field name 'approved' first before field var 'x_approved'
        $val = $CurrentForm->hasValue("approved") ? $CurrentForm->getValue("approved") : $CurrentForm->getValue("x_approved");
        if (!$this->approved->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->approved->Visible = false; // Disable update for API request
            } else {
                $this->approved->setFormValue($val, true, $validate);
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

        // Check field name 'res_id' first before field var 'x_res_id'
        $val = $CurrentForm->hasValue("res_id") ? $CurrentForm->getValue("res_id") : $CurrentForm->getValue("x_res_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->date->CurrentValue = $this->date->FormValue;
        $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->rate_id->CurrentValue = $this->rate_id->FormValue;
        $this->fname->CurrentValue = $this->fname->FormValue;
        $this->lname->CurrentValue = $this->lname->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->contactno->CurrentValue = $this->contactno->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->paymentamount->CurrentValue = $this->paymentamount->FormValue;
        $this->dateuploaded->CurrentValue = $this->dateuploaded->FormValue;
        $this->approved->CurrentValue = $this->approved->FormValue;
        $this->uname->CurrentValue = $this->uname->FormValue;
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
        $this->pool_id->setDbValue($row['pool_id']);
        $this->date->setDbValue($row['date']);
        $this->rate_id->setDbValue($row['rate_id']);
        $this->fname->setDbValue($row['fname']);
        $this->lname->setDbValue($row['lname']);
        $this->address->setDbValue($row['address']);
        $this->contactno->setDbValue($row['contactno']);
        $this->_email->setDbValue($row['email']);
        $this->proofofpayment->Upload->DbValue = $row['proofofpayment'];
        if (is_resource($this->proofofpayment->Upload->DbValue) && get_resource_type($this->proofofpayment->Upload->DbValue) == "stream") { // Byte array
            $this->proofofpayment->Upload->DbValue = stream_get_contents($this->proofofpayment->Upload->DbValue);
        }
        $this->paymentamount->setDbValue($row['paymentamount']);
        $this->dateuploaded->setDbValue($row['dateuploaded']);
        $this->approved->setDbValue($row['approved']);
        $this->uname->setDbValue($row['uname']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['res_id'] = $this->res_id->DefaultValue;
        $row['pool_id'] = $this->pool_id->DefaultValue;
        $row['date'] = $this->date->DefaultValue;
        $row['rate_id'] = $this->rate_id->DefaultValue;
        $row['fname'] = $this->fname->DefaultValue;
        $row['lname'] = $this->lname->DefaultValue;
        $row['address'] = $this->address->DefaultValue;
        $row['contactno'] = $this->contactno->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['proofofpayment'] = $this->proofofpayment->DefaultValue;
        $row['paymentamount'] = $this->paymentamount->DefaultValue;
        $row['dateuploaded'] = $this->dateuploaded->DefaultValue;
        $row['approved'] = $this->approved->DefaultValue;
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

        // res_id
        $this->res_id->RowCssClass = "row";

        // pool_id
        $this->pool_id->RowCssClass = "row";

        // date
        $this->date->RowCssClass = "row";

        // rate_id
        $this->rate_id->RowCssClass = "row";

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

        // proofofpayment
        $this->proofofpayment->RowCssClass = "row";

        // paymentamount
        $this->paymentamount->RowCssClass = "row";

        // dateuploaded
        $this->dateuploaded->RowCssClass = "row";

        // approved
        $this->approved->RowCssClass = "row";

        // uname
        $this->uname->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // res_id
            $this->res_id->ViewValue = $this->res_id->CurrentValue;

            // pool_id
            $this->pool_id->ViewValue = $this->pool_id->CurrentValue;
            $this->pool_id->ViewValue = FormatNumber($this->pool_id->ViewValue, $this->pool_id->formatPattern());

            // date
            $this->date->ViewValue = $this->date->CurrentValue;
            $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());

            // rate_id
            $this->rate_id->ViewValue = $this->rate_id->CurrentValue;
            $this->rate_id->ViewValue = FormatNumber($this->rate_id->ViewValue, $this->rate_id->formatPattern());

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

            // proofofpayment
            if (!EmptyValue($this->proofofpayment->Upload->DbValue)) {
                $this->proofofpayment->ViewValue = $this->res_id->CurrentValue;
                $this->proofofpayment->IsBlobImage = IsImageFile(ContentExtension($this->proofofpayment->Upload->DbValue));
            } else {
                $this->proofofpayment->ViewValue = "";
            }

            // paymentamount
            $this->paymentamount->ViewValue = $this->paymentamount->CurrentValue;

            // dateuploaded
            $this->dateuploaded->ViewValue = $this->dateuploaded->CurrentValue;

            // approved
            $this->approved->ViewValue = $this->approved->CurrentValue;
            $this->approved->ViewValue = FormatNumber($this->approved->ViewValue, $this->approved->formatPattern());

            // uname
            $this->uname->ViewValue = $this->uname->CurrentValue;

            // date
            $this->date->HrefValue = "";

            // rate_id
            $this->rate_id->HrefValue = "";

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

            // paymentamount
            $this->paymentamount->HrefValue = "";

            // dateuploaded
            $this->dateuploaded->HrefValue = "";

            // approved
            $this->approved->HrefValue = "";

            // uname
            $this->uname->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // date
            $this->date->setupEditAttributes();
            $this->date->EditValue = HtmlEncode(FormatDateTime($this->date->CurrentValue, $this->date->formatPattern()));
            $this->date->PlaceHolder = RemoveHtml($this->date->caption());

            // rate_id
            $this->rate_id->setupEditAttributes();
            $this->rate_id->EditValue = HtmlEncode($this->rate_id->CurrentValue);
            $this->rate_id->PlaceHolder = RemoveHtml($this->rate_id->caption());
            if (strval($this->rate_id->EditValue) != "" && is_numeric($this->rate_id->EditValue)) {
                $this->rate_id->EditValue = FormatNumber($this->rate_id->EditValue, null);
            }

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
            if (!$this->address->Raw) {
                $this->address->CurrentValue = HtmlDecode($this->address->CurrentValue);
            }
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

            // proofofpayment
            $this->proofofpayment->setupEditAttributes();
            if (!EmptyValue($this->proofofpayment->Upload->DbValue)) {
                $this->proofofpayment->EditValue = $this->res_id->CurrentValue;
                $this->proofofpayment->IsBlobImage = IsImageFile(ContentExtension($this->proofofpayment->Upload->DbValue));
            } else {
                $this->proofofpayment->EditValue = "";
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->proofofpayment);
            }

            // paymentamount
            $this->paymentamount->setupEditAttributes();
            if (!$this->paymentamount->Raw) {
                $this->paymentamount->CurrentValue = HtmlDecode($this->paymentamount->CurrentValue);
            }
            $this->paymentamount->EditValue = HtmlEncode($this->paymentamount->CurrentValue);
            $this->paymentamount->PlaceHolder = RemoveHtml($this->paymentamount->caption());

            // dateuploaded
            $this->dateuploaded->setupEditAttributes();
            if (!$this->dateuploaded->Raw) {
                $this->dateuploaded->CurrentValue = HtmlDecode($this->dateuploaded->CurrentValue);
            }
            $this->dateuploaded->EditValue = HtmlEncode($this->dateuploaded->CurrentValue);
            $this->dateuploaded->PlaceHolder = RemoveHtml($this->dateuploaded->caption());

            // approved
            $this->approved->setupEditAttributes();
            $this->approved->EditValue = HtmlEncode($this->approved->CurrentValue);
            $this->approved->PlaceHolder = RemoveHtml($this->approved->caption());
            if (strval($this->approved->EditValue) != "" && is_numeric($this->approved->EditValue)) {
                $this->approved->EditValue = FormatNumber($this->approved->EditValue, null);
            }

            // uname
            $this->uname->setupEditAttributes();
            if (!$this->uname->Raw) {
                $this->uname->CurrentValue = HtmlDecode($this->uname->CurrentValue);
            }
            $this->uname->EditValue = HtmlEncode($this->uname->CurrentValue);
            $this->uname->PlaceHolder = RemoveHtml($this->uname->caption());

            // Add refer script

            // date
            $this->date->HrefValue = "";

            // rate_id
            $this->rate_id->HrefValue = "";

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

            // paymentamount
            $this->paymentamount->HrefValue = "";

            // dateuploaded
            $this->dateuploaded->HrefValue = "";

            // approved
            $this->approved->HrefValue = "";

            // uname
            $this->uname->HrefValue = "";
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
        if ($this->date->Required) {
            if (!$this->date->IsDetailKey && EmptyValue($this->date->FormValue)) {
                $this->date->addErrorMessage(str_replace("%s", $this->date->caption(), $this->date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date->FormValue, $this->date->formatPattern())) {
            $this->date->addErrorMessage($this->date->getErrorMessage(false));
        }
        if ($this->rate_id->Required) {
            if (!$this->rate_id->IsDetailKey && EmptyValue($this->rate_id->FormValue)) {
                $this->rate_id->addErrorMessage(str_replace("%s", $this->rate_id->caption(), $this->rate_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->rate_id->FormValue)) {
            $this->rate_id->addErrorMessage($this->rate_id->getErrorMessage(false));
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
        if ($this->proofofpayment->Required) {
            if ($this->proofofpayment->Upload->FileName == "" && !$this->proofofpayment->Upload->KeepFile) {
                $this->proofofpayment->addErrorMessage(str_replace("%s", $this->proofofpayment->caption(), $this->proofofpayment->RequiredErrorMessage));
            }
        }
        if ($this->paymentamount->Required) {
            if (!$this->paymentamount->IsDetailKey && EmptyValue($this->paymentamount->FormValue)) {
                $this->paymentamount->addErrorMessage(str_replace("%s", $this->paymentamount->caption(), $this->paymentamount->RequiredErrorMessage));
            }
        }
        if ($this->dateuploaded->Required) {
            if (!$this->dateuploaded->IsDetailKey && EmptyValue($this->dateuploaded->FormValue)) {
                $this->dateuploaded->addErrorMessage(str_replace("%s", $this->dateuploaded->caption(), $this->dateuploaded->RequiredErrorMessage));
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
        if ($this->uname->Required) {
            if (!$this->uname->IsDetailKey && EmptyValue($this->uname->FormValue)) {
                $this->uname->addErrorMessage(str_replace("%s", $this->uname->caption(), $this->uname->RequiredErrorMessage));
            }
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

        // date
        $this->date->setDbValueDef($rsnew, UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern()), CurrentDate(), false);

        // rate_id
        $this->rate_id->setDbValueDef($rsnew, $this->rate_id->CurrentValue, 0, false);

        // fname
        $this->fname->setDbValueDef($rsnew, $this->fname->CurrentValue, "", false);

        // lname
        $this->lname->setDbValueDef($rsnew, $this->lname->CurrentValue, "", false);

        // address
        $this->address->setDbValueDef($rsnew, $this->address->CurrentValue, "", false);

        // contactno
        $this->contactno->setDbValueDef($rsnew, $this->contactno->CurrentValue, "", false);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, "", false);

        // proofofpayment
        if ($this->proofofpayment->Visible && !$this->proofofpayment->Upload->KeepFile) {
            if ($this->proofofpayment->Upload->Value === null) {
                $rsnew['proofofpayment'] = null;
            } else {
                $rsnew['proofofpayment'] = $this->proofofpayment->Upload->Value;
            }
        }

        // paymentamount
        $this->paymentamount->setDbValueDef($rsnew, $this->paymentamount->CurrentValue, "", false);

        // dateuploaded
        $this->dateuploaded->setDbValueDef($rsnew, $this->dateuploaded->CurrentValue, "", false);

        // approved
        $this->approved->setDbValueDef($rsnew, $this->approved->CurrentValue, 0, false);

        // uname
        $this->uname->setDbValueDef($rsnew, $this->uname->CurrentValue, "", false);

        // Update current values
        $this->setCurrentValues($rsnew);
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ApprovedReservationsList"), "", $this->TableVar, true);
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