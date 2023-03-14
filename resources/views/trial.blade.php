@extends('template')

@push('heads')
    <script async src="https://docs.opencv.org/3.4.15/opencv.js" onload="onOpenCvReady();" type="text/javascript"></script>
    <script src="https://cdn.rawgit.com/naptha/tesseract.js/1.0.10/dist/tesseract.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endpush
@section('content')
    <div class="header bg-default pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="/admin/dashboard"><i class="fas fa-home"
                                            style="color: #172B4D"></i></a></li>
                                <li class="breadcrumb-item"><a href="/admin/lihat-semua-data-akun"
                                        style="color: #172B4D">Form Input</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        @if ($notification = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $notification }}</strong>
            </div>
        @endif
        @if ($notification = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <strong>{{ $notification }}</strong>
            </div>
        @endif
        <div class="row">
            <div class="col-12" style="width: 100%;">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="huePlus">Hue+</label>
                                        <input type="range" id="huePlus" class="form-control" value="90"
                                            oninput="threshRange()" min="0" max="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="hueMinus">Hue-</label>
                                        <input type="range" id="hueMinus" class="form-control" value="0"
                                            oninput="threshRange()" min="0" max="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="saturationPlus">Saturation+</label>
                                        <input type="range" id="saturationPlus" class="form-control" value="255"
                                            oninput="threshRange()" min="0" max="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="saturationMinus">Saturation-</label>
                                        <input type="range" id="saturationMinus" class="form-control" value="0"
                                            oninput="threshRange()" min="0" max="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="valuePlus">Value+</label>
                                        <input type="range" id="valuePlus" class="form-control" value="255"
                                            oninput="threshRange()" min="0" max="255">
                                    </div>
                                    <div class="form-group">
                                        <label for="valueMinus">Value-</label>
                                        <input type="range" id="valueMinus" class="form-control" value="0"
                                            oninput="threshRange()" min="0" max="255">
                                    </div>
                                </div>
                                <div class="col d-flex align-items-center">
                                    <select name="type" id="" onchange="changeType()" class="form-control">
                                        <option value="Pilih">Pilih</option>
                                        <option value="Air">Air</option>
                                        <option value="Listrik">Listrik</option>
                                    </select>
                                    <button class="btn btn-success" onclick="saveConfig()">Save Config</button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center text-center">
                            <h1>Camera Capture</h1>
                        </div>
                        <div class="d-flex justify-content-center text-center">
                            <video id="camera-preview" width="640" height="480" autoplay style="display: none"></video>
                        </div>
                        <div class="d-flex justify-content-center text-center">
                            <select id="video-source" class="form-control"></select>
                        </div>

                        <div class="d-flex justify-content-center text-center">
                            <canvas id="camera-canvas" width="640" height="480" autoplay
                                style="display: none"></canvas>
                            <canvas id="threshold-canvas" width="640" height="480" autoplay></canvas>
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <button id="capture-btn" class="btn btn-success">Capture Image</button>
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <canvas id="image-canvas" width="640" height="480" style="display: block;"></canvas>
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <img id="captured-image" src="#" style="display: none;">
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <img id="bitmap-image" src="#" style="display: none;">
                        </div>

                        <form action="{{ route('detector.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label" for="meteran_value">Nilai Meteran</label>
                                <input type="text" id="meteran-value" name="meteran_value" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="type">Type</label>
                                <select name="type" id="" class="form-control" required>
                                    <option value="-">Choose</option>
                                    <option value="listrik">Listrik</option>
                                    <option value="air">Air</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="units_id">No Unit</label>
                                <select name="units_id" id="" class="form-control" required>
                                    <option value="-">Choose</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label" for="foto_bukti">Foto Bukti</label>
                                <input type="file" id="input-foto" name="foto_bukti" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let low;
        let high;

        let hueMin = 0;
        let hueMax = 90;
        let satMin = 0;
        let satMax = 255;
        let valMin = 0;
        let valMax = 255;

        function changeType() {
            const type = document.querySelector('select[name="type"]').value;
            $.ajax({
                url: '/get/config/' + type,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    hueMin = data.hueMin;
                    hueMax = data.hueMax;
                    satMin = data.satMin;
                    satMax = data.satMax;
                    valMin = data.valMin;
                    valMax = data.valMax;

                    hueMin = parseInt(hueMin);
                    hueMax = parseInt(hueMax);
                    satMin = parseInt(satMin);
                    satMax = parseInt(satMax);
                    valMin = parseInt(valMin);
                    valMax = parseInt(valMax);

                    // put the value to the slider
                    document.getElementById('hueMinus').value = hueMin;
                    document.getElementById('huePlus').value = hueMax;
                    document.getElementById('saturationMinus').value = satMin;
                    document.getElementById('saturationPlus').value = satMax;
                    document.getElementById('valueMinus').value = valMin;
                    document.getElementById('valuePlus').value = valMax;
                    console.log(hueMin, hueMax, satMin, satMax, valMin, valMax);
                }
            });
        }

        function saveConfig() {
            const type = document.querySelector('select[name="type"]').value;

            $.ajax({
                url: '/save/config/' + type,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    hueMin: hueMin,
                    hueMax: hueMax,
                    satMin: satMin,
                    satMax: satMax,
                    valMin: valMin,
                    valMax: valMax,
                },
                success: function(data) {
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Config has been saved',
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            });
        }

        function onOpenCvReady() {
            document.getElementById("hueMinus").addEventListener("input", updateThresholds);
            document.getElementById("huePlus").addEventListener("input", updateThresholds);
            document.getElementById("saturationMinus").addEventListener("input", updateThresholds);
            document.getElementById("saturationPlus").addEventListener("input", updateThresholds);
            document.getElementById("valueMinus").addEventListener("input", updateThresholds);
            document.getElementById("valuePlus").addEventListener("input", updateThresholds);

            const input = document.getElementById('input');
            // Get the preview video element
            const previewVideo = document.getElementById('camera-preview');
            const previewCanvas = document.getElementById('camera-canvas');
            const previewCtx = previewCanvas.getContext('2d');

            // Get the capture button element
            const captureBtn = document.getElementById('capture-btn');

            // Get the image canvas element
            const imageCanvas = document.getElementById('image-canvas');
            const imageCtx = imageCanvas.getContext('2d');

            // Get the captured image element
            const capturedImage = document.getElementById('captured-image');
            const bitmapImage = document.getElementById('bitmap-image');
            let valid_data = '';
            let prev_confidence = 0;

            const inputMeteran = document.getElementById('meteran-value');
            const inputFoto = document.getElementById('input-foto');

            //---> Thresholded image
            const thresholdCanvas = document.getElementById('threshold-canvas');
            const thresholdCtx = thresholdCanvas.getContext('2d');

            function update() {
                previewCtx.drawImage(previewVideo, 0, 0, previewCanvas.width, previewCanvas.height);

                requestAnimationFrame(update);

                // Call the OpenCV function to threshold the image
                let imageData = previewCtx.getImageData(160, 160, 320, 180);
                let srcMat = cv.matFromImageData(imageData);
                let hsvMat = new cv.Mat();
                cv.cvtColor(srcMat, hsvMat, cv.COLOR_RGB2HSV);
                let dstMat = new cv.Mat();


                // Define the lower and upper bounds of the color range to threshold
                let lower = new cv.Mat(hsvMat.rows, hsvMat.cols, hsvMat.type(), [hueMin, satMin, valMin, 0]);
                let upper = new cv.Mat(hsvMat.rows, hsvMat.cols, hsvMat.type(), [hueMax, satMax, valMax, 255]);

                // Threshold the image to get a binary mask
                let mask = new cv.Mat();
                cv.inRange(hsvMat, lower, upper, mask);

                // Apply the mask to the input image to get the result
                let result = new cv.Mat();
                // cv.bitwise_and(srcMat, srcMat, dstMat, mask);

                // Display the thresholded image
                cv.imshow('threshold-canvas', mask);

                // Delete the old Mat objects
                srcMat.delete();
                hsvMat.delete();
                dstMat.delete();
            }

            navigator.mediaDevices.enumerateDevices()
                .then(devices => {
                    let videoSourcesSelect = document.getElementById("video-source");
                    navigator.mediaDevices.getUserMedia({
                            video: true
                        })
                        .then(stream => {
                            previewVideo.srcObject = stream;
                            previewVideo.addEventListener('loadeddata', () => {
                                previewVideo.play();
                                update();
                            });


                        })
                        .catch(error => {
                            console.error('Error accessing user camera:', error);
                        });
                    devices.forEach(device => {
                        if (device.kind === 'videoinput') {
                            let option = document.createElement('option');
                            option.value = device.deviceId;
                            option.text = device.label;
                            videoSourcesSelect.appendChild(option);
                        }

                        videoSourcesSelect.onchange = () => {
                            let videoSource = videoSourcesSelect.value;
                            let constraints = {
                                video: {
                                    deviceId: videoSource ? {
                                        exact: videoSource
                                    } : undefined
                                }
                            };
                            navigator.mediaDevices.getUserMedia(constraints)
                                .then(stream => {
                                    previewVideo.srcObject = stream;
                                    previewVideo.addEventListener('loadeddata', () => {
                                        previewVideo.play();
                                        update();
                                    });
                                })
                                .catch(error => {
                                    console.error('Error accessing user camera:', error);
                                });
                        };
                    });
                })
                .catch(err => {
                    console.log("ini error");
                    console.log(err.name, err.message);
                });

            captureBtn.addEventListener('click', async () => {
                // Pause the video stream
                // previewVideo.paus÷ ÷e();

                imageCtx.drawImage(previewVideo, 0, 0, imageCanvas.width, imageCanvas.height);
                // let imageData = imageCtx.getImageData(0, 0, imageCanvas.width, imageCanvas.height);
                // let srcMat = cv.matFromImageData(imageData);
                // let dstMat = new cv.Mat();

                let maskImageData = null;


                // Call the OpenCV function to threshold the image
                let imageData = previewCtx.getImageData(160, 160, 320, 180);
                let srcMat = cv.matFromImageData(imageData);
                let hsvMat = new cv.Mat();
                cv.cvtColor(srcMat, hsvMat, cv.COLOR_RGB2HSV);
                let dstMat = new cv.Mat();


                // Define the lower and upper bounds of the color range to threshold
                let lower = new cv.Mat(hsvMat.rows, hsvMat.cols, hsvMat.type(), [hueMin, satMin, valMin, 0]);
                let upper = new cv.Mat(hsvMat.rows, hsvMat.cols, hsvMat.type(), [hueMax, satMax, valMax, 255]);

                // Threshold the image to get a binary mask
                let mask = new cv.Mat();
                cv.inRange(hsvMat, lower, upper, mask);

                // Apply the mask to the input image to get the result
                let result = new cv.Mat();
                // cv.bitwise_and(srcMat, srcMat, dstMat, mask);

                cv.imshow('image-canvas', mask);

                maskImageData = document.getElementById('image-canvas').getContext('2d').getImageData(0, 0, mask
                    .cols,
                    mask.rows);

                // get image data from canvas
                const imgData = document.getElementById('image-canvas').getContext('2d').getImageData(0, 0, mask
                    .cols, mask.rows);

                // do some processing until the Tesseract recognize the text
                let canvas = document.createElement('canvas');
                canvas.width = mask.cols;
                canvas.height = mask.rows;
                let context = canvas.getContext('2d');
                context.putImageData(maskImageData, 0, 0);
                let imgBuffer = canvas.toDataURL('image/png');
                console.log(imgBuffer);
                try {
                    Tesseract.recognize(imgBuffer, 'eng', {
                        logger: m => console.log(m)
                    }).then((data) => {
                        console.log(data.text);
                        // get the recognized data.text that only contains numbers
                        let numbers = data.text.match(/\d+/g).map(Number);
                        Swal.fire({
                            title: 'Your number is',
                            text: numbers[0],
                            icon: 'success',
                            confirmButtonText: 'Cool'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                inputMeteran.value = numbers[0];

                            }
                        })
                    });
                } catch (err) {
                    console.log(err);
                }
                srcMat.delete();
                hsvMat.delete();
                mask.delete();
            });
        }

        function updateThresholds() {
            // Get the slider values
            hueMin = parseInt(document.getElementById("hueMinus").value);
            hueMax = parseInt(document.getElementById("huePlus").value);
            satMin = parseInt(document.getElementById("saturationMinus").value);
            satMax = parseInt(document.getElementById("saturationPlus").value);
            valMin = parseInt(document.getElementById("valueMinus").value);
            valMax = parseInt(document.getElementById("valuePlus").value);

            // Set the threshold values
            low = new cv.Mat(1, 3, cv.CV_8UC1);
            high = new cv.Mat(1, 3, cv.CV_8UC1);
            low.data.set([hueMin, satMin, valMin]);
            high.data.set([hueMax, satMax, valMax]);

            // Delete the old threshold Mat objects
            if (typeof low !== "undefined") {
                low.delete();
            }
            if (typeof high !== "undefined") {
                high.delete();
            }

            console.log(low);
            console.log(hueMin, hueMax, satMin, satMax, valMin, valMax);


        }
        $(document).ready(function() {

            function handleVideo(cameraFacing) {
                const constraints = {
                    video: {
                        facingMode: {
                            exact: cameraFacing
                        }
                    }
                }
                return constraints
            };

            function turnVideo(constraints) {
                navigator.mediaDevices.getUserMedia(constraints)
                    .then(stream => {
                        previewVideo.srcObject = stream;
                        previewVideo.addEventListener('loadeddata', () => {
                            previewVideo.play();
                            update();
                        });
                    })
                    .catch(error => {
                        console.error('Error accessing user camera:', error);
                    });
            }
        });
    </script>

    <style>
        #camera-preview {
            width: 50%;
            height: 50%;
            object-fit: cover;
        }
    </style>
@endsection
