<?php
require_once "inc/header.php";
require_once "inc/sidebar.php";
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Slider List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial</th>
						<th>Slider Title</th>
						<th>Image</th>
						<th>Image alt tag</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$query = "select  * from tbl_slider ";
					$slider = $db->select($query);
					if ($slider) {
						$serial = 0;
						while ($result = $slider->fetch_assoc()) {
							$serial++ ?>
							<tr class="odd gradeX">
								<td><?= $serial ?></td>
								<td><?=$result['title']?></td>
								<td><img src="upload/slider/<?= $result['image'] ?>" height="40px" width="60px"></td>
								<td><?=$result['alt']?></td>
								<td>
						<?php
						   if( Session::get('userRole') == 0){	?>
								 <a href="editSlider.php?editSliderId=<?= $result['id'] ?>">Edit</a> ||
									<a href="deleteSlider.php?deleteSliderId=<?= $result['id'] ?>" onclick="return confirm('Are you sure want to delete?') ">Delete</a>  
									<?php  } ?>
								</td>
							</tr>

					<?php	}	}	?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php
require_once "inc/footer.php";
?>