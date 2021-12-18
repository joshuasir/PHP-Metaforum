<?php
require 'utils.php';
require 'databaseHandler.php';
session_start();
$flag=0; 
$forums = (isset($_POST['Cat'])) ? getThreads($_POST['Cat']): NULL; 
$_SESSION['category'] = $_POST['Cat'];
?>

<?php if (isset($forums) && count($forums)>0): ?>
    <?php foreach ($forums as $post) : ?>
        <tr class=<?= (($flag++%2==1) ? 'bg-light':'bg-white').' d-flex flex-row content' ?>>
            <td style="width: 15%;" class="pt-3">
                <p class="text-muted text-center"> <?= ($post['badge']) ? '[HOT]' : ''?></p>
            </td>
            <td style="width: 40%;">
                <a id=<?=$post["id"]?> class="text-start" style="margin-left:-2em" href=''> <?= $post["title"]?> </a> 
            </td>
            <td  class="pt-3" style="width: 15%;">
                <p class="text-start" style="margin-left:-2em"> by <?= $post["author"]?> </p> 
            </td>
            <td  class="w-50 d-flex pt-4 align-items-end"  >
            <i class="far fa-eye pr-1 pt-1"></i><p style="margin-bottom: 0;"class="pl-1">  <?= $post["view"]?> </p> 
            </td>
            <td  class="w-50 d-flex ">
            <i class="far fa-comments pr-1 pt-1"></i><p class="pl-1">  <?= $post["replies"]?> </p> 
            </td>
            <td  class="w-50 p-4">
                <p> <?= getDiff($post["lastreplied"]);?> Ago </p> 
            </td>
        </tr>
    <?php endforeach ?>
<?php else: ?>
    <tr class="w-100 content">
    <td> <p class="text-muted w-100"> No forum posted yet for this category </p>
        </td>
    </tr>
<?php endif; ?>