<x-layout>
<!--start page wrapper -->
<div class="page-wrapper">
	<div class="page-content">
		<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Logistics</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0" style="background-color: transparent;">
								<li class="breadcrumb-item"><a href="/logistics"><i class="bx bx-copy"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page"> {{$logistic->title}}  Request Page</li>
							</ol>
						</nav>
					</div>
				</div>
				<!--end breadcrumb-->
    


          <div class="row">
                <div class="col-lg-12 col-sm-12">
                   
                    <div class="card" style="padding-bottom: 30px;">
                          
                                <div class=" radius-10">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h4 class="mb-0">{{$logistic->title}}  Request Details</h4>
                                                <p>View details of logistic request</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                           
                     </div>
                </div>
             
         </div>


        <div class="card" style="padding-bottom: 30px;">
          <div class="row">
                <div class="col-lg-12 col-sm-12" style="padding: 30px;">
                      <x-flash-message />
                        
                             <div class="row my-3">
                                       

                                    @if($logistic->status=="pending" && $logistic->requested_by == Auth::user()->profileid)
                                        <div class="col-lg-2">
                                            <form method="POST" action="/logistic/{{$logistic->id}}" name='delete'>
                                                @csrf
                                                @method('DELETE')
                                                <button  class="btn btn-danger" id="delete-logistic" type="submit" data-src="delete">
                                                    Delete<i class='bx bxs-trash'></i> 
                                                </button>
                                                <img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
                                
                                            </form>
                                        
                                        </div>

                                    @endif
    

                                    <div class="col-lg-10 ">
                                        <div class="card">
                                            <div class="card-body">
                                                
                                                <div class="status mb-3">
                                                                    @php
                                                                        if($logistic->status=="pending"){
                                                                            echo "<span class='badge bg-warning'>Request Pending Approval</span> ";
                                                                        }else if($logistic->status=="approved"){
                                                                            echo "<span class='badge bg-success'>Request Approved</span> ";
                                                                        } elseif($logistic->status=="disbursed") {
                                                                            echo "<span class='badge bg-info'>Request Disbursed</span> ";
                                                                
                                                                        } else {
                                                                        echo "<span class='badge bg-danger'>Request Rejected</span> ";
                                                                
                                                                        }
                                                                        

                                                                        @endphp
                                            
                                                </div>
                                            
                                            </div>
                                        </div>

                                    </div>

                           </div>
                           <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Request Title:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                         
                                            <p><b>{{$logistic->title}}</b><p>

                                           
                                        
                                    </div>
                        </div>
                             
                          
                             
                             <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Purpose:</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                          <p><b>{{$logistic->purpose}} </b></p>
                                    </div>
                            </div>
                             <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Amount</p>
                                    </div>
                                    <div class="col-lg-10 ">
                                           <p> <b>&#8358; {{number_format($logistic->amount,2)}} </b></p>

                                    </div>
                            </div>
                           
                            
                            <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Requested By:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p> <b> {{$logistic->requestedBy->name}}</b></p>

                                    </div>
                            </div>
                         <div class="row my-3">
                                    <div class="col-lg-2">
                                        <p>Sent To:</p>
                                    </div>
                                    <div class="col-lg-10">
                                            <p><b>  {{$logistic->sentTo->name}}</b></p>

                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-lg-2">
                                        <p>Duration:</p>
                                    </div>
                                    <div class="col-lg-10">
                                        <p> 
                                        @php
                                            $date1 = "2007-03-24";
                                        $date2 = "2009-06-26";

                                        $diff = abs(strtotime($logistic->end_date) - strtotime($logistic->start_date));

                                        $years = floor($diff / (365*60*60*24));
                                        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

                                        printf("<b> %d months, %d days\n </b>", $months, $days);
                                        @endphp
                                          <b> -  {{date('Y-m-d', strtotime($logistic->start_date))}} - {{date('Y-m-d', strtotime($logistic->end_date))}}</b>
                                        
                                        </p>

                                    </div>
                            </div>
                           
                            <div class="row">
                                    <div class="col-lg-2">
                                        <p>Request Status:</p>
                                    </div>
                                    <div class="col-lg-10">
                                              @php
                                                                                        if($logistic->status=="pending"){
                                                                                            echo "<span class='badge bg-warning'>Pending</span> ";
                                                                                        }elseif($logistic->status=="rejected"){
                                                                                            echo "<span class='badge bg-danger'>Rejected</span> ";
                                                                                        }elseif($logistic->status=="approved"){
                                                                                            echo "<span class='badge bg-success'>Approved</span> ";
                                                                                        }else{
                                                                                             echo "<span class='badge bg-success'>Disbursed</span> ";
                                                                                   
                                                                                        }
                                                                                        

                                                                                        @endphp

                                    </div>
                            </div>
                           

                    
                      @if(Auth::user()->profileid== $logistic->requested_by && $logistic->status=="pending")
                        
                                    <div class="row">
                                    
                            
                                        <div class="col-lg-2">
                                    
                                            
                                        <p>Edit:</p>
                                    
                                        </div>
                                        <div class="col-lg-10 ">
                                            <a href="/editlogistic{{$logistic->id}}">
                                            <button  class="btn btn-warning" id="delete-task" >
                                                    Edit<i class='bx bx-edit'></i>
                                                </button>
                                            </a>
                                            
                                        </div>
                                    </div>
                         @endif
               
                        </div>
                
             
       
       
                              
       
                    </div>
       </div>

        @if(is_null($logistic->disbursed_date) && $logistic->status!="disbursed")
                     <div class="row my-3">
                                                
                                                    <div class="col-lg-12 ">
                                                            <div class="card radius-10">
                                                                <div class="card-header">
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <h5 class="mb-0">Treat {{$logistic->title}} Logistic Request</h5>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="card-body" style="padding-top: 40px;">
                                                              
                                                                    <div class="form-body">
                                                                            <form class="row g-3" action="/logistic/treat/{{$logistic->id}}" id="treatlogistic" method="post" name="treat">
                                                                                @csrf
                                                                                @method('PUT')
                                                                                
                                                                        
                                                                                <div class="row my-2">

                                                                                    <div class="col-sm-6">
                                                                                    
                                                                                        <h3 class="form-control"> {{ucfirst($logistic->title)}}  for  &#8358;({{$logistic->amount}})</h3>
                                                                                        <input type="text" class="form-control" required id="treated_by"  name="treated_by"  value="{{ Auth::user()->profileid}}" hidden>
                                                                                    </div>
                                                                                    
                                                                                    <div class="col-sm-6">
                                                                                        <label for="status" class="form-label">Approve Or Reject Request</label>
                                                                                        <select class="form-control" id="status" name="status" >
                                                                                            <option value="">Select Action</option>
                                                                                            
                                                                                            <option  value="approved" > Approve Request </option>
                                                                                            <option  value="rejected" > Reject Request </option>
                                                                                            
                                                                                        </select>
                                                                                        @error('status')
                                                                                            <p class="text-red-500 text-danger text-xs mt-1">{{$message}}</p>
                                                                                            @enderror
                                                                                    </div>

                                                                                    
                                                                                </div><br />
                                                                                
                                                                                
                                                                            
                                                                                
                                                                                
                                                                                <div class="row">
                                                                                <div class="col-sm-6">
                                                                                        <label for="comment"> Comment</label>
                                                                                        <textarea class="form-control" id="comment" name= "comment" rows="3"></textarea>

                                                                                                                                        
                                                                                    </div>
                                                                                    
                                                                                
                                                                                    <div class="col-sm-6 text-right float-right">
                                                                                    </div>
                                                                                </div><br />
                                                                        <div class="row my-2">
                                                                                <div class="col-sm-6">
                                                                                    
                                                                                                                                        
                                                                                    </div>
                                                                                    
                                                                                
                                                                                    <div class="col-sm-6 text-right float-right">
                                                                                        <button class="btn btn-info" type="submit" id="button">Submit</button>
                                                                                        <img src="{{ asset('assets/images/processing.gif') }}" width="50px;" id="processing" class="processing" style="display: none;">
                                                                                    </div>
                                                                                </div><br />
                                                                        
                                                                            </form>
                                                                    </div>
                                                                </div>
                                                        </div>

                                                    </div>

                       </div>
                        
              @endif
		
	</div>
