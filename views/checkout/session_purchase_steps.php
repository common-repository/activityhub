<?php if($steps): ?>
<ul id="_purchase_steps" class="_purchase_steps">
    <?php foreach ($steps as $number => $step): ?>
    <li id="km_<?php echo $step['name']; ?>" class="km_step <?php echo $number == 1 ? 'km_active_step': '' ?>">
        <span class="km_icon km_icon_<?php echo $step['name']; ?>"></span>
        <a class="km_step_number km_primary_steps" title="<?php echo $step['name']; ?>" href="javascript:;"><?php echo $number; ?></a>
    </li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
