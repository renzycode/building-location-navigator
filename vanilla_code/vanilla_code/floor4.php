   <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>DOH INTERACTIVE MAP</title>
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
                <img src="assets\images\2nd.png" alt="zoom" id="layout-image">

                <div>
                    <div class="office showkm" style="
                    animation: bounce 1s infinite;
                    color: RED;
                    top: 280px;
                    left: 600px;
                    ">
                        <span class="bi bi-geo-alt-fill"></span>
                    </div>
                    <span class="hover-pinlocation office showkm" style="
                    background-color: rgba(247, 0, 0, 0.3);
                    top: 255px;
                    left: 575px;
                    "></span>
                </div>

                <div>
                    <div class="office showkm" style="
                    animation: bounce 1s infinite;
                    color: rgba(247, 0, 123);
                    top: 400px;
                    left: 800px;
                    ">
                        <span class="bi bi-geo-alt-fill"></span>
                    </div>
                    <span class="hover-pinlocation office showkm" style="
                    background-color: rgba(247, 0, 123, 0.3);
                    top: 400px;
                    left: 800px;
                    "></span>
                </div>

                <div>
                    <div class="office showkm" style="
                    animation: bounce 1s infinite;
                    color: rgba(5, 512, 5);
                    top: 600px;
                    left: 600px;
                    ">
                        <span class="bi bi-geo-alt-fill"></span>
                    </div>
                    <span class="hover-pinlocation office showkm" style="
                    background-color: rgba(5, 512, 5, 0.3);
                    top: 600px;
                    left: 600px;
                    "></span>
                </div>

            </div>
        </div>
    </div>

    <?php
    $floor0=FALSE;
    $floor1=FALSE;
    $floor2=FALSE;
    $floor3=FALSE;
    if(isset($_GET['floor'])){
        if($_GET['floor']==0){
            $floor0=TRUE;
        }elseif($_GET['floor']==1){
            $floor1=TRUE;
        }elseif($_GET['floor']==2){
            $floor2=TRUE;
        }elseif($_GET['floor']==3){
            $floor3=TRUE;
        }
    }
?>
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

                <a href="index.php?floor=0" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor0 ? ' background-color: #3c8f76 !important;' : '') ?> "> 1st FLOOR
                    </a>
                <a href="floor2.php?floor=1" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor1 ? ' background-color: #3c8f76 !important;' : '') ?> ">2nd FLOOR
                    </a>
                <a href="floor3.php?floor=2" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor2 ? ' background-color: #3c8f76 !important;' : '') ?> ">3rd FLOOR
                    </a>
                <a href="floor4.php?floor=3" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; <?php echo ($floor3 ? ' background-color: #3c8f76 !important;' : '') ?> ">4th FLOOR
                    </a>

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
                <h3 class="units-title p-2 mb-0">FOURTH FLOOR UNITS</h3>
                <div class="p-2">
                    <span class="btn btn-danger rounded-0 p-0 px-1" onclick="goto(500,1000,4)"
                        style="font-size: 15px;">FUNCTION HALL</span>
                    <span class="btn btn-info rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">CANTEEN</span>
                    <span class="btn btn-success rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">RD</span>
                    <span class="btn btn-primary rounded-0 p-0 px-1" onclick="goto(300,1000,4)"
                        style="font-size: 15px;">ADMIN</span>
                </div>
            </div>
            <div class="units rounded-0 shadow mb-2 bounce d-none" id="kmprofiles">
                <h3 class="units-title p-2 mb-0">ADMIN PROFILES</h3>
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
                                Arthur Defensor
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
                                Arthur Defensor
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




            <div class="legend d-none">
                <!-- <div class="legend bg-light p-2 border-primary border border-4 rounded-0 shadow d-none" id="kmprofiles"> -->
                <div class="card ccard radius-t-0 h-100">
                    <div class="position-tl w-102 border-t-3 brc-primary-tp3 ml-n1px mt-n1px"></div>
                    <!-- the blue line on top -->

                    <div class="card-header pb-3 brc-secondary-l3">
                        <h6 class="card-title mb-2 mb-md-0 text-dark-m3">
                            KM PROFILES
                        </h6>
                    </div>

                    <div class="card-body pt-2 pb-1">
                        <div class="col-3">
                            <span
                                class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                    class="h-4 w-4" />
                            </span>
                            <span class="text-default-d3 text-90 text-300 mb-0">
                                ARTHUR
                            </span>
                        </div>

                        <div role="button"
                            class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                            <span
                                class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                <img alt="Derek's avatar" src="https://bootdey.com/img/Content/avatar/avatar2.png"
                                    class="h-4 w-4" />
                            </span>
                            <br>
                            <br>
                            <span class="text-default-d3 text-90 text-300 mb-0">
                                DENNIS
                            </span>


                        </div>
                        <div role="button"
                            class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                            <span
                                class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                <img alt="Antonio's avatar" src="https://bootdey.com/img/Content/avatar/avatar3.png"
                                    class="h-4 w-4" />
                            </span>
                            <br>
                            <br>
                            <span class="text-default-d3 text-90 text-300 mb-0">
                                VENUS
                            </span>


                        </div>
                        <div role="button"
                            class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                            <span
                                class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                <img alt="Gabriel's avatar" src="https://bootdey.com/img/Content/avatar/avatar4.png"
                                    class="h-4 w-4" />
                            </span>
                            <br>
                            <br>
                            <span class="text-default-d3 text-90 text-300 mb-0">
                                SIR PHIL
                            </span>


                        </div>
                        <div role="button"
                            class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                            <span
                                class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                <img alt="David's avatar" src="https://bootdey.com/img/Content/avatar/avatar5.png"
                                    class="h-4 w-4" />
                            </span>
                            <br>
                            <br>
                            <span class="text-default-d3 text-90 text-300 mb-0">
                                SIR RALPH
                            </span>


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
        $(".showkm").click(function() {
            $("#kmprofiles").toggleClass("d-none");
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