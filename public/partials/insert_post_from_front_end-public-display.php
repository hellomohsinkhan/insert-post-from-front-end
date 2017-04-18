<div class="container">
    <form method="post" action="" name="insertpost" id="insertpost" enctype="multipart/form-data">
        <?php wp_nonce_field('inser_post_from_front', 'verify_insert_post'); ?>
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="title" class="form-control" id="title" placeholder="Enter title" name="title">
        </div>
        <div class="form-group">
              <label for="title">Description:</label>
            <?php
            $content = '';
            $editor_id = 'mycustomeditor';

            wp_editor($content, $editor_id);
            ?>
        </div>
        <div class="form-group">
            <label for="file">Featured Image:</label>
            <input type="file" class="form-control" id="featuredimage" name="file">
        </div>
        

        <button type="submit" class="btn btn-default" id="submitpost" >Submit</button>
    </form>
</div>