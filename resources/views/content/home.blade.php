@extends('layouts/contentLayoutMaster')

@section('title', 'Home')

@section('content')

<div class="card-body">
    <section id="multilingual-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title">All Words</h4>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons flex-wrap d-inline-flex">
                                <button class="btn create-new btn-primary" tabindex="0" aria-controls="DataTables_Table_0" type="button" data-toggle="modal" data-target="#modals-slide-in">
                                    <span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus mr-50 font-small-4">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add New Record
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable">
                        <table class="dt-multilingual table" id="DataTables_Table_0">
                            <thead>
                                <tr>
                                    <th>English</th>
                                    <th>Kurdish</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal to add new record -->
            <div class="modal modal-slide-in fade" id="modals-slide-in" style="display: none;" aria-hidden="true">
                <div class="modal-dialog sidebar-sm">
                    <form id="jquery-val-form" class="add-new-record modal-content needs-validation  pt-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">New Word</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <input type="text" id="word_id" class="form-control dt-email" placeholder="apple" aria-label="apple" hidden>
                            <div class="form-group">
                                <label class="form-label" for="category">Choose Category</label>
                                <select type="text" class="form-control dt-full-name" id="category" placeholder="Category Name" aria-label="Category Name" required>
                                    @foreach($categories as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="english_word">English word</label>
                                <input type="text" id="english_word" class="form-control dt-email" placeholder="apple" aria-label="apple" required>
                                <small class="form-text text-muted"> You can use letters, numbers &amp; periods </small>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="kurd_word">Kurdish word</label>
                                <input type="text" id="kurd_word" class="form-control dt-email" placeholder="sêv" aria-label="sêv" required>
                                <small class="form-text text-muted"> You can also record spilling below: </small>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <input type="text" id="description" class="form-control dt-email">

                            </div>

                            <div class="form-group">
                                <label class="form-label">Kurdish spell</label>
                                <div>
                                    <div id="recordButton" class=" btn btn-danger waves-effect waves-float waves-light">Record</div>
                                    <div id="stopButton" class="btn waves-effect waves-float waves-light">Stop</div>
                                </div>
                                <label class="form-label">Recordings</label>
                                <ul id="recordingsList" style="  padding: 0; list-style-type: none;"></ul>
                                <small class="form-text text-muted"> Press 'Record' to record spelling </small>
                                <label class="form-label">Or</label>
                                <label for="myfile">Select a recording file:</label>
                                <input type="file" id="myfile" name="myfile" accept="audio/*">
                            </div>
                            <button type="button" id="add-btn" class="btn btn-primary data-submit mr-1 waves-effect waves-float waves-light">Submit</button>
                            <button type="reset" id="dismiss-btn" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--/ Multilingual -->
</div>

@endsection

@section('page-script')

<script>
    $(document).on('click', '#delete', function() {
        var id = $(this).data('id');
        var word = $(this).data('word');
        Swal.fire({
            title: 'Are you sure you want delete' + word + '?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: !0,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-secondary ml-1',
            buttonsStyling: !1
        }).then(function(t) {

            if (t.value) {
                $.ajax({
                    type: 'DElETE',
                    url: '/api/delete-word/' + id,
                });
                Swal.fire({
                    type: 'success',
                    title: 'Deleted!',
                    text: 'Your file has been deleted.',
                    confirmButtonClass: 'btn btn-success',
                }).then(function() {
                    window.location = window.location;
                    resetForm();
                });
            } else {
                t.dismiss === Swal.DismissReason.cancel &&
                    Swal.fire({
                        title: 'Cancelled',
                        text: 'Your imaginary file is safe :)',
                        type: 'error',
                        confirmButtonClass: 'btn btn-success'
                    });
            }
        });
    });
    $(document).on('click', '#show', function() {
            var en = $(this).data('english_word');
            var ku_word = $(this).data('kurdish_word');
            var ku_spell = $(this).data('kurdish_spell');
            var category = $(this).data('category');
            var description = $(this).data('description');
            var ku_spellHtml = ``;
            if (ku_spell) {
                ku_spellHtml = `
                        <audio id="player" src="` + ku_spell + `"></audio>
                        <a onclick="document.getElementById('player').play()" style="margin-bottom:0.5rem;" class="btn-icon btn-sm col-2">
                            <i class='fa fa-volume-up fa-2x'></i>
                        </a>
                `;
            }
            var showHtml = `
                        <div class="row justify-content-center mb-2 d-flex">
                            <label class="col-6 h3 text-primary" for="english_word">Category: </label>
                            <h4 class="col-6 text-bold font-weight-normal align-self-center" >` + category + `</h4>
                        </div> 
                        <div class="row mb-2 d-flex">
                            <label class="col-6 h3 text-primary align-self-center" for="english_word">English Word: </label>
                            <h4 class="font-weight-normal align-self-center col-4 " >` + en + `</h4>
                            <a onclick="responsiveVoice.speak('` + en + `');"  style="margin-bottom:0.5rem;" class="col-2 btn-icon btn-sm" value="Play">
                                <i class='fa fa-volume-up fa-2x'></i>
                            </a>
                        </div>   
                        <div class="row   mb-2 d-flex">
                            <label class="col-6 h3 align-self-center text-primary" for="english_word">Kurdish Word: </label>
                            <h4 class="col-4 font-weight-normal align-self-center" >` + ku_word + `</h4>
                            ` + ku_spellHtml + `
                        </div> 
                       
                    `;
            Swal.fire({
                title: 'Word Detail',
                html: showHtml,
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: !1,
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: !0,

                showLoaderOnConfirm: !0,
                cancelButtonClass: 'btn btn-danger ml-1',
                showConfirmButton: false,
                allowOutsideClick: function() {
                    Swal.isLoading();
                }
            }).then(function(t) {
                t.value && Swal.fire({
                    title: t.value.login + "'s avatar",
                    imageUrl: t.value.avatar_url
                });
            });
        }),
        $(document).on('click', '#edit', function() {
            $('#exampleModalLabel').text("Edit Word");
            var id = $(this).data('id');
            var en = $(this).data('english_word');
            var ku_word = $(this).data('kurdish_word');
            var ku_spell = $(this).data('kurdish_spell');
            var category = $(this).data('category');
            var description = $(this).data('description');
            var url = `{{ asset('/') }}` + ku_spell;
            editRecordingAdd(url);
            $('#word_id').val(id);
            $('#category').val(category);
            $('#english_word').val(en);
            $('#kurd_word').val(ku_word);
            $('#description').val(description);

        })
    //==============================================================================//
    $(function() {
        var submitbutton = document.getElementById("add-btn");
        var cancelbutton = document.getElementById("dismiss-btn");
        var form = document.getElementById("jquery-val-form");
        var recordButton = document.getElementById("recordButton");

        submitbutton.addEventListener("click", uploadnewword);
        cancelbutton.addEventListener("click", resetForm);
        $('#myfile').on("change", function() {
            //   recordButton.innerHTML= 'You have selected a file';
            recordButton.classList.add("disabled");
            recordButton.disabled = true;
        });

        function resetForm() {
            form.reset();
            $('#exampleModalLabel').text("New Word");
            document.getElementById("word_id").value = null;
            document.getElementById("category").value = 0;
            document.getElementById("english_word").value = '';
            document.getElementById("kurd_word").value = '';
            document.getElementById("description").value = '';
            recordButton.disabled = false;
            recordButton.classList.remove("disabled");
            document.getElementById('myfile').disabled = false;
            var num = $("#recordingsList").find("li").length;

            if (num > 0) {
                var urlfile = $('ul#recordingsList li:first audio').attr("src");
                $('ul#recordingsList').empty();
                URL.revokeObjectURL(urlfile);
            }

        }
        $("#modals-slide-in").on("hide.bs.modal", function() {
            resetForm();
        });

        function uploadnewword() {
            if (form.checkValidity() === false) {
                form.classList.add('invalid');

            } else {
                form.classList.add('was-validated');
                //اضافة او تعديل
                var wordId = document.getElementById("word_id").value;
                if (wordId == null || wordId == "") {
                    var fd = new FormData();
                    //مناقشة اذا ملف او تسجيل
                    fd.append('filename', 'test.mp3');
                    if (audioBlob != null)
                        fd.append('kurdish_spell', audioBlob);
                    else if ($('#myfile')[0] != null) {


                        fd.append('kurdish_spell', $('#myfile')[0].files[0]);
                    }
                    fd.append('kurdish_spell', $('#myfile')[0].files[0])
                    fd.append('category_id', document.getElementById("category").value);
                    fd.append('english_word', document.getElementById("english_word").value);
                    fd.append('kurdish_word', document.getElementById("kurd_word").value);
                    fd.append('description', document.getElementById("description").value);

                    $.ajax({
                        type: 'POST',
                        url: '/api/add-word',
                        data: fd,
                        processData: false,
                        contentType: false
                    }).done(function(data) {
                        window.location = window.location;
                        resetForm();
                    });
                } else {
                    var fd = new FormData();
                    //مناقشة اذا ملف او تسجيل
                    fd.append('filename', 'test.mp3');
                    if (audioBlob != null)
                        fd.append('kurdish_spell', audioBlob);
                    else if ($('#myfile')[0] != null)
                        fd.append('kurdish_spell', $('#myfile')[0].files[0])
                    fd.append('category_id', document.getElementById("category").value);
                    fd.append('english_word', document.getElementById("english_word").value);
                    fd.append('kurdish_word', document.getElementById("kurd_word").value);
                    fd.append('description', document.getElementById("description").value);

                    $.ajax({
                        type: 'POST',
                        url: '/api/edit-word/' + wordId,
                        data: fd,
                        processData: false,
                        contentType: false
                    }).done(function(data) {
                        window.location = window.location;
                        resetForm();
                    });
                }
            }
        }
        var dt_multilingual_table = $('.dt-multilingual'),
            assetPath = '../../../app-assets/';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
        }
        if (dt_multilingual_table.length) {
            var table_language = dt_multilingual_table.DataTable({
                ajax: {
                    method: 'POST',
                    url: '/api/get-words',
                    dataSrc: 'data'
                },
                columns: [

                    {
                        data: "english_word"
                    },
                    {
                        data: "kurdish_word"
                    },
                    {
                        data: "name"
                    },
                    {
                        data: "description"
                    },
                ],
                columnDefs: [{
                        // For Responsive
                        className: 'control',
                        orderable: true,
                        targets: 0
                    },

                    {
                        // Actions
                        targets: +4,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            return (

                                '<a href="javascript:;" id="show" data-id="' + full.id + '" data-english_word="' + full.english_word + '" data-kurdish_word="' + full.kurdish_word + '" data-category="' + full.name + '" data-kurdish_spell="' + full.kurdish_spell + '" class="item-edit mr-1">' +
                                feather.icons['eye'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<a href="javascript:;" id="delete" data-id="' + full.id + '" data-word="' + full.english_word + '  " data-description="' + full.description + ' " class="item-edit mr-1">' +
                                feather.icons['trash-2'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>' +
                                '<a href="javascript:;" id="edit" class="item-edit " data-id="' + full.id + '  " data-description="' + full.description + ' " data-english_word="' + full.english_word + '" data-kurdish_word="' + full.kurdish_word + '" data-category="' + full.category_id + '" data-kurdish_spell="' + full.kurdish_spell + '" data-toggle="modal" data-target="#modals-slide-in">' +
                                feather.icons['edit'].toSvg({
                                    class: 'font-small-4'
                                }) +
                                '</a>'

                            );
                        }
                    }
                ],

                dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 100,
                lengthMenu: [7, 10, 25, 50, 75, 100],

            });
        }
    });
    //==============================================================================//
    //record audio
    var audioBlob;
    var gumStream; //stream from getUserMedia()
    var recorder; //WebAudioRecorder object
    var input; //MediaStreamAudioSourceNode  we'll be recording
    var encodingType; //holds selected encoding for resulting audio (file)
    var encodeAfterRecord = true; // when to encode
    //==============================================================================//
    // shim for AudioContext when it's not avb. 
    var AudioContext = window.AudioContext || window.webkitAudioContext;
    var audioContext; //new audio context to help us record
    //==============================================================================//
    var recordButton = document.getElementById("recordButton");
    var stopButton = document.getElementById("stopButton");
    var recordingsList = document.getElementById("recordingsList");
    //==============================================================================//
    //add events to those 2 buttons
    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    //==============================================================================//
    function startRecording() {
        if (recordButton.disabled) return;
        document.getElementById('myfile').disabled = true;

        var num = $("#recordingsList").find("li").length;

        if (num > 0) {
            var urlfile = $('ul#recordingsList li:first audio').attr("src");
            $('ul#recordingsList').empty();
            URL.revokeObjectURL(urlfile);
        }



        /*
        	Simple constraints object, for more advanced features see
        	https://addpipe.com/blog/audio-constraints-getusermedia/
        */

        var constraints = {
            audio: true,
            video: false
        }

        /*
    	We're using the standard promise based getUserMedia() 
    	https://developer.mozilla.org/en-US/docs/Web/API/MediaDevices/getUserMedia
	*/

        navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
            __log("getUserMedia() success, stream created, initializing WebAudioRecorder...");

            /*
            	create an audio context after getUserMedia is called
            	sampleRate might change after getUserMedia is called, like it does on macOS when recording through AirPods
            	the sampleRate defaults to the one set in your OS for your playback device
            */
            audioContext = new AudioContext();


            //assign to gumStream for later use
            gumStream = stream;

            /* use the stream */
            input = audioContext.createMediaStreamSource(stream);

            //stop the input from playing back through the speakers
            //input.connect(audioContext.destination)

            //get the encoding 
            encodingType = 'mp3';

            //disable the encoding selector

            recorder = new WebAudioRecorder(input, {
                workerDir: "js/core/", // must end with slash
                encoding: encodingType,
                numChannels: 2, //2 is the default, mp3 encoding supports only 2
                onEncoderLoading: function(recorder, encoding) {
                    // show "loading encoder..." display
                    __log("Loading " + encoding + " encoder...");
                },
                onEncoderLoaded: function(recorder, encoding) {
                    // hide "loading encoder..." display
                    __log(encoding + " encoder loaded");
                }
            });

            recorder.onComplete = function(recorder, blob) {
                __log("Encoding complete");
                createDownloadLink(blob, recorder.encoding);
            }

            recorder.setOptions({
                timeLimit: 120, //اكثر وقت للتسجيل بالثواني
                encodeAfterRecord: encodeAfterRecord,
                ogg: {
                    quality: 0.5
                },
                mp3: {
                    bitRate: 160
                }
            });

            //start the recording process
            recorder.startRecording();

            __log("Recording started");

        }).catch(function(err) {
            //enable the record button if getUSerMedia() fails
            recordButton.disabled = false;
            recordButton.innerText = 'Record';
            stopButton.disabled = true;

        });

        //disable the record button
        recordButton.disabled = true;
        recordButton.innerText = 'Recording...';

        stopButton.disabled = false;
    }
    //==============================================================================//
    function stopRecording() {
        //stop microphone access
        gumStream.getAudioTracks()[0].stop();
        //disable the stop button
        stopButton.disabled = true;
        recordButton.disabled = false;
        recordButton.innerText = 'Record';
        //tell the recorder to finish the recording (stop recording + encode the recorded audio)
        recorder.finishRecording();
        __log('Recording stopped');
    }
    //==============================================================================//
    function editRecordingAdd(url) {
        var au = document.createElement('audio');
        var li = document.createElement('li');
        var link = document.createElement('a');

        //add controls to the <audio> element
        au.controls = true;
        au.src = url;

        //link the a element to the blob
        // link.href = url;
        // link.download = new Date().toISOString() + '.' + encoding;
        // link.innerHTML = link.download;

        //add the new audio and a elements to the li element
        li.appendChild(au);
        li.appendChild(link);

        //add the li element to the ordered list
        recordingsList.appendChild(li);
    }
    //==============================================================================//
    function createDownloadLink(blob, encoding) {
        audioBlob = blob;
        var url = URL.createObjectURL(blob);
        var au = document.createElement('audio');
        var li = document.createElement('li');
        var link = document.createElement('a');

        //add controls to the <audio> element
        au.controls = true;
        au.src = url;

        //link the a element to the blob
        // link.href = url;
        // link.download = new Date().toISOString() + '.' + encoding;
        // link.innerHTML = link.download;

        //add the new audio and a elements to the li element
        li.appendChild(au);
        li.appendChild(link);

        //add the li element to the ordered list
        recordingsList.appendChild(li);
    }
    //==============================================================================//
    //helper function
    function __log(e, data) {
        //	log.innerHTML += "\n" + e + " " + (data || '');
    }
    //==============================================================================//
</script>
<script src="{{asset('js/core/WebAudioRecorder.min.js')}}"></script>
<!-- Vendor files -->
<script src="{{asset(mix('vendors/js/extensions/sweetalert2.all.min.js'))}}"></script>
<link rel="stylesheet" type="text/css" href="vendors/css/extensions/sweetalert2.min.css">

<!-- Template files -->
<link rel="stylesheet" type="text/css" href="css/base/plugins/extensions/ext-component-sweet-alerts.css">

<!-- <script src="{{asset('js/scripts/forms/form-validation.js')}}"></script> -->

<script src="https://code.responsivevoice.org/responsivevoice.js?key=WuFKOvb8"></script>

@endsection