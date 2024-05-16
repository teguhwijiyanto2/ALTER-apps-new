<?php 
session_start();
date_default_timezone_set('Asia/Jakarta');
require_once 'db.class.php';
$id = $_POST['id'];

$results = DB::query("SELECT post_comments.*, users.name, users.id as user_id, users.user_pp_file FROM post_comments JOIN users ON post_comments.posted_by = users.id WHERE reply_comment_id IS NULL AND post_comments.post_id = %s ", $id);
foreach ($results as $comment) {

    $user_profile_images = 'https://placehold.co/48x48.png';

    if (!empty($comment['user_pp_file'])) {
      $user_pp_file_path = 'user_pp_files/' . $comment['user_pp_file'];
      
      if (file_exists($user_pp_file_path)) {
          $user_profile_images = $user_pp_file_path;
      }
    }

    $reply_comments = DB::query("SELECT post_comments.*, users.name, users.id as user_id, users.user_pp_file FROM post_comments JOIN users ON post_comments.posted_by = users.id WHERE reply_comment_id = %i", $comment['id']);

?>

<div class="comment__item d-flex flex-row gap-3 px-3 pt-3">
    <img
    src="<?php echo $user_profile_images ?>"
    width="48"
    height="48"
    class="rounded-circle"
    />
    <div>
        <span class="fs-6 text-capitalize"> <?php echo $comment['name'] ?></span>
        <div class="text-light" style="font-size: 10pt; margin-top:3px;">
            <?php echo $comment['comment'] ?>
        </div>
        <span
            id="reply-comment"
            onclick="replyComment(<?php echo $comment['post_id'] ?>,<?php echo $comment['id'] ?>)"
            class="text-secondary cursor__pointer"
            style="font-size: 10pt"
            >Reply</span
        >
        <?php if(count($reply_comments) > 0) { ?>
        <div
            onclick="showReply(<?php echo $comment['id'] ?>)"
            class="text-secondary cursor__pointer d-flex flex-row align-items-center gap-2"
            style="font-size: 10pt;"
        >
            <div
            class="bg-secondary bg-opacity-50 d-inline-block"
            style="width: 2rem; height: 1px"
            ></div>
            View <?php echo count($reply_comments) ?> replies
        </div>
            <div class="<?php echo (isset($_GET['x']) && $_GET['x'] == $comment['id']) ? 'd-block' : 'd-none' ?>" id="reply-comment__wrapper<?php echo $comment['id']?>">
                <?php 
                foreach ($reply_comments as $reply) {

                    $user_reply_images = 'https://placehold.co/36x36.png';
                
                    if (!empty($reply['user_pp_file'])) {
                        $user_pp_file_path = 'user_pp_files/' . $reply['user_pp_file'];
                        
                        if (file_exists($user_pp_file_path)) {
                            $user_reply_images = $user_pp_file_path;
                        }
                    }
                ?>
                    <div class="reply-comment__item d-flex flex-row gap-3 pt-3">
                    <img
                    src="<?php echo $user_reply_images ?>"
                    width="36"
                    height="36"
                    class="rounded-circle"
                    />
                    <div>
                    <span class="fs-6 text-capitalize"> <?php echo $reply['name'] ?></span>
                    <div class="text-light" style="font-size: 10pt; margin-top:3px;">
                        <?php echo $reply['comment'] ?>
                    </div>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
</div>

<?php } ?>

<script>
      function showReply(id) {
        // $(this).removeClass('d-flex');
        // $(this).addClass('d-none');
        var hide = $('#reply-comment__wrapper'+id).hasClass('d-none');
          if (hide) {
            $('#reply-comment__wrapper'+id).removeClass('d-none');
            $('#reply-comment__wrapper'+id).addClass('d-block');
          } else {
            $('#reply-comment__wrapper'+id).removeClass('d-block');
            $('#reply-comment__wrapper'+id).addClass('d-none');
          }
      }
    </script>