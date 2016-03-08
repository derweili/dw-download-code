<?php
function dwdownloads_protectbox_markup( $object )
{
    wp_nonce_field(basename(__FILE__), "dwdownloads-protectbox-nonce");

    ?>
        <div>

            
            <?php
                $dwdownloads_protect_checkbox_value = get_post_meta($object->ID, "dwdownloads_protected", true);

                if($dwdownloads_protect_checkbox_value == "")
                {
                    ?>
                        <input name="dwdownloads-protect" id="dwdownloads-protect" type="checkbox" value="true">
                    <?php
                }
                else if($dwdownloads_protect_checkbox_value == "true")
                {
                    ?>  
                        <input name="dwdownloads-protect" id="dwdownloads-protect" type="checkbox" value="true" checked>
                    <?php
                }
            ?><label for="dwdownloads-protect">Beitrag schützen.</label>
        </div>
    <?php  
}

function dwdownloads_add_protect_box()
{
    add_meta_box("dwdwownloads-checkbox", "Durch Codes schützen", "dwdownloads_protectbox_markup", array('post', 'page'), "side", "high", null);
}

add_action("add_meta_boxes", "dwdownloads_add_protect_box");



//Save Fields
function dwdownloads_save_protect_box($post_id, $post, $update)
{
    if (!isset($_POST["dwdownloads-protectbox-nonce"]) || !wp_verify_nonce($_POST["dwdownloads-protectbox-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if("post" != $post->post_type && "page" != $post->post_type)
        return $post_id;

    $dwdownloads_protect_checkbox_value = "";

    if(isset($_POST["dwdownloads-protect"]))
    {
        $dwdownloads_protect_checkbox_value = $_POST["dwdownloads-protect"];
    }   
    update_post_meta($post_id, "dwdownloads_protected", $dwdownloads_protect_checkbox_value);
}

add_action("save_post", "dwdownloads_save_protect_box", 10, 3);