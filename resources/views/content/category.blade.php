@extends('layouts/contentLayoutMaster')

@section('title', 'Categories')

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
                                <button class="btn create-new btn-primary" tabindex="0" type="button" data-toggle="modal" data-target="#modals-slide-in">
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
                                    <th>Name</th>
                                    <th>Words</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal to add new record -->
            <div class="modal modal-slide-in fade" id="modals-slide-in" style="display: none;" aria-hidden="true">
                <div class="modal-dialog sidebar-sm">
                    <form id="jquery-val-form"  class="modal-content needs-validation  pt-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            
                            <div class="form-group">
                                <label class="form-label" for="english_word">Name</label>
                                <input type="text" id="category" name="name" class="form-control dt-email" placeholder="Sport"
                                    aria-label="Sport" required>
                                <small class="form-text text-muted"> You can use letters, numbers &amp; periods </small>
                                <input type="hidden" id="category_id" name="id" class="form-control ">

                            </div>
                            <button type="button" id="add-btn" class="btn btn-primary data-submit mr-1 waves-effect waves-float waves-light ">Submit</button>
                            <button type="reset" id="dismiss-btn" class="btn btn-outline-secondary waves-effect"
                                data-dismiss="modal">Cancel</button>
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
<script src="{{asset('js/core/WebAudioRecorder.min.js')}}"></script>
<!-- Vendor files -->
<script src="{{asset(mix('vendors/js/extensions/sweetalert2.all.min.js'))}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('vendors/css/extensions/sweetalert2.min.css')}}">

<!-- Template files -->
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/extensions/ext-component-sweet-alerts.css')}}">

  <script>

    $(document).on('click','#delete',function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        Swal.fire({
        title: 'Are you sure you want delete category ('+name+'), with ALL the words under it ?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: !0,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        confirmButtonClass: 'btn btn-danger',
        cancelButtonClass: 'btn btn-secondary ml-1',
        buttonsStyling: !1
    }).then(function (t) {
        if(t.value){
            $.ajax({
                type: 'DElETE',
                url: '/api/delete-category/'+id,
            });
           Swal.fire({
              type: 'success',
              title: 'Deleted!',
              text: 'Your category ('+name+') has been deleted, with ALL the words under this category',
              confirmButtonClass: 'btn btn-success',
            }).then(function(){
                window.location = window.location;
                resetForm();
            });
         }else{ 
         }
      });
    });

    $(document).on('click', '#edit' , function(){
        
        var category = $(this).data('name');
        
        var id = $(this).data('id');

        $('#category').val(category);
        $('#category_id').val(id);
      

    })
    
    $(function(){
        var submitbutton = document.getElementById("add-btn");
        var cancelbutton = document.getElementById("dismiss-btn");
        var form = document.getElementById("jquery-val-form");

        submitbutton.addEventListener("click", uploadnewword);
        cancelbutton.addEventListener("click", resetForm);

        function resetForm() {
            form.reset();
            document.getElementById("category").value = '';
            document.getElementById("category_id").value = 0;
        }

        function uploadnewword() {
            if (form.checkValidity() === false) {
                form.classList.add('invalid');
            } else {
                form.classList.add('was-validated');

                var id = $('#category_id').val();
                var fd = new FormData();

                fd.append('id', document.getElementById("category_id").value);
                fd.append('name', document.getElementById("category").value);

                if(id == ""){
                    $.ajax({
                        type: 'POST',
                        url: '/api/add-category',
                        data: fd,
                        processData: false,
                        contentType: false
                    }).done(function(data) {
                        window.location = window.location;
                        resetForm();
                    });
                }else{
                    $.ajax({
                        type: 'POST',
                        url: '/api/edit-category/'+id,
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

        var dt_multilingual_table = $('#DataTables_Table_0'),
        assetPath = '../../../app-assets/';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
        }
        if (dt_multilingual_table.length) {
            var table_language = dt_multilingual_table.DataTable({
                ajax: {
                    method: 'POST',
                    url: '/api/get-categories',
                    dataSrc: 'data'
                },
                columns: [

                    {
                        data: "name"
                    },
                    {
                        data: "words_count"
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
                        targets: 2,
                        title: 'Actions',
                        orderable: false,
                        render: function(data, type, full, meta) {
                            if(full.name != "Home"){
                                return (
                                    '<a href="javascript:;" id="delete" data-id='+full.id+' data-name='+full.name+' class="item-edit mr-1">' +
                                    feather.icons['trash-2'].toSvg({
                                        class: 'font-small-4'
                                    }) +
                                    '</a>' +
                                    '<a href="javascript:;" id="edit" data-id='+full.id+' data-name="'+full.name+'" class="item-edit " data-toggle="modal" data-target="#modals-slide-in">' +
                                    feather.icons['edit'].toSvg({
                                        class: 'font-small-4'
                                    }) +
                                    '</a>'

                                );
                            }else{
                                return '';
                            }
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


@endsection