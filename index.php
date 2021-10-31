<?php
    require('pagetemplate.php');
    require('database.php');
    $conn = createConnection();

    use wip\pagetemplate;
    $ob = new pagetemplate();

?>
<br><br>
<div class="container-fluid aboutText">
    <div class="row">
        <div class="col-sm-8">
            <h2>Work in Progress,</h2>
            <h4>just like you!</h4>
            <p>Getting a degree in the most efficient, clear way we can.</p>
            <button class="btn btn-default btn-lg" onclick="location.href='tour.php'">Learn More</button>
        </div>
        <div class="col-sm-4 aboutImg">
            <img src="img/wip_b_01.jpg">

        </div>
    </div>
</div>

<hr>
<br>

<div class="container-fluid bg-3 text-center">
    <h3>OUR GOALS</h3>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <i class="fas fa-chart-bar fa-4x"></i>
            <br>
            <h3>Decrease unnecessary Classes</h3>
            <p>The average attainer of a Bachelors degree completes 133 credits on average. Whereas
                the typical degree only requires 120 credits. That's an extra $17,810 more than needed!</p>
        </div>
        <div class="col-sm-4">
            <i class="fas fa-brain fa-4x"></i>
            <br>
            <h3>Clarity</h3>
            <p>Many students report that contacting an advisor is difficult, and even when they do it may
             not be clear what steps they need to take. This woudl provide all the information
                directly to the user in a clear way</p>
        </div>
        <div class="col-sm-4">
            <i class="fas fa-check-circle fa-4x"></i>
            <br>
            <h3>Simplicity</h3>
            <p>A contributing factor for creation of our tool is to simplify the degree acquisition process.</p>
        </div>
    </div>
</div>

<?php
    $ob->loadfooter();
?>

