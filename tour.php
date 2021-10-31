<?php
require('pagetemplate.php');
require('database.php');
use wip\pagetemplate;
session_start();
$ob = new pagetemplate();
$conn = createConnection();
?>

<div class="bodyPanel">

    <?php
        if($_SESSION["role"] == 1 || $_SESSION["role"] == 3 || $_SESSION["role"] == NULL){
            echo "<div class=\"panel searchPanel\">";
            echo "<div class=\"panelHeading\"><h5 class=\"title\"><b>Search for your major</b></h5></div>";
            echo "<div class=\"panelBody\">";
            echo "<p class=\"searchContainer\"><input type=\"text\" id=\"majorSearch\" placeholder=\"Search for your major here\"><button type=\"submit\" id=\"majorSearchSubmit\">Search</button>";
            echo "<button type=\"button\" id=\"clearSearch\">Clear</button></p>";
            echo "<p class=\"searchContainer\"><select id=\"majorDropdown\">";
            echo "<option selected=\"selected\">Select your major</option>";
            echo "</select></p>";
            echo "</div>";
            echo "</div>";
        }
        if($_SESSION["role"] == 2){
            echo "<div class=\"panel advisorPanel\">";
            echo "<div class=\"panelHeading\"><h5 class=\"title\"><b>Search for your students</b></h5></div>";
            echo "<div class=\"panelBody\">";
            echo "<p class=\"searchContainer\"><select id=\"studentDropdown\">";
            echo "<option selected=\"selected\">Select your student</option>";
            echo "</select><br>";
            echo "<input type=\"text\" id=\"majorPop\" disabled placeholder=\"Student's Major\">";
            echo "</input></p>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    <br>
    <div class="panel majorsPanel">
        <div class="panelHeading"><h5 class="title"><b>Major courses</b></h5></div>
        <div class="panelBody">
            <table id="majorCoursesTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalOnePanel">
        <div class="panelHeading"><h5 class="title"><b>Goal One courses</b></h5></div>
        <div class="panelBody">
            <table id="goalOneTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalTwoPanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Two courses</b></h5></div>
        <div class="panelBody" style="text-align:center;">
            <p><b>This is completed by completing all of the other goals</b></p>
        </div>
    </div>
    <br>
    <div class="panel goalThreePanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Three courses</b></h5></div>
        <div class="panelBody">
            <table id="goalThreeTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalFourPanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Four courses</b></h5></div>
        <div class="panelBody">
            <table id="goalFourTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalFivePanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Five courses</b></h5></div>
        <div class="panelBody">
            <table id="goalFiveTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalSixPanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Six courses</b></h5></div>
        <div class="panelBody">
            <table id="goalSixTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalSevenPanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Seven courses</b></h5></div>
        <div class="panelBody">
            <table id="goalSevenTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalEightPanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Eight courses</b></h5></div>
        <div class="panelBody">
            <table id="goalEightTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalNinePanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Nine courses</b></h5></div>
        <div class="panelBody">
            <table id="goalNineTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel goalTenPanel">
        <div class="panelHeading"><h5 class="title"><b>Goal Ten courses</b></h5></div>
        <div class="panelBody">
            <table id="goalTenTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel rigrPanel">
        <div class="panelHeading"><h5 class="title"><b>Racial Issues Graduation Requirement courses</b></h5></div>
        <div class="panelBody">
            <table id="rigrTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="panel libralStudiesPanel">
        <div class="panelHeading"><h5 class="title"><b>Liberal Studies courses</b></h5></div>
        <div class="panelBody">
            <table id="liberalStudiesTable">
                <tr>
                    <th>Class</th>
                    <th>Name</th>
                    <th>Credits</th>
                    <th>Completed?</th>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div id="spacer"></div>
</div>
<script src="js/tour.js"></script>
<?php
$ob->loadfooter();
?>

