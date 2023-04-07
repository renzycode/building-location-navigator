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

    <style>
    #layout-image {

        width: 100%;

    }

    .inner-canvas {
        padding: 400px;
    }

    body {
        overflow: hidden;
        /* Hide scrollbars */
    }



    .office {
        position: absolute;
        cursor: pointer;
        text-align: center;
        font-family: Arial, Helvetica, sans-serif;
        color: RED;
        font-weight: bold;


    }


    #km {
        top: 1150px;
        left: 830px;

    }

    #office1_hover {
        top: 1125px;
        left: 800px;
    }

    #office2 {
        top: 500px;
        left: 740px;
    }

    #office3 {
        top: 750px;
        left: 650px;
    }





    .units {
        background-color: #EEB743;
    }

    .units-title {
        color: #0F9449;
    }

    .units h3 {
        font-size: 16px;
        margin-top: 0;
    }

    .units ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .units li {
        display: flex;
        align-items: center;
    }

    .units .square {
        width: 20px;
        height: 20px;
        margin-right: 10px;

    }

    .units .square-1 {
        background-color: #f00;

    }

    .units .square-2 {
        background-color: #0f0;
    }

    .units .square-3 {
        background-color: #00f;
    }

    .card {
        box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: 1rem;
    }

    .bgc-h-secondary-l3:hover,
    .bgc-secondary-l3 {
        background-color: #ebeff1 !important;
    }

    .h-4 {
        height: 2rem;
    }

    .w-4 {
        width: 2rem;
    }

    .d-zoom-1,
    .d-zoom-2,
    .d-zoom-3,
    .dh-zoom-1,
    .dh-zoom-2,
    .dh-zoom-3 {
        transition: -webkit-transform 180ms;
        transition: transform 180ms;
        transition: transform 180ms, -webkit-transform 180ms;
    }

    .mr-25,
    .mx-25 {
        margin-right: .75rem !important;
    }

    .p-25 {
        padding: .75rem !important;
    }

    .radius-1 {
        border-radius: .25rem !important;
    }

    [class*=bgc-h-] {
        transition: background-color .15s;
    }

    .text-default-d3 {
        color: #416578 !important;
    }

    .font-bolder,
    .text-600 {
        font-weight: 600 !important;
    }

    .text-90 {
        font-size: 0.7em !important;
    }


    .bgc-h-secondary-l4:hover,
    .bgc-secondary-l4 {
        background-color: #f2f4f6 !important;
    }

    .text-danger-m1 {
        color: #da3636 !important;
    }

    .text-green-m1 {
        color: #2c8d6a !important;
    }

    .text-95 {
        font-size: .95em !important;
    }

    .buttons-canvas {
        background-color: #EEB743;
    }

    .hovers {
        color: #fff;
        background-color: #0F9449;
        border: 10px;
        border-radius: 0.25rem !important;
    }

    .hovers:hover,
    .hovers:focus,
    .hovers:active,
    .hovers.active,
    .open>.dropdown-toggle.hovers {
        color: #fff;
        background-color: gray;
        border-radius: 0.25rem !important;
        box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
        /*transform: translateY(-0.25em);*/
    }

    .hover-unit {
        color: #fff;
        background-color: #0F9449;
        border: 10px;
        margin-left: 7px;
    }

    .hover-unit:hover,
    .hover-unit:focus,
    .hover-unit:active,
    .hover-unit.active,
    .open>.dropdown-toggle.hover-unit {
        color: #fff;
        background-color: #0F9449;
        border-radius: 0.25rem !important;
        box-shadow: 0 0.5em 0.5em -0.4em var(--hover);
        transform: translateY(-0.25em);

    }

    .hover-pinlocation {
        color: #fff;
        background-color: #0F9449;
        border: 10px;
        margin-left: 7px;
        width: 10vh;
        height: 10vh;
        border-radius: 50%;
        background-color: #dfd;
        outline: 1px solid transparent;
        animation: pulse 2.5s ease-in-out infinite;

    }

    .hover-pinlocation:hover,
    .hover-pinlocation:focus,
    .hover-pinlocation:active,
    .hover-pinlocation.active,
    .open>.dropdown-toggle.hover-pinlocation {
        color: #fff;
        background-color: #EEB743;
    }

    @keyframes pulse {
        0% {
            transform: scale(0);
            opacity: 0.8;
        }

        /* 50% { transform: scale(1); opacity: 0.3;} */
        100% {
            transform: scale(2);
            opacity: 0;
        }
    }

    </style>
</head>