</div>
<!--end page wrapper -->
				



</x-layout>


<script>
$("form[name='treat']").submit(function(event) {
    event.preventDefault(); // prevent the form from submitting
     $("#button").hide();
	$("#processing").show();
	
			const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			title: 'Are you sure you want to Treat this  Logistics Request?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Treat !',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				$(this).unbind('submit').submit();
				swalWithBootstrapButtons.fire(
				'Updating Treat Request',
				'...',
				''
				)
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'You Cancelled this Operation :)',
				'error'
				)
				$("#button").show();
				$("#processing").hide();
			}
			})


});

$("form[name='delete']").submit(function(event) {
    event.preventDefault(); // prevent the form from submitting
     $("#button").hide();
	$("#processing").show();
	
			const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success',
				cancelButton: 'btn btn-danger'
			},
			buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
			title: 'Are you sure you want to Delete this  Logistics Request?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonText: 'Yes, Delete !',
			cancelButtonText: 'No, cancel!',
			reverseButtons: true
			}).then((result) => {
			if (result.isConfirmed) {
				$(this).unbind('submit').submit();
				swalWithBootstrapButtons.fire(
				'Deleting Logistic Request',
				'...',
				''
				)
			} else if (
				/* Read more about handling dismissals below */
				result.dismiss === Swal.DismissReason.cancel
				
			) {
				swalWithBootstrapButtons.fire(
				'Cancelled',
				'You Cancelled this Operation :)',
				'error'
				)
				$("#button").show();
				$("#processing").hide();
			}
			})


});

</script>