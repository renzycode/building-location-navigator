<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>On point zoom with Scrollwheel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta https-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css" />
    <link rel="stylesheet" href="assets/vendor/fontawesome-free/css/all.min.css">
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
        border: 2px solid black;
        border-radius: 50%;
        background-color: #99B898;
        width: 80px;
        height: 50px;
        text-align: center;
        line-height: 50px;
        font-weight: bold;
        font-size: 20px;
    }

    #office1 {
        top: 600px;
        left: 750px;
    }

    #office2 {
        top: 800px;
        left: 1200px;
    }

    #office3 {
        top: 900px;
        left: 1050px;
    }

    




    </style>
</head>

<body class="bg-secondary">



    <div class="outer-canvas">
        <div id="zoom">

            <div class="inner-canvas">
                <img src="layout.png" alt="zoom" id="layout-image">
                <div class="office" id="office1">KM</div>
                <div class="office" id="office2">SUPPLY</div>
                <div class="office" id="office3">AO</div>



            </div>
        </div>



    </div>


    <div class="hud-canvas fixed-top m-5 p-2 bg-primary rounded shadow" style="width: 100px;">
        <button class="btn btn-light rounded mb-2" style="width: 85px;"> <strong>FLOOR</strong> <br> 0</button>
        <button class="btn btn-light rounded mb-2" style="width: 85px;"> <strong>FLOOR</strong> <br> 1</button>
        <button class="btn btn-light rounded mb-2" style="width: 85px;"> <strong>FLOOR</strong> <br> 2</button>
        <button class="btn btn-light rounded mb-2" style="width: 85px;"> <strong>FLOOR</strong> <br> 3</button>
        <button class="btn btn-light rounded" style="width: 85px;"> <strong>
                <h1 class="mb-0"><i class="bi bi-zoom-in"></h1></i>
            </strong></button>
        <button class="btn btn-light rounded" style="width: 85px;"> <strong>
                <h1 class="mb-0"><i class="bi bi-zoom-in"></h1></i>
            </strong></button>
    </div>





    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>



    </div>

    <div class="hud-canvas fixed-top m-5 p-2 bg-primary shadow" style="width: 100px;">
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;"> <strong>FLOOR</strong> <br> 0</button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;"> <strong>FLOOR</strong> <br> 1</button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;"> <strong>FLOOR</strong> <br> 2</button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;"> <strong>FLOOR</strong> <br> 3</button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;" onclick="zoomIn()">
            <strong>
                <h2 class="mb-0"><i class="bi bi-zoom-in"></h2></i>
            </strong>
        </button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;" onclick="zoomOut()">
            <strong>
                <h2 class="mb-0"><i class="bi bi-zoom-out"></h2></i>
            </strong>
        </button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 85px;" onclick="reset()"> <strong>RESET</strong> <br></button>
    </div>


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