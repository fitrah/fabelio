<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Input Product</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
			<?php
				$error = $this->session->flashdata('error');
				if(!empty($error)){
			?>
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<?php echo $error['message']; ?>
					</div>
			<?php 
				}
			?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Input new Product
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post" action="<?=base_url()?>monitoring/create">
                                        <div class="form-group">
                                            <label>Url Product</label>
                                            <input class="form-control" type="url" name="url" placeholder="Enter Url Product" required value="<?=!empty($error['url'])?$error['url']:''?>">
                                        </div>
										<button type="submit" class="btn btn-default">Submit</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
<!-- jQuery -->
<script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>