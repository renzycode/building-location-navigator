<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>On point zoom with Scrollwheel</title>
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
  width: 200px;
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

    </style>
</head>

<body class="bg-secondary">
    




    <div class="outer-canvas">
        <div id="zoom">

            <div class="inner-canvas">
                <img src="layout.png" alt="zoom" id="layout-image">

                <button class="office bi bi-geo-alt-fill" type="button" onclick="show()" id="office1">KM</button>
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

    <div class="hud-canvas fixed-top m-5 p-1 bg-primary shadow" style="width: 88px;">
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

   <div class="hud-canvas fixed-top d-flex align-items-end flex-column " style="height: 200px;">
   
   <button class="btn btn-light mb-2 rounded-0 p-1"style="width: 80px;"><strong>Unit 1</strong></button>
        <button class="btn btn-light mb-2 rounded-0 p-2"  style="width: 80px;"><strong>Unit 2</strong></button>
        <button class="btn btn-light mb-2 rounded-0 p-2"   style="width: 80px;"><strong>Unit 3</strong></button>
       
 
</div>
   



    <div class="legend fixed-bottom m-5 p-2 bg-light border-primary border border-4 rounded-0 shadow">
    <h3>Departments</h3>
    <ul>
        <li><span class="square square-1"></span> <span>KM</span></li>
        <li><span class="square square-2"></span> <span>AO</span></li>
        <li><span class="square square-3"></span> <span>SUPPLY</span></li>
    </ul>
    </div>


    
    <script>
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