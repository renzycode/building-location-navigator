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

    <?php include_once 'unitsData.php'; ?>

    <div class="outer-canvas">
        <div id="zoom">
            
            <!-- map canvas -->
            <div class="inner-canvas">
                <img src="floor-images/1.png" alt="zoom" id="layout-image">
                
                <?php
                foreach($units as $unit){
                    echo '
                    <div>   
                        <!-- pinpoint -->
                        <div class="office" style="';



                        if(isset($_GET['active'])){
                            if($_GET['active']==$unit['shortName']){
                                echo 'animation: bounce 1s infinite;';
                            }
                        }
                        
                        echo '
                        color: rgba('.$unit['rgbColor'].');
                        top: '.$unit['pinPointTopLocation'].'px;
                        left: '.$unit['pinPointLeftLocation'].'px;
                        ">
                            <span class="bi bi-geo-alt-fill"></span>
                        </div>

                        <!-- pulse -->
                        <span class="';
                        

                        if(isset($_GET['active'])){
                            if($_GET['active']==$unit['shortName']){
                                echo 'pin-pulse';
                            }
                        }

                        echo ' office" style="
                        background-color: rgba('.$unit['rgbColor'].', 0.3);
                        top: '.$unit['pulseTopLocation'].'px;
                        left: '.$unit['pulseLeftLocation'].'px;
                        "></span>
                    </div>
                    ';
                }
                ?>

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

        <!-- start navigation HUD -->
        <div class="col-3 mb-0">
            <div class="hud-canvas p-1 buttons-canvas rounded-0 shadow mb-0" style="width: 93px;">

                <a href="index.php?floor=0" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px; background-color: #3c8f76 !important;">1st Floor</a>

                <a href="index.php?floor=1" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px;">2nd Floor</a>

                <a href="index.php?floor=2" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px;">3rd Floor</a>

                <a href="index.php?floor=3" class="hovers-floor btn btn-success mb-2 rounded-0 border-0 p-1"
                    style="width: 80px;">4th Floor</a>

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
                <a href="floor1.php" class="hovers btn btn-success rounded-0" style="width: 80px;" onclick="reset()">
                    RESET
                    <br></a>
            </div>
        </div>
        <!-- end navigation HUD -->

        <div class="col-9">
            <div class="units rounded-0 shadow mb-2">
                <h3 class="units-title p-2 mb-0">FLOOR 1 UNITS</h3>
                <div class="p-2">

                    <?php
                    foreach($units as $unit){
                        echo '<a href="floor1.php?active='.$unit['shortName'].'&goto='.$unit['gotoLocation'].'" class="btn text-light rounded-0 m-1 p-0 px-1" onclick="goto('.$unit['gotoLocation'].')"
                        style="font-size: 15px; background-color: rgba('.$unit['rgbColor'].');">'.$unit['shortName'].'</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

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

    <?php
        if(isset($_GET['goto'])){
            $goto_array = preg_split("/\,/", $_GET['goto']);
            echo '
            scale = '.$goto_array[2].';
            pointX = '.$goto_array[0].';
            pointY = '.$goto_array[1].';
            setTransform();
            ';
        }
        
    ?>

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