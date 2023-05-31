<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Building Location Navigator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta https-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/css/custom.css" />
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-secondary">





    <div class="outer-canvas">
        <div id="zoom">

            <div class="inner-canvas">
                <img src="assets\images\4th.png" alt="zoom" id="layout-image">
                <?php
                $floor0=FALSE;
                $floor1=FALSE;
                $floor2=FALSE;
                $floor3=FALSE;
                if(isset($_GET['floor'])){
                    if($_GET['floor']==1){
                        $floor1=TRUE;
                    }elseif($_GET['floor']==2){
                        $floor2=TRUE;
                    }elseif($_GET['floor']==3){
                        $floor3=TRUE;
                    }elseif($_GET['floor']==4){
                        $floor4=TRUE;
                    }
                }else{
                    echo '<script> window.location.href = "index.php?floor=1"; </script>';
                }
                if($_GET['floor']==1){
                    echo '<img src="1.jpg" alt="zoom" id="layout-image">';
                }elseif($_GET['floor']==2){
                    echo '<img src="2.png" alt="zoom" id="layout-image">';
                }elseif($_GET['floor']==3){
                    echo '<img src="3.jpg" alt="zoom" id="layout-image">';
                }
                ?>

                <div>
                    <div class="office showcanteen" style="
                    animation: bounce 1s infinite;
                    color: RED;
                    top: 285px;
                    left: 600px;
                    ">
                        <span class="bi bi-geo-alt-fill"></span>
                    </div>
                    <span class="pin-pulse office showcanteen" style="
                    background-color: rgba(247, 0, 0, 0.3);
                    top: 255px;
                    left: 575px;
                    "></span>
                </div>

                
            </div>
        </div>
    </div>

    <div class="hud-canvas fixed-top p-3 row" style="width: 500px; 
    background: rgba( 255, 255, 255, 0.1 );
    box-shadow: 0 8px 32px 0 rgba( 0, 0, 0, 0 );
    backdrop-filter: blur( 3px );
    -webkit-backdrop-filter: blur( 3px );
    border-radius: 0 0 10px 0;
    /*border: 1px solid rgba( 255, 255, 255, 0.18 );*/
">

        <div class="col-3 mb-0">
            <div class="hud-canvas p-1 buttons-canvas rounded-0 shadow mb-0" style="width: 93px;">

            <a href="index.php?floor=1" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor1 ? ' background-color: #3c8f76 !important;' : '') ?> ">FLOOR
                    1</a>
                <a href="floor2.php?floor=2" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor2 ? ' background-color: #3c8f76 !important;' : '') ?> ">FLOOR
                    2</a>
                <a href="floor3.php?floor=3" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor3 ? ' background-color: #3c8f76 !important;' : '') ?> ">FLOOR
                    3</a>
                <a href="floor4.php?floor=4" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor4 ? ' background-color: #3c8f76 !important;' : '') ?> ">FLOOR
                    4</a>

                <button class="hovers btn btn-success rounded-0 mb-2 p-1" style="width: 80px;" onclick="zoomIn()">
                    <strong>
                        <h5 class="mb-0"><i class="bi bi-zoom-in"></h5></i>
                    </strong>
                </button>
                <button class="hovers btn btn-success rounded-0 mb-2 p-1" style="width: 80px;" onclick="zoomOut()">
                    <strong>
                        <h5 class="mb-0"><i class="bi bi-zoom-out"></h5></i>
                    </strong>
                </button>
                <button class="hovers btn btn-success rounded-0" style="width: 80px;" onclick="reset()">
                    RESET
                    <br></button>
            </div>
        </div>


        <div class="col-9">
            <div class="units rounded-0 shadow mb-2">
                <h3 class="units-title p-2 mb-0">4th FLOOR UNITS</h3>
                <div class="p-2">
                    <span class="btn btn-danger rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">FH</span>
                    <span class="btn btn-info rounded-0 p-0 px-1" onclick="goto(250,800,5)"
                        style="font-size: 15px;">Canteen</span>
                    <span class="btn btn-success rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">ADMIN</span>
                    <span class="btn btn-secondary rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">RD</span>
                    <span class="btn btn-danger rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">DINING</span>
                </div>
            </div>

            <div class="units rounded-0 shadow mb-2 bounce d-none" id="canteenprofiles">
                <h3 class="units-title p-2 mb-0">CANTEEN PROFILES</h3>
                <div class="p-2 m-2">
                    <div class="row">

                    <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Arthur 
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                            Venus 
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Phil
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar4.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Denis
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Arthur
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Venus 
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Phil
                            </p>
                        </div>
                        <div class="col-3 profile-box">
                            <span class="overflow-hidden">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar4.png"
                                    class="h-4 w-4 mx-auto d-flex justify-content-center m-1" />
                            </span>
                            <p class="text-default-d3 text-90 text-300 mb-0 text-center">
                                Denis
                            </p>
                        </div>

                    </div>

                </div>
            </div>
            
        </div>

    </div>




    <!--div class="legend fixed-bottom m-5 p-2 bg-light border-primary border border-4 rounded-0 shadow">
        <h3>Departments</h3>
        <ul>
            <li><span class="square square-1"></span> <span>KM</span></li>
            <li><span class="square square-2"></span> <span>AO</span></li>
            <li><span class="square square-3"></span> <span>SUPPLY</span></li>
        </ul>
    </div-->

    <script src="assets\vendor\jquery\jquery.min.js"></script>




    <script>
    $(document).ready(function() {
        $(".showcanteen").click(function() {
            $("#canteenprofiles").toggleClass("d-none");
        });
    })
    </script>


    <script>
    var scale = 1,
        panning = false,
        pointX = 0,
        pointY = 0,
        start = {
            x: 0,
            y: 0
        },
        zoom = document.getElementById("zoom");

    function setTransform() {
        zoom.style.transform = "translate(" + pointX + "px, " + pointY + "px) scale(" + scale + ")";
    }

    zoom.onmousedown = function(e) {
        e.preventDefault();
        start = {
            x: e.clientX - pointX,
            y: e.clientY - pointY
        };
        panning = true;
    }

    zoom.onmouseup = function(e) {
        panning = false;
    }

    zoom.onmousemove = function(e) {
        e.preventDefault();
        if (!panning) {
            return;
        }
        pointX = (e.clientX - start.x);
        pointY = (e.clientY - start.y);
        setTransform();
    }

    zoom.onwheel = function(e) {
        e.preventDefault();
        var xs = (e.clientX - pointX) / scale,
            ys = (e.clientY - pointY) / scale,
            delta = (e.wheelDelta ? e.wheelDelta : -e.deltaY);
        (delta > 0) ? (scale *= 1.2) : (scale /= 1.2);
        pointX = e.clientX - xs * scale;
        pointY = e.clientY - ys * scale;

        setTransform();
    }


    $('#exampleModal').on('shown.bs.modal', function() {
        $('#modal').trigger('focus')
    })

    function zoomIn() {
        scale = scale + 0.1;
        setTransform();
    }

    function goto(argx, argy, argScale) {
        scale = argScale;
        pointX = argx;
        pointY = argy;
        setTransform();
    }

    function zoomOut() {
        scale = scale - 0.1;
        setTransform();
    }

    function reset() {
        scale = 1;
        panning = false;
        pointX = 0;
        pointY = 0;
        start = {
            x: 0,
            y: 0
        };
        setTransform();
    }
    </script>




</body>

</html>