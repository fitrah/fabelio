<!-- Morris Charts CSS -->
<link href="<?php echo base_url()?>assets/vendor/morrisjs/morris.css" rel="stylesheet">
	
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Price History</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
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
<!-- /.row -->
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Product Detail
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-4">
						<img src="<?=$product['product_image']?>" width="200px">
					</div>
					<div class="col-lg-8">
						<h4><?=$product['product_title']?></h4>
						<span>Price : Rp. <?=$product['product_price']?></span>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<dl>
						<dt>Description</dt>
						<dd><?=$product['product_description']?></dd>
						</dl>
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
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				Price Movement
			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<?php if (isset($historyProduct)) { ?>
				<div id="myfirstchart" style="height: 250px;"></div>
				<?php } else { ?>
					<div class="panel-heading">
						History Nof Found
					</div>
				<?php } ?>
			</div>
			<!-- /.panel-body -->
		</div>
	</div>
</div>

<!-- /.row -->
<?php 
if (isset($comment)) { 
	foreach ($comment as $key=>$val){
	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Comment
				</div>
				<!-- /.panel-heading -->
				<div class="panel-body">
					<div class="row">
							<div class="col-lg-6">
								<p><?=$val['comment_content']?></p>
							</div>
					</div>
					<div class="row">
							<div class="col-lg-2">
								<a href="<?=base_url()?>monitoring/add_likes/<?=$val['comment_id']?>/<?=$product['product_id']?>/1" class="fa fa-thumbs-o-up"> <?=$val['likes']?> likes</a>
							</div>
							<div class="col-lg-2">
								<a href="<?=base_url()?>monitoring/add_likes/<?=$val['comment_id']?>/<?=$product['product_id']?>/2" class="fa fa-thumbs-o-down"> <?=$val['dislikes']?> dislikes</a>
							</div>
					</div>
					<div class="row">
							<div class="col-lg-2">
								<?=$val['likes']-$val['dislikes']?> nett
							</div>
					</div>
				</div>
				<!-- /.panel-body -->
			</div>
		</div>
	</div>
<?php 
	}
} else { ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				History Nof Found
			</div>
		</div>
	</div>
</div>
<?php } ?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">

			<div class="panel-heading">
				Add New Comment
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-6">
						<form role="form" method="post" action="<?=base_url()?>monitoring/add_comment/<?=$product['product_id']?>">
							<div class="form-group">
								<textarea name="comment_content" class="form-control" rows="3"></textarea>
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

	<!-- jQuery -->
	<script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>

	<!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url()?>assets/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/morrisjs/morris.min.js"></script>
<script>
new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
  <?php foreach ($historyProduct as $key=>$val) {?>
    { date: '<?=$val['created_date']?>', value: <?=$val['product_price']?> },
  <?php } ?>
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'date',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Price']
});
</script>