<body class="bg-secondary">





    <div class="outer-canvas">
        <div id="zoom">

            <div class="inner-canvas">
                <img src="layout.png" alt="zoom" id="layout-image">

                
                <div class="office showkm" id="km">
                    <span class="bi bi-geo-alt-fill"></span>
                    <span class="text-90 mt-1 shadow rounded">KM UNIT</span>
                </div>
                <span class="hover-pinlocation-km office showkm"></span>


                <div class="office bi bi-geo-alt-fill" id="office2">SUPPLY</div>
                <div class="office bi bi-geo-alt-fill" id="office3">AO</div>

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
    <div class="hud-canvas fixed-top m-3 row" style="width: 500px;">

        <div class="col-3 mb-0">
            <div class="hud-canvas p-1 buttons-canvas rounded shadow mb-0" style="width: 88px;">

                <a href="index.php?floor=0" class="hovers-floor btn btn-success mb-2 rounded border-0 p-1" style="width: 80px; <?php echo ($floor0 ? ' background-color: #0d6a35 !important;' : '') ?> "><strong>FLOOR
                        0</strong></a>
                <a href="index.php?floor=1" class="hovers-floor btn btn-success mb-2 rounded border-0 p-1" style="width: 80px; <?php echo ($floor1 ? ' background-color: #0d6a35 !important;' : '') ?> "><strong>FLOOR
                        1</strong></a>
                <a href="index.php?floor=2" class="hovers-floor btn btn-success mb-2 rounded border-0 p-1" style="width: 80px; <?php echo ($floor2 ? ' background-color: #0d6a35 !important;' : '') ?> "><strong>FLOOR
                        2</strong></a>
                <a href="index.php?floor=3" class="hovers-floor btn btn-success mb-2 rounded border-0 p-1" style="width: 80px; <?php echo ($floor3 ? ' background-color: #0d6a35 !important;' : '') ?> "><strong>FLOOR
                        3</strong></a>
                <button class="hovers rounded btn-success btn mb-2 p-1" style="width: 80px;" onclick="zoomIn()">
                <button class="hovers btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR
                        0</strong></button>
                <button class="hovers btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR
                        1</strong></button>
                <button class="hovers btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR
                        2</strong></button>
                <button class="hovers btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR
                        3</strong></button>
                <button class="hovers btn btn-light mb-2 rounded-0 p-1" style="width: 80px;" onclick="zoomIn()">
                    <strong>
                        <h5 class="mb-0"><i class="bi bi-zoom-in"></h5></i>
                    </strong>
                </button>
                <button class="hovers rounded btn-success btn mb-2 p-1" style="width: 80px;" onclick="zoomOut()">
                    <strong>
                        <h5 class="mb-0"><i class="bi bi-zoom-out"></h5></i>
                    </strong>
                </button>
                <button class="hovers rounded btn-success btn" style="width: 80px;" onclick="reset()">
                    <strong>RESET</strong>
                    <br></button>
            </div>
        </div>

        <div class="col-9">
            <div class="units rounded shadow mb-2 p-2 ">
                <h3 class="units-title">FLOOR 1 UNITS</h3>
                <ul>
                    <button class="hover-unit btn-success btn p-1" type="button" onclick="goto(300,1000,4)">
                        <li> <span class="square square-1 mt-1 rounded"></span> <span class="text-90 mt-1">KM
                                UNIT</span></li>
                    </button>
                    <button class="hover-unit btn-success btn p-1" type="button">
                        <li> <span class="square square-2 mt-1 rounded"></span> <span class="text-90 mt-1">RESU
                                UNIT</span></li>
                    </button> 
                    <button class="hover-unit btn-success btn p-1" type="button">
                        <li> <span class="square square-3 mt-1 rounded"></span> <span class="text-90 mt-1">RLED
                                UNIT</span></li>
                    </button>
                </ul>
            </div>

            <div class="legend bg-light p-2 border-primary border border-4 rounded-0 shadow d-none" id="kmprofiles">
                <div class="card ccard radius-t-0 h-100">
                    <div class="position-tl w-102 border-t-3 brc-primary-tp3 ml-n1px mt-n1px"></div>
                    <!-- the blue line on top -->

                    <div class="card-header pb-3 brc-secondary-l3">
                        <h6 class="card-title mb-2 mb-md-0 text-dark-m3">
                            KM UNIT PROFILES
                        </h6>
                    </div>

                    <div class="card-body pt-2 pb-1">
                        <div role=" button"
                            class="d-flex flex-wrap align-items-center my-2 bgc-secondary-l4 bgc-h-secondary-l3 radius-1 p-25 d-style">
                            <span
                                class="mr-25 w-4 h-4 overflow-hidden text-center border-1 brc-secondary-m2 radius-round shadow-sm d-zoom-2">
                                <img alt="Alexa's avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png"
                                    class="h-4 w-4" />
                            </span>
                            <br>
                            <br>
                            <span class="text-default-d3 text-90 text-300 mb-0">
                                ARTHUR GWAPOTITO, HEAD OF THE HEAD UWU
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
                                DENNIS THE GREAT ELVIS, MANOG TAKOD UTP CABLE
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
                                VENUS RAHH RAH RAWR, TAGA TYPE EXCEL KAG PAPER WORKS
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
                                SIR PHIL, AND PERMI GA ML ajsdjd
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
                                SIR RALPH, ANG PERMI GA ORDER FAV SNG OJT
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

    function goto(argx,argy,argScale) {
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