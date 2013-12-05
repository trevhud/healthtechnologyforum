<div class="standard-generic-field generic-field-resource">
    <div class="generic-label"><label for="nr_cols"><?php _e( 'Set number of cols', 'cosmotheme' ); ?></label></div>
    <div class="generic-field generic-field-select">
        <select id="nr_cols" onchange="javascript:price( this.value );">
            <option selected="selected"><?php _e( 'select number of columns' , 'cosmotheme'); ?></option>
            <?php
                for($i = 1; $i < 10; $i++ ){
                    if( $i != 1 ){
                        $col = 'col';
                    }else{
                        $col = 'cols';
                    }
                    echo '<option value="'.$i.'"> ' . $i . ' ' . $col . '</option>';
                }
            ?>

        </select>
    </div>
    
    <div class="clear"></div>

    

    <!-- pricing table -->
    <div class="container-price-cols">
    </div>
</div>
