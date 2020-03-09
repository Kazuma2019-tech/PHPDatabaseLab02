<?php

/**
 * Class: MainController
 * This is the main controller class for the web applicaiton
 *
 * @author gerry.guinane
 * 
 */
class MainController extends Controller {

    //properties
    private $postArray;     //a copy of the content of the $_POST superglobal array
    private $getArray;      //a copy of the content of the $_GET superglobal array
    private $viewData;          //an array containing page content generated using models
    private $mainControllerObjects;          //an array containing models used by the controller
    private $db; //database connection
    private $pageTitle;
    //methods

    function __construct($loggedin,$database) { //constructor   
        parent::__construct($loggedin);
        
        //initialise all the class properties
        $this->postArray = array();
        $this->getArray = array();
        $this->viewData=array();
        $this->mainControllerObjects=array();
        $this->db=$database;
        $this->pageTitle='College ONLINE';
    }

//end METHOD - constructor

    public function run() {  // run the controller
        $this->getUserInputs();
        $this->updateView();
    }

//end METHOD - run the controller

    public function getUserInputs() { // get user input
        //
        //This method is the main interface between the user and the controller.
        //
        //Get the $_GET array values
        $this->getArray = filter_input_array(INPUT_GET) ; //used for PAGE navigation
        
        //Get the $_POST array values
        $this->postArray = filter_input_array(INPUT_POST);  //used for form data entry and buttons
        
    }

//end METHOD - get user input

    public function updateView() { //update the VIEW based on the users page selection
        if (isset($this->getArray['pageID'])) { //check if a page id is contained in the URL
            switch ($this->getArray['pageID']) {
                case "home":
                    //create objects to generate view content
                    $home = new Home($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$home,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $home->getPageTitle();
                    $data['pageHeading'] = $home->getPageHeading();
                    $data['panelHeadRHS'] = $home->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $home->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $home->getPanelHead_2();
                    $data['stringLHS'] = $home->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $home->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $home->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php';  //load the view
                    break;
                case "messages":
                    //get the model
                    $messages = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$messages,$navigation);
                    //get the content from the model - put into the $data array for the view:
                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS                    
                    //get the content from the model - put into the $data array for the view:
                    $data['pageTitle'] = $messages->getPageTitle();
                    $data['pageHeading'] = $messages->getPageHeading();
                    $data['panelHeadRHS'] = $messages->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $messages->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $messages->getPanelHead_2();
                    $data['stringLHS'] = $messages->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $messages->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $messages->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view
                    break;
                case "register":
                    //get the model
                    $register = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$register,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the model - put into the $data array for the view:
                    $data['pageTitle'] = $register->getPageTitle();
                    $data['pageHeading'] = $register->getPageHeading();
                    $data['panelHeadRHS'] = $register->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $register->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $register->getPanelHead_2();
                    $data['stringLHS'] = $register->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $register->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $register->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view
                    break;
                case "account":
                    //create objects to generate view content
                    $account = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$account,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $account->getPageTitle();
                    $data['pageHeading'] = $account->getPageHeading();
                    $data['panelHeadRHS'] = $account->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $account->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $account->getPanelHead_2();
                    $data['stringLHS'] = $account->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $account->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $account->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view
                    break;
                case "calculator":
                    //create objects to generate view content
                    $calculator = new Calculator($this->loggedin, $this->postArray,$this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$calculator,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $calculator->getPageTitle();
                    $data['pageHeading'] = $calculator->getPageHeading();
                    $data['panelHeadRHS'] = $calculator->getPanelHead_2(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $calculator->getPanelHead_1(); // A string containing the LHS panel heading/title 
                    $data['stringLHS'] = $calculator->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $calculator->getPanelContent_2();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_2_panel.php'; //load the view
                    break;
                case 'login':
                    //create objects to generate view content
                    //$login = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $login = new Login($this->postArray, $this->pageTitle, strtoupper($this->getArray['pageID']), $this->db, $this->loggedin);
                    
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$login,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $login->getPageTitle();
                    $data['pageHeading'] = $login->getPageHeading();
                    $data['panelHeadRHS'] = $login->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $login->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $login->getPanelHead_2();
                    $data['stringLHS'] = $login->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $login->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $login->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view                  

                    break;
                case "logout":
                    //create objects to generate view content
                    $logout = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$logout,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $logout->getPageTitle();
                    $data['pageHeading'] = $logout->getPageHeading();
                    $data['panelHeadRHS'] = $logout->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $logout->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $logout->getPanelHead_2();
                    $data['stringLHS'] = $logout->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $logout->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $logout->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view                  


                    break;

                case"studentQuery":
                    //create objects to generate view content
                    //($loggedin,$postArray,$pageTitle,$pageHead,$database)
                    $student = new Student($this->loggedin,$this->postArray,$this->pageTitle,strtoupper($this->getArray['pageID']),$this->db);
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$student,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $student->getPageTitle();
                    $data['pageHeading'] = $student->getPageHeading();
                    $data['panelHeadRHS'] = $student->getPanelHead_2(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $student->getPanelHead_1(); // A string containing the LHS panel heading/title
                    //$data['panelHeadMID'] = $student->getPanelHead_2();
                    $data['stringLHS'] = $student->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    //$data['stringMID'] = $student->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $student->getPanelContent_2();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_2_panel.php'; //load the view
                    break;

                case "modules":
                    //create objects to generate view content
                    $modules = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$modules,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $modules->getPageTitle();
                    $data['pageHeading'] = $modules->getPageHeading();
                    $data['panelHeadRHS'] = $modules->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $modules->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $modules->getPanelHead_2();
                    $data['stringLHS'] = $modules->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $modules->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $modules->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view
                    break;
                
                case "grades":
                    //create objects to generate view content
                    $grades = new UnderConstruction($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$grades,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $grades->getPageTitle();
                    $data['pageHeading'] = $grades->getPageHeading();
                    $data['panelHeadRHS'] = $grades->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $grades->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $grades->getPanelHead_2();
                    $data['stringLHS'] = $grades->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $grades->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $grades->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php'; //load the view
                    break;
                
                default:
                    //no page selected 
                    //create objects to generate view content
                    $home = new Home($this->loggedin, $this->pageTitle, strtoupper($this->getArray['pageID']));
                    $navigation = new Navigation($this->loggedin, $this->getArray['pageID']);
                    array_push($this->mainControllerObjects,$home,$navigation);

                    //get the content from the navigation model - put into the $data array for the view:
                    $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
                    //get the content from the page content model  - put into the $data array for the view:
                    $data['pageTitle'] = $home->getPageTitle();
                    $data['pageHeading'] = $home->getPageHeading();
                    $data['panelHeadRHS'] = $home->getPanelHead_3(); // A string containing the RHS panel heading/title
                    $data['panelHeadLHS'] = $home->getPanelHead_1(); // A string containing the LHS panel heading/title
                    $data['panelHeadMID'] = $home->getPanelHead_2();
                    $data['stringLHS'] = $home->getPanelContent_1();     // A string intended of the Left Hand Side of the page
                    $data['stringMID'] = $home->getPanelContent_2();     // A string intended of the Left Hand Side of the page
                    $data['stringRHS'] = $home->getPanelContent_3();     // A string intended of the Right Hand Side of the page
                    $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
                    //update the view
                    include_once 'views/view_navbar_3_panel.php';
                    break;
            }
        } else {//no page selected and NO page ID passed in the URL 
            //no page selected - default loads HOME page
            //create objects to generate view content
            $home = new Home($this->loggedin, $this->pageTitle, 'HOME');
            $navigation = new Navigation($this->loggedin, 'home');
            array_push($this->mainControllerObjects,$home,$navigation);

            //get the content from the navigation model - put into the $data array for the view:
            $data['menuNav'] = $navigation->getMenuNav();       // an array of menu items and associated URLS
            //get the content from the page content model  - put into the $data array for the view:
            $data['pageTitle'] = $home->getPageTitle();
            $data['pageHeading'] = $home->getPageHeading();
            $data['panelHeadRHS'] = $home->getPanelHead_3(); // A string containing the RHS panel heading/title
            $data['panelHeadLHS'] = $home->getPanelHead_1(); // A string containing the LHS panel heading/title
            $data['panelHeadMID'] = $home->getPanelHead_2();
            $data['stringLHS'] = $home->getPanelContent_1();     // A string intended of the Left Hand Side of the page
            $data['stringMID'] = $home->getPanelContent_2();     // A string intended of the Left Hand Side of the page
            $data['stringRHS'] = $home->getPanelContent_3();     // A string intended of the Right Hand Side of the page
            $this->viewData = $data;  //put the content array into a class property for diagnostic purposes
            //update the view
            include_once 'views/view_navbar_3_panel.php';  //load the view
        }
    }

//end METHOD - update the VIEW based on the users page selection

    
    

    public function debug() {   //Diagnostics/debug information - dump the application variables if DEBUG mode is on
            echo '<section>';
            echo '<!-- The Debug SECTION -->';
            echo '<div class="container-fluid"   style="background-color: #AAAAAA">'; //outer DIV

            echo '<h2>Main Controller Class - Debug information</h2><br>';

            echo '<div class="container">';  //INNER DIV
            //SECTION 1
            echo '<section style="background-color: #AAAAAA">';
            echo '<h3>Main Controller (CLASS) properties</h3>';
            echo '<section style="background-color: #BBBBB">';
            echo '<h4>User Logged in Status:</h4>';
            echo '<section style="background-color: #FFFFFF">';
            if ($this->loggedin) {
                echo 'User Logged In state is TRUE ($loggedin) <br>';
            } else {
                echo 'User Logged In state is FALSE ($loggedin) <br>';
            }
            echo '</section>';

            echo '<h4>$postArray Values</h4>';
            echo '<pre>';
            var_dump($this->postArray);
            echo '</pre>';
            echo '<br>';

            echo '<h4>$getArray Values</h4>';
            echo '<pre>';
            var_dump($this->getArray);
            echo '</pre>';
            echo '<br>';

            echo '<h4>$data Array Values</h4>';
            echo '<pre>';
            var_dump($this->viewData);
            echo '</pre>';
            echo '<br>';
            echo '</section>';
            echo '</section>';


            //SECTION 2
            echo '<section style="background-color: #AAAAAA">';
            echo '<h3>SERVER - Super Global Arrays</h3>';

            echo '<section style="background-color: #AAAAAA">';
            echo '<h4>$_GET Arrays</h4>';
            echo '<section style="background-color: #FFFFFF">';
            echo '<table class="table table-bordered"><thead><tr><th>KEY</th><th>VALUE</th></tr></thead>';
            foreach ($_GET as $key => $value) {
                echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
            }
            echo '</table>';
            echo '</section>';

            echo '<h4>$_POST Array</h4>';
            echo '<section style="background-color: #FFFFFF">';
            echo '<table class="table table-bordered"><thead><tr><th>KEY</th><th>VALUE</th></tr></thead>';
            foreach ($_POST as $key => $value) {
                echo '<tr><td>' . $key . '</td><td>' . $value . '</td></tr>';
            }
            echo '</table>';
            echo '</section>';
            echo '</section>';
            echo '</section>';

            echo '</div>';  //END INNER DIV
            echo '</div>';  //END outer DIV
            echo '</section>';
        
    }

// end METHOD - Diagnostics/debug information       
    
}

//end CLASS
