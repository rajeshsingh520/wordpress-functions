<?php
/*
    USING THIS you can create 
    text filed,
    number filed
    media field
    color field
    Multiple category selection filed
    Dropdown field
*/
    class pi_widget_fields{

        /*
            $instance    : widget instance so we can show the old selection
            $patent_this : $this object of the widget so we can use its function to make widget variable name
        */
        public $instance;
        public $parent_this;

        public function __construct($instance, $parent_this) {
           $this->instance = $instance;
           $this->parent_this = $parent_this;

           wp_enqueue_script('pi-meidia', plugin_dir_url( __FILE__ ) . 'script.js', array('jquery'));
        }

        public function pi_get_category(){
            $cats = get_terms('category');
            return $cats;
        }

        /*
            This function is used to select multiple categories

            $field_label : is the label of the category selection field
            $field_name  : variable name that will be storing the category value
           
        */
        public function pi_multiplace_cat_selection($filed_label, $field_name){
                $parent_this = $this->parent_this;
                $instance = $this->instance;
            ?>
                <div class="rpwe-multiple-check-form" >
                    <label>
                        <?php _e( $filed_label, 'recent-posts-widget-extended' ); ?>
                    </label>
                    <ul style="width:100%; height:150px; display:block; border:1px solid #000; overflow-y:scroll; padding:10px; box-sizing:border-box; ">
                        <?php foreach ( $this->pi_get_category() as $category ) : ?>
                            <li>
                                <input type="checkbox" value="<?php echo (int) $category->term_id; ?>" id="<?php echo $parent_this->get_field_id($field_name.'-' . (int) $category->term_id); ?>" name="<?php echo $parent_this->get_field_name($field_name.'[]'); ?>" <?php checked( is_array( $instance[$field_name] ) && in_array( $category->term_id, $instance[$field_name] ) ); ?> />
                                <label for="<?php echo $parent_this->get_field_id($field_name.'-' . (int) $category->term_id); ?>">
                                    <?php echo esc_html( $category->name ); ?>
                                </label>
                                <?php //print_r( $instance); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php
        }

        /* 
            Widget Text field

        */

        public function pi_text_field($field_label, $field_name, $default_value=null){
            $parent_this = $this->parent_this;
            $instance = $this->instance;
            $title = ! empty( $instance[$field_name] ) ? $instance[$field_name] : __( $default_value, 'pi_title' );
            ?>
            <p>
            <label for="<?php echo $parent_this->get_field_id( $field_name ); ?>"><?php _e( $field_label ); ?></label>
            <input class="widefat" id="<?php echo $parent_this->get_field_id( $field_name ); ?>" name="<?php echo $parent_this->get_field_name( $field_name ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
                </p>
            <?php
        }

        /* 
            Widget Number field

        */

        public function pi_number_field($field_label, $field_name, $default_value=1,$min=null, $max=null){
            $parent_this = $this->parent_this;
            $instance = $this->instance;
            $title = ! empty( $instance[$field_name] ) ? $instance[$field_name] : __( $default_value, 'pi_title' );
            ?>
            <p>
            <label for="<?php echo $parent_this->get_field_id( $field_name ); ?>"><?php _e( $field_label ); ?></label>
            <input class="widefat" id="<?php echo $parent_this->get_field_id( $field_name ); ?>" name="<?php echo $parent_this->get_field_name( $field_name ); ?>" type="number" value="<?php echo esc_attr( $title ); ?>" <?php if($min) echo "min='".$min."'"; ?> <?php if($max) echo "max='".$max."'"; ?>>
                </p>
            <?php
        }

        /* 
            Color Selection
        */

        public function pi_color_selection($field_label, $field_name, $default_value="#cccccc"){
            wp_enqueue_style( 'wp-color-picker' );        
            wp_enqueue_script( 'wp-color-picker' );
            $parent_this = $this->parent_this;
            $instance = $this->instance;
            $font_color  = ! empty( $instance[$field_name] ) ? $instance[$field_name] : __( $default_value, 'pi_title' );
            ?>
                <p>
                <label for="<?php echo $parent_this->get_field_id( $field_name ); ?>"><?php _e( $field_label ); ?></label>
                <input type="text" class="my-color-picker" id="<?php echo $parent_this->get_field_id( $field_name ); ?>"  name="<?php echo $parent_this->get_field_name( $field_name ); ?>" value="<?php echo esc_attr( $font_color ); ?>" />
                </p>
            <?php
        }

        /* 
            Dropdown selector
        */

        public function pi_dropdown($field_label, $field_name, $list, $default_value){
            $parent_this = $this->parent_this;
            $instance = $this->instance;
            $selected = ! empty( $instance[$field_name] ) ? $instance[$field_name] : __( $default_value, 'pi_title' );
           ?>
            <p>
            <label for="<?php echo $parent_this->get_field_id( $field_name ); ?>"><?php _e( $field_label ); ?></label>
            <select  id="<?php echo $parent_this->get_field_id( $field_name ); ?>"  name="<?php echo $parent_this->get_field_name( $field_name ); ?>" >
                <?php
                    foreach($list as $key => $value){
                        echo '<option value="'.$value.'" '.selected($value, $selected).'>'.$key.'</option>';
                    }
                ?>
            </select>
            </p>
            <?php
        }

        /* 
            Media upload
        */
        public function pi_media($field_label, $field_name){
            $parent_this = $this->parent_this;
            $instance = $this->instance;
            $image = ! empty( $instance[$field_name] ) ? $instance[$field_name] : "";
           ?>
           <p>
           <label for="<?php echo $parent_this->get_field_id(  $field_name ); ?>"><?php _e( $field_label ); ?></label>
           <input class="widefat" id="<?php echo $parent_this->get_field_id( $field_name ); ?>" name="<?php echo $parent_this->get_field_name( $field_name ); ?>" type="hidden" value="<?php echo esc_url( $image ); ?>" />
           <button class="remove_image_button button button-primary" id="pi-remove">Remove Image</button>
           <button class="upload_image_button button button-primary">Upload Image</button>
           <?php if($image){ ?>
           <img src="<?php echo esc_url($image); ?>"  alt="" style="display:block; margin:auto; max-width:100%; margin-top:10px;">
           <?php }else{ ?>
            <img src="#"  alt="" style="display:block; margin:auto; max-width:100%; margin-top:10px;">
           <?php } ?>
            </p>
            <?php
        }

    }