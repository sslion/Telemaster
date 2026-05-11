<div class="card">
    <div class="card-header">
        <h3 class="card-title">Администраторы канала</h3>

        <div class="card-tools">
            <span class="badge badge-danger"></span>
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="users-list clearfix">
            <?php
            foreach ($admins as $admin) { ?>
            <li>
                <?php
                if (!$admin["fileUrl"]) {
                    $r = rand(100, 200); $g = rand(100, 200); $b = rand(100, 200);
                    $background = "background-color: rgb({$r}, {$g}, {$b});";
                    $firstLetter = mb_substr($admin["user"]["first_name"], 0, 1); ?>
                    <div style="<?=$background?> border-radius: 50%; color: #fff; text-align: center; position: relative;">
                        <img src="/avatars/chanelNoPhoto.png" style="filter: opacity(0);" alt="User Image">
                        <span class="avatar-letter"><?=$firstLetter?></span>
                    </div>
                <?php } else {
                    echo  '<img src="' . $admin["fileUrl"] . '" alt="User Image">';
                }
                $style = "";
                if($admin["user"]["is_bot"])
                    $style = "style='background-color: #eee; border-radius: 4px; display: inline-block;' title='Bot'";
                ?>
                <a class="users-list-name" href="#"><?=$admin["user"]["first_name"]?></a>
                <span class="users-list-date" <?=$style?>><?=$admin["user"]["username"] ?? ""?></span>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<style>
    .avatar-letter {
        display: block;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translateX(-50%) translateY(-50%);
        font-size: 10vw;
        line-height: 10vw;
</style>
