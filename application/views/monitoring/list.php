<!-- DataTables CSS -->
<link href="http://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Product List</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Product List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
							<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
								<thead>
									<tr>
										<th>No</th>
										<th>Product Name</th>
										<th>Product URL</th>
										<th>Price</th>
										<th>Create at</th>
										<th>Update at</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>No</th>
										<th>Product Name</th>
										<th>Product URL</th>
										<th>Price</th>
										<th>Create at</th>
										<th>Update at</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>
<!-- DataTables JavaScript -->
<script src="http://code.jquery.com/jquery-3.3.1.js"></script>
<script src="http://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
		$('#dataTables').DataTable( {
			"processing": true,
			"serverSide": true,
			aoColumnDefs: [
                    { "aTargets": [ 0 ], "bSortable": false },  
                     { "aTargets": [ 6 ], "bSortable": false }, 
                ],
			"ajax":{
                url :"<?=base_url()?>monitoring/getData",
                type: "post",
			}
		} );
	} );
</script>
