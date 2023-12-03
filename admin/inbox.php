<?php
  require_once "inc/header.php";
  require_once "inc/sidebar.php";
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					  $query = "select * from tbl_contact order by id desc ";
					  $message =  $db->select($query);
					  if($message){
						$serial = 0;
						while($result = $message->fetch_assoc()){
							$serial++;  ?>	
						<tr class="odd gradeX">
							<td><?=$serial?></td>
							<td><?=$result['lastname'] ?></td>
							<td><?=$result['email'] ?></td>
							<td><?=$fm->textShorten($result['body'], 30) ?></td>
							<td><?=$fm->formatDate($result['date']) ?></td>
							<td>
								<a href="viewMessage.php?messageId=<?=$result['id']?>">view</a> ||
								<a href="replyMessage.php?messageId=<?=$result['id']?>">Reply</a> ||
								<a href="?messageId=<?=$result['id'] ?>">Seen</a> 
							</td>
						</tr>
						<?php  } } ?>
					</tbody>
				</table>
               </div>
            </div>
       
			<div class="box round first grid">
                <h2>Seen Message</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
						<tr class="odd gradeX">
							<td>01</td>
							<td>Internet</td>
							<td><a href="">Delete</a> 
							</td>
						</tr>

					</tbody>
				</table>
               </div>
            </div>

        </div>
        <script type="text/javascript">
        
        $(document).ready(function () {
            setupLeftMenu();
        
            $('.datatable').dataTable();
            setSidebarHeight();
        
        
        });
 </script>
 <?php
  require_once "inc/footer.php";
 ?>
