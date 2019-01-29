<?php
/**
* version 1.3
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

if(!class_exists('pisol_class_form')):
class pisol_class_form{

    private $setting;
    private $saved_value; 
    private $pro;
    function __construct($setting){

        $this->setting = $setting;

        if(isset( $this->setting['default'] )){
            $this->saved_value = get_option($this->setting['field'], $this->setting['default']);
        }else{
            $this->saved_value = get_option($this->setting['field']);
        }

        if(isset( $this->setting['pro'] )){
            if($this->setting['pro']){
                $this->pro = ' free-version ';
                $this->setting['desc'] = '<span style="color:#f00; font-weight:bold;">Workes in Pro version only / Without PRO version this setting will have no effect</span>';
            }else{
                $this->pro = ' paid-version ';
            }
        }else{
            $this->pro = "";
        }
        
        
        $this->check_field_type();
    }

    

    
    function check_field_type(){
        if(isset($this->setting['type'])):
            switch ($this->setting['type']){
                case 'select':
                    $this->select_box();
                break;

                case 'number':
                    $this->number_box();
                break;

                case 'text':
                    $this->text_box();
                break;
                    
                case 'textarea':
                    $this->textarea_box();
                break;

                case 'multiselect':
                    $this->multiselect_box();
                break;

                case 'color':
                    $this->color_box();
                break;

                case 'hidden':
                    $this->hidden_box();
                break;
            }
        endif;
    }

    /*
        Field type: select box
    */
    function select_box(){

        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<select class="pisol_select '.$this->pro.'" name="'.$this->setting['field'].'" id="'.$this->setting['field'].'"';
        echo (isset($this->setting['multiple']) ? ' multiple="'.$this->setting['multiple'].'"': '');
        echo '>';
            foreach($this->setting['value'] as $key => $val){
                echo '<option value="'.$key.'" '.( ( $this->saved_value == $key) ? " selected=\"selected\" " : "" ).'>'.$val.'</option>';
            }
        echo '</select>';

    }

    /*
        Field type: select box
    */
    function multiselect_box(){
        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<select class="pisol_select '.$this->pro.'" name="'.$this->setting['field'].'[]" id="'.$this->setting['field'].'" multiple';
        echo '>';
            foreach($this->setting['value'] as $key => $val){
                if(isset($this->saved_value) && $this->saved_value != false){
                    echo '<option value="'.$key.'" '.( ( in_array($key, $this->saved_value) ) ? " selected=\"selected\" " : "" ).'>'.$val.'</option>';
                }else{
                    echo '<option value="'.$key.'">'.$val.'</option>';
                }
            }
        echo '</select>';

    }

    /*
        Field type: Number box
    */
    function number_box(){

        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<input type="number" class="pisol_select '.$this->pro.'" name="'.$this->setting['field'].'" id="'.$this->setting['field'].'" value="'.$this->saved_value.'"';
        echo (isset($this->setting['min']) ? ' min="'.$this->setting['min'].'"': '');
        echo (isset($this->setting['max']) ? ' max="'.$this->setting['max'].'"': '');
        echo (isset($this->setting['required']) ? ' required="'.$this->setting['required'].'"': '');
        echo (isset($this->setting['readonly']) ? ' readonly="'.$this->setting['readonly'].'"': '');
        echo '>';

    }

    /*
        Field type: Number box
    */
    function text_box(){

        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<input type="text" class="pisol_select '.$this->pro.'" name="'.$this->setting['field'].'" id="'.$this->setting['field'].'" value="'.$this->saved_value.'"';
        echo (isset($this->setting['required']) ? ' required="'.$this->setting['required'].'"': '');
        echo (isset($this->setting['readonly']) ? ' readonly="'.$this->setting['readonly'].'"': '');
        echo '>';

    }
    
    /*
    Textarea field
    */
    function textarea_box(){
        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<textarea type="text" class="pisol_select '.$this->pro.'" name="'.$this->setting['field'].'" id="'.$this->setting['field'].'"';
        echo (isset($this->setting['required']) ? ' required="'.$this->setting['required'].'"': '');
        echo (isset($this->setting['readonly']) ? ' readonly="'.$this->setting['readonly'].'"': '');
        echo '>';
        echo $this->saved_value; 
        echo '</textarea>';

    }

     /*
        Field type: color
    */
    function color_box(){
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
        wp_add_inline_script('wp-color-picker','
        jQuery(document).ready(function($) {
            $(".color-picker").wpColorPicker();
          });
        ');
        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<input type="text" class="color-picker pisol_select '.$this->pro.'" name="'.$this->setting['field'].'" id="'.$this->setting['field'].'" value="'.$this->saved_value.'"';
        echo (isset($this->setting['required']) ? ' required="'.$this->setting['required'].'"': '');
        echo (isset($this->setting['readonly']) ? ' readonly="'.$this->setting['readonly'].'"': '');
        echo '>';

    }

    function hidden_box(){
        echo '<div><label for="'.$this->setting['field'].'">'.$this->setting['label'].'</label>';
        echo (isset($this->setting['desc'])) ? '<br><small>'.$this->setting['desc'].'</small>' : "";
        echo '</div>';
        echo '<input type="hidden" class="pisol_select '.$this->pro.'" name="'.$this->setting['field'].'" id="'.$this->setting['field'].'" value="'.$this->saved_value.'"';
        echo (isset($this->setting['required']) ? ' required="'.$this->setting['required'].'"': '');
        echo (isset($this->setting['readonly']) ? ' readonly="'.$this->setting['readonly'].'"': '');
        echo '>';

    }
}
endif;
