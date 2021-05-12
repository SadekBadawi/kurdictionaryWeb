@extends('layouts/contentLayoutMaster')

@section('title', 'KURDictionary')

@section('vendor-style')
{{-- vendor css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
@endsection
@section('page-style')
{{-- Page css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('navLogo')

<img alt="Logo" src="{{asset('img/kur.png')}}" style="max-width: 240px" />
@endSection

@section('content')

<section id="multilingual-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h4 class="card-title">All Words</h4>
                    <div class="dt-action-buttons text-right">
                        <div class="dt-buttons flex-wrap d-inline-flex">

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

    </div>
</section>
@endsection

@section('vendor-script')
{{-- vendor files --}}

<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')
{{-- Page js files --}}

<div class="modal fade text-left" id="timedout-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Timedout Dialog</h4>
            </div>
            <form id="timedout-form" action="#">
                <div class="modal-body">
                    <label>Name </label>
                    <div class="form-group">
                        <input type="text" id="full-name" placeholder="Full Name" class="form-control" required />
                    </div>
                    <label>Email </label>
                    <div class="form-group">
                        <input type="email" id="email" placeholder="Email Address" class="form-control" required />
                    </div>
                    <label>Phone </label>
                    <div class="form-group">
                        <input type="tel" id="phone" placeholder="Phone Number" class="form-control" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="confirm-timedout-btn" type="button" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    //----------------------------------------------------------------------------//
    $(function() {
        var visitNumber = 0;
        if (getCookie('visit-number')) {
            visitNumber = getCookie('visit-number');
            visitNumber++;
            setCookie('visit-number', visitNumber, 365);
        } else {
            visitNumber++;
            setCookie('visit-number', visitNumber, 365);
        }

        if (visitNumber > 14) {
            showTimedoutModal();
        }
    });
    //----------------------------------------------------------------------------//
    function showTimedoutModal() {
        var $timedoutModal = $('#timedout-modal');
        $timedoutModal.modal({
            backdrop: 'static',
            keyboard: false
        });
        $timedoutModal.find('#confirm-timedout-btn').click(function() {
            var $form = $timedoutModal.find('#timedout-form');
            if ($form.find('#full-name').val() && $form.find('#email').val() && $form.find('#phone').val()) {
                setCookie('visit-number', 1, 365);
                $timedoutModal.modal('hide');
            } else {
                Swal.fire({
                    type: 'danger',
                    title: 'Error!',
                    text: 'Please enter all the data',
                    confirmButtonClass: 'btn btn-success',
                });
            }
        })
    }
    //----------------------------------------------------------------------------//
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


        $(function() {


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

                                    '<a href="javascript:;" id="show" data-id="' + full.id + '" data-english_word="' + full.english_word + '" data-kurdish_word="' + full.kurdish_word + '" data-category="' + full.name + '" data-kurdish_spell="' + full.kurdish_spell + ' ' + full.id + '  " data-description=" " class="item-edit mr-1">' +
                                    feather.icons['eye'].toSvg({
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
</script>
<script src="{{asset(mix('vendors/js/extensions/sweetalert2.all.min.js'))}}"></script>
<link rel="stylesheet" type="text/css" href="vendors/css/extensions/sweetalert2.min.css">
<!-- Template files -->
<link rel="stylesheet" type="text/css" href="css/base/plugins/extensions/ext-component-sweet-alerts.css">
<script src="https://code.responsivevoice.org/responsivevoice.js?key=WuFKOvb8"></script>


@endsection