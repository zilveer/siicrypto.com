<h4>Transactions</h4>
		<table class="table table-condensed table-bordered table-hover" >
		<thead>
			<tr>
				<th>Date</th>
				<th>Username</th>
				<th>Reference</th>				
				<th>Amount</th>
				<th>Type</th>
				<th>Approved</th>		
				<th>Action</th>								
			</tr>
		</thead>
		<tbody>
<?php 
$i = 0;
foreach ($Details as $tx){?>
		<tr <?php if(($i%2)==0){?>style="background-color:#B8FBAC"<?php }else{?>style="background-color:#FEEABA"<?php }?>>
			<td><?=gmdate('Y-M-d H:i:s',$tx['TranDate']->sec)?></td>
			<td><a href="/Admin/detail/<?=$tx['username']?>" target="_blank"><?=$tx['username']?></a></td>
			<td><?=$tx['Reference']?></td>
			<td style="text-align:right "><strong class="label label-warning tooltip-x" rel="tooltip-x" data-placement="top" title="Withdraw"><?=number_format($tx['Amount'],2)?> <?=$tx['Currency']?></strong><br>
<strong class="label label-success  tooltip-x" rel="tooltip-x" data-placement="top" title="Balance">
			<?php if($tx['Currency']=='GBP'){echo number_format($tx['GBP'],2).' GBP';}?>
			<?php if($tx['Currency']=='USD'){echo number_format($tx['USD'],2).' USD';}?>
			<?php if($tx['Currency']=='EUR'){echo number_format($tx['EUR'],2).' EUR';}?></strong></td>
			<td><?php if($tx['Added']==true){echo "Deposit";}else{echo "Withdraw";}?></td>
			<td style="text-align:center"><?=$tx['Approved']?>
			<br>Uploaded:<?=$tx['Uploaded']?><br>
			<a href="/vanity/out/SiiCrypto-Withdraw-<?=$tx['Reference']?>-<?=gmdate('Y-M-d',$tx['DateTime']->sec)?>-<?=$tx['Currency']?>-<?=$tx['netAmount']?>.pdf" target="_blank" class="btn btn-primary" >View</a><br>
			</td>			
			<td colspan="2">
			Action->
			<a href="/admin/deletewithdrawal/<?=$tx['_id']?>" class="tooltip-x label label-warning" rel="tooltip-x" data-placement="top" title="Cannot be recovered">Delete</a>
			<a href="/admin/rejectwithdrawal/<?=$tx['_id']?>/W1" id="RejectURL" class="tooltip-x label label-important" rel="tooltip-x" data-placement="top" title="User will be sent an email about rejection, cannot be recovered">Reject</a><br>			
			<select id="RejectReason" class="span2 form-control" onChange="RejectReason(this.value);">
			<?php foreach($reasons as $reason){	?>
				<option value="<?=$reason['code']?>"><?=$reason['reason']?></option>
			<?php }?>
			</select>

			<form action="/admin/approvewithdrawal" method="post" class="form form-horizontal">
			<input type="hidden" name="WithdrawalMethod" id="WithdrawalMethod" value="<?=$tx['WithdrawalMethod']?>">
			<input type="hidden" name="WithdrawalCharges" id="WithdrawalCharges" value="<?=$tx['WithdrawalCharges']?>"><br>
				<input type="text" name="Amount" id="Amount" value="<?=$tx['Amount']?>"  max="<?=$tx['Amount']?>" min="1"  class="form-control  tooltip-x" rel="tooltip-x" data-placement="top" title="Only numbers no comma ">
				<input type="hidden" name="id" id="id" value="<?=$tx['_id']?>">
				<input type="hidden" name="Currency" id="Currency" value="<?=$tx['Currency']?>">				
				<input type="submit" value="Approve" class="btn btn-primary tooltip-x" rel="tooltip-x" data-placement="top" title="Approve this transaction">
			</form>
			</td>
		</tr>
<?php  foreach($tx['Previous'] as $pt){ ?>
		<tr <?php if(($i%2)==0){?>style="background-color:#B8FBAC"<?php }else{?>style="background-color:#FEEABA"<?php }?>>
			<td><?=gmdate('Y-M-d H:i:s',$pt['DateTime']->sec)?></td>
			<td><?=$tx['username']?></td>
			<td>Previous Transaction </td>
			<td style="text-align:right "><?=number_format($pt['Amount'],2)?></td>
			<td style="text-align:right "><?=$pt['Currency']?></td>			
			<td><?php if($pt['Added']==true){echo "Deposit";}else{echo "Withdraw";}?></td>
			<td style="text-align:center"><?=$pt['Approved']?></td>			
			<td colspan="3"></td>
		</tr>
<?php }?>
		
<?php $i++;
} ?>
		</tbody>
	</table>
