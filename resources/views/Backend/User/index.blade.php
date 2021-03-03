@extends('Backend.partials.master')
@include('Backend.partials.Header')
@include('Backend.partials.sidebar')
@include('Backend.partials.footer')


@push('css')
<link rel="stylesheet" href="{{url('Backend/plugins/datatables/dataTables.bootstrap.css')}}">
@endpush()

@section('content')


<div class="content-wrapper">

    <section class="content-header">
        <h1>
          User Management
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="#">Tables</a></li>
          <li class="active">User Management</li>
        </ol>
      </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div id="message_success" style="display:none;" class="alert alert-success">Status Enabled</div>
          <div id="message_error" style="display:none;" class="alert alert-danger">Status Disabled</div>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>Add User</button></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>SN</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Roles</th>
                  <th>Mobile No</th>
                  <th>Address</th>
                  <th>Image</th>
                  <th>Action</th>
                
                </tr>
                </thead>
                <tbody>
                   @foreach($user as $u)
                       <tr>
                          <td>{{$loop->index +1 }}</td>
                          <td>{{$u->name}}</td>
                          <td>{{$u->email}}</td>
                          <td>
                              @if(!empty($u->getRoleNames()))
                                @foreach($u->getRoleNames() as $v)
                                  <label class="btn btn-success">{{ $v }}</label>
                                @endforeach
                               @endif
                          </td>
                          <td>{{$u->mobile_no}}</td>
                          <td>{{$u->address}}</td>
                          <td>
                            @if(!empty($u->image))
                            <img src="{{asset('Images/User/'.$u->image) }}" alt="" style="width:100px; height:100px">
                            @endif
                          </td>
                      
                          <td>
                            <a href="#" data-toggle="modal" data-target="#editModal"  data-id={{$u->id}}  data-name={{$u->name}} data-email={{$u->email}}   data-address={{$u->address}}  data-mobile={{$u->mobile_no}}   ><i class="fa fa-edit"></i></a>
                              &nbsp &nbsp
                              <a href="{{route('brand.delete',$u->id)}}"><i class="fa fa-trash" style="color:red"></i></a>
                          </td> 
                       </tr>

                   @endforeach
               
                </tbody>
                <tfoot>
                
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
</div>

              <!-- Modal -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h4 class="modal-title" id="exampleModalLabel">Add User</h4>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                        <form action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username:<span style="color:red">*</span></label>
                                                <input type="text" class="form-control"  name="username" placeholder="Username">
                                             </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password:<span style="color:red">*</span></label>
                                                <input type="password" class="form-control" name="password" >
                                             </div>
            
                                          </div>
                                     
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Email:<span style="color:red">*</span></label>
                                          <input type="email" class="form-control"  name="email" placeholder="someone@gmail.com">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Address:</label>
                                          <input type="text" class="form-control" name="address"  >
                                       </div>
      
                                    </div>
                               
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Phone No:</label>
                                          <input type="integer" class="form-control" name="number" placeholder="Enter Phone No">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Image:</label>
                                          <input type="file" class="form-control" name="image" >
                                       </div>
      
                                    </div>
                               
                                 </div>
                                 <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Role: <span style="color:red">*</span></label>
                                        <select name="role_id" class="form-control">
                                          <option value="">Select Role...</option>
                                          @foreach($roles as $role)
                                              <option value="{{$role->id}}">{{$role->name}}</option>
                                          @endforeach
                                      </select>
                                     </div>
    
                                  </div>
                                 </div>
                              
                        
                           <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>

                        </form>
                     </div>
             
                   </div>
                 </div>
               </div>


               
              <!-- Edit Modal -->
              <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title" id="exampleModalLabel">Edit User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="" method="post" id="editForm" enctype="multipart/form-data">
                       {{ csrf_field() }}
                        {{method_field('put')}}
                 
                                    <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Username:</label>
                                              <input type="text" class="form-control"  name="username" id="editusername" placeholder="Username">
                                           </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                              <label>Password:</label>
                                              <input type="password" class="form-control"  name="password" >
                                           </div>
            
                                        </div>
                                   
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email:</label>
                                        <input type="email" class="form-control"  name="email" id="editemail" placeholder="someone@gmail.com">
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Address:</label>
                                        <input type="text" class="form-control" name="address" id="editaddress" placeholder="Address" >
                                     </div>
            
                                  </div>
                             
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone No:</label>
                                        <input type="integer" class="form-control" name="number" id="editnumber" placeholder="Enter Phone No">
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image:</label>
                                        <input type="file" class="form-control"  name="image" >
                                     </div>
            
                                  </div>
                             
                               </div>
                               <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Role: <span style="color:red">*</span></label>
                                      <select name="role_id" class="form-control">
                                        <option value="">Select Role...</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                   </div>
  
                                </div>
                               </div>
                            
                
          

                       
                       
                          <div class="form-group">
                           <button type="submit" class="btn btn-primary">Submit</button>
                         </div>

                       </form>
                    </div>
            
                  </div>
                </div>
              </div>




@endsection
@push('js')

<script>
    $(document).ready(function(){
      $("#example1").DataTable();

    })
  </script>
<script src="{{asset('Backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('Backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

<script>
  $('#editModal').on('show.bs.modal', function (event) {

var button = $(event.relatedTarget) 
var id = button.data('id')
var name = button.data('name') 
var email=button.data('email')
var address=button.data('address')
var number=button.data('mobile')
console.log(number);



var modal = $(this)

modal.find('.modal-body #id').val(id);
modal.find('.modal-body #editusername').val(name);
modal.find('.modal-body #editemail').val(email);
modal.find('.modal-body #editaddress').val(address);
modal.find('.modal-body #editnumber').val(number);



modal.find('.modal-body #editForm').prop('action',`{{url('user/${id}')}}`);
})
 </script>


@endpush()