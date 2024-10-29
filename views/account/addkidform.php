<form class="km_form_kid_add" method="post" name="form-kid-add" id="km_form_kid_add" enctype="multipart/form-data">
    <div class="km_row">
        <div class="km_kid_add_pic km_col_3 profile-pic-upload">
            <div class="km_addnew_kid_dp_wrap">
                <?php print $this->getfielddayKidDP(['name' => ""]);?>
            </div>

            <label for="ParentPicUpload">
                <input type="file" id="ParentPicUpload" class="picUpload km_hidden" name="ParentPicUpload" onchange=" fieldday.readURL(this);">
                <span><?php _e('Change Picture', 'fieldday')?></span>
            </label>
        </div>
        <div class="km_add_single_kid km_kids_fields_wrap km_col_12">
            <div class="km_row">
                <div class="km_col_4 km_field_wrap">
                    <label><?php _e('First Name', 'fieldday');?></label>
                    <input type="text" name="firstName" class="km_input" data-parsley-group="new_kid_create" data-parsley-required-message="Required" id="new_kid_first_name" required="">
                </div>
                <div class="km_col_4 km_field_wrap">
                    <label for="new-kid-last-name"><?php _e('Last Name', 'fieldday')?></label>
                     <input type="text" class="km_input" name="lastName" data-parsley-group="new_kid_create" data-parsley-required-message="Required" id="new_kid_first_name" required="">
                </div>
                <div class="km_col_4 km_field_wrap">
                    <label for="new-kid-last-name"><?php _e('Known As ', 'fieldday')?></label>
                     <input type="text" class="km_input" name="knownAs" id="new_kid_first_name">
                </div>
            </div>
            <div class="km_row">
                <div class="km_col_4 km_field_wrap">
                    <label for="new-kid-gender"><?php _e('Gender', 'fieldday')?></label>
                     <div class="km_gender_wrap">
                         <select data-name="school" name="gender" class="">
                             <option value="">-select gender-</option>
                             <option value="male"><?php _e('Male', 'fieldday');?></option>
                             <option value="female"><?php _e('Female', 'fieldday');?></option>
                         </select>
                     </div>
                </div>
                <div class="km_col_4 km_field_wrap">
                    <label for="new-kid-date-of-birth"><?php _e('Date of Birth', 'fieldday')?></label>
                    <?php $this->fielddayDateField(['name' => "dob"]);?>
                </div>
                <div class="km_col_4 km_field_wrap km_field_school_select">
                    <label><?php _e('School', 'fieldday');?></label>
                    <select data-name="school" onchange="fieldday.getSchoolData(this,event, 'grade', 'track');" name="school" class="km_input km_select fieldday_select">
                        <option value="">-select school-</option>
                        <?php $this->displaySchools($this->getValue('school', $school, false));?>
                    </select>
                </div>
            </div>
            <div class="km_row">
                <div class='km_col_4 km_field_wrap km_school_grades'></div>
                <div class='km_col_4 km_field_wrap km_school_tracks'></div>
            </div>
        </div>
    </div>
</form>