<div id="km_parent_kid_<?php echo $kid->_id; ?>"  class="kid-info-wrapper kid-info-wrapper_vw_all_km_prctixipants">
				<div class="kid-info-main">
					<div class="kid-info-short-name">
                    <?php
                            if (isset($kid->profilePicURL->thumbnail) && $kid->profilePicURL->thumbnail)
                            {
                                echo wp_sprintf('<img class="km_user_dp preview-img" src="%s" alt="%s %s" />', $kid->profilePicURL->thumbnail, $kid->firstName, $kid->lastName);
                            } else
                            {
                                $initial = substr($kid->firstName, 0, 1);
                                if ($kid->firstName)
                                {
                                    $initial .= substr($kid->lastName, 0, 1);
                                }

                                echo wp_sprintf("<span class=''>%s</span><img src='' class='preview-img km_hidden'>", $initial);
                            }                    
                    
                    
                    ?>
					</div>
					<div class="kids-info-cont-wrapper">
						<h1 class="kid-name"><?php echo $kid->firstName.' '.$kid->lastName;?></h1>
						<div class="kids-gender"><span>Gender:</span><?php $this->getValue('gender', $kid); ?></div>
						<div class="kids-gender kids-dob"><span><?php _e('DOB', 'fieldday'); ?>:</span><?php echo (isset($kid->dob))? $this->parseDate($kid->dob) :'';?></div>
					</div>
				</div>
              <?php if(isset($kid->school->name) && $kid->school->name!='' ) { ?>
				<div class="kids-info-schoolnm">
                <?php echo (isset($kid->school->name))? $kid->school->name : '';?>
				</div>
              <?php } ?>

				<div class="kid-info-btn">

                <a href="#" class="km_delete_kid km_btn km_primary_color km_transparent_bg" data-kid-num-id="<?php echo $kid->_id; ?>">Delete</a>

				
                    <a href="<?php echo (isset($permalink)) ? add_query_arg([['action' => 'kidsinfo', 'id' =>$kid->_id]],$permalink) :add_query_arg(['action' => 'kidsinfo', 'id' =>$kid->_id]);?>" class="km_primary_bg"> <?php _e('View Details', 'fieldday'); ?></a>
                

				</div>
</div>
