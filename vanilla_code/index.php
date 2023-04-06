<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Building Location Navigator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta https-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css" />
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
        line-height: 50px;
        font-weight: bold;
        font-size: 30px;
        color: red;


    }


    #office1 {
        top: 1150px;
        left: 490px;

    }

    #office2 {
        top: 500px;
        left: 740px;
    }

    #office3 {
        top: 750px;
        left: 650px;
    }





    .legend {
        width: px;
        padding: 2px;
        border: 3px solid #ccc;
        border-radius: 5px;

    }

    .legend h3 {
        font-size: 16px;
        margin-top: 0;
    }

    .legend ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .legend li {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .legend .square {
        width: 20px;
        height: 20px;
        margin-right: 10px;

    }

    .legend .square-1 {
        background-color: #f00;
    }

    .legend .square-2 {
        background-color: #0f0;
    }

    .legend .square-3 {
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
    </style>
</head>

<body class="bg-secondary">





    <div class="outer-canvas">
        <div id="zoom">

            <div class="inner-canvas">
                <img src="layout.png" alt="zoom" id="layout-image">

                <button class="office bi bi-geo-alt-fill showkm" type="button" id="office1">KM</button>
                <img id="image" src="" class="office" />

                <div class="office bi bi-geo-alt-fill" id="office2">SUPPLY</div>
                <div class="office bi bi-geo-alt-fill" id="office3">AO</div>

            </div>
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


    <div class="hud-canvas fixed-top m-5 p-1 bg-primary shadow d-none" style="width: 88px;">
        <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 0</strong></button>
        <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 1</strong></button>
        <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 2</strong></button>
        <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 3</strong></button>
        <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;" onclick="zoomIn()">
            <strong>
                <h5 class="mb-0"><i class="bi bi-zoom-in"></h5></i>
            </strong>
        </button>
        <button class="btn btn-light mb-2 rounded-0" style="width: 80px;" onclick="zoomOut()">
            <strong>
                <h5 class="mb-0"><i class="bi bi-zoom-out"></h5></i>
            </strong>
        </button>
        <button class="btn btn-light rounded-0" style="width: 80px;" onclick="reset()"> <strong>RESET</strong>
            <br></button>
    </div>


    <div class="hud-canvas fixed-top m-3 row" style="width: 500px;">

        <div class="col-3 mb-0">
            <div class="hud-canvas p-1 bg-primary shadow mb-0" style="width: 88px;">
                <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 0</strong></button>
                <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 1</strong></button>
                <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 2</strong></button>
                <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;"><strong>FLOOR 3</strong></button>
                <button class="btn btn-light mb-2 rounded-0 p-1" style="width: 80px;" onclick="zoomIn()">
                    <strong>
                        <h5 class="mb-0"><i class="bi bi-zoom-in"></h5></i>
                    </strong>
                </button>
                <button class="btn btn-light mb-2 rounded-0" style="width: 80px;" onclick="zoomOut()">
                    <strong>
                        <h5 class="mb-0"><i class="bi bi-zoom-out"></h5></i>
                    </strong>
                </button>
                <button class="btn btn-light rounded-0" style="width: 80px;" onclick="reset()"> <strong>RESET</strong>
                    <br></button>
            </div>
        </div>

        <div class="col-9">
            <div class="legend bg-light border-primary border border-4 rounded-0 shadow mb-2 p-2">
                <h3>UNITS</h3>
                <ul>
                    <button class="btn p-0" type="button">
                        <li> <span class="square square-1"></span> <span class="text-90">KM UNIT</span></li>
                    </button>
                    <button class="btn p-0" type="button">
                        <li> <span class="square square-2"></span> <span class="text-90">RESU UNIT</span></li>
                    </button>
                    <button class="btn p-0" type="button">
                        <li> <span class="square square-3"></span> <span class="text-90">RLED UNIT</span></li>
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
                        <div role="button"
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

    function show() {

        /* Get image and change value
        of src attribute */
        let image = document.getElementById("image");

        image.src =
            "km-profile.PNG"

        document.getElementById("office1")
            .style.display = "";


    }
    </script>
    <script>
    document.getElementById("image").onclick = function(e) {
        e.target.style.visibility = 'hidden';
    }
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