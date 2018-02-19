<!-- Левая колонка в режиме редактора -->
<ul>
<?php foreach ($items as $item):?>
    <li>
        <a href="index.php?admin&id=<?=$item['id_item']?>&act=Edit">
            <?=$item['title'];?>
        </a>
        <br />

        <a href="index.php?admin&id=<?=$item['id_item']?>&act=Edit"
        	style="color:red; font-size:x-small;">Редактировать</a> |

        <a href="index.php?admin&del=<?=$item['id_item']?>&admin&act=Del"
        	style="color:red; font-size:x-small; text-align:right">Удалить</a>
        	
        <br /><br />
    </li>
<?php endforeach; ?>
</ul>