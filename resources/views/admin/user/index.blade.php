
@extends('admin.layouts.app')

@section('header')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <!-- Sweetalert Css -->
    <link href="{{ asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <!-- table user -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>
                                    BASIC EXAMPLE
                                </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email-Address</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                                <th>Block User</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email-Address</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                                <th>Block User</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            @foreach($users as $user)
                                            <tr id="rowUser{{ $user->id }}">
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>
                                                    <a class="deleteUser" id="{{ $user->id }}"><i class="material-icons waves-effect" >delete</i></a>
                                                    <a href="{{ route('user.edit', $user->id )}}"><i class="material-icons waves-effect" >mode_edit</i></a>
                                                </td>
                                                <td>
                                                    @if($user->status == 1)
                                                        <div class="demo-switch">
                                                            <div class="switch">
                                                            <label>OFF<input class="check" name="status" type="checkbox" checked  id="{{ $user->id }}" value="{{$user->status}}"><span class="lever"></span>ON</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="demo-switch">
                                                            <div class="switch">
                                                            <label>OFF<input class="check" name="status" type="checkbox"  id="{{ $user->id }}" value="{{$user->status}}"><span class="lever"></span>ON</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# table user -->
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('js/pages/tables/jquery-datatable.js')}}"></script>
    <script src="{{ asset('js/pages/ui/dialogs.js')}}"></script>

    <!-- SweetAlert Plugin Js -->
    <script src="{{ asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

    {{-- <!-- Select Plugin Js -->
    <script src="plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Bootstrap Notify Plugin Js -->
    <script src="../../plugins/bootstrap-notify/bootstrap-notify.js"></script> --}}

    <script> 
    $(document).ready(function(){

        ///block and unlock User
        $(".check").change(function(e){
            console.log(this.id)
                var _this = this
                $.ajax({
                    type: 'GET',  // http method
                    url : 'http://localhost:8000/user/block/'+this.id+'/'+ $(this).attr('value'),
                    success: function (data) {
                            console.log(data)
                            console.log($(_this).val())
                            if($(_this).val() ==1) {
                                $("input#"+_this.id).val(0)
                            }
                            else {
                                $("input#"+_this.id).val(1)
                            }
                    },
                    error: function (jqXhr, textStatus, errorMessage) {
                            $('p').append('Error' + errorMessage);
                    }
                });
        });

        //delete USER
        $(".deleteUser").click( function(){
            var _this = this
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $.ajax({
                    type:"GET",
                    url:"http://localhost:8000/user/delete/"+this.id,
                    success:function()
                    {
                        console.log('ok work it')
                        var row = "tr#rowUser"+_this.id
                        console.log(row)
                        $(row).remove()
                    }
                })
            }
            else
            {
                return false;
            }
        }); 

        // ///update acc user
        // $('#UpdateUser').on('show.bs.modal', function(event){
        //     console.log('modal open');
        //     var button = $(event.relatedTarget) //button that triggered the modal
        //     var recipient = button.data('whatever'); ///extract info from data attr

        //     // var modal = $(this);
        //     // modal.find('.modal-body #name').val(name);
        //     $('#name').val($(this).data('name'));


        // })
    });
    </script> 
    
@endsection