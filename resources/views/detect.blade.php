@extends('template')
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
                            <canvas id="camera-canvas" width="640" height="480" autoplay></canvas>
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <button id="capture-btn" class="btn btn-success">Capture Image</button>
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <canvas id="image-canvas" width="640" height="480" style="display: none;"></canvas>
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <img id="captured-image" src="#" style="display: none;">
                        </div>
                        <div class="d-flex justify-content-center text-center my-5">
                            <img id="bitmap-image" src="#" style="display: none;">
                        </div>

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label" for="meteran_value">Nilai Meteran</label>
                                <input type="text" id="meteran-value" name="meteran_value" class="form-control" required>
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
                                    {{-- @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach --}}
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


        captureBtn.addEventListener('click', async () => {
            // Pause the video stream
            previewVideo.pause();

            // Draw the current frame of the video stream to the canvas
            imageCtx.drawImage(previewVideo, 0, 0, imageCanvas.width, imageCanvas.height);
            const imageDataUrl = imageCanvas.toDataURL();
            const formattedImageDataUrl = imageDataUrl.split('+').join(' ');
            capturedImage.src = imageDataUrl;
            capturedImage.style.display = 'block';
            // set the captured image to the inputFoto
            // imageCanvas.toBlob(function(blob) {
            //     inputFoto.files = new File([blob], 'image.png', {
            //         type: 'image/png'
            //     });
            // });

            // imageCanvas.toBlob(function(blob) {
            //     inputFoto.files = new File([blob], capturedImage, {
            //         type: 'image/png'
            //     });
            // });

            // Convert the image data to a blob
            const blob = await fetch(formattedImageDataUrl).then(r => r.blob());

            const imageData = Buffer.from(imageDataUrl.split(',')[1], 'base64');
            console.log(imageData);
            const image = await Jimp.read(imageData);
            // Dimension is 640x480
            // crop the image to make a rectangle with width 320 and height 240
            image.crop(160, 160, 320, 180);

            // Scale image by 2x
            image.scale(2);

            // Adjust contrast of image
            image.contrast(0.2);

            // Adjust brightness of image
            image.brightness(0.5);

            // Convert image to grayscale
            image.greyscale();

            // Convert to 8-bit image
            image.quality(100);

            // Invert image colors
            image.invert();

            const processedDataUri = await image.getBase64Async(Jimp.AUTO);
            console.log(processedDataUri);
            bitmapImage.src = processedDataUri;
            bitmapImage.style.display = 'block';

            Tesseract.recognize(bitmapImage, 'eng', {
                    logger: m => console.log(m)
                })
                .catch(err => console.error(err))
                .then(result => {
                    console.log(result.data.words);
                    const pattern = /\d+/g;
                    const matches = result.data.text.match(pattern);
                    console.log("Length: " + result.data.words.length);
                    for (let i = 0; i < result.data.words.length; i++) {
                        console.log("matches: " + result.data.text[i].match(pattern));
                        // if (result.data.text[i].match(pattern)) {
                        if (result.data.words[i].confidence > prev_confidence) {
                            valid_data = result.data.words[i].text;
                            prev_confidence = result.data.words[i].confidence;
                        }
                        if (result.data.words[i].confidence > 95) {
                            valid_data = result.data.words[i].text;
                            prev_confidence = result.data.words[i].confidence;
                        }
                    }
                    // swal show valid_data and have option to use it or not
                    Swal.fire({
                        title: 'Apakah data yang terbaca sudah benar?',
                        text: valid_data,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Tidak'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            inputMeteran.value = valid_data;
                            // make the original image to be the inputFoto

                        }
                    })
                })
                .catch(error => console.error(error));
        });

        // Get the user's camera video stream and set it as the source of the preview video element
        // navigator.mediaDevices.getUserMedia({
        //         video: true
        //     })
        //     .then(stream => {
        //         previewVideo.srcObject = stream;
        //         previewVideo.addEventListener('loadeddata', () => {
        //             previewVideo.play();
        //             update();
        //         });
        //     })
        //     .catch(error => {
        //         console.error('Error accessing user camera:', error);
        //     });

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

        // switchCam.addEventListener('click', () => {
        //     console.log('switch camera');
        //     if (switchCam.value == 'front') {
        //         switchCam.value = 'back';
        //         turnVideo(handleVideo('environment'));
        //     } else {
        //         switchCam.value = 'front';
        //         turnVideo(handleVideo('user'));
        //     }
        // });

        function update() {
            previewCtx.drawImage(previewVideo, 0, 0, previewCanvas.width, previewCanvas.height);
            // draw rectangle on the canvas
            previewCtx.beginPath();
            previewCtx.rect(160, 160, 320, 180);
            previewCtx.lineWidth = 2;
            previewCtx.strokeStyle = 'red';
            previewCtx.stroke();

            requestAnimationFrame(update);
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
                console.log(err.name, err.message);
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
